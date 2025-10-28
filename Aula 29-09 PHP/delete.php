
<?php
// cria conexão
$conexao = mysqli_connect("localhost", "root", "", "baseTeste");
if (!$conexao) {
    die("Conexão falhou! " . mysqli_connect_error());
} else {
    echo "Conexão realizada!";
}

$get1 = filter_input(INPUT_GET, "var-cod");
//echo "=> $get1";

$sql = "DELETE FROM Produto WHERE codigo = {$get1}";
mysqli_query($conexao, $sql);

echo "<br />" . "Excluido com Sucesso!";


// encerra conexão
mysqli_close($conexao);

?>
<h3><a href="produtoSelect.php">LISTAR PRODUTOS</a></h3>