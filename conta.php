<?php
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
exit();
echo session_save_path(); // Mostra onde as sessões estão a ser guardadas
include "includes/db_connection.php";

// Verificar se o utilizador está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: conta.php'); // Redirecionar para a página de login se não estiver autenticado
    exit();
}

// Obter o ID do utilizador logado
$user_id = $_SESSION['user']['id'];

// Consultar os dados do utilizador
$stmt = $conn->prepare("SELECT nome, email, endereco FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Erro ao recuperar os dados do utilizador.";
    exit();
}

?>

<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<main class="container my-4">
    <h1 class="text-center text-primary fw-bold">Minha Conta</h1>

    <section>
        <h2 class="text-warning">Informações de Conta</h2>
        <form action="atualizar_conta.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($user['endereco']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Conta</button>
        </form>
    </section>

    <section class="mt-4">
        <h2 class="text-warning">Alterar Senha</h2>
        <form action="alterar_senha.php" method="POST">
            <div class="mb-3">
                <label for="senha_atual" class="form-label">Senha Atual</label>
                <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
            </div>
            <div class="mb-3">
                <label for="nova_senha" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_senha" class="form-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <button type="submit" class="btn btn-danger">Alterar Senha</button>
        </form>
    </section>
</main>

<?php include "includes/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async></script>

</body>
</html>
