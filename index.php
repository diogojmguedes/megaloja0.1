<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id FROM administradores WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['admin'] = true;  // Define a sessão corretamente
        header("Location: index.php");
        exit;
    } else {
        echo "Email ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <!-- Link para o CSS externo -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <!-- Sidebar -->
    <?php include('sidebar.php'); ?> <!-- Incluindo a sidebar -->

    <!-- Conteúdo Principal -->
    <div class="content">
        <h1>Bem-vindo, Administrador!</h1>
        <p>Aqui pode gerir os produtos, criar administradores, etc.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>