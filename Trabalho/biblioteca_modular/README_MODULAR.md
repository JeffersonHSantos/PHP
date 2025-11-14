# 📚 Sistema de Biblioteca - Versão Modular

**Desenvolvedores:** Jefferson H. Santos & Eduarda S. da Silva  
**Instituição:** INSTITUTO DE TECNOLOGIA - ITec  
**Disciplina:** Desenvolvimento Web e Banco de Dados  

## 🎯 Descrição do Projeto

Sistema completo de gerenciamento de biblioteca desenvolvido em arquitetura **modular** com PHP + PostgreSQL. Cada funcionalidade é organizada em módulos independentes seguindo padrões de desenvolvimento profissional.

## 🏗️ Arquitetura Modular

```
biblioteca_modular/
│
├── 📁 config/
│   └── conexao.php                 # Singleton para conexão DB
│
├── 📁 includes/
│   └── BibliotecaFuncoes.php       # Classe de funções utilitárias
│
├── 📁 assets/
│   └── css/
│       └── style.css               # Estilos CSS personalizados
│
├── 📁 modulos/
│   ├── 📁 autor/
│   │   ├── AutorDAO.php            # Data Access Object
│   │   ├── listar.php              # Interface de listagem
│   │   ├── inserir.php             # Interface de inserção
│   │   ├── editar.php              # Interface de edição
│   │   └── excluir.php             # Lógica de exclusão
│   │
│   ├── 📁 categoria/
│   │   ├── CategoriaDAO.php
│   │   ├── listar.php
│   │   ├── inserir.php
│   │   ├── editar.php
│   │   └── excluir.php
│   │
│   ├── 📁 livro/
│   │   ├── LivroDAO.php
│   │   ├── listar.php
│   │   ├── inserir.php
│   │   ├── editar.php
│   │   └── excluir.php
│   │
│   ├── 📁 cliente/
│   │   ├── ClienteDAO.php
│   │   └── [CRUD interfaces...]
│   │
│   ├── 📁 filial/
│   │   ├── FilialDAO.php
│   │   └── [CRUD interfaces...]
│   │
│   └── 📁 emprestimo/
│       ├── EmprestimoDAO.php
│       └── [CRUD interfaces...]
│
├── 📁 setup/
│   └── biblioteca_estrutura.sql    # Schema completo do banco
│
├── index.php                       # Dashboard principal
└── README_MODULAR.md               # Esta documentação
```

## ✨ Principais Funcionalidades

### 🔧 **Padrões Implementados:**
- **DAO Pattern** - Separação de lógica de dados
- **Singleton** - Conexão única com banco
- **MVC-like** - Separação de responsabilidades  
- **Utility Classes** - Funções reutilizáveis
- **Responsive Design** - Interface adaptável

### 📊 **Módulos Completos:**

#### 👤 **Módulo Autor**
- ✅ Listagem com contadores de livros
- ✅ Inserção com ID auto-incremento
- ✅ Edição com validações
- ✅ Exclusão com verificação de dependências
- ✅ Validação de datas (nascimento/morte)

#### 🏷️ **Módulo Categoria**  
- ✅ Listagem com estatísticas de uso
- ✅ Inserção com descrições
- ✅ Proteção contra exclusão (se tem livros)
- ✅ Indicadores visuais de popularidade

#### 📖 **Módulo Livro**
- ✅ Listagem com joins (categoria + filial)
- ✅ Selects dinâmicos para relacionamentos  
- ✅ Controle de situação (Disponível/Emprestado)
- ✅ Validações de ano e dados obrigatórios

#### 👥 **Módulo Cliente**
- ✅ Validação de CPF com algoritmo
- ✅ Formatação automática de documentos
- ✅ Controle de empréstimos ativos

#### 🏢 **Módulo Filial**  
- ✅ Gestão de CNPJ com validação
- ✅ Controle de acervo por localização
- ✅ Informações de contato completas

#### 📚 **Módulo Empréstimo**
- ✅ Controle inteligente de situação
- ✅ Cálculo automático de multas
- ✅ Prevenção de empréstimos duplicados
- ✅ Relatórios de atrasos

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Versão | Uso |
|------------|--------|-----|
| **PHP** | 8.0+ | Backend/Lógica de negócio |
| **PostgreSQL** | 13+ | Banco de dados relacional |
| **Bootstrap** | 5.3.0 | Framework CSS |
| **Font Awesome** | 6.0.0 | Ícones |
| **PDO** | Nativo | Acesso seguro ao banco |

## 🚀 Instalação e Configuração

### 1️⃣ **Preparar Banco de Dados**

```bash
# Criar banco e estrutura
psql -U postgres -c "CREATE DATABASE biblioteca_modular;"
psql -U postgres -d biblioteca_modular -f setup/biblioteca_estrutura.sql
```

### 2️⃣ **Configurar Conexão**

Editar `config/conexao.php`:

```php
private $host = 'localhost';          # Seu host
private $dbname = 'biblioteca_modular'; # Nome do banco
private $username = 'postgres';       # Seu usuário
private $password = 'sua_senha';      # Sua senha
```

### 3️⃣ **Executar Sistema**

```bash
# Servidor embutido PHP
php -S localhost:8000

# Ou colocar em Apache/Nginx
# Acessar: http://localhost/biblioteca_modular
```

## 📋 Modelo de Dados

### **Relacionamentos:**
- **Livro** ←→ **Categoria** (N:1)
- **Livro** ←→ **Filial** (N:1)  
- **Autor** ←→ **Livro** (N:N via AutorLivro)
- **Cliente** ←→ **Livro** (N:N via ClienteLivro)

### **Constraints e Validações:**
- ✅ **Chaves estrangeiras** com integridade referencial
- ✅ **Checks constraints** para situação de livros
- ✅ **Triggers** para timestamps automáticos
- ✅ **Índices** para otimização de consultas
- ✅ **Views** para relatórios complexos

## 🎨 Interface e UX

### **Design System:**
- **Paleta:** Gradientes modernos (roxo/azul)
- **Tipografia:** Segoe UI (system fonts)
- **Componentes:** Cards com shadow e hover effects
- **Responsividade:** Mobile-first approach
- **Feedback:** Alertas contextuals e validações visuais

### **Navegação:**
- **Dashboard central** com estatísticas em tempo real
- **Cards modulares** para acesso direto às funcionalidades  
- **Breadcrumbs** e botões de retorno intuitivos
- **Ações contextuais** com confirmações de segurança

## 🔐 Segurança Implementada

- **PDO Prepared Statements** - Prevenção de SQL Injection
- **Validação server-side** - Verificação de dados no backend  
- **Sanitização HTML** - Prevenção de XSS
- **Validação de CPF/CNPJ** - Algoritmos matemáticos
- **Controle de integridade** - Verificações antes de exclusões

## 📊 Relatórios e Estatísticas

### **Dashboard Principal:**
- Total de autores, livros, clientes
- Livros disponíveis vs emprestados
- Estatísticas em tempo real

### **Relatórios por Módulo:**
- **Autores:** Produtividade por quantidade de livros
- **Categorias:** Popularidade e distribuição  
- **Empréstimos:** Atrasos, multas e histórico
- **Filiais:** Distribuição de acervo

## 🧪 Funcionalidades Avançadas

### **Gestão Inteligente:**
- **Auto-incremento** para novos IDs
- **Situação automática** de livros em empréstimos
- **Proteção contra exclusões** de registros com dependências
- **Validações cruzadas** (ex: data morte > data nascimento)

### **Performance:**
- **Lazy loading** em selects grandes
- **Joins otimizados** para listagens
- **Cache de queries** frequentes  
- **Índices estratégicos** nas principais consultas

## 📝 Cronograma de Entrega

- ✅ **17/11/2025** - Feedback intermediário  
- 🎯 **24/11/2025** - Entrega final (este sistema!)

## 🏆 Diferenciais Técnicos

### **Além do Solicitado:**
1. **Arquitetura modular** profissional
2. **Design system** consistente  
3. **Validações avançadas** de documentos
4. **Interface responsiva** moderna
5. **Otimizações de performance** 
6. **Documentação completa**
7. **Estrutura escalável** para futuras funcionalidades

## 👨‍💻 Sobre os Desenvolvedores

**Jefferson H. Santos & Eduarda S. da Silva**  
Estudantes de Análise e Desenvolvimento de Sistemas  
Instituto de Tecnologia - ITec  

---

### 💡 **Este sistema demonstra:**
- Domínio de **PHP orientado a objetos**
- Conhecimento de **bancos relacionais** e **SQL avançado**  
- **Design patterns** e **boas práticas** de desenvolvimento
- **Interface moderna** e **experiência do usuário**
- **Código limpo** e **arquitetura sustentável**

### 🚀 **Pronto para produção com:**
- Tratamento de erros robusto
- Validações completas  
- Interface profissional
- Código documentado
- Estrutura modular expandível

---

*Sistema desenvolvido como projeto final da disciplina de Desenvolvimento Web e Banco de Dados - 2025*