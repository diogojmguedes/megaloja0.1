<?php
session_start();
include "includes/db_connection.php"; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem.";
    } else {
        // Verificar se o e-mail já está cadastrado
        $sql = "SELECT id FROM clientes WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $erro = "Este e-mail já está registado.";
        } else {
            // Criar hash da senha
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Inserir no banco de dados
            $sql = "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                header("Location: login.php?sucesso=1"); // Redireciona para login
                exit;
            } else {
                $erro = "Erro ao criar conta. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo de Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php @include_once "includes/header.php"; ?>

    <div class="container my-5">
        <h1 class="text-center text-primary fw-bold">Registo de Cliente</h1>

        <?php if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

        <form method="POST" action="registo.php" onsubmit="return validarFormulario()" class="w-50 mx-auto bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="confirmar_senha" class="form-label">Confirmar Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registar</button>
        </form>

        <p class="text-center mt-3">Já tem conta? <a href="login.php">Iniciar sessão</a></p>
    </div>

    <?php @include_once "includes/footer.php"; ?>

    <script>
        function validarFormulario() {
            var senha = document.getElementById("senha").value;
            var confirmar_senha = document.getElementById("confirmar_senha").value;

            if (senha !== confirmar_senha) {
                alert("As senhas não coincidem.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
