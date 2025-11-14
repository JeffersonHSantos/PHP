<?php
 include_once("conexao.php");

 if($_POST["tabela"] == 'produto'){
    cadastraProduto($_POST["cod"],$_POST["nome"],$_POST["valor"],$_POST["per"],); 
    header("location:produtoSelect.php");
 }

 if($_POST["tabela"] == 'pedido'){
 }

 if($_POST["tabela"] == 'itens'){
 }


# -----------------------------------------------------------------------
 function cadastraProduto($codProd, $nomeProd, $valorProd,$tipoProd){
  $conexao = conectaBD();
  $sql = "INSERT INTO produto(codigo,nome,valor,perecivel)VALUES({$codProd},'{$nomeProd}',{$valorProd},'{$tipoProd}')";
    mysqli_query($conexao,$sql) or die(mysqli_error()); 

    descontectaBD($conexao);

    echo "Conexão realizada!";
 }
 

 function cadastraPedido($numero, $cliente,$data){
   //  $conexao = conectaBD();
 }

# -----------------------------------------------------------------------
 function cadastraItens($numero, $produto, $quantidade, $preco){
  //  $conexao = conectaBD();    
 }