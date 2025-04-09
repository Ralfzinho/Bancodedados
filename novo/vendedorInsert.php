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

    $codigo    = $_POST["codigo"];
    $nome      = $_POST["nome"];
    $comissao  = $_POST["comissao"];
      
    $sql= "INSERT INTO vendedor(codigo, nome, comissao) 
           VALUES ({$codigo},'{$nome}', {$comissao})";
    mysqli_query($conexao,$sql) or die(mysqli_error());

    echo "Cadastro com Sucesso!";

   mysqli_close($conexao);
?>