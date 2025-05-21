<?php
include '_conexao.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning'>ID da transação não informado.</div>";
    exit;
}

$id = $_GET['id'];

// Busca segura
$stmt = $conn->prepare("SELECT * FROM Transacao WHERE id_transacao = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>Transação não encontrada.</div>";
    exit;
}

$transacao = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Editar Transação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card shadow-sm p-4">
    <h2 class="text-primary mb-4">✏️ Editar Transação</h2>

    <form action="transacaoUpdate.php" method="post">
      <input type="hidden" name="id_transacao" value="<?= $transacao['id_transacao'] ?>">

      <div class="mb-3">
        <label class="form-label"><strong>ID do Cartão:</strong></label>
        <input type="text" name="id_cartao" class="form-control" value="<?= htmlspecialchars($transacao['id_cartao']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Data da Transação:</strong></label>
        <input type="datetime-local" name="data_transacao" class="form-control" value="<?= str_replace(' ', 'T', $transacao['data_transacao']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Valor:</strong></label>
        <input type="number" step="0.01" name="valor" class="form-control" value="<?= htmlspecialchars($transacao['valor']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Descrição:</strong></label>
        <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($transacao['descricao']) ?>">
      </div>

      <div class="mb-4">
        <label class="form-label"><strong>Tipo:</strong></label>
        <select name="tipo" class="form-select" required>
          <option value="Débito" <?= $transacao['tipo'] == 'Débito' ? 'selected' : '' ?>>Débito</option>
          <option value="Crédito" <?= $transacao['tipo'] == 'Crédito' ? 'selected' : '' ?>>Crédito</option>
          <option value="Estorno" <?= $transacao['tipo'] == 'Estorno' ? 'selected' : '' ?>>Estorno</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Salvar Alterações</button>
      <a href="transacao.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
  </div>
</div>
</body>
</html>
