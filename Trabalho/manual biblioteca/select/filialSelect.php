<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">
<BODY>
   <h2><font color="#0000FF">Lista de Filiais</font></h2><br>
   <h4><a href="../insert/filial.html">Cadastrar nova Filial</a></h4>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>CNPJ</b></td>
        <td><b>Razão Social</b></td>
        <td><b>Endereço</b></td>
        <td><b>Telefone</b></td>
        <td><b>Alterar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
            include_once("../conexao/conexao.php");
            $conn = conectaBD();

            $produtos = "SELECT * FROM filial";
            $resultado = mysqli_query($conn, $produtos);

            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $i['cnpj']); ?></td>
                <td><?php echo $i['razao_social'];?></td>
                <td><?php echo $i['endereco'];?></td>
                <td><?php echo $i['telefone'];?></td>

                <td><a href="<?php echo"../update/FilialFormEditar.php?var_cod=".$i['cnpj']."&var_razao=".$i['razao_social']."&var_end=".$i['endereco']."&var_tel=".$i['telefone']?>">Alterar</a></td>
                <td><a href="<?php echo"../delete/delete.php?var_cod=". $i['cnpj']."&tabela=filial"?>">Excluir</a></td>
             </tr>
            <?php
           }
            ?>
     </table>

     

</BODY>
</HTML>
