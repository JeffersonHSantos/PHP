<?php
// Configuração de conexão com banco de dados
class Conexao {
    private static $instance = null;
    private $conexao;
    
    // Dados de conexão
    private $host = 'localhost';
    private $dbname = 'biblioteca';
    private $username = 'postgres';
    private $password = 'senha';
    
    private function __construct() {
        try {
            $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";
            $this->conexao = new PDO($dsn, $this->username, $this->password);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->exec("SET NAMES utf8");
        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConexao() {
        return $this->conexao;
    }
}
?>