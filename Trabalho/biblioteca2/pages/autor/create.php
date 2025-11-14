<?php
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO autor (id_autor, nome, data_nasc, data_morte) 
              VALUES (:id_autor, :nome, :data_nasc, :data_morte)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_autor', $_POST['id_autor']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':data_nasc', $_POST['data_nasc']);
    
    // Data morte pode ser null
    $data_morte = !empty($_POST['data_morte']) ? $_POST['data_morte'] : null;
    $stmt->bindParam(':data_morte', $data_morte);
    
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
    <title>Novo Autor - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Novo Autor</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Autores</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>ID do Autor:</label>
                    <input type="number" name="id_autor" required>
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
                    <label>Data de Morte (opcional):</label>
                    <input type="date" name="data_morte">
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
