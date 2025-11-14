<?php
// Funções auxiliares para o sistema de biblioteca
class BibliotecaFuncoes {
    
    // Formatar CPF
    public static function formatarCPF($cpf) {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
    
    // Formatar CNPJ
    public static function formatarCNPJ($cnpj) {
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }
    
    // Formatar data brasileira
    public static function formatarData($data) {
        if (empty($data)) return '-';
        return date('d/m/Y', strtotime($data));
    }
    
    // Limpar CPF/CNPJ (apenas números)
    public static function limparNumeros($str) {
        return preg_replace('/[^0-9]/', '', $str);
    }
    
    // Validar CPF
    public static function validarCPF($cpf) {
        $cpf = self::limparNumeros($cpf);
        
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        // Cálculo dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }
    
    // Gerar ID único para novos registros
    public static function gerarNovoId($tabela) {
        $db = Conexao::getInstance()->getConexao();
        
        switch($tabela) {
            case 'autor':
                $sql = "SELECT COALESCE(MAX(id_autor), 0) + 1 as novo_id FROM autor";
                break;
            case 'categoria':
                $sql = "SELECT COALESCE(MAX(id_categoria), 0) + 1 as novo_id FROM categoria";
                break;
            case 'livro':
                $sql = "SELECT COALESCE(MAX(id_livro), 0) + 1 as novo_id FROM livro";
                break;
            default:
                return 1;
        }
        
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['novo_id'];
    }
    
    // Redirecionar com mensagem
    public static function redirecionarCom($url, $tipo, $mensagem) {
        $query = http_build_query(['msg' => $tipo, 'texto' => $mensagem]);
        header("Location: {$url}?{$query}");
        exit();
    }
    
    // Exibir alerta baseado nos parâmetros GET
    public static function exibirAlerta() {
        if (isset($_GET['msg']) && isset($_GET['texto'])) {
            $tipo = $_GET['msg'];
            $texto = $_GET['texto'];
            
            $classe = '';
            switch($tipo) {
                case 'success':
                    $classe = 'alert-success';
                    break;
                case 'error':
                    $classe = 'alert-danger';
                    break;
                case 'warning':
                    $classe = 'alert-warning';
                    break;
                default:
                    $classe = 'alert-info';
            }
            
            echo "<div class='alert {$classe} alert-dismissible fade show' role='alert'>";
            echo htmlspecialchars($texto);
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>";
            echo "</div>";
        }
    }
}
?>