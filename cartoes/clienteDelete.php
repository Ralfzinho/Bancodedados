<?php
include '_conexao.php';

$success = false;
$error = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepared statement para segurança
    $stmt = $conn->prepare("DELETE FROM Cliente WHERE id_cliente = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $error = $stmt->error;
    }

    $stmt->close();
} else {
    $error = "ID do cliente não especificado.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Excluir Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    <?php if ($success): ?>
      <div class="alert alert-success">
        ✅ Cliente excluído com sucesso!
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        ❌ Erro ao excluir cliente: <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <a href="clienteList.php" class="btn btn-primary">⬅ Voltar à lista de clientes</a>
  </div>
</body>
</html>
