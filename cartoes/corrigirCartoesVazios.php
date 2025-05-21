<?php
include('_conexao.php');

// Consulta cartões com número vazio ou nulo
$sql = "SELECT id_cartao FROM Cartao WHERE numero_cartao IS NULL OR TRIM(numero_cartao) = ''";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 0) {
    echo "✅ Todos os cartões têm número preenchido.";
} else {
    echo "<h3>⚠️ Cartões com número vazio encontrados:</h3>";
    echo "<ul>";

    // Atualizar com número genérico, se desejar
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id_cartao'];
        $novoNumero = "Cartao-" . str_pad($id, 4, "0", STR_PAD_LEFT);

        echo "<li>ID $id → atualizado para: <strong>$novoNumero</strong></li>";

        // Atualização
        $update = $conn->prepare("UPDATE Cartao SET numero_cartao = ? WHERE id_cartao = ?");
        $update->bind_param("si", $novoNumero, $id);
        $update->execute();
        $update->close();
    }

    echo "</ul>";
    echo "<br>✅ Atualização concluída.";
}

$conn->close();
?>
