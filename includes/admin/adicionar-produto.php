<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];

    // Processar upload de imagem
    $imagem = null;
    if (!empty($_FILES["imagem"]["name"])) {
        $target_dir = "../assets/img/";
        $imagem = basename($_FILES["imagem"]["name"]);
        $target_file = $target_dir . $imagem;
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO produtos (nome, preco, descricao, categoria, imagem) 
            VALUES ('$nome', '$preco', '$descricao', '$categoria', '$imagem')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro: " . mysqli_error($conn);
    }
}
?>

<h2>Adicionar Produto</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Preço (€):</label>
    <input type="number" step="0.01" name="preco" required>

    <label>Descrição:</label>
    <textarea name="descricao"></textarea>

    <label>Categoria:</label>
    <input type="text" name="categoria" required>

    <label>Imagem:</label>
    <input type="file" name="imagem">

    <button type="submit">Adicionar Produto</button>
</form>

<?php include 'footer.php'; ?>

