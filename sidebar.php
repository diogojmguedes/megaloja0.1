

<div class="sidebar bg-dark vh-100">
    <h3 class="text-white text-center py-3">Administração</h3>

    <!-- Dashboard -->
    <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>

    <!-- Gestão de Utilizadores -->
    <a class="text-white d-block p-3" data-bs-toggle="collapse" href="#menuUtilizadores">
        <i class="fa fa-users"></i> Utilizadores <i class="fa fa-chevron-down"></i>
    </a>
    <div class="collapse" id="menuUtilizadores">
        <a href="utilizadores.php" class="d-block text-white ps-4 py-2">Lista de Utilizadores</a>
        <a href="adicionar_utilizador.php" class="d-block text-white ps-4 py-2">Adicionar Utilizador</a>
        <a href="permissoes.php" class="d-block text-white ps-4 py-2">Definir Permissões</a>
    </div>

    <!-- Gestão de Produtos -->
    <a class="text-white d-block p-3" data-bs-toggle="collapse" href="#menuProdutos">
        <i class="fa fa-box"></i> Produtos <i class="fa fa-chevron-down"></i>
    </a>
    <div class="collapse" id="menuProdutos">
        <a href="produtos.php" class="d-block text-white ps-4 py-2">Lista de Produtos</a>
        <a href="adicionar_produto.php" class="d-block text-white ps-4 py-2">Adicionar Produto</a>
        <a href="categorias.php" class="d-block text-white ps-4 py-2">Gerir Categorias</a>
        <a href="estoque.php" class="d-block text-white ps-4 py-2">Gestão de Stock</a>
    </div>

    <!-- Gestão de Encomendas -->
    <a class="text-white d-block p-3" data-bs-toggle="collapse" href="#menuEncomendas">
        <i class="fa fa-shopping-cart"></i> Encomendas <i class="fa fa-chevron-down"></i>
    </a>
    <div class="collapse" id="menuEncomendas">
        <a href="encomendas.php" class="d-block text-white ps-4 py-2">Lista de Encomendas</a>
        <a href="encomendas_pendentes.php" class="d-block text-white ps-4 py-2">Pendentes</a>
        <a href="encomendas_enviadas.php" class="d-block text-white ps-4 py-2">Enviadas</a>
    </div>

    <!-- Gestão de Pagamentos -->
    <a class="text-white d-block p-3" data-bs-toggle="collapse" href="#menuPagamentos">
        <i class="fa fa-credit-card"></i> Pagamentos <i class="fa fa-chevron-down"></i>
    </a>
    <div class="collapse" id="menuPagamentos">
        <a href="pagamentos.php" class="d-block text-white ps-4 py-2">Todos os Pagamentos</a>
        <a href="pagamentos_pendentes.php" class="d-block text-white ps-4 py-2">Pendentes</a>
    </div>

    <!-- Definições -->
    <a class="text-white d-block p-3" data-bs-toggle="collapse" href="#menuDefinicoes">
    <i class="fa fa-cog"></i> Definições <i class="fa fa-chevron-down"></i>
</a>
<div class="collapse" id="menuDefinicoes">
    <a href="perfil.php" class="d-block text-white ps-4 py-2">Perfil</a>
    <a href="configuracoes.php" class="d-block text-white ps-4 py-2">Configurações Gerais</a>
    <a href="relogio_ponto.php" class="d-block text-white ps-4 py-2"><i class="fa fa-clock"></i> Relógio de Ponto</a>
</div>

    <!-- Relatórios & Estatísticas -->
    <a href="relatorios.php"><i class="fa fa-chart-line"></i> Relatórios</a>

    <!-- Logout -->
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Sair</a>
</div>

