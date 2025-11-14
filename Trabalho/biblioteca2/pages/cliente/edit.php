<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE cliente SET nome = :nome, data_nasc = :data_nasc, 
              endereco = :endereco, telefone = :telefone WHERE cpf = :cpf";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':cpf', $_POST['cpf']);
    $stmt->bindParam(':nome', $_POST['nome']);
    $stmt->bindParam(':data_nasc', $_POST['data_nasc']);
    $stmt->bindParam(':endereco', $_POST['endereco']);
    $stmt->bindParam(':telefone', $_POST['telefone']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados do cliente
$query = "SELECT * FROM cliente WHERE cpf = :cpf";
$stmt = $db->prepare($query);
$stmt->bindParam(':cpf', $_GET['cpf']);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Cliente</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Clientes</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="cpf" value="<?= $cliente['cpf'] ?>">

                <div class="form-group">
                    <label>CPF:</label>
                    <input type="text" value="<?= htmlspecialchars($cliente['cpf']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="data_nasc" value="<?= $cliente['data_nasc'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Endereço:</label>
                    <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" maxlength="255">
                </div>

                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" maxlength="20">
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
