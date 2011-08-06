-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Ago 06, 2011 as 05:55 
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `bytestore`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fone` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `senha` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `endereco` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `endereco_num` char(5) CHARACTER SET utf8 DEFAULT NULL,
  `endereco_comp` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `cidade` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `uf` char(2) CHARACTER SET utf8 DEFAULT NULL,
  `cep` char(9) CHARACTER SET utf8 DEFAULT NULL,
  `cpf` char(11) CHARACTER SET utf8 DEFAULT NULL,
  `rg` char(15) CHARACTER SET utf8 DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empenho`
--

DROP TABLE IF EXISTS `empenho`;
CREATE TABLE IF NOT EXISTS `empenho` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `produto_id` int(5) NOT NULL,
  `fornecedor_id` int(5) NOT NULL,
  `nota` varchar(64) DEFAULT NULL,
  `valor` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `empenho_ibfk_1` (`produto_id`),
  KEY `empenho_ibfk_2` (`fornecedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) CHARACTER SET utf8 NOT NULL,
  `documento` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(5) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

DROP TABLE IF EXISTS `pedido_produto`;
CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `pedido_id` int(5) NOT NULL,
  `produto_id` int(5) NOT NULL,
  `qtde` float(8,2) NOT NULL,
  `valor` float(8,2) NOT NULL,
  `desconto` float(4,2) DEFAULT NULL,
  PRIMARY KEY (`pedido_id`,`produto_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) DEFAULT NULL,
  `descricao` text,
  `categoria_id` int(5) DEFAULT '1',
  `estoque` float(8,2) DEFAULT NULL,
  `valor` float(8,2) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_ibfk_1` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para visualizar `relatorio_empenhos`
--
DROP VIEW IF EXISTS `relatorio_empenhos`;
CREATE TABLE IF NOT EXISTS `relatorio_empenhos` (
`Produtos` varchar(341)
,`Fornecedor` varchar(128)
,`Total` double(19,2)
);
-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `login` varchar(24) DEFAULT NULL,
  `senha` varchar(256) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `nivel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura para visualizar `relatorio_empenhos`
--
DROP TABLE IF EXISTS `relatorio_empenhos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `relatorio_empenhos` AS (select group_concat(`p`.`nome` separator ',') AS `Produtos`,`f`.`nome` AS `Fornecedor`,sum(`e`.`valor`) AS `Total` from ((`produtos` `p` join `fornecedor` `f`) join `empenho` `e`) where ((`e`.`produto_id` = `p`.`id`) and (`e`.`fornecedor_id` = `f`.`id`)) group by `f`.`nome`);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para a tabela `pedido_produto`
--
ALTER TABLE `pedido_produto`
  ADD CONSTRAINT `pedido_produto_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedido_produto_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Restrições para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
