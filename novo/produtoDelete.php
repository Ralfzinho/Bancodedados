<?php
    // criar conexao
    include_once("_conexao.php");
    $conexao= conectaBD();

    $cod = filter_input(INPUT_GET, "var_cod");
    $dados= "DELETE FROM produto WHERE codigo = {$cod}";

    mysqli_query($conexao, $dados) or die(mysqli_error());

    echo "Excluído com Sucesso!";

    mysqli_close($conexao);
?>
