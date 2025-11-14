<?php
require_once '../../config/conexao.php';

// Classe para operações de dados dos Autores
class AutorDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::getInstance()->getConexao();
    }
    
    // Listar todos os autores
    public function listarTodos() {
        $sql = "SELECT * FROM autor ORDER BY nome";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Buscar autor por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM autor WHERE id_autor = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Inserir novo autor
    public function inserir($dados) {
        $sql = "INSERT INTO autor (id_autor, nome, data_nasc, data_morte) 
                VALUES (:id_autor, :nome, :data_nasc, :data_morte)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id_autor', $dados['id_autor'], PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':data_nasc', $dados['data_nasc'], PDO::PARAM_STR);
        
        $data_morte = !empty($dados['data_morte']) ? $dados['data_morte'] : null;
        $stmt->bindParam(':data_morte', $data_morte);
        
        return $stmt->execute();
    }
    
    // Atualizar autor
    public function atualizar($id, $dados) {
        $sql = "UPDATE autor SET nome = :nome, data_nasc = :data_nasc, 
                data_morte = :data_morte WHERE id_autor = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':data_nasc', $dados['data_nasc'], PDO::PARAM_STR);
        
        $data_morte = !empty($dados['data_morte']) ? $dados['data_morte'] : null;
        $stmt->bindParam(':data_morte', $data_morte);
        
        return $stmt->execute();
    }
    
    // Excluir autor
    public function excluir($id) {
        $sql = "DELETE FROM autor WHERE id_autor = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Verificar se autor tem livros associados
    public function temLivrosAssociados($id) {
        $sql = "SELECT COUNT(*) as total FROM autorlivro WHERE id_autor = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
}
?>