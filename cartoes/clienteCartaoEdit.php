<?php
include("_conexao.php");

if (!isset($_GET['id_cliente']) || !isset($_GET['id_cartao'])) {
    echo "<div class='alert alert-warning'>⚠️ Parâmetros ausentes.</div>";
    exit;
}

$id_cliente = $_GET['id_cliente'];
$id_cartao = $_GET['id_cartao'];

// Consulta segura usando prepared statement
$sql = "SELECT papel FROM ClienteCartao WHERE id_cliente = ? AND id_cartao = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_cliente, $id_cartao);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>❌ Vínculo não encontrado.</div>";
    exit;
}

$row = $result->fetch_assoc();
$papelAtual = $row['papel'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Papel do Vínculo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-primary mb-4">✏️ Editar Papel no Vínculo Cliente ↔ Cartão</h2>

        <form action="clienteCartaoUpdate.php" method="post">
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <input type="hidden" name="id_cartao" value="<?php echo $id_cartao; ?>">

            <div class="mb-3">
                <label class="form-label"><strong>ID Cliente:</strong></label>
                <input type="text" class="form-control" value="<?php echo $id_cliente; ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>ID Cartão:</strong></label>
                <input type="text" class="form-control" value="<?php echo $id_cartao; ?>" disabled>
            </div>

            <div class="mb-4">
                <label for="papel" class="form-label"><strong>Novo Papel:</strong></label>
                <select name="papel" id="papel" class="form-select" required>
                    <option value="Titular" <?php if ($papelAtual == "Titular") echo "selected"; ?>>Titular</option>
                    <option value="Adicional" <?php if ($papelAtual == "Adicional") echo "selected"; ?>>Adicional</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="clienteCartaoList.php" class="btn btn-secondary ms-2">Voltar</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
