<!DOCTYPE HTML>
<html lang="pt-br">
<meta charset="utf-8"/>
<body>
   <b><font color="#0000FF">Cadastro de ITENS do PEDIDO</font></b>
   </br> </br>

   <form action="itensInsert.php" method="post">
      <input type="hidden" name="tabela" value="itens">

      <?php
          $get1 = filter_input(INPUT_GET, "var_cod", FILTER_SANITIZE_NUMBER_INT);

          include_once("_conexao.php");
          $conn = conectaBD();

          $select = "SELECT p.numero, c.nome, p.data 
                     FROM pedido p 
                     INNER JOIN cliente c ON p.codcliente = c.codigo 
                     WHERE p.numero = $get1";
          $resultado = mysqli_query($conn, $select);
          $i = mysqli_fetch_assoc($resultado);
          echo "<br> <br>";
          echo "Itens do Pedido: <strong>" . $i['numero'] . " (Cliente: " . $i['nome'] . ")</strong>";
          echo "<br> <br>";
      ?>

      <input type="hidden" name="input_cod" value="<?php echo $get1 ?>">

      <label>
          <b>Produto</b>
          <select name="input_codProduto" id="input_codProduto" onchange="updatePrice()">
              <option>Selecione</option>
              <?php
                  $selectProdutos = "SELECT * FROM produto ORDER BY nome";
                  $resultadoProdutos = mysqli_query($conn, $selectProdutos);
                  while($produto = mysqli_fetch_assoc($resultadoProdutos)){
              ?>
              <option value="<?php echo $produto['codigo'];?>" data-preco="<?php echo $produto['valor']; ?>">
                  <?php echo $produto['nome'];?>
              </option>
              <?php
                  }
              ?>
          </select>
      </label>
      </br></br>

      <label>
          <b>Quantidade:</b>
          <input type="text" name="input_quantidade" size="12" required>
      </label>
      </br></br>

      <label>
          <b>Preço:</b>
          <input type="text" name="input_preco" id="input_preco" size="12" readonly>
      </label>
      </br></br>

      <input type="reset" value="Reset">
      <input type="submit" value="Cadastrar">
   </form>

   <script>
       function updatePrice() {
           var select = document.getElementById("input_codProduto");
           var selectedOption = select.options[select.selectedIndex];
           var preco = selectedOption.getAttribute("data-preco");
           document.getElementById("input_preco").value = preco;
       }
   </script>
</body>
</html>
