<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "biblioteca";

// Estabelece conexão com MySQL
$conexao = mysqli_connect($host, $user, $password, $database);

// Verifica se houve erro na conexão
if(!$conexao){
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
