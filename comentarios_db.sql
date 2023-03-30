-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tempo de geração: 03-11-2021 a las 00:55:57
-- Versão do servidor: 10.4.20-MariaDB
-- Versão de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dados: `comentarios_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela para a tabela `tbl_comentarios`
--

CREATE TABLE `tbl_comentarios` (
  `co_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `comentarios` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `comentario_nombre` varchar(40) CHARACTER SET utf8 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*
co_id: número inteiro de 11 dígitos, identifica cada registro na tabela.
 Essa coluna é (NOT NULL), significa que um valor precisa ser fornecido 
 para essa coluna durante a inserção de novos registros.
*/

--
-- Despejo de dados para a tabela `tbl_comentarios`
--

INSERT INTO `tbl_comentarios` (`co_id`, `parent_id`, `comentarios`, `comentario_nombre`, `fecha`) VALUES
(22, 0, 'teste 👍', 'josé igor', '2023-01-30 06:26:18'),
(23, 22, 'isso 😊👍', 'Web', '2023-01-01 30:26:47'),
(24, 0, 'teste de comentarios', 'web', '2023-01-03 06:27:21');

--
-- Índices para tabelas de despejo
--

--
-- índices de tabela `tbl_comentarios`
--
ALTER TABLE `tbl_comentarios`
  ADD PRIMARY KEY (`co_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT da tabela `tbl_comentarios`
--
ALTER TABLE `tbl_comentarios`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
