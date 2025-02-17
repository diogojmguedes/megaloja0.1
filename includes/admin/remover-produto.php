<?php include "header.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/includes/db_connection.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["tipo"] != "admin") {
    header("Location: ../login.php");
    exit();
}

// Verifica se o ID do produto foi enviado
if (!isset($_GET['id'])) {
    die("Erro: Produto não encontrado.");
}

$id = $_GET['id'];

// Remover produto da base de dados
$query = "DELETE FROM produtos WHERE id=$id";
if (mysqli_query($conn, $query)) {
    echo "Produto removido com sucesso! <a href='gerenciar-produtos.php'>Voltar</a>";
} else {
    echo "Erro ao remover produto: " . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<?php include 'footer.php'; ?>
