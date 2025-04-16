<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

    $codigo    = $_POST["cod"];
    $nome      = $_POST["nome"];
    $valor     = $_POST["valor"];
    $perecivel = $_POST["per"];
      
    $sql= "INSERT INTO produto(codigo, nome, valor, perecivel) 
           VALUES ({$codigo},'{$nome}', {$valor},'{$perecivel}')";
    mysqli_query($conexao,$sql) or die(mysqli_error());

    echo "Cadastro com Sucesso!";

    mysqli_close($conexao);
?>
