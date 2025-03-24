<?php
session_start();
include "includes/db_connection.php";

// Verificar se o utilizador está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Obter os dados do formulário
$user_id = $_SESSION['user']['id'];
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$endereco = $_POST['endereco'] ?? '';

// Atualizar os dados no banco de dados
$stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?");
$stmt->bind_param("ssssi", $nome, $email, $telefone, $endereco, $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Dados atualizados com sucesso!";
} else {
    echo "Erro ao atualizar os dados.";
}
?>
