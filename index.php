<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
</head>
<body>
    <!-- Cabeçalho -->
    <?php include __DIR__ . '/includes/header.php'; ?>
    
    <!-- Página Inicial -->
    <main class="container my-4">
        <div class="text-center mb-4">
            <h1 class="text-danger fw-bold">Bem-vindo à Mega Loja Borja Reis</h1>
            <p>A sua casa é o melhor lugar do mundo</p>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="text-warning">Materiais de Construção</h2>
                        <a href="catalogo.html" class="btn btn-danger">Ver Produtos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="text-warning">Mobiliário</h2>
                        <a href="catalogo.html" class="btn btn-danger">Ver Produtos</a>
                    </div>
                </div>
            </div>
        </div>
        <main class="container my-4">
    <div id="banner-carousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="imagens\maxresdefault.jpg" class="d-block w-100" alt="Promoção 1">
            </div>
            <div class="carousel-item">
                <img src="imagens\einhell-startpage-hero-campaign-sealed-battery-of-einhell-desktop.jpg" class="d-block w-100" alt="Promoção 2">
            </div>
            <div class="carousel-item">
                <img src="imagens\stanley_logo.jpg" class="d-block w-100" alt="Promoção 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <section class="container my-4">
        <h2 class="text-center text-primary">Produtos em Destaque</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="imagens\1730975621_1adaca10e674c8eda376ed680fd631b5.jpg" class="card-img-top" alt="Produto 1">
                    <div class="card-body text-center">
                        <h5 class="card-title">Produto 1</h5>
                        <p class="card-text text-danger">€186,90</p>
                        <a href="#" class="btn btn-warning">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="imagens\kwb-jogo-de-brocas-e-bits-powerbox-41-pcs.jpg" class="card-img-top" alt="Produto 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Produto 2</h5>
                        <p class="card-text text-danger">€23,99</p>
                        <a href="#" class="btn btn-warning">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="imagens\1600132201_fbda12435f2b370ae9ec532b9fb5f0aa.jpg" class="card-img-top" alt="Produto 3">
                    <div class="card-body text-center">
                        <h5 class="card-title">Produto 3</h5>
                        <p class="card-text text-danger">€21,90/m2</p>
                        <a href="#" class="btn btn-warning">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="imagens\Sanita-MUNIQUE-Saida-Vertical-SANITANA.jpg" class="card-img-top" alt="Produto 4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text text-danger">€64,55</p>
                        <a href="#" class="btn btn-warning">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="container my-4 text-center">
        <a href="catalogo.php" class="btn btn-primary btn-lg">Ver Todos os Produtos</a>
    </section>
</main>


    
    <!-- Rodapé -->
    <?php include __DIR__ . '/includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var carousel = document.getElementById('banner-carousel');
    carousel.addEventListener('mouseover', function () {
        var carouselInstance = bootstrap.Carousel.getInstance(carousel);
        carouselInstance.pause();
    });
    carousel.addEventListener('mouseleave', function () {
        var carouselInstance = bootstrap.Carousel.getInstance(carousel);
        carouselInstance.cycle();
    });
</script>
</body>
</html>
