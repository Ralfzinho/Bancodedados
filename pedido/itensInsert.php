<?php
    // Criar conexão
    include_once("_conexao.php");
    $conexao = conectaBD();

    // Receber os dados do formulário
    $nropedido = $_POST["input_cod"];
    $codproduto = $_POST["input_codProduto"];
    $quantidade = $_POST["input_quantidade"];
    $preco = $_POST["input_preco"];

    // Inserir os dados na tabela "itens"
    $sql = "INSERT INTO itens (nropedido, codproduto, quantidade, preco) 
            VALUES ($nropedido, $codproduto, $quantidade, $preco)";

    if (mysqli_query($conexao, $sql)) {
        echo "Item cadastrado com sucesso!";
        // Redirecionar para a página de itens do pedido
        header("Location: itensSelect.php?var_cod=$nropedido");
    } else {
        echo "Erro ao cadastrar o item: " . mysqli_error($conexao);
    }

    // Fechar a conexão
    mysqli_close($conexao);
?>
