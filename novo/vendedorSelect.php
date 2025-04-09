<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <b><font color="#0000FF">Lista de Vendedores</font></b>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>Código</b></td>
        <td><b>Nome</b></td>
        <td><b>Comissão</b></td>
     </tr>
     <?php
            // criar conexao
            include_once("_conexao.php");
            $conexao = conectaBD();

            $sql = "SELECT * FROM vendedor;";
            $resultado = mysqli_query($conexao, $sql);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['codigo'];?></td>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['comissao'];?></td>

                <td><a href="<?php echo"vendedorEditar.php?var_cod=". $i['codigo']."&var_nome=".$i['nome']."&var_comissao=".$i['comissao']?>">Alterar</a></td>
                <td><a href="<?php echo"vendedorDelete.php?var_cod=". $i['codigo']?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>
     <h4><a href="vendedor.html">Cadastrar novo VENDEDOR</a></h4>

     <?php
      mysqli_close($conexao);
     ?>
</BODY>
</HTML>