<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['id'])) {
    $query = "DELETE FROM livro WHERE id_livro = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
    } else {
        header("Location: index.php?msg=error");
    }
    exit();
}
?>
