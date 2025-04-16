<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

    $codigo    = $_POST["codigo"];
    $nome      = $_POST["nome"];
    $comissao     = $_POST["comissao"];
      
    $sql= "INSERT INTO vendedor(codigo, nome, comissao) 
           VALUES ({$codigo}, '{$nome}', {$comissao})";
    mysqli_query($conexao,$sql) or die(mysqli_error());

    echo "Cadastro com Sucesso!";

    mysqli_close($conexao);
?>
