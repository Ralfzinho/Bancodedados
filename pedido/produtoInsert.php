<?php
    // Criar conexão
    include_once("_conexao.php");
    $conexao = conectaBD();

    // Receber dados do formulário
    $nome      = $_POST["nome"];
    $valor     = $_POST["valor"];
    $perecivel = $_POST["per"];

    // Verifique se o 'valor' é um número válido e o 'perecivel' é uma string
    if (!is_numeric($valor)) {
        die("Valor inválido para o campo 'valor'.");
    }

    // Consulta SQL - Não inclui o campo 'codigo', que é auto-incremento
    $sql = "INSERT INTO produto(nome, valor, perecivel) 
            VALUES ('{$nome}', {$valor}, '{$perecivel}')";

    // Executar a consulta
    if (mysqli_query($conexao, $sql)) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }

    // Fechar a conexão
    mysqli_close($conexao);
?>
