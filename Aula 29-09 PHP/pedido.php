<!DOCTYPE HTML>
<HTML>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css">

<BODY>
    <h3>
        <font color="#0000FF">Cadastro de Pedidos</font>
    </h3>
    <h2><a href="home.html">HOME</a></h2>
    <h3><a href="produtoSelect.php">LISTAR PRODUTOS</a></h3>
    <h3><a href="pedidoSelect.php">LISTAR PEDIDOS</a></h3>
    <h3><a href="produto.html">CADASTRAR NOVO PRODUTO</a></h3>
    <form action="insertPedido.php" method="post">
        <b> Código:</b> <input type="text" name="cod" size="3">
        <br /><br />
        <b> Data:</b> <input type="date" name="data" size="30">
        <br /><br />
        <b> Valor:</b> <input type="text" name="valor" size="10">
        <br /><br />
        <b> Vendedor:</b>

        <select name="vendedor">
            <option> Selecione </option>
            <?php
            //conectar com Servidor de BD
            $conexao = mysqli_connect(
                "localhost",
                "root",
                "",
                "baseteste"
            );
            if (!$conexao) {
                die("Conexão falhou!" . mysqli_connect_error());
            } else {
                echo "Conexão realizada com sucesso!";
            }
            $sql = "SELECT codigo,nome FROM Vendedor
               order by nome";
            $resultado = mysqli_query($conexao, $sql);

            while ($i = mysqli_fetch_assoc($resultado)) {
                ?>
                <option value="<?php echo $i['codigo']; ?>">
                    <?php echo $i['nome']; ?>
                </option>
            <?php }
            mysqli_close($conexao);

            ?>
        </select>
        <br /><br />
        <input type="reset" value="Cancelar"> <input type="submit" value="Cadastrar">

    </form>
</BODY>

</HTML>