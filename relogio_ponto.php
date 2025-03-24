<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar autenticação
if (!isset($_SESSION['admin']) || empty($_SESSION['admin']['id'])) {
    header("Location: login.php");
    exit();
}

$admin = $_SESSION['admin'];
$user_id = intval($admin['id']); // Garantir que é um número

include "../includes/db_connection.php";

// Data de hoje formatada
$data_hoje = date("Y-m-d");

// Verificar se já existe um ponto aberto (entrada sem saída)
$sql = "SELECT id FROM registos_ponto WHERE utilizador_id = ? AND DATE(entrada) = ? AND saida IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $data_hoje);
$stmt->execute();
$result = $stmt->get_result();
$ponto_aberto = $result->fetch_assoc();

// Calcular total de horas trabalhadas no mês
$sql = "SELECT TIME_FORMAT(SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, entrada, COALESCE(saida, NOW())))), '%H:%i:%s') AS total_horas 
        FROM registos_ponto 
        WHERE utilizador_id = ? AND MONTH(entrada) = MONTH(NOW()) AND YEAR(entrada) = YEAR(NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total_horas = $result->fetch_assoc()['total_horas'] ?? "00:00:00";

// Processar pedido de entrada/saída
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$ponto_aberto) {
        $sql = "INSERT INTO registos_ponto (utilizador_id, entrada) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
    } else {
        $sql = "UPDATE registos_ponto SET saida = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ponto_aberto['id']);
    }

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Ponto atualizado com sucesso!";
    } else {
        $_SESSION['msg'] = "Erro ao atualizar o ponto.";
        error_log("Erro no registo de ponto: " . $stmt->error, 3, "error_log.txt");
    }

    header("Location: relogio_ponto.php");
    exit();
}

// Filtrar histórico por data
$filtro_data = $_GET['filtro_data'] ?? '';
$sql = "SELECT DATE(entrada) AS data, entrada, saida, TIMESTAMPDIFF(SECOND, entrada, COALESCE(saida, NOW())) AS duracao 
        FROM registos_ponto WHERE utilizador_id = ?";
if (!empty($filtro_data)) {
    $sql .= " AND DATE(entrada) = ?";
}
$sql .= " ORDER BY entrada DESC";
$stmt = $conn->prepare($sql);
if (!empty($filtro_data)) {
    $stmt->bind_param("is", $user_id, $filtro_data);
} else {
    $stmt->bind_param("i", $user_id);
}
$stmt->execute();
$result = $stmt->get_result();
$historico = $result->fetch_all(MYSQLI_ASSOC);

// Agrupar registos por dia
$historico_agrupado = [];
foreach ($historico as $registo) {
    $historico_agrupado[$registo['data']][] = $registo;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relógio de Ponto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar.php'); ?>

    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h5 class="mb-3">Relógio de Ponto</h5>

            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-info"><?= htmlspecialchars($_SESSION['msg']); unset($_SESSION['msg']); ?></div>
            <?php endif; ?>

            <p><strong>Horas Trabalhadas no Mês:</strong> <?= htmlspecialchars($total_horas) ?></p>

            <form method="POST">
                <?php if (!$ponto_aberto): ?>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-clock"></i> Iniciar Ponto
                    </button>
                <?php else: ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-stopwatch"></i> Terminar Ponto
                    </button>
                <?php endif; ?>
            </form>
        </div>

        <div class="card shadow-sm p-4 mt-4">
            <h5 class="mb-3">Histórico de Ponto</h5>
            <form method="GET" class="mb-3">
                <label for="filtro_data" class="form-label">Filtrar por data:</label>
                <input type="date" id="filtro_data" name="filtro_data" class="form-control" value="<?= htmlspecialchars($filtro_data) ?>">
                <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
            </form>
            
            <?php foreach ($historico_agrupado as $data => $registos): ?>
                <h6 class="mt-3">Dia: <?= htmlspecialchars($data) ?></h6>
                <ul class="list-group">
                    <?php foreach ($registos as $registo): ?>
                        <?php
                        $duracao_horas = gmdate("H:i:s", $registo['duracao']);
                        $classe_horas = ($registo['duracao'] > 28800) ? 'text-danger' : '';
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?= htmlspecialchars($registo['entrada']) ?> - <?= htmlspecialchars($registo['saida'] ?? 'Em andamento') ?></span>
                            <span class="fw-bold <?= $classe_horas ?>"><?= $duracao_horas ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>