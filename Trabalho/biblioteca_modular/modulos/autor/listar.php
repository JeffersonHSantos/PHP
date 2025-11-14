<?php
require_once 'AutorDAO.php';
require_once '../../includes/BibliotecaFuncoes.php';

$autorDAO = new AutorDAO();
$autores = $autorDAO->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores - Biblioteca</title>
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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-users"></i> Lista de Autores
                        </h4>
                        <a href="inserir.php" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Novo Autor
                        </a>
                    </div>
                    <div class="card-body">
                        <?php BibliotecaFuncoes::exibirAlerta(); ?>
                        
                        <?php if (empty($autores)): ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                Nenhum autor cadastrado ainda.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Data Nascimento</th>
                                            <th>Data Morte</th>
                                            <th width="120">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($autores as $autor): ?>
                                        <tr>
                                            <td><?= $autor['id_autor'] ?></td>
                                            <td><?= htmlspecialchars($autor['nome']) ?></td>
                                            <td><?= BibliotecaFuncoes::formatarData($autor['data_nasc']) ?></td>
                                            <td><?= BibliotecaFuncoes::formatarData($autor['data_morte']) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="editar.php?id=<?= $autor['id_autor'] ?>" 
                                                       class="btn btn-outline-primary" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="excluir.php?id=<?= $autor['id_autor'] ?>" 
                                                       class="btn btn-outline-danger" 
                                                       onclick="return confirm('Deseja realmente excluir este autor?')" 
                                                       title="Excluir">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Total de autores: <?= count($autores) ?>
                                </small>
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