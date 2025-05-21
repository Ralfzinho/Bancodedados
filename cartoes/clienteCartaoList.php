<?php
include("_conexao.php");

$sql = "
    SELECT 
        cc.id_cliente,
        c.nome AS nome_cliente,
        ct.id_cartao,
        ct.numero_cartao,
        cc.papel
    FROM 
        ClienteCartao cc
    INNER JOIN Cliente c ON cc.id_cliente = c.id_cliente
    INNER JOIN Cartao ct ON cc.id_cartao = ct.id_cartao
    ORDER BY c.nome, ct.numero_cartao
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vínculos Cliente ↔ Cartão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-primary">🔗 Vínculos entre Clientes e Cartões</h2>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Cliente</th>
                <th>Cartão</th>
                <th>Papel</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($row['numero_cartao']); ?></td>
                    <td><?php echo htmlspecialchars($row['papel']); ?></td>
                    <td class="text-center">
                        <a href="clienteCartaoEdit.php?id_cliente=<?php echo $row['id_cliente']; ?>&id_cartao=<?php echo $row['id_cartao']; ?>" 
                           class="btn btn-sm btn-warning">Editar</a>

                        <a href="clienteCartaoDelete.php?id_cliente=<?php echo $row['id_cliente']; ?>&id_cartao=<?php echo $row['id_cartao']; ?>" 
                           onclick="return confirm('Deseja realmente remover este vínculo?');"
                           class="btn btn-sm btn-danger ms-2">Remover</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="clienteCartaoForm.php" class="btn btn-success">+ Novo Vínculo</a>
    <a href="index.html" class="btn btn-secondary ms-2">Voltar ao Menu</a>
</div>
</body>
</html>
