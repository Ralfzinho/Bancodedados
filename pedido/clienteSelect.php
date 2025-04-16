<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <b><font color="#0000FF">Lista de CLIENTES</font></b>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>Código</b></td>
        <td><b>Nome</b></td>
        <td><b>Alterar</b></td>
        <td><b>Excluir</b></td>
     </tr>

       <?php
            // criar conexao
            include_once("_conexao.php");
            $conexao = conectaBD();

            $sql = "SELECT * FROM cliente;";
            $resultado = mysqli_query($conexao, $sql);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['codigo'];?></td>
                <td><?php echo $i['nome'];?></td>

                <td><a href="<?php echo "clienteEditar.php?var_cod=". $i['codigo']."&var_nome=".$i['nome']?>">Alterar</a></td>
                <td><a href="<?php echo "clienteDelete.php?var_cod=". $i['codigo']?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>
     <h4><a href="cliente.html">Cadastrar novo Cliente</a></h4>

     <?php
      mysqli_close($conexao);
     ?>
</BODY>
</HTML>
