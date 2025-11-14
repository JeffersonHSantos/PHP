<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['cpf'])) {
    $query = "DELETE FROM cliente WHERE cpf = :cpf";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cpf', $_GET['cpf']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
    } else {
        header("Location: index.php?msg=error");
    }
    exit();
}
?>
