-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: mysql.sucurihc.org
-- Generation Time: Apr 29, 2016 at 01:43 AM
-- Server version: 5.6.25-log
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sucurihc_ctf`
--

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE latin1_bin NOT NULL,
  `inicio` datetime NOT NULL,
  `formatoflag` varchar(255) COLLATE latin1_bin NOT NULL,
  `link_evento` varchar(255) COLLATE latin1_bin NOT NULL,
  `link_score` varchar(255) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Table structure for table `flag`
--

CREATE TABLE `flag` (
  `idflag` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `resposta` varchar(200) NOT NULL,
  `evento` int(11) NOT NULL,
  `valor` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `confirmacao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resolvidas`
--

CREATE TABLE `resolvidas` (
  `id` int(11) NOT NULL,
  `flagid` int(15) NOT NULL,
  `userid` int(15) NOT NULL,
  `valor` int(11) NOT NULL,
  `evento` varchar(255) NOT NULL DEFAULT '',
  `dhresposta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id_score` int(11) NOT NULL,
  `score` bigint(20) NOT NULL,
  `iduser` int(15) NOT NULL,
  `time` datetime NOT NULL,
  `evento` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------------------

--
-- Estrutura da tabela `recuperacao`
--

CREATE TABLE recuperacao (
  utilizador  VARCHAR(255) NOT NULL,
  confirmacao VARCHAR(40) NOT NULL,
  KEY(utilizador, confirmacao)
)


-- --------------------------------------------------------

--
-- Table structure for table `sr_usuarios_secret`
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
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `idteam` int(11) NOT NULL,
  `nome` varchar(255) COLLATE latin1_bin NOT NULL,
  `hash` varchar(255) COLLATE latin1_bin NOT NULL,
  `adm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `flag`
--
ALTER TABLE `flag`
  ADD PRIMARY KEY (`idflag`),
  ADD KEY `evento_fk_idx` (`evento`);

--
-- Indexes for table `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`,`confirmacao`);

--
-- Indexes for table `resolvidas`
--
ALTER TABLE `resolvidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `flagid` (`flagid`,`userid`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id_score`),
  ADD UNIQUE KEY `iduser` (`iduser`,`evento`);

--
-- Indexes for table `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idteam_idx` (`idteam`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`idteam`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`),
  ADD UNIQUE KEY `hash_UNIQUE` (`hash`),
  ADD KEY `adm_fk_idx` (`adm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `flag`
--
ALTER TABLE `flag`
  MODIFY `idflag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `resolvidas`
--
ALTER TABLE `resolvidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2787;
--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21371;
--
-- AUTO_INCREMENT for table `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `idteam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flag`
--
ALTER TABLE `flag`
  ADD CONSTRAINT `evento_fk` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sr_usuarios_secret`
--
ALTER TABLE `sr_usuarios_secret`
  ADD CONSTRAINT `idteam` FOREIGN KEY (`idteam`) REFERENCES `team` (`idteam`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `adm_fk` FOREIGN KEY (`adm`) REFERENCES `sr_usuarios_secret` (`Id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
