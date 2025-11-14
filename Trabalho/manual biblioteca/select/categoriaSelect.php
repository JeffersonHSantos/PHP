<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">
<BODY>
   <h2><font color="#0000FF">Lista de Categorias</font></h2><br>
   <h4><a href="../insert/categoria.html">Cadastrar nova Categoria</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>ID</b></td>
        <td><b>Nome</b></td>
        <td><b>Descrição</b></td>
        <td><b>Alterar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("../conexao/conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM categoria";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['id_categoria'];?></td>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['descricao'];?></td>

                <td><a href="<?php echo"../update/CategoriaFormEditar.php?var_cod=". $i['id_categoria']."&var_nome=".$i['nome']."&var_desc=".$i['descricao']?>">Alterar</a></td>
                <td><a href="<?php echo"../delete/delete.php?var_cod=". $i['id_categoria']."&tabela=categoria"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
