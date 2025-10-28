<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<BODY>
   <link rel="stylesheet" href="style.css">

   <?php
      $get1 = filter_input(INPUT_GET, "var_num");
      $get2 = filter_input(INPUT_GET, "var_codProd");
      $get3 = filter_input(INPUT_GET, "var_nomeProd");
      $get4 = filter_input(INPUT_GET, "var_Quantidade");
   ?>

   <b><font color="#0000FF">Tela de Edição de PEDIDOS</font></b>
      </br> </br>

    <form action="pedidoUpdate.php" method="post">
     <input type=hidden name=tabela value="pedido">

      <b> Número:</b> <input type="text" name="numero" size="8" value="" readonly>
       <br /><br/>

      <b> Data:</b> <input type="date" name="data" size="16" value="">
       <br /><br/>

      <b> Valor:</b> <input type="text" name="valor" size="16" value="">
       <br /><br/>

      <b> Vendedor:</b> <input type="text" name="vendedor" size="8" value="">
       <br /><br/>


    <input type="submit" value="Salvar">

   </form>

</BODY>
</HTML>