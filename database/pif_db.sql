-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 mars 2025 à 00:36
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pif_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cible_activites`
--

CREATE TABLE `cible_activites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_cible` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cible_activites`
--

INSERT INTO `cible_activites` (`id`, `designation_cible`) VALUES
(1, 'Hommes'),
(2, 'Femmes'),
(3, 'Jeunes'),
(4, 'Vieux'),
(5, 'Populations rurales'),
(6, 'Personnes vivant avec un handicape'),
(7, 'Petites et moyennes entreprises (PME)'),
(8, 'Personnes à faible revenu');

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

CREATE TABLE `communes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_commune` varchar(255) NOT NULL,
  `id_departement` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `nom_commune`, `id_departement`, `created_at`, `updated_at`) VALUES
(1, 'NGOR', 1, NULL, NULL),
(2, 'BISCUITERIE', 1, NULL, NULL),
(3, 'CA.MERMOZ/ SACRE -COEUR', 1, NULL, NULL),
(4, 'CAMBERENE', 1, NULL, NULL),
(5, 'COLOBANE/FASS/GUEULE TAPEE', 1, NULL, NULL),
(6, 'DIEUPPEUL DERKLE', 1, NULL, NULL),
(7, 'FANN/POINT E/ AMITIE', 1, NULL, NULL),
(8, 'GOREE', 1, NULL, NULL),
(9, 'GRAND DAKAR', 1, NULL, NULL),
(10, 'GRAND YOFF', 1, NULL, NULL),
(11, 'HANN/ BEL AIR', 1, NULL, NULL),
(12, 'HLM', 1, NULL, NULL),
(13, 'MEDINA', 1, NULL, NULL),
(14, 'OUAKAM', 1, NULL, NULL),
(15, 'PARCELLES ASSAINIES', 1, NULL, NULL),
(16, 'PATTE D’OIE', 1, NULL, NULL),
(17, 'PLATEAU', 1, NULL, NULL),
(18, 'SICAP LIBERTE', 1, NULL, NULL),
(19, 'YOFF', 1, NULL, NULL),
(20, 'NDIAREME LIMAMOULAYE', 2, NULL, NULL),
(21, 'GOLF SUD', 2, NULL, NULL),
(22, 'MEDINA GOUNASS', 2, NULL, NULL),
(23, 'SAM NOTAIRE', 2, NULL, NULL),
(24, 'WAKHINANE NIMZATT', 2, NULL, NULL),
(25, 'DALIFORD', 4, NULL, NULL),
(26, 'DIACK SAO', 4, NULL, NULL),
(27, 'DIAMAGUENE/SICAP M’BAO', 4, NULL, NULL),
(28, 'DJIDAH THIAROYE KAO', 4, NULL, NULL),
(29, 'GUINAW RAIL NORD', 4, NULL, NULL),
(30, 'GUINAW RAIL SUD', 4, NULL, NULL),
(31, 'KEUR MASSAR', 4, NULL, NULL),
(32, 'MBAO', 4, NULL, NULL),
(33, 'MALIKA', 4, NULL, NULL),
(34, 'PIKINE EST', 4, NULL, NULL),
(35, 'PIKINE OUEST', 4, NULL, NULL),
(36, 'PIKINE SUD', 4, NULL, NULL),
(37, 'THIAROYE /MER', 4, NULL, NULL),
(38, 'THIAROYE GARE', 4, NULL, NULL),
(39, 'YEUMBEUL NORD', 4, NULL, NULL),
(40, 'YEUMBEUL SUD', 4, NULL, NULL),
(41, 'BAMBYLOR', 3, NULL, NULL),
(42, 'BARGNY', 3, NULL, NULL),
(43, 'DIAMNIADIO', 3, NULL, NULL),
(44, 'JAXAAY PARCELLE NIAKOUL RAP', 3, NULL, NULL),
(45, 'SANGALKAM', 3, NULL, NULL),
(46, 'SEBIKOTANE', 3, NULL, NULL),
(47, 'SENDOU', 3, NULL, NULL),
(48, 'RUFISQUE EST', 3, NULL, NULL),
(49, 'RUFISQUE CENTRE (NORD)', 3, NULL, NULL),
(50, 'RUFISQUE OUEST', 3, NULL, NULL),
(51, 'TIVAOUANE PEULH-NIAGHA', 3, NULL, NULL),
(52, 'YENE', 3, NULL, NULL),
(53, 'BALINGORE', 5, NULL, NULL),
(54, 'BIGNONA', 5, NULL, NULL),
(55, 'DIOULOULOU', 5, NULL, NULL),
(56, 'THIONCK-ESSYL', 5, NULL, NULL),
(57, 'COUBALAN', 5, NULL, NULL),
(58, 'DIEGOUNE', 5, NULL, NULL),
(59, 'DJIBIDIONE', 5, NULL, NULL),
(60, 'DJINAKI', 5, NULL, NULL),
(61, 'KAFOUNTINE', 5, NULL, NULL),
(62, 'KARTHIACK', 5, NULL, NULL),
(63, 'KATABAI', 5, NULL, NULL),
(64, 'MANGAGOULACK', 5, NULL, NULL),
(65, 'MLOMP', 5, NULL, NULL),
(66, 'NIAMONE', 5, NULL, NULL),
(67, 'OULAMPANE', 5, NULL, NULL),
(68, 'OUONCK', 5, NULL, NULL),
(69, 'SINDIAN', 5, NULL, NULL),
(70, 'SUELLE', 5, NULL, NULL),
(71, 'TENGHORY', 5, NULL, NULL),
(72, 'OUSSOUYE', 6, NULL, NULL),
(73, 'DJEMBERING', 6, NULL, NULL),
(74, 'MLOMP', 6, NULL, NULL),
(75, 'OUKOUT', 6, NULL, NULL),
(76, 'SANTHIABA MANJACQUE', 6, NULL, NULL),
(77, 'ADEANE', 7, NULL, NULL),
(78, 'BOUTOUPA CAMAR', 7, NULL, NULL),
(79, 'ZIGUINCHOR', 7, NULL, NULL),
(80, 'ENAMPORE', 7, NULL, NULL),
(81, 'NIAGUIS', 7, NULL, NULL),
(82, 'NYASSIA', 7, NULL, NULL),
(83, 'NDONDOL', 10, NULL, NULL),
(84, 'NGOGOM', 10, NULL, NULL),
(85, 'NGOYE', 10, NULL, NULL),
(86, 'BABA GARAGE', 10, NULL, NULL),
(87, 'BAMBEY', 10, NULL, NULL),
(88, 'DANGALMA', 10, NULL, NULL),
(89, 'DINGUIRAYE', 10, NULL, NULL),
(90, 'GAWANE', 10, NULL, NULL),
(91, 'K. SAMBA KANE', 10, NULL, NULL),
(92, 'LAMBAYE', 10, NULL, NULL),
(93, 'REFANE', 10, NULL, NULL),
(94, 'THIAKAR', 10, NULL, NULL),
(95, 'NDINDY', 8, NULL, NULL),
(96, 'NDOULO', 8, NULL, NULL),
(97, 'NGOHE', 8, NULL, NULL),
(98, 'DIOURBEL', 8, NULL, NULL),
(99, 'DANKH SENE', 8, NULL, NULL),
(100, 'GADE ESCALE', 8, NULL, NULL),
(101, 'KEUR ’GALGOU', 8, NULL, NULL),
(102, 'PATAR', 8, NULL, NULL),
(103, 'TAIBA MOUTOUPHA', 8, NULL, NULL),
(104, 'TOCKY GARE', 8, NULL, NULL),
(105, 'TOUBA LAPPE', 8, NULL, NULL),
(106, 'TOURE M’BONDE', 8, NULL, NULL),
(107, 'NDIOUMANE T. THIEKENE', 9, NULL, NULL),
(108, 'NGHAYE', 9, NULL, NULL),
(109, 'COM. M’BACKE', 9, NULL, NULL),
(110, 'DALLA ’GABOU', 9, NULL, NULL),
(111, 'DAROU NAHIM', 9, NULL, NULL),
(112, 'DAROU SALAM TYP', 9, NULL, NULL),
(113, 'DENDEYE GOUYE GUI', 9, NULL, NULL),
(114, 'KAEL', 9, NULL, NULL),
(115, 'MADINA', 9, NULL, NULL),
(116, 'MISSIRAH', 9, NULL, NULL),
(117, 'SADIO', 9, NULL, NULL),
(118, 'TAIBA TIECKENE', 9, NULL, NULL),
(119, 'TAÏF', 9, NULL, NULL),
(120, 'TOUBA M’BOUL', 9, NULL, NULL),
(121, 'TOUBA FALL', 9, NULL, NULL),
(122, 'TOUBA MOSQUEE', 9, NULL, NULL),
(123, 'BOKHOL', 11, NULL, NULL),
(124, 'DAGANA', 11, NULL, NULL),
(125, 'GAE', 11, NULL, NULL),
(126, 'NDOMBO SANDJIRY', 11, NULL, NULL),
(127, 'RICHARD-TOLL', 11, NULL, NULL),
(128, 'ROSS-BETHIO', 11, NULL, NULL),
(129, 'ROSSO-SENEGAL', 11, NULL, NULL),
(130, 'DIAMA', 11, NULL, NULL),
(131, 'MBANE', 11, NULL, NULL),
(132, 'NGNITH', 11, NULL, NULL),
(133, 'RONKH', 11, NULL, NULL),
(134, 'BOKE DIALLOUBE', 12, NULL, NULL),
(135, 'AERE LAO', 12, NULL, NULL),
(136, 'BODE LAO', 12, NULL, NULL),
(137, 'DEMETTE', 12, NULL, NULL),
(138, 'GALOYA TOUCOULEUR', 12, NULL, NULL),
(139, 'GOLLERE', 12, NULL, NULL),
(140, 'GUEDE CHANTIER', 12, NULL, NULL),
(141, 'MBOUMBA', 12, NULL, NULL),
(142, 'NDIANDANE', 12, NULL, NULL),
(143, 'NDIOUM', 12, NULL, NULL),
(144, 'PETE', 12, NULL, NULL),
(145, 'PODOR', 12, NULL, NULL),
(146, 'WALALDE', 12, NULL, NULL),
(147, 'DODEL', 12, NULL, NULL),
(148, 'DOUNGA-LAO', 12, NULL, NULL),
(149, 'FANAYE', 12, NULL, NULL),
(150, 'GAMADJI SARE', 12, NULL, NULL),
(151, 'GUEDE VILLAGE', 12, NULL, NULL),
(152, 'MBOLO BIRANE', 12, NULL, NULL),
(153, 'MEDINA NDIATHBE', 12, NULL, NULL),
(154, 'MERY', 12, NULL, NULL),
(155, 'NDIAYENE PENDAO', 12, NULL, NULL),
(156, 'NDIEBENE GANDIOLE', 13, NULL, NULL),
(157, 'MPAL', 13, NULL, NULL),
(158, 'SAINT LOUIS', 13, NULL, NULL),
(159, 'FASS NGOM', 13, NULL, NULL),
(160, 'GANDON', 13, NULL, NULL),
(161, 'BALLOU', 14, NULL, NULL),
(162, 'BELE', 14, NULL, NULL),
(163, 'KIDIRA', 14, NULL, NULL),
(164, 'BAKEL', 14, NULL, NULL),
(165, 'DIAWARA', 14, NULL, NULL),
(166, 'GABOU', 14, NULL, NULL),
(167, 'GATHIARY', 14, NULL, NULL),
(168, 'MADINA FOULBE', 14, NULL, NULL),
(169, 'MOUDERY', 14, NULL, NULL),
(170, 'SADATOU', 14, NULL, NULL),
(171, 'SINTHIOU-FISSA', 14, NULL, NULL),
(172, 'TOUMBOURA', 14, NULL, NULL),
(173, 'BALA', 15, NULL, NULL),
(174, 'BANI ISRAEL', 15, NULL, NULL),
(175, 'BOUTOUCOUFARA', 15, NULL, NULL),
(176, 'BOYNGUEL BAMBA', 15, NULL, NULL),
(177, 'GOUDIRY', 15, NULL, NULL),
(178, 'KOTHIARY', 15, NULL, NULL),
(179, 'DIANKE MAKHA', 15, NULL, NULL),
(180, 'DOUGUE', 15, NULL, NULL),
(181, 'GOUMBAYEL', 15, NULL, NULL),
(182, 'KOAR', 15, NULL, NULL),
(183, 'KOMOTI', 15, NULL, NULL),
(184, 'KOULOR', 15, NULL, NULL),
(185, 'KOUSSAN', 15, NULL, NULL),
(186, 'SINTHIOU BOCAR ALI', 15, NULL, NULL),
(187, 'SINTHIOU MAMADOU BOUBOU', 15, NULL, NULL),
(188, 'NDAME', 16, NULL, NULL),
(189, 'BAMBA THIALENE', 16, NULL, NULL),
(190, 'KOUMPENTOUM', 16, NULL, NULL),
(191, 'MALEM NIANI', 16, NULL, NULL),
(192, 'KAHENE', 16, NULL, NULL),
(193, 'KOUTHIA GAYDI', 16, NULL, NULL),
(194, 'KOUTHIABA WOLOF', 16, NULL, NULL),
(195, 'MERETO', 16, NULL, NULL),
(196, 'PASS KOTO', 16, NULL, NULL),
(197, 'PAYAR', 16, NULL, NULL),
(198, 'NDOGA BABACAR', 17, NULL, NULL),
(199, 'TAMBACOUNDA', 17, NULL, NULL),
(200, 'DIALACOTO', 17, NULL, NULL),
(201, 'KOUSSANAR', 17, NULL, NULL),
(202, 'MAKACOULIBATANG', 17, NULL, NULL),
(203, 'MISSIRAH', 17, NULL, NULL),
(204, 'NETTE BOULOU', 17, NULL, NULL),
(205, 'NIANI TOUCOULEUR', 17, NULL, NULL),
(206, 'SINTHIOU MALEM', 17, NULL, NULL),
(207, 'FASS', 20, NULL, NULL),
(208, 'GUINGUINEO', 20, NULL, NULL),
(209, 'MBOSS', 20, NULL, NULL),
(210, 'DARA MBOSS', 20, NULL, NULL),
(211, 'GAGNICK', 20, NULL, NULL),
(212, 'KHELCOM BIRAME', 20, NULL, NULL),
(213, 'MBADAKHOUNE', 20, NULL, NULL),
(214, 'NDIAGO', 20, NULL, NULL),
(215, 'NGATHIE NAOUDE', 20, NULL, NULL),
(216, 'NGUELOU', 20, NULL, NULL),
(217, 'OUROUR', 20, NULL, NULL),
(218, 'PANAL OUOLOF', 20, NULL, NULL),
(219, 'GANDIAYE', 18, NULL, NULL),
(220, 'KAHONE', 18, NULL, NULL),
(221, 'KAOLACK', 18, NULL, NULL),
(222, 'NDOFFANE', 18, NULL, NULL),
(223, 'SIBASSOR', 18, NULL, NULL),
(224, 'DYA', 18, NULL, NULL),
(225, 'KEUR BAKA', 18, NULL, NULL),
(226, 'KEUR SOCE', 18, NULL, NULL),
(227, 'LATMINGUE', 18, NULL, NULL),
(228, 'NDIAFFATE', 18, NULL, NULL),
(229, 'NDIEBEL', 18, NULL, NULL),
(230, 'NDIEDIENG', 18, NULL, NULL),
(231, 'THIARE', 18, NULL, NULL),
(232, 'THIOMBY', 18, NULL, NULL),
(233, 'KEUR MADIABEL', 19, NULL, NULL),
(234, 'NIORO', 19, NULL, NULL),
(235, 'DABALY', 19, NULL, NULL),
(236, 'DAROU SALAM', 19, NULL, NULL),
(237, 'GAINTE KAYE', 19, NULL, NULL),
(238, 'K. MANDONGO', 19, NULL, NULL),
(239, 'KAYEMOR', 19, NULL, NULL),
(240, 'KEUR MABA DIAKHOU', 19, NULL, NULL),
(241, 'MEDINA-SABAKH', 19, NULL, NULL),
(242, 'NDRAME ESCALE', 19, NULL, NULL),
(243, 'NGAYENE', 19, NULL, NULL),
(244, 'PAOSKOTO', 19, NULL, NULL),
(245, 'POROKHANE', 19, NULL, NULL),
(246, 'TAÏBA NIASSENE', 19, NULL, NULL),
(247, 'WACK NGOUNA', 19, NULL, NULL),
(248, 'NDIAGANIAO', 21, NULL, NULL),
(249, 'NGUENIENE', 21, NULL, NULL),
(250, 'NGAPAROU', 21, NULL, NULL),
(251, 'GUEKOKH', 21, NULL, NULL),
(252, 'JOAL- FADIOUTH', 21, NULL, NULL),
(253, 'MBOUR', 21, NULL, NULL),
(254, 'POPOGUINE', 21, NULL, NULL),
(255, 'SALY PORTUDAL', 21, NULL, NULL),
(256, 'SOMONE', 21, NULL, NULL),
(257, 'THIADIAYE', 21, NULL, NULL),
(258, 'DIASS', 21, NULL, NULL),
(259, 'FISSEL', 21, NULL, NULL),
(260, 'MALICOUNDA', 21, NULL, NULL),
(261, 'SANDIARA', 21, NULL, NULL),
(262, 'SESSENE', 21, NULL, NULL),
(263, 'SINDIA', 21, NULL, NULL),
(264, 'NDIEYENE SIRAKH', 22, NULL, NULL),
(265, 'NGOUNDIANE', 22, NULL, NULL),
(266, 'CAYAR', 22, NULL, NULL),
(267, 'KHOMBOLE', 22, NULL, NULL),
(268, 'POUT', 22, NULL, NULL),
(269, 'DIENDER GUEDJI', 22, NULL, NULL),
(270, 'FANDENE', 22, NULL, NULL),
(271, 'KEUR MOUSSA', 22, NULL, NULL),
(272, 'NOTTO', 22, NULL, NULL),
(273, 'TASSETTE', 22, NULL, NULL),
(274, 'THIENABA', 22, NULL, NULL),
(275, 'THIES EST', 22, NULL, NULL),
(276, 'THIES NORD', 22, NULL, NULL),
(277, 'THIES OUEST', 22, NULL, NULL),
(278, 'TOUBA TOUL', 22, NULL, NULL),
(279, 'NGANDIOUF', 23, NULL, NULL),
(280, 'CHERIF LÖ', 23, NULL, NULL),
(281, 'MBORO', 23, NULL, NULL),
(282, 'MEKHE', 23, NULL, NULL),
(283, 'TIVAOUANE', 23, NULL, NULL),
(284, 'DAROU KHOUDOSS', 23, NULL, NULL),
(285, 'KOUL', 23, NULL, NULL),
(286, 'MBAYENE', 23, NULL, NULL),
(287, 'MEOUANE', 23, NULL, NULL),
(288, 'MERINA DAKHAR', 23, NULL, NULL),
(289, 'MONT- ROLLAND', 23, NULL, NULL),
(290, 'NIAKHENE', 23, NULL, NULL),
(291, 'NOTTO GOUYE DIAMA', 23, NULL, NULL),
(292, 'PAMBAL', 23, NULL, NULL),
(293, 'PEKESSE', 23, NULL, NULL),
(294, 'PIRE GOUREYE', 23, NULL, NULL),
(295, 'TAIBA NDIAYE', 23, NULL, NULL),
(296, 'THILMAKHA', 23, NULL, NULL),
(297, 'BADEGNE OUOLOF', 24, NULL, NULL),
(298, 'GUEOUL', 24, NULL, NULL),
(299, 'KEBEMER', 24, NULL, NULL),
(300, 'DAROU MARNANE', 24, NULL, NULL),
(301, 'DAROU MOUSTY', 24, NULL, NULL),
(302, 'DIOKOUL DIAWRIGNE', 24, NULL, NULL),
(303, 'KAB GAYE', 24, NULL, NULL),
(304, 'KANENE NDIOB', 24, NULL, NULL),
(305, 'LORO', 24, NULL, NULL),
(306, 'MBACKE CADIOR', 24, NULL, NULL),
(307, 'MBADIANE', 24, NULL, NULL),
(308, 'NDANDE', 24, NULL, NULL),
(309, 'NDOYENE', 24, NULL, NULL),
(310, 'NGOURANE OUOLOF', 24, NULL, NULL),
(311, 'SAGATTA GUETH', 24, NULL, NULL),
(312, 'SAM YABAL', 24, NULL, NULL),
(313, 'THIEPPE', 24, NULL, NULL),
(314, 'THIOLOM FALL', 24, NULL, NULL),
(315, 'TOUBA MERINA', 24, NULL, NULL),
(316, 'AFFE DJOLOFF', 25, NULL, NULL),
(317, 'BARKEDJI', 25, NULL, NULL),
(318, 'BOULAL', 25, NULL, NULL),
(319, 'DAHRA', 25, NULL, NULL),
(320, 'LINGUERE', 25, NULL, NULL),
(321, 'MBEULEUKHE', 25, NULL, NULL),
(322, 'DEALI', 25, NULL, NULL),
(323, 'DODJI', 25, NULL, NULL),
(324, 'GASSANE', 25, NULL, NULL),
(325, 'KAMB', 25, NULL, NULL),
(326, 'LABGAR', 25, NULL, NULL),
(327, 'MBOULA', 25, NULL, NULL),
(328, 'OUARKHOH', 25, NULL, NULL),
(329, 'SAGATTA DJOLOF', 25, NULL, NULL),
(330, 'TESSEKRE FORAGE', 25, NULL, NULL),
(331, 'THIAMENE DJOLOF', 25, NULL, NULL),
(332, 'THIARGNY', 25, NULL, NULL),
(333, 'THIEL', 25, NULL, NULL),
(334, 'YANG YANG', 25, NULL, NULL),
(335, 'COKI', 26, NULL, NULL),
(336, 'LOUGA', 26, NULL, NULL),
(337, 'NDIAGNE', 26, NULL, NULL),
(338, 'GANDE', 26, NULL, NULL),
(339, 'GUET ARDO', 26, NULL, NULL),
(340, 'K.MOMAR SARR', 26, NULL, NULL),
(341, 'KELLE GUEYE', 26, NULL, NULL),
(342, 'LEONA', 26, NULL, NULL),
(343, 'MBEDIENE', 26, NULL, NULL),
(344, 'NGUER MALAL', 26, NULL, NULL),
(345, 'NGUEUNE SARR', 26, NULL, NULL),
(346, 'NGUIDILE', 26, NULL, NULL),
(347, 'NIOMRE', 26, NULL, NULL),
(348, 'PETE OUARACK', 26, NULL, NULL),
(349, 'SAKAL', 26, NULL, NULL),
(350, 'SYER', 26, NULL, NULL),
(351, 'THIAMENE CAYOR', 26, NULL, NULL),
(352, 'AOURE', 30, NULL, NULL),
(353, 'BOKILADJI', 30, NULL, NULL),
(354, 'DEMBANCANE', 30, NULL, NULL),
(355, 'HAMADY OUNARE', 30, NULL, NULL),
(356, 'KANEL', 30, NULL, NULL),
(357, 'ODOBERE', 30, NULL, NULL),
(358, 'SEMME', 30, NULL, NULL),
(359, 'SINTHIOU BAMANBE-BANADJI', 30, NULL, NULL),
(360, 'WAOUNDE', 30, NULL, NULL),
(361, 'NDENDORY', 30, NULL, NULL),
(362, 'ORKADIERE', 30, NULL, NULL),
(363, 'OURO SIDY', 30, NULL, NULL),
(364, 'AGNAM-CIVOL', 31, NULL, NULL),
(365, 'BOKIDIAWE', 31, NULL, NULL),
(366, 'MATAM', 31, NULL, NULL),
(367, 'NGUIDILOGNE', 31, NULL, NULL),
(368, 'OUROSSOGUI', 31, NULL, NULL),
(369, 'THILOGNE', 31, NULL, NULL),
(370, 'DABIA', 31, NULL, NULL),
(371, 'NABADJI-CIVOL', 31, NULL, NULL),
(372, 'OGO', 31, NULL, NULL),
(373, 'OREFONDE', 31, NULL, NULL),
(374, 'COM. RANEROU', 32, NULL, NULL),
(375, 'LOUGRE-THIOLY', 32, NULL, NULL),
(376, 'OUDALAYE', 32, NULL, NULL),
(377, 'VELINGARA', 32, NULL, NULL),
(378, 'DIAKHAO', 27, NULL, NULL),
(379, 'DIOFIOR', 27, NULL, NULL),
(380, 'FATICK', 27, NULL, NULL),
(381, 'DIAOULE', 27, NULL, NULL),
(382, 'DIARERE', 27, NULL, NULL),
(383, 'DIOUROUP', 27, NULL, NULL),
(384, 'DJILASSE', 27, NULL, NULL),
(385, 'FIMELA', 27, NULL, NULL),
(386, 'LOUL-SESSENE', 27, NULL, NULL),
(387, 'MBELACADIAO', 27, NULL, NULL),
(388, 'NDIOB', 27, NULL, NULL),
(389, 'NGAYOKHEME', 27, NULL, NULL),
(390, 'NIAKHAR', 27, NULL, NULL),
(391, 'PALMARIN FACAO', 27, NULL, NULL),
(392, 'PATAR', 27, NULL, NULL),
(393, 'TATTAGUINE', 27, NULL, NULL),
(394, 'THIARE NDIALGUI', 27, NULL, NULL),
(395, 'BASSOUL', 28, NULL, NULL),
(396, 'FOUNDIOUGNE', 28, NULL, NULL),
(397, 'KARANG POSTE', 28, NULL, NULL),
(398, 'PASSY', 28, NULL, NULL),
(399, 'SOKONE', 28, NULL, NULL),
(400, 'SOUM', 28, NULL, NULL),
(401, 'DIAGANE BARKA', 28, NULL, NULL),
(402, 'DIONEWAR', 28, NULL, NULL),
(403, 'DIOSSONG', 28, NULL, NULL),
(404, 'DJILOR', 28, NULL, NULL),
(405, 'DJIRNDA', 28, NULL, NULL),
(406, 'KEUR SAMBA GUEYE', 28, NULL, NULL),
(407, 'KEUR S.DIANE', 28, NULL, NULL),
(408, 'MBAM', 28, NULL, NULL),
(409, 'NIASSENE', 28, NULL, NULL),
(410, 'NIORO ALASSANE TALL', 28, NULL, NULL),
(411, 'TOUBACOUTA', 28, NULL, NULL),
(412, 'COLOBANE', 29, NULL, NULL),
(413, 'GOSSAS', 29, NULL, NULL),
(414, 'MBAR', 29, NULL, NULL),
(415, 'NDIENE LAGANE', 29, NULL, NULL),
(416, 'OUADIOUR', 29, NULL, NULL),
(417, 'PATAR LIA', 29, NULL, NULL),
(418, 'NDIOGNICK', 33, NULL, NULL),
(419, 'BIRKELANE', 33, NULL, NULL),
(420, 'DIAMAL', 33, NULL, NULL),
(421, 'KEUR MBOUKI', 33, NULL, NULL),
(422, 'MABO', 33, NULL, NULL),
(423, 'MBEULEUP', 33, NULL, NULL),
(424, 'SEGRE GATTA', 33, NULL, NULL),
(425, 'TOUBA M\'BELLA', 33, NULL, NULL),
(426, 'BOULEL', 34, NULL, NULL),
(427, 'NGANDA', 34, NULL, NULL),
(428, 'KAFFRINE', 34, NULL, NULL),
(429, 'DIAMAGADIO', 34, NULL, NULL),
(430, 'DIOKOUL M’BELBOUCK', 34, NULL, NULL),
(431, 'GNIBY', 34, NULL, NULL),
(432, 'KAHI', 34, NULL, NULL),
(433, 'KATHIOTE', 34, NULL, NULL),
(434, 'MEDINATOUL SALAM 2', 34, NULL, NULL),
(435, 'KOUNGHEUL', 35, NULL, NULL),
(436, 'FASS THIEKENE', 35, NULL, NULL),
(437, 'GAINTHE PATHE', 35, NULL, NULL),
(438, 'IDA MOURIDE', 35, NULL, NULL),
(439, 'LOUR ESCALE', 35, NULL, NULL),
(440, 'MAKA YOP', 35, NULL, NULL),
(441, 'MISSIRAH WADENE', 35, NULL, NULL),
(442, 'RIBOT ESCALE', 35, NULL, NULL),
(443, 'SALY ESCALE', 35, NULL, NULL),
(444, 'NDIOUM NGAINTH', 36, NULL, NULL),
(445, 'MALEM HODDAR', 36, NULL, NULL),
(446, 'DAROU MINAM II', 36, NULL, NULL),
(447, 'DIANKE SOUF', 36, NULL, NULL),
(448, 'KHELCOM', 36, NULL, NULL),
(449, 'NDIOBENE SAMBA LAMO', 36, NULL, NULL),
(450, 'SAGNA', 36, NULL, NULL),
(451, 'BANDAFASSI', 37, NULL, NULL),
(452, 'KEDOUGOU', 37, NULL, NULL),
(453, 'DIMBOLI', 37, NULL, NULL),
(454, 'DINDIFELO', 37, NULL, NULL),
(455, 'FONGOLEMBI', 37, NULL, NULL),
(456, 'NINEFECHA', 37, NULL, NULL),
(457, 'TOMBORONKOTO', 37, NULL, NULL),
(458, 'SALEMATA', 38, NULL, NULL),
(459, 'DAKATELI', 38, NULL, NULL),
(460, 'DAR SALAM', 38, NULL, NULL),
(461, 'ETHIOLO', 38, NULL, NULL),
(462, 'KEVOYE', 38, NULL, NULL),
(463, 'OUBADJI', 38, NULL, NULL),
(464, 'BEMBOU', 39, NULL, NULL),
(465, 'SARAYA', 39, NULL, NULL),
(466, 'KHOSSANTO', 39, NULL, NULL),
(467, 'MEDINA BAFFE', 39, NULL, NULL),
(468, 'MISSIRAH SIRIMANA', 39, NULL, NULL),
(469, 'SABODALA', 39, NULL, NULL),
(470, 'BAGADADJI', 40, NULL, NULL),
(471, 'DABO', 40, NULL, NULL),
(472, 'KOLDA', 40, NULL, NULL),
(473, 'SALIKEGNE', 40, NULL, NULL),
(474, 'SARE YOBA DIEGA', 40, NULL, NULL),
(475, 'COUMBACARA', 40, NULL, NULL),
(476, 'DIALAMBERE', 40, NULL, NULL),
(477, 'DIOULACOLON', 40, NULL, NULL),
(478, 'GUIRO YERO BOCAR', 40, NULL, NULL),
(479, 'MAMPATIM', 40, NULL, NULL),
(480, 'MEDINA EL HADJI', 40, NULL, NULL),
(481, 'MEDINA CHERIF', 40, NULL, NULL),
(482, 'SARE BIDJI', 40, NULL, NULL),
(483, 'TANKANTO ESCALE', 40, NULL, NULL),
(484, 'THIETTY', 40, NULL, NULL),
(485, 'BADION', 41, NULL, NULL),
(486, 'BIGNARABE', 41, NULL, NULL),
(487, 'BOUROUCO', 41, NULL, NULL),
(488, 'MEDINA YORO FOULAH', 41, NULL, NULL),
(489, 'PATA', 41, NULL, NULL),
(490, 'DINGUIRAYE', 41, NULL, NULL),
(491, 'FAFACOUROU', 41, NULL, NULL),
(492, 'KEREWANE', 41, NULL, NULL),
(493, 'KOULINTO', 41, NULL, NULL),
(494, 'NDORNA', 41, NULL, NULL),
(495, 'NIAMING', 41, NULL, NULL),
(496, 'BONCONTO', 42, NULL, NULL),
(497, 'DIAOUBE- KABENDOU', 42, NULL, NULL),
(498, 'KOUNKANE', 42, NULL, NULL),
(499, 'VELINGARA', 42, NULL, NULL),
(500, 'KANDIA', 42, NULL, NULL),
(501, 'KANDIAYE', 42, NULL, NULL),
(502, 'LINKERING', 42, NULL, NULL),
(503, 'MEDINA GOUNASS', 42, NULL, NULL),
(504, 'NEMATABA', 42, NULL, NULL),
(505, 'OUASSADOU', 42, NULL, NULL),
(506, 'PAKOUR', 42, NULL, NULL),
(507, 'PAROUMBA', 42, NULL, NULL),
(508, 'SARE COLY SALLE', 42, NULL, NULL),
(509, 'SINTHIANG KOUNDARA', 42, NULL, NULL),
(510, 'BOGHAL', 43, NULL, NULL),
(511, 'BONA', 43, NULL, NULL),
(512, 'BOUNKILING', 43, NULL, NULL),
(513, 'MADINA WANDIFA', 43, NULL, NULL),
(514, 'NDIAMACOUTA', 43, NULL, NULL),
(515, 'DIACOUNDA', 43, NULL, NULL),
(516, 'DIAMBATY', 43, NULL, NULL),
(517, 'DIAROUME', 43, NULL, NULL),
(518, 'DJINANY', 43, NULL, NULL),
(519, 'FAOUNE', 43, NULL, NULL),
(520, 'INOR', 43, NULL, NULL),
(521, 'KANDION MANGANA', 43, NULL, NULL),
(522, 'NDIAMALATHIEL', 43, NULL, NULL),
(523, 'TANKON', 43, NULL, NULL),
(524, 'BAGHERE', 44, NULL, NULL),
(525, 'DIATTACOUNDA', 44, NULL, NULL),
(526, 'GOUDOMP', 44, NULL, NULL),
(527, 'SAMINE', 44, NULL, NULL),
(528, 'TANAFF', 44, NULL, NULL),
(529, 'DIOUBOUDOU', 44, NULL, NULL),
(530, 'DJIBANAR', 44, NULL, NULL),
(531, 'KAOUR', 44, NULL, NULL),
(532, 'KARANTABA', 44, NULL, NULL),
(533, 'KOLIBANTANG', 44, NULL, NULL),
(534, 'MANGAROUNGOU SANTO', 44, NULL, NULL),
(535, 'NIAGHA', 44, NULL, NULL),
(536, 'SIMBADI BALANTE', 44, NULL, NULL),
(537, 'SIMBANDI BRASSOU', 44, NULL, NULL),
(538, 'YARANG BALANTE', 44, NULL, NULL),
(539, 'BAMBALI', 45, NULL, NULL),
(540, 'BENET- BIJINI', 45, NULL, NULL),
(541, 'DIANAH MALARY', 45, NULL, NULL),
(542, 'MARSASSOUM', 45, NULL, NULL),
(543, 'SEDHIOU', 45, NULL, NULL),
(544, 'DIANNAH BA', 45, NULL, NULL),
(545, 'DIENDE', 45, NULL, NULL),
(546, 'DJIBABOUYA', 45, NULL, NULL),
(547, 'DJIREDJI', 45, NULL, NULL),
(548, 'KOUSSY', 45, NULL, NULL),
(549, 'OUDOUCAR', 45, NULL, NULL),
(550, 'SAKAR', 45, NULL, NULL),
(551, 'SAMA KANTA PEULH', 45, NULL, NULL),
(552, 'SANSAMBA', 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commune_derouler`
--

CREATE TABLE `commune_derouler` (
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_commune` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commune_derouler`
--

INSERT INTO `commune_derouler` (`id_candidature`, `id_commune`, `created_at`, `updated_at`) VALUES
(70, 206, NULL, NULL),
(70, 437, NULL, NULL),
(53, 191, NULL, NULL),
(53, 435, NULL, NULL),
(53, 436, NULL, NULL),
(54, 248, NULL, NULL),
(54, 436, NULL, NULL),
(55, 1, NULL, NULL),
(57, 76, NULL, NULL),
(57, 160, NULL, NULL),
(61, 300, NULL, NULL),
(71, 2, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(71, 3, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(123, 1, '2025-03-22 17:40:56', '2025-03-22 17:40:56');

-- --------------------------------------------------------

--
-- Structure de la table `criteres`
--

CREATE TABLE `criteres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coefficient` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `bareme` int(11) NOT NULL,
  `id_prix` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `criteres`
--

INSERT INTO `criteres` (`id`, `coefficient`, `designation`, `bareme`, `id_prix`, `created_at`, `updated_at`) VALUES
(1, 4, 'zone_intervention', 10, 2, NULL, NULL),
(2, 4, 'approche_innovante', 10, 2, NULL, NULL),
(3, 5, 'cible', 10, 2, NULL, NULL),
(4, 5, 'effet_impact', 10, 2, NULL, NULL),
(5, 3, 'secteur_activite', 10, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_departement` varchar(255) NOT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom_departement`, `id_region`, `created_at`, `updated_at`) VALUES
(1, 'DAKAR', 1, NULL, NULL),
(2, 'GUEDIAWAYE', 1, NULL, NULL),
(3, 'RUFISQUE', 1, NULL, NULL),
(4, 'PIKINE', 1, NULL, NULL),
(5, 'BIGNONA', 14, NULL, NULL),
(6, 'OUSSOUYE', 14, NULL, NULL),
(7, 'ZIGUINCHOR', 14, NULL, NULL),
(8, 'DIOURBEL', 3, NULL, NULL),
(9, 'M’BACKE', 3, NULL, NULL),
(10, 'BAMBEY', 3, NULL, NULL),
(11, 'DAGANA', 11, NULL, NULL),
(12, 'PODOR', 11, NULL, NULL),
(13, 'SAINT-LOUIS', 11, NULL, NULL),
(14, 'BAKEL', 13, NULL, NULL),
(15, 'GOUDIRY', 13, NULL, NULL),
(16, 'KOUPENTOUM', 13, NULL, NULL),
(17, 'TAMBACOUNDA', 13, NULL, NULL),
(18, 'KAOLACK', 5, NULL, NULL),
(19, 'NIORO', 5, NULL, NULL),
(20, 'GUINGUINEO', 5, NULL, NULL),
(21, 'MBOUR', 2, NULL, NULL),
(22, 'THIES', 2, NULL, NULL),
(23, 'TIVAOUANE', 2, NULL, NULL),
(24, 'KEBEMER', 9, NULL, NULL),
(25, 'LINGUERE', 9, NULL, NULL),
(26, 'LOUGA', 9, NULL, NULL),
(27, 'FATICK', 4, NULL, NULL),
(28, 'FOUNDIOUGNE', 4, NULL, NULL),
(29, 'GOSSAS', 4, NULL, NULL),
(30, 'KANEL', 10, NULL, NULL),
(31, 'MATAM', 10, NULL, NULL),
(32, 'RANEROU', 10, NULL, NULL),
(33, 'BIRKELANE', 6, NULL, NULL),
(34, 'KAFFRINE', 6, NULL, NULL),
(35, 'KOUNGHEUL', 6, NULL, NULL),
(36, 'MALEM HODDAR', 6, NULL, NULL),
(37, 'KEDOUGOU', 7, NULL, NULL),
(38, 'SALEMATA', 7, NULL, NULL),
(39, 'SARAYA', 7, NULL, NULL),
(40, 'KOLDA', 8, NULL, NULL),
(41, 'MEDINA YORO FOULAH', 8, NULL, NULL),
(42, 'VELINGARA', 8, NULL, NULL),
(43, 'BOUNKILING', 12, NULL, NULL),
(44, 'GOUDOMP', 12, NULL, NULL),
(45, 'SEDHIOU', 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dept_deroule`
--

CREATE TABLE `dept_deroule` (
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_departement` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dept_deroule`
--

INSERT INTO `dept_deroule` (`id_candidature`, `id_departement`, `created_at`, `updated_at`) VALUES
(70, 35, NULL, NULL),
(70, 36, NULL, NULL),
(53, 9, NULL, NULL),
(53, 34, NULL, NULL),
(53, 35, NULL, NULL),
(53, 36, NULL, NULL),
(54, 27, NULL, NULL),
(54, 28, NULL, NULL),
(54, 34, NULL, NULL),
(54, 35, NULL, NULL),
(55, 2, NULL, NULL),
(57, 12, NULL, NULL),
(57, 13, NULL, NULL),
(61, 18, NULL, NULL),
(61, 19, NULL, NULL),
(61, 21, NULL, NULL),
(71, 1, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(71, 2, '2025-03-21 16:01:08', '2025-03-21 16:01:08');

-- --------------------------------------------------------

--
-- Structure de la table `dossier_candidatures`
--

CREATE TABLE `dossier_candidatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num_dossier` varchar(255) NOT NULL,
  `intitule_activite` varchar(255) NOT NULL,
  `etat` enum('en_attente','validé','évalué','terminé','rejeté') NOT NULL DEFAULT 'en_attente',
  `motif_rejet` text DEFAULT NULL,
  `description_activite` text NOT NULL,
  `effet_impact` text NOT NULL,
  `innovation` text NOT NULL,
  `date_debut_intervention` date NOT NULL,
  `date_fin_intervention` date NOT NULL,
  `rapport_activite` varchar(255) NOT NULL,
  `fichier_ninea` varchar(255) DEFAULT NULL,
  `fichier_rccm` varchar(255) DEFAULT NULL,
  `fichier_agrement` varchar(255) DEFAULT NULL,
  `decret_creation` varchar(255) DEFAULT NULL,
  `quitus_fiscal` varchar(255) DEFAULT NULL,
  `nbr_homme_toucher` int(11) DEFAULT NULL,
  `nbr_femme_toucher` int(11) DEFAULT NULL,
  `nbr_jeune_toucher` int(11) DEFAULT NULL,
  `nbr_handicape_toucher` int(11) DEFAULT NULL,
  `id_prix` bigint(20) UNSIGNED NOT NULL,
  `id_structure` bigint(20) UNSIGNED NOT NULL,
  `note_finale` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dossier_candidatures`
--

INSERT INTO `dossier_candidatures` (`id`, `num_dossier`, `intitule_activite`, `etat`, `motif_rejet`, `description_activite`, `effet_impact`, `innovation`, `date_debut_intervention`, `date_fin_intervention`, `rapport_activite`, `fichier_ninea`, `fichier_rccm`, `fichier_agrement`, `decret_creation`, `quitus_fiscal`, `nbr_homme_toucher`, `nbr_femme_toucher`, `nbr_jeune_toucher`, `nbr_handicape_toucher`, `id_prix`, `id_structure`, `note_finale`, `created_at`, `updated_at`) VALUES
(53, 'DPC-2025-005', 'Forage et Inclusion Financière – Accès à l’Eau et au Crédit Rural', 'évalué', 'Absence de rapport d\'activité', 'Le projet \"Forage et Inclusion Financière\" vise à développer des infrastructures de forage d\'eau potable dans les zones rurales et semi-urbaines tout en intégrant des mécanismes de financement inclusif pour permettre aux communautés d’accéder à l’eau de manière durable. L’initiative repose sur un partenariat entre des institutions de microfinance, des coopératives locales et des ONG pour faciliter le financement des forages via des microcrédits et des modèles de paiement innovants (ex. Pay-As-You-Go).', 'Construire et réhabiliter des forages équipés de systèmes de pompage solaire.\r\nMettre en place des solutions de paiement numérique pour l’accès à l’eau (ex. mobile money).\r\nOffrir des crédits d’investissement aux agriculteurs et petits commerçants pour l’exploitation de l’eau dans leurs activités économiques.\r\nRenforcer les capacités financières des ménages en développant des services de micro-assurance liés aux infrastructures hydrauliques.', 'Accès élargi à l’eau potable : Amélioration des conditions de vie en garantissant un accès sécurisé à l’eau potable pour les ménages et les agriculteurs.\r\nAutonomisation économique des communautés rurales : Développement de petites entreprises agricoles et artisanales grâce à l’irrigation et l’accès à l’eau.\r\nInclusion financière accrue : Intégration des populations non bancarisées dans le système financier grâce aux solutions de microfinance adaptées.\r\nRéduction des inégalités de genre : Les femmes, souvent en charge de l’approvisionnement en eau, gagnent du temps pour se consacrer à des activités économiques et éducatives.\r\nImpact environnemental positif : Promotion de solutions écologiques comme l’énergie solaire pour le pompage de l’eau.', '2025-02-01', '2025-02-15', 'documents/agilis_rapport_67d8b37323ef0.docx', 'documents/xWON4ENmee5v2yZKAaGcpp7xGWly35xKfqRAwWf2.docx', 'documents/3aVnTywDr7MFc6xdx7EJFtvoMwYC5zYVqbUSciL9.docx', 'documents/agilis_agrement_67d8b37324a01.docx', 'documents/WPhnri2XwRpCl17a7c1MVilQrdgJScOoLgeEJ9CK.pdf', 'documents/0ITAYjGHTFthF2lj3Pbt4ncdXV6tQk6vbbb1fHgL.docx', 12, 43, 23, 6, 2, 43, 168.00, '2025-02-13 13:14:03', '2025-03-22 18:17:03'),
(54, 'DPC-2025-006', 'Mobile Money & Microcrédit pour les Petits Commerçants Pays d\'implantation : Sénégal', 'terminé', NULL, 'Ce projet vise à offrir des services financiers numériques aux petits commerçants et entrepreneurs informels grâce au mobile money et au microcrédit digitalisé. Les bénéficiaires peuvent :\r\n\r\nEffectuer des transactions financières via leur téléphone portable (paiements, transferts, épargne).\r\nAccéder à des microcrédits instantanés sans nécessité de garantie physique.\r\nConstruire un historique de crédit basé sur leurs transactions mobiles, facilitant leur accès à des financements plus conséquents.\r\nL’IMF utilise des algorithmes d’analyse de données pour évaluer la solvabilité des clients en se basant sur leurs habitudes de transactions et leur flux de trésorerie mobile.', '✅ Accès amélioré aux services financiers : Inclusion des travailleurs informels et des petits commerçants souvent exclus du système bancaire traditionnel.\r\n✅ Croissance économique locale : Augmentation du capital disponible pour les petits entrepreneurs, favorisant le développement de leurs activités.\r\n✅ Réduction des coûts de transaction : Moins de déplacements et de paperasse grâce à la numérisation.\r\n✅ Autonomisation des femmes : Beaucoup de bénéficiaires sont des femmes entrepreneures ayant peu d’accès au crédit bancaire.\r\n✅ Amélioration de la traçabilité financière : Les transactions mobiles offrent une meilleure visibilité sur les flux de trésorerie, facilitant l’octroi de prêts plus adaptés.', '💡 Utilisation du scoring alternatif : Évaluation de la solvabilité via l’analyse des transactions mobile money, au lieu des garanties classiques.\r\n💡 Microcrédit instantané et sans garantie : Décaissement rapide via mobile, éliminant les lourdeurs administratives.\r\n💡 Partenariat entre opérateurs télécoms et IMF : Création d’un écosystème où la technologie mobile soutient l’accès aux services financiers.\r\n💡 Utilisation de l’IA et du Big Data : Analyse prédictive pour améliorer l’évaluation des risques et proposer des solutions adaptées aux clients.', '2024-01-03', '2025-02-01', 'documents/larabia_rapport_67d8b3c150a1a.docx', 'documents/larabia_ninea_67d8b3c1511a3.docx', 'documents/larabia_rccm_67d8b3c154bc1.docx', 'documents/zglU1Wpr4PXIyYWh6j4NoTKb5bTiYv2zHImzgyar.docx', 'documents/u80yewnfAuJ5o09IW2fBMqDXPvfumgJtjRvY2kDj.docx', 'documents/larabia_quitus_67d8b3c15554e.docx', 23, 12, 15, 4, 2, 44, 174.50, '2025-02-13 23:41:37', '2025-03-22 18:23:03'),
(55, 'DPC-2025-007', 'Utilisation des technologies numériques pour améliorer l\'accès aux services financiers en zones rurales.', 'en_attente', 'Dossier incomplet', 'Dans de nombreux pays en développement, l\'accès aux services financiers reste limité, en particulier dans les zones rurales où les infrastructures bancaires sont rares. Ce projet vise à renforcer l’inclusion financière en utilisant une application mobile et un système d’intelligence artificielle pour offrir des services financiers adaptés aux populations non bancarisées.', 'Augmentation du taux de bancarisation	Inclusion financière accrue\r\nAccès simplifié aux crédits	Développement économique local\r\nSécurisation des transactions	Réduction de la fraude financière\r\nSensibilisation à l\'épargne	Autonomisation des ménages', 'Score de crédit basé sur le Big Data (analyse des flux financiers, factures, paiements mobile money).\r\n✨ Chatbot en langues locales pour guider les utilisateurs avec une IA conversationnelle.\r\n✨ Utilisation de la blockchain pour assurer la transparence et la traçabilité des transactions.\r\n✨ Modèle de micro-assurance pour couvrir les risques financiers des emprunteurs.', '2025-02-08', '2025-02-13', 'documents/agrovision_rapport_67d8b3f96df15.docx', 'documents/N0mVu4UNoaE1ti6x9xtvkhzJi7RclmWt5IMdBIkq.pdf', 'documents/cJxWljPQBLX8LbUKfeMNRNL3XhfbeCXEH1pHqJrP.docx', 'documents/agrovision_agrement_67d8b3f96f35b.docx', 'documents/BIOuYJhPurw15O8ahfA3hj6HPdtPrRb3Fy5Kkx8z.doc', 'documents/OjDQDrQTapAeBul2jyGh9EzpcqHEwtRd3FEgGQ5j.docx', 23, 53, 53, 6, 2, 45, 0.00, '2025-02-14 01:10:21', '2025-03-18 14:42:11'),
(57, 'DPC-2025-009', 'Mobile Banking pour l\'Inclusion Financière', 'en_attente', NULL, 'Ce projet vise à offrir des services bancaires mobiles aux populations non bancarisées et sous-bancarisées, notamment dans les zones rurales et à faible revenu. Grâce à une application mobile et à un réseau d\'agents locaux, les utilisateurs peuvent ouvrir des comptes, effectuer des paiements, recevoir des micro-crédits et accéder à des assurances, sans nécessiter une présence physique en agence.', 'Accès facilité aux services financiers\r\n\r\nRéduction du nombre de personnes exclues du système bancaire.\r\nDiminution des coûts de transaction pour les populations éloignées des agences bancaires.\r\nAutonomisation économique des populations vulnérables\r\n\r\nAccès aux micro-crédits pour soutenir les petites entreprises et l\'entrepreneuriat.\r\nEncouragement de l’épargne et meilleure gestion des finances personnelles.\r\nSécurisation des transactions financières\r\n\r\nRéduction de la manipulation d’espèces, limitant ainsi les risques de vol et de fraude.\r\nSécurisation des paiements pour les commerçants et travailleurs informels.\r\nDéveloppement de l\'économie locale\r\n\r\nAugmentation des investissements grâce aux prêts accessibles.\r\nFluidification des échanges commerciaux via le paiement mobile.', 'Technologie Blockchain & Sécurité des Transactions\r\n\r\nUtilisation de la blockchain pour sécuriser les transferts d\'argent et prévenir la fraude.\r\n🔹 Utilisation de l\'intelligence artificielle\r\n\r\nAnalyse du comportement financier pour proposer des micro-crédits adaptés au profil du client.\r\n🔹 Partenariats avec des fintechs et opérateurs télécoms\r\n\r\nIntégration avec des services de mobile money pour atteindre les populations rurales sans accès à Internet.\r\n🔹 Système de notation de crédit alternatif\r\n\r\nPrise en compte de l\'historique des paiements mobiles pour évaluer la solvabilité des clients sans antécédents bancaires.', '2025-02-01', '2025-02-21', 'documents/bis_rapport_67d8b43a82c3e.docx', 'documents/uGOnQhBXnkJgph8NYzSnqZ6jxEdtQ38D2EPLpdbf.docx', 'documents/oUu1iPlnPd9lk0qiWEABPAaOkK9TJsUNPTYUWa6M.docx', 'documents/bis_agrement_67d8b43a837ec.docx', 'documents/0U6yX3BOP8a0VOlQ1KtWR3uXhxRcLhThmTsHXpBi.docx', 'documents/VICPcPUkL8C7l9mzCcQHophaRf7Wx6JGbNIkkltU.docx', 23, 12, 43, 6, 2, 47, 146.50, '2025-02-15 23:54:51', '2025-03-18 15:06:05'),
(61, 'DPC-2025-011', 'AfricaHair – Plateforme Intelligente pour la Beauté et l’Entretien des Cheveux Afro', 'en_attente', 'Dossier incomplet', 'AfricaHair est une application mobile et web qui accompagne les personnes aux cheveux crépus, frisés et bouclés dans l’entretien et le soin capillaire. Grâce à l’intelligence artificielle, la plateforme analyse le type de cheveux de l’utilisateur via une simple photo et propose des recommandations personnalisées : produits adaptés, routines capillaires, astuces naturelles et salons de coiffure spécialisés à proximité. Elle intègre aussi un espace communautaire où les utilisateurs peuvent partager leurs expériences, astuces et avis sur les produits.', 'Aide à mieux comprendre et prendre soin des cheveux afro grâce à des conseils personnalisés.\r\nFacilite l’accès aux salons spécialisés et aux produits adaptés.\r\nEncourage l’utilisation de soins naturels et écoresponsables.\r\nValorisation des cheveux naturels et lutte contre les standards de beauté eurocentrés.\r\nSoutien aux petites entreprises et marques africaines spécialisées dans les soins capillaires.\r\nCréation d’une communauté engagée et solidaire autour de la beauté afro.', 'Utilisation de l’IA pour analyser le type de cheveux et générer des recommandations personnalisées.\r\nIntégration d’une marketplace pour acheter directement des produits capillaires adaptés.\r\nSystème de géolocalisation pour trouver les salons et coiffeurs spécialisés proches.\r\nCréation d’un espace interactif avec des tutoriels, des défis capillaires et des événements en ligne.', '2025-01-27', '2025-03-07', 'documents/africahair_rapport_67d8b49ce8dc8.docx', NULL, NULL, NULL, 'documents/africahair_decret_67d8b49ce9d80.docx', NULL, 5, 16, 12, 6, 2, 49, 133.00, '2025-02-28 12:36:55', '2025-03-18 15:05:47'),
(70, 'DPC-2025-012', 'Plateforme de Microfinance Mobile pour les Zones Rurales', 'en_attente', NULL, 'Ce projet consiste à développer une plateforme mobile de microfinance destinée aux populations rurales, offrant des services financiers adaptés à leurs besoins spécifiques. La plateforme permet aux utilisateurs de souscrire à des prêts, d\'épargner, et de consulter des informations sur leur solde et les transactions, tout cela via leurs téléphones mobiles. L\'accent est mis sur la facilité d\'accès, la sécurité des transactions et la simplicité d\'utilisation, avec une interface en plusieurs langues locales.', 'Amélioration de l\'inclusion financière : Le projet permet aux populations rurales, souvent exclues des systèmes bancaires traditionnels, d\'accéder à des services financiers. Cela favorise une plus grande égalité d\'accès aux ressources financières, notamment pour les femmes et les jeunes entrepreneurs.\r\n\r\nRenforcement de l’autonomisation économique : En facilitant l’accès à des crédits et des comptes d’épargne, le projet soutient les initiatives entrepreneuriales locales, stimulant ainsi la création d\'emplois et de petites entreprises. Cela pourrait aider à lutter contre la pauvreté et à améliorer la résilience économique des communautés rurales.\r\n\r\nRéduction des coûts et des risques : La digitalisation des services financiers permet de réduire les coûts d’exploitation associés aux agences physiques, tout en minimisant les risques liés à la gestion des espèces, souvent source de fraude et de vol dans les zones reculées.\r\n\r\nAccélération des processus économiques locaux : La possibilité d’obtenir des prêts instantanément ou d’effectuer des paiements via mobile réduit les délais de traitement et accélère les flux économiques dans les communautés.', 'Utilisation de la technologie mobile : Le recours aux téléphones mobiles comme principal outil d’accès aux services financiers constitue une innovation majeure dans les zones rurales, où l’accès aux infrastructures bancaires est limité.\r\n\r\nSystème de micro-crédit basé sur la réputation sociale : Un des aspects innovants du projet est l’utilisation de la réputation sociale comme critère principal pour accorder des prêts. Au lieu de se baser uniquement sur l’historique de crédit ou les garanties matérielles, le système se fonde également sur la participation communautaire et les références de proches, ce qui est plus adapté aux réalités des zones rurales.\r\n\r\nIntégration de l’intelligence artificielle (IA) : La plateforme utilise des algorithmes d’IA pour évaluer la solvabilité des emprunteurs en temps réel, en tenant compte de paramètres sociaux et économiques comme les tendances agricoles locales, les performances commerciales et les comportements de paiement des utilisateurs. Cela permet d’offrir des services plus personnalisés et de mieux gérer les risques associés aux prêts.\r\n\r\nRéconciliation des paiements via blockchain : Pour assurer la transparence et la sécurité des transactions, la plateforme exploite la blockchain pour la réconciliation des paiements, garantissant que chaque transaction est enregistrée de manière immuable et vérifiable.', '2020-01-29', '2021-06-09', 'documents/fimf_rapport.pdf', NULL, NULL, NULL, 'documents/fimf_decret.pdf', NULL, 34, 12, 14, 5, 2, 36, 179.50, '2025-03-17 23:31:46', '2025-03-18 15:04:51'),
(71, 'DPC-2025-013', 'AgroFinance 360 – Plateforme Intelligente de Microfinance et d’Optimisation Agricole', 'en_attente', NULL, 'AgroFinance 360 est une plateforme numérique qui associe finance, agriculture et technologie pour améliorer la productivité des agriculteurs tout en leur donnant accès à des solutions de microfinance et d’assurance.\r\nCe projet repose sur un modèle de financement basé sur l’analyse de données. Chaque agriculteur peut accéder à des crédits et assurances en fonction de son historique de production, de ses pratiques agricoles et des conditions météorologiques. En intégrant l’intelligence artificielle (IA), l’Internet des Objets (IoT) et la blockchain, la plateforme permet un suivi efficace et transparent des financements et des récoltes.', 'Accès au financement pour les agriculteurs non bancarisés grâce à un scoring basé sur la production et les transactions.\r\nProtection des revenus agricoles en réduisant l’impact des risques climatiques.\r\nAmélioration des rendements et des prises de décision grâce à l’IA et aux capteurs intelligents.\r\nDéveloppement des économies rurales en favorisant la vente directe et l’autonomie financière.\r\nTransparence et confiance dans le financement agricole grâce à la blockchain.', 'Blockchain & Smart Contracts : Sécurisation des transactions financières et automatisation des indemnisations.\r\nIoT & Big Data : Suivi en temps réel des cultures et analyse avancée des risques agricoles.\r\nPaiements via Mobile Money : Facilité d’accès aux financements et transactions dématérialisées.\r\nModèle de Microfinance Éthique : Financement flexible, adapté aux réalités agricoles et sans taux d’intérêt abusif.', '2025-02-25', '2025-04-04', 'documents/tecnosus_rapport.pdf', NULL, NULL, 'documents/tecnosus_agrement.docx', NULL, NULL, 12, 43, 23, 4, 2, 52, 0.00, '2025-03-18 14:22:39', '2025-03-18 15:06:17'),
(123, 'DPC-2025-014', 'hjh', 'en_attente', NULL, 'jkjk', 'kjkj', 'jkj', '2025-02-28', '2025-04-05', 'documents/cnc-shap_rapport.docx', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 2, 85, NULL, '2025-03-22 17:37:14', '2025-03-22 17:40:56');

-- --------------------------------------------------------

--
-- Structure de la table `evaluateurs`
--

CREATE TABLE `evaluateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `structure` varchar(255) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evaluateurs`
--

INSERT INTO `evaluateurs` (`id`, `id_user`, `structure`, `fonction`, `tel`, `created_at`, `updated_at`) VALUES
(21, 177, 'Senpix', 'ingénieur', '52548865', '2025-02-17 09:01:31', '2025-02-17 09:01:31'),
(22, 179, 'SenHijab', 'Gérante', '778654352', '2025-02-17 10:10:53', '2025-02-17 10:10:53');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"eca276ee-91bc-4b58-ba15-d9a947fa93a6\",\"displayName\":\"App\\\\Notifications\\\\EvaluateurRegisteredNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:167;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:50:\\\"App\\\\Notifications\\\\EvaluateurRegisteredNotification\\\":2:{s:7:\\\"\\u0000*\\u0000user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:167;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:2:\\\"id\\\";s:36:\\\"7a32e6bf-873a-4395-bf23-c74e191092d2\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1739732938, 1739732938),
(2, 'default', '{\"uuid\":\"c9d029b3-3a12-4ba8-8fc8-5439bb24f61b\",\"displayName\":\"App\\\\Notifications\\\\WelcomeUserNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:168;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:41:\\\"App\\\\Notifications\\\\WelcomeUserNotification\\\":1:{s:2:\\\"id\\\";s:36:\\\"d8a37afc-0107-402a-a1eb-0c04edc7f5d6\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:4:\\\"mail\\\";}}\"}}', 0, NULL, 1739732993, 1739732993);

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `laureats`
--

CREATE TABLE `laureats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rang` int(11) DEFAULT NULL,
  `date_selection` date NOT NULL,
  `candidature_id` bigint(20) UNSIGNED NOT NULL,
  `observation_jury` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `laureats`
--

INSERT INTO `laureats` (`id`, `rang`, `date_selection`, `candidature_id`, `observation_jury`, `created_at`, `updated_at`) VALUES
(4, 1, '2025-03-22', 54, NULL, '2025-03-22 18:16:54', '2025-03-22 18:23:03'),
(5, 2, '2025-03-22', 53, NULL, '2025-03-22 18:17:04', '2025-03-22 18:23:03');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_22_171456_create_prix_table', 1),
(5, '2025_01_22_171901_create_cible_activites_table', 1),
(6, '2025_01_22_171907_create_secteur_interventions_table', 1),
(7, '2025_01_22_172016_create_regions_table', 1),
(8, '2025_01_22_172025_create_structures_table', 1),
(9, '2025_01_22_172041_create_admins_table', 1),
(10, '2025_01_22_172051_create_evaluateurs_table', 1),
(11, '2025_01_22_172105_create_criteres_table', 1),
(12, '2025_01_22_172120_create_dossier_candidatures_table', 1),
(13, '2025_01_22_172135_create_notes_table', 1),
(14, '2025_01_22_172218_create_viser_activites_table', 1),
(15, '2025_01_22_172247_create_region_derouler_table', 1),
(16, '2025_01_22_172325_create_departements_table', 1),
(17, '2025_01_22_172334_create_communes_table', 1),
(18, '2025_01_22_172348_create_commune_derouler_table', 1),
(19, '2025_01_22_172427_create_secteur_toucher_table', 1),
(20, '2025_01_22_193211_create_dept_deroule_table', 1),
(21, '2025_02_12_114421_update_etat_column_in_dossier_candidatures', 2),
(22, '2025_02_12_114932_modify_id_user_to_id_evaluateur_in_notes_table', 2),
(23, '2025_02_12_120722_add_motif_rejet_to_dossier_candidatures_table', 3),
(24, '2025_02_14_004802_add_two_factor_columns_to_users_table', 4),
(25, '2025_02_15_221052_update_evaluateurs_table', 4),
(26, '2025_02_15_222013_remove_columns_from_evaluateurs', 5),
(27, '2025_02_21_163015_create_laureats_table', 6),
(28, '2025_02_21_120942_create_laureats_table', 7),
(29, '2025_03_19_115242_update_structures_table', 7),
(30, '2025_03_21_111510_create_pays_table', 8);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `observation` text DEFAULT NULL,
  `etat_note` varchar(255) NOT NULL,
  `note_critere` int(11) NOT NULL,
  `etat` enum('en_attente','enregistré','validé') NOT NULL DEFAULT 'en_attente',
  `id_critere` bigint(20) UNSIGNED NOT NULL,
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_evaluateur` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`id`, `observation`, `etat_note`, `note_critere`, `etat`, `id_critere`, `id_candidature`, `id_evaluateur`, `created_at`, `updated_at`) VALUES
(202, 'Bien', 'publié', 9, 'en_attente', 1, 53, 21, '2025-03-22 18:10:50', '2025-03-22 18:10:50'),
(203, 'Bien', 'publié', 9, 'en_attente', 3, 53, 21, '2025-03-22 18:10:50', '2025-03-22 18:10:50'),
(204, 'Bien', 'publié', 6, 'en_attente', 5, 53, 21, '2025-03-22 18:10:51', '2025-03-22 18:10:51'),
(205, 'Bien', 'publié', 9, 'en_attente', 2, 53, 21, '2025-03-22 18:10:51', '2025-03-22 18:10:51'),
(206, 'Bien', 'publié', 8, 'en_attente', 4, 53, 21, '2025-03-22 18:10:51', '2025-03-22 18:10:51'),
(207, 'Très bien', 'publié', 9, 'en_attente', 1, 54, 21, '2025-03-22 18:11:08', '2025-03-22 18:11:08'),
(208, 'Très bien', 'publié', 8, 'en_attente', 3, 54, 21, '2025-03-22 18:11:08', '2025-03-22 18:11:08'),
(209, 'Très bien', 'publié', 10, 'en_attente', 5, 54, 21, '2025-03-22 18:11:08', '2025-03-22 18:11:08'),
(210, 'Très bien', 'publié', 8, 'en_attente', 2, 54, 21, '2025-03-22 18:11:08', '2025-03-22 18:11:08'),
(211, 'Très bien', 'publié', 9, 'en_attente', 4, 54, 21, '2025-03-22 18:11:08', '2025-03-22 18:11:08'),
(212, 'Bien', 'publié', 7, 'en_attente', 1, 53, 22, '2025-03-22 18:11:49', '2025-03-22 18:11:49'),
(213, 'Bien', 'publié', 9, 'en_attente', 3, 53, 22, '2025-03-22 18:11:49', '2025-03-22 18:11:49'),
(214, 'Bien', 'publié', 8, 'en_attente', 5, 53, 22, '2025-03-22 18:11:49', '2025-03-22 18:11:49'),
(215, 'Bien', 'publié', 6, 'en_attente', 2, 53, 22, '2025-03-22 18:11:49', '2025-03-22 18:11:49'),
(216, 'Bien', 'publié', 8, 'en_attente', 4, 53, 22, '2025-03-22 18:11:49', '2025-03-22 18:11:49'),
(217, 'Assez bien', 'publié', 9, 'en_attente', 1, 54, 22, '2025-03-22 18:12:07', '2025-03-22 18:12:07'),
(218, 'Assez bien', 'publié', 8, 'en_attente', 3, 54, 22, '2025-03-22 18:12:07', '2025-03-22 18:12:07'),
(219, 'Assez bien', 'publié', 8, 'en_attente', 5, 54, 22, '2025-03-22 18:12:07', '2025-03-22 18:12:07'),
(220, 'Assez bien', 'publié', 9, 'en_attente', 2, 54, 22, '2025-03-22 18:12:07', '2025-03-22 18:12:07'),
(221, 'Assez bien', 'publié', 6, 'en_attente', 4, 54, 22, '2025-03-22 18:12:07', '2025-03-22 18:12:07');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `national` varchar(255) NOT NULL,
  `candidature_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `national`, `candidature_id`, `created_at`, `updated_at`) VALUES
(5, '0', 71, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(38, '0', 123, '2025-03-22 17:37:14', '2025-03-22 17:37:14');

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

CREATE TABLE `prix` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `annee` int(11) NOT NULL,
  `date_ouverture` date NOT NULL,
  `date_cloture_depot_dossier` date NOT NULL,
  `date_cloture` date NOT NULL,
  `etat` enum('en_attente','ouvert','fermé') NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prix`
--

INSERT INTO `prix` (`id`, `designation`, `annee`, `date_ouverture`, `date_cloture_depot_dossier`, `date_cloture`, `etat`, `created_at`, `updated_at`) VALUES
(2, 'Prix du Ministre de la Microfinance et de l\'Économie Sociale et Solidaire pour la Promotion de l\'Inclusion Financière', 2025, '2025-03-14', '2025-05-08', '2025-02-28', 'en_attente', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_region` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom_region`, `created_at`, `updated_at`) VALUES
(1, 'Dakar', NULL, NULL),
(2, 'Thiès', NULL, NULL),
(3, 'Diourbel', NULL, NULL),
(4, 'Fatick', NULL, NULL),
(5, 'Kaolack', NULL, NULL),
(6, 'Kaffrine', NULL, NULL),
(7, 'Kédougou', NULL, NULL),
(8, 'Kolda', NULL, NULL),
(9, 'Louga', NULL, NULL),
(10, 'Matam', NULL, NULL),
(11, 'Saint-Louis', NULL, NULL),
(12, 'Sédhiou', NULL, NULL),
(13, 'Tambacounda', NULL, NULL),
(14, 'Ziguinchor', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `region_derouler`
--

CREATE TABLE `region_derouler` (
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_region` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `region_derouler`
--

INSERT INTO `region_derouler` (`id_candidature`, `id_region`, `created_at`, `updated_at`) VALUES
(70, 5, NULL, NULL),
(70, 6, NULL, NULL),
(53, 3, NULL, NULL),
(53, 5, NULL, NULL),
(53, 6, NULL, NULL),
(54, 4, NULL, NULL),
(54, 6, NULL, NULL),
(54, 8, NULL, NULL),
(55, 1, NULL, NULL),
(57, 5, NULL, NULL),
(57, 11, NULL, NULL),
(61, 7, NULL, NULL),
(61, 8, NULL, NULL),
(61, 9, NULL, NULL),
(71, 1, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(71, 2, '2025-03-21 16:01:08', '2025-03-21 16:01:08');

-- --------------------------------------------------------

--
-- Structure de la table `secteur_interventions`
--

CREATE TABLE `secteur_interventions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation_secteur` varchar(255) NOT NULL,
  `descripion_secteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `secteur_interventions`
--

INSERT INTO `secteur_interventions` (`id`, `designation_secteur`, `descripion_secteur`) VALUES
(1, 'Agriculture', 'Production végétale et animale, y compris la pêche et la foresterie.'),
(2, 'Commerce', 'Activités liées à l’achat et à la vente de biens et services.'),
(3, 'Industrie', 'Fabrication et transformation des matières premières en produits finis.'),
(4, 'Éducation', 'Secteur consacré à l’enseignement et à la formation.'),
(5, 'Santé', 'Services médicaux, pharmaceutiques et hospitaliers.'),
(6, 'Finance', 'Banques, assurances et institutions de microfinance.'),
(7, 'BTP', 'Bâtiments et travaux publics, construction d’infrastructures.'),
(8, 'Transport', 'Moyens de déplacement des personnes et des marchandises.'),
(9, 'Technologie', 'Développement et maintenance de solutions informatiques et numériques.'),
(10, 'Tourisme', 'Activités liées aux voyages, à l’hôtellerie et aux loisirs.'),
(11, 'Pêche', 'autre'),
(12, 'Artisanat', 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `secteur_toucher`
--

CREATE TABLE `secteur_toucher` (
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_secteur` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `secteur_toucher`
--

INSERT INTO `secteur_toucher` (`id_candidature`, `id_secteur`, `created_at`, `updated_at`) VALUES
(70, 1, NULL, NULL),
(70, 2, NULL, NULL),
(53, 7, NULL, NULL),
(54, 9, NULL, NULL),
(55, 6, NULL, NULL),
(57, 6, NULL, NULL),
(57, 9, NULL, NULL),
(61, 4, NULL, NULL),
(61, 9, NULL, NULL),
(71, 1, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(71, 6, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(123, 1, '2025-03-22 17:40:56', '2025-03-22 17:40:56');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('d3zNLEwgcPCs4x8TF2FCoULzHY46pFrZ5BKRURWa', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS29KZmdXZURkaGI4WWpYTFVhUGRNbndGTWs0YXpGSllhNkZhdmVIOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ldmFsdWF0b3IvbGlzdGVDYW5kaWRhdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1742686503),
('HDiycJ4x8nin9BoNXCJwx0or1qgC4ln4XyLLeuOV', 144, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTElHamxvVTVzQU9EYWlaWUtQeWFxTVBCQXNCbmdGWXhUbUFmbE9yZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0cnVjdC9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0cnVjdC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDQ7fQ==', 1742685546);

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `nom_structure` varchar(255) NOT NULL,
  `siege_social` varchar(255) NOT NULL,
  `date_creation` date NOT NULL,
  `tel_structure` int(11) NOT NULL,
  `ninea` varchar(255) DEFAULT NULL,
  `agreement` varchar(255) DEFAULT NULL,
  `num_decret` varchar(255) DEFAULT NULL,
  `statut_juridique` varchar(255) DEFAULT NULL,
  `registre_commerce` varchar(255) DEFAULT NULL,
  `nom_contact` varchar(255) NOT NULL,
  `prenom_contact` varchar(255) NOT NULL,
  `fonction_contact` varchar(255) NOT NULL,
  `tel_contact` int(11) NOT NULL,
  `email_contact` varchar(255) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `type`, `nom_structure`, `siege_social`, `date_creation`, `tel_structure`, `ninea`, `agreement`, `num_decret`, `statut_juridique`, `registre_commerce`, `nom_contact`, `prenom_contact`, `fonction_contact`, `tel_contact`, `email_contact`, `id_user`, `created_at`, `updated_at`) VALUES
(36, 'Structure publique', 'FIMF', '4, Avenue Jean Jaurès, Immeuble El Hadji Oumar Dia, 2ème étage blocs D, E et F', '2005-02-02', 52548865, 'DS-TEF736', 'KL-OIJSDH', '12-HKYY-22376', 'SARL', 'TF-GGSD787', 'DIONGUE', 'Cheikh Anta', 'INFORMATICIEN', 52548865, 'cheikhanta@gmail.com', 139, '2025-02-11 14:44:55', '2025-03-20 16:57:53'),
(43, 'FINTECH', 'AGILIS', 'Zone de Captage', '2024-12-01', 774189000, 'DG-gf6352', 'TI-gsf9897', 'TG-JKSHJ', NULL, 'FR-HSOZ88', 'BOYE', 'Ibrahima', 'Ingénieur hydrogéologue', 774189000, 'ibrahima@gmail.com', 144, '2025-02-13 13:10:01', '2025-02-13 13:10:01'),
(44, 'Société coopérative', 'LARABIA', 'Thiès', '2012-02-01', 776145543, 'FT-HSG765', 'GH-SOS990', '2025YSF637', NULL, 'KI-HS827', 'BADJI', 'Patrice', 'Coordonateur', 776145543, 'aristidebadji@gmail.com', 145, '2025-02-13 23:37:56', '2025-02-13 23:37:56'),
(45, 'ONG', 'Agrovision', 'DIAMNIADIO', '2025-02-01', 773553905, 'FT-HSG765', 'GH-SOS990', '2025YSF637', NULL, 'KI-HS827', 'BADJI', 'Patrice', 'Coordonateur', 52548865, 'aristidebadji@gmail.com', 146, '2025-02-14 01:07:18', '2025-02-14 01:07:18'),
(47, 'Banque', 'BIS', 'Sandaga', '2025-02-01', 775527442, 'FT-HSG765', 'GH-SOS990', '2025YSF637', NULL, 'KI-HS827', 'SARR', 'KATIME', 'Ingénieur agronome', 52548865, 'katime.sarr@gmail.com', 162, '2025-02-15 23:50:46', '2025-02-15 23:50:46'),
(48, 'ONG', 'Agritech SARL', 'Mermoz', '2025-01-27', 66444336, '0001122 2G3', '7840929', 'DS-002344', NULL, 'G30001122 2', 'DIOP', 'Aminata', 'Assistante de Direction', 66777, 'aminatadiop@agritech.sn', 178, '2025-02-17 10:03:03', '2025-02-17 10:03:03'),
(49, 'Structure publique', 'AfricaHair', 'Quest Foire', '2025-01-26', 330995677, '18822799', '0002G31122', 'DS-002344', NULL, 'G30001122 2', 'Mbaye', 'Rokhaya', 'Directrice', 339857795, 'rokhaya.mbaye@africahair.sn', 183, '2025-02-26 16:10:02', '2025-02-26 16:10:02'),
(52, 'FINTECH', 'TECNOSUS', 'DAKAR', '2023-03-03', 775527442, 'FT-HSG765', 'KL-OIJSDH', '2025YSF637', NULL, 'YU-AZS656', 'BADJI', 'Patrice', 'INFORMATICIEN', 774189000, 'aristidebadji@gmail.com', 186, '2025-03-18 13:54:39', '2025-03-18 13:55:34'),
(85, 'Entreprise sociale', 'CNC-SHAP', 'DIAMNIADIO', '2025-03-01', 773553905, 'FT-HSG765', NULL, NULL, 'SA', NULL, 'Kane', 'Abdoulaye', 'Ingénieur', 773553905, 'daoudaboye19@gmail.com', 187, '2025-03-22 16:55:31', '2025-03-22 16:55:31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'DMIF', 'dmif@dmif.sn', NULL, '$2y$12$aRzUP5ZNPvez1UllxYz.b.jK4IfmDIuK6zXoqSFLQytafQDAoTwEK', NULL, NULL, NULL, 'DMIF', NULL, NULL, NULL),
(20, 'Cheikh Anta DIONGUE', 'cheikhanta@gmail.com', NULL, '$2y$12$aRzUP5ZNPvez1UllxYz.b.jK4IfmDIuK6zXoqSFLQytafQDAoTwEK', NULL, NULL, NULL, 'jury', NULL, NULL, NULL),
(139, 'Patrice Samuel Aristide BADJI', 'daouda.boye@fimf.sn', NULL, '$2y$12$l5QxzKc77oRlTcMcScWPr.PE2/.RA4UrAe6IzMGAlWWhvPOp5oPAK', NULL, NULL, NULL, 'structure', NULL, '2025-02-11 14:42:10', '2025-02-11 14:42:10'),
(144, 'Moussou Touré', 'moussou.toure@fimf.sn', NULL, '$2y$12$CpmF6D5D2HBvcjSjAOkgleaVcG0DEwXKhMLTczMzDUIJvvPspjkYW', NULL, NULL, NULL, 'structure', NULL, '2025-02-13 11:53:35', '2025-02-13 11:53:35'),
(145, 'Amadou Sylla', 'prixmmess@fimf.sn', NULL, '$2y$12$SbnGXKvUHWeQpxqn1kr87O9osTM64Zqv3LSwwRvJe5fhnlW4rKO82', NULL, NULL, NULL, 'structure', NULL, '2025-02-13 23:20:11', '2025-02-13 23:20:11'),
(146, 'Aissatou Ndao', 'daoudaboye@gmail.com', NULL, '$2y$12$T0EtZdl3IasvDJGDFkW8F.fhsrLD04PksdVNKzYznATg2coCoYV7u', NULL, NULL, NULL, 'structure', NULL, '2025-02-13 23:31:58', '2025-02-13 23:31:58'),
(162, 'Rokhaya NIANG', 'rokhaya.niang@fimf.sn', NULL, '$2y$12$IOjTQ0RTWvEf3fKqhrAGcuuhMn9euzepuv/g.Si9PVHxgyPqTw2s6', NULL, NULL, NULL, 'structure', NULL, '2025-02-15 23:48:39', '2025-02-15 23:48:39'),
(177, 'Malick BOYE', 'daoudaboye18@gmail.com', NULL, '$2y$12$OHGYXONbN/OviAfIDilj8uhZ2gEHru1Hmilpv9x6IMkZlEI0luWMK', NULL, NULL, NULL, 'evaluateur', NULL, '2025-02-17 09:01:31', '2025-02-17 09:01:31'),
(178, 'Mariama Kesso BAH', 'mariamakessobah@esp.sn', NULL, '$2y$12$owjzSNI3gHx6oTYbW58fY.sSIo9anMNQ5siDZA70oWDMMOaa16yby', NULL, NULL, NULL, 'structure', NULL, '2025-02-17 10:00:07', '2025-02-17 10:00:07'),
(179, 'Mariéme SALL', 'mariama.ba@fimf.sn', NULL, '$2y$12$reX3T288VDWU2aW1BRhfd.G0rHE.RZnJfWdiJnBn/VGNjyWxtrvLW', NULL, NULL, NULL, 'evaluateur', NULL, '2025-02-17 10:10:53', '2025-02-17 12:01:50'),
(183, 'Abdoulaye Ba', 'abdoulayeba@gmail.com', NULL, '$2y$12$9C/rxG8z7LFagAU1bFBBD.FK.TXoZUdxHKZY9MXKSYdxZVmD1.H/y', NULL, NULL, NULL, 'structure', NULL, '2025-02-26 15:40:33', '2025-02-26 15:40:33'),
(186, 'Daouda Boye', 'daoudaboye19@gmail.com', NULL, '$2y$12$bYhocA8WuOTGTCyepE1HfO8eRSeMo5MazgCSdVNc9gufOq6PB1OZu', NULL, NULL, NULL, 'structure', NULL, '2025-03-18 13:03:36', '2025-03-21 16:01:51'),
(187, 'Mamadou Mbow', 'mamadou@fimf.sn', NULL, '$2y$12$kKwDvgzIkN1md9CrpLwsyO6HsKTWrNZgxI9BNkKW5Fu.LXLDorceS', NULL, NULL, NULL, 'structure', NULL, '2025-03-19 11:17:15', '2025-03-19 11:17:15');

-- --------------------------------------------------------

--
-- Structure de la table `viser_activites`
--

CREATE TABLE `viser_activites` (
  `id_candidature` bigint(20) UNSIGNED NOT NULL,
  `id_cible` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `viser_activites`
--

INSERT INTO `viser_activites` (`id_candidature`, `id_cible`, `created_at`, `updated_at`) VALUES
(70, 5, NULL, NULL),
(53, 5, NULL, NULL),
(54, 1, NULL, NULL),
(54, 2, NULL, NULL),
(55, 1, NULL, NULL),
(55, 2, NULL, NULL),
(55, 5, NULL, NULL),
(57, 7, NULL, NULL),
(61, 7, NULL, NULL),
(71, 1, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(71, 2, '2025-03-21 16:01:08', '2025-03-21 16:01:08'),
(123, 1, '2025-03-22 17:40:56', '2025-03-22 17:40:56');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_id_user_foreign` (`id_user`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cible_activites`
--
ALTER TABLE `cible_activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `communes_id_departement_foreign` (`id_departement`);

--
-- Index pour la table `commune_derouler`
--
ALTER TABLE `commune_derouler`
  ADD KEY `commune_derouler_id_candidature_foreign` (`id_candidature`),
  ADD KEY `commune_derouler_id_commune_foreign` (`id_commune`);

--
-- Index pour la table `criteres`
--
ALTER TABLE `criteres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteres_id_prix_foreign` (`id_prix`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departements_id_region_foreign` (`id_region`);

--
-- Index pour la table `dept_deroule`
--
ALTER TABLE `dept_deroule`
  ADD KEY `dept_deroule_id_candidature_foreign` (`id_candidature`),
  ADD KEY `dept_deroule_id_departement_foreign` (`id_departement`);

--
-- Index pour la table `dossier_candidatures`
--
ALTER TABLE `dossier_candidatures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dossier_candidatures_num_dossier_unique` (`num_dossier`),
  ADD KEY `dossier_candidatures_id_prix_foreign` (`id_prix`),
  ADD KEY `dossier_candidatures_id_structure_foreign` (`id_structure`);

--
-- Index pour la table `evaluateurs`
--
ALTER TABLE `evaluateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluateurs_id_user_foreign` (`id_user`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `laureats`
--
ALTER TABLE `laureats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laureats_candidature_id_foreign` (`candidature_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_id_critere_foreign` (`id_critere`),
  ADD KEY `notes_id_candidature_foreign` (`id_candidature`),
  ADD KEY `notes_id_evaluateur_foreign` (`id_evaluateur`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pays_candidature_id_foreign` (`candidature_id`);

--
-- Index pour la table `prix`
--
ALTER TABLE `prix`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prix_annee_unique` (`annee`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `region_derouler`
--
ALTER TABLE `region_derouler`
  ADD KEY `region_derouler_id_candidature_foreign` (`id_candidature`),
  ADD KEY `region_derouler_id_region_foreign` (`id_region`);

--
-- Index pour la table `secteur_interventions`
--
ALTER TABLE `secteur_interventions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `secteur_toucher`
--
ALTER TABLE `secteur_toucher`
  ADD KEY `secteur_toucher_id_candidature_foreign` (`id_candidature`),
  ADD KEY `secteur_toucher_id_secteur_foreign` (`id_secteur`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structures_id_user_foreign` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `viser_activites`
--
ALTER TABLE `viser_activites`
  ADD KEY `viser_activites_id_candidature_foreign` (`id_candidature`),
  ADD KEY `viser_activites_id_cible_foreign` (`id_cible`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cible_activites`
--
ALTER TABLE `cible_activites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT pour la table `criteres`
--
ALTER TABLE `criteres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `dossier_candidatures`
--
ALTER TABLE `dossier_candidatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `evaluateurs`
--
ALTER TABLE `evaluateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `laureats`
--
ALTER TABLE `laureats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `prix`
--
ALTER TABLE `prix`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `secteur_interventions`
--
ALTER TABLE `secteur_interventions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `communes`
--
ALTER TABLE `communes`
  ADD CONSTRAINT `communes_id_departement_foreign` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commune_derouler`
--
ALTER TABLE `commune_derouler`
  ADD CONSTRAINT `commune_derouler_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commune_derouler_id_commune_foreign` FOREIGN KEY (`id_commune`) REFERENCES `communes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `criteres`
--
ALTER TABLE `criteres`
  ADD CONSTRAINT `criteres_id_prix_foreign` FOREIGN KEY (`id_prix`) REFERENCES `prix` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dept_deroule`
--
ALTER TABLE `dept_deroule`
  ADD CONSTRAINT `dept_deroule_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dept_deroule_id_departement_foreign` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dossier_candidatures`
--
ALTER TABLE `dossier_candidatures`
  ADD CONSTRAINT `dossier_candidatures_id_prix_foreign` FOREIGN KEY (`id_prix`) REFERENCES `prix` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dossier_candidatures_id_structure_foreign` FOREIGN KEY (`id_structure`) REFERENCES `structures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `evaluateurs`
--
ALTER TABLE `evaluateurs`
  ADD CONSTRAINT `evaluateurs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `laureats`
--
ALTER TABLE `laureats`
  ADD CONSTRAINT `laureats_candidature_id_foreign` FOREIGN KEY (`candidature_id`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_id_critere_foreign` FOREIGN KEY (`id_critere`) REFERENCES `criteres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_id_evaluateur_foreign` FOREIGN KEY (`id_evaluateur`) REFERENCES `evaluateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_candidature_id_foreign` FOREIGN KEY (`candidature_id`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `region_derouler`
--
ALTER TABLE `region_derouler`
  ADD CONSTRAINT `region_derouler_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `region_derouler_id_region_foreign` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `secteur_toucher`
--
ALTER TABLE `secteur_toucher`
  ADD CONSTRAINT `secteur_toucher_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secteur_toucher_id_secteur_foreign` FOREIGN KEY (`id_secteur`) REFERENCES `secteur_interventions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `structures`
--
ALTER TABLE `structures`
  ADD CONSTRAINT `structures_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `viser_activites`
--
ALTER TABLE `viser_activites`
  ADD CONSTRAINT `viser_activites_id_candidature_foreign` FOREIGN KEY (`id_candidature`) REFERENCES `dossier_candidatures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `viser_activites_id_cible_foreign` FOREIGN KEY (`id_cible`) REFERENCES `cible_activites` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
