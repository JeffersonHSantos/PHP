<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO filial (cnpj, razao_social, endereco, telefone) 
              VALUES (:cnpj, :razao_social, :endereco, :telefone)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':cnpj', $_POST['cnpj']);
    $stmt->bindParam(':razao_social', $_POST['razao_social']);
    $stmt->bindParam(':endereco', $_POST['endereco']);
    $stmt->bindParam(':telefone', $_POST['telefone']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Filial - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Nova Filial</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Filiais</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>CNPJ (apenas números):</label>
                    <input type="text" name="cnpj" required maxlength="14" pattern="[0-9]{14}">
                </div>

                <div class="form-group">
                    <label>Razão Social:</label>
                    <input type="text" name="razao_social" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Endereço:</label>
                    <input type="text" name="endereco" maxlength="255">
                </div>

                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" maxlength="20">
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
