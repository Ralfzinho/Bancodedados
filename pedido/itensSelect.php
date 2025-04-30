<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Atualiza ITENS DO PEDIDO</title>
</head>
<body>
    <b><font color="#0000FF">Atualiza ITENS DO PEDIDO</font></b>
    </br> </br>

    <table border="1">
        <tr>
            <td><b>Produto</b></td>
            <td><b>Quantidade</b></td>
            <td><b>Preço</b></td>
            <td><b>Editar?</b></td>
            <td><b>Excluir?</b></td>
        </tr>

        <?php
            $get1 = filter_input(INPUT_GET, "var_cod", FILTER_SANITIZE_NUMBER_INT);  // Sanitiza o código do pedido

            include_once("_conexao.php");
            $conn = conectaBD();

            // Consulta para obter as informações do pedido
            $select = "SELECT pedido.numero, cliente.nome, pedido.data 
                       FROM pedido 
                       INNER JOIN cliente ON pedido.codcliente = cliente.codigo 
                       WHERE pedido.numero = $get1";
            $resultado = mysqli_query($conn, $select);
            $pedido = mysqli_fetch_assoc($resultado);

            echo "<br><br>";
            echo "Itens do Pedido: <strong>" . $pedido['numero'] . " (Cliente: " . $pedido['nome'] . ")</strong>";
            echo "<br><br>";

            // Consulta para obter os itens do pedido
            $selectItens = "SELECT itens.nropedido, itens.codproduto, produto.nome, itens.quantidade, itens.preco 
                            FROM itens 
                            INNER JOIN produto ON itens.codproduto = produto.codigo 
                            WHERE itens.nropedido = $get1";
            $resultadoItens = mysqli_query($conn, $selectItens);

            while ($item = mysqli_fetch_assoc($resultadoItens)) {
        ?>
            <tr>
                <td><?php echo $item['nome']; ?></td>
                <td><?php echo $item['quantidade']; ?></td>
                <td><?php echo number_format($item['preco'], 2, ',', '.'); ?></td> <!-- Formatação do preço -->
                <td><a href="ItensFormEditar.php?var_cod=<?php echo $item['nropedido']; ?>&var_codProd=<?php echo $item['codproduto']; ?>&var_descrProd=<?php echo $item['nome']; ?>&var_Quantidade=<?php echo $item['quantidade']; ?>&var_Preco=<?php echo $item['preco']; ?>">Alterar</a></td>
                <td><a href="itensDelete.php?var_cod=<?php echo $item['nropedido']; ?>&var_codProd=<?php echo $item['codproduto']; ?>&tabela=itens">Excluir</a></td>
            </tr>
        <?php
            }
        ?>
    </table>

    <h3><a href="itens.php?var_cod=<?php echo $get1; ?>">Cadastrar novo ITEM para este PEDIDO</a></h3>

</body>
</html>
