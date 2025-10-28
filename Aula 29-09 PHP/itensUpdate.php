<link rel="stylesheet" href="style.css">

<?php
    // criar conexao
    //include_once("_conexao.php");
    //$conexao= conectaBD();

    $nropedido   = $_POST["input_pedido"];
    $codproduto  = $_POST["input_codigoProduto"];
    $quantidade  = $_POST["input_quantidade"];

    // cria conexão
   $conexao= mysqli_connect("localhost", "root", "", "baseTeste");
   if(!$conexao){
     die("Conexão falhou! ".mysqli_connect_error());
   }else{
     echo "Conexão realizada!";
   }
    
    $sql = "UPDATE   itens
              SET    qtd  = $quantidade
              WHERE  numpedido = {$nropedido} and codproduto = {$codproduto}";

   //echo $sql;

   mysqli_query($conexao, $sql) or die(mysqli_error());

   echo "Alteração com Sucesso!";

// encerrar conexão
   mysqli_close($conexao);
?>
 <h4><a href="pedidoSelect.php">Listar PEDIDOS</a></h4>


 
