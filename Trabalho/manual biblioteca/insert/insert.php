<?php
 include_once("../conexao/conexao.php");

 $id_categoria = $_POST['id_categoria'];

 if($_POST["tabela"] == 'autor'){
  cadastraAutor($_POST["id_autor"],$_POST["nome"],$_POST["data_nasc"],$_POST["data_morte"]); 
    header("location:../select/autorSelect.php");
    exit;
 }

 if($_POST["tabela"] == 'categoria'){
  cadastraCategoria($_POST["id_categoria"],$_POST["nome"],$_POST["descricao"]); 
    header("location:../select/categoriaSelect.php");
    exit;
 }

 if($_POST["tabela"] == 'cliente'){
  cadastraCliente($_POST["cpf"],$_POST["nome"],$_POST["data_nasc"],$_POST["endereco"],$_POST["telefone"]); 
    header("location:../select/clienteSelect.php");
    exit;
 }

 if($_POST["tabela"] == 'filial'){
  cadastraFilial($_POST["cnpj"],$_POST["razao_social"],$_POST["endereco"],$_POST["telefone"]); 
    header("location:../select/filialSelect.php");
    exit;
 }

if ($_POST["tabela"] == 'livro') { 

    if ($_POST["acao"] == "editar") {
        editaLivro($_POST["id_livro"], $_POST["titulo"], $_POST["ano_publicacao"], $_POST["situacao"], $_POST["id_categoria"]);
    } else {
        cadastraLivro($_POST["titulo"], $_POST["ano_publicacao"], $_POST["situacao"], $_POST["id_categoria"]);
    }

    header("location:../select/livroSelect.php");
    exit;

}




# -----------------------------------------------------------------------
 

function cadastraLivro($titulo, $anoPubli, $situacao, $idCategoria){
  $conexao = conectaBD();
  $sql = "INSERT INTO livro(titulo, ano_publicacao, situacao, id_categoria)
          VALUES('{$titulo}', {$anoPubli}, '{$situacao}', {$idCategoria})";

  mysqli_query($conexao, $sql) or die(mysqli_error($conexao)); 

  desconectaBD($conexao);
}

function editaLivro($id, $titulo, $anoPubli, $situacao, $idCategoria){
  $conexao = conectaBD();
  
  $sql = "UPDATE livro SET 
            titulo = '{$titulo}',
            ano_publicacao = {$anoPubli},
            situacao = '{$situacao}',
            id_categoria = {$idCategoria}
          WHERE id_livro = {$id}";
  
  mysqli_query($conexao, $sql) or die(mysqli_error($conexao)); 

  desconectaBD($conexao);
}





 

