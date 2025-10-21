<?php
    // cria conexão
    $conexao = mysqli_connect("localhost", "root", "", "baseTeste");
    if (!$conexao) {
      die("Conexão falhou! " . mysqli_connect_error());
    } else {
      echo "Conexão realizada!";
    }

    $cod = $_POST["cod"];
    $nom = $_POST["nome"];
    $val = $_POST["valor"];
    $tip = $_POST["tipo"];


    $sql = "UPDATE produto SET nome = '$nom', valor ='$val', perecivel ='$tip' WHERE codigo = '$cod'";

    mysqli_query($conexao, $sql);
    echo "Dados Atualizados!";

    



    // encerra conexão
  mysqli_close($conexao);

?>

<h3><a href="produtoSelect.php">LISTAR PRODUTOS</a></h3>