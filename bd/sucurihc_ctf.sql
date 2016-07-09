-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql.sucurihc.org
-- Tempo de geração: 09/07/2016 às 06:02
-- Versão do servidor: 5.6.25-log
-- Versão do PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sucurihc_ctf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE latin1_bin NOT NULL,
  `inicio` datetime NOT NULL,
  `formatoflag` varchar(255) COLLATE latin1_bin NOT NULL,
  `link_evento` varchar(255) COLLATE latin1_bin NOT NULL,
  `link_score` varchar(255) COLLATE latin1_bin NOT NULL,
  `link_team` varchar(255) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `flag`
--

CREATE TABLE `flag` (
  `idflag` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `descricao` varchar(800) NOT NULL,
  `resposta` varchar(200) NOT NULL,
  `evento` int(11) NOT NULL,
  `valor` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `acesso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `resolvidas`
--

CREATE TABLE `resolvidas` (
  `id` int(11) NOT NULL,
  `flagid` int(15) NOT NULL,
  `userid` int(15) NOT NULL,
  `idteam` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `evento` varchar(255) NOT NULL DEFAULT '',
  `dhresposta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `score`
--

CREATE TABLE `score` (
  `id_score` int(11) NOT NULL,
  `score` bigint(20) NOT NULL,
  `iduser` int(15) NOT NULL,
  `time` datetime NOT NULL,
  `evento` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `scoreteam`
--

CREATE TABLE `scoreteam` (
  `id_score` int(11) NOT NULL,
  `score` bigint(20) NOT NULL,
  `idteam` int(15) NOT NULL,
  `time` datetime NOT NULL,
  `evento` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sr_usuarios_secret`
--

CREATE TABLE `sr_usuarios_secret` (
  `Id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `salt` char(128) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `idteam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `team`
--

CREATE TABLE `team` (
  `idteam` int(11) NOT NULL,
  `nome` varchar(255) COLLATE latin1_bin NOT NULL,
  `hash` varchar(255) COLLATE latin1_bin NOT NULL,
  `adm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `flag`
--
ALTER TABLE `flag`
  ADD PRIMARY KEY (`idflag`),
  ADD KEY `evento_fk_idx` (`evento`);

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`,`confirmacao`);

--
-- Índices de tabela `resolvidas`
--
ALTER TABLE `resolvidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flagid` (`flagid`,`userid`);

--
-- Índices de tabela `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id_score`),
  ADD UNIQUE KEY `iduser` (`iduser`,`evento`);

--
-- Índices de tabela `scoreteam`
--
ALTER TABLE `scoreteam`
  ADD PRIMARY KEY (`id_score`),
  ADD UNIQUE KEY `iduser` (`idteam`,`evento`);

--
-- Índices de tabela `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idteam_idx` (`idteam`);

--
-- Índices de tabela `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`idteam`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`),
  ADD UNIQUE KEY `hash_UNIQUE` (`hash`),
  ADD KEY `adm_fk_idx` (`adm`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `flag`
--
ALTER TABLE `flag`
  MODIFY `idflag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1758;
--
-- AUTO_INCREMENT de tabela `resolvidas`
--
ALTER TABLE `resolvidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5137;
--
-- AUTO_INCREMENT de tabela `score`
--
ALTER TABLE `score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40909;
--
-- AUTO_INCREMENT de tabela `scoreteam`
--
ALTER TABLE `scoreteam`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3717;
--
-- AUTO_INCREMENT de tabela `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=723;
--
-- AUTO_INCREMENT de tabela `team`
--
ALTER TABLE `team`
  MODIFY `idteam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `flag`
--
ALTER TABLE `flag`
  ADD CONSTRAINT `evento_fk` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  ADD CONSTRAINT `idteam` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `adm_fk` FOREIGN KEY (`adm`) REFERENCES `sr_usuarios_secret` (`Id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
