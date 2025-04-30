<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

   $nropedido = $_POST["input_numero"];
   $data      = $_POST["input_data"];
   $vendedor  = $_POST["input_vendedor"];
   $cliente   = $_POST["input_cliente"];

   $SQL = "UPDATE pedido
              SET    data        = '$data',
                     codvendedor = $vendedor,
                     codcliente  = $cliente
              WHERE  numero = {$nropedido};";

   mysqli_query($conexao, $SQL) or die(mysqli_error());

   echo "Alteração com Sucesso!";

// encerrar conexão
   mysqli_close($conexao);
?>


 