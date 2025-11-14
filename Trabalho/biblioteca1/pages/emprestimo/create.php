<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Buscar clientes e livros disponíveis
$queryCliente = "SELECT * FROM cliente ORDER BY nome";
$stmtCliente = $db->prepare($queryCliente);
$stmtCliente->execute();

$queryLivro = "SELECT * FROM livro WHERE situacao = 'Disponível' ORDER BY titulo";
$stmtLivro = $db->prepare($queryLivro);
$stmtLivro->execute();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inserir empréstimo
    $query = "INSERT INTO clientelivro (cpf_cliente, id_livro) 
              VALUES (:cpf_cliente, :id_livro)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':cpf_cliente', $_POST['cpf_cliente']);
    $stmt->bindParam(':id_livro', $_POST['id_livro']);
    
    if ($stmt->execute()) {
        // Atualizar situação do livro para emprestado
        $queryUpdate = "UPDATE livro SET situacao = 'Emprestado' WHERE id_livro = :id_livro";
        $stmtUpdate = $db->prepare($queryUpdate);
        $stmtUpdate->bindParam(':id_livro', $_POST['id_livro']);
        $stmtUpdate->execute();
        
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
    <title>Novo Empréstimo - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastrar Novo Empréstimo</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Empréstimos</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <div class="form-group">
                    <label>Cliente:</label>
                    <select name="cpf_cliente" required>
                        <option value="">Selecione...</option>
                        <?php while ($cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $cliente['cpf'] ?>"><?= htmlspecialchars($cliente['nome']) ?> (CPF: <?= $cliente['cpf'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Livro Disponível:</label>
                    <select name="id_livro" required>
                        <option value="">Selecione...</option>
                        <?php while ($livro = $stmtLivro->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $livro['id_livro'] ?>"><?= htmlspecialchars($livro['titulo']) ?> (Ano: <?= $livro['ano_publicacao'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="alert alert-info">
                    <strong>Atenção:</strong> Somente livros com situação "Disponível" podem ser emprestados.
                </div>

                <button type="submit" class="btn btn-success">Cadastrar Empréstimo</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
