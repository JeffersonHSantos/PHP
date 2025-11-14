<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Livros</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h3 { color: #333; }
        form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        input, select { padding: 8px; margin: 5px 0; }
        input[type="text"], input[type="number"] { width: 200px; }
        select { width: 218px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
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
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano_publicacao'];
    $situacao = $_POST['situacao'];
    $categoria = $_POST['id_categoria'];
    $filial = $_POST['cnpj_filial'];
    
    $sql = "INSERT INTO livro (id_livro, titulo, ano_publicacao, situacao, id_categoria, cnpj_filial) 
            VALUES ('$id', '$titulo', '$ano', '$situacao', '$categoria', '$filial')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $id = $_GET['id'];
    $result = mysqli_query($conexao, "SELECT * FROM livro WHERE id_livro = '$id'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['cod']) && $_POST['acao'] == 'atualizar'){
    $id = $_POST['cod'];
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano_publicacao'];
    $situacao = $_POST['situacao'];
    $categoria = $_POST['id_categoria'];
    $filial = $_POST['cnpj_filial'];
    
    $sql = "UPDATE livro SET titulo='$titulo', ano_publicacao='$ano', situacao='$situacao', 
            id_categoria='$categoria', cnpj_filial='$filial' WHERE id_livro='$id'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $id = $_GET['id'];
    mysqli_query($conexao, "DELETE FROM livro WHERE id_livro = '$id'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Livro</h3>
    
    <!-- FORMULÁRIO -->
    <form action="livro.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        
        <br>Código: 
        <input type="text" name="cod" size="3" value="<?php echo isset($row) ? $row['id_livro'] : ''; ?>" <?php echo isset($row) ? 'readonly' : ''; ?> required>
        
        <br>Título: 
        <input type="text" name="titulo" size="50" value="<?php echo isset($row) ? $row['titulo'] : ''; ?>" required>
        
        <br>Ano Publicação: 
        <input type="number" name="ano_publicacao" min="1900" max="2099" value="<?php echo isset($row) ? $row['ano_publicacao'] : ''; ?>">
        
        <br>Situação: 
        <select name="situacao" required>
            <option value="">Selecione</option>
            <option value="Disponível" <?php echo (isset($row) && $row['situacao'] == 'Disponível') ? 'selected' : ''; ?>>Disponível</option>
            <option value="Emprestado" <?php echo (isset($row) && $row['situacao'] == 'Emprestado') ? 'selected' : ''; ?>>Emprestado</option>
        </select>
        
        <br>Categoria: 
        <select name="id_categoria" required>
            <option value="">Selecione</option>
            <?php
            $categorias = mysqli_query($conexao, "SELECT * FROM categoria ORDER BY nome");
            while($cat = mysqli_fetch_assoc($categorias)){
                $selected = (isset($row) && $row['id_categoria'] == $cat['id_categoria']) ? 'selected' : '';
                echo "<option value='" . $cat['id_categoria'] . "' $selected>" . $cat['nome'] . "</option>";
            }
            ?>
        </select>
        
        <br>Filial: 
        <select name="cnpj_filial" required>
            <option value="">Selecione</option>
            <?php
            $filiais = mysqli_query($conexao, "SELECT * FROM filial ORDER BY razao_social");
            while($fil = mysqli_fetch_assoc($filiais)){
                $selected = (isset($row) && $row['cnpj_filial'] == $fil['cnpj']) ? 'selected' : '';
                echo "<option value='" . $fil['cnpj'] . "' $selected>" . $fil['razao_social'] . "</option>";
            }
            ?>
        </select>
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Livros Cadastrados</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Ano</th>
            <th>Situação</th>
            <th>Categoria</th>
            <th>Filial</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT l.*, c.nome as categoria_nome, f.razao_social as filial_nome 
                FROM livro l 
                INNER JOIN categoria c ON l.id_categoria = c.id_categoria
                INNER JOIN filial f ON l.cnpj_filial = f.cnpj
                ORDER BY l.titulo";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['id_livro'] . "</td>";
            echo "<td>" . $row['titulo'] . "</td>";
            echo "<td>" . $row['ano_publicacao'] . "</td>";
            echo "<td>" . $row['situacao'] . "</td>";
            echo "<td>" . $row['categoria_nome'] . "</td>";
            echo "<td>" . $row['filial_nome'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&id=" . $row['id_livro'] . "'>Editar</a>
                    <a href='?acao=remover&id=" . $row['id_livro'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
