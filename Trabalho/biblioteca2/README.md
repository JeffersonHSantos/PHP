# Sistema de Gerenciamento de Biblioteca

**Autores:** Jefferson H. Santos & Eduarda S. da Silva

## Descrição do Projeto

Sistema completo de gerenciamento de biblioteca desenvolvido em PHP com banco de dados PostgreSQL. Implementa todas as operações CRUD (Create, Read, Update, Delete) para as tabelas do projeto.

## Estrutura do Banco de Dados

### Tabelas Implementadas:
- ✅ **Autor** - Cadastro de autores com datas de nascimento e morte
- ✅ **Categoria** - Categorias de livros (Romance, Ficção, etc.)
- ✅ **Cliente** - Cadastro de clientes da biblioteca
- ✅ **Filial** - Filiais da biblioteca
- ✅ **Livro** - Acervo de livros com categoria e filial
- ✅ **AutorLivro** - Relacionamento N:N entre autores e livros
- ✅ **ClienteLivro** - Registro de empréstimos

## Estrutura de Arquivos

```
biblioteca/
│
├── config/
│   └── database.php          # Configuração de conexão com banco
│
├── css/
│   └── style.css             # Estilos do sistema
│
├── pages/
│   ├── autor/                # CRUD de Autores
│   │   ├── index.php         # Listar
│   │   ├── create.php        # Criar
│   │   ├── edit.php          # Editar
│   │   └── delete.php        # Excluir
│   │
│   ├── categoria/            # CRUD de Categorias
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── cliente/              # CRUD de Clientes
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── filial/               # CRUD de Filiais
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── livro/                # CRUD de Livros
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   ├── autorlivro/           # CRUD de Relacionamento Autor-Livro
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   └── delete.php
│   │
│   └── emprestimo/           # CRUD de Empréstimos (ClienteLivro)
│       ├── index.php
│       ├── create.php
│       └── delete.php
│
├── setup/
│   └── database.sql          # Script de criação do banco
│
├── index.php                 # Página inicial
└── README.md                 # Este arquivo
```

## Instalação

### 1. Configurar Banco de Dados

```bash
# Criar banco e tabelas
psql -U postgres -f setup/database.sql
```

### 2. Configurar Conexão

Editar o arquivo `config/database.php` com suas credenciais:

```php
private $host = "localhost";
private $db_name = "biblioteca";
private $username = "postgres";
private $password = "sua_senha";
```

### 3. Executar o Sistema

Colocar os arquivos em um servidor web com PHP instalado:

```bash
# Exemplo com servidor embutido do PHP
php -S localhost:8000
```

Acessar: http://localhost:8000

## Funcionalidades Implementadas

### Autor (✅ CRUD Completo)
- Inserir novo autor
- Listar todos os autores
- Editar dados do autor
- Remover autor

### Categoria (✅ CRUD Completo)
- Inserir nova categoria
- Listar todas as categorias
- Editar categoria
- Remover categoria

### Cliente (✅ CRUD Completo)
- Inserir novo cliente
- Listar todos os clientes
- Editar dados do cliente
- Remover cliente

### Filial (✅ CRUD Completo)
- Inserir nova filial
- Listar todas as filiais
- Editar dados da filial
- Remover filial

### Livro (✅ CRUD Completo)
- Inserir novo livro (com seleção de categoria e filial)
- Listar todos os livros com informações relacionadas
- Editar dados do livro
- Remover livro

### AutorLivro (✅ CRUD Completo)
- Relacionar autor com livro
- Listar todos os relacionamentos
- Editar tipo de participação
- Remover relacionamento

### Empréstimo (✅ CRUD Completo)
- Registrar empréstimo (atualiza situação do livro)
- Listar todos os empréstimos
- Devolver livro (atualiza situação do livro)

## Modelo Lógico com Operações

```
AUTOR (✅ I S E R)
├── id_autor
├── nome
├── data_nasc
└── data_morte

CATEGORIA (✅ I S E R)
├── id_categoria
├── nome
└── descricao

CLIENTE (✅ I S E R)
├── cpf
├── nome
├── data_nasc
├── endereco
└── telefone

FILIAL (✅ I S E R)
├── cnpj
├── razao_social
├── endereco
└── telefone

LIVRO (✅ I S E R)
├── id_livro
├── titulo
├── ano_publicacao
├── situacao
├── id_categoria (FK)
└── cnpj_filial (FK)

AUTORLIVRO (✅ I S E R)
├── id_livro (FK)
├── id_autor (FK)
└── participacao

CLIENTELIVRO (✅ I S R)
├── id_clientelivro
├── cpf_cliente (FK)
└── id_livro (FK)
```

**Legenda:**
- I = Inserção
- S = Seleção/Listar
- E = Edição
- R = Remoção

## Tecnologias Utilizadas

- **PHP** - Linguagem de programação
- **PostgreSQL** - Sistema de gerenciamento de banco de dados
- **HTML/CSS** - Interface do usuário
- **PDO** - Conexão segura com banco de dados

## Características Técnicas

- Uso de PDO para prevenir SQL Injection
- Prepared Statements em todas as queries
- Interface responsiva e moderna
- Validação de dados no cliente e servidor
- Relacionamentos com chaves estrangeiras
- Cascata em deleções quando apropriado
- Sistema de empréstimos com controle de situação

## Cronograma de Entrega

- 17/11 - Feedback da situação do trabalho
- 24/11 - Entrega final (pasta compactada)

## Observações

Todos os CRUDs estão funcionais e testados. O sistema mantém a integridade referencial do banco de dados e implementa as regras de negócio da biblioteca.
