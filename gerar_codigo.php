<?php
require 'db_connection.php'; // Conexão com o banco
require 'email.php'; // Função para envio de e-mails

date_default_timezone_set('America/Sao_Paulo'); // Ajuste para o fuso horário correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);

    // Verifica se o CPF e e-mail são válidos e estão ativos
    $sql = "SELECT * FROM radcadastro WHERE cpf = :cpf AND email = :email AND ativo = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":cpf", $cpf);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	// Elimina tentativas sem o devido cadastro no sistema de cpf e email ou bloqueado.
	if (!$result) {
		header("Location: cad_avisos.php?erro=cpf_email_block");
		exit();
	}
    
	// Verifica se já há um código ativo e não utilizado
    $sql2 = "SELECT * FROM radcodigo WHERE cpf = :cpf AND usado = 0 AND expiracao > NOW()";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(":cpf", $cpf);
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
	// Verifica se o código está válido e gera o error
	if ($result2 > 0) {
		header("Location: cad_avisos.php?erro=codigo_ainda_ativo");
		exit();
	}
    if ($result && !$result2) {
        $codigo = random_int(100000, 999999); // Código mais seguro
        $expiracao = date('Y-m-d H:i:s', strtotime('+15 minutes')); //Soma 15 minutos ao relógio atual
		$ip_solicitante = $_SERVER['REMOTE_ADDR']; // Captura o IP
		
        // Insere o código na tabela de recuperação
        $sql3 = "INSERT INTO radcodigo (cpf, email, codigo, expiracao, usado, ativacao_recuperacao, ip_solicitante) 
                 VALUES (:cpf, :email, :codigo, :expiracao, 0, 1, :ip_solicitante)";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->bindParam(":cpf", $cpf);
        $stmt3->bindParam(":email", $email);
        $stmt3->bindParam(":codigo", $codigo);
        $stmt3->bindParam(":expiracao", $expiracao);
		$stmt3->bindParam(":ip_solicitante", $ip_solicitante);

			if ($stmt3->execute()) {
              // Envio de e-mail
			$assunto = "SEU ASSUNTO | Redifinir Senha";
			$link = "https://seuservidordecadastro/validar_codigo.php?cpf=" . urlencode($cpf);
			$mensagem = "Seu código de redefinição é: $codigo. Ele expira em 15 minutos.\n";
			$mensagem .= "Acesse o link abaixo para validar seu código e redefinir sua senha:\n$link";

				if (enviarEmail($email, $assunto, $mensagem)) {
					header("Location: cad_avisos.php?erro=codigo_ok");
					exit();
				} else {
					header("Location: cad_avisos.php?erro=codigo_erro_envio_email");
					exit();
				}
			} else {
				header("Location: cad_avisos.php?erro=codigo_erro_cadastro");
				exit();
			}

	} else {
		header("Location: cad_avisos.php?erro=codigo_condicao");
		exit();
	}
}
?>
