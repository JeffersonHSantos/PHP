<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Categorias</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f4f4f4; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h3 { color: #333; }
        form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        input, textarea { padding: 8px; margin: 5px 0; }
        input[type="text"] { width: 200px; }
        textarea { width: 400px; height: 60px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
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
if(isset($_POST['cod']) && $_POST['acao'] == 'cadastrar'){
    $id = $_POST['cod'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    
    $sql = "INSERT INTO categoria (id_categoria, nome, descricao) VALUES ('$id', '$nome', '$descricao')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $id = $_GET['id'];
    $result = mysqli_query($conexao, "SELECT * FROM categoria WHERE id_categoria = '$id'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['cod']) && $_POST['acao'] == 'atualizar'){
    $id = $_POST['cod'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    
    $sql = "UPDATE categoria SET nome='$nome', descricao='$descricao' WHERE id_categoria='$id'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $id = $_GET['id'];
    mysqli_query($conexao, "DELETE FROM categoria WHERE id_categoria = '$id'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Categoria</h3>
    
    <!-- FORMULÁRIO -->
    <form action="categoria.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        
        <br>Código: 
        <input type="text" name="cod" size="3" value="<?php echo isset($row) ? $row['id_categoria'] : ''; ?>" <?php echo isset($row) ? 'readonly' : ''; ?> required>
        
        <br>Nome: 
        <input type="text" name="nome" size="30" value="<?php echo isset($row) ? $row['nome'] : ''; ?>" required>
        
        <br>Descrição: 
        <textarea name="descricao"><?php echo isset($row) ? $row['descricao'] : ''; ?></textarea>
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Categorias Cadastradas</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM categoria ORDER BY nome";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['id_categoria'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&id=" . $row['id_categoria'] . "'>Editar</a>
                    <a href='?acao=remover&id=" . $row['id_categoria'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
