<?php
session_start();
include "../includes/db_connection.php";

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php"); // Redirecionar para o login se não estiver autenticado como admin
    exit;
}

// Consultar os administradores no banco de dados
$sql = "SELECT id, nome, email, nivel FROM administradores";
$result = $conn->query($sql);
$utilizadores = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $utilizadores[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Administradores - Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- O caminho do CSS da sidebar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php include_once "sidebar.php"; ?>

<main class="content">
    <h1>Gestão de Utilizadores</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilizadores as $utilizador): ?>
                <tr>
                    <td><?= htmlspecialchars($utilizador['id']); ?></td>
                    <td><?= htmlspecialchars($utilizador['nome']); ?></td>
                    <td><?= htmlspecialchars($utilizador['email']); ?></td>
                    <td><?= htmlspecialchars(ucfirst($utilizador['nivel'])); ?></td>
                    <td>
                        <a href="editar_utilizador.php?id=<?= $utilizador['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="remover_utilizador.php?id=<?= $utilizador['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover este utilizador?')">Remover</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
