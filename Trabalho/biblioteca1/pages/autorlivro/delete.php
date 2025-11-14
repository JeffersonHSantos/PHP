<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id_livro']) && isset($_GET['id_autor'])) {
    $query = "DELETE FROM autorlivro WHERE id_livro = :id_livro AND id_autor = :id_autor";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_livro', $_GET['id_livro']);
    $stmt->bindParam(':id_autor', $_GET['id_autor']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
    } else {
        header("Location: index.php?msg=error");
    }
    exit();
}
?>
