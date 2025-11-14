<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT cl.*, c.nome as cliente_nome, l.titulo as livro_titulo, l.situacao
          FROM clientelivro cl
          INNER JOIN cliente c ON cl.cpf_cliente = c.cpf
          INNER JOIN livro l ON cl.id_livro = l.id_livro
          ORDER BY cl.id_clientelivro";
$stmt = $db->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Empréstimos</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../cliente/index.php">Clientes</a></li>
                <li><a href="../livro/index.php">Livros</a></li>
                <li><a href="../autorlivro/index.php">Autor-Livro</a></li>
            </ul>
        </nav>

        <main>
            <div class="page-header">
                <h2>Lista de Empréstimos</h2>
                <a href="create.php" class="btn btn-success">+ Novo Empréstimo</a>
            </div>

            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="alert alert-success">Operação realizada com sucesso!</div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Livro</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id_clientelivro'] ?></td>
                        <td><?= htmlspecialchars($row['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($row['livro_titulo']) ?></td>
                        <td>
                            <span style="color: <?= $row['situacao'] == 'Disponível' ? 'green' : 'red' ?>">
                                <?= htmlspecialchars($row['situacao']) ?>
                            </span>
                        </td>
                        <td class="actions">
                            <a href="delete.php?id=<?= $row['id_clientelivro'] ?>" class="btn btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
