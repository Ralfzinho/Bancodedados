<?php
include("_conexao.php");

// Buscar todos os clientes
$sqlClientes = "SELECT id_cliente, nome FROM Cliente ORDER BY nome";
$resultClientes = mysqli_query($conn, $sqlClientes);

// Buscar todos os cartões
$sqlCartoes = "SELECT id_cartao, numero_cartao FROM Cartao ORDER BY numero_cartao";
$resultCartoes = mysqli_query($conn, $sqlCartoes);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vincular Cliente a Cartão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h2 class="text-primary mb-4">🔗 Vincular Cliente a Cartão</h2>

        <form action="clienteCartaoInsert.php" method="post">
            <div class="mb-3">
                <label for="id_cliente" class="form-label"><strong>Cliente:</strong></label>
                <select name="id_cliente" id="id_cliente" class="form-select" required>
                    <option value="">-- Selecione o cliente --</option>
                    <?php while ($cliente = mysqli_fetch_assoc($resultClientes)) { ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>">
                            <?php echo htmlspecialchars($cliente['nome']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_cartao" class="form-label"><strong>Cartão:</strong></label>
                <select name="id_cartao" id="id_cartao" class="form-select" required>
                    <option value="">-- Selecione o cartão --</option>
                    <?php while ($cartao = mysqli_fetch_assoc($resultCartoes)) { ?>
                        <option value="<?php echo $cartao['id_cartao']; ?>">
                            <?php echo htmlspecialchars($cartao['numero_cartao']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="papel" class="form-label"><strong>Papel:</strong></label>
                <select name="papel" id="papel" class="form-select" required>
                    <option value="">-- Selecione o papel --</option>
                    <option value="Titular">Titular</option>
                    <option value="Adicional">Adicional</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Vincular</button>
            <a href="clienteCartaoList.php" class="btn btn-secondary ms-2">Ver Vínculos</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
