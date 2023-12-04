-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/11/2023 às 00:08
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `monitoramento_reparos`
--
CREATE DATABASE `monitoramento_reparos`;
USE `monitoramento_reparos`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `ID` int(11) NOT NULL,
  `ID_Reparo` int(11) NOT NULL,
  `Path` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `direcao`
--

CREATE TABLE `direcao` (
  `Login` varchar(30) NOT NULL,
  `Senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `direcao`
--

INSERT INTO `direcao` (`Login`, `Senha`) VALUES
('direcao', 'direcao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dispositivo`
--

CREATE TABLE `dispositivo` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Problema` varchar(50) NOT NULL,
  `Quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dispositivo_reparo`
--

CREATE TABLE `dispositivo_reparo` (
  `ID_Dispositivo` int(11) NOT NULL,
  `ID_Reparo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `monitor`
--

CREATE TABLE `monitor` (
  `Login` varchar(30) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Senha` varchar(30) NOT NULL,
  `Login_Professor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `monitor`
--

INSERT INTO `monitor` (`Login`, `Nome`, `Senha`, `Login_Professor`) VALUES
('isa_belle', 'isabelle', 'senha123', NULL),
('nico_li', 'nicoli kassa', 'senha123', NULL),
('ste_phanie', 'stephanie', 'senha123', NULL),
('vic_tor', 'victor bello', 'senha123', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `ID` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `laboratorio` varchar(15) NOT NULL,
  `problema` varchar(30) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `responsavel` varchar(30) NOT NULL,
  `login_prof` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocorrencias-arquivadas`
--

CREATE TABLE `ocorrencias-arquivadas` (
  `ID` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `laboratorio` varchar(15) NOT NULL,
  `problema` varchar(30) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `responsavel` varchar(30) NOT NULL,
  `login` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `Login` varchar(30) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Senha` varchar(30) NOT NULL,
  `Login_Direcao` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`Login`, `Nome`, `Senha`, `Login_Direcao`) VALUES
('j_amaral', 'amaral', 'senha123', 'direcao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reparo`
--

CREATE TABLE `reparo` (
  `ID` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Acao` varchar(300) NOT NULL,
  `Problemas_Nao_Solucionados` varchar(300) NOT NULL,
  `Responsavel` varchar(30) NOT NULL,
  `Login_Monitor` varchar(30) DEFAULT NULL,
  `Laboratorio` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ID_Reparo` (`ID_Reparo`);

--
-- Índices de tabela `direcao`
--
ALTER TABLE `direcao`
  ADD PRIMARY KEY (`Login`);

--
-- Índices de tabela `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `dispositivo_reparo`
--
ALTER TABLE `dispositivo_reparo`
  ADD PRIMARY KEY (`ID_Dispositivo`) USING BTREE,
  ADD KEY `FK_dispositivo` (`ID_Dispositivo`) USING BTREE,
  ADD KEY `FK_reparo` (`ID_Reparo`);

--
-- Índices de tabela `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`Login`),
  ADD KEY `FK_professor` (`Login_Professor`);

--
-- Índices de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `prof_ocorrencias` (`login_prof`);

--
-- Índices de tabela `ocorrencias-arquivadas`
--

ALTER TABLE `ocorrencias-arquivadas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `log_direcao` (`login`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`Login`),
  ADD KEY `FK_direcao` (`Login_Direcao`);

--
-- Índices de tabela `reparo`
--
ALTER TABLE `reparo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Monitor` (`Login_Monitor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de tabela `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=986;

--
-- AUTO_INCREMENT de tabela `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `ocorrencias-arquivadas`
--

ALTER TABLE `ocorrencias-arquivadas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `reparo`
--
ALTER TABLE `reparo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `FK_ID_Reparo` FOREIGN KEY (`ID_Reparo`) REFERENCES `reparo` (`ID`) ON DELETE CASCADE;

--
-- Restrições para tabelas `dispositivo_reparo`
--
ALTER TABLE `dispositivo_reparo`
  ADD CONSTRAINT `FK_dispositivo` FOREIGN KEY (`ID_Dispositivo`) REFERENCES `dispositivo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reparo` FOREIGN KEY (`ID_Reparo`) REFERENCES `reparo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `monitor`
--
ALTER TABLE `monitor`
  ADD CONSTRAINT `FK_professor` FOREIGN KEY (`Login_Professor`) REFERENCES `professor` (`Login`) ON DELETE SET NULL;

--
-- Restrições para tabelas `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD CONSTRAINT `prof_ocorrencias` FOREIGN KEY (`login_prof`) REFERENCES `professor` (`Login`) ON DELETE SET NULL;

--
-- Restrições para tabelas `ocorrencias-arquivadas`
--

ALTER TABLE `ocorrencias-arquivadas`
  ADD CONSTRAINT `log_direcao` FOREIGN KEY (`login`) REFERENCES `direcao` (`Login`) ON DELETE SET NULL;

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `FK_direcao` FOREIGN KEY (`Login_Direcao`) REFERENCES `direcao` (`Login`);

--
-- Restrições para tabelas `reparo`
--
ALTER TABLE `reparo`
  ADD CONSTRAINT `FK_Monitor` FOREIGN KEY (`Login_Monitor`) REFERENCES `monitor` (`Login`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;