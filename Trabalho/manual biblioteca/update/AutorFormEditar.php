<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../css/style.css">

<BODY>
   <?php
   $get1 = filter_input(INPUT_GET,"var_cod");
   $get2 = filter_input(INPUT_GET,"var_nome");
   $get3 = filter_input(INPUT_GET,"var_nasc");
   $get4 = filter_input(INPUT_GET,"var_morte");   



   ?>

   <b><font color="#0000FF">Tela de Edição de Autores</font></b>
      </br> </br>

    <form action="../insert/insert.php" method="post">

     <input type=hidden name=tabela value="autor">

      <b> ID do Autor:</b> <input type="text" name="id_autor" size="6"value="<?php echo $get1?>" readonly>
      <br /><br />
      <b> Nome:</b> <input type="text" name="nome" size="30" value="<?php echo $get2?>">
      <br /><br />
      <b> Data de Nascimento:</b> <input type="date" name="data_nasc" size="10" value="<?php echo $get3?>">
      <br /><br />
      <b> Data da Morte:</b> <input type="date" name="data_morte" size="10" value="<?php echo $get4?>">
      <br /><br />
     
      
      
      

    <input type="submit" value="Salvar">
    <button type="button" onclick="history.back()">Voltar</button>

   </form>