<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT al.*, a.nome as autor_nome, l.titulo as livro_titulo 
          FROM autorlivro al
          INNER JOIN autor a ON al.id_autor = a.id_autor
          INNER JOIN livro l ON al.id_livro = l.id_livro
          ORDER BY l.titulo, a.nome";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autor-Livro - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Autor-Livro</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../autor/index.php">Autores</a></li>
                <li><a href="../livro/index.php">Livros</a></li>
                <li><a href="../emprestimo/index.php">Empréstimos</a></li>
            </ul>
        </nav>

        <main>
            <div class="page-header">
                <h2>Relacionamento Autor-Livro</h2>
                <a href="create.php" class="btn btn-success">+ Novo Relacionamento</a>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="alert alert-success">Operação realizada com sucesso!</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Autor</th>
                        <th>Participação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['livro_titulo']) ?></td>
                        <td><?= htmlspecialchars($row['autor_nome']) ?></td>
                        <td><?= htmlspecialchars($row['participacao']) ?></td>
                        <td class="actions">
                            <a href="edit.php?id_livro=<?= $row['id_livro'] ?>&id_autor=<?= $row['id_autor'] ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?id_livro=<?= $row['id_livro'] ?>&id_autor=<?= $row['id_autor'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
