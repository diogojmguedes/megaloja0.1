<?php
session_start();
include "includes/db_connection.php";

// Verifica se há erro na conexão
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Obtém a categoria da URL (se existir)
$categoria = $_GET['categoria'] ?? '';

// Sanitiza o valor da categoria para evitar possíveis problemas de segurança
$categoria = htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8');

// Consulta SQL para buscar produtos com base na categoria
if (!empty($categoria)) {
    $stmt = $conn->prepare("SELECT id, nome, imagem, preco FROM produtos WHERE categoria = ?");
    $stmt->bind_param("s", $categoria);
} else {
    $stmt = $conn->prepare("SELECT id, nome, imagem, preco FROM produtos");
}

$stmt->execute();
$result = $stmt->get_result();
$produtos = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include "includes/header.php"; ?>

    <main class="container my-4" id="catalogo-container">
    <h1 class="text-center text-primary" id="catalogo-titulo">Catálogo de Produtos</h1>

    <div class="row g-4" id="produtos-row">
        <?php foreach ($produtos as $produto): ?>
            <div class="col-md-3" id="produto-<?= htmlspecialchars($produto['id']); ?>">
                <a href="produto.php?id=<?= urlencode($produto['id']); ?>" class="text-decoration-none" aria-label="Ver detalhes de <?= htmlspecialchars($produto['nome']); ?>" id="produto-link-<?= htmlspecialchars($produto['id']); ?>">
                    <div class="card shadow-sm catalogo-card" id="card-produto-<?= htmlspecialchars($produto['id']); ?>">
                        <img src="uploads/<?= htmlspecialchars($produto['imagem'] ?: 'default.jpg'); ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($produto['nome'] ?: 'Produto sem imagem'); ?>" 
                             loading="lazy" id="produto-imagem-<?= htmlspecialchars($produto['id']); ?>">
                        <div class="card-body text-center" id="card-body-<?= htmlspecialchars($produto['id']); ?>">
                            <h5 class="card-title" id="produto-nome-<?= htmlspecialchars($produto['id']); ?>"><?= htmlspecialchars($produto['nome']); ?></h5>
                            <p class="card-text text-danger fw-bold" id="produto-preco-<?= htmlspecialchars($produto['id']); ?>"><?= '€' . number_format($produto['preco'], 2, ',', '.'); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>


    <?php include "includes/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async></script>
</body>
</html>
