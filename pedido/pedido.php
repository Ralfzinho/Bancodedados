<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <b><font color="#0000FF">Cadastro de PEDIDOS - versão 2</font></b>    </br> </br>

     <form name="cadPedido2" method="POST" action="pedidoInsert.php" >

    <b> Número do pedido:</b> <input type="text" name="input_numero" size="8">
       </br></br>

    <b> Data:</b>   <input type="date" name="input_data" size="30">
       </br></br>

        <b>Vendedor</b>
        <select name="input_vendedor">
        <option>Selecione</option>
        <?php
            include_once("_conexao.php");

            $conn = conectaBD();

            $select = "SELECT codigo, nome FROM vendedor order by nome";
            $resultado = mysqli_query($conn, $select);

            while($i = mysqli_fetch_assoc($resultado)){
            ?>
             <option value="<?php echo $i['codigo'];?>">
                            <?php echo $i['nome'];?>
             </option> 
        <?php
           }
        ?>
          </select>    
       </br></br>

       <b>Cliente:</b> 
       <select name="input_cliente">
        <option>Selecione</option>
        <?php
            include_once("_conexao.php");

            $conn = conectaBD();

            $select = "SELECT codigo, nome FROM cliente order by nome";
            $resultado = mysqli_query($conn, $select);

            while($i = mysqli_fetch_assoc($resultado)){
            ?>
             <option value="<?php echo $i['codigo'];?>">
                            <?php echo $i['nome'];?>
             </option> 
        <?php
           }
        ?>
          </select> 
          <br><br>
        <input type="submit" value="Enviar"/>
    </form>

</body>
</html>