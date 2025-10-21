<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8" />

<BODY>
  <h1>
    <font color="#0000FF">Lista de PRODUTOS</font>
  </h1>

  <table border="1">
    <h2><a href="home.html">HOME</a></h2> 
    <h4><a href="produto.html">CADASTRAR NOVO PRODUTO</a></h4>
  
    <tr>
      <td><b>Código</b></td>
      <td><b>Nome</b></td>
      <td><b>Valor</b></td>
      <td><b>Tipo</b></td>
      <td><b>Excluir</b></td>
      <td><b>Editar</b></td>
    </tr>

    <?php
    // cria conexão
    $conexao = mysqli_connect("localhost", "root", "", "baseTeste");
    if (!$conexao) {
      die("Conexão falhou! " . mysqli_connect_error());
    } else {
      echo "Conexão realizada!";
    }

    $sql = "SELECT * FROM Produto order by codigo";
    $resultado = mysqli_query($conexao, $sql);

    while ($i = mysqli_fetch_assoc($resultado)) {
      ?>

      <tr>
        <td><?php echo "$i[codigo]"; ?></td>
        <td><?php echo "$i[nome]"; ?></td>
        <td><?php echo "$i[valor]"; ?></td>
        <td><?php echo "$i[perecivel]"; ?></td>
        <td><a href="<?php echo "delete.php?var-cod=" . $i['codigo'] ?>">Excluir</a></td>
        <td><a href="<?php echo "produtoFormEditar.php?var-cod=" . $i['codigo'] . "&var-nome=" . $i['nome'] . "&var-valor=" . $i['valor'] . "&var-perecivel=" . $i['perecivel'] ?>">Editar</a>
        </td>

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