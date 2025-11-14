<?php
require_once 'config/conexao.php';
require_once 'includes/BibliotecaFuncoes.php';

// Estatísticas do sistema
$db = Conexao::getInstance()->getConexao();

// Contar registros
$stats = [];

$queries = [
    'autores' => 'SELECT COUNT(*) as total FROM autor',
    'livros' => 'SELECT COUNT(*) as total FROM livro',
    'clientes' => 'SELECT COUNT(*) as total FROM cliente',
    'emprestimos' => 'SELECT COUNT(*) as total FROM clientelivro',
    'disponíveis' => "SELECT COUNT(*) as total FROM livro WHERE situacao = 'Disponível'",
    'emprestados' => "SELECT COUNT(*) as total FROM livro WHERE situacao = 'Emprestado'"
];

foreach ($queries as $key => $query) {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stats[$key] = $result['total'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Biblioteca - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-book"></i> Sistema Biblioteca
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Header da aplicação -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="card shadow-lg bg-white">
                    <div class="card-body py-5">
                        <h1 class="display-4 text-primary mb-3">
                            <i class="fas fa-book-open"></i>
                            Sistema de Gerenciamento de Biblioteca
                        </h1>
                        <p class="lead text-muted mb-4">
                            Desenvolvido por <strong>Jefferson H. Santos</strong> & <strong>Eduarda S. da Silva</strong>
                        </p>
                        <p class="text-secondary">
                            Sistema completo para gerenciamento de acervo, clientes e empréstimos
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estatísticas do sistema -->
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="stat-card fade-in-up">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3><?= $stats['autores'] ?></h3>
                    <p>Autores Cadastrados</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card fade-in-up">
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3><?= $stats['livros'] ?></h3>
                    <p>Livros no Acervo</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card fade-in-up">
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3><?= $stats['clientes'] ?></h3>
                    <p>Clientes Cadastrados</p>
                </div>
            </div>
        </div>

        <!-- Status dos livros -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="stat-card fade-in-up">
                    <div class="icon text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-success"><?= $stats['disponíveis'] ?></h3>
                    <p>Livros Disponíveis</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="stat-card fade-in-up">
                    <div class="icon text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-warning"><?= $stats['emprestados'] ?></h3>
                    <p>Livros Emprestados</p>
                </div>
            </div>
        </div>

        <!-- Menu de navegação modular -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-th-large"></i> Módulos do Sistema
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Módulo Autores -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                        <h5 class="card-title">Autores</h5>
                                        <p class="card-text text-muted">
                                            Gerenciar cadastro de autores e suas informações
                                        </p>
                                        <a href="modulos/autor/listar.php" class="btn btn-primary">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Módulo Livros -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-book fa-3x text-success mb-3"></i>
                                        <h5 class="card-title">Livros</h5>
                                        <p class="card-text text-muted">
                                            Controle do acervo e situação dos livros
                                        </p>
                                        <a href="modulos/livro/listar.php" class="btn btn-success">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Módulo Clientes -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-friends fa-3x text-info mb-3"></i>
                                        <h5 class="card-title">Clientes</h5>
                                        <p class="card-text text-muted">
                                            Cadastro e gestão de clientes da biblioteca
                                        </p>
                                        <a href="modulos/cliente/listar.php" class="btn btn-info">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Módulo Categorias -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-tags fa-3x text-warning mb-3"></i>
                                        <h5 class="card-title">Categorias</h5>
                                        <p class="card-text text-muted">
                                            Organização por categorias de livros
                                        </p>
                                        <a href="modulos/categoria/listar.php" class="btn btn-warning">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Módulo Filiais -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                                        <h5 class="card-title">Filiais</h5>
                                        <p class="card-text text-muted">
                                            Controle das filiais da biblioteca
                                        </p>
                                        <a href="modulos/filial/listar.php" class="btn btn-secondary">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Módulo Empréstimos -->
                            <div class="col-lg-4 col-md-6">
                                <div class="card h-100 module-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-handshake fa-3x text-danger mb-3"></i>
                                        <h5 class="card-title">Empréstimos</h5>
                                        <p class="card-text text-muted">
                                            Gestão de empréstimos e devoluções
                                        </p>
                                        <a href="modulos/emprestimo/listar.php" class="btn btn-danger">
                                            <i class="fas fa-arrow-right"></i> Acessar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 py-4 text-center text-white">
        <div class="container">
            <p class="mb-0">
                © 2025 Sistema de Biblioteca - Jefferson H. Santos & Eduarda S. da Silva
            </p>
            <small class="text-white-50">
                Desenvolvido com <i class="fas fa-heart text-danger"></i> em PHP + PostgreSQL
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animação dos cards
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        });

        document.querySelectorAll('.module-card').forEach((el) => {
            observer.observe(el);
        });
    </script>
</body>
</html>