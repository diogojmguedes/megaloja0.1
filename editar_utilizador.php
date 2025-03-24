<?php
session_start();
include "../includes/db_connection.php";

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php"); // Redirecionar para o login se não estiver autenticado como admin
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o utilizador a ser editado
    $sql = "SELECT * FROM administradores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $utilizador = $result->fetch_assoc();
}

// Atualizar os dados do utilizador
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nivel = $_POST['nivel'];

    // Atualizar no banco de dados
    $sql = "UPDATE administradores SET nome = ?, email = ?, nivel = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $nivel, $id);
    $stmt->execute();

    header("Location: utilizadores.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Utilizador</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- O caminho do CSS da sidebar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php include_once "sidebar.php"; ?>

<main class="content">
    <h1>Editar Utilizador</h1>
    <form method="POST" action="editar_utilizador.php?id=<?= $utilizador['id']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($utilizador['nome']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($utilizador['email']); ?>" required>

        <label for="nivel">Nível:</label>
        <select name="nivel">
            <option value="admin" <?= ($utilizador['nivel'] === 'admin') ? 'selected' : ''; ?>>Administrador</option>
            <option value="gerente" <?= ($utilizador['nivel'] === 'gerente') ? 'selected' : ''; ?>>Gerente</option>
            <option value="colaborador" <?= ($utilizador['nivel'] === 'colaborador') ? 'selected' : ''; ?>>Colaborador</option>
        </select>

        <button type="submit">Atualizar</button>
    </form>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
