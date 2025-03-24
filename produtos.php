<?php
session_start();
include "../includes/db_connection.php";

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php"); // Redirecionar para o login se não estiver autenticado como admin
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Certifique-se de que o caminho está correto -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
</head>
<body>

    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Conteúdo da página -->
    <div class="content">
        <h1>Gestão de Produtos</h1>

        <!-- Adicionar produto -->
        <a href="adicionar_produto.php" class="btn">Adicionar Novo Produto</a>

        <!-- Tabela de produtos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Buscar todos os produtos no banco de dados
                $sql = "SELECT * FROM produtos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Exibir cada produto
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>";
                        echo "<td>" . number_format($row['preco'], 2, ',', '.') . "€</td>";
                        echo "<td>
                                <a href='editar_produto.php?id=" . $row['id'] . "'>Editar</a> |
                                <a href='excluir_produto.php?id=" . $row['id'] . "'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
