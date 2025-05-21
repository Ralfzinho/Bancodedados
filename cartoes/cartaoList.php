<?php
include("_conexao.php");

$sql = "SELECT * FROM Cartao ORDER BY id_cartao";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Cartões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-primary">📋 Cartões Cadastrados</h2>

    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Número</th>
                <th>Validade</th>
                <th>Código</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id_cartao']; ?></td>
                    <td><?php echo $row['numero_cartao']; ?></td>
                    <td><?php echo $row['validade']; ?></td>
                    <td><?php echo $row['codigo_seguranca']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td>
                        <a href="cartaoEdit.php?id_cartao=<?php echo $row['id_cartao']; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="cartaoDelete.php?id_cartao=<?= $row['id_cartao'] ?>" 
                            class="btn btn-sm btn-danger" 
                                onclick="return confirm('Deseja realmente excluir o cartão <?= $row['numero_cartao'] ?>?');">
                                Excluir
                        </a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="index.html" class="btn btn-secondary mt-3">⬅ Voltar ao Menu</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
