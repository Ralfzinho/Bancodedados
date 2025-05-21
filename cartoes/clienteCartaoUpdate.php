<?php
include("_conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_cartao = $_POST['id_cartao'];
    $novo_papel = $_POST['papel'];

    $mensagem = "";
    $erro = false;

    // Se o novo papel for TITULAR, verificar se já existe outro titular para esse cartão
    if ($novo_papel === 'Titular') {
        $check = $conn->prepare("
            SELECT id_cliente 
            FROM ClienteCartao 
            WHERE id_cartao = ? AND papel = 'Titular' AND id_cliente != ?
        ");
        $check->bind_param("ii", $id_cartao, $id_cliente);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $mensagem = "❌ Este cartão já possui outro titular. Só pode haver um.";
            $erro = true;
        }

        $check->close();
    }

    // Se tudo certo, faz o update
    if (!$erro) {
        $sql = "UPDATE ClienteCartao SET papel = ? WHERE id_cliente = ? AND id_cartao = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $novo_papel, $id_cliente, $id_cartao);

        if ($stmt->execute()) {
            $mensagem = "✅ Papel atualizado com sucesso!";
        } else {
            $mensagem = "❌ Erro ao atualizar: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado da Atualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="alert <?php echo $erro ? 'alert-danger' : 'alert-success'; ?>">
        <?php echo $mensagem; ?>
    </div>

    <a href="clienteCartaoList.php" class="btn btn-primary">⬅ Voltar para Lista de Vínculos</a>
</div>
</body>
</html>
