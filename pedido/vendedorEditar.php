<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <?php
      $get1 = filter_input(INPUT_GET, "var_cod");
      $get2 = filter_input(INPUT_GET, "var_nome");
      $get3 = filter_input(INPUT_GET, "var_comissao");
   ?>

   <b><font color="#0000FF">Tela de Edição de PRODUTOS</font></b>
      </br> </br>

    <form action="vendedorUpdate.php" method="post">

     <input type=hidden name=tabela value="produto">

     <b> Código:</b> <input type="text" name="input_codigo" size="8" value="<?php echo $get1?>" readonly>
       </br></br>

    <b> Descrição:</b> <input type="text" name="input_nome" size="30" value="<?php echo $get2?>">
       </br></br>

    <b> Preço:</b> <input type="text" name="input_comissao" size="15" value="<?php echo $get3?>">
       </br></br>

    <input type="submit" value="Salvar">

   </form>

</BODY>
</HTML>
