<?php include 'header.php'; ?>

<h2>Gerenciar Produtos</h2>
<a href="adicionar-produto.php" class="btn btn-success mb-3">+ Adicionar Produto</a>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM produtos");
        while ($produto = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $produto['id']; ?></td>
            <td><?= $produto['nome']; ?></td>
            <td>€<?= number_format($produto['preco'], 2, ',', '.'); ?></td>
            <td>
                <?php if ($produto['imagem']) { ?>
                    <img src="../assets/img/<?= $produto['imagem']; ?>" width="50">
                <?php } else { ?>
                    <span>Sem imagem</span>
                <?php } ?>
            </td>
            <td>
                <a href="editar-produto.php?id=<?= $produto['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="remover-produto.php?id=<?= $produto['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?');">Remover</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<?php include 'footer.php'; ?>

