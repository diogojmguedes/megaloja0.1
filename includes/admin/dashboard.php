<?php include "header.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/includes/db_connection.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["tipo"] != "admin") {
    header("Location: ../login.php");
    exit();
}

// Contar utilizadores
$result_users = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$total_users = mysqli_fetch_assoc($result_users)["total"];

// Contar produtos
$result_produtos = mysqli_query($conn, "SELECT COUNT(*) as total FROM produtos");
$total_produtos = mysqli_fetch_assoc($result_produtos)["total"];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<body>
    <h1>Painel de Administração</h1>
    <p>Bem-vindo, <?= $_SESSION["user"]["nome"]; ?>!</p>

    <div class="dashboard">
        <div class="card">
            <h2>Utilizadores</h2>
            <p><?= $total_users; ?> registados</p>
        </div>
        <div class="card">
            <h2>Produtos</h2>
            <p><?= $total_produtos; ?> disponíveis</p>
        </div>
    </div>

    <a href="gerenciar-produtos.php">Gerir Produtos</a> |
    <a href="gerenciar-utilizadores.php">Gerir Utilizadores</a> |
    <a href="../logout.php">Sair</a>

</body>
</html>

<?php include 'footer.php'; ?>
