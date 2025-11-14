<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE categoria SET nome = :nome, descricao = :descricao 
              WHERE id_categoria = :id_categoria";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_categoria', $_POST['id_categoria']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':descricao', $_POST['descricao']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados da categoria
$query = "SELECT * FROM categoria WHERE id_categoria = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$categoria = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Categoria</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Categorias</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">

                <div class="form-group">
                    <label>ID da Categoria:</label>
                    <input type="number" value="<?= $categoria['id_categoria'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required maxlength="50">
                </div>

                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="descricao" maxlength="255"><?= htmlspecialchars($categoria['descricao']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
