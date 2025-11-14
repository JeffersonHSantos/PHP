<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Empréstimos de Livros</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h3 { color: #333; }
        form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        input, select { padding: 8px; margin: 5px 0; width: 218px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        tr:hover { background: #f5f5f5; }
        a { color: #007bff; text-decoration: none; margin: 0 5px; }
        a:hover { text-decoration: underline; }
        .back { display: inline-block; margin-bottom: 15px; padding: 8px 15px; background: #6c757d; color: white; border-radius: 5px; }
    </style>
</head>
<body>
<?php
include "conexao.php";

// INSERÇÃO
if(isset($_POST['cpf_cliente']) && $_POST['acao'] == 'cadastrar'){
    $cpf_cliente = $_POST['cpf_cliente'];
    $id_livro = $_POST['id_livro'];
    
    $sql = "INSERT INTO clientelivro (cpf_cliente, id_livro) VALUES ('$cpf_cliente', '$id_livro')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $id = $_GET['id'];
    $result = mysqli_query($conexao, "SELECT * FROM clientelivro WHERE id_clientelivro = '$id'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['id_clientelivro']) && $_POST['acao'] == 'atualizar'){
    $id = $_POST['id_clientelivro'];
    $cpf_cliente = $_POST['cpf_cliente'];
    $id_livro = $_POST['id_livro'];
    
    $sql = "UPDATE clientelivro SET cpf_cliente='$cpf_cliente', id_livro='$id_livro' 
            WHERE id_clientelivro='$id'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $id = $_GET['id'];
    mysqli_query($conexao, "DELETE FROM clientelivro WHERE id_clientelivro = '$id'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Empréstimo</h3>
    
    <!-- FORMULÁRIO -->
    <form action="clientelivro.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        <?php if(isset($row)){ ?>
            <input type="hidden" name="id_clientelivro" value="<?php echo $row['id_clientelivro']; ?>">
        <?php } ?>
        
        <br>Cliente: 
        <select name="cpf_cliente" required>
            <option value="">Selecione</option>
            <?php
            $clientes = mysqli_query($conexao, "SELECT * FROM cliente ORDER BY nome");
            while($cli = mysqli_fetch_assoc($clientes)){
                $selected = (isset($row) && $row['cpf_cliente'] == $cli['cpf']) ? 'selected' : '';
                echo "<option value='" . $cli['cpf'] . "' $selected>" . $cli['nome'] . "</option>";
            }
            ?>
        </select>
        
        <br>Livro: 
        <select name="id_livro" required>
            <option value="">Selecione</option>
            <?php
            $livros = mysqli_query($conexao, "SELECT * FROM livro ORDER BY titulo");
            while($liv = mysqli_fetch_assoc($livros)){
                $selected = (isset($row) && $row['id_livro'] == $liv['id_livro']) ? 'selected' : '';
                echo "<option value='" . $liv['id_livro'] . "' $selected>" . $liv['titulo'] . "</option>";
            }
            ?>
        </select>
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Empréstimos Cadastrados</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Livro</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT cl.*, c.nome as cliente_nome, l.titulo as livro_titulo 
                FROM clientelivro cl 
                INNER JOIN cliente c ON cl.cpf_cliente = c.cpf
                INNER JOIN livro l ON cl.id_livro = l.id_livro
                ORDER BY c.nome, l.titulo";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['id_clientelivro'] . "</td>";
            echo "<td>" . $row['cliente_nome'] . "</td>";
            echo "<td>" . $row['livro_titulo'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&id=" . $row['id_clientelivro'] . "'>Editar</a>
                    <a href='?acao=remover&id=" . $row['id_clientelivro'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
