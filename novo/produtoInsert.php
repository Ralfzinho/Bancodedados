<?php       
    $servername = "localhost";
    $database = "produto_vendedor";
    $username = "root";
    $password = "";
         
    // criar conexao
    $conexao= mysqli_connect($servername, $username, $password, $database);
    if(!$conexao){
        die("Conexão falhou! ".mysqli_connect_error());
    }else{
        echo "Conexão realizada!"; 
    }

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