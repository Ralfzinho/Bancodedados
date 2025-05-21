<?php
include '_conexao.php';

$result = $conn->query("SELECT * FROM Cliente");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-primary mb-4">📋 Lista de Clientes</h2>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th class="text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id_cliente'] ?></td>
          <td><?= htmlspecialchars($row['nome']) ?></td>
          <td><?= htmlspecialchars($row['cpf']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td class="text-center">
            <a href="clienteEdit.php?id=<?= $row['id_cliente'] ?>" class="btn btn-sm btn-warning">Editar</a>
            <a href="clienteDelete.php?id=<?= $row['id_cliente'] ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Deseja realmente excluir este cliente?');">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a href="clienteForm.html" class="btn btn-success">+ Novo Cliente</a>
  <a href="index.html" class="btn btn-secondary ms-2">Voltar ao Menu</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
