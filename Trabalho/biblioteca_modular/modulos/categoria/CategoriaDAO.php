<?php
require_once '../../config/conexao.php';

// Classe para operações de dados das Categorias
class CategoriaDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::getInstance()->getConexao();
    }
    
    // Listar todas as categorias
    public function listarTodos() {
        $sql = "SELECT c.*, COUNT(l.id_livro) as total_livros 
                FROM categoria c 
                LEFT JOIN livro l ON c.id_categoria = l.id_categoria 
                GROUP BY c.id_categoria, c.nome, c.descricao 
                ORDER BY c.nome";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Buscar categoria por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM categoria WHERE id_categoria = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Inserir nova categoria
    public function inserir($dados) {
        $sql = "INSERT INTO categoria (id_categoria, nome, descricao) 
                VALUES (:id_categoria, :nome, :descricao)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id_categoria', $dados['id_categoria'], PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    // Atualizar categoria
    public function atualizar($id, $dados) {
        $sql = "UPDATE categoria SET nome = :nome, descricao = :descricao 
                WHERE id_categoria = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    // Excluir categoria
    public function excluir($id) {
        $sql = "DELETE FROM categoria WHERE id_categoria = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Verificar se categoria tem livros associados
    public function temLivrosAssociados($id) {
        $sql = "SELECT COUNT(*) as total FROM livro WHERE id_categoria = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
    
    // Buscar categorias mais populares
    public function categoriasPopulares($limit = 5) {
        $sql = "SELECT c.nome, COUNT(l.id_livro) as total_livros 
                FROM categoria c 
                LEFT JOIN livro l ON c.id_categoria = l.id_categoria 
                GROUP BY c.id_categoria, c.nome 
                HAVING COUNT(l.id_livro) > 0 
                ORDER BY total_livros DESC 
                LIMIT :limit";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>