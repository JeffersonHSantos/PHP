<?php
require_once '../../config/conexao.php';

// Classe para operações de dados dos Livros
class LivroDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::getInstance()->getConexao();
    }
    
    // Listar todos os livros com informações relacionadas
    public function listarTodos() {
        $sql = "SELECT l.*, c.nome as categoria_nome, f.razao_social as filial_nome
                FROM livro l
                INNER JOIN categoria c ON l.id_categoria = c.id_categoria
                INNER JOIN filial f ON l.cnpj_filial = f.cnpj
                ORDER BY l.titulo";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Buscar livro por ID
    public function buscarPorId($id) {
        $sql = "SELECT l.*, c.nome as categoria_nome, f.razao_social as filial_nome
                FROM livro l
                INNER JOIN categoria c ON l.id_categoria = c.id_categoria
                INNER JOIN filial f ON l.cnpj_filial = f.cnpj
                WHERE l.id_livro = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Inserir novo livro
    public function inserir($dados) {
        $sql = "INSERT INTO livro (id_livro, titulo, ano_publicacao, situacao, id_categoria, cnpj_filial)
                VALUES (:id_livro, :titulo, :ano_publicacao, :situacao, :id_categoria, :cnpj_filial)";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id_livro', $dados['id_livro'], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $dados['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':ano_publicacao', $dados['ano_publicacao'], PDO::PARAM_INT);
        $stmt->bindParam(':situacao', $dados['situacao'], PDO::PARAM_STR);
        $stmt->bindParam(':id_categoria', $dados['id_categoria'], PDO::PARAM_INT);
        $stmt->bindParam(':cnpj_filial', $dados['cnpj_filial'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    // Atualizar livro
    public function atualizar($id, $dados) {
        $sql = "UPDATE livro SET titulo = :titulo, ano_publicacao = :ano_publicacao,
                situacao = :situacao, id_categoria = :id_categoria, cnpj_filial = :cnpj_filial
                WHERE id_livro = :id";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $dados['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':ano_publicacao', $dados['ano_publicacao'], PDO::PARAM_INT);
        $stmt->bindParam(':situacao', $dados['situacao'], PDO::PARAM_STR);
        $stmt->bindParam(':id_categoria', $dados['id_categoria'], PDO::PARAM_INT);
        $stmt->bindParam(':cnpj_filial', $dados['cnpj_filial'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    
    // Excluir livro
    public function excluir($id) {
        $sql = "DELETE FROM livro WHERE id_livro = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // Listar categorias para select
    public function listarCategorias() {
        $sql = "SELECT * FROM categoria ORDER BY nome";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Listar filiais para select
    public function listarFiliais() {
        $sql = "SELECT * FROM filial ORDER BY razao_social";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Verificar se livro está emprestado
    public function estaEmprestado($id) {
        $sql = "SELECT COUNT(*) as total FROM clientelivro WHERE id_livro = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
    
    // Atualizar situação do livro
    public function atualizarSituacao($id, $situacao) {
        $sql = "UPDATE livro SET situacao = :situacao WHERE id_livro = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':situacao', $situacao, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>