<?php
include("_conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero_cartao'];
    $validade = $_POST['validade'];
    $codigo = $_POST['codigo_seguranca'];
    $tipo = $_POST['tipo'];

    // Usando prepared statement para segurança
    $stmt = $conn->prepare("INSERT INTO Cartao (numero_cartao, validade, codigo_seguranca, tipo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $numero, $validade, $codigo, $tipo);

    $success = $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Cartão</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    <?php if (isset($success) && $success): ?>
      <div class="alert alert-success">
        ✅ Cartão cadastrado com sucesso!
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        ❌ Erro ao cadastrar cartão: <?php echo isset($stmt) ? $stmt->error : "Dados não enviados corretamente."; ?>
      </div>
    <?php endif; ?>

    <a href="cartaoForm.html" class="btn btn-primary">⬅ Voltar ao cadastro</a>
    <a href="cartaoList.php" class="btn btn-secondary ms-2">📋 Ver lista de cartões</a>

  </div>
</body>
</html>
