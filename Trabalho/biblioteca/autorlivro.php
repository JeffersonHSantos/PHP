<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Relação Autor-Livro</title>
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
if(isset($_POST['id_livro']) && $_POST['acao'] == 'cadastrar'){
    $id_livro = $_POST['id_livro'];
    $id_autor = $_POST['id_autor'];
    $participacao = $_POST['participacao'];
    
    $sql = "INSERT INTO autorlivro (id_livro, id_autor, participacao) 
            VALUES ('$id_livro', '$id_autor', '$participacao')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $id_livro = $_GET['id_livro'];
    $id_autor = $_GET['id_autor'];
    $result = mysqli_query($conexao, "SELECT * FROM autorlivro WHERE id_livro = '$id_livro' AND id_autor = '$id_autor'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['id_livro']) && $_POST['acao'] == 'atualizar'){
    $id_livro = $_POST['id_livro'];
    $id_autor = $_POST['id_autor'];
    $participacao = $_POST['participacao'];
    
    $sql = "UPDATE autorlivro SET participacao='$participacao' 
            WHERE id_livro='$id_livro' AND id_autor='$id_autor'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $id_livro = $_GET['id_livro'];
    $id_autor = $_GET['id_autor'];
    mysqli_query($conexao, "DELETE FROM autorlivro WHERE id_livro = '$id_livro' AND id_autor = '$id_autor'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Relação Autor-Livro</h3>
    
    <!-- FORMULÁRIO -->
    <form action="autorlivro.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        
        <br>Livro: 
        <select name="id_livro" <?php echo isset($row) ? 'readonly onclick="return false;"' : ''; ?> required>
            <option value="">Selecione</option>
            <?php
            $livros = mysqli_query($conexao, "SELECT * FROM livro ORDER BY titulo");
            while($liv = mysqli_fetch_assoc($livros)){
                $selected = (isset($row) && $row['id_livro'] == $liv['id_livro']) ? 'selected' : '';
                echo "<option value='" . $liv['id_livro'] . "' $selected>" . $liv['titulo'] . "</option>";
            }
            ?>
        </select>
        
        <br>Autor: 
        <select name="id_autor" <?php echo isset($row) ? 'readonly onclick="return false;"' : ''; ?> required>
            <option value="">Selecione</option>
            <?php
            $autores = mysqli_query($conexao, "SELECT * FROM autor ORDER BY nome");
            while($aut = mysqli_fetch_assoc($autores)){
                $selected = (isset($row) && $row['id_autor'] == $aut['id_autor']) ? 'selected' : '';
                echo "<option value='" . $aut['id_autor'] . "' $selected>" . $aut['nome'] . "</option>";
            }
            ?>
        </select>
        
        <br>Participação: 
        <select name="participacao" required>
            <option value="">Selecione</option>
            <option value="Principal" <?php echo (isset($row) && $row['participacao'] == 'Principal') ? 'selected' : ''; ?>>Principal</option>
            <option value="Coautor" <?php echo (isset($row) && $row['participacao'] == 'Coautor') ? 'selected' : ''; ?>>Coautor</option>
        </select>
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Relações Cadastradas</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>Livro</th>
            <th>Autor</th>
            <th>Participação</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT al.*, l.titulo as livro_titulo, a.nome as autor_nome 
                FROM autorlivro al 
                INNER JOIN livro l ON al.id_livro = l.id_livro
                INNER JOIN autor a ON al.id_autor = a.id_autor
                ORDER BY l.titulo, a.nome";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['livro_titulo'] . "</td>";
            echo "<td>" . $row['autor_nome'] . "</td>";
            echo "<td>" . $row['participacao'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&id_livro=" . $row['id_livro'] . "&id_autor=" . $row['id_autor'] . "'>Editar</a>
                    <a href='?acao=remover&id_livro=" . $row['id_livro'] . "&id_autor=" . $row['id_autor'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
