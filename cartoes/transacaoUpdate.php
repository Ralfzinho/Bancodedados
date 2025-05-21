<?php
include '_conexao.php';

$mensagem = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id_transacao'];
    $id_cartao = $_POST['id_cartao'];
    $data = $_POST['data_transacao'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];

    // Verifica se o cartão informado existe
    $check = $conn->prepare("SELECT 1 FROM Cartao WHERE id_cartao = ?");
    $check->bind_param("i", $id_cartao);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        $mensagem = "❌ O cartão informado não existe. Verifique o ID selecionado.";
        $erro = true;
    }

    $check->close();

    // Só atualiza se o cartão for válido
    if (!$erro) {
        $sql = "UPDATE Transacao 
                SET id_cartao = ?, data_transacao = ?, valor = ?, descricao = ?, tipo = ?
                WHERE id_transacao = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdssi", $id_cartao, $data, $valor, $descricao, $tipo, $id);

        if ($stmt->execute()) {
            $mensagem = "✅ Transação atualizada com sucesso!";
        } else {
            $mensagem = "❌ Erro ao atualizar: " . $stmt->error;
            $erro = true;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Atualizar Transação</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

  <div class="alert <?= $erro ? 'alert-danger' : 'alert-success' ?>">
    <?= $mensagem ?>
  </div>

  <a href="transacao.php" class="btn btn-primary">⬅ Voltar à lista de transações</a>

</div>
</body>
</html>
