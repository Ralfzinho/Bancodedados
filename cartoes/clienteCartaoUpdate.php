<?php
include("_conexao.php");

$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_cartao = $_POST['id_cartao'];
    $papel = $_POST['papel'];

    // Atualização segura com prepared statement
    $sql = "UPDATE ClienteCartao SET papel = ? WHERE id_cliente = ? AND id_cartao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $papel, $id_cliente, $id_cartao);

    if ($stmt->execute()) {
        $mensagem = "✅ Papel atualizado com sucesso!";
    } else {
        $mensagem = "❌ Erro ao atualizar: " . $stmt->error;
        $erro = true;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Papel do Vínculo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <div class="alert <?php echo $erro ? 'alert-danger' : 'alert-success'; ?>">
        <?php echo $mensagem; ?>
    </div>

    <a href="clienteCartaoList.php" class="btn btn-primary">⬅ Voltar para a lista de vínculos</a>
</div>
</body>
</html>
