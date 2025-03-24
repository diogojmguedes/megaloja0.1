<?php
session_start();
include "../includes/db_connection.php";

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Remover o utilizador
    $sql = "DELETE FROM administradores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: utilizadores.php");
    exit;
} else {
    echo "ID do utilizador não fornecido.";
}
?>
