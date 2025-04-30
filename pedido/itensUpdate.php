<?php
// Conectar ao banco de dados
include_once("_conexao.php");
$conn = conectaBD();

// Receber os dados do formulário
$nropedido = $_POST['nropedido'];   // Número do pedido
$codproduto = $_POST['codproduto']; // Código do produto
$quantidade = $_POST['quantidade']; // Quantidade do produto
$preco = $_POST['preco'];           // Preço do produto

// Validar os dados (você pode adicionar mais validações conforme necessário)
if (!is_numeric($quantidade) || !is_numeric($preco)) {
    die("Quantidade e preço devem ser números válidos.");
}

// Atualizar os dados na tabela 'itens'
$sql = "UPDATE itens 
        SET quantidade = $quantidade, preco = $preco 
        WHERE nropedido = $nropedido AND codproduto = $codproduto";

// Executar a consulta SQL
if (mysqli_query($conn, $sql)) {
    // Atualização bem-sucedida
    echo "Item atualizado com sucesso!";
    // Redireciona para a página de itens do pedido
    header("Location: itensSelect.php?var_cod=$nropedido");
} else {
    // Se ocorrer um erro
    echo "Erro ao atualizar o item: " . mysqli_error($conn);
}

// Fechar a conexão
mysqli_close($conn);
?>
