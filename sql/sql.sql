-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Set-2015 às 04:05
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `infolog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nomeGrupo` varchar(255) NOT NULL,
  PRIMARY KEY (`idGrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `nomeGrupo`) VALUES
(1, 'Hardware');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `idGrupo` int(11) DEFAULT NULL,
  `idUnMedida` int(11) DEFAULT NULL,
  `codBarras` varchar(255) NOT NULL,
  `nomeProduto` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `valorVenda` decimal(10,2) NOT NULL,
  `estoqueMin` varchar(255) NOT NULL,
  `descProduto` varchar(255) NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `fk_produto_grupo` (`idGrupo`),
  KEY `fk_produto_medida` (`idUnMedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `idGrupo`, `idUnMedida`, `codBarras`, `nomeProduto`, `valorVenda`, `estoqueMin`, `descProduto`) VALUES
(1, 1, 1, '1018962', 'HP-MFP LJ Pro M127fn ', '700.85', '2', 'Impressora HP M127fn'),
(2, 1, 1, '11552233', 'Lâmpada dicróica', '15.00', '10', 'Lâmpada dicróica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidademedida`
--

CREATE TABLE IF NOT EXISTS `unidademedida` (
  `idUnMedida` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUnMedida` varchar(255) NOT NULL,
  PRIMARY KEY (`idUnMedida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `unidademedida`
--

INSERT INTO `unidademedida` (`idUnMedida`, `nomeUnMedida`) VALUES
(1, 'Peça');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_grupo` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`),
  ADD CONSTRAINT `fk_produto_medida` FOREIGN KEY (`idUnMedida`) REFERENCES `unidademedida` (`idUnMedida`);
