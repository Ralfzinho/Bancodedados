<?php
include '_conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cartao = $_POST['id_cartao'];
    $numero = $_POST['numero_cartao'];
    $validade = $_POST['validade'];
    $codigo = $_POST['codigo_seguranca'];
    $tipo = $_POST['tipo'];

    // Atualização com prepared statement (seguro)
    $sql = "UPDATE Cartao 
            SET numero_cartao = ?, validade = ?, codigo_seguranca = ?, tipo = ?
            WHERE id_cartao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $numero, $validade, $codigo, $tipo, $id_cartao);
    $success = $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualização de Cartão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    <?php if (isset($success) && $success): ?>
      <div class="alert alert-success">
        ✅ Cartão atualizado com sucesso!
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        ❌ Erro ao atualizar cartão: <?php echo isset($stmt) ? $stmt->error : "Dados não enviados corretamente."; ?>
      </div>
    <?php endif; ?>

    <a href="cartaoList.php" class="btn btn-primary">⬅ Voltar à lista de cartões</a>
  </div>
</body>
</html>
