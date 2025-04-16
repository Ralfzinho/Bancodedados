<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

    $nropedido = $_POST["input_numero"];
    $data      = $_POST["input_data"];
    $vendedor  = $_POST["input_vendedor"];
    $cliente   = $_POST["input_cliente"];
      
    $sql= "INSERT INTO pedido(numero, data, codvendedor, codcliente)
           VALUES ({$nropedido},'{$data}', {$vendedor},'{$cliente}')";
    mysqli_query($conexao,$sql) or die(mysqli_error());

    echo "Cadastro com Sucesso!";

    mysqli_close($conexao);
?>
