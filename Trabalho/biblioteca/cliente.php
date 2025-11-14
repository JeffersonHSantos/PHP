<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Clientes</title>
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
if(isset($_POST['cpf']) && $_POST['acao'] == 'cadastrar'){
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    
    $sql = "INSERT INTO cliente (cpf, nome, data_nasc, endereco, telefone) 
            VALUES ('$cpf', '$nome', '$data_nasc', '$endereco', '$telefone')";
    mysqli_query($conexao, $sql);
}

// EDIÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    $cpf = $_GET['cpf'];
    $result = mysqli_query($conexao, "SELECT * FROM cliente WHERE cpf = '$cpf'");
    $row = mysqli_fetch_assoc($result);
}

// ATUALIZAÇÃO
if(isset($_POST['cpf']) && $_POST['acao'] == 'atualizar'){
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    
    $sql = "UPDATE cliente SET nome='$nome', data_nasc='$data_nasc', 
            endereco='$endereco', telefone='$telefone' WHERE cpf='$cpf'";
    mysqli_query($conexao, $sql);
}

// REMOÇÃO
if(isset($_GET['acao']) && $_GET['acao'] == 'remover'){
    $cpf = $_GET['cpf'];
    mysqli_query($conexao, "DELETE FROM cliente WHERE cpf = '$cpf'");
}
?>

<div class="container">
    <a href="index.html" class="back">← Voltar ao Menu</a>
    <h3><?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'Editar' : 'Cadastrar'; ?> Cliente</h3>
    
    <!-- FORMULÁRIO -->
    <form action="cliente.php" method="POST">
        <input type="hidden" name="acao" value="<?php echo isset($_GET['acao']) && $_GET['acao'] == 'editar' ? 'atualizar' : 'cadastrar'; ?>">
        
        <br>CPF: 
        <input type="text" name="cpf" size="11" maxlength="11" value="<?php echo isset($row) ? $row['cpf'] : ''; ?>" <?php echo isset($row) ? 'readonly' : ''; ?> required>
        
        <br>Nome: 
        <input type="text" name="nome" size="40" value="<?php echo isset($row) ? $row['nome'] : ''; ?>" required>
        
        <br>Data Nascimento: 
        <input type="date" name="data_nasc" value="<?php echo isset($row) ? $row['data_nasc'] : ''; ?>" required>
        
        <br>Endereço: 
        <textarea name="endereco"><?php echo isset($row) ? $row['endereco'] : ''; ?></textarea>
        
        <br>Telefone: 
        <input type="text" name="telefone" size="15" value="<?php echo isset($row) ? $row['telefone'] : ''; ?>">
        
        <br><br><button type="submit"><?php echo isset($row) ? 'Atualizar' : 'Cadastrar'; ?></button>
    </form>
    
    <h3>Clientes Cadastrados</h3>
    
    <!-- LISTAGEM -->
    <table>
        <tr>
            <th>CPF</th>
            <th>Nome</th>
            <th>Data Nascimento</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM cliente ORDER BY nome";
        $resultado = mysqli_query($conexao, $sql);
        
        while($row = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['data_nasc'])) . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "<td>
                    <a href='?acao=editar&cpf=" . $row['cpf'] . "'>Editar</a>
                    <a href='?acao=remover&cpf=" . $row['cpf'] . "' onclick='return confirm(\"Confirma exclusão?\")'>Remover</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<?php mysqli_close($conexao); ?>
</body>
</html>
