<link rel="stylesheet" href="style.css">

<?php
   
   $numPed = $_POST["input_numpedido"];
   $codProd = $_POST["input_codproduto"];
   $qtdItem = $_POST["input_quantidade"]; 
   
   echo "$numPed";
   echo "$codProd";
   echo "$qtdItem";

   // cria conexão
   $conexao= mysqli_connect("localhost", "root", "", "baseTeste");
   if(!$conexao){
     die("Conexão falhou! ".mysqli_connect_error());
   }else{
     echo "Conexão realizada!";
   }
   
   // Inserção de Dados
   $sql = "INSERT INTO itens(numPedido,codProduto,qtd) VALUES 
                           ({$numPed},{$codProd},{$qtdItem})";
   mysqli_query($conexao,$sql) or die(mysqli_error());


   echo "<br />"."Gravando na tabela....";

   // encerra conexão
   mysqli_close($conexao);
?>

     <h4><a href="pedidoSelect.php">Listar PEDIDOS</a></h4>
     <h4><a href="itens.php?var_num=<?php echo $numPed; ?>">Continuar Cadastrando Itens</a></h4>

