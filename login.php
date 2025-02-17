<?php
session_start();
include __DIR__ . "/includes/db_connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        if ($user["tipo"] == "admin") {
            header("Location: includes/admin/dashboard.php"); // Redireciona admins para o painel
        } else {
            header("Location: conta.php"); // Redireciona clientes para a área pessoal
        }
        exit();
    } else {
        echo "Email ou palavra-passe incorretos!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Palavra-passe" required>
    <button type="submit">Entrar</button>
</form>
