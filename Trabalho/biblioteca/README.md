# Sistema de Gerenciamento de Biblioteca

Sistema desenvolvido em PHP e MySQL para gerenciamento completo de uma biblioteca.

## Estrutura do Projeto

```
biblioteca/
│
├── index.html              # Página inicial com menu principal
├── conexao.php             # Configuração de conexão com banco de dados
├── database.sql            # Script de criação do banco e dados de teste
│
├── autor.php               # CRUD de Autores
├── categoria.php           # CRUD de Categorias
├── cliente.php             # CRUD de Clientes
├── filial.php              # CRUD de Filiais
├── livro.php               # CRUD de Livros
├── autorlivro.php          # CRUD de Relação Autor-Livro
└── clientelivro.php        # CRUD de Empréstimos (Cliente-Livro)
```

## Funcionalidades Implementadas

### Cada módulo possui operações CRUD completas:
- ✅ **Inserção** de novos registros
- ✅ **Seleção/Listagem** de todos os registros
- ✅ **Edição** de registros existentes
- ✅ **Remoção** de registros com confirmação

### Tabelas do Sistema:
1. **Autor** - Gerencia autores com data de nascimento e morte
2. **Categoria** - Categorias de livros (Romance, Terror, etc.)
3. **Cliente** - Cadastro de clientes com CPF, endereço e contato
4. **Filial** - Filiais da biblioteca com CNPJ e localização
5. **Livro** - Livros com categoria, situação e filial
6. **AutorLivro** - Relacionamento N:N entre autores e livros
7. **ClienteLivro** - Registro de empréstimos

## Instalação

### 1. Configurar Banco de Dados
```sql
-- Execute o arquivo database.sql no MySQL
mysql -u root -p < database.sql
```

### 2. Configurar Conexão
Edite o arquivo `conexao.php` com suas credenciais:
```php
$host = "localhost";
$user = "root";
$password = "sua_senha";
$database = "biblioteca";
```

### 3. Executar no Servidor
- Coloque os arquivos na pasta do servidor web (htdocs, www, etc.)
- Acesse pelo navegador: `http://localhost/biblioteca/`

## Observações

- O sistema utiliza PHP com MySQLi
- Design responsivo e interface intuitiva
- Validações de formulário
- Confirmação antes de remover registros
- Foreign Keys respeitadas nos relacionamentos

## Autores do Projeto
- Jefferson H. Santos
- Eduarda S. da Silva

## Data de Entrega
24/11/2024
