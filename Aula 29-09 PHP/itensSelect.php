<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css">

<BODY>
   <b><font color="#0000FF">Atualiza ITENS DO PEDIDO</font></b>
      </br> </br>

     <table border = "1">
      <tr>
        <td><b>Produto</b></td>
        <td><b>Quantidade</b></td>
        <td><b>Editar?</b></td>
        <td><b>Excluir?</b></td>
     </tr>

       <?php
        include_once("conexao.php");
        $get1 = filter_input(INPUT_GET, "var_num");
        $conexao= conectarBD();
            

            $select = "SELECT p.numero, v.nome, p.data FROM pedido p inner join vendedor v ON p.codVendedor = v.codigo WHERE p.numero = $get1;";
            echo $select; echo "<br> <br>";
            $resultado = mysqli_query($conexao, $select);
            $i = mysqli_fetch_assoc($resultado);

            echo "Itens do Pedido: <strong>".$i['numero']." (Vendedor: ".$i['nome'].")"."</strong>";
            echo "<br> <br>";

            $select = "SELECT i.numpedido, i.codproduto, p.nome, i.qtd FROM itens i inner join produto p ON i.codproduto = p.codigo WHERE i.numpedido = $get1";
            //echo $select; echo "<br> <br>";
            $resultado = mysqli_query($conexao,$select);
            while($i = mysqli_fetch_assoc($resultado)){
        ?>
             <tr>
                <td><?php echo $i['nome'];?></td>
                <td><?php echo $i['qtd'];?></td>
                <td><a href="<?php echo"itensEditar.php?var_num=". $i['numpedido']."&var_codProd=".$i['codproduto']."&var_nomeProd=".$i['nome']."&var_Quantidade=".$i['qtd']?>">Alterar</a></td>
                <td><a href="<?php echo"itensDelete.php?var_num=". $i['numpedido']."&var_codprod=". $i['codproduto']."&tabela=itens"?>">Excluir</a></td>
             </tr>
            <?php
           }
        ?>
     </table>

     <h3><a href="<?php echo "itens.php?var_num=". $get1?>">Cadastrar novo ITEM para este PEDIDO</a></h3>
     <?php  
       desconectarBD($conexao);
     ?>
</BODY>
</HTML>
