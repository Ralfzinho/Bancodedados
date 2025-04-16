<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

   $var_codigo    = $_POST["input_codigo"];
   $var_nome      = $_POST["input_nome"];

   $SQL = "UPDATE cliente
              SET    nome      = '$var_nome'
              WHERE  codigo = {$var_codigo};";

   // echo $SQL;

   mysqli_query($conexao, $SQL) or die(mysqli_error());

   echo "Alterado com Sucesso!";

// encerrar conexão
   mysqli_close($conexao);
?>


 
