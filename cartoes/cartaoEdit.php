<?php
include("_conexao.php");

if (!isset($_GET['id_cartao'])) {
    echo "<div class='alert alert-warning'>⚠️ ID do cartão não especificado.</div>";
    exit;
}

$id = $_GET['id_cartao'];

$sql = "SELECT * FROM Cartao WHERE id_cartao = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>❌ Cartão não encontrado.</div>";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cartão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-primary mb-4">✏️ Editar Cartão</h2>

        <form action="cartaoUpdate.php" method="post">
            <input type="hidden" name="id_cartao" value="<?php echo $row['id_cartao']; ?>">

            <div class="mb-3">
                <label class="form-label"><strong>Número do Cartão:</strong></label>
                <input type="text" name="numero_cartao" class="form-control" value="<?php echo $row['numero_cartao']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Validade:</strong></label>
                <input type="date" name="validade" class="form-control" value="<?php echo $row['validade']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Código de Segurança:</strong></label>
                <input type="text" name="codigo_seguranca" maxlength="4" class="form-control" value="<?php echo $row['codigo_seguranca']; ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label"><strong>Tipo:</strong></label>
                <select name="tipo" class="form-select" required>
                    <option value="Titular" <?php if ($row['tipo'] == "Titular") echo "selected"; ?>>Titular</option>
                    <option value="Adicional" <?php if ($row['tipo'] == "Adicional") echo "selected"; ?>>Adicional</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="cartaoList.php" class="btn btn-secondary ms-2">Voltar</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
