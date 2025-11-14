<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar categorias e filiais para select
$queryCategoria = "SELECT * FROM categoria ORDER BY nome";
$stmtCategoria = $db->prepare($queryCategoria);
$stmtCategoria->execute();

$queryFilial = "SELECT * FROM filial ORDER BY razao_social";
$stmtFilial = $db->prepare($queryFilial);
$stmtFilial->execute();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE livro SET titulo = :titulo, ano_publicacao = :ano_publicacao, 
              situacao = :situacao, id_categoria = :id_categoria, cnpj_filial = :cnpj_filial 
              WHERE id_livro = :id_livro";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id_livro', $_POST['id_livro']);
    $stmt->bindParam(':titulo', $_POST['titulo']);
    $stmt->bindParam(':ano_publicacao', $_POST['ano_publicacao']);
    $stmt->bindParam(':situacao', $_POST['situacao']);
    $stmt->bindParam(':id_categoria', $_POST['id_categoria']);
    $stmt->bindParam(':cnpj_filial', $_POST['cnpj_filial']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados do livro
$query = "SELECT * FROM livro WHERE id_livro = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$livro = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Livro</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Livros</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="id_livro" value="<?= $livro['id_livro'] ?>">

                <div class="form-group">
                    <label>ID do Livro:</label>
                    <input type="number" value="<?= $livro['id_livro'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required maxlength="150">
                </div>

                <div class="form-group">
                    <label>Ano de Publicação:</label>
                    <input type="number" name="ano_publicacao" value="<?= $livro['ano_publicacao'] ?>" min="1000" max="9999">
                </div>

                <div class="form-group">
                    <label>Situação:</label>
                    <select name="situacao" required>
                        <option value="Disponível" <?= $livro['situacao'] == 'Disponível' ? 'selected' : '' ?>>Disponível</option>
                        <option value="Emprestado" <?= $livro['situacao'] == 'Emprestado' ? 'selected' : '' ?>>Emprestado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Categoria:</label>
                    <select name="id_categoria" required>
                        <?php while ($cat = $stmtCategoria->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $cat['id_categoria'] ?>" <?= $livro['id_categoria'] == $cat['id_categoria'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['nome']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Filial:</label>
                    <select name="cnpj_filial" required>
                        <?php while ($fil = $stmtFilial->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $fil['cnpj'] ?>" <?= $livro['cnpj_filial'] == $fil['cnpj'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($fil['razao_social']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
