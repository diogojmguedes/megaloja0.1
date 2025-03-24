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
$senha_atual = $_POST['senha_atual'] ?? '';
$nova_senha = $_POST['nova_senha'] ?? '';
$confirmar_senha = $_POST['confirmar_senha'] ?? '';

// Validar se as senhas coincidem
if ($nova_senha !== $confirmar_senha) {
    echo "As senhas não coincidem.";
    exit();
}

// Verificar se a senha atual está correta
$stmt = $conn->prepare("SELECT senha FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (password_verify($senha_atual, $user['senha'])) {
    // Atualizar a senha
    $nova_senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
    $stmt->bind_param("si", $nova_senha_hash, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Senha alterada com sucesso!";
    } else {
        echo "Erro ao alterar a senha.";
    }
} else {
    echo "Senha atual incorreta.";
}
?>
