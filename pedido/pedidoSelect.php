<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <title>Lista de PEDIDOS</title>
</head>
<body>
    <b><font color="#0000FF">Lista de PEDIDOS</font></b>
    </br> </br>

    <table border="1">
        <tr>
            <td><b>Número</b></td>
            <td><b>Data</b></td>
            <td><b>Total</b></td>
            <td><b>Vendedor</b></td>
            <td><b>Cliente</b></td>
            <td><b>Alterar</b></td>
            <td><b>Excluir</b></td>
            <td><b>Itens do Pedido</b></td>
        </tr>

        <?php
            // Criar conexão
            include_once("_conexao.php");
            $conexao = conectaBD();

            // Consulta para obter os pedidos e calcular o total com base nos itens
            $sql = "SELECT pedido.numero, pedido.data, 
                           SUM(itens.quantidade * itens.preco) AS totalPedido,
                           pedido.codvendedor, vendedor.nome AS nomevendedor,
                           pedido.codcliente, cliente.nome AS nomecliente
                    FROM pedido
                    JOIN vendedor ON pedido.codvendedor = vendedor.codigo
                    JOIN cliente ON pedido.codcliente = cliente.codigo
                    LEFT JOIN itens ON pedido.numero = itens.nropedido
                    GROUP BY pedido.numero, pedido.data, pedido.codvendedor, pedido.codcliente, vendedor.nome, cliente.nome";
            $resultado = mysqli_query($conexao, $sql);

            // Laço para exibir cada pedido
            while($i = mysqli_fetch_assoc($resultado)){
        ?>
            <tr>
                <td><?php echo $i['numero']; ?></td>
                <td><?php echo $i['data']; ?></td>
                <td><?php echo number_format($i['totalPedido'], 2, ',', '.'); ?></td> <!-- Exibe o total formatado -->
                <td><?php echo $i['codvendedor'] . " - " . $i['nomevendedor']; ?></td>
                <td><?php echo $i['codcliente'] . " - " . $i['nomecliente']; ?></td>
                <td><a href="pedidoEditar.php?var_cod=<?php echo $i['numero']; ?>&var_data=<?php echo $i['data']; ?>&var_vendedor=<?php echo $i['codvendedor']; ?>&var_cliente=<?php echo $i['codcliente']; ?>">Alterar</a></td>
                <td><a href="pedidoDelete.php?var_cod=<?php echo $i['numero']; ?>">Excluir</a></td>
                <td><a href="itensSelect.php?var_cod=<?php echo $i['numero']; ?>">Itens do Pedido</a></td>
            </tr>
        <?php
            }
        ?>
    </table>

    <h4><a href="pedido.php">Cadastrar novo PEDIDO</a></h4>

    <?php
        mysqli_close($conexao);
    ?>
</body>
</html>
