<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">

<BODY>
   <?php
   $get1 = filter_input(INPUT_GET,"var_cod");
   $get2 = filter_input(INPUT_GET,"var_titulo");
   $get3 = filter_input(INPUT_GET,"var_ano");
   $get4 = filter_input(INPUT_GET,"var_sit");
   $get5 = filter_input(INPUT_GET, "var_cat");  



   ?>
   <?php
include("../conexao/conexao.php");

// chama a função para abrir a conexão
$conexao = conectaBD();

$sql = "SELECT id_categoria, nome FROM categoria";
$categorias = mysqli_query($conexao, $sql);
?>


   <b><font color="#0000FF">Tela de Edição de LIVROS</font></b>
      </br> </br>

    <form action="../insert/insert.php" method="post">

     <input type="hidden" name="tabela" value="livro">
     <input type="hidden" name="acao" value="editar">

      <b> ID do Produto:</b> <input type="text" name="id_livro" size="6"value="<?php echo $get1?>" readonly>
      <br /><br />
      <b> Título:</b> <input type="text" name="titulo" size="30" value="<?php echo $get2?>">
      <br /><br />
      <b> Ano de publicação:</b> <input type="number" name="ano_publicacao" size="10" value="<?php echo $get3?>">
      <br /><br />

      <b>Categoria:</b><select name="id_categoria">
    <?php while ($cat = mysqli_fetch_assoc($categorias)) { ?>
        <option value="<?php echo $cat['id_categoria']; ?>" 
            <?php if ($cat['id_categoria'] == $get5) echo "selected"; ?>>
            <?php echo $cat['nome']; ?>
        </option>
    <?php } ?>
  </select><br><br>
      

      <b>Disponível</b> <input type="radio" name="situacao" value="Disponível" <?php if ($get4 == "Disponível") echo "checked"; ?>>
      <br /><br />
      <b>Emprestado</b> <input type="radio" name="situacao" value="Emprestado" <?php if ($get4 == "Emprestado") echo "checked"; ?>>
      <br /><br />
      
      

    <input type="submit" value="Salvar">
    <button type="button" onclick="history.back()">Voltar</button>
      
   </form>
   <?php desconectaBD($conexao); ?>