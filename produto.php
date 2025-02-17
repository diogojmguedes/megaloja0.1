<?php
include __DIR__ . "/includes/db_connection.php";

if (!isset($_GET['id'])) {
    die("Produto não encontrado.");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM produtos WHERE id=$id");
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    die("Produto não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $produto['nome']; ?></title>
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<body>
    <h1><?= $produto['nome']; ?></h1>
    <img src="assets/img/<?= $produto['imagem']; ?>" width="300">
    <p><strong>Preço:</strong> €<?= number_format($produto['preco'], 2, ',', '.'); ?></p>
    <p><strong>Categoria:</strong> <?= $produto['categoria']; ?></p>
    <p><?= $produto['descricao']; ?></p>
    <a href="index.php">Voltar</a>
</body>
</html>
