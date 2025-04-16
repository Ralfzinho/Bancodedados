<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <?php
      $get1 = filter_input(INPUT_GET, "var_cod");
      $get2 = filter_input(INPUT_GET, "var_nome");
   ?>

   <b><font color="#0000FF">Tela de Edição de PRODUTOS</font></b>
      </br> </br>

    <form action="clienteUpdate.php" method="post">

     <input type=hidden name=tabela value="cliente">

     <b> Código:</b> <input type="text" name="input_codigo" size="8" value="<?php echo $get1?>" readonly>
       </br></br>

    <b> Descrição:</b> <input type="text" name="input_nome" size="30" value="<?php echo $get2?>">
       </br></br>

       </br></br>

    <input type="submit" value="Salvar">

   </form>

</BODY>
</HTML>
