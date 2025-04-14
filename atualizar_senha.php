<?php
session_start();
require 'db_connection.php';

// Verifica se o usuário passou pela verificação do código
if (!isset($_SESSION['cpf'])) {
    header("Location: esqueci.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_senha = $_POST['senha'];
    $cpf = $_SESSION['cpf'];

    try {
        $pdo->beginTransaction(); // Iniciar transação

        // Atualiza a senha no banco `radcadastro`
        $sql1 = "UPDATE radcadastro SET senha = :senha WHERE cpf = :cpf";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(":senha", $nova_senha);
        $stmt1->bindParam(":cpf", $cpf);
        $stmt1->execute();

        // Atualiza a senha no banco `radcheck`
        $sql2 = "UPDATE radcheck SET Value = :senha WHERE username = :cpf";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(":senha", $nova_senha); // Aqui precisa ser sem hash!
        $stmt2->bindParam(":cpf", $cpf);
        $stmt2->execute();

        // Commit se tudo der certo
        $pdo->commit();

        // Limpa a sessão corretamente
        session_unset();
        session_destroy();

        header("Location: cad_avisos.php?erro=senha_alterada");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack(); // Reverter alterações em caso de erro
        header("Location: cad_avisos.php?erro=erro_senha");
        exit();
    }
}
?>
