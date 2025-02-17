<?php
$servername = "localhost";  // Se estiveres a usar XAMPP
$username = "root";         // Nome de utilizador do MySQL (por padrão é "root")
$password = "";             // Normalmente, a password é vazia no XAMPP
$dbname = "megaloja0.1";       // Nome da base de dados que criaste

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
