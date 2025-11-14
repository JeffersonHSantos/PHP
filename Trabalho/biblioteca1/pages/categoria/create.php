<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO categoria (id_categoria, nome, descricao) 
              VALUES (:id_categoria, :nome, :descricao)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_categoria', $_POST['id_categoria']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':descricao', $_POST['descricao']);
    
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
    <title>Nova Categoria - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Nova Categoria</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Categorias</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>ID da Categoria:</label>
                    <input type="number" name="id_categoria" required>
                </div>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required maxlength="50">
                </div>

                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="descricao" maxlength="255"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
