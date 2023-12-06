-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06/12/2023 às 12:31
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
-- Banco de dados: monitoramento_reparos
--

CREATE DATABASE monitoramento_reparos;
USE monitoramento_reparos;

-- --------------------------------------------------------

--
-- Estrutura para tabela arquivos
--

CREATE TABLE arquivos (
  ID int(11) NOT NULL,
  ID_Reparo int(11) NOT NULL,
  Path varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela arquivos
--

INSERT INTO arquivos (ID, ID_Reparo, Path) VALUES
(94, 119, '../../arquivos/657050c4c6da5.png'),
(95, 119, '../../arquivos/657050c4c87b0.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela direcao
--

CREATE TABLE direcao (
  Login varchar(30) NOT NULL,
  Senha varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela direcao
--

INSERT INTO direcao (Login, Senha) VALUES
('direcao', 'direcao');

-- --------------------------------------------------------

--
-- Estrutura para tabela dispositivo
--

CREATE TABLE dispositivo (
  ID int(11) NOT NULL,
  Nome varchar(30) NOT NULL,
  Problema varchar(50) NOT NULL,
  Quantidade int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela dispositivo
--

INSERT INTO dispositivo (ID, Nome, Problema, Quantidade) VALUES
(986, 'Apps', 'Desatualizado', 4),
(987, 'Fonte', '', 0),
(988, 'HD', '', 0),
(989, 'Monitor', '', 0),
(990, 'Mouse', '', 0),
(991, 'Teclado', '', 0),
(992, 'Windows', '', 0),
(993, 'Apps', 'Desatualizado', 5),
(994, 'Fonte', 'Quebrado', 3),
(995, 'HD', 'Corrompido', 2),
(996, 'Monitor', '', 0),
(997, 'Mouse', '', 0),
(998, 'Teclado', '', 0),
(999, 'Windows', '', 0),
(1000, 'Apps', '', 0),
(1001, 'Fonte', '', 0),
(1002, 'HD', '', 0),
(1003, 'Monitor', '', 0),
(1004, 'Mouse', '', 0),
(1005, 'Teclado', '', 0),
(1006, 'Windows', '', 0),
(1007, 'Apps', '', 0),
(1008, 'Fonte', '', 0),
(1009, 'HD', '', 0),
(1010, 'Monitor', '', 0),
(1011, 'Mouse', '', 0),
(1012, 'Teclado', '', 0),
(1013, 'Windows', '', 0),
(1014, 'Apps', '', 0),
(1015, 'Fonte', '', 0),
(1016, 'HD', '', 0),
(1017, 'Monitor', '', 0),
(1018, 'Mouse', '', 0),
(1019, 'Teclado', '', 0),
(1020, 'Windows', '', 0),
(1021, 'Apps', '', 0),
(1022, 'Fonte', '', 0),
(1023, 'HD', '', 0),
(1024, 'Monitor', '', 0),
(1025, 'Mouse', '', 0),
(1026, 'Teclado', '', 0),
(1027, 'Windows', '', 0),
(1028, 'Apps', '', 0),
(1029, 'Fonte', '', 0),
(1030, 'HD', '', 0),
(1031, 'Monitor', '', 0),
(1032, 'Mouse', '', 0),
(1033, 'Teclado', '', 0),
(1034, 'Windows', '', 0),
(1035, 'Apps', '', 0),
(1036, 'Fonte', '', 0),
(1037, 'HD', '', 0),
(1038, 'Monitor', '', 0),
(1039, 'Mouse', '', 0),
(1040, 'Teclado', '', 0),
(1041, 'Windows', '', 0),
(1042, 'Apps', '', 0),
(1043, 'Fonte', '', 0),
(1044, 'HD', '', 0),
(1045, 'Monitor', '', 0),
(1046, 'Mouse', '', 0),
(1047, 'Teclado', '', 0),
(1048, 'Windows', '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela dispositivo_reparo
--

CREATE TABLE dispositivo_reparo (
  ID_Dispositivo int(11) NOT NULL,
  ID_Reparo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela dispositivo_reparo
--

INSERT INTO dispositivo_reparo (ID_Dispositivo, ID_Reparo) VALUES
(986, 111),
(987, 111),
(988, 111),
(989, 111),
(990, 111),
(991, 111),
(992, 111),
(993, 112),
(994, 112),
(995, 112),
(996, 112),
(997, 112),
(998, 112),
(999, 112),
(1042, 119),
(1043, 119),
(1044, 119),
(1045, 119),
(1046, 119),
(1047, 119),
(1048, 119);

-- --------------------------------------------------------

--
-- Estrutura para tabela monitor
--

CREATE TABLE monitor (
  Login varchar(30) NOT NULL,
  Nome varchar(30) NOT NULL,
  Senha varchar(30) NOT NULL,
  Login_Professor varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela monitor
--

INSERT INTO monitor (Login, Nome, Senha, Login_Professor) VALUES
('isa_belle', 'isabelle', 'senha123', NULL),
('nico_li', 'nicoli kassa', 'senha123', NULL),
('ste_phanie', 'stephanie', 'senha123', NULL),
('vic_tor', 'victor bello', 'senha123', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela ocorrencia
--

CREATE TABLE ocorrencia (
  ID int(11) NOT NULL,
  data date NOT NULL,
  titulo varchar(150) NOT NULL,
  laboratorio varchar(15) NOT NULL,
  problema varchar(30) NOT NULL,
  descricao varchar(500) NOT NULL,
  responsavel varchar(30) NOT NULL,
  arquivado varchar(5) NOT NULL,
  login_prof varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela ocorrencia
--

INSERT INTO ocorrencia (ID, data, titulo, laboratorio, problema, descricao, responsavel, arquivado, login_prof) VALUES
(83, '2023-11-26', 'aaaaaaaaa', 'Lab 3', 'Cadeiras desorganizadas', 'aaaaaaaaa', 'amaral', 'não', 'j_amaral'),
(84, '2023-07-15', 'Interrupção na Conexão Online', 'Lab 3', 'Falta de internet', 'Os usuários do Laboratório 3 relataram uma interrupção completa na conexão à internet. Isso afetou o andamento de pesquisas online e acesso a recursos essenciais para as atividades práticas.', 'amaral', 'não', 'j_amaral'),
(85, '2023-04-05', 'Caos nos equipamentos', 'Lab 2', 'Computadores desorganizados', 'Os computadores no Laboratório 2 foram encontrados em estado caótico, com cabos emaranhados, teclados fora de lugar e monitores desalinhados. Isso dificultou o uso eficiente dos recursos pelos usuários.', 'amaral', 'não', 'j_amaral'),
(86, '2023-02-02', 'Desaparecimento de pen drive', 'Lab 1', 'Sumiço de dispositivos', 'Um dispositivo importante desapareceu misteriosamente do Laboratório 1. Os usuários estão preocupados com a perda de dados e funcionalidades essenciais relacionadas ao dispositivo.', 'amaral', 'não', 'j_amaral'),
(87, '2023-05-10', 'Avaria Crítica', 'Lab 4', 'Dispositivo quebrado', 'Um dispositivo vital no Laboratório 4 sofreu danos consideráveis, impossibilitando o uso normal. Isso impactou negativamente as atividades experimentais e de análise realizadas no local.', 'amaral', 'não', 'j_amaral'),
(88, '2023-03-03', 'Cadeiras amontoadas', 'Lab 2', 'Cadeiras desorganizadas', 'As cadeiras no Laboratório 2 foram encontradas em desordem, com ajustes de altura e inclinação modificados. Isso causou desconforto e afetou a postura dos usuários durante a aula.', 'amaral', 'não', 'j_amaral'),
(89, '2023-06-18', 'Conexões interrompidas', 'Lab 3', 'Cabos desconectados', 'Várias conexões importantes foram descobertas desconectadas no Laboratório 3. Isso resultou em falhas de comunicação entre dispositivos, prejudicando o funcionamento adequado dos sistemas.', 'amaral', 'não', 'j_amaral'),
(90, '2023-01-08', 'Interrupção Elétrica', 'Lab 1', 'Disjuntor desligado', 'Houve uma interrupção temporária no Laboratório 1 devido ao desligamento do disjuntor. Isso causou a perda momentânea de energia, afetando brevemente o progresso das atividades.', 'amaral', 'não', 'j_amaral'),
(91, '2023-08-25', 'Janela aberta ao chegar de manhã', 'Lab 4', 'Janela aberta', 'Uma janela foi deixada aberta no Laboratório 4, causando uma leve interferência nos computadores, visto que choveu durante a noite. Isso demandou ajustes e correções.', 'amaral', 'não', 'j_amaral'),
(92, '2023-09-12', 'Apagão inesperado', 'Lab 2', 'Queda de energia', 'Uma queda de energia súbita ocorreu no Laboratório 2, interrompendo temporariamente todas as atividades. Isso levou à perda de progresso e à necessidade de reinicialização de alguns sistemas.', 'amaral', 'não', 'j_amaral'),
(93, '2023-07-07', 'Máquinas foram trocadas de lugar', 'Lab 3', 'Computadores desorganizados', 'Os computadores no Laboratório 3 foram encontrados bagunçados, com arquivos misturados, áreas de trabalho desorganizadas e programas desconfigurados, dificultando o uso eficiente dos recursos.', 'amaral', 'não', 'j_amaral'),
(94, '2022-02-22', 'Falha Crítica de Equipamento', 'Lab 1', 'Dispositivo quebrado', 'Mouses do Laboratório 1 foram descobertos danificados, impossibilitando suas utilizações. Isso causou a interrupção de experimentos em andamento e atrasos nos projetos.', 'amaral', 'não', 'j_amaral'),
(95, '2022-06-11', 'Cadeiras fora da sala', 'Lab 4', 'Cadeiras desorganizadas', 'Ao chegar na sala, foi notada a falta de diversas cadeiras, o que fez com que alunos não pudessem usar os computadores.', 'amaral', 'não', 'j_amaral'),
(96, '2023-12-06', 'bbbbbbbb', 'Lab 2', 'Falta de internet', 'bbbbbbb', 'amaral', 'sim', 'j_amaral'),
(97, '2023-12-06', 'regthrtg', 'Lab 2', 'Sumiço de dispositivos', 'dgbfngh', 'amaral', 'não', 'j_amaral'),
(98, '2023-12-06', 'zzzzzzzzzz', 'Lab 2', 'Dispositivo quebrado', 'zzzzzzzzzzzz\n', 'amaral', 'não', 'j_amaral');

-- --------------------------------------------------------

--
-- Estrutura para tabela professor
--

CREATE TABLE professor (
  Login varchar(30) NOT NULL,
  Nome varchar(30) NOT NULL,
  Senha varchar(30) NOT NULL,
  Login_Direcao varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela professor
--

INSERT INTO professor (Login, Nome, Senha, Login_Direcao) VALUES
('fabi_ano', 'fabiano', 'senha123', 'direcao'),
('j_amaral', 'amaral', 'senha123', 'direcao');

-- --------------------------------------------------------

--
-- Estrutura para tabela reparo
--

CREATE TABLE reparo (
  ID int(11) NOT NULL,
  Data date NOT NULL,
  Acao varchar(300) NOT NULL,
  Problemas_Nao_Solucionados varchar(300) NOT NULL,
  Responsavel varchar(30) NOT NULL,
  Login_Monitor varchar(30) DEFAULT NULL,
  Laboratorio varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela reparo
--

INSERT INTO reparo (ID, Data, Acao, Problemas_Nao_Solucionados, Responsavel, Login_Monitor, Laboratorio) VALUES
(111, '2023-11-24', 'Atualizei quatro aplicativos', 'Fiz tudo.', 'stephanie', 'ste_phanie', 'Lab 4'),
(112, '2023-11-15', 'Foram consertados 2 HDs, que foram formatados e atualizados conforme a versão vigente de SO atualmente utilizado usado. Além disso, foram atualizados 5 aplicativos que estavam atrasados em relação aos outros computadores.', 'Não foi possível arrumar as fontes.', 'stephanie', 'ste_phanie', 'Lab 2'),
(119, '2023-12-06', 'dghfh', 'dgbhfh', 'stephanie', 'ste_phanie', 'Lab 2');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela arquivos
--
ALTER TABLE arquivos
  ADD PRIMARY KEY (ID),
  ADD KEY FK_ID_Reparo (ID_Reparo);

--
-- Índices de tabela direcao
--
ALTER TABLE direcao
  ADD PRIMARY KEY (Login);

--
-- Índices de tabela dispositivo
--
ALTER TABLE dispositivo
  ADD PRIMARY KEY (ID);

--
-- Índices de tabela dispositivo_reparo
--
ALTER TABLE dispositivo_reparo
  ADD PRIMARY KEY (ID_Dispositivo) USING BTREE,
  ADD KEY FK_dispositivo (ID_Dispositivo) USING BTREE,
  ADD KEY FK_reparo (ID_Reparo);

--
-- Índices de tabela monitor
--
ALTER TABLE monitor
  ADD PRIMARY KEY (Login),
  ADD KEY FK_professor (Login_Professor);

--
-- Índices de tabela ocorrencia
--
ALTER TABLE ocorrencia
  ADD PRIMARY KEY (ID),
  ADD KEY prof_ocorrencias (login_prof);

--
-- Índices de tabela professor
--
ALTER TABLE professor
  ADD PRIMARY KEY (Login),
  ADD KEY FK_direcao (Login_Direcao);

--
-- Índices de tabela reparo
--
ALTER TABLE reparo
  ADD PRIMARY KEY (ID),
  ADD KEY FK_Monitor (Login_Monitor);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela arquivos
--
ALTER TABLE arquivos
  MODIFY ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de tabela dispositivo
--
ALTER TABLE dispositivo
  MODIFY ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1049;

--
-- AUTO_INCREMENT de tabela ocorrencia
--
ALTER TABLE ocorrencia
  MODIFY ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela reparo
--
ALTER TABLE reparo
  MODIFY ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas arquivos
--
ALTER TABLE arquivos
  ADD CONSTRAINT FK_ID_Reparo FOREIGN KEY (ID_Reparo) REFERENCES reparo (ID) ON DELETE CASCADE;

--
-- Restrições para tabelas dispositivo_reparo
--
ALTER TABLE dispositivo_reparo
  ADD CONSTRAINT FK_dispositivo FOREIGN KEY (ID_Dispositivo) REFERENCES dispositivo (ID) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT FK_reparo FOREIGN KEY (ID_Reparo) REFERENCES reparo (ID) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas monitor
--
ALTER TABLE monitor
  ADD CONSTRAINT FK_professor FOREIGN KEY (Login_Professor) REFERENCES professor (Login) ON DELETE SET NULL;

--
-- Restrições para tabelas ocorrencia
--
ALTER TABLE ocorrencia
  ADD CONSTRAINT prof_ocorrencias FOREIGN KEY (login_prof) REFERENCES professor (Login) ON DELETE SET NULL;

--
-- Restrições para tabelas professor
--
ALTER TABLE professor
  ADD CONSTRAINT FK_direcao FOREIGN KEY (Login_Direcao) REFERENCES direcao (Login);

--
-- Restrições para tabelas reparo
--
ALTER TABLE reparo
  ADD CONSTRAINT FK_Monitor FOREIGN KEY (Login_Monitor) REFERENCES monitor (Login) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
