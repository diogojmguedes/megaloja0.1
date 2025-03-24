<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<main class="container my-4" id="main-sobre-nos">
    <h1 class="text-center text-primary fw-bold" id="titulo-sobre-nos">Sobre Nós</h1>
    <p class="text-center lead" id="descricao-sobre-nos">A Mega Loja Borja Reis está aqui para transformar o seu lar com produtos de qualidade!</p>

    <section class="row g-4" id="secao-historia">
        <div class="col-md-6" id="imagem-loja">
            <img src="imagens/exterior da loja_2.jpg" alt="Nossa Loja" class="img-fluid rounded shadow" id="imagem-nossa-loja">
        </div>
        <div class="col-md-6" id="texto-historia">
            <h2 class="text-warning" id="titulo-historia">A Nossa História</h2>
            <p id="descricao-historia">
                Fundada com o compromisso de oferecer materiais de construção, mobiliário e muito mais,
                a Mega Loja Borja Reis destaca-se pela qualidade e variedade dos seus produtos.
            </p>
            <p id="descricao-historia-continua">
                Trabalhamos diariamente para garantir os melhores preços e atendimento excepcional aos nossos clientes.
            </p>
        </div>
    </section>

    <section class="row g-4 mt-4" id="secao-missao-valores">
        <div class="col-md-6" id="secao-missao">
            <h2 class="text-warning" id="titulo-missao">A Nossa Missão</h2>
            <p id="descricao-missao">Proporcionar soluções acessíveis e inovadoras para transformar espaços com qualidade e bom gosto.</p>
        </div>
        <div class="col-md-6" id="secao-valores">
            <h2 class="text-warning" id="titulo-valores">Os Nossos Valores</h2>
            <ul id="lista-valores">
                <li id="valor-compromisso">✅ Compromisso com a qualidade</li>
                <li id="valor-atendimento">✅ Atendimento personalizado</li>
                <li id="valor-inovacao">✅ Inovação constante</li>
                <li id="valor-sustentabilidade">✅ Sustentabilidade e responsabilidade</li>
            </ul>
        </div>
    </section>
</main>

<?php include "includes/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async></script>

</body>
</html>
