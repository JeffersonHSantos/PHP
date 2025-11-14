<?php
require_once 'AutorDAO.php';
require_once '../../includes/BibliotecaFuncoes.php';

$autorDAO = new AutorDAO();

// Verificar se ID foi passado
if (!isset($_GET['id'])) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 'ID do autor não informado');
}

$id = intval($_GET['id']);
$autor = $autorDAO->buscarPorId($id);

if (!$autor) {
    BibliotecaFuncoes::redirecionarCom('listar.php', 'error', 'Autor não encontrado');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dados = [
        'nome' => trim($_POST['nome']),
        'data_nasc' => $_POST['data_nasc'],
        'data_morte' => $_POST['data_morte']
    ];
    
    if (empty($dados['nome'])) {
        BibliotecaFuncoes::redirecionarCom("editar.php?id={$id}", 'error', 'Nome é obrigatório');
    }
    
    if ($autorDAO->atualizar($id, $dados)) {
        BibliotecaFuncoes::redirecionarCom('listar.php', 'success', 'Autor atualizado com sucesso');
    } else {
        BibliotecaFuncoes::redirecionarCom("editar.php?id={$id}", 'error', 'Erro ao atualizar autor');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">
                <i class="fas fa-book"></i> Sistema Biblioteca
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="listar.php">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="fas fa-edit"></i> Editar Autor
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php BibliotecaFuncoes::exibirAlerta(); ?>
                        
                        <form method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="id_autor" class="form-label">ID do Autor</label>
                                <input type="number" class="form-control" id="id_autor" 
                                       value="<?= $autor['id_autor'] ?>" readonly>
                                <div class="form-text">ID não pode ser alterado</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo *</label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                       value="<?= htmlspecialchars($autor['nome']) ?>"
                                       maxlength="100" required>
                                <div class="invalid-feedback">
                                    Nome é obrigatório
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="data_nasc" class="form-label">Data de Nascimento *</label>
                                <input type="date" class="form-control" id="data_nasc" name="data_nasc" 
                                       value="<?= $autor['data_nasc'] ?>" required>
                                <div class="invalid-feedback">
                                    Data de nascimento é obrigatória
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="data_morte" class="form-label">Data de Morte</label>
                                <input type="date" class="form-control" id="data_morte" name="data_morte"
                                       value="<?= $autor['data_morte'] ?>">
                                <div class="form-text">Deixe em branco se o autor ainda está vivo</div>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="listar.php" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Atualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validação do formulário
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Validar data de morte não pode ser antes do nascimento
        document.getElementById('data_morte').addEventListener('change', function() {
            var dataNasc = document.getElementById('data_nasc').value;
            var dataMorte = this.value;
            
            if (dataNasc && dataMorte && dataMorte < dataNasc) {
                this.setCustomValidity('Data de morte não pode ser anterior à data de nascimento');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>