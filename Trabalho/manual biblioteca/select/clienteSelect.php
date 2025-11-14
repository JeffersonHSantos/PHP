<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">
<BODY>
   <h2><font color="#0000FF">Lista de Clientes</font></h2><br>
   <h4><a href="../insert/categoria.html">Cadastrar novo Cliente</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>CPF</b></td>
        <td><b>Nome</b></td>
        <td><b>Data de Nascimento</b></td>
        <td><b>Endereço</b></td>
        <td><b>Telefone</b></td>
        <td><b>Alterar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("../conexao/conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM cliente";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $i['cpf']); ?></td>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['data_nasc'];?></td>
                <td><?php echo $i['endereco'];?></td>
                <td><?php echo $i['telefone'];?></td>

                <td><a href="<?php echo"../update/ClienteFormEditar.php?var_cod=".$i['cpf']."&var_nome=".$i['nome']."&var_nasc=".$i['data_nasc']."&var_end=".$i['endereco']."&var_tel=".$i['telefone']?>">Alterar</a></td>
                <td><a href="<?php echo"../delete/delete.php?var_cod=". $i['cpf']."&tabela=cliente"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
