<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8"/>
<link rel="stylesheet" href="style.css">

<BODY>
  <h3>
    <font color="#0000FF">Lista de PEDIDOS</font>
  </h3>


  <table border="1">
    <h2><a href="home.html">HOME</a></h2> 
    <h4><a href="pedido.php">CADASTRAR NOVO PEDIDO</a></h4>

    <tr>
      <td><b>Numero</b></td>
      <td><b>Data</b></td>
      <td><b>Valor</b></td>
      <td><b>Vendedor</b></td>
      <td><b>Excluir</b></td>
      <td><b>Editar</b></td>
      <td><b>Itens do Pedido</b></td>
    </tr>

    <?php
    // cria conexão
    $conexao = mysqli_connect("localhost", "root", "", "baseTeste");
    if (!$conexao) {
      die("Conexão falhou! " . mysqli_connect_error());
    } else {
      echo "Conexão realizada!";
    }

    //Comando de inserção
    
    $sql = "SELECT * FROM Pedido order by data";
    $resultado = mysqli_query($conexao, $sql);

    while ($i = mysqli_fetch_assoc($resultado)) {
      ?>
      <tr>
        <td><?php echo "$i[numero]"; ?></td>
        <td><?php echo date("d/m/Y", strtotime($i['data'])); ?></td>
        <td><?php echo "$i[valor]"; ?></td>
        <td><?php echo "$i[codVendedor]"; ?></td>

        <td><a href="<?php echo "pedidoDelete.php?var_num=" . $i['numero'] . "&tabela=pedido" ?>">Excluir</a></td>
        <td><a href="<?php echo "pedidoFormEditar.php?var_num=" . $i['numero'] . "&var_data=" . $i['data'] . "&var_valor=" . $i['valor'] . "&var_vend=" . $i['codVendedor'] ?>">Alterar</a></td>
        <td><a href="<?php echo "itensSelect.php?var_num=" . $i['numero'] . "&tabela=itens"?>"> Itens do Pedido</a></td>

      </tr>
      <?php
    }
    ?>
  </table>

  

  <?php
  // encerra conexão
  mysqli_close($conexao);
  ?>

</BODY>

</HTML>