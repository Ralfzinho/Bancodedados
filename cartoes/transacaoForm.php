<?php
include('_conexao.php');

// Consulta cartões com nome do titular
$sql = "
  SELECT ct.id_cartao, ct.numero_cartao, cl.nome
  FROM Cartao ct
  INNER JOIN ClienteCartao cc ON ct.id_cartao = cc.id_cartao
  INNER JOIN Cliente cl ON cc.id_cliente = cl.id_cliente
  WHERE cc.papel = 'Titular'
  ORDER BY cl.nome
";

$cartoes = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Transação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card shadow-sm p-4">
    <h2 class="text-primary mb-4">💳 Cadastro de Transação</h2>

    <form action="transacao.php" method="post">
      <input type="hidden" name="cadastrar_transacao" value="1">

      <div class="mb-3">
        <label class="form-label"><strong>Cartão (Titular):</strong></label>
        <select name="id_cartao" class="form-select" required>
          <option value="">-- Selecione um cartão --</option>
          <?php if ($cartoes && mysqli_num_rows($cartoes) > 0): ?>
            <?php while ($c = mysqli_fetch_assoc($cartoes)) {
              $id = $c['id_cartao'];
              $numero = trim($c['numero_cartao']) ?: "Sem número";
              $nome = trim($c['nome']) ?: "Sem titular";
              ?>
              <option value="<?= $id ?>"><?= htmlspecialchars($numero) ?> – <?= htmlspecialchars($nome) ?></option>
            <?php } ?>
          <?php else: ?>
            <option disabled>⚠️ Nenhum cartão com titular encontrado</option>
          <?php endif; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Data da Transação:</strong></label>
        <input type="datetime-local" name="data_transacao" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Valor:</strong></label>
        <input type="number" step="0.01" name="valor" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label"><strong>Descrição:</strong></label>
        <input type="text" name="descricao" class="form-control">
      </div>

      <div class="mb-4">
        <label class="form-label"><strong>Tipo:</strong></label>
        <select name="tipo" class="form-select" required>
          <option value="">-- Selecione --</option>
          <option value="Débito">Débito</option>
          <option value="Crédito">Crédito</option>
          <option value="Estorno">Estorno</option>
        </select>
      </div>

      <button type="reset" class="btn btn-outline-secondary">Limpar</button>
      <button type="submit" class="btn btn-primary ms-2">Cadastrar</button>
      <a href="transacao.php" class="btn btn-secondary ms-2">Ver Transações</a>
    </form>
  </div>
</div>
</body>
</html>
