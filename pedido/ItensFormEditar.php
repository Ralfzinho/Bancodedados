<?php
// Recebe os parâmetros enviados pelo link
$get_codPedido = filter_input(INPUT_GET, "var_cod", FILTER_SANITIZE_NUMBER_INT);
$get_codProduto = filter_input(INPUT_GET, "var_codProd", FILTER_SANITIZE_NUMBER_INT);
$get_descrProduto = filter_input(INPUT_GET, "var_descrProd", FILTER_SANITIZE_STRING);
$get_quantidade = filter_input(INPUT_GET, "var_Quantidade", FILTER_SANITIZE_NUMBER_INT);
$get_preco = filter_input(INPUT_GET, "var_Preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Conectar ao banco de dados
include_once("_conexao.php");
$conn = conectaBD();

// Obter os dados do item para edição
$sql = "SELECT * FROM itens WHERE nropedido = $get_codPedido AND codproduto = $get_codProduto";
$resultado = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($resultado);

// Verifique se o item foi encontrado (para evitar erros se os parâmetros estiverem incorretos)
if (!$item) {
    die("Item não encontrado.");
}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Alterar Item do Pedido</title>
</head>
<body>
    <b><font color="#0000FF">Alterar ITENS do PEDIDO</font></b>
    </br> </br>

    <form action="itensUpdate.php" method="post">
        <!-- Campos ocultos para o pedido e o produto -->
        <input type="hidden" name="nropedido" value="<?php echo $get_codPedido; ?>">
        <input type="hidden" name="codproduto" value="<?php echo $get_codProduto; ?>">

        <label>
            <b>Produto:</b>
            <input type="text" name="produto" value="<?php echo $get_descrProduto; ?>" readonly>
        </label>
        </br></br>

        <label>
            <b>Quantidade:</b>
            <input type="text" name="quantidade" value="<?php echo $get_quantidade; ?>" required>
        </label>
        </br></br>

        <label>
            <b>Preço:</b>
            <input type="text" name="preco" value="<?php echo $get_preco; ?>" required>
        </label>
        </br></br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Salvar Alterações">
    </form>

</body>
</html>

<?php
// Fechar a conexão
mysqli_close($conn);
?>
