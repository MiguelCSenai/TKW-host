-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Jun-2025 às 02:51
-- Versão do servidor: 8.3.0
-- versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `the_kings_will`
--
CREATE DATABASE IF NOT EXISTS `the_kings_will` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `the_kings_will`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adms`
--

DROP TABLE IF EXISTS `adms`;
CREATE TABLE IF NOT EXISTS `adms` (
  `adm_id` int NOT NULL AUTO_INCREMENT,
  `adm_username` varchar(20) NOT NULL,
  `adm_password` varchar(20) NOT NULL,
  PRIMARY KEY (`adm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `adms`
--

INSERT INTO `adms` (`adm_id`, `adm_username`, `adm_password`) VALUES
(1, 'mnt.Dev', 'Miguel.2008'),
(2, 'RixxDev', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `armaduras`
--

DROP TABLE IF EXISTS `armaduras`;
CREATE TABLE IF NOT EXISTS `armaduras` (
  `arm_id` int NOT NULL AUTO_INCREMENT,
  `arm_nome` varchar(30) NOT NULL,
  `arm_natureza` varchar(20) NOT NULL,
  `arm_protecao` int NOT NULL,
  PRIMARY KEY (`arm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `armas`
--

DROP TABLE IF EXISTS `armas`;
CREATE TABLE IF NOT EXISTS `armas` (
  `wpn_id` int NOT NULL AUTO_INCREMENT,
  `wpn_nome` varchar(255) NOT NULL,
  `wpn_tipo` enum('Espada','Machado','Arco','Lança','Porrete','Adaga','Garras','Escudo','Foice','Bastão','Besta') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wpn_natureza` varchar(255) NOT NULL,
  `wpn_efeito` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wpn_dano` int NOT NULL,
  `wpn_velocidade` int NOT NULL,
  `wpn_alcance` int NOT NULL,
  `wpn_descricao` text NOT NULL,
  `wpn_icone` varchar(255) NOT NULL,
  PRIMARY KEY (`wpn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `armas`
--

INSERT INTO `armas` (`wpn_id`, `wpn_nome`, `wpn_tipo`, `wpn_natureza`, `wpn_efeito`, `wpn_dano`, `wpn_velocidade`, `wpn_alcance`, `wpn_descricao`, `wpn_icone`) VALUES
(1, 'Secreção De Subris', 'Espada', 'Sangue', 'Corrosão II', 4, 2, 3, 'Uma espada feita inteiramente de músculos e restos de Subris, em sua extremidade inferior a o globo ocular, por mero capricho, sua empunhadora é feita com o triceps do Subris enrolado por seu intestino delgado, no guarda-punho temos o figado do Subris, bombeando bile até a extremidade vazada da lamina, assim embuindo a arma em uma secreção corrosiva.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Espadas/Sangue/secrecao_de_subris.gif'),
(2, 'Espada Longa', 'Espada', 'Base', 'Nenhum', 6, 2, 3, 'Uma espada longa forjada com precisão e equilíbrio. Sua lâmina reta e afiada reflete o brilho do aço temperado, sendo ideal para golpes rápidos e precisos. O guarda-mão em formato de cruz proporciona proteção e estabilidade, enquanto o cabo revestido em couro garante uma pegada firme e confortável. No pomo, um ornamento metálico reforça a estrutura e o peso da arma, tornando-a confiável para qualquer guerreiro. Esta espada representa a simplicidade e eficácia de uma lâmina clássica, sem adornos mágicos ou influência de elementos sobrenaturais.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Espadas/Base/espada_base.gif'),
(3, 'Arco Grande', 'Arco', 'Base', 'Nenhum', 3, 4, 8, 'Um arco longo feito de madeira resistente e corda trançada com fibras naturais. Seu design simples e eficiente permite disparos precisos e poderosos, sendo uma escolha confiável para caçadores e guerreiros habilidosos. A empunhadura é suavemente esculpida para proporcionar conforto ao arqueiro, enquanto os extremos do arco são reforçados para garantir maior durabilidade. Uma arma versátil, ideal para combates à distância e emboscadas estratégicas.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Arcos/Base/arco_base.gif'),
(4, 'Machado de Duas Mãos', 'Machado', 'Base', 'Nenhum', 9, 1, 4, 'Um machado de batalha forjado com precisão e resistência. Sua lâmina larga e afiada, acompanhada de uma ponta perfurante, permite golpes devastadores e versatilidade em combate. O cabo longo, de madeira reforçada e envolto em couro, proporciona firmeza e equilíbrio, enquanto o reforço metálico na base adiciona durabilidade. Sem adornos mágicos, esta arma representa a força bruta e a eficácia de um armamento clássico.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Machados/Duas%20M%C3%A3os/Base/DHMachado_base.gif'),
(5, 'Presa Branca', 'Lança', 'Base', 'Nenhum', 5, 3, 6, 'Uma lança longa e equilibrada, forjada para precisão e versatilidade. Sua haste reforçada garante firmeza, enquanto a ponta principal, afiada e resistente, é ideal para perfurações devastadoras. Duas lâminas menores próximas à base da ponta ampliam seu potencial ofensivo, garantindo dano adicional caso a estocada atinja toda a profundidade. A guarda curva protege a empunhadura, permitindo firmeza no manuseio. Sem adornos mágicos, esta arma representa a letalidade pura e estratégica de uma lança clássica.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Lan%C3%A7as/Base/lanca-base.gif'),
(6, 'Ceifadora', 'Foice', 'Base', 'Nenhum', 6, 1, 5, 'Uma foice mortalmente afiada, projetada para cortes amplos e precisos. Sua lâmina curva, forjada em aço temperado, desliza com facilidade, dilacerando qualquer obstáculo em seu caminho. O cabo longo e reforçado proporciona alcance e firmeza no manuseio, enquanto a ponta metálica na base pode ser usada como arma secundária. Simples e letal, a Ceifadora representa a frieza e eficiência de uma lâmina criada para ceifar vidas com um único golpe.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Foices/Base/foice_base.gif'),
(9, 'Cascudo', 'Porrete', 'Base', 'Nenhum', 5, 3, 3, 'Um porrete bruto, esculpido de um único pedaço de madeira densa e resistente. Sua superfície irregular carrega marcas do tempo e do combate, tornando cada golpe imprevisível e devastador. Sem adornos, lâminas ou refinamento, o Cascudo é pura força bruta em forma de arma – ideal para quem prefere esmagar em vez de cortar. Uma extensão selvagem do guerreiro, perfeita para combates diretos e brutais.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Porretes/Base/porrete.gif'),
(8, 'Presas', 'Adaga', 'Base', 'Nenhum', 4, 4, 2, 'Um par de adagas afiadas como dentes predadores, forjadas para velocidade e precisão. Suas lâminas são envoltas por um brilho frio, ideais para ataques rápidos e silenciosos. Os cabos detalhados, reforçados, oferecem firmeza e controle absoluto em combate. Leves e mortais, as Presas são a escolha perfeita para guerreiros ágeis que preferem eliminar seus inimigos antes que percebam o perigo.', 'https://raw.githubusercontent.com/MiguelCSenai/TheKingsWill/refs/heads/main/Armas/Gifs/Adagas/Base/adagas_base.gif');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `cla_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cla_nome` varchar(25) NOT NULL,
  PRIMARY KEY (`cla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `classes`
--

INSERT INTO `classes` (`cla_id`, `cla_nome`) VALUES
(1, 'Desertor'),
(2, 'Caçador'),
(3, 'Conjurador'),
(4, 'Bobo da Corte');

-- --------------------------------------------------------

--
-- Estrutura da tabela `efeitos`
--

DROP TABLE IF EXISTS `efeitos`;
CREATE TABLE IF NOT EXISTS `efeitos` (
  `eft_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `eft_nome` varchar(255) NOT NULL,
  `eft_descricao` text NOT NULL,
  `eft_cor` char(7) NOT NULL DEFAULT '#000000',
  `eft_duracao` int DEFAULT NULL,
  PRIMARY KEY (`eft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `efeitos`
--

INSERT INTO `efeitos` (`eft_id`, `eft_nome`, `eft_descricao`, `eft_cor`, `eft_duracao`) VALUES
(1, 'Sangramento', 'Jogador afetado perde 5 pontos HP', '#ff0000', 5),
(2, 'Corrosão I', 'Diminui a vida máxima por 25% durante 3 turnos e causa 4 de dano por 1d4 turnos.', '#369d34', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inventario`
--

DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `inv_id` int NOT NULL AUTO_INCREMENT,
  `itm_id` int DEFAULT NULL,
  `pla_id` int NOT NULL,
  `wpn_id` int DEFAULT NULL,
  `mag_id` int DEFAULT NULL,
  `eft_id` int DEFAULT NULL,
  `eft_duracao` int DEFAULT NULL,
  PRIMARY KEY (`inv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `inventario`
--

INSERT INTO `inventario` (`inv_id`, `itm_id`, `pla_id`, `wpn_id`, `mag_id`, `eft_id`, `eft_duracao`) VALUES
(1, 1, 206, NULL, NULL, NULL, NULL),
(2, 1, 206, NULL, NULL, NULL, NULL),
(3, 1, 206, NULL, NULL, NULL, NULL),
(4, 1, 206, NULL, NULL, NULL, NULL),
(5, 1, 208, NULL, NULL, NULL, NULL),
(10, 1, 208, NULL, NULL, NULL, NULL),
(11, 1, 209, NULL, NULL, NULL, NULL),
(17, NULL, 208, 1, NULL, NULL, NULL),
(18, NULL, 208, 5, NULL, NULL, NULL),
(19, NULL, 210, 1, NULL, NULL, NULL),
(20, NULL, 210, 5, NULL, NULL, NULL),
(21, NULL, 211, 5, NULL, NULL, NULL),
(22, NULL, 211, 1, NULL, NULL, NULL),
(23, 1, 210, NULL, NULL, NULL, NULL),
(24, 1, 210, NULL, NULL, NULL, NULL),
(25, 1, 210, NULL, NULL, NULL, NULL),
(26, 1, 210, NULL, NULL, NULL, NULL),
(27, 1, 212, NULL, NULL, NULL, NULL),
(28, 1, 212, NULL, NULL, NULL, NULL),
(29, 1, 212, NULL, NULL, NULL, NULL),
(30, 1, 212, NULL, NULL, NULL, NULL),
(31, 1, 212, NULL, NULL, NULL, NULL),
(32, 1, 212, NULL, NULL, NULL, NULL),
(33, 1, 212, NULL, NULL, NULL, NULL),
(34, 1, 212, NULL, NULL, NULL, NULL),
(35, NULL, 212, 3, NULL, NULL, NULL),
(36, NULL, 212, 6, NULL, NULL, NULL),
(37, NULL, 213, 1, NULL, NULL, NULL),
(38, NULL, 213, 8, NULL, NULL, NULL),
(39, 1, 214, NULL, NULL, NULL, NULL),
(40, 1, 214, NULL, NULL, NULL, NULL),
(41, 1, 214, NULL, NULL, NULL, NULL),
(42, 1, 214, NULL, NULL, NULL, NULL),
(43, 1, 214, NULL, NULL, NULL, NULL),
(44, 1, 214, NULL, NULL, NULL, NULL),
(45, 1, 214, NULL, NULL, NULL, NULL),
(46, 1, 214, NULL, NULL, NULL, NULL),
(47, 1, 214, NULL, NULL, NULL, NULL),
(48, 1, 214, NULL, NULL, NULL, NULL),
(49, 1, 215, NULL, NULL, NULL, NULL),
(50, 1, 215, NULL, NULL, NULL, NULL),
(51, 1, 215, NULL, NULL, NULL, NULL),
(52, 1, 215, NULL, NULL, NULL, NULL),
(53, 1, 215, NULL, NULL, NULL, NULL),
(54, NULL, 214, 1, NULL, NULL, NULL),
(55, NULL, 214, 8, NULL, NULL, NULL),
(57, NULL, 215, 2, NULL, NULL, NULL),
(59, NULL, 215, 4, NULL, NULL, NULL),
(60, NULL, 216, 4, NULL, NULL, NULL),
(61, NULL, 216, 1, NULL, NULL, NULL),
(62, NULL, 217, NULL, 1, NULL, NULL),
(96, NULL, 225, 4, NULL, NULL, NULL),
(98, NULL, 243, NULL, 1, NULL, NULL),
(99, NULL, 243, NULL, 1, NULL, NULL),
(100, NULL, 243, NULL, 1, NULL, NULL),
(101, NULL, 243, NULL, 1, NULL, NULL),
(112, NULL, 252, NULL, NULL, 1, 6),
(113, NULL, 260, NULL, NULL, 1, 4),
(114, NULL, 267, NULL, NULL, 1, 4),
(115, NULL, 276, NULL, NULL, 1, 4),
(116, NULL, 278, NULL, NULL, 1, 4),
(118, NULL, 287, NULL, NULL, 1, 4),
(119, NULL, 291, NULL, NULL, 1, 2),
(120, NULL, 293, NULL, NULL, 1, 2),
(121, NULL, 295, NULL, NULL, 1, 2),
(122, NULL, 297, NULL, NULL, 1, 2),
(123, NULL, 299, NULL, NULL, 1, 2),
(124, NULL, 301, NULL, NULL, 1, 2),
(125, NULL, 304, NULL, NULL, 1, 2),
(126, NULL, 305, NULL, NULL, 1, 2),
(127, NULL, 307, NULL, NULL, 2, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `itm_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `itm_nome` varchar(30) NOT NULL,
  `itm_tipo` enum('Poções','Armas secundarias') NOT NULL,
  `itm_efeito` enum('Cura','Corta veneno','Coagulação','Dano') NOT NULL,
  `itm_potencia` int NOT NULL,
  `itm_img` text,
  PRIMARY KEY (`itm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `items`
--

INSERT INTO `items` (`itm_id`, `itm_nome`, `itm_tipo`, `itm_efeito`, `itm_potencia`, `itm_img`) VALUES
(1, 'Poção de Cura', 'Poções', 'Cura', 10, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Potions/pngs/cura.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `magias`
--

DROP TABLE IF EXISTS `magias`;
CREATE TABLE IF NOT EXISTS `magias` (
  `mag_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `mag_nome` varchar(25) NOT NULL,
  `mag_descricao` text,
  `mag_conjuracao` int NOT NULL,
  `mag_icone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`mag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `magias`
--

INSERT INTO `magias` (`mag_id`, `mag_nome`, `mag_descricao`, `mag_conjuracao`, `mag_icone`) VALUES
(1, 'Cura média', 'Cura 50HP próprio ou de aliados.', 5, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Magias/cura_menor.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mestre`
--

DROP TABLE IF EXISTS `mestre`;
CREATE TABLE IF NOT EXISTS `mestre` (
  `mes_id` int NOT NULL AUTO_INCREMENT,
  `mes_lvl` int DEFAULT '1',
  `mes_turnos` int DEFAULT '0',
  `mes_creditos` int DEFAULT '1',
  `ses_id` int NOT NULL,
  PRIMARY KEY (`mes_id`),
  KEY `ses_id` (`ses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `mestre`
--

INSERT INTO `mestre` (`mes_id`, `mes_lvl`, `mes_turnos`, `mes_creditos`, `ses_id`) VALUES
(1, 1, 3, 0, 178),
(2, 1, 0, 0, 179),
(3, 1, 0, 1, 180),
(4, 5, 3, 32, 181),
(5, 1, 0, 1, 182),
(6, 1, 1, 0, 183),
(7, 1, 0, 1, 184),
(8, 1, 0, 1, 185),
(9, 1, 0, 1, 186),
(10, 1, 0, 1, 187),
(11, 1, 0, 1, 188),
(12, 1, 1, 2, 189),
(13, 1, 0, 1, 190),
(14, 1, 0, 1, 191),
(15, 1, 0, 1, 192),
(16, 1, 1, 1, 193),
(17, 1, 0, 1, 194),
(18, 1, 0, 1, 195),
(19, 1, 0, 1, 196),
(20, 3, 0, 17, 197),
(21, 1, 0, 1, 198),
(22, 1, 0, 0, 199),
(23, 1, 0, 1, 200),
(24, 1, 0, 1, 201),
(25, 1, 0, 1, 202),
(26, 1, 0, 1, 203),
(27, 1, 0, 1, 204),
(28, 1, 0, 1, 205),
(29, 1, 0, 1, 206),
(30, 1, 0, 1, 207),
(31, 1, 0, 1, 208),
(32, 1, 1, 1, 209),
(33, 1, 0, 1, 210),
(34, 1, 1, 1, 211),
(35, 1, 0, 1, 212),
(36, 1, 0, 1, 213),
(37, 1, 0, 0, 214),
(38, 1, 0, 0, 215),
(39, 1, 1, 1, 216),
(40, 1, 1, 1, 217),
(41, 1, 1, 1, 218),
(42, 1, 1, 0, 219),
(43, 1, 1, 0, 220),
(44, 1, 1, 0, 221),
(45, 1, 1, 0, 222),
(46, 1, 0, 1, 223),
(47, 1, 1, 0, 224),
(48, 1, 1, 0, 225),
(49, 1, 0, 1, 226);

-- --------------------------------------------------------

--
-- Estrutura da tabela `monstros`
--

DROP TABLE IF EXISTS `monstros`;
CREATE TABLE IF NOT EXISTS `monstros` (
  `mon_id` int NOT NULL AUTO_INCREMENT,
  `mon_nome` varchar(25) NOT NULL,
  `mon_natureza` enum('Sangue','Ossos','Visceras','Consciencia','Base') NOT NULL,
  `mon_HP` int NOT NULL DEFAULT '10',
  `mon_STR` int NOT NULL,
  `mon_AGI` int NOT NULL,
  `mon_INT` int NOT NULL,
  `mon_xp` int NOT NULL DEFAULT '10',
  `mon_x` int DEFAULT '1',
  `mon_y` int DEFAULT '7',
  `mon_bloco` int DEFAULT '4',
  `mon_icone` varchar(255) DEFAULT NULL,
  `mon_valor` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`mon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `monstros`
--

INSERT INTO `monstros` (`mon_id`, `mon_nome`, `mon_natureza`, `mon_HP`, `mon_STR`, `mon_AGI`, `mon_INT`, `mon_xp`, `mon_x`, `mon_y`, `mon_bloco`, `mon_icone`, `mon_valor`) VALUES
(1, 'Manequim', 'Sangue', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 1),
(2, 'Manequim', 'Sangue', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 2),
(3, 'Manequim', 'Ossos', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 1),
(4, 'Manequim', 'Ossos', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 2),
(5, 'Manequim', 'Consciencia', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 1),
(6, 'Manequim', 'Sangue', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 3),
(7, 'Manequim', 'Ossos', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 3),
(8, 'Manequim', 'Visceras', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 1),
(9, 'Manequim', 'Visceras', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 2),
(10, 'Manequim', 'Consciencia', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 2),
(11, 'Manequim', 'Base', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 1),
(12, 'Manequim', 'Consciencia', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 3),
(13, 'Manequim', 'Base', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 2),
(14, 'Manequim', 'Visceras', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 3),
(15, 'Manequim', 'Base', 20, 7, 10, 4, 10, 1, 7, 4, 'https://raw.githubusercontent.com/MiguelCSenai/TKW-host/refs/heads/main/Monstros/manequim.png', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `monstros_sessao`
--

DROP TABLE IF EXISTS `monstros_sessao`;
CREATE TABLE IF NOT EXISTS `monstros_sessao` (
  `ms_id` int NOT NULL AUTO_INCREMENT,
  `ses_id` int NOT NULL,
  `mon_id` int NOT NULL,
  `ms_bloco` int NOT NULL,
  `ms_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ms_id`),
  KEY `ses_id` (`ses_id`),
  KEY `mon_id` (`mon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `monstros_sessao`
--

INSERT INTO `monstros_sessao` (`ms_id`, `ses_id`, `mon_id`, `ms_bloco`, `ms_status`) VALUES
(1, 178, 1, 1, 1),
(2, 178, 3, 1, 1),
(3, 178, 1, 1, 1),
(4, 178, 1, 1, 1),
(6, 178, 1, 1, 1),
(7, 178, 2, 5, 1),
(8, 178, 1, 6, 1),
(9, 178, 1, 6, 1),
(10, 179, 1, 3, 1),
(11, 179, 6, 3, 1),
(12, 179, 2, 3, 1),
(13, 179, 6, 3, 1),
(14, 179, 1, 3, 1),
(15, 179, 1, 5, 1),
(16, 183, 2, 6, 1),
(17, 193, 1, 1, 1),
(18, 197, 2, 1, 1),
(19, 199, 1, 1, 1),
(20, 209, 1, 1, 1),
(21, 211, 1, 1, 1),
(22, 214, 1, 4, 1),
(23, 215, 1, 4, 1),
(24, 216, 1, 4, 1),
(25, 217, 1, 4, 1),
(26, 218, 1, 4, 1),
(27, 219, 2, 4, 1),
(28, 220, 2, 4, 1),
(29, 221, 2, 4, 1),
(30, 222, 2, 4, 1),
(31, 224, 2, 4, 1),
(32, 225, 2, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `pla_id` int NOT NULL AUTO_INCREMENT,
  `pla_nome` varchar(25) NOT NULL,
  `pla_classe` varchar(15) NOT NULL,
  `pla_reino` int NOT NULL,
  `pla_HP` int NOT NULL DEFAULT '10',
  `pla_Max_HP` int DEFAULT NULL,
  `pla_STR` int DEFAULT NULL,
  `pla_AGI` int DEFAULT NULL,
  `pla_INT` int DEFAULT NULL,
  `pla_EVA` int DEFAULT NULL,
  `pla_lvl` int DEFAULT '1',
  `pla_xp` int DEFAULT '0',
  `pla_ses_id` int DEFAULT NULL,
  PRIMARY KEY (`pla_id`),
  KEY `fk_sessao` (`pla_ses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `players`
--

INSERT INTO `players` (`pla_id`, `pla_nome`, `pla_classe`, `pla_reino`, `pla_HP`, `pla_Max_HP`, `pla_STR`, `pla_AGI`, `pla_INT`, `pla_EVA`, `pla_lvl`, `pla_xp`, `pla_ses_id`) VALUES
(1, 'Miguel', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 2),
(2, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 2),
(3, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 30),
(4, 'Miguel', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 32),
(5, 'KAMILLY ', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 32),
(6, 'Caellyn', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 32),
(7, 'Miguel', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 38),
(8, 'Henrique', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 38),
(9, 'Davi', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 38),
(10, 'Rafael', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 38),
(11, 'Kamilly', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 38),
(12, 'Ana Beatriz', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 38),
(13, 'LiviaZaramella', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 38),
(14, 'Maria Bueno', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 38),
(15, 'Miguel', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 58),
(16, 'Henrique', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 58),
(17, 'Davi', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 58),
(18, 'Rafael', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 58),
(19, 'Gays', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 58),
(20, 'Gordas', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 58),
(21, 'Coachs', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 58),
(22, 'Feministas', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 58),
(23, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 59),
(24, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 59),
(25, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 59),
(26, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 59),
(27, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 60),
(28, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 60),
(29, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 60),
(30, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 60),
(31, 'teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 62),
(32, 'teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 61),
(33, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 63),
(34, 'Miguel', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 64),
(35, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 64),
(36, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 65),
(37, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 65),
(38, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 66),
(39, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 67),
(40, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 67),
(41, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 68),
(42, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 69),
(43, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 69),
(44, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 70),
(45, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 70),
(46, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 72),
(47, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 72),
(48, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 73),
(49, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 73),
(50, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 74),
(51, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 74),
(52, 'Kamilly', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 75),
(53, 'Miguel', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 75),
(54, 'Kamys', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 76),
(55, 'Comi quem leu', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 76),
(56, 'Miguel', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 77),
(57, 'Kamyss', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 77),
(58, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 78),
(59, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 79),
(60, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 80),
(61, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 81),
(62, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 83),
(63, 'Rixx', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 85),
(64, 'Mnt', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 85),
(65, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 86),
(66, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 87),
(67, 'Miguel', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 88),
(68, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 89),
(69, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 90),
(70, 'Miguel', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 91),
(71, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 92),
(72, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 92),
(73, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 93),
(74, 'Mapa', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 93),
(75, 'Isso', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 94),
(76, 'É', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 94),
(77, 'Um', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 94),
(78, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 94),
(79, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 94),
(80, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 94),
(81, 'Teste', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 94),
(82, 'Teste', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 94),
(83, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 96),
(84, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 96),
(85, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 96),
(86, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 96),
(87, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 98),
(88, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 98),
(89, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 98),
(90, 'Teste', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 98),
(91, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 106),
(92, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 106),
(93, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 106),
(94, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 106),
(95, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 102),
(96, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 102),
(97, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 102),
(98, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 102),
(99, 'Teste mapa', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 107),
(100, 'Teste mapa', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 107),
(101, 'Teste mapa', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 107),
(102, 'Teste mapa', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 107),
(103, 'Teste mapa', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 107),
(104, 'Teste mapa', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 107),
(105, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 112),
(106, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 116),
(107, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 116),
(108, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 116),
(109, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 116),
(110, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 116),
(111, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 116),
(112, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 117),
(113, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 117),
(114, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 122),
(115, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 122),
(116, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 122),
(117, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 122),
(118, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 122),
(119, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 122),
(120, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 123),
(121, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 124),
(122, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 125),
(123, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 126),
(124, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 127),
(125, 'Teste', 'Guerreiro', 1, 35, 15, 9, 11, 6, 0, 1, 0, 128),
(126, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 129),
(127, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 129),
(128, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 130),
(129, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 128),
(130, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 131),
(131, 'Teste', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 131),
(132, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 133),
(133, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 133),
(134, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 134),
(135, 'Teste 2', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 134),
(136, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 135),
(137, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 135),
(138, 'Anas e mari', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 137),
(139, 'Nicoleta', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 137),
(140, 'mafer', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 137),
(141, 'Caellyn', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 137),
(142, 'Gaby', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 137),
(143, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 137),
(144, 'Alexandre', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 137),
(145, 'Mariana ', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 137),
(146, 'Kamilly linda', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 139),
(147, 'Miguel', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 139),
(148, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 140),
(149, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 140),
(150, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 141),
(151, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 141),
(152, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 141),
(153, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 141),
(154, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 142),
(155, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 142),
(156, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 143),
(157, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 143),
(158, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 144),
(159, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 144),
(160, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 145),
(161, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 145),
(162, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 146),
(163, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 146),
(164, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 147),
(165, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 147),
(166, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 148),
(167, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 148),
(168, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 149),
(169, 'teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 149),
(170, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 150),
(171, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 150),
(172, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 152),
(173, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 152),
(174, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 154),
(175, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 154),
(176, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 155),
(177, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 155),
(178, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 156),
(179, 'Kamys', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 156),
(180, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 157),
(181, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 157),
(182, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 158),
(183, 'Kamy', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 158),
(184, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 160),
(185, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 160),
(186, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 161),
(187, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 161),
(188, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 162),
(189, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 162),
(190, 'Teste', 'Guerreiro', 1, 40, 15, 9, 11, 6, 0, 1, 0, 163),
(191, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 163),
(192, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 164),
(193, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 166),
(194, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 166),
(195, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 166),
(196, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 166),
(197, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 166),
(198, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 166),
(199, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 168),
(200, 'Teste 2', 'Guerreiro', 2, 40, 15, 9, 11, 6, 0, 1, 0, 168),
(202, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 169),
(203, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 169),
(204, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 170),
(205, 'Alexandre', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 170),
(206, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 171),
(207, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 171),
(208, 'Miguel', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 172),
(209, 'Roger', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 172),
(210, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 173),
(211, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 173),
(212, 'Teste Local', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 174),
(213, 'Teste Mobile', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 174),
(214, 'Teste Mobile', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 175),
(215, 'Teste', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 175),
(216, 'Teste Mobile', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 176),
(217, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 177),
(218, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 177),
(219, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 178),
(220, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 178),
(221, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 179),
(222, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 179),
(223, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 180),
(224, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 180),
(225, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 181),
(226, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 181),
(227, 'Miguel', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 182),
(228, 'Miguel', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 183),
(229, 'Valdecir ', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 183),
(230, 'Comedor de cu', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 184),
(231, 'Miguel', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 184),
(232, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 185),
(233, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 185),
(234, 'Teste', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 186),
(235, 'Teste 2', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 186),
(236, 'Teste', 'Guerreiro', 1, 50, 50, 20, 11, 20, 0, 1, 0, 187),
(237, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 187),
(238, 'Teste', 'Guerreiro', 1, 55, 55, 9, 11, 6, 0, 1, 0, 188),
(239, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 188),
(240, 'Teste', 'Guerreiro', 1, 40, 50, 9, 11, 6, 0, 1, 0, 189),
(242, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 189),
(243, 'Teste 2', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 190),
(244, 'Teste', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 190),
(245, 'Linda', 'Guerreiro', 2, 40, 40, 9, 11, 6, 0, 1, 0, 191),
(246, 'Ridiculo', 'Armadilheiro', 1, 15, 15, 3, 14, 11, 0, 1, 0, 191),
(247, 'Kamilly ', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 192),
(248, 'Enzo', 'Armadilheiro', 2, 15, 15, 3, 14, 11, 0, 1, 0, 192),
(249, 'Xr', 'Armadilheiro', 2, 15, 0, 3, 14, 11, 0, 1, 0, 193),
(250, 'Kamilly', 'Guerreiro', 1, 40, 40, 9, 11, 6, 0, 1, 0, 193),
(251, 'Teste', 'Caçador', 1, 30, 30, 7, 13, 9, 0, 1, 0, 195),
(252, 'Teste', 'Desertor', 1, 35, 40, 9, 8, 6, 7, 1, 0, 197),
(253, 'Teste 2', 'Caçador', 1, 30, 30, 7, 10, 9, 3, 1, 0, 197),
(254, 'Teste 3', 'Conjurador', 2, 20, 20, 5, 5, 12, 5, 1, 0, 197),
(255, 'Teste 4', 'Bobo da Corte', 2, 15, 15, 3, 11, 11, 3, 1, 0, 197),
(256, 'Teste', 'Caçador', 1, 30, 30, 7, 10, 9, 3, 1, 0, 198),
(257, 'Ray', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 198),
(258, 'Matheus', 'Conjurador', 1, 20, 20, 5, 5, 12, 5, 1, 0, 198),
(259, 'Teste', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 199),
(260, 'Rixx', 'Conjurador', 1, 15, 20, 5, 5, 12, 5, 1, 0, 199),
(261, 'Miguel', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 200),
(262, 'Teste ', 'Conjurador', 2, 20, 20, 5, 5, 12, 5, 1, 0, 200),
(263, 'Miguel', 'Bobo da Corte', 1, 15, 15, 3, 11, 11, 3, 1, 0, 202),
(264, 'Rafael', 'Bobo da Corte', 2, 15, 15, 3, 11, 11, 3, 1, 0, 202),
(265, 'Miguel', 'Bobo da Corte', 1, 15, 15, 3, 11, 11, 3, 1, 0, 203),
(266, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 203),
(267, 'Miguel', 'Bobo da Corte', 1, 15, 15, 3, 11, 11, 3, 1, 0, 204),
(268, 'Rafael', 'Conjurador', 2, 20, 20, 5, 5, 12, 5, 1, 0, 204),
(269, 'Miguel', 'Conjurador', 1, 20, 20, 15, 5, 12, 5, 1, 0, 205),
(270, 'Rafale', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 205),
(271, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 206),
(272, 'Miguel', 'Bobo da Corte', 1, 15, 15, 3, 11, 11, 3, 1, 0, 206),
(273, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 207),
(274, 'Miguel', 'Conjurador', 1, 20, 20, 5, 5, 12, 5, 1, 0, 207),
(275, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 208),
(276, 'Miguel', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 208),
(277, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 209),
(278, 'Miguel', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 209),
(279, 'Apollo', 'Caçador', 1, 30, 30, 7, 10, 9, 3, 1, 0, 211),
(280, 'Pintudo', 'Bobo da Corte', 2, 15, 15, 3, 11, 11, 3, 1, 0, 211),
(281, 'Pytter', 'Caçador', 1, 30, 30, 7, 10, 9, 3, 1, 0, 211),
(282, 'Xibiu', 'Bobo da Corte', 2, 100, 100, 3, 11, 11, 3, 1, 0, 211),
(283, 'Rafael', 'Caçador', 1, 30, 30, 7, 10, 9, 3, 1, 0, 212),
(284, 'Davi', 'Caçador', 2, 30, 30, 8, 10, 9, 3, 1, 0, 212),
(285, 'Davi', 'Desertor', 1, 40, 45, 9, 8, 6, 7, 1, 0, 214),
(286, 'Teste ', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 214),
(287, 'Teste', 'Bobo da Corte', 1, 15, 20, 3, 11, 11, 3, 1, 0, 215),
(288, 'Rafael', 'Desertor', 2, 40, 40, 9, 8, 6, 7, 1, 0, 215),
(289, 'Rafael', 'Bobo da Corte', 1, 15, 15, 3, 11, 11, 3, 1, 0, 216),
(290, 'Davi', 'Caçador', 2, 30, 35, 7, 10, 9, 3, 1, 0, 216),
(291, 'Davi', 'Bobo da Corte', 1, 15, 20, 3, 11, 11, 3, 1, 0, 217),
(292, 'Rafael', 'Conjurador', 2, 20, 20, 5, 5, 12, 5, 1, 0, 217),
(293, 'Davi', 'Conjurador', 1, 20, 25, 5, 5, 12, 5, 1, 0, 218),
(294, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 218),
(295, 'Rafael', 'Bobo da Corte', 1, 15, 20, 3, 11, 11, 3, 1, 0, 219),
(296, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 219),
(297, 'Teste', 'Bobo da Corte', 1, 15, 20, 3, 11, 11, 3, 1, 0, 220),
(298, 'Rafael', 'Desertor', 2, 40, 40, 9, 8, 6, 7, 1, 0, 220),
(299, 'Davi', 'Desertor', 1, 40, 45, 9, 8, 6, 7, 1, 0, 221),
(300, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 221),
(301, 'Isabelly', 'Caçador', 2, 30, 35, 7, 10, 9, 3, 1, 0, 222),
(302, 'Livia', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 222),
(303, 'Rafael', 'Conjurador', 1, 20, 20, 5, 5, 12, 5, 1, 0, 224),
(304, 'Davi', 'Caçador', 2, 30, 35, 7, 10, 9, 3, 1, 0, 224),
(305, 'Davi', 'Bobo da Corte', 1, 15, 20, 3, 11, 11, 3, 1, 0, 225),
(306, 'Rafael', 'Desertor', 2, 40, 40, 9, 8, 6, 7, 1, 0, 225),
(307, 'Miguel', 'Desertor', 1, 40, 40, 9, 8, 6, 7, 1, 0, 226),
(308, 'Henrique', 'Conjurador', 1, 20, 20, 5, 5, 12, 5, 1, 0, 226),
(309, 'Rafael', 'Caçador', 2, 30, 30, 7, 10, 9, 3, 1, 0, 226),
(310, 'Kamilly', 'Bobo da Corte', 2, 15, 15, 3, 11, 11, 3, 1, 0, 226);

--
-- Acionadores `players`
--
DROP TRIGGER IF EXISTS `trg_set_max_hp`;
DELIMITER $$
CREATE TRIGGER `trg_set_max_hp` BEFORE INSERT ON `players` FOR EACH ROW BEGIN
  SET NEW.pla_Max_HP = NEW.pla_HP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessoes`
--

DROP TABLE IF EXISTS `sessoes`;
CREATE TABLE IF NOT EXISTS `sessoes` (
  `ses_id` int NOT NULL AUTO_INCREMENT,
  `ses_inicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ses_fim` timestamp NULL DEFAULT NULL,
  `ses_limite` int DEFAULT NULL,
  PRIMARY KEY (`ses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `sessoes`
--

INSERT INTO `sessoes` (`ses_id`, `ses_inicio`, `ses_fim`, `ses_limite`) VALUES
(1, '2025-04-14 02:06:45', NULL, NULL),
(2, '2025-04-14 02:17:19', NULL, NULL),
(3, '2025-04-14 03:06:47', NULL, NULL),
(4, '2025-04-14 03:07:02', NULL, NULL),
(5, '2025-04-14 03:07:29', NULL, NULL),
(6, '2025-04-14 03:07:31', NULL, NULL),
(7, '2025-04-14 03:07:46', NULL, NULL),
(8, '2025-04-14 03:07:47', NULL, NULL),
(9, '2025-04-14 03:07:54', NULL, NULL),
(10, '2025-04-14 03:08:06', NULL, NULL),
(11, '2025-04-14 03:08:08', NULL, NULL),
(12, '2025-04-14 03:08:32', NULL, NULL),
(13, '2025-04-14 03:08:45', NULL, NULL),
(14, '2025-04-14 03:08:54', NULL, NULL),
(15, '2025-04-14 03:09:04', NULL, NULL),
(16, '2025-04-14 03:10:45', NULL, NULL),
(17, '2025-04-14 03:15:53', NULL, NULL),
(18, '2025-04-14 03:15:55', NULL, NULL),
(19, '2025-04-14 03:16:14', NULL, NULL),
(20, '2025-04-14 03:16:21', NULL, NULL),
(21, '2025-04-14 03:16:27', NULL, NULL),
(22, '2025-04-14 03:19:43', NULL, NULL),
(23, '2025-04-14 03:19:47', NULL, NULL),
(24, '2025-04-14 03:20:03', NULL, NULL),
(25, '2025-04-14 03:20:07', NULL, NULL),
(26, '2025-04-14 03:20:42', NULL, NULL),
(27, '2025-04-14 03:20:52', NULL, NULL),
(28, '2025-04-14 03:20:54', NULL, NULL),
(29, '2025-04-14 03:20:56', NULL, NULL),
(30, '2025-04-14 03:21:15', NULL, NULL),
(31, '2025-04-14 10:59:17', NULL, NULL),
(32, '2025-04-14 15:24:41', NULL, NULL),
(33, '2025-04-14 16:01:48', NULL, NULL),
(34, '2025-04-14 16:03:49', NULL, NULL),
(35, '2025-04-14 16:03:51', NULL, NULL),
(36, '2025-04-14 16:06:42', NULL, NULL),
(37, '2025-04-14 16:06:45', NULL, NULL),
(38, '2025-04-14 17:43:55', NULL, NULL),
(39, '2025-04-14 19:38:19', NULL, NULL),
(40, '2025-04-14 19:39:57', NULL, NULL),
(41, '2025-04-14 19:40:04', NULL, NULL),
(42, '2025-04-14 19:44:35', NULL, NULL),
(43, '2025-04-14 19:48:41', NULL, NULL),
(44, '2025-04-14 19:48:51', NULL, NULL),
(45, '2025-04-14 19:58:29', NULL, NULL),
(46, '2025-04-14 20:01:15', NULL, NULL),
(47, '2025-04-14 20:02:35', '2025-04-14 20:02:40', NULL),
(48, '2025-04-17 20:41:00', '2025-04-17 22:15:46', NULL),
(49, '2025-04-17 22:15:52', '2025-04-17 22:17:35', NULL),
(50, '2025-04-17 22:17:50', '2025-04-17 22:58:27', NULL),
(51, '2025-04-17 22:58:34', '2025-04-17 22:59:41', NULL),
(52, '2025-04-17 23:00:11', '2025-04-18 17:03:41', NULL),
(53, '2025-04-18 17:03:46', '2025-04-18 17:40:43', NULL),
(54, '2025-04-18 17:40:49', '2025-04-18 17:42:38', NULL),
(55, '2025-04-18 17:42:54', '2025-04-18 17:48:47', NULL),
(56, '2025-04-18 17:48:53', '2025-04-18 18:03:25', NULL),
(57, '2025-04-18 18:03:57', '2025-04-18 19:27:28', 1),
(58, '2025-04-18 18:31:49', NULL, 4),
(59, '2025-04-18 19:18:03', NULL, 4),
(60, '2025-04-18 19:22:56', '2025-04-18 19:28:16', 4),
(61, '2025-04-18 19:27:36', '2025-04-18 20:04:17', 1),
(62, '2025-04-18 19:28:23', NULL, 1),
(63, '2025-04-18 19:46:17', NULL, 1),
(64, '2025-04-18 20:04:22', '2025-04-18 21:20:04', 1),
(65, '2025-04-18 21:20:19', '2025-04-18 21:24:48', 1),
(66, '2025-04-18 21:24:53', '2025-04-18 21:25:45', 1),
(67, '2025-04-18 21:25:54', NULL, 1),
(68, '2025-04-18 22:46:48', NULL, 1),
(69, '2025-04-19 03:32:02', NULL, 1),
(70, '2025-04-19 12:19:02', NULL, 1),
(71, '2025-04-22 20:55:52', '2025-04-22 20:55:55', 4),
(72, '2025-04-22 20:56:00', NULL, 1),
(73, '2025-04-24 02:30:28', NULL, 1),
(74, '2025-04-24 03:03:37', NULL, 1),
(75, '2025-04-25 10:44:20', NULL, 1),
(76, '2025-04-25 10:59:10', '2025-04-25 11:02:57', 1),
(77, '2025-04-25 11:04:18', '2025-04-25 11:15:55', 1),
(78, '2025-04-25 11:22:28', NULL, 1),
(79, '2025-04-25 11:30:16', NULL, 1),
(80, '2025-04-25 11:31:19', NULL, 1),
(81, '2025-04-25 11:31:47', NULL, 1),
(82, '2025-04-25 11:32:38', NULL, 1),
(83, '2025-04-25 11:44:55', '2025-04-25 16:07:27', 1),
(84, '2025-04-25 16:08:17', '2025-04-25 16:08:55', 1),
(85, '2025-04-25 16:09:03', '2025-04-25 16:29:55', 1),
(86, '2025-04-25 16:30:00', NULL, 1),
(87, '2025-04-25 17:07:45', NULL, 1),
(88, '2025-04-25 17:19:14', NULL, 1),
(89, '2025-04-25 17:30:12', NULL, 1),
(90, '2025-04-25 17:35:20', NULL, 1),
(91, '2025-04-25 18:34:57', NULL, 1),
(92, '2025-04-25 19:18:03', NULL, 1),
(93, '2025-04-26 03:44:44', '2025-04-26 16:53:49', 1),
(94, '2025-04-26 16:53:57', '2025-04-26 21:37:16', 4),
(95, '2025-04-26 21:47:09', '2025-04-26 22:00:19', 2),
(96, '2025-04-26 22:00:31', '2025-04-26 22:12:24', 2),
(97, '2025-04-26 22:12:31', NULL, 2),
(98, '2025-04-26 22:14:19', NULL, 2),
(99, '2025-04-26 22:27:49', NULL, 0),
(100, '2025-04-26 22:27:50', '2025-04-26 22:41:50', 2),
(101, '2025-04-26 22:30:09', NULL, 0),
(102, '2025-04-26 22:35:56', '2025-04-27 19:46:53', 2),
(103, '2025-04-26 22:42:06', '2025-04-26 22:51:15', 2),
(104, '2025-04-26 22:51:52', '2025-04-26 23:08:59', 2),
(105, '2025-04-26 23:48:12', '2025-04-26 23:48:18', 2),
(106, '2025-04-26 23:48:46', '2025-04-27 18:58:21', 2),
(107, '2025-04-27 18:58:33', NULL, 3),
(108, '2025-04-27 19:01:11', NULL, 3),
(109, '2025-04-27 19:01:19', NULL, 3),
(110, '2025-04-27 19:01:21', NULL, 3),
(111, '2025-04-27 19:01:24', NULL, 3),
(112, '2025-04-27 19:11:25', NULL, 3),
(113, '2025-04-27 19:12:08', NULL, 3),
(114, '2025-04-27 19:12:10', NULL, 3),
(115, '2025-04-27 19:12:11', NULL, 3),
(116, '2025-04-27 19:12:12', '2025-04-27 21:54:47', 3),
(117, '2025-04-27 19:46:57', NULL, 1),
(118, '2025-04-27 21:55:01', '2025-04-27 21:55:27', 3),
(119, '2025-04-27 21:55:47', NULL, 3),
(120, '2025-04-27 22:11:30', NULL, 3),
(121, '2025-04-27 22:26:18', NULL, 3),
(122, '2025-04-27 22:29:59', '2025-04-27 22:33:59', 3),
(123, '2025-04-27 22:43:37', NULL, 1),
(124, '2025-04-28 00:09:50', NULL, 1),
(125, '2025-04-28 00:47:51', NULL, 1),
(126, '2025-04-28 00:59:25', NULL, 1),
(127, '2025-04-28 01:03:46', '2025-04-28 01:08:56', 1),
(128, '2025-04-28 01:09:00', NULL, 1),
(129, '2025-04-28 01:14:30', NULL, 1),
(130, '2025-04-28 01:34:10', NULL, 1),
(131, '2025-04-28 01:50:09', NULL, 1),
(132, '2025-04-28 04:16:16', '2025-04-28 04:16:21', 2),
(133, '2025-04-28 04:16:27', NULL, 1),
(134, '2025-04-28 04:25:54', NULL, 2),
(135, '2025-04-28 10:39:13', NULL, 1),
(136, '2025-04-28 13:09:51', '2025-04-28 13:10:01', 2),
(137, '2025-04-28 13:16:54', NULL, 4),
(138, '2025-05-05 10:46:43', NULL, 1),
(139, '2025-05-05 11:08:18', NULL, 1),
(140, '2025-05-09 10:38:10', '2025-05-09 11:40:45', 1),
(141, '2025-05-09 11:40:50', '2025-05-09 12:26:06', 2),
(142, '2025-05-09 12:26:15', '2025-05-09 13:54:02', 1),
(143, '2025-05-09 12:35:48', NULL, 1),
(144, '2025-05-09 12:49:19', '2025-05-09 12:52:02', 1),
(145, '2025-05-09 12:52:11', NULL, 1),
(146, '2025-05-09 13:07:39', NULL, 1),
(147, '2025-05-09 13:26:35', '2025-05-09 13:31:45', 1),
(148, '2025-05-09 13:31:58', NULL, 1),
(149, '2025-05-09 13:46:15', '2025-05-09 13:51:24', 1),
(150, '2025-05-09 13:51:38', NULL, 1),
(151, '2025-05-09 13:54:07', '2025-05-09 13:54:13', 2),
(152, '2025-05-09 13:54:17', '2025-05-09 14:38:26', 1),
(153, '2025-05-09 14:38:35', NULL, 1),
(154, '2025-05-09 14:42:55', '2025-05-09 14:49:46', 1),
(155, '2025-05-09 14:49:53', '2025-05-09 14:58:16', 1),
(156, '2025-05-09 14:58:32', NULL, 1),
(157, '2025-05-09 15:03:04', '2025-05-09 15:06:33', 1),
(158, '2025-05-09 15:06:38', '2025-05-09 15:08:29', 1),
(159, '2025-05-09 15:09:16', '2025-05-09 15:09:45', 1),
(160, '2025-05-09 15:10:21', '2025-05-09 16:12:18', 1),
(161, '2025-05-09 16:12:26', '2025-05-09 16:24:04', 1),
(162, '2025-05-09 16:25:50', NULL, 1),
(163, '2025-05-16 10:52:44', '2025-05-16 11:08:40', 1),
(164, '2025-05-16 11:05:12', '2025-05-16 11:05:20', 1),
(165, '2025-05-16 11:05:25', NULL, 3),
(166, '2025-05-16 11:08:56', '2025-05-16 11:30:28', 3),
(167, '2025-05-16 11:30:40', '2025-05-16 11:32:01', 3),
(168, '2025-05-16 11:33:10', '2025-05-16 11:49:04', 1),
(169, '2025-05-16 11:49:18', '2025-05-16 12:50:55', 1),
(170, '2025-05-16 12:51:15', '2025-05-16 12:53:03', 1),
(171, '2025-05-16 12:58:03', '2025-05-16 13:41:19', 1),
(172, '2025-05-16 13:42:20', '2025-05-16 15:35:39', 1),
(173, '2025-05-16 15:25:15', NULL, 1),
(174, '2025-05-16 15:35:47', '2025-05-16 16:36:14', 1),
(175, '2025-05-16 16:00:32', NULL, 1),
(176, '2025-05-16 16:09:47', '2025-05-16 16:33:37', 1),
(177, '2025-05-17 14:08:50', '2025-05-19 00:58:37', 1),
(178, '2025-05-19 00:58:54', '2025-06-06 12:39:02', 1),
(179, '2025-05-19 10:47:05', NULL, 1),
(180, '2025-05-23 01:15:21', '2025-05-23 02:48:11', 1),
(181, '2025-05-23 02:48:28', '2025-05-23 16:36:31', 1),
(182, '2025-05-23 16:36:52', NULL, 2),
(183, '2025-05-23 19:39:37', NULL, 1),
(184, '2025-05-26 12:00:17', NULL, 1),
(185, '2025-05-26 12:46:48', NULL, 1),
(186, '2025-05-26 12:57:56', NULL, 1),
(187, '2025-05-29 21:44:51', NULL, 1),
(188, '2025-05-30 10:57:51', '2025-05-30 11:14:05', 1),
(189, '2025-05-30 11:17:22', '2025-05-30 11:24:38', 1),
(190, '2025-05-30 11:24:55', NULL, 1),
(191, '2025-05-30 13:55:25', '2025-05-30 14:12:33', 1),
(192, '2025-05-30 14:12:51', '2025-05-30 14:17:29', 1),
(193, '2025-05-30 14:17:39', '2025-05-30 14:22:48', 1),
(194, '2025-05-30 14:23:12', '2025-05-30 14:23:34', 1),
(195, '2025-06-02 10:37:02', '2025-06-02 13:26:29', 1),
(196, '2025-06-02 13:26:37', '2025-06-02 13:26:39', 1),
(197, '2025-06-02 13:26:44', '2025-06-06 12:21:18', 2),
(198, '2025-06-06 12:35:36', NULL, 3),
(199, '2025-06-06 12:39:09', '2025-06-06 12:42:59', 1),
(200, '2025-06-06 12:46:49', '2025-06-06 12:51:58', 1),
(201, '2025-06-06 13:00:14', '2025-06-06 13:00:28', 1),
(202, '2025-06-06 13:12:59', '2025-06-06 13:17:36', 1),
(203, '2025-06-06 13:21:21', '2025-06-06 13:27:56', 1),
(204, '2025-06-06 13:29:29', '2025-06-06 13:39:23', 1),
(205, '2025-06-06 13:39:37', '2025-06-06 13:46:32', 1),
(206, '2025-06-06 13:46:50', '2025-06-06 13:53:06', 1),
(207, '2025-06-06 13:53:14', '2025-06-06 14:01:37', 1),
(208, '2025-06-06 14:01:45', '2025-06-06 14:10:43', 1),
(209, '2025-06-06 14:10:51', '2025-06-06 17:04:57', 1),
(210, '2025-06-06 17:05:03', '2025-06-06 17:05:38', 1),
(211, '2025-06-06 17:05:46', '2025-06-06 17:53:04', 2),
(212, '2025-06-06 18:01:34', '2025-06-06 18:06:45', 1),
(213, '2025-06-06 19:26:53', NULL, 1),
(214, '2025-06-07 12:04:16', '2025-06-07 12:11:39', 1),
(215, '2025-06-07 12:20:37', '2025-06-07 12:24:43', 1),
(216, '2025-06-07 12:29:31', '2025-06-07 12:34:17', 1),
(217, '2025-06-07 12:36:25', '2025-06-07 12:40:25', 1),
(218, '2025-06-07 12:50:59', '2025-06-07 13:01:51', 1),
(219, '2025-06-07 13:09:27', '2025-06-07 13:16:41', 1),
(220, '2025-06-07 13:18:12', '2025-06-07 13:25:22', 1),
(221, '2025-06-07 13:28:19', '2025-06-07 13:31:48', 1),
(222, '2025-06-07 13:35:54', '2025-06-07 13:42:57', 1),
(223, '2025-06-07 14:09:58', '2025-06-07 14:10:12', 1),
(224, '2025-06-07 14:20:37', '2025-06-07 14:23:21', 1),
(225, '2025-06-07 14:26:52', '2025-06-07 14:34:48', 1),
(226, '2025-06-07 23:41:04', NULL, 2);

--
-- Acionadores `sessoes`
--
DROP TRIGGER IF EXISTS `trg_insert_mestre_after_sessao`;
DELIMITER $$
CREATE TRIGGER `trg_insert_mestre_after_sessao` AFTER INSERT ON `sessoes` FOR EACH ROW BEGIN
INSERT INTO mestre (ses_id)
VALUES (NEW.ses_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turnos`
--

DROP TABLE IF EXISTS `turnos`;
CREATE TABLE IF NOT EXISTS `turnos` (
  `tur_id` int NOT NULL AUTO_INCREMENT,
  `tur_ses_id` int NOT NULL,
  `tur_ordem` text,
  `tur_atual` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`tur_id`),
  KEY `tur_ses_id` (`tur_ses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `turnos`
--

INSERT INTO `turnos` (`tur_id`, `tur_ses_id`, `tur_ordem`, `tur_atual`) VALUES
(1, 143, '[\"156\",\"157\"]', '156'),
(2, 145, '[\"160\",\"161\"]', '160'),
(3, 146, '[\"162\",\"163\"]', '162'),
(4, 148, '[\"166\",\"167\"]', '166'),
(5, 149, '[\"169\",\"168\"]', '169'),
(6, 150, '[\"171\",\"170\"]', '170'),
(7, 152, '[\"172\",\"173\"]', '172'),
(8, 154, '[\"175\",\"174\"]', '175'),
(9, 155, '[\"176\",\"177\"]', '177'),
(10, 156, '[\"178\",\"179\"]', '178'),
(11, 157, '[\"180\",\"181\"]', '180'),
(12, 158, '[\"182\",\"183\"]', '182'),
(13, 160, '[\"184\",\"185\"]', '184'),
(14, 162, '[\"188\",\"189\"]', '188'),
(15, 163, '[\"190\",\"191\"]', '190'),
(16, 166, '[\"193\",\"196\",\"194\",\"197\",\"195\",\"198\"]', '193'),
(17, 170, '[\"204\",\"205\"]', '204'),
(18, 174, '[\"212\",\"213\"]', '212'),
(19, 177, '[\"217\",\"218\"]', '217'),
(20, 178, '[\"219\",\"220\"]', '219'),
(21, 179, '[\"221\",\"222\"]', '221'),
(22, 180, '[\"223\",\"224\"]', '224'),
(23, 181, '[\"226\",\"MESTRE\",\"225\"]', '226'),
(24, 183, '[\"228\",\"229\",\"MESTRE\"]', 'MESTRE'),
(25, 184, '[\"230\",\"231\",\"MESTRE\"]', '231'),
(26, 185, '[\"232\",\"233\",\"MESTRE\"]', '232'),
(27, 186, '[\"234\",\"235\",\"MESTRE\"]', '234'),
(28, 187, '[\"236\",\"237\",\"MESTRE\"]', '236'),
(29, 188, '[\"238\",\"239\",\"MESTRE\"]', '238'),
(30, 189, '[\"240\",\"241\",\"MESTRE\"]', 'MESTRE'),
(31, 190, '[\"244\",\"243\",\"MESTRE\"]', '244'),
(32, 191, '[\"246\",\"245\",\"MESTRE\"]', 'MESTRE'),
(33, 193, '[\"250\",\"249\",\"MESTRE\"]', 'MESTRE'),
(34, 197, '[\"254\",\"253\",\"255\",\"MESTRE\",\"252\"]', 'MESTRE'),
(35, 199, '[\"260\",\"259\",\"MESTRE\"]', '259'),
(36, 200, '[\"262\",\"261\",\"MESTRE\"]', 'MESTRE'),
(37, 202, '[\"264\",\"MESTRE\",\"263\"]', '263'),
(38, 203, '[\"265\",\"266\",\"MESTRE\"]', '265'),
(39, 204, '[\"267\",\"268\",\"MESTRE\"]', '267'),
(40, 205, '[\"269\",\"270\",\"MESTRE\"]', '269'),
(41, 206, '[\"272\",\"271\",\"MESTRE\"]', '272'),
(42, 207, '[\"274\",\"273\",\"MESTRE\"]', '274'),
(43, 208, '[\"276\",\"275\",\"MESTRE\"]', '276'),
(44, 209, '[\"277\",\"278\",\"MESTRE\"]', '278'),
(45, 211, '[\"MESTRE\",\"282\",\"280\",\"281\",\"279\"]', '282'),
(46, 212, '[\"283\",\"284\",\"MESTRE\"]', '284'),
(47, 214, '[\"MESTRE\",\"286\",\"285\"]', '286'),
(48, 215, '[\"MESTRE\",\"288\",\"287\"]', '288'),
(49, 216, '[\"289\",\"MESTRE\",\"290\"]', '289'),
(50, 217, '[\"MESTRE\",\"291\",\"292\"]', 'MESTRE'),
(51, 218, '[\"MESTRE\",\"293\",\"294\"]', 'MESTRE'),
(52, 219, '[\"MESTRE\",\"295\",\"296\"]', 'MESTRE'),
(53, 220, '[\"298\",\"297\",\"MESTRE\"]', 'MESTRE'),
(54, 221, '[\"MESTRE\",\"299\",\"300\"]', 'MESTRE'),
(55, 222, '[\"MESTRE\",\"302\",\"301\"]', 'MESTRE'),
(56, 224, '[\"MESTRE\",\"303\",\"304\"]', 'MESTRE'),
(57, 225, '[\"MESTRE\",\"305\",\"306\"]', 'MESTRE'),
(58, 226, '[\"307\",\"309\",\"308\",\"310\",\"MESTRE\"]', '307');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `mestre`
--
ALTER TABLE `mestre`
  ADD CONSTRAINT `mestre_ibfk_1` FOREIGN KEY (`ses_id`) REFERENCES `sessoes` (`ses_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `monstros_sessao`
--
ALTER TABLE `monstros_sessao`
  ADD CONSTRAINT `monstros_sessao_ibfk_1` FOREIGN KEY (`ses_id`) REFERENCES `sessoes` (`ses_id`),
  ADD CONSTRAINT `monstros_sessao_ibfk_2` FOREIGN KEY (`mon_id`) REFERENCES `monstros` (`mon_id`);

--
-- Limitadores para a tabela `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `fk_sessao` FOREIGN KEY (`pla_ses_id`) REFERENCES `sessoes` (`ses_id`);

--
-- Limitadores para a tabela `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`tur_ses_id`) REFERENCES `sessoes` (`ses_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
