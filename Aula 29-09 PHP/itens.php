<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css">

<BODY>
   <b><font color="#0000FF">Cadastro de ITENS do PEDIDO</font></b>
      </br> </br>

    <form action="itensInsert.php" method="post">

    <input type=hidden name=tabela value="itens">

    <?php
        $get1 = filter_input(INPUT_GET, "var_num");

        $conexao= mysqli_connect("localhost", "root", "", "baseTeste");
        if(!$conexao){
            die("Conexão falhou! ".mysqli_connect_error());
        }else{
            //echo "Conexão realizada!";
        }

        $select = "SELECT p.numero, v.nome, p.data FROM pedido p inner join vendedor v ON p.codVendedor = v.codigo WHERE p.numero = $get1";
        echo $select;

        $resultado = mysqli_query($conexao, $select);
        $i = mysqli_fetch_assoc($resultado);
        echo "<br> <br>";
        echo "Itens do Pedido: <strong>".$i['numero']." (Vendedor: ".$i['nome'].")"."</strong>";
        echo "<br> <br>";
    ?>

     <input type=hidden name="input_numpedido" value="<?php echo $get1?>">

    <label>
    <b> Produto </b> 
      <select name="input_codproduto">
        <option>Selecione</option>
        <?php
        
            $select = "SELECT * FROM produto order by nome";
            $resultado = mysqli_query($conexao, $select);

            while($i = mysqli_fetch_assoc($resultado)){
            ?>
             <option value="<?php echo $i['codigo'];?>">
                            <?php echo $i['nome'];?>
             </option> 
        <?php
           }
        mysqli_close($conexao);   
        ?>
          </select>    
       </br
    </label>
 
    </br>
     <b> Quantidade: </b> <input type="text" name="input_quantidade" size="12">
      </br></br>

    </br></br>
    <input type="reset" value="Cancelar">   <input type="submit" value="Cadastrar">

   </form>

</BODY>
</HTML>
