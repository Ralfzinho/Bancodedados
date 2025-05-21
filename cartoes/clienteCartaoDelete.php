<?php
include("_conexao.php");

$success = false;
$error = "";

if (isset($_GET['id_cliente']) && isset($_GET['id_cartao'])) {
    $id_cliente = $_GET['id_cliente'];
    $id_cartao = $_GET['id_cartao'];

    $stmt = $conn->prepare("DELETE FROM ClienteCartao WHERE id_cliente = ? AND id_cartao = ?");
    $stmt->bind_param("ii", $id_cliente, $id_cartao);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $error = $stmt->error;
    }

    $stmt->close();
} else {
    $error = "Parâmetros ausentes.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Remover Vínculo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    <?php if ($success): ?>
      <div class="alert alert-success">
        ✅ Vínculo removido com sucesso!
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        ❌ Erro ao remover vínculo: <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <a href="clienteCartaoList.php" class="btn btn-primary">⬅ Voltar para a lista de vínculos</a>
  </div>
</body>
</html>
