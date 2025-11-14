<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Filiais</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        h3 { color: #333; }
        form { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        input, textarea { padding: 8px; margin: 5px 0; }
        input[type="text"] { width: 200px; }
        textarea { width: 400px; height: 60px; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
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
if(isset($_POST['cnpj']) && $_POST['acao'] == 'cadastrar'){
    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    
    $sql = "INSERT INTO filial (cnpj, razao_social, endereco, telefone) 
            VALUES ('$cnpj', '$razao_social', '$endereco', '$telefone')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $cnpj = $_GET['cnpj'];
    $result = mysqli_query($conexao, "SELECT * FROM filial WHERE cnpj = '$cnpj'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['cnpj']) && $_POST['acao'] == 'atualizar'){
    $cnpj = $_POST['cnpj'];
    $razao_social = $_POST['razao_social'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    
    $sql = "UPDATE filial SET razao_social='$razao_social', endereco='$endereco', 
            telefone='$telefone' WHERE cnpj='$cnpj'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $cnpj = $_GET['cnpj'];
    mysqli_query($conexao, "DELETE FROM filial WHERE cnpj = '$cnpj'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Filial</h3>
    
    <!-- FORMULÁRIO -->
    <form action="filial.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        
        <br>CNPJ: 
        <input type="text" name="cnpj" size="14" maxlength="14" value="<?php echo isset($row) ? $row['cnpj'] : ''; ?>" <?php echo isset($row) ? 'readonly' : ''; ?> required>
        
        <br>Razão Social: 
        <input type="text" name="razao_social" size="40" value="<?php echo isset($row) ? $row['razao_social'] : ''; ?>" required>
        
        <br>Endereço: 
        <textarea name="endereco"><?php echo isset($row) ? $row['endereco'] : ''; ?></textarea>
        
        <br>Telefone: 
        <input type="text" name="telefone" size="15" value="<?php echo isset($row) ? $row['telefone'] : ''; ?>">
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Filiais Cadastradas</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>CNPJ</th>
            <th>Razão Social</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM filial ORDER BY razao_social";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['cnpj'] . "</td>";
            echo "<td>" . $row['razao_social'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&cnpj=" . $row['cnpj'] . "'>Editar</a>
                    <a href='?acao=remover&cnpj=" . $row['cnpj'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
