<?php include "header.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . "/includes/db_connection.php";

if (!isset($_SESSION["user"]) || $_SESSION["user"]["tipo"] != "admin") {
    header("Location: ../login.php");
    exit();
}

// Verifica se o ID do produto foi enviado
if (!isset($_GET['id'])) {
    die("Erro: Produto não encontrado.");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM produtos WHERE id = $id");
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    die("Erro: Produto não encontrado.");
}

// Atualizar produto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];

    $query = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', categoria='$categoria' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo "Produto atualizado com sucesso! <a href='gerenciar-produtos.php'>Voltar</a>";
    } else {
        echo "Erro ao atualizar produto: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<h1>Editar Produto</h1>
<form method="POST">
    <input type="text" name="nome" value="<?= $produto['nome']; ?>" required>
    <textarea name="descricao"><?= $produto['descricao']; ?></textarea>
    <input type="number" step="0.01" name="preco" value="<?= $produto['preco']; ?>" required>
    <input type="text" name="categoria" value="<?= $produto['categoria']; ?>" required>
    <button type="submit">Atualizar Produto</button>
</form>
<?php include 'footer.php'; ?>
