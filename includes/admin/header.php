<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/includes/db_connection.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["tipo"] != "admin") {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Caminho correto para o CSS -->
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<body class="painel-admin">
    <div class="d-flex">
        <!-- Menu lateral -->
        <nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4>Painel Admin</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
                <li class="nav-item"><a href="gerenciar-produtos.php" class="nav-link text-white">Gerir Produtos</a></li>
                <li class="nav-item"><a href="gerenciar-utilizadores.php" class="nav-link text-white">Gerir Utilizadores</a></li>
                <li class="nav-item"><a href="../logout.php" class="nav-link text-danger">Sair</a></li>
            </ul>
        </nav>
        <div class="container-fluid p-4">

