<?php
 include_once("../conexao/conexao.php");

  //Qual tabela quer manipular?
  $get1 = (string)filter_input(INPUT_GET,"tabela");
  //qual codigo quer excluir?
  $get2 = filter_input (INPUT_GET,"var_cod");

  // de qual objeto?
 if($get1 == 'produto'){
  excluirProduto($get2);
  header("location:produtoSelect.php");


 }

 if($get1 == 'pedido'){
  

 }

 if($get1 == 'itens'){
  

 }

# ---------------------------------
  function excluirProduto($p1){
    $conexao = conectaBD();

    $sql = "DELETE FROM Produto WHERE codigo = $p1";

    mysqli_query($conexao,$sql) or die(mysqli_error());

    desconectaBD($conexao);

  }


 function excluirPedido($p1){

  
 }

# ---------------------------------
 function excluirItens($p1, $p2){
 }

?>
