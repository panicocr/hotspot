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
        function checkPasswords() {
            const senha = document.getElementById("senha").value;
            const confirmSenha = document.getElementById("confirmSenha").value;
            const feedback = document.getElementById("passwordFeedback");

            const senhaValida = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/.test(senha);

            if (!senhaValida) {
                feedback.textContent = "A senha deve ter pelo menos 8 caracteres, incluindo letras e números.";
                feedback.classList.add("invalid");
                feedback.classList.remove("valid");
            } else if (confirmSenha === "") {
                feedback.textContent = "";
            } else if (senha === confirmSenha) {
                feedback.textContent = "As senhas coincidem.";
                feedback.classList.add("valid");
                feedback.classList.remove("invalid");
            } else {
                feedback.textContent = "As senhas não coincidem.";
                feedback.classList.add("invalid");
                feedback.classList.remove("valid");
            }
        }
		
		function validarSenha(senha) {
			return /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/.test(senha);
		}

        function togglePasswordVisibility(checkboxId, inputId) {
            const input = document.getElementById(inputId);
            const checkbox = document.getElementById(checkboxId);
            input.type = checkbox.checked ? "text" : "password";
        }
  	</script>
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
    <h2>Redefinição de Senha</h2>
    <form method="post" action="atualizar_senha.php">
        <!-- Campo Nova Senha -->
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua nova senha" required minlength="8" pattern="^(?=.*[a-zA-Z])(?=.*\d).{8,}$" oninput="checkPasswords()">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="toggleSenha" onclick="togglePasswordVisibility('toggleSenha', 'senha')">
                <label class="form-check-label" for="toggleSenha">Mostrar Nova senha</label>
            </div>
        </div>

        <!-- Campo Confirmação Nova de Senha -->
        <div class="mb-3">
            <label for="confirmSenha" class="form-label">Confirme a Nova Senha</label>
            <input type="password" class="form-control" id="confirmSenha" name="confirmSenha" placeholder="Confirme sua nova senha" required oninput="checkPasswords()">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="toggleConfirmSenha" onclick="togglePasswordVisibility('toggleConfirmSenha', 'confirmSenha')">
                <label class="form-check-label" for="toggleConfirmSenha">Mostrar nova senha</label>
            </div>
            <div id="passwordFeedback" class="feedback"></div>
        </div>

        <!-- Checkbox de Aceite dos Termos -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="aceiteTermos" name="aceiteTermos" required>
            <label class="form-check-label" for="aceiteTermos">
                Aceito os <a href="seutermodeusoeprivacidade.pdf" target="_blank">termos de uso e privacidade</a>.
            </label>
        </div>

        <!-- Botão de Redifinir -->
        <button type="submit" class="btn btn-primary w-100" id="submitBtn" disabled>Redefinir</button>
		<a href="javascript: history.go(-1)" class="btn btn-secondary w-100 mt-2">Voltar</a>
	</form>
</div>

<script src="captiveportal-bootstrap.bundle.min.js"></script>
<script>
	function checkFormValidity() {
		const senha = document.getElementById("senha").value.trim();
		const confirmSenha = document.getElementById("confirmSenha").value.trim();
		const termos = document.getElementById("aceiteTermos").checked;
		const botao = document.getElementById("submitBtn");

		const senhaValida = validarSenha(senha); // Agora a senha é validada corretamente
		const senhasIguais = senha === confirmSenha;

		if (senhaValida && senhasIguais && termos) {
			botao.removeAttribute("disabled");
		} else {
			botao.setAttribute("disabled", "disabled");
		}
	}

	// Adiciona eventos para disparar a validação sempre que os campos forem alterados
	document.getElementById("senha").addEventListener("input", checkFormValidity);
	document.getElementById("confirmSenha").addEventListener("input", checkFormValidity);
	document.getElementById("aceiteTermos").addEventListener("change", checkFormValidity);
	
	// Chama a validação ao carregar a página
    window.onload = checkFormValidity;
</script>
</body>
</html>
