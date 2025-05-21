<?php
include '_conexao.php';

$success = false;
$erro = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM Transacao WHERE id_transacao = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $erro = $stmt->error;
    }

    $stmt->close();
} else {
    $erro = "ID da transação não informado.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Transação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    <?php if ($success): ?>
      <div class="alert alert-success">
        ✅ Transação excluída com sucesso!
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        ❌ Erro ao excluir transação: <?= htmlspecialchars($erro) ?>
      </div>
    <?php endif; ?>

    <a href="transacao.php" class="btn btn-primary">⬅ Voltar à lista de transações</a>
  </div>
</body>
</html>
