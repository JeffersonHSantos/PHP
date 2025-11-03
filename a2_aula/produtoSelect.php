<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css">
<BODY>
   <h2><font color="#0000FF">Lista de PRODUTOS</font></h2><br>
   <h4><a href="produto.html">Cadastrar novo PRODUTO</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>Código</b></td>
        <td><b>Nome</b></td>
        <td><b>Preço</b></td>
        <td><b>Tipo</b></td>
        <td><b>Editar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM Produto";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['codigo'];?></td>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['valor'];?></td>
                <td><?php echo $i['perecivel'];?></td>

                <td><a href="<?php echo"ProdutoFormEditar.php?var_cod=". $i['codigo']."&var_Descricao=".$i['nome']."&var_Preco=".$i['valor']."&var_tipo=".$i['perecivel']?>">Alterar</a></td>
                <td><a href="<?php echo"delete.php?var_cod=". $i['codigo']."&tabela=produto"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
