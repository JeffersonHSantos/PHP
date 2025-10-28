<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css">

<BODY>
   <?php
      $get1 = filter_input(INPUT_GET, "var_num");
      $get2 = filter_input(INPUT_GET, "var_codProd");
      $get3 = filter_input(INPUT_GET, "var_nomeProd");
      $get4 = filter_input(INPUT_GET, "var_Quantidade");
   ?>

   <b><font color="#0000FF">Tela de Edição de ITENS do PEDIDO</font></b>
      </br> </br>

    <form action="itensUpdate.php" method="post">
     <input type=hidden name=tabela value="itens">

     
     <b> Pedido: </b> <input type="text" name="input_pedido" size="30" value="<?php echo $get1?>" readonly>
       </br></br>    
      
       
       <input type=hidden name="input_codigoProduto" value="<?php echo $get2?>">

     <b> Produto: </b> <input type="text" name="input_produto" size="30" value="<?php echo $get3?>" readonly>
       </br></br>

    <b> Quantidade: </b> <input type="text" name="input_quantidade" size="12" value="<?php echo $get4?>">
       </br></br>

  
    <input type="submit" value="Salvar">

   </form>

</BODY>
</HTML>
