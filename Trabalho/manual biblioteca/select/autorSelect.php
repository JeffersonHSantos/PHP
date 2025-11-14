<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">
<BODY>
   <h2><font color="#0000FF">Lista de Autores</font></h2><br>
   <h4><a href="../insert/autor.html">Cadastrar novo Autor</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>ID</b></td>
        <td><b>Nome</b></td>
        <td><b>Data de Nascimento</b></td>
        <td><b>Data da Morte</b></td>
        <td><b>Alterar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("../conexao/conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM autor";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['id_autor'];?></td>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['data_nasc'];?></td>
                <td><?php echo empty($i['data_morte']) ? 'Vivo' : $i['data_morte']; ?></td>

                <td><a href="<?php echo"../update/AutorFormEditar.php?var_cod=". $i['id_autor']."&var_nome=".$i['nome']."&var_nasc=".$i['data_nasc']."&var_morte=".$i['data_morte']?>">Alterar</a></td>
                <td><a href="<?php echo"../delete/delete.php?var_cod=". $i['id_autor']."&tabela=autor"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
