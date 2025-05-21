<?php
include '_conexao.php';

// Verifica se o parâmetro correto foi recebido
if (isset($_GET['id_cartao'])) {
    $id_cartao = $_GET['id_cartao'];

    // Prepara a query para evitar SQL Injection
    $stmt = $conn->prepare("DELETE FROM Cartao WHERE id_cartao = ?");
    $stmt->bind_param("i", $id_cartao);

    if ($stmt->execute()) {
        $mensagem = "✅ Cartão excluído com sucesso!";
        $classe = "success";
    } else {
        $mensagem = "❌ Erro ao excluir cartão: " . $stmt->error;
        $classe = "danger";
    }

    $stmt->close();
} else {
    $mensagem = "⚠️ ID do cartão não especificado.";
    $classe = "warning";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Cartão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="alert alert-<?= $classe ?>">
    <?= $mensagem ?>
  </div>

  <a href="cartaoList.php" class="btn btn-primary">⬅ Voltar à lista de cartões</a>
</div>
</body>
</html>

<?php $conn->close(); ?>
