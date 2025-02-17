<?php
include __DIR__ . "/includes/db_connection.php";  // Conexão com a BD

if ($conn) {
    echo "Ligação à base de dados estabelecida com sucesso!";
} else {
    echo "Erro na ligação à base de dados!";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Encriptação segura

    $sql = "INSERT INTO users (nome, email, password) VALUES ('$nome', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Registo efetuado com sucesso!";
    } else {
        echo "Erro: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Palavra-passe" required>
    <button type="submit">Registar</button>
</form>
