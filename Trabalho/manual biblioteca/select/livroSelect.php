<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">
<BODY>
   <h2><font color="#0000FF">Lista de LIVROS</font></h2><br>
   <h4><a href="../insert/livro.html">Cadastrar novo LIVRO</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>ID</b></td>
        <td><b>Título</b></td>
        <td><b>Ano da Publicação</b></td>
        <td><b>Situação</b></td>
        <td><b>ID da Categoria</b></td>
        <td><b>CNPJ filial</b></td>
        <td><b>Alterar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("../conexao/conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM livro";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['id_livro'];?></td>
                <td><?php echo $i['titulo'];?></td>
                <td><?php echo $i['ano_publicacao'];?></td>
                <td><?php echo $i['situacao'];?></td>
                <td><?php echo $i['id_categoria'];?></td>
                <td><?php echo $i['cnpj_filial'];?></td>

                <td><a href="<?php echo"../update/LivroFormEditar.php?var_cod=". $i['id_livro']."&var_titulo=".$i['titulo']."&var_ano=".$i['ano_publicacao']."&var_sit=".$i['situacao']."&var_cat=".$i['id_categoria']?>">Alterar</a></td>
                <td><a href="<?php echo"../delete/delete.php?var_cod=". $i['id_livro']."&tabela=livro"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
