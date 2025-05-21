<?php
include '_conexao.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-warning'>ID do cliente não especificado.</div>";
    exit;
}

$id = $_GET['id'];

// Busca com prepared statement
$stmt = $conn->prepare("SELECT * FROM Cliente WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>Cliente não encontrado.</div>";
    exit;
}

$cliente = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow-sm p-4">
      <h2 class="text-primary mb-4">✏️ Editar Cliente</h2>

      <form action="clienteUpdate.php" method="post">
        <input type="hidden" name="id" value="<?= $cliente['id_cliente'] ?>">

        <div class="mb-3">
          <label class="form-label"><strong>Nome:</strong></label>
          <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><strong>CPF:</strong></label>
          <input type="text" name="cpf" class="form-control" value="<?= htmlspecialchars($cliente['cpf']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label"><strong>Email:</strong></label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($cliente['email']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label"><strong>Telefone:</strong></label>
          <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($cliente['telefone']) ?>">
        </div>

        <div class="mb-3">
          <label class="form-label"><strong>Data de Nascimento:</strong></label>
          <input type="date" name="data_nascimento" class="form-control" value="<?= $cliente['data_nascimento'] ?>">
        </div>

        <div class="mb-4">
          <label class="form-label"><strong>Endereço:</strong></label>
          <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($cliente['endereco']) ?>">
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="clienteList.php" class="btn btn-secondary ms-2">Cancelar</a>
      </form>
    </div>
  </div>
</body>
</html>
