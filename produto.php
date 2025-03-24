<?php
session_start();
include "includes/db_connection.php";
require 'includes/header.php';

// Validar ID do produto recebido via GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p id='produto-invalido' class='text-center text-danger'>Produto inválido.</p>";
    exit;
}

// Guardar no histórico (máximo 10 produtos)
if (!isset($_SESSION['historico'])) {
    $_SESSION['historico'] = [];
}

// Remover duplicações e adicionar no início
$_SESSION['historico'] = array_diff($_SESSION['historico'], [$id]);
array_unshift($_SESSION['historico'], $id);
$_SESSION['historico'] = array_slice($_SESSION['historico'], 0, 10);

// Buscar informações do produto
$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    echo "<p id='produto-nao-encontrado' class='text-center text-danger'>Produto não encontrado.</p>";
    exit;
}

// Verificar se existe uma imagem para o produto
$imagemProduto = !empty($produto['imagem']) ? $produto['imagem'] : 'placeholder.jpg';

// Buscar produtos relacionados
$stmt = $conn->prepare("SELECT * FROM produtos WHERE categoria_id = ? AND id != ? ORDER BY RAND() LIMIT 4");
$stmt->bind_param("ii", $produto['categoria_id'], $id);
$stmt->execute();
$relacionados = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id='titulo-produto'><?= htmlspecialchars($produto['nome']); ?> | Mega Loja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div id='container-produto' class="container my-5">
    <div class="row">
        <!-- Galeria de Imagens -->
        <div id='galeria-imagens' class="col-md-6">
            <img id='imagem-principal' src="uploads/<?= htmlspecialchars($imagemProduto); ?>" class="d-block w-100" alt="Imagem do produto">
            <div id='miniaturas' class="mt-3 d-flex justify-content-center">
                <img src="uploads/<?= htmlspecialchars($imagemProduto); ?>" class="img-thumbnail mx-1" style="width: 60px; height: 60px; cursor: pointer;">
            </div>
            <p id='id-produto' class="text-muted">ID: <?= htmlspecialchars($produto['id']); ?></p>
            <p id='descricao-titulo' class="lead">Descrição:</p>
            <p id='descricao-produto'><?= nl2br(htmlspecialchars($produto['descricao'])); ?></p>
        </div>

        <!-- Caixa Flutuante -->
        <div id='caixa-compra' class="col-md-4">
            <div class="p-4 border rounded shadow-sm bg-light">
                <h2 id='nome-produto' class="text-primary"><?= htmlspecialchars($produto['nome']); ?></h2>
                <p id='preco-produto' class="h4 text-danger">€<?= number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p id='disponibilidade-produto' class="<?= $produto['quantidade'] > 0 ? 'text-success' : 'text-danger'; ?>">
                    <?= $produto['quantidade'] > 0 ? 'Em Stock' : 'Esgotado'; ?>
                </p>
                <button id='btn-favoritos' class="btn btn-warning w-100 my-2">Adicionar aos Favoritos</button>
                <button id='btn-comprar' class="btn btn-success w-100 my-2">Comprar Agora</button>
                <p id='pagamento-titulo' class="fw-bold mt-3">Formas de Pagamento:</p>
                <div id='metodos-pagamento' class="d-flex gap-2">
                    <i class="fab fa-cc-visa fa-2x text-primary"></i>
                    <i class="fab fa-cc-mastercard fa-2x text-danger"></i>
                    <i class="fab fa-cc-paypal fa-2x text-info"></i>
                    <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                </div>
                <p id='entrega-titulo' class="fw-bold mt-3">Entrega estimada:</p>
                <p id='entrega-detalhes'>2 a 5 dias úteis</p>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async>
document.addEventListener("DOMContentLoaded", function() {
    const caixaCompra = document.getElementById("caixa-compra");
    const galeria = document.getElementById("galeria-imagens");

    function ajustarPosicao() {
        if (!galeria || !caixaCompra) return;

        let rectGaleria = galeria.getBoundingClientRect();
        let margem = 20; // Margem entre os elementos
        let novaPosicao = rectGaleria.right + margem;

        // Garante que a caixa não ultrapassa os limites da tela
        if (novaPosicao + caixaCompra.offsetWidth > window.innerWidth) {
            novaPosicao = window.innerWidth - caixaCompra.offsetWidth - 20; // Ajusta para não sair da tela
        }

        caixaCompra.style.left = `${novaPosicao}px`;
    }

    function seguirScroll() {
        let scrollY = window.scrollY || document.documentElement.scrollTop;
        caixaCompra.style.transform = `translateY(${scrollY}px)`;
    }

    // Atualiza posição ao carregar a página e ao redimensionar a tela
    ajustarPosicao();
    window.addEventListener("resize", ajustarPosicao);
    window.addEventListener("scroll", seguirScroll);
});
</script>
</body>
</html>
