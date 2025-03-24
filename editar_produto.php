<?php
session_start();
include "../includes/db_connection.php"; // Conexão com o banco de dados
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php"); // Redireciona para o login se não for admin
    exit;
}

// Verificar se o ID do produto foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Erro: ID do produto inválido.";
    exit;
}

$id = $_GET['id'];

// Buscar os detalhes do produto
$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    echo "Erro: Produto não encontrado.";
    exit;
}

// Processar a atualização do produto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria_id = $_POST['categoria_id'];
    $desconto = $_POST['desconto'];

    // Atualizar produto no banco de dados
    $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, categoria_id = ?, desconto = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiiii", $nome, $descricao, $preco, $quantidade, $categoria_id, $desconto, $id);


    if ($stmt->execute()) {
        header("Location: produtos.php?msg=Produto atualizado com sucesso!");
        exit;
    } else {
        echo "Erro ao atualizar o produto: " . $conn->error;
    }
}

// Buscar categorias para o select
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);
$categorias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <?php include "sidebar.php"; ?>

    <div class="content">
        <h1>Editar Produto</h1>
        <form method="POST" action="editar_produto.php?id=<?= $id ?>" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']); ?>" required class="form-control">

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required class="form-control"><?= htmlspecialchars($produto['descricao']); ?></textarea>

            <label for="preco">Preço (€):</label>
            <input type="number" id="preco" name="preco" value="<?= $produto['preco']; ?>" step="0.01" required class="form-control">

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']); ?>" step="0.01" required class="form-control">

            <label for="desconto">Desconto (%):</label>
            <input type="number" id="desconto" name="desconto" value="<?= htmlspecialchars($produto['desconto']); ?>" step="0.01" required class="form-control">

            <label for="categoria_id">Categoria:</label>
            <select name="categoria_id" id="categoria_id" required class="form-control">
                <option value="">Selecione uma categoria</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id']; ?>" <?= ($produto['categoria_id'] == $categoria['id']) ? 'selected' : ''; ?>>
                        <?= $categoria['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Imagens Atuais:</label>
            <div>
                <?php 
                $imagens = !empty($produto['imagens']) ? unserialize($produto['imagens']) : [];
                if (!empty($imagens)) {
                    foreach ($imagens as $imagem): ?>
                        <img src="../uploads/<?= $imagem; ?>" width="100">
                    <?php endforeach;
                } else {
                    echo "Nenhuma imagem disponível.";
                }
                ?>
            </div>
            
            <label for="imagens">Alterar Imagens:</label>
            <input type="file" id="imagens" name="imagens[]" multiple accept="image/*">

            <button type="submit">Atualizar Produto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
