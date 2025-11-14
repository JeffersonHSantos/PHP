<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar autores e livros para select
$queryAutor = "SELECT * FROM autor ORDER BY nome";
$stmtAutor = $db->prepare($queryAutor);
$stmtAutor->execute();

$queryLivro = "SELECT * FROM livro ORDER BY titulo";
$stmtLivro = $db->prepare($queryLivro);
$stmtLivro->execute();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "INSERT INTO autorlivro (id_livro, id_autor, participacao) 
              VALUES (:id_livro, :id_autor, :participacao)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_livro', $_POST['id_livro']);
    $stmt->bindParam(':id_autor', $_POST['id_autor']);
    $stmt->bindParam(':participacao', $_POST['participacao']);
    
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
    <title>Novo Relacionamento Autor-Livro - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Relacionamento Autor-Livro</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Autor-Livro</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>Livro:</label>
                    <select name="id_livro" required>
                        <option value="">Selecione...</option>
                        <?php while ($livro = $stmtLivro->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $livro['id_livro'] ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Autor:</label>
                    <select name="id_autor" required>
                        <option value="">Selecione...</option>
                        <?php while ($autor = $stmtAutor->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $autor['id_autor'] ?>"><?= htmlspecialchars($autor['nome']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Participação:</label>
                    <select name="participacao" required>
                        <option value="">Selecione...</option>
                        <option value="Principal">Principal</option>
                        <option value="Coautor">Coautor</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
