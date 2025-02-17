<?php 
session_start();
include __DIR__ . "/includes/db_connection.php";

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

include "includes/header.php"; // Incluindo o cabeçalho corretamente
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <!-- Caminho correto para o CSS -->
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<body class="minha-conta">
    <h1>Minha Conta</h1>
    <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION["user"]["nome"]); ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["user"]["email"]); ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>

<?php include "includes/footer.php"; ?>

