<?php
include '_conexao.php';

$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $endereco = $_POST['endereco'];

    // Prepared statement para segurança
    $stmt = $conn->prepare("INSERT INTO Cliente (nome, cpf, email, telefone, data_nascimento, endereco) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nome, $cpf, $email, $telefone, $data_nascimento, $endereco);

    if ($stmt->execute()) {
        $mensagem = "✅ Cliente cadastrado com sucesso!";
    } else {
        $mensagem = "❌ Erro ao cadastrar cliente: " . $stmt->error;
        $erro = true;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="alert <?php echo $erro ? 'alert-danger' : 'alert-success'; ?>">
      <?php echo $mensagem; ?>
    </div>

    <a href="clienteForm.html" class="btn btn-primary">⬅ Novo Cadastro</a>
    <a href="clienteList.php" class="btn btn-secondary ms-2">📋 Ver Lista de Clientes</a>
  </div>
</body>
</html>
