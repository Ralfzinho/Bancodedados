<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <b><font color="#0000FF">Lista de PEDIDOS</font></b>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>Número</b></td>
        <td><b>Data</b></td>
        <td><b>Total</b></td>
        <td><b>Vendedor</b></td>
        <td><b>Cliente</b></td>
        <td><b>Alterar</b></td>
        <td><b>Excluir</b></td>
     </tr>

       <?php
            // criar conexao
            include_once("_conexao.php");
            $conexao = conectaBD();

            $sql = "SELECT numero, data, total, codvendedor, vendedor.nome as nomevendedor, codcliente, cliente.nome as nomecliente
                    FROM pedido 
                    JOIN vendedor ON pedido.codvendedor = vendedor.codigo
                    JOIN cliente  ON pedido.codcliente = cliente.codigo;";
            $resultado = mysqli_query($conexao, $sql);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['numero'];?></td>
                <td><?php echo $i['data'];?></td>
                <td><?php echo $i['total'];?></td>
                <td><?php echo $i['codvendedor']. " - " .$i['nomevendedor'];?></td>
                <td><?php echo $i['codcliente']. " - " .$i['nomecliente'];?></td>

                <td><a href="<?php echo "pedidoEditar.php?var_cod=". $i['numero']."&var_data=".$i['data']."&var_total=".$i['total']."&var_vendedor=".$i['codvendedor']."&var_cliente=".$i['codcliente']?>">Alterar</a></td>
                <td><a href="<?php echo "pedidoDelete.php?var_cod=". $i['numero']?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>
     <h4><a href="pedido.php">Cadastrar novo PEDIDO</a></h4>

     <?php
      mysqli_close($conexao);
     ?>
</BODY>