-- =====================================================================
-- SISTEMA DE BIBLIOTECA - ESTRUTURA COMPLETA
-- Autores: Jefferson H. Santos & Eduarda S. da Silva
-- Data: Novembro 2025
-- =====================================================================

-- Criar banco de dados
CREATE DATABASE biblioteca_modular;

-- Conectar ao banco
\c biblioteca_modular;

-- =====================================================================
-- CRIAÇÃO DAS TABELAS
-- =====================================================================

-- Tabela AUTOR
CREATE TABLE autor (
    id_autor SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nasc DATE NOT NULL,
    data_morte DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela CATEGORIA  
CREATE TABLE categoria (
    id_categoria SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela CLIENTE
CREATE TABLE cliente (
    cpf VARCHAR(11) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nasc DATE NOT NULL,
    endereco TEXT,
    telefone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela FILIAL
CREATE TABLE filial (
    cnpj VARCHAR(14) PRIMARY KEY,
    razao_social VARCHAR(100) NOT NULL,
    endereco TEXT,
    telefone VARCHAR(20),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela LIVRO
CREATE TABLE livro (
    id_livro SERIAL PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    isbn VARCHAR(20),
    ano_publicacao INTEGER,
    situacao VARCHAR(20) DEFAULT 'Disponível' CHECK (situacao IN ('Disponível', 'Emprestado', 'Manutenção')),
    id_categoria INTEGER NOT NULL,
    cnpj_filial VARCHAR(14) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria) ON DELETE RESTRICT,
    FOREIGN KEY (cnpj_filial) REFERENCES filial(cnpj) ON DELETE RESTRICT
);

-- Tabela AUTORLIVRO (Relacionamento N:N)
CREATE TABLE autorlivro (
    id_livro INTEGER NOT NULL,
    id_autor INTEGER NOT NULL,
    participacao VARCHAR(50) DEFAULT 'Principal' CHECK (participacao IN ('Principal', 'Coautor', 'Organizador', 'Tradutor')),
    PRIMARY KEY (id_livro, id_autor),
    FOREIGN KEY (id_livro) REFERENCES livro(id_livro) ON DELETE CASCADE,
    FOREIGN KEY (id_autor) REFERENCES autor(id_autor) ON DELETE CASCADE
);

-- Tabela CLIENTELIVRO (Empréstimos)
CREATE TABLE clientelivro (
    id_clientelivro SERIAL PRIMARY KEY,
    cpf_cliente VARCHAR(11) NOT NULL,
    id_livro INTEGER NOT NULL,
    data_emprestimo DATE DEFAULT CURRENT_DATE,
    data_devolucao_prevista DATE DEFAULT (CURRENT_DATE + INTERVAL '14 days'),
    data_devolucao_real DATE NULL,
    multa_aplicada DECIMAL(10,2) DEFAULT 0.00,
    observacoes TEXT,
    FOREIGN KEY (cpf_cliente) REFERENCES cliente(cpf) ON DELETE CASCADE,
    FOREIGN KEY (id_livro) REFERENCES livro(id_livro) ON DELETE CASCADE
);

-- =====================================================================
-- ÍNDICES PARA MELHOR PERFORMANCE
-- =====================================================================

-- Índices na tabela autor
CREATE INDEX idx_autor_nome ON autor(nome);
CREATE INDEX idx_autor_data_nasc ON autor(data_nasc);

-- Índices na tabela livro  
CREATE INDEX idx_livro_titulo ON livro(titulo);
CREATE INDEX idx_livro_situacao ON livro(situacao);
CREATE INDEX idx_livro_ano ON livro(ano_publicacao);
CREATE INDEX idx_livro_categoria ON livro(id_categoria);

-- Índices na tabela cliente
CREATE INDEX idx_cliente_nome ON cliente(nome);

-- Índices na tabela empréstimo
CREATE INDEX idx_emprestimo_data ON clientelivro(data_emprestimo);
CREATE INDEX idx_emprestimo_cliente ON clientelivro(cpf_cliente);

-- =====================================================================
-- TRIGGERS PARA ATUALIZAR TIMESTAMPS
-- =====================================================================

-- Função para atualizar updated_at
CREATE OR REPLACE FUNCTION update_updated_at_column()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ language 'plpgsql';

-- Triggers para cada tabela
CREATE TRIGGER update_autor_updated_at BEFORE UPDATE ON autor
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_categoria_updated_at BEFORE UPDATE ON categoria  
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_cliente_updated_at BEFORE UPDATE ON cliente
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_filial_updated_at BEFORE UPDATE ON filial
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

CREATE TRIGGER update_livro_updated_at BEFORE UPDATE ON livro
    FOR EACH ROW EXECUTE FUNCTION update_updated_at_column();

-- =====================================================================
-- DADOS INICIAIS PARA TESTE
-- =====================================================================

-- Inserir categorias
INSERT INTO categoria (nome, descricao) VALUES
('Romance', 'Histórias focadas em relacionamentos amorosos e emoções humanas.'),
('Ficção Científica', 'Explora futuros tecnológicos, viagens espaciais e realidades alternativas.'),
('Fantasia', 'Universos mágicos, criaturas míticas e aventuras épicas.'),
('Terror', 'Narrativas assustadoras que exploram o medo e o sobrenatural.'),
('Suspense', 'Histórias cheias de mistério, tensão e reviravoltas.'),
('Drama', 'Tramas focadas em conflitos emocionais e sociais.'),
('História', 'Livros baseados em fatos e acontecimentos históricos.'),
('Biografia', 'Relatos da vida de pessoas reais e suas trajetórias.'),
('Aventura', 'Explorações, jornadas perigosas e descobertas.'),
('Poesia', 'Expressões artísticas em versos e linguagem poética.');

-- Inserir filiais
INSERT INTO filial (cnpj, razao_social, endereco, telefone, email) VALUES
('12345678000101', 'Biblioteca Central São Paulo', 'Rua XV de Novembro, 100 - Centro, São Paulo/SP', '(11) 3333-1122', 'central.sp@biblioteca.com'),
('23456789000102', 'Biblioteca Zona Sul Rio', 'Av. Atlântica, 2000 - Copacabana, Rio de Janeiro/RJ', '(21) 3444-2233', 'zonasul.rj@biblioteca.com'),
('34567890000103', 'Biblioteca Savassi BH', 'Rua da Bahia, 450 - Savassi, Belo Horizonte/MG', '(31) 3555-3344', 'savassi.bh@biblioteca.com'),
('45678901000104', 'Biblioteca Centro Salvador', 'Praça da Sé, 77 - Centro, Salvador/BA', '(71) 3666-4455', 'centro.ssa@biblioteca.com'),
('56789012000105', 'Biblioteca Moinhos POA', 'Rua Padre Chagas, 321 - Moinhos, Porto Alegre/RS', '(51) 3777-5566', 'moinhos.poa@biblioteca.com');

-- Inserir autores
INSERT INTO autor (nome, data_nasc, data_morte) VALUES
('Machado de Assis', '1839-06-21', '1908-09-29'),
('Clarice Lispector', '1920-12-10', '1977-12-09'),
('Jorge Amado', '1912-08-10', '2001-08-06'),
('Lygia Fagundes Telles', '1923-04-19', '2022-04-03'),
('José Saramago', '1922-11-16', '2010-06-18'),
('Isabel Allende', '1942-08-02', NULL),
('Gabriel García Márquez', '1927-03-06', '2014-04-17'),
('Agatha Christie', '1890-09-15', '1976-01-12'),
('Stephen King', '1947-09-21', NULL),
('J.K. Rowling', '1965-07-31', NULL);

-- Inserir clientes
INSERT INTO cliente (cpf, nome, data_nasc, endereco, telefone, email) VALUES
('12345678901', 'João Silva Santos', '1990-05-12', 'Rua das Flores, 123 - Jardins, São Paulo/SP', '(11) 98877-1122', 'joao.santos@email.com'),
('23456789012', 'Maria Oliveira Costa', '1985-08-25', 'Av. Brasil, 456 - Copacabana, Rio de Janeiro/RJ', '(21) 97766-3344', 'maria.costa@email.com'),
('34567890123', 'Carlos Santos Lima', '1978-02-10', 'Rua das Palmeiras, 789 - Savassi, Belo Horizonte/MG', '(31) 98855-6677', 'carlos.lima@email.com'),
('45678901234', 'Ana Costa Ferreira', '1995-12-01', 'Rua da Liberdade, 55 - Pelourinho, Salvador/BA', '(71) 99123-4455', 'ana.ferreira@email.com'),
('56789012345', 'Fernanda Almeida Rocha', '2000-07-19', 'Av. Independência, 222 - Moinhos, Porto Alegre/RS', '(51) 98456-7788', 'fernanda.rocha@email.com');

-- Inserir livros
INSERT INTO livro (titulo, isbn, ano_publicacao, situacao, id_categoria, cnpj_filial) VALUES
('Dom Casmurro', '9788535902777', 1899, 'Disponível', 1, '12345678000101'),
('A Hora da Estrela', '9788520920077', 1977, 'Disponível', 6, '23456789000102'),
('Capitães da Areia', '9788535902545', 1937, 'Emprestado', 1, '34567890000103'),
('As Meninas', '9788535915555', 1973, 'Disponível', 1, '45678901000104'),
('Ensaio Sobre a Cegueira', '9788535902123', 1995, 'Disponível', 6, '56789012000105'),
('A Casa dos Espíritos', '9788535912777', 1982, 'Disponível', 1, '12345678000101'),
('Cem Anos de Solidão', '9788535926247', 1967, 'Emprestado', 1, '23456789000102'),
('Assassinato no Expresso do Oriente', '9788525052789', 1934, 'Disponível', 5, '34567890000103'),
('O Iluminado', '9788581050236', 1977, 'Disponível', 4, '45678901000104'),
('Harry Potter e a Pedra Filosofal', '9788532511010', 1997, 'Emprestado', 3, '56789012000105');

-- Inserir relacionamentos autor-livro
INSERT INTO autorlivro (id_livro, id_autor, participacao) VALUES
(1, 1, 'Principal'),
(2, 2, 'Principal'),
(3, 3, 'Principal'),
(4, 4, 'Principal'),
(5, 5, 'Principal'),
(6, 6, 'Principal'),
(7, 7, 'Principal'),
(8, 8, 'Principal'),
(9, 9, 'Principal'),
(10, 10, 'Principal');

-- Inserir empréstimos
INSERT INTO clientelivro (cpf_cliente, id_livro, data_emprestimo, data_devolucao_prevista) VALUES
('12345678901', 3, '2025-11-01', '2025-11-15'),
('23456789012', 7, '2025-11-05', '2025-11-19'), 
('34567890123', 10, '2025-11-08', '2025-11-22');

-- =====================================================================
-- VIEWS ÚTEIS PARA RELATÓRIOS
-- =====================================================================

-- View de livros com informações completas
CREATE VIEW vw_livros_completos AS
SELECT 
    l.id_livro,
    l.titulo,
    l.isbn,
    l.ano_publicacao,
    l.situacao,
    c.nome as categoria,
    f.razao_social as filial,
    string_agg(a.nome, ', ') as autores
FROM livro l
JOIN categoria c ON l.id_categoria = c.id_categoria
JOIN filial f ON l.cnpj_filial = f.cnpj
LEFT JOIN autorlivro al ON l.id_livro = al.id_livro
LEFT JOIN autor a ON al.id_autor = a.id_autor
GROUP BY l.id_livro, l.titulo, l.isbn, l.ano_publicacao, l.situacao, c.nome, f.razao_social
ORDER BY l.titulo;

-- View de empréstimos ativos
CREATE VIEW vw_emprestimos_ativos AS
SELECT 
    cl.id_clientelivro,
    c.nome as cliente,
    c.cpf,
    l.titulo as livro,
    cl.data_emprestimo,
    cl.data_devolucao_prevista,
    CASE 
        WHEN cl.data_devolucao_prevista < CURRENT_DATE THEN 'Atrasado'
        ELSE 'No Prazo'
    END as status,
    (CURRENT_DATE - cl.data_devolucao_prevista) as dias_atraso
FROM clientelivro cl
JOIN cliente c ON cl.cpf_cliente = c.cpf
JOIN livro l ON cl.id_livro = l.id_livro
WHERE cl.data_devolucao_real IS NULL
ORDER BY cl.data_devolucao_prevista;

-- =====================================================================
-- FUNCTIONS ÚTEIS
-- =====================================================================

-- Função para calcular multa
CREATE OR REPLACE FUNCTION calcular_multa(dias_atraso INTEGER)
RETURNS DECIMAL(10,2) AS $$
BEGIN
    IF dias_atraso <= 0 THEN
        RETURN 0.00;
    ELSE
        RETURN dias_atraso * 1.50; -- R$ 1,50 por dia de atraso
    END IF;
END;
$$ LANGUAGE plpgsql;

-- =====================================================================
-- COMENTÁRIOS NAS TABELAS
-- =====================================================================

COMMENT ON TABLE autor IS 'Tabela de autores de livros';
COMMENT ON TABLE categoria IS 'Categorias/gêneros literários';
COMMENT ON TABLE cliente IS 'Clientes cadastrados na biblioteca';
COMMENT ON TABLE filial IS 'Filiais da rede de bibliotecas';
COMMENT ON TABLE livro IS 'Acervo de livros da biblioteca';
COMMENT ON TABLE autorlivro IS 'Relacionamento N:N entre autores e livros';
COMMENT ON TABLE clientelivro IS 'Registro de empréstimos de livros';

-- =====================================================================
-- GRANTS DE SEGURANÇA
-- =====================================================================

-- Criar usuário para a aplicação
CREATE USER biblioteca_app WITH PASSWORD 'biblioteca123';

-- Conceder permissões
GRANT CONNECT ON DATABASE biblioteca_modular TO biblioteca_app;
GRANT USAGE ON SCHEMA public TO biblioteca_app;
GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO biblioteca_app;
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO biblioteca_app;

-- =====================================================================
-- FIM DO SCRIPT
-- =====================================================================

-- Verificar estrutura criada
SELECT 
    schemaname,
    tablename,
    tableowner
FROM pg_tables 
WHERE schemaname = 'public'
ORDER BY tablename;