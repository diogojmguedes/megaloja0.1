<?php
include "../includes/db_connection.php"; // Garante que o ficheiro tem a conexão correta

$nome = "Admin";
$email = "admin@email.com";
$senha = password_hash("admin123", PASSWORD_BCRYPT); // Criptografa a senha

$stmt = $conn->prepare("INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Administrador criado com sucesso!";
} else {
    echo "Erro ao criar administrador.";
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

    <?php include('sidebar.php'); ?> <!-- Incluindo a sidebar -->

    <!-- Conteúdo Principal -->
    <div class="content">
        <h1>Criar Administrador</h1>
        <form action="criar_admin_action.php" method="POST">
            <!-- Formulário de criação de administrador -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>