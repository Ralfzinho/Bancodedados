<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

   $var_codigo    = $_POST["input_codigo"];
   $var_nome      = $_POST["input_nome"];
   $var_valor     = $_POST["input_valor"];
   $var_perecivel = $_POST["input_perecivel"];

   $SQL = "UPDATE produto
              SET    nome      = '$var_nome',
                     valor     = $var_valor,
                     perecivel = '$var_perecivel'
              WHERE  codigo = {$var_codigo};";

   mysqli_query($conexao, $SQL) or die(mysqli_error());

// encerrar conexão
   mysqli_close($conexao);
?>


 
