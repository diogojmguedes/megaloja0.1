<?php include 'header.php'; ?>

<h2>Gerenciar Utilizadores</h2>
<form method="GET">
    <input type="text" name="q" placeholder="Pesquisar utilizador..." class="form-control mb-3">
</form>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $q = isset($_GET['q']) ? $_GET['q'] : '';
        $sql = "SELECT * FROM users WHERE nome LIKE '%$q%' OR email LIKE '%$q%'";
        $result = mysqli_query($conn, $sql);

        while ($user = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['nome']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['tipo']; ?></td>
            <td>
                <?php if ($user['tipo'] == 'cliente') { ?>
                    <a href="promover-user.php?id=<?= $user['id']; ?>" class="btn btn-primary btn-sm">Promover</a>
                <?php } ?>
                <a href="remover-user.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?');">Remover</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>

