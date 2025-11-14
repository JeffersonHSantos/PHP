<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE autor SET nome = :nome, data_nasc = :data_nasc, data_morte = :data_morte 
              WHERE id_autor = :id_autor";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_autor', $_POST['id_autor']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':data_nasc', $_POST['data_nasc']);
    
    $data_morte = !empty($_POST['data_morte']) ? $_POST['data_morte'] : null;
    $stmt->bindParam(':data_morte', $data_morte);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados do autor
$query = "SELECT * FROM autor WHERE id_autor = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$autor = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Autor</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Autores</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="id_autor" value="<?= $autor['id_autor'] ?>">

                <div class="form-group">
                    <label>ID do Autor:</label>
                    <input type="number" value="<?= $autor['id_autor'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($autor['nome']) ?>" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="data_nasc" value="<?= $autor['data_nasc'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Data de Morte (opcional):</label>
                    <input type="date" name="data_morte" value="<?= $autor['data_morte'] ?>">
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
