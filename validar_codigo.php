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
            background-image: url('captiveportal-bg.jpg');
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
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .feedback {
            font-size: 0.9rem;
            color: red;
        }
        .feedback.valid {
            color: green;
        }
    </style>
    <script>
  	</script>
	<?php
	if (!isset($_GET['cpf'])) {
    header("Location: esqueci.html");
    exit();
	}
	$cpf = htmlspecialchars($_GET['cpf']);
	?>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SEU TITULO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="form-container mt-5">
    <h2>Validar Código</h2>
    <form method="post" action="verificar_codigo.php">
        <!-- Campo Código -->
        <div class="mb-3">
			<input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
            <label for="codigo" class="form-label">Digite o Código de Redefinição de Senha</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" required>
        </div>

        <!-- Botão de Validação -->
        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Validar</button>
	</form>
</div>

<script src="captiveportal-bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const codigoInput = document.getElementById("codigo");
    const submitBtn = document.getElementById("submitBtn");

    // Desativa o botão inicialmente
    submitBtn.disabled = true;

    // Ativa o botão apenas quando há texto no campo
    codigoInput.addEventListener("input", function () {
        submitBtn.disabled = codigoInput.value.trim() === "";
    });
});
</script>

</body>
</html>
