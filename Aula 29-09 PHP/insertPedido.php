<?php   
    $codPed =      $_POST  ["cod"];
    $dataPed =     $_POST  ["data"];
    $valorPed =    $_POST  ["valor"];
    $vendPed =     $_POST  ["vendedor"];

    //conectar com o Servidor de BD
    $conexao = mysqli_connect("localhost", "root", "", 'baseteste');
    if(!$conexao){
        die("Conexão falhou!".mysqli_connect_error());
    }else{
        echo"Conexão realizada com sucesso!";
    }

    //Comando de inserção

    $sql = "INSERT INTO pedido(numero,data,valor,codVendedor)VALUES({$codPed},'{$dataPed}',{$valorPed},'{$vendPed}')";
    mysqli_query($conexao,$sql);

    echo"Gravando os dados...";

    // desconectar do banco de dados
    mysqli_close($conexao);
?>

<h3><a href="produtoSelect.php">LISTAR PRODUTOS</a></h3>
<h3><a href="pedido.php">CONTINUAR CADASTRANDO PEDIDO</a></h3>
