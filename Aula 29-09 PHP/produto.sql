-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/10/2025 às 03:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `baseteste`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `perecivel` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`codigo`, `nome`, `valor`, `perecivel`) VALUES
(1, 'Arroz 5kg', 22.50, 'Não-perecível'),
(2, 'Feijão Carioca 1kg', 8.90, 'Não-perecível'),
(3, 'Macarrão Espaguete', 5.75, 'Perecivel'),
(4, 'gabinete', 100.00, 'Perecivel'),
(5, 'Bolacha Trakinas', 5.20, 'Perecivel'),
(6, 'Arroz', 15.10, 'Perecivel'),
(7, 'monitor', 454.00, 'Não-perecível'),
(8, 'Iogurte Natural 170g', 3.60, 'Perecível'),
(9, 'Queijo Mussarela 500', 22.00, 'Perecível'),
(10, 'Presunto 200g', 9.50, 'Perecível'),
(11, 'Carne Bovina 1kg', 42.00, 'Perecível'),
(12, 'Frango Congelado 1kg', 15.00, 'Perecível'),
(13, 'Peixe Tilápia 1kg', 29.00, 'Perecível'),
(14, 'Margarina 500g', 8.20, 'Perecível'),
(15, 'Biscoito Recheado', 4.10, 'Não-perecível'),
(16, 'Farinha de Trigo 1kg', 6.50, 'Não-perecível'),
(17, 'Café Torrado 500g', 15.30, 'Não-perecível'),
(18, 'Achocolatado 400g', 9.80, 'Não-perecível'),
(19, 'Detergente 500ml', 2.50, 'Não-perecível'),
(20, 'Sabão em Pó 1kg', 9.90, 'Não-perecível'),
(21, 'Refrigerante 2L', 9.70, 'Perecível'),
(22, 'Suco Natural 1L', 10.50, 'Perecível'),
(23, 'Pão Francês 1kg', 14.00, 'Perecível'),
(24, 'Manteiga 200g', 12.30, 'Perecível'),
(25, 'Cereal Matinal 250g', 11.40, 'Não-perecível'),
(26, 'Arroz Integral 1kg', 9.10, 'Não-perecível'),
(27, 'Feijão Preto 1kg', 8.60, 'Não-perecível'),
(28, 'Molho de Tomate 340g', 4.50, 'Não-perecível'),
(29, 'Vinagre 750ml', 3.80, 'Não-perecível'),
(30, 'Leite Condensado 395', 6.90, 'Perecível'),
(31, 'Creme de Leite 200g', 5.70, 'Perecível'),
(32, 'Maionese 500g', 9.30, 'Perecível'),
(33, 'Ketchup 1kg', 10.00, 'Não-perecível'),
(34, 'Mostarda 1kg', 9.50, 'Não-perecível'),
(35, 'Farinha de Mandioca ', 6.20, 'Não-perecível'),
(36, 'Chocolate em Barra 1', 7.80, 'Não-perecível'),
(37, 'Papel Higiênico 4un', 12.00, 'Não-perecível'),
(38, 'Sabonete 90g', 2.20, 'Não-perecível'),
(39, 'Shampoo 350ml', 14.50, 'Não-perecível'),
(40, 'Condicionador 350ml', 15.00, 'Não-perecível'),
(41, 'Água Mineral 1.5L', 3.20, 'Perecível'),
(42, 'Bala de Goma 100g', 2.90, 'Não-perecível'),
(43, 'Chá Mate 200g', 10.90, 'Não-perecível'),
(44, 'Biscoito Cream Crack', 5.30, 'Não-perecível'),
(45, 'Arroz Parboilizado 5', 24.00, 'Não-perecível'),
(46, 'Frutas Congeladas 1k', 18.50, 'Perecível'),
(47, 'Verduras Higienizada', 7.80, 'Perecível'),
(48, 'Leite Desnatado 1L', 6.30, 'Perecível'),
(49, 'Iogurte Grego 100g', 4.80, 'Perecível'),
(50, 'Carne Suína 1kg', 27.00, 'Perecivel');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
