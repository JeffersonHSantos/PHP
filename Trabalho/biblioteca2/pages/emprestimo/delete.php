<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id'])) {
    // Buscar id do livro antes de deletar
    $querySelect = "SELECT id_livro FROM clientelivro WHERE id_clientelivro = :id";
    $stmtSelect = $db->prepare($querySelect);
    $stmtSelect->bindParam(':id', $_GET['id']);
    $stmtSelect->execute();
    $result = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        // Deletar empréstimo
        $query = "DELETE FROM clientelivro WHERE id_clientelivro = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $_GET['id']);
        
        if ($stmt->execute()) {
            // Atualizar situação do livro para disponível
            $queryUpdate = "UPDATE livro SET situacao = 'Disponível' WHERE id_livro = :id_livro";
            $stmtUpdate = $db->prepare($queryUpdate);
            $stmtUpdate->bindParam(':id_livro', $result['id_livro']);
            $stmtUpdate->execute();
            
            header("Location: index.php?msg=success");
        } else {
            header("Location: index.php?msg=error");
        }
    }
    exit();
}
?>
