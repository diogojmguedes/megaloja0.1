<?php
$servername = "localhost"; // Ou "127.0.0.1"
$username = "root"; // Usuário padrão do XAMPP
$password = ""; // Senha padrão (vazia)
$database = "megaloja0.1"; // Nome da sua base de dados

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
