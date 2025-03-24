<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="header-custom p-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logotipo -->
        <a href="index.php" class="header-logo">
            <img src="imagens/logotipo.jpg" alt="Logotipo da Mega Loja Borja Reis" class="header-logo-img">
        </a>

        <!-- Barra de Pesquisa -->
        <form action="catalogo.php" method="GET" class="search-form d-none d-md-flex">
            <input type="text" name="q" class="search-input form-control me-2" placeholder="O que procura?" required>
            <button type="submit" class="search-btn btn btn-light">🔍</button>
        </form>

        <!-- Menu Navegação -->
        <nav class="nav-menu d-flex align-items-center gap-3 d-none d-lg-flex" aria-label="Menu de Navegação">
            <a href="catalogo.php" class="nav-link text-light fw-bold nav-item <?= $current_page == 'catalogo.php' ? 'active' : ''; ?>">
                <i class="fas fa-th-large"></i> Catálogo
            </a>
            <a href="sobre.php" class="nav-link text-light fw-bold nav-item <?= $current_page == 'sobre.php' ? 'active' : ''; ?>">
                <i class="fas fa-info-circle"></i> Sobre Nós
            </a>
            <a href="contato.php" class="nav-link text-light fw-bold nav-item <?= $current_page == 'contato.php' ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i> Contactos
            </a>

            <!-- Menu Dinâmico para Login -->
            <?php if (isset($_SESSION["user"])): ?>
                <a href="conta.php" class="btn btn-light text-dark px-3 account-btn">
                    <i class="fas fa-user"></i> Minha Conta
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-light text-dark px-3 login-btn <?= $current_page == 'login.php' ? 'active' : ''; ?>">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            <?php endif; ?>
        </nav>

        <!-- Menu Hambúrguer para Mobile -->
        <button class="navbar-toggler d-lg-none mobile-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</header>

<!-- Menu Offcanvas para Mobile -->
<div class="offcanvas offcanvas-end mobile-menu" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header mobile-menu-header">
        <h5 class="offcanvas-title mobile-menu-title">Menu</h5>
        <button type="button" class="btn-close mobile-menu-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body mobile-menu-body">
        <a href="catalogo.php" class="nav-link text-dark mobile-menu-item">📦 Catálogo</a>
        <a href="sobre.php" class="nav-link text-dark mobile-menu-item">ℹ️ Sobre Nós</a>
        <a href="contato.php" class="nav-link text-dark mobile-menu-item">📩 Contactos</a>

        <?php if (isset($_SESSION["user"])): ?>
            <a href="conta.php" class="btn btn-primary w-100 mt-3 mobile-account-btn">👤 Minha Conta</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-secondary w-100 mt-3 mobile-login-btn">🔑 Login</a>
        <?php endif; ?>
    </div>
</div>
