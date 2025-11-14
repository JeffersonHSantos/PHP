<?php
require_once 'AutorDAO.php';
require_once '../../includes/BibliotecaFuncoes.php';

$autorDAO = new AutorDAO();

// Verificar se ID foi passado
if (!isset($_GET['id'])) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 'ID do autor não informado');
}

$id = intval($_GET['id']);

// Verificar se autor existe
$autor = $autorDAO->buscarPorId($id);
if (!$autor) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 'Autor não encontrado');
}

// Verificar se autor tem livros associados
if ($autorDAO->temLivrosAssociados($id)) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 
        'Não é possível excluir o autor pois ele possui livros associados');
}

// Tentar excluir
if ($autorDAO->excluir($id)) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'success', 
        'Autor excluído com sucesso');
} else {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 
        'Erro ao excluir autor');
}
?>