<?php
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['cnpj'])) {
    $query = "DELETE FROM filial WHERE cnpj = :cnpj";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':cnpj', $_GET['cnpj']);
    
    if ($stmt->execute()) {
        header("Location: index.php?msg=success");
    } else {
        header("Location: index.php?msg=error");
    }
    exit();
}
?>
