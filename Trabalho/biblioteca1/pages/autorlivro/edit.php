<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Deletar o registro antigo
    $queryDelete = "DELETE FROM autorlivro WHERE id_livro = :id_livro_old AND id_autor = :id_autor_old";
    $stmtDelete = $db->prepare($queryDelete);
    $stmtDelete->bindParam(':id_livro_old', $_POST['id_livro_old']);
    $stmtDelete->bindParam(':id_autor_old', $_POST['id_autor_old']);
    $stmtDelete->execute();
    
    // Inserir o novo registro com participação atualizada
    $query = "INSERT INTO autorlivro (id_livro, id_autor, participacao) 
              VALUES (:id_livro, :id_autor, :participacao)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_livro', $_POST['id_livro_old']);
    $stmt->bindParam(':id_autor', $_POST['id_autor_old']);
    $stmt->bindParam(':participacao', $_POST['participacao']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados do relacionamento
$query = "SELECT al.*, a.nome as autor_nome, l.titulo as livro_titulo 
          FROM autorlivro al
          INNER JOIN autor a ON al.id_autor = a.id_autor
          INNER JOIN livro l ON al.id_livro = l.id_livro
          WHERE al.id_livro = :id_livro AND al.id_autor = :id_autor";
$stmt = $db->prepare($query);
$stmt->bindParam(':id_livro', $_GET['id_livro']);
$stmt->bindParam(':id_autor', $_GET['id_autor']);
$stmt->execute();
$autorlivro = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relacionamento - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Relacionamento Autor-Livro</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Autor-Livro</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="id_livro_old" value="<?= $autorlivro['id_livro'] ?>">
                <input type="hidden" name="id_autor_old" value="<?= $autorlivro['id_autor'] ?>">

                <div class="form-group">
                    <label>Livro:</label>
                    <input type="text" value="<?= htmlspecialchars($autorlivro['livro_titulo']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Autor:</label>
                    <input type="text" value="<?= htmlspecialchars($autorlivro['autor_nome']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Participação:</label>
                    <select name="participacao" required>
                        <option value="Principal" <?= $autorlivro['participacao'] == 'Principal' ? 'selected' : '' ?>>Principal</option>
                        <option value="Coautor" <?= $autorlivro['participacao'] == 'Coautor' ? 'selected' : '' ?>>Coautor</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
