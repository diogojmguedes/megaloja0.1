<?php
session_start();
include "../includes/db_connection.php"; // Conexão com o banco de dados

// Verificar se o utilizador está autenticado e tem permissão de admin
if (!isset($_SESSION['admin']) || $_SESSION['admin']['nivel'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Obter categorias e marcas do banco de dados
$categorias = $conn->query("SELECT id, nome FROM categorias")->fetch_all(MYSQLI_ASSOC);
$marcas = $conn->query("SELECT id, nome FROM marcas")->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = filter_var($_POST['preco'], FILTER_VALIDATE_FLOAT);
    $quantidade = filter_var($_POST['quantidade'], FILTER_VALIDATE_INT);
    $categoria_id = filter_var($_POST['categoria'], FILTER_VALIDATE_INT);
    $desconto = isset($_POST['desconto']) ? filter_var($_POST['desconto'], FILTER_VALIDATE_FLOAT) : 0;
    
    if ($preco === false || $quantidade === false || $categoria_id === false || $desconto === false) {
        die("Dados inválidos fornecidos.");
    }

    // Verificar se uma nova marca foi adicionada
    if (!empty($_POST['nova_marca']) && trim($_POST['nova_marca']) !== '') {
        $nova_marca = trim($_POST['nova_marca']);

        // Verificar se a marca já existe
        $stmt = $conn->prepare("SELECT id FROM marcas WHERE nome = ?");
        $stmt->bind_param("s", $nova_marca);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $marca_id = $row['id'];
        } else {
            $stmt = $conn->prepare("INSERT INTO marcas (nome) VALUES (?)");
            $stmt->bind_param("s", $nova_marca);
            $stmt->execute();
            $marca_id = $stmt->insert_id;
        }
    } else {
        $marca_id = filter_var($_POST['marca'], FILTER_VALIDATE_INT);
    }

    $preco_promo = $preco - ($preco * ($desconto / 100));

    // Inserir produto sem imagem principal (será atualizado depois)
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, preco_promocao, quantidade, categoria_id, marca_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddiii", $nome, $descricao, $preco, $preco_promo, $quantidade, $categoria_id, $marca_id);
    
    if ($stmt->execute()) {
        $produto_id = $stmt->insert_id;
        $imagem_principal = null;
        $permitidos = ['jpg', 'jpeg', 'png', 'webp'];
        $diretorio = "../uploads/";

        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['tmp_name'])) {
            foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['imagens']['error'][$key] == 0) {
                    $extensao = strtolower(pathinfo($_FILES['imagens']['name'][$key], PATHINFO_EXTENSION));

                    if (in_array($extensao, $permitidos) && $_FILES['imagens']['size'][$key] <= 2000000) {
                        $nome_arquivo = uniqid('', true) . "." . $extensao;
                        $caminho_destino = $diretorio . $nome_arquivo;

                        if (move_uploaded_file($tmp_name, $caminho_destino)) {
                            if ($imagem_principal === null) {
                                $imagem_principal = $nome_arquivo;
                                $update_stmt = $conn->prepare("UPDATE produtos SET imagem = ? WHERE id = ?");
                                $update_stmt->bind_param("si", $imagem_principal, $produto_id);
                                $update_stmt->execute();
                            }

                            $stmt_img = $conn->prepare("INSERT INTO imagens_produto (produto_id, imagem) VALUES (?, ?)");
                            $stmt_img->bind_param("is", $produto_id, $nome_arquivo);
                            $stmt_img->execute();
                        }
                    }
                }
            }
        }

        header("Location: produtos.php");
        exit;
    } else {
        die("Erro ao adicionar o produto: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="content container mt-4">
        <h1>Adicionar Novo Produto</h1>
        <form method="POST" action="adicionar_produto.php" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required class="form-control">
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required class="form-control"></textarea>
            
            <label for="preco">Preço (€):</label>
            <input type="number" id="preco" name="preco" step="0.01" required class="form-control">
            
            <label for="desconto">Desconto (%):</label>
            <input type="number" id="desconto" name="desconto" step="1" value="0" required class="form-control">
            
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required class="form-control">
            
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required class="form-control">
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="marca">Marca:</label>
            <select id="marca" name="marca" class="form-control">
                <option value="">Selecione uma marca</option>
                <?php foreach ($marcas as $marca) : ?>
                    <option value="<?= $marca['id'] ?>"><?= $marca['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="nova_marca">Ou adicionar nova marca:</label>
            <input type="text" id="nova_marca" name="nova_marca" class="form-control">
            
            <label for="imagens">Imagens:</label>
            <input type="file" id="imagens" name="imagens[]" multiple class="form-control">
            
            <button type="submit" class="btn btn-primary mt-3">Adicionar Produto</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>