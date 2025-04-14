<?php
require 'db_connection.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = trim($_POST['cpf']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    try {
        // Verificar se o CPF já existe na tabela cadastro
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM radcadastro WHERE cpf = ?");
        $stmtCheck->execute([$cpf]);
        
		// Evento de erro. "CPF já cadastrado."
        if ($stmtCheck->fetchColumn() > 0) {
            header("Location: cad_avisos.php?erro=cpf_existente");
            exit;
        }

        $pdo->beginTransaction();
        
        // Inserir na tabela radcadastro
		$ip_solicitante = $_SERVER['REMOTE_ADDR']; // Captura o IP
        $stmt1 = $pdo->prepare("INSERT INTO radcadastro (cpf, nome, email, senha, ip_solicitante) VALUES (?, ?, ?, ?, ?)");
        $stmt1->execute([$cpf, $nome, $email, $senha, $ip_solicitante]);
        
        // Inserir na tabela radcheck
        $stmt2 = $pdo->prepare("INSERT INTO radcheck (username, attribute, op, value) VALUES (?, 'Cleartext-Password', ':=', ?)");
		$stmt2->execute([$cpf, $senha]);
        
        $pdo->commit();
        
        // Evento de erro. "Cadastro realizado com sucesso!";
		header("Location: cad_avisos.php?erro=cadastro_ok");
    } catch (Exception $e) {
        $pdo->rollBack();
		// Exibe a mensagem de erro no navegador para desenvolvedor
		//echo "Erro ao cadastrar: " . $e->getMessage();
		//echo "<br><pre>" . $e->getTraceAsString() . "</pre>";
        //Evento de erro. "Erro ao cadastrar. Retorno do BD"
		header("Location: cad_avisos.php?erro=erro_cadastro");
    }
} else {
    //echo "Requisição inválida.";
	header("Location: cad_avisos.php?erro=invalida");
}
