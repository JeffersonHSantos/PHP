<?php
require_once 'CategoriaDAO.php';
require_once '../../includes/BibliotecaFuncoes.php';

$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias - Biblioteca</title>
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
                <a class="nav-link" href="../../index.php">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-tags"></i> Lista de Categorias
                        </h4>
                        <a href="inserir.php" class="btn btn-dark btn-sm">
                            <i class="fas fa-plus"></i> Nova Categoria
                        </a>
                    </div>
                    <div class="card-body">
                        <?php BibliotecaFuncoes::exibirAlerta(); ?>
                        
                        <?php if (empty($categorias)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Nenhuma categoria cadastrada ainda.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Total Livros</th>
                                            <th width="120">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categorias as $categoria): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary"><?= $categoria['id_categoria'] ?></span>
                                            </td>
                                            <td>
                                                <strong><?= htmlspecialchars($categoria['nome']) ?></strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($categoria['descricao']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($categoria['total_livros'] > 0): ?>
                                                    <span class="badge badge-disponivel">
                                                        <i class="fas fa-book"></i> <?= $categoria['total_livros'] ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-minus"></i> 0
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="editar.php?id=<?= $categoria['id_categoria'] ?>" 
                                                       class="btn btn-outline-warning" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <?php if ($categoria['total_livros'] == 0): ?>
                                                        <a href="excluir.php?id=<?= $categoria['id_categoria'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           onclick="return confirm('Deseja realmente excluir esta categoria?')" 
                                                           title="Excluir">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-outline-secondary" 
                                                                title="Não pode excluir - tem livros associados" disabled>
                                                            <i class="fas fa-lock"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Total de categorias: <?= count($categorias) ?>
                                    </small>
                                </div>
                                <div class="col-md-6 text-end">
                                    <small class="text-muted">
                                        <i class="fas fa-lock"></i>
                                        Categorias com livros não podem ser excluídas
                                    </small>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>