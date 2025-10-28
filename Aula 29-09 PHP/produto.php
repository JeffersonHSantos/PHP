<link rel="stylesheet" href="style.css">

<?php   
    $codProd =      $_POST  ["cod"];
    $nomeProd =     $_POST  ["nome"];
    $valorProd =    $_POST  ["valor"];
    $tipoProd =     $_POST  ["per"];

    //conectar com o Servidor de BD
    $conexao = mysqli_connect("localhost", "root", "", 'baseteste');
    if(!$conexao){
        die("Conexão falhou!".mysqli_connect_error());
    }else{
        echo"Conexão realizada com sucesso!";
    }

    //Comando de inserção

    $sql = "INSERT INTO produto(codigo,nome,valor,perecivel)VALUES({$codProd},'{$nomeProd}',{$valorProd},'{$tipoProd}')";
    mysqli_query($conexao,$sql);

    echo"Gravando os dados...";

    // desconectar do banco de dados
    mysqli_close($conexao);
?>

<h3><a href="produtoSelect.php">LISTAR PRODUTOS</a></h3>
<h3><a href="produto.html">CONTINUAR CADASTRANDO</a></h3>
