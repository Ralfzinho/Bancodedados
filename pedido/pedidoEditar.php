<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <?php
      $get1 = filter_input(INPUT_GET, "var_cod");
      $get2 = filter_input(INPUT_GET, "var_data");
      $get3 = filter_input(INPUT_GET, "var_vendedor");
      $get4 = filter_input(INPUT_GET, "var_cliente");
   ?>

   <b><font color="#0000FF">Tela de Edição de PEDIDOS</font></b>
      </br> </br>

    <form action="pedidoUpdate.php" method="post">

     <b> Número:</b> <input type="text" name="input_numero" size="8" value="<?php echo $get1?>" readonly>
       </br></br>

    <b> Data:</b> <input type="date" name="input_data" size="30" value="<?php echo $get2?>">
       </br></br>

    <b> Vendedor: </b>
        <select name="input_vendedor">
          <option>Selecione</option>
          <?php
              include_once("_conexao.php");

              $conn = conectaBD();

              $select = "SELECT * FROM vendedor order by nome";
              $resultado = mysqli_query($conn, $select);

              while($i = mysqli_fetch_assoc($resultado)){

                  if ($i['codigo'] == $get3) { ?>

                  <option selected value="<?php echo $i['codigo'];?>">
                                          <?php echo $i['nome'];?>
                  </option>

              <?php
                  } else { ?>
                      <option value="<?php echo $i['codigo'];?>">
                                     <?php echo $i['nome'];?>
                      </option>

              <?php } #fim if else
              } # fim while
          ?>
            </select>
         </br></br>


         <b> Cliente: </b>
        <select name="input_cliente">
          <option>Selecione</option>
          <?php
              include_once("_conexao.php");

              $conn = conectaBD();

              $select = "SELECT * FROM cliente order by nome";
              $resultado = mysqli_query($conn, $select);

              while($i = mysqli_fetch_assoc($resultado)){

                  if ($i['codigo'] == $get4) { ?>

                  <option selected value="<?php echo $i['codigo'];?>">
                                          <?php echo $i['nome'];?>
                  </option>

              <?php
                  } else { ?>
                      <option value="<?php echo $i['codigo'];?>">
                                     <?php echo $i['nome'];?>
                      </option>

              <?php } #fim if else
              } # fim while
          ?>
            </select>
         </br></br>

    <input type="submit" value="Salvar">

   </form>
</BODY>
</HTML>