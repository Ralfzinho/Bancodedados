<?php
include '_conexao.php';

$mensagem = '';
$erro = false;

// CREATE – Inserir transação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar_transacao'])) {
    $id_cartao = $_POST['id_cartao'];
    $data = $_POST['data_transacao'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];

    $stmt = $conn->prepare("INSERT INTO Transacao (id_cartao, data_transacao, valor, descricao, tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdss", $id_cartao, $data, $valor, $descricao, $tipo);

    if ($stmt->execute()) {
        $mensagem = "✅ Transação cadastrada com sucesso!";
    } else {
        $mensagem = "❌ Erro ao cadastrar: " . $stmt->error;
        $erro = true;
    }

    $stmt->close();
}

// READ – Listar transações
$result = $conn->query("SELECT * FROM Transacao ORDER BY data_transacao DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Transações</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

  <h2 class="text-primary mb-4">📒 Lista de Transações</h2>

  <?php if (!empty($mensagem)): ?>
    <div class="alert <?= $erro ? 'alert-danger' : 'alert-success' ?>">
      <?= $mensagem ?>
    </div>
  <?php endif; ?>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Cartão</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Tipo</th>
        <th>Descrição</th>
        <th class="text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id_transacao'] ?></td>
          <td><?= $row['id_cartao'] ?></td>
          <td><?= $row['data_transacao'] ?></td>
          <td>R$ <?= number_format($row['valor'], 2, ',', '.') ?></td>
          <td><?= $row['tipo'] ?></td>
          <td><?= htmlspecialchars($row['descricao']) ?></td>
          <td class="text-center">
            <a href="transacaoEdit.php?id=<?= $row['id_transacao'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="transacaoDelete.php?id=<?= $row['id_transacao'] ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Deseja excluir esta transação?');">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="transacaoForm.html" class="btn btn-success">+ Nova Transação</a>
  <a href="index.html" class="btn btn-secondary ms-2">Voltar ao Menu</a>

</div>
</body>
</html>

<?php $conn->close(); ?>
