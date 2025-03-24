<?php
session_start();
include "../includes/db_connection.php";

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o produto
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: produtos.php"); // Redireciona para a lista de produtos
        exit;
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
}
?>
