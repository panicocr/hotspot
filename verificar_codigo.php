<?php
require 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = trim($_POST['cpf']);
    $codigo = trim($_POST['codigo']);

    // Verifica se há tentativas recentes
    $sql1 = "SELECT tentativas, ultimo_erro FROM radtentativas WHERE cpf = :cpf";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(":cpf", $cpf);
    $stmt1->execute();
    $tentativa = $stmt1->fetch(PDO::FETCH_ASSOC);

    // Se houver tentativas anteriores
    if ($tentativa) {
    $tentativas = $tentativa['tentativas'];
    $ultimoErro = strtotime($tentativa['ultimo_erro']);
    $tempoAtual = time();

    // Se tempo for maior que 60 minutos, limpar tentativas e resetar timestamp
    if (($tempoAtual - $ultimoErro) > 3600) {
        $sql0 = "UPDATE radtentativas SET tentativas = 0, ultimo_erro = NOW() WHERE cpf = :cpf";
        $stmt0 = $pdo->prepare($sql0);
        $stmt0->bindParam(":cpf", $cpf);
        $stmt0->execute();
        $tentativas = 0; // Garante que a variável local também reflita a mudança
    }

    // Bloquear por 60 minutos se houver 5 tentativas falhas
    if ($tentativas >= 5 && ($tempoAtual - $ultimoErro) < 3600) {
        header("Location: cad_avisos.php?erro=muitas_tentativas");
        exit();
    }
	}

    // Verifica o código
    $sql2 = "SELECT * FROM radcodigo WHERE cpf = :cpf AND codigo = :codigo AND usado = 0 AND expiracao > NOW()";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(":cpf", $cpf);
    $stmt2->bindParam(":codigo", $codigo);
    $stmt2->execute();
    $result = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Código correto, marca como usado
        $sql3 = "UPDATE radcodigo SET usado = 1 WHERE cpf = :cpf";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->bindParam(":cpf", $cpf);
        $stmt3->execute();

        // Limpa tentativas erradas
        $sql4 = "DELETE FROM radtentativas WHERE cpf = :cpf";
        $stmt4 = $pdo->prepare($sql4);
        $stmt4->bindParam(":cpf", $cpf);
        $stmt4->execute();

        $_SESSION['cpf'] = $cpf;
        header("Location: redefinir_senha.php");
        exit();
    } else {
        // Registra tentativa
        if ($tentativa) {
            $sql5 = "UPDATE radtentativas SET tentativas = tentativas + 1, ultimo_erro = NOW() WHERE cpf = :cpf";
        } else {
            $sql5 = "INSERT INTO radtentativas (cpf, tentativas, ultimo_erro) VALUES (:cpf, 1, NOW())";
        }
        $stmt5 = $pdo->prepare($sql5);
        $stmt5->bindParam(":cpf", $cpf);
        $stmt5->execute();

        header("Location: cad_avisos.php?erro=codigo_invalido");
        exit();
    }
}
?>
