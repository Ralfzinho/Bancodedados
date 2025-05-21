<?php
include '_conexao.php';

$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];

    // Atualização segura com prepared statement
    $sql = "UPDATE Cliente 
            SET nome = ?, cpf = ?, email = ?, telefone = ?, data_nascimento = ?, endereco = ? 
            WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $cpf, $email, $telefone, $data_nascimento, $endereco, $id);

    if ($stmt->execute()) {
        $mensagem = "✅ Cliente atualizado com sucesso!";
    } else {
        $mensagem = "❌ Erro ao atualizar cliente: " . $stmt->error;
        $erro = true;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualizar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="alert <?php echo $erro ? 'alert-danger' : 'alert-success'; ?>">
      <?php echo $mensagem; ?>
    </div>

    <a href="clienteList.php" class="btn btn-primary">⬅ Voltar para a lista de clientes</a>
  </div>
</body>
</html>
