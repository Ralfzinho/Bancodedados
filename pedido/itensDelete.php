<?php
// Conectar ao banco de dados
include_once("_conexao.php");
$conn = conectaBD();

// Receber os parâmetros via GET
$nropedido = filter_input(INPUT_GET, 'var_cod', FILTER_SANITIZE_NUMBER_INT);
$codproduto = filter_input(INPUT_GET, 'var_codProd', FILTER_SANITIZE_NUMBER_INT);

// Verificar se os parâmetros foram passados corretamente
if (!$nropedido || !$codproduto) {
    die("Pedido ou produto não informado.");
}

// Consultar o item antes de deletar (opcional, para verificar a existência do item)
$sql_check = "SELECT * FROM itens WHERE nropedido = $nropedido AND codproduto = $codproduto";
$resultado_check = mysqli_query($conn, $sql_check);
$item = mysqli_fetch_assoc($resultado_check);

if (!$item) {
    die("Item não encontrado.");
}

// Remover o item da tabela 'itens'
$sql_delete = "DELETE FROM itens WHERE nropedido = $nropedido AND codproduto = $codproduto";

if (mysqli_query($conn, $sql_delete)) {
    // Redireciona para a página de itens do pedido após exclusão
    echo "Item excluído com sucesso!";
    header("Location: itensSelect.php?var_cod=$nropedido");
} else {
    // Caso ocorra erro durante a exclusão
    echo "Erro ao excluir item: " . mysqli_error($conn);
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
