<link rel="stylesheet" href="style.css">

<?php
// cria conexão
    $conexao= mysqli_connect("localhost", "root", "", "baseTeste");
    if(!$conexao){
      die("Conexão falhou! ".mysqli_connect_error());
    }else{
      //echo "Conexão realizada!";
    }


    //$get1 = (string)filter_input(INPUT_GET, "tabela");
    $get1 = filter_input(INPUT_GET, "var_num");
    $get2 = filter_input(INPUT_GET, "var_codprod");
    
    $sql= "DELETE FROM Itens WHERE numpedido = {$get1} and codproduto = {$get2}";
    //echo "$sql";
    mysqli_query($conexao, $sql);

    echo "Excluído com Sucesso!";

// encerra conexão
   mysqli_close($conexao);
  
?>
<h4><a href="pedidoSelect.php">Listar PEDIDOS</a></h4>