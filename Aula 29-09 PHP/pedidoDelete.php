<?php
// cria conexão
$conexao = mysqli_connect("localhost", "root", "", "baseTeste");
if (!$conexao) {
    die("Conexão falhou! " . mysqli_connect_error());
} else {
    echo "Conexão realizada!";
}

$get1 = filter_input(INPUT_GET, "var_num");
//echo "=> $get1";

$sql = "DELETE FROM Pedido WHERE numero = {$get1}";
mysqli_query($conexao, $sql);

echo "<br />" . "Excluido com Sucesso!";


// encerra conexão
mysqli_close($conexao);

?>
<h3><a href="pedidoSelect.php">LISTAR PEDIDOS</a></h3>