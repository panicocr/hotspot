<?php
$errorCode = isset($_GET['erro']) ? $_GET['erro'] : 'desconhecido';

$mensagemErro = [
	"cpf_existente" => "O CPF informado já está cadastrado. Utilize outro CPF ou faça login.",
	"cpf_email_block" => "CPF ou E-mail não encontrados, ou a conta pode estar bloqueada.",
	"email_existente" => "O e-mail informado já está cadastrado. Utilize outro endereço ou faça login.",
	"dados_invalidos" => "Os dados inseridos não são válidos. Verifique as informações e tente novamente.",
	"desconhecido" => "Ocorreu um erro inesperado. Tente novamente mais tarde.",
	"cadastro_ok" => "Cadastro realizado com sucesso! Agora você pode fazer login no sistema.",
	"erro_cadastro" => "Erro ao realizar o cadastro. Por favor, tente novamente.",
	"codigo_ok" => "Código de redefinição enviado com sucesso! O Código é válido por 15 minutos. Verifique seu e-mail e siga as instruções.",
	"codigo_ainda_ativo" => "Já existe um código ativo para sua conta. Verifique seu e-mail.",
	"codigo_erro_envio_email" => "Erro ao enviar o e-mail de redefinição. Tente novamente mais tarde. [Erro A01]",
	"codigo_erro_cadastro" => "Erro ao gerar o código de redefinição. Tente novamente.",
	"codigo_condicao" => "Não foi possível gerar um novo código. Verifique seus dados e tente novamente.",
	"codigo_invalido" => "Código inválido ou expirado.",
	"senha_alterada" => "Senha redefinida com sucesso! Agora você pode fazer login.",
	"erro_senha" => "Erro ao redefinir a senha. Tente novamente mais tarde.",
	"muitas_tentativas" => "Foram detectadas tentativas inválidas de utilização do Código. Seu acesso foi bloqueado por 60 minutos. Tente novamente mais tarde",
	"invalida" => "Requisição inválida. Verifique as informações e tente novamente."
];

$mensagem = isset($mensagemErro[$errorCode]) ? $mensagemErro[$errorCode] : $mensagemErro["desconhecido"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEU TITULO</title>
    <link href="captiveportal-bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SUA MARCA OU TITULO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="form-container">
    <h2>Aviso</h2>
    <p><strong><?php echo htmlspecialchars($mensagem); ?></strong></p>
    <a href="javascript: history.go(-1)" class="btn btn-secondary w-100 mt-2">Voltar</a>
	<a href="https://suaurldohotspot:8003/index.php?zone=nomezonacaptiveportal" class="btn btn-secondary w-100 mt-2">Login</a>
</div>

<script src="captiveportal-bootstrap.bundle.min.js"></script>
</body>
</html>
