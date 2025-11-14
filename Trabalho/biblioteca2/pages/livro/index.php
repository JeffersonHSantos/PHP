<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT l.*, c.nome as categoria_nome, f.razao_social 
          FROM livro l 
          INNER JOIN categoria c ON l.id_categoria = c.id_categoria
          INNER JOIN filial f ON l.cnpj_filial = f.cnpj
          ORDER BY l.id_livro";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Livros</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../autor/index.php">Autores</a></li>
                <li><a href="../categoria/index.php">Categorias</a></li>
                <li><a href="../cliente/index.php">Clientes</a></li>
                <li><a href="../filial/index.php">Filiais</a></li>
            </ul>
        </nav>

        <main>
            <div class="page-header">
                <h2>Lista de Livros</h2>
                <a href="create.php" class="btn btn-success">+ Novo Livro</a>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="alert alert-success">Operação realizada com sucesso!</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Ano</th>
                        <th>Situação</th>
                        <th>Categoria</th>
                        <th>Filial</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id_livro'] ?></td>
                        <td><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= $row['ano_publicacao'] ?></td>
                        <td><?= htmlspecialchars($row['situacao']) ?></td>
                        <td><?= htmlspecialchars($row['categoria_nome']) ?></td>
                        <td><?= htmlspecialchars($row['razao_social']) ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $row['id_livro'] ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?id=<?= $row['id_livro'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
