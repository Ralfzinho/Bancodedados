<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

    $codigo    = $_POST["codigo"];
    $nome      = $_POST["nome"];
      
    $sql= "INSERT INTO cliente(codigo, nome) 
           VALUES ({$codigo}, '{$nome}')";
    mysqli_query($conexao,$sql) or die(mysqli_error());

    echo "Cadastro com Sucesso!";

    mysqli_close($conexao);
?>
