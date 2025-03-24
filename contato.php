<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar os dados para evitar XSS
    $nome = htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $mensagem = htmlspecialchars($_POST['mensagem'] ?? '', ENT_QUOTES, 'UTF-8');

    // Validação simples
    if (empty($nome) || empty($email) || empty($mensagem)) {
        $erro = "Todos os campos são obrigatórios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "O email fornecido não é válido.";
    } else {
        // Enviar a mensagem por email
        $to = 'info@megaloja.com';
        $subject = 'Mensagem do Contacto do Website';
        $message = "Nome: $nome\nEmail: $email\nMensagem: $mensagem";
        $headers = "From: no-reply@megaloja.com";

        if (mail($to, $subject, $message, $headers)) {
            $sucesso = "Mensagem enviada com sucesso!";
        } else {
            $erro = "Erro ao enviar a mensagem. Tente novamente.";
        }
    }
}
?>

<?php include "includes/header.php"; ?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - Mega Loja Borja Reis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/megaloja0.1/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<main class="container my-4" id="contacto-main">
    <h1 class="text-center text-primary fw-bold" id="contacto-title">Contactos</h1>
    <p class="text-center lead" id="contacto-description">Estamos aqui para ajudá-lo! Entre em contacto connosco através dos meios abaixo.</p>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger" id="contacto-error"><?php echo $erro; ?></div>
    <?php elseif (isset($sucesso)): ?>
        <div class="alert alert-success" id="contacto-success"><?php echo $sucesso; ?></div>
    <?php endif; ?>

    <section class="row g-4" id="contacto-section">
        <!-- Informações de contacto -->
        <div class="col-md-6" id="contact-info">
            <h2 class="text-warning" id="contact-info-title">Informações de Contacto</h2>
            <ul class="list-unstyled" id="contact-info-list">
                <li><strong>Endereço:</strong> <p id="contact-address">Zona Industrial de Angra do Heroísmo, Lote 4 Dir</p> <p id="contact-postal">9700-135 Angra do Heroísmo</p></li>
                <li><strong>Telefone:</strong> <p id="contact-phone">+351 295 628 792</p></li>
                <li><strong>Email:</strong> <a href="mailto:megaloja@borjareis.com" id="contact-email">megaloja@borjareis.com</a></li>
                <li><strong>Horário:</strong><p id="contact-hours">🗓 Segunda a Sábado: 08:30 - 19:00</p>
                <p>🗓 Domingos e Feriados: 14:00 - 19:00</p></li>
            </ul>
        </div>

        <!-- Formulário de Contacto -->
        <div class="col-md-6" id="contact-form-container">
            <h2 class="text-warning" id="contact-form-title">Envie-nos uma Mensagem</h2>
            <form action="enviar_mensagem.php" method="POST" id="contact-form">
                <div class="mb-3" id="form-nome">
                    <label for="nome" class="form-label" id="nome-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required value="<?= isset($nome) ? htmlspecialchars($nome) : '' ?>" id="nome-input">
                </div>
                <div class="mb-3" id="form-email">
                    <label for="email" class="form-label" id="email-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" id="email-input">
                </div>
                <div class="mb-3" id="form-mensagem">
                    <label for="mensagem" class="form-label" id="mensagem-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required id="mensagem-textarea"><?= isset($mensagem) ? htmlspecialchars($mensagem) : '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="submit-btn">Enviar Mensagem</button>
            </form>
        </div>
    </section>
</main>

<?php include "includes/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async></script>

</body>
</html>
