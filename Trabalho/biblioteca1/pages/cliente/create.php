<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO cliente (cpf, nome, data_nasc, endereco, telefone) 
              VALUES (:cpf, :nome, :data_nasc, :endereco, :telefone)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':cpf', $_POST['cpf']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':data_nasc', $_POST['data_nasc']);
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
    <title>Novo Cliente - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Novo Cliente</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Clientes</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>CPF (apenas números):</label>
                    <input type="text" name="cpf" required maxlength="11" pattern="[0-9]{11}">
                </div>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="data_nasc" required>
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
