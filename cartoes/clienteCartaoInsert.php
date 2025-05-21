<?php
include("_conexao.php");

$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_cartao = $_POST['id_cartao'];
    $papel = $_POST['papel'];

    // Verifica se o vínculo já existe
    $checkSql = "SELECT 1 FROM clientecartao WHERE id_cliente = ? AND id_cartao = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ii", $id_cliente, $id_cartao);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $mensagem = "⚠️ Esse vínculo já existe.";
        $erro = true;
    } else {
        // Insere o vínculo com segurança
        $insertSql = "INSERT INTO ClienteCartao (id_cliente, id_cartao, papel) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iis", $id_cliente, $id_cartao, $papel);

        if ($insertStmt->execute()) {
            $mensagem = "✅ Vínculo inserido com sucesso!";
        } else {
            $mensagem = "❌ Erro ao inserir: " . $insertStmt->error;
            $erro = true;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Vínculo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="alert <?php echo $erro ? 'alert-warning' : 'alert-success'; ?>">
        <?php echo $mensagem; ?>
    </div>

    <a href="clienteCartaoForm.php" class="btn btn-primary">⬅ Novo Vínculo</a>
    <a href="clienteCartaoList.php" class="btn btn-secondary ms-2">📋 Ver Lista de Vínculos</a>
</div>
</body>
</html>
