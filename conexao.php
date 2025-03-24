<?php
$conn = new mysqli("localhost", "root", "", "megaloja0.1");
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
