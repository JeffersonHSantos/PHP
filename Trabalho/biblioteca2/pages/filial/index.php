<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM filial ORDER BY razao_social";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filiais - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Filiais</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../autor/index.php">Autores</a></li>
                <li><a href="../categoria/index.php">Categorias</a></li>
                <li><a href="../cliente/index.php">Clientes</a></li>
                <li><a href="../livro/index.php">Livros</a></li>
            </ul>
        </nav>

        <main>
            <div class="page-header">
                <h2>Lista de Filiais</h2>
                <a href="create.php" class="btn btn-success">+ Nova Filial</a>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="alert alert-success">Operação realizada com sucesso!</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>CNPJ</th>
                        <th>Razão Social</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['cnpj']) ?></td>
                        <td><?= htmlspecialchars($row['razao_social']) ?></td>
                        <td><?= htmlspecialchars($row['endereco']) ?></td>
                        <td><?= htmlspecialchars($row['telefone']) ?></td>
                        <td class="actions">
                            <a href="edit.php?cnpj=<?= $row['cnpj'] ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?cnpj=<?= $row['cnpj'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
