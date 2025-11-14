-- CRIAÇÃO DO BANCO DE DADOS
CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

-- TABELA AUTOR
CREATE TABLE autor (
    id_autor INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nasc DATE NOT NULL,
    data_morte DATE
);

-- TABELA CATEGORIA
CREATE TABLE categoria (
    id_categoria INT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255)
);

-- TABELA CLIENTE
CREATE TABLE cliente (
    cpf VARCHAR(11) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nasc DATE NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(20)
);

-- TABELA FILIAL
CREATE TABLE filial (
    cnpj VARCHAR(14) PRIMARY KEY,
    razao_social VARCHAR(100) NOT NULL,
    endereco VARCHAR(255),
    telefone VARCHAR(20)
);

-- TABELA LIVRO
CREATE TABLE livro (
    id_livro INT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    ano_publicacao INT,
    situacao VARCHAR(20),
    id_categoria INT NOT NULL,
    cnpj_filial VARCHAR(14) NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (cnpj_filial) REFERENCES filial(cnpj)
);

-- TABELA AUTORLIVRO
CREATE TABLE autorlivro (
    id_livro INT NOT NULL,
    id_autor INT NOT NULL,
    participacao VARCHAR(50),
    PRIMARY KEY (id_livro, id_autor),
    FOREIGN KEY (id_livro) REFERENCES livro(id_livro),
    FOREIGN KEY (id_autor) REFERENCES autor(id_autor)
);

-- TABELA CLIENTELIVRO
CREATE TABLE clientelivro (
    id_clientelivro INT AUTO_INCREMENT PRIMARY KEY,
    cpf_cliente VARCHAR(11) NOT NULL,
    id_livro INT NOT NULL,
    FOREIGN KEY (cpf_cliente) REFERENCES cliente(cpf),
    FOREIGN KEY (id_livro) REFERENCES livro(id_livro)
);

-- =============================================================================
-- INSERÇÃO DE DADOS DE TESTE
-- =============================================================================

-- DADOS AUTOR
INSERT INTO autor (id_autor, nome, data_nasc, data_morte) VALUES
(1,'Augusto','1997-02-10','2020-10-25'),
(2,'Mariana Silva','1985-07-14',NULL),
(3,'Carlos Almeida','1950-11-22','2015-03-02'),
(4,'Fernanda Costa','1992-09-08',NULL),
(5,'Ricardo Souza','1945-06-30','2010-01-15'),
(6,'Juliana Pereira','2000-12-01',NULL),
(7,'Paulo Henrique','1920-05-05','1999-04-17'),
(8,'Ana Beatriz','1988-08-19',NULL),
(9,'Luiz Fernando','1970-03-25','2023-02-20'),
(10,'Camila Rocha','1995-11-11',NULL),
(11,'Renata Lima','1980-03-12',NULL),
(12,'Fernando Castro','1975-07-25',NULL);

-- DADOS CATEGORIA
INSERT INTO categoria (id_categoria, nome, descricao) VALUES
(1, 'Romance', 'Histórias focadas em relacionamentos amorosos e emoções humanas.'),
(2, 'Ficção Científica', 'Explora futuros tecnológicos, viagens espaciais e realidades alternativas.'),
(3, 'Fantasia', 'Universos mágicos, criaturas míticas e aventuras épicas.'),
(4, 'Terror', 'Narrativas assustadoras que exploram o medo e o sobrenatural.'),
(5, 'Suspense', 'Histórias cheias de mistério, tensão e reviravoltas.'),
(6, 'Drama', 'Tramas focadas em conflitos emocionais e sociais.'),
(7, 'História', 'Livros baseados em fatos e acontecimentos históricos.'),
(8, 'Biografia', 'Relatos da vida de pessoas reais e suas trajetórias.'),
(9, 'Aventura', 'Explorações, jornadas perigosas e descobertas.'),
(10, 'Poesia', 'Expressões artísticas em versos e linguagem poética.');

-- DADOS CLIENTE
INSERT INTO cliente (cpf, nome, data_nasc, endereco, telefone) VALUES
('12345678901', 'João Pereira', '1990-05-12', 'Rua das Flores, 123 - São Paulo/SP', '(11) 98877-1122'),
('23456789012', 'Maria Oliveira', '1985-08-25', 'Av. Brasil, 456 - Rio de Janeiro/RJ', '(21) 97766-3344'),
('34567890123', 'Carlos Santos', '1978-02-10', 'Rua das Palmeiras, 789 - Belo Horizonte/MG', '(31) 98855-6677'),
('45678901234', 'Ana Costa', '1995-12-01', 'Rua da Liberdade, 55 - Salvador/BA', '(71) 99123-4455'),
('56789012345', 'Fernanda Almeida', '2000-07-19', 'Av. Independência, 222 - Porto Alegre/RS', '(51) 98456-7788'),
('67890123456', 'Ricardo Lima', '1982-03-08', 'Rua Central, 890 - Curitiba/PR', '(41) 98765-1122'),
('78901234567', 'Juliana Rocha', '1998-09-30', 'Travessa São José, 12 - Recife/PE', '(81) 99321-5566'),
('89012345678', 'Pedro Martins', '1975-11-22', 'Rua do Sol, 321 - Fortaleza/CE', '(85) 99654-7788'),
('90123456789', 'Camila Ferreira', '1993-06-15', 'Alameda das Acácias, 90 - Manaus/AM', '(92) 99234-8899'),
('01234567890', 'Lucas Souza', '1987-04-05', 'Rua Bela Vista, 45 - Florianópolis/SC', '(48) 99777-2233');

-- DADOS FILIAL
INSERT INTO filial (cnpj, razao_social, endereco, telefone) VALUES
('12345678000101', 'Filial Centro SP', 'Rua XV de Novembro, 100 - São Paulo/SP', '(11) 3333-1122'),
('23456789000102', 'Filial Zona Sul RJ', 'Av. Atlântica, 2000 - Rio de Janeiro/RJ', '(21) 3444-2233'),
('34567890000103', 'Filial Savassi BH', 'Rua da Bahia, 450 - Belo Horizonte/MG', '(31) 3555-3344'),
('45678901000104', 'Filial Comércio SSA', 'Praça da Sé, 77 - Salvador/BA', '(71) 3666-4455'),
('56789012000105', 'Filial Moinhos POA', 'Rua Padre Chagas, 321 - Porto Alegre/RS', '(51) 3777-5566'),
('67890123000106', 'Filial Batel CTBA', 'Av. Batel, 999 - Curitiba/PR', '(41) 3888-6677'),
('78901234000107', 'Filial Boa Viagem REC', 'Av. Boa Viagem, 1234 - Recife/PE', '(81) 3999-7788'),
('89012345000108', 'Filial Aldeota FOR', 'Rua Barbosa de Freitas, 567 - Fortaleza/CE', '(85) 3111-8899'),
('90123456000109', 'Filial Ponta Negra NAT', 'Av. Engenheiro Roberto Freire, 432 - Natal/RN', '(84) 3222-9900'),
('01234567000110', 'Filial Centro FLN', 'Rua Felipe Schmidt, 250 - Florianópolis/SC', '(48) 3334-1122');

-- DADOS LIVRO
INSERT INTO livro (id_livro, titulo, ano_publicacao, situacao, id_categoria, cnpj_filial) VALUES
(1, 'O Mistério da Serra', 2005, 'Disponível', 1, '12345678000101'),
(2, 'Além das Estrelas', 2010, 'Emprestado', 2, '23456789000102'),
(3, 'Sombras do Passado', 1998, 'Disponível', 3, '34567890000103'),
(4, 'A Jornada Perdida', 2015, 'Disponível', 4, '45678901000104'),
(5, 'Ecos do Amanhã', 2020, 'Emprestado', 5, '56789012000105'),
(6, 'O Último Guardião', 2003, 'Disponível', 6, '67890123000106'),
(7, 'Luzes da Cidade', 2018, 'Disponível', 7, '78901234000107'),
(8, 'Segredos da Floresta', 2007, 'Emprestado', 8, '89012345000108'),
(9, 'Horizontes Distantes', 2012, 'Disponível', 9, '90123456000109'),
(10, 'Memórias Inacabadas', 1995, 'Disponível', 10, '01234567000110'),
(11, 'Noite de Terror', 2021, 'Disponível', 4, '12345678000101'),
(12, 'Viagem Fantástica', 2019, 'Emprestado', 3, '23456789000102'),
(13, 'Amor Proibido', 2016, 'Disponível', 1, '34567890000103');

-- DADOS AUTORLIVRO
INSERT INTO autorlivro (id_livro, id_autor, participacao) VALUES
(1,1,'Principal'),
(2,2,'Coautor'),
(3,3,'Principal'),
(4,4,'Principal'),
(5,5,'Principal'),
(6,6,'Principal'),
(7,7,'Principal'),
(8,8,'Coautor'),
(9,9,'Principal'),
(10,10,'Principal'),
(11,11,'Principal'),
(12,12,'Principal'),
(13,2,'Coautor');

-- DADOS CLIENTELIVRO
INSERT INTO clientelivro (cpf_cliente, id_livro) VALUES
('12345678901', 1),
('23456789012', 2),
('34567890123', 3),
('45678901234', 4),
('56789012345', 5),
('67890123456', 6),
('78901234567', 7),
('89012345678', 8),
('90123456789', 9),
('01234567890', 10),
('12345678901', 11),
('23456789012', 12),
('34567890123', 13);
