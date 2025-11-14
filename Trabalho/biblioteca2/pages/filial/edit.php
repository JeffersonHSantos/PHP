<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE filial SET razao_social = :razao_social, endereco = :endereco, 
              telefone = :telefone WHERE cnpj = :cnpj";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':cnpj', $_POST['cnpj']);
    $stmt->bindParam(':razao_social', $_POST['razao_social']);
    $stmt->bindParam(':endereco', $_POST['endereco']);
    $stmt->bindParam(':telefone', $_POST['telefone']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
        exit();
    }
}

// Buscar dados da filial
$query = "SELECT * FROM filial WHERE cnpj = :cnpj";
$stmt = $db->prepare($query);
$stmt->bindParam(':cnpj', $_GET['cnpj']);
$stmt->execute();
$filial = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filial - Biblioteca</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Editar Filial</h1>
        </header>

        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="index.php">Voltar para Filiais</a></li>
            </ul>
        </nav>

        <main>
            <form method="POST">
                <input type="hidden" name="cnpj" value="<?= $filial['cnpj'] ?>">

                <div class="form-group">
                    <label>CNPJ:</label>
                    <input type="text" value="<?= htmlspecialchars($filial['cnpj']) ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Razão Social:</label>
                    <input type="text" name="razao_social" value="<?= htmlspecialchars($filial['razao_social']) ?>" required maxlength="100">
                </div>

                <div class="form-group">
                    <label>Endereço:</label>
                    <input type="text" name="endereco" value="<?= htmlspecialchars($filial['endereco']) ?>" maxlength="255">
                </div>

                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="text" name="telefone" value="<?= htmlspecialchars($filial['telefone']) ?>" maxlength="20">
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </form>
        </main>
    </div>
</body>
</html>
