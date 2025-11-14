<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar autores
$query = "SELECT * FROM autor ORDER BY id_autor";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Autores</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../categoria/index.php">Categorias</a></li>
                <li><a href="../cliente/index.php">Clientes</a></li>
                <li><a href="../filial/index.php">Filiais</a></li>
                <li><a href="../livro/index.php">Livros</a></li>
            </ul>
        </nav>

        <main>
            <div class="page-header">
                <h2>Lista de Autores</h2>
                <a href="create.php" class="btn btn-success">+ Novo Autor</a>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="alert alert-success">Operação realizada com sucesso!</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Data Morte</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id_autor'] ?></td>
                        <td><?= htmlspecialchars($row['nome']) ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data_nasc'])) ?></td>
                        <td><?= $row['data_morte'] ? date('d/m/Y', strtotime($row['data_morte'])) : '-' ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $row['id_autor'] ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?id=<?= $row['id_autor'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
