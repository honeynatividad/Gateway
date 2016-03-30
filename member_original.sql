-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2015 at 04:52 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `member`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `province_id`) VALUES
(1, 'Bangued', 1),
(2, 'Boliney', 1),
(3, 'Bucay', 1),
(4, 'Bucloc', 1),
(5, 'Daguioman', 1),
(6, 'Danglas', 1),
(7, 'Dolores', 1),
(8, 'La Paz', 1),
(9, 'Lacub', 1),
(10, 'Lagangilang', 1),
(11, 'Lagayan', 1),
(12, 'Langiden', 1),
(13, 'Licuan-Baay', 1),
(14, 'Luba', 1),
(15, 'Malibcong', 1),
(16, 'Manabo', 1),
(17, 'Peñarrubia', 1),
(18, 'Pidigan', 1),
(19, 'Pilar', 1),
(20, 'Sallapadan', 1),
(21, 'San Isidro', 1),
(22, 'San Juan', 1),
(23, 'San Quintin', 1),
(24, 'Tayum', 1),
(25, 'Tineg', 1),
(26, 'Tubo', 1),
(27, 'Villaviciosa', 1),
(28, 'Butuan City', 2),
(29, 'Buenavista', 2),
(30, 'Cabadbaran', 2),
(31, 'Carmen', 2),
(32, 'Jabonga', 2),
(33, 'Kitcharao', 2),
(34, 'Las Nieves', 2),
(35, 'Magallanes', 2),
(36, 'Nasipit', 2),
(37, 'Remedios T. Romualdez', 2),
(38, 'Santiago', 2),
(39, 'Tubay', 2),
(40, 'Bayugan', 3),
(41, 'Bunawan', 3),
(42, 'Esperanza', 3),
(43, 'La Paz', 3),
(44, 'Loreto', 3),
(45, 'Prosperidad', 3),
(46, 'Rosario', 3),
(47, 'San Francisco', 3),
(48, 'San Luis', 3),
(49, 'Santa Josefa', 3),
(50, 'Sibagat', 3),
(51, 'Talacogon', 3),
(52, 'Trento', 3),
(53, 'Veruela', 3),
(54, 'Altavas', 4),
(55, 'Balete', 4),
(56, 'Banga', 4),
(57, 'Batan', 4),
(58, 'Buruanga', 4),
(59, 'Ibajay', 4),
(60, 'Kalibo', 4),
(61, 'Lezo', 4),
(62, 'Libacao', 4),
(63, 'Madalag', 4),
(64, 'Makato', 4),
(65, 'Malay', 4),
(66, 'Malinao', 4),
(67, 'Nabas', 4),
(68, 'New Washington', 4),
(69, 'Numancia', 4),
(70, 'Tangalan', 4),
(71, 'Legazpi City', 5),
(72, 'Ligao City', 5),
(73, 'Tabaco City', 5),
(74, 'Bacacay', 5),
(75, 'Camalig', 5),
(76, 'Daraga', 5),
(77, 'Guinobatan', 5),
(78, 'Jovellar', 5),
(79, 'Libon', 5),
(80, 'Malilipot', 5),
(81, 'Malinao', 5),
(82, 'Manito', 5),
(83, 'Oas', 5),
(84, 'Pio Duran', 5),
(85, 'Polangui', 5),
(86, 'Rapu-Rapu', 5),
(87, 'Santo Domingo', 5),
(88, 'Tiwi', 5),
(89, 'Anini-y', 6),
(90, 'Barbaza', 6),
(91, 'Belison', 6),
(92, 'Bugasong', 6),
(93, 'Caluya', 6),
(94, 'Culasi', 6),
(95, 'Hamtic', 6),
(96, 'Laua-an', 6),
(97, 'Libertad', 6),
(98, 'Pandan', 6),
(99, 'Patnongon', 6),
(100, 'San Jose', 6),
(101, 'San Remigio', 6),
(102, 'Sebaste', 6),
(103, 'Sibalom', 6),
(104, 'Tibiao', 6),
(105, 'Tobias Fornier', 6),
(106, 'Valderrama', 6),
(107, 'Calanasan', 7),
(108, 'Conner', 7),
(109, 'Flora', 7),
(110, 'Kabugao', 7),
(111, 'Luna', 7),
(112, 'Pudtol', 7),
(113, 'Santa Marcela', 7),
(114, 'Baler', 8),
(115, 'Casiguran', 8),
(116, 'Dilasag', 8),
(117, 'Dinalungan', 8),
(118, 'Dingalan', 8),
(119, 'Dipaculao', 8),
(120, 'Maria Aurora', 8),
(121, 'San Luis', 8),
(122, 'Isabela City', 9),
(123, 'Akbar', 9),
(124, 'Al-Barka', 9),
(125, 'Hadji Mohammad Ajul', 9),
(126, 'Hadji Muhtamad', 9),
(127, 'Lamitan', 9),
(128, 'Lantawan', 9),
(129, 'Maluso', 9),
(130, 'Sumisip', 9),
(131, 'Tabuan-Lasa', 9),
(132, 'Tipo-Tipo', 9),
(133, 'Tuburan', 9),
(134, 'Ungkaya Pukan', 9),
(135, 'Balanga City', 10),
(136, 'Abucay', 10),
(137, 'Bagac', 10),
(138, 'Dinalupihan', 10),
(139, 'Hermosa', 10),
(140, 'Limay', 10),
(141, 'Mariveles', 10),
(142, 'Morong', 10),
(143, 'Orani', 10),
(144, 'Orion', 10),
(145, 'Pilar', 10),
(146, 'Samal', 10),
(147, 'Basco', 11),
(148, 'Itbayat', 11),
(149, 'Ivana', 11),
(150, 'Mahatao', 11),
(151, 'Sabtang', 11),
(152, 'Uyugan', 11),
(153, 'Batangas City', 12),
(154, 'Lipa City', 12),
(155, 'Tanauan City', 12),
(156, 'Agoncillo', 12),
(157, 'Alitagtag', 12),
(158, 'Balayan', 12),
(159, 'Balete', 12),
(160, 'Bauan', 12),
(161, 'Calaca', 12),
(162, 'Calatagan', 12),
(163, 'Cuenca', 12),
(164, 'Ibaan', 12),
(165, 'Laurel', 12),
(166, 'Lemery', 12),
(167, 'Lian', 12),
(168, 'Lobo', 12),
(169, 'Mabini', 12),
(170, 'Malvar', 12),
(171, 'Mataas na Kahoy', 12),
(172, 'Nasugbu', 12),
(173, 'Padre Garcia', 12),
(174, 'Rosario', 12),
(175, 'San Jose', 12),
(176, 'San Juan', 12),
(177, 'San Luis', 12),
(178, 'San Nicolas', 12),
(179, 'San Pascual', 12),
(180, 'Santa Teresita', 12),
(181, 'Santo Tomas', 12),
(182, 'Taal', 12),
(183, 'Talisay', 12),
(184, 'Taysan', 12),
(185, 'Tingloy', 12),
(186, 'Tuy', 12),
(187, 'Baguio City', 13),
(188, 'Atok', 13),
(189, 'Bakun', 13),
(190, 'Bokod', 13),
(191, 'Buguias', 13),
(192, 'Itogon', 13),
(193, 'Kabayan', 13),
(194, 'Kapangan', 13),
(195, 'Kibungan', 13),
(196, 'La Trinidad', 13),
(197, 'Mankayan', 13),
(198, 'Sablan', 13),
(199, 'Tuba', 13),
(200, 'Tublay', 13),
(201, 'Almeria', 14),
(202, 'Biliran', 14),
(203, 'Cabucgayan', 14),
(204, 'Caibiran', 14),
(205, 'Culaba', 14),
(206, 'Kawayan', 14),
(207, 'Maripipi', 14),
(208, 'Naval', 14),
(209, 'Tagbilaran City', 15),
(210, 'Alburquerque', 15),
(211, 'Alicia', 15),
(212, 'Anda', 15),
(213, 'Antequera', 15),
(214, 'Baclayon', 15),
(215, 'Balilihan', 15),
(216, 'Batuan', 15),
(217, 'Bien Unido', 15),
(218, 'Bilar', 15),
(219, 'Buenavista', 15),
(220, 'Calape', 15),
(221, 'Candijay', 15),
(222, 'Carmen', 15),
(223, 'Catigbian', 15),
(224, 'Clarin', 15),
(225, 'Corella', 15),
(226, 'Cortes', 15),
(227, 'Dagohoy', 15),
(228, 'Danao', 15),
(229, 'Dauis', 15),
(230, 'Dimiao', 15),
(231, 'Duero', 15),
(232, 'Garcia Hernandez', 15),
(233, 'Getafe', 15),
(234, 'Guindulman', 15),
(235, 'Inabanga', 15),
(236, 'Jagna', 15),
(237, 'Lila', 15),
(238, 'Loay', 15),
(239, 'Loboc', 15),
(240, 'Loon', 15),
(241, 'Mabini', 15),
(242, 'Maribojoc', 15),
(243, 'Panglao', 15),
(244, 'Pilar', 15),
(245, 'President Carlos P. Garcia', 15),
(246, 'Sagbayan', 15),
(247, 'San Isidro', 15),
(248, 'San Miguel', 15),
(249, 'Sevilla', 15),
(250, 'Sierra Bullones', 15),
(251, 'Sikatuna', 15),
(252, 'Talibon', 15),
(253, 'Trinidad', 15),
(254, 'Tubigon', 15),
(255, 'Ubay', 15),
(256, 'Valencia', 15),
(257, 'Malaybalay City', 16),
(258, 'Valencia City', 16),
(259, 'Baungon', 16),
(260, 'Cabanglasan', 16),
(261, 'Damulog', 16),
(262, 'Dangcagan', 16),
(263, 'Don Carlos', 16),
(264, 'Impasug-ong', 16),
(265, 'Kadingilan', 16),
(266, 'Kalilangan', 16),
(267, 'Kibawe', 16),
(268, 'Kitaotao', 16),
(269, 'Lantapan', 16),
(270, 'Libona', 16),
(271, 'Malitbog', 16),
(272, 'Manolo Fortich', 16),
(273, 'Maramag', 16),
(274, 'Pangantucan', 16),
(275, 'Quezon', 16),
(276, 'San Fernando', 16),
(277, 'Sumilao', 16),
(278, 'Talakag', 16),
(279, 'Malolos City', 17),
(280, 'Meycauayan City', 17),
(281, 'San Jose del Monte City', 17),
(282, 'Angat', 17),
(283, 'Balagtas', 17),
(284, 'Baliuag', 17),
(285, 'Bocaue', 17),
(286, 'Bulacan', 17),
(287, 'Bustos', 17),
(288, 'Calumpit', 17),
(289, 'Doña Remedios Trinidad', 17),
(290, 'Guiguinto', 17),
(291, 'Hagonoy', 17),
(292, 'Marilao', 17),
(293, 'Norzagaray', 17),
(294, 'Obando', 17),
(295, 'Pandi', 17),
(296, 'Paombong', 17),
(297, 'Plaridel', 17),
(298, 'Pulilan', 17),
(299, 'San Ildefonso', 17),
(300, 'San Miguel', 17),
(301, 'San Rafael', 17),
(302, 'Santa Maria', 17),
(303, 'Tuguegarao City', 18),
(304, 'Abulug', 18),
(305, 'Alcala', 18),
(306, 'Allacapan', 18),
(307, 'Amulung', 18),
(308, 'Aparri', 18),
(309, 'Baggao', 18),
(310, 'Ballesteros', 18),
(311, 'Buguey', 18),
(312, 'Calayan', 18),
(313, 'Camalaniugan', 18),
(314, 'Claveria', 18),
(315, 'Enrile', 18),
(316, 'Gattaran', 18),
(317, 'Gonzaga', 18),
(318, 'Iguig', 18),
(319, 'Lal-lo', 18),
(320, 'Lasam', 18),
(321, 'Pamplona', 18),
(322, 'Peñablanca', 18),
(323, 'Piat', 18),
(324, 'Rizal', 18),
(325, 'Sanchez-Mira', 18),
(326, 'Santa Ana', 18),
(327, 'Santa Praxedes', 18),
(328, 'Santa Teresita', 18),
(329, 'Santo Niño', 18),
(330, 'Solana', 18),
(331, 'Tuao', 18),
(332, 'Basud', 19),
(333, 'Capalonga', 19),
(334, 'Daet', 19),
(335, 'Jose Panganiban', 19),
(336, 'Labo', 19),
(337, 'Mercedes', 19),
(338, 'Paracale', 19),
(339, 'San Lorenzo Ruiz', 19),
(340, 'San Vicente', 19),
(341, 'Santa Elena', 19),
(342, 'Talisay', 19),
(343, 'Vinzons', 19),
(344, 'Iriga City', 20),
(345, 'Naga City', 20),
(346, 'Baao', 20),
(347, 'Balatan', 20),
(348, 'Bato', 20),
(349, 'Bombon', 20),
(350, 'Buhi', 20),
(351, 'Bula', 20),
(352, 'Cabusao', 20),
(353, 'Calabanga', 20),
(354, 'Camaligan', 20),
(355, 'Canaman', 20),
(356, 'Caramoan', 20),
(357, 'Del Gallego', 20),
(358, 'Gainza', 20),
(359, 'Garchitorena', 20),
(360, 'Goa', 20),
(361, 'Lagonoy', 20),
(362, 'Libmanan', 20),
(363, 'Lupi', 20),
(364, 'Magarao', 20),
(365, 'Milaor', 20),
(366, 'Minalabac', 20),
(367, 'Nabua', 20),
(368, 'Ocampo', 20),
(369, 'Pamplona', 20),
(370, 'Pasacao', 20),
(371, 'Pili', 20),
(372, 'Presentacion', 20),
(373, 'Ragay', 20),
(374, 'Sagñay', 20),
(375, 'San Fernando', 20),
(376, 'San Jose', 20),
(377, 'Sipocot', 20),
(378, 'Siruma', 20),
(379, 'Tigaon', 20),
(380, 'Tinambac', 20),
(381, 'Catarman', 21),
(382, 'Guinsiliban', 21),
(383, 'Mahinog', 21),
(384, 'Mambajao', 21),
(385, 'Sagay', 21),
(386, 'Roxas City', 22),
(387, 'Cuartero', 22),
(388, 'Dao', 22),
(389, 'Dumalag', 22),
(390, 'Dumarao', 22),
(391, 'Ivisan', 22),
(392, 'Jamindan', 22),
(393, 'Ma-ayon', 22),
(394, 'Mambusao', 22),
(395, 'Panay', 22),
(396, 'Panitan', 22),
(397, 'Pilar', 22),
(398, 'Pontevedra', 22),
(399, 'President Roxas', 22),
(400, 'Sapi-an', 22),
(401, 'Sigma', 22),
(402, 'Tapaz', 22),
(403, 'Bagamanoc', 23),
(404, 'Baras', 23),
(405, 'Bato', 23),
(406, 'Caramoran', 23),
(407, 'Gigmoto', 23),
(408, 'Pandan', 23),
(409, 'Panganiban', 23),
(410, 'San Andres', 23),
(411, 'San Miguel', 23),
(412, 'Viga', 23),
(413, 'Virac', 23),
(414, 'Cavite City', 24),
(415, 'Dasmariñas City', 24),
(416, 'Tagaytay City', 24),
(417, 'Trece Martires City', 24),
(418, 'Alfonso', 24),
(419, 'Amadeo', 24),
(420, 'Bacoor', 24),
(421, 'Carmona', 24),
(422, 'General Mariano Alvarez', 24),
(423, 'General Emilio Aguinaldo', 24),
(424, 'General Trias', 24),
(425, 'Imus', 24),
(426, 'Indang', 24),
(427, 'Kawit', 24),
(428, 'Magallanes', 24),
(429, 'Maragondon', 24),
(430, 'Mendez', 24),
(431, 'Naic', 24),
(432, 'Noveleta', 24),
(433, 'Rosario', 24),
(434, 'Silang', 24),
(435, 'Tanza', 24),
(436, 'Ternate', 24),
(437, 'Bogo City', 25),
(438, 'Cebu City', 25),
(439, 'Carcar City', 25),
(440, 'Danao City', 25),
(441, 'Lapu-Lapu City', 25),
(442, 'Mandaue City', 25),
(443, 'Naga City', 25),
(444, 'Talisay City', 25),
(445, 'Toledo City', 25),
(446, 'Alcantara', 25),
(447, 'Alcoy', 25),
(448, 'Alegria', 25),
(449, 'Aloguinsan', 25),
(450, 'Argao', 25),
(451, 'Asturias', 25),
(452, 'Badian', 25),
(453, 'Balamban', 25),
(454, 'Bantayan', 25),
(455, 'Barili', 25),
(456, 'Boljoon', 25),
(457, 'Borbon', 25),
(458, 'Carmen', 25),
(459, 'Catmon', 25),
(460, 'Compostela', 25),
(461, 'Consolacion', 25),
(462, 'Cordoba', 25),
(463, 'Daanbantayan', 25),
(464, 'Dalaguete', 25),
(465, 'Dumanjug', 25),
(466, 'Ginatilan', 25),
(467, 'Liloan', 25),
(468, 'Madridejos', 25),
(469, 'Malabuyoc', 25),
(470, 'Medellin', 25),
(471, 'Minglanilla', 25),
(472, 'Moalboal', 25),
(473, 'Oslob', 25),
(474, 'Pilar', 25),
(475, 'Pinamungahan', 25),
(476, 'Poro', 25),
(477, 'Ronda', 25),
(478, 'Samboan', 25),
(479, 'San Fernando', 25),
(480, 'San Francisco', 25),
(481, 'San Remigio', 25),
(482, 'Santa Fe', 25),
(483, 'Santander', 25),
(484, 'Sibonga', 25),
(485, 'Sogod', 25),
(486, 'Tabogon', 25),
(487, 'Tabuelan', 25),
(488, 'Tuburan', 25),
(489, 'Tudela', 25),
(490, 'Compostela', 26),
(491, 'Laak', 26),
(492, 'Mabini', 26),
(493, 'Maco', 26),
(494, 'Maragusan', 26),
(495, 'Mawab', 26),
(496, 'Monkayo', 26),
(497, 'Montevista', 26),
(498, 'Nabunturan', 26),
(499, 'New Bataan', 26),
(500, 'Pantukan', 26),
(501, 'Kidapawan City', 27),
(502, 'Alamada', 27),
(503, 'Aleosan', 27),
(504, 'Antipas', 27),
(505, 'Arakan', 27),
(506, 'Banisilan', 27),
(507, 'Carmen', 27),
(508, 'Kabacan', 27),
(509, 'Libungan', 27),
(510, 'M''lang', 27),
(511, 'Magpet', 27),
(512, 'Makilala', 27),
(513, 'Matalam', 27),
(514, 'Midsayap', 27),
(515, 'Pigkawayan', 27),
(516, 'Pikit', 27),
(517, 'President Roxas', 27),
(518, 'Tulunan', 27),
(519, 'Panabo City', 28),
(520, 'Island Garden City of Samal', 28),
(521, 'Tagum City', 28),
(522, 'Asuncion', 28),
(523, 'Braulio E. Dujali', 28),
(524, 'Carmen', 28),
(525, 'Kapalong', 28),
(526, 'New Corella', 28),
(527, 'San Isidro', 28),
(528, 'Santo Tomas', 28),
(529, 'Talaingod', 28),
(530, 'Davao City', 29),
(531, 'Digos City', 29),
(532, 'Bansalan', 29),
(533, 'Don Marcelino', 29),
(534, 'Hagonoy', 29),
(535, 'Jose Abad Santos', 29),
(536, 'Kiblawan', 29),
(537, 'Magsaysay', 29),
(538, 'Malalag', 29),
(539, 'Malita', 29),
(540, 'Matanao', 29),
(541, 'Padada', 29),
(542, 'Santa Cruz', 29),
(543, 'Santa Maria', 29),
(544, 'Sarangani', 29),
(545, 'Sulop', 29),
(546, 'Mati City', 30),
(547, 'Baganga', 30),
(548, 'Banaybanay', 30),
(549, 'Boston', 30),
(550, 'Caraga', 30),
(551, 'Cateel', 30),
(552, 'Governor Generoso', 30),
(553, 'Lupon', 30),
(554, 'Manay', 30),
(555, 'San Isidro', 30),
(556, 'Tarragona', 30),
(557, 'Arteche', 31),
(558, 'Balangiga', 31),
(559, 'Balangkayan', 31),
(560, 'Borongan', 31),
(561, 'Can-avid', 31),
(562, 'Dolores', 31),
(563, 'General MacArthur', 31),
(564, 'Giporlos', 31),
(565, 'Guiuan', 31),
(566, 'Hernani', 31),
(567, 'Jipapad', 31),
(568, 'Lawaan', 31),
(569, 'Llorente', 31),
(570, 'Maslog', 31),
(571, 'Maydolong', 31),
(572, 'Mercedes', 31),
(573, 'Oras', 31),
(574, 'Quinapondan', 31),
(575, 'Salcedo', 31),
(576, 'San Julian', 31),
(577, 'San Policarpo', 31),
(578, 'Sulat', 31),
(579, 'Taft', 31),
(580, 'Buenavista', 32),
(581, 'Jordan', 32),
(582, 'Nueva Valencia', 32),
(583, 'San Lorenzo', 32),
(584, 'Sibunag', 32),
(585, 'Aguinaldo', 33),
(586, 'Alfonso Lista', 33),
(587, 'Asipulo', 33),
(588, 'Banaue', 33),
(589, 'Hingyon', 33),
(590, 'Hungduan', 33),
(591, 'Kiangan', 33),
(592, 'Lagawe', 33),
(593, 'Lamut', 33),
(594, 'Mayoyao', 33),
(595, 'Tinoc', 33),
(596, 'Batac City', 34),
(597, 'Laoag City', 34),
(598, 'Adams', 34),
(599, 'Bacarra', 34),
(600, 'Badoc', 34),
(601, 'Bangui', 34),
(602, 'Banna', 34),
(603, 'Burgos', 34),
(604, 'Carasi', 34),
(605, 'Currimao', 34),
(606, 'Dingras', 34),
(607, 'Dumalneg', 34),
(608, 'Marcos', 34),
(609, 'Nueva Era', 34),
(610, 'Pagudpud', 34),
(611, 'Paoay', 34),
(612, 'Pasuquin', 34),
(613, 'Piddig', 34),
(614, 'Pinili', 34),
(615, 'San Nicolas', 34),
(616, 'Sarrat', 34),
(617, 'Solsona', 34),
(618, 'Vintar', 34),
(619, 'Candon City', 35),
(620, 'Vigan City', 35),
(621, 'Alilem', 35),
(622, 'Banayoyo', 35),
(623, 'Bantay', 35),
(624, 'Burgos', 35),
(625, 'Cabugao', 35),
(626, 'Caoayan', 35),
(627, 'Cervantes', 35),
(628, 'Galimuyod', 35),
(629, 'Gregorio Del Pilar', 35),
(630, 'Lidlidda', 35),
(631, 'Magsingal', 35),
(632, 'Nagbukel', 35),
(633, 'Narvacan', 35),
(634, 'Quirino', 35),
(635, 'Salcedo', 35),
(636, 'San Emilio', 35),
(637, 'San Esteban', 35),
(638, 'San Ildefonso', 35),
(639, 'San Juan', 35),
(640, 'San Vicente', 35),
(641, 'Santa', 35),
(642, 'Santa Catalina', 35),
(643, 'Santa Cruz', 35),
(644, 'Santa Lucia', 35),
(645, 'Santa Maria', 35),
(646, 'Santiago', 35),
(647, 'Santo Domingo', 35),
(648, 'Sigay', 35),
(649, 'Sinait', 35),
(650, 'Sugpon', 35),
(651, 'Suyo', 35),
(652, 'Tagudin', 35),
(653, 'Iloilo City', 36),
(654, 'Passi City', 36),
(655, 'Ajuy', 36),
(656, 'Alimodian', 36),
(657, 'Anilao', 36),
(658, 'Badiangan', 36),
(659, 'Balasan', 36),
(660, 'Banate', 36),
(661, 'Barotac Nuevo', 36),
(662, 'Barotac Viejo', 36),
(663, 'Batad', 36),
(664, 'Bingawan', 36),
(665, 'Cabatuan', 36),
(666, 'Calinog', 36),
(667, 'Carles', 36),
(668, 'Concepcion', 36),
(669, 'Dingle', 36),
(670, 'Dueñas', 36),
(671, 'Dumangas', 36),
(672, 'Estancia', 36),
(673, 'Guimbal', 36),
(674, 'Igbaras', 36),
(675, 'Janiuay', 36),
(676, 'Lambunao', 36),
(677, 'Leganes', 36),
(678, 'Lemery', 36),
(679, 'Leon', 36),
(680, 'Maasin', 36),
(681, 'Miagao', 36),
(682, 'Mina', 36),
(683, 'New Lucena', 36),
(684, 'Oton', 36),
(685, 'Pavia', 36),
(686, 'Pototan', 36),
(687, 'San Dionisio', 36),
(688, 'San Enrique', 36),
(689, 'San Joaquin', 36),
(690, 'San Miguel', 36),
(691, 'San Rafael', 36),
(692, 'Santa Barbara', 36),
(693, 'Sara', 36),
(694, 'Tigbauan', 36),
(695, 'Tubungan', 36),
(696, 'Zarraga', 36),
(697, 'Cauayan City', 37),
(698, 'Santiago City', 37),
(699, 'Alicia', 37),
(700, 'Angadanan', 37),
(701, 'Aurora', 37),
(702, 'Benito Soliven', 37),
(703, 'Burgos', 37),
(704, 'Cabagan', 37),
(705, 'Cabatuan', 37),
(706, 'Cordon', 37),
(707, 'Delfin Albano', 37),
(708, 'Dinapigue', 37),
(709, 'Divilacan', 37),
(710, 'Echague', 37),
(711, 'Gamu', 37),
(712, 'Ilagan', 37),
(713, 'Jones', 37),
(714, 'Luna', 37),
(715, 'Maconacon', 37),
(716, 'Mallig', 37),
(717, 'Naguilian', 37),
(718, 'Palanan', 37),
(719, 'Quezon', 37),
(720, 'Quirino', 37),
(721, 'Ramon', 37),
(722, 'Reina Mercedes', 37),
(723, 'Roxas', 37),
(724, 'San Agustin', 37),
(725, 'San Guillermo', 37),
(726, 'San Isidro', 37),
(727, 'San Manuel', 37),
(728, 'San Mariano', 37),
(729, 'San Mateo', 37),
(730, 'San Pablo', 37),
(731, 'Santa Maria', 37),
(732, 'Santo Tomas', 37),
(733, 'Tumauini', 37),
(734, 'Tabuk', 38),
(735, 'Balbalan', 38),
(736, 'Lubuagan', 38),
(737, 'Pasil', 38),
(738, 'Pinukpuk', 38),
(739, 'Rizal', 38),
(740, 'Tanudan', 38),
(741, 'Tinglayan', 38),
(742, 'San Fernando City', 39),
(743, 'Agoo', 39),
(744, 'Aringay', 39),
(745, 'Bacnotan', 39),
(746, 'Bagulin', 39),
(747, 'Balaoan', 39),
(748, 'Bangar', 39),
(749, 'Bauang', 39),
(750, 'Burgos', 39),
(751, 'Caba', 39),
(752, 'Luna', 39),
(753, 'Naguilian', 39),
(754, 'Pugo', 39),
(755, 'Rosario', 39),
(756, 'San Gabriel', 39),
(757, 'San Juan', 39),
(758, 'Santo Tomas', 39),
(759, 'Santol', 39),
(760, 'Sudipen', 39),
(761, 'Tubao', 39),
(762, 'Biñan City', 40),
(763, 'Calamba City', 40),
(764, 'San Pablo City', 40),
(765, 'Santa Rosa City', 40),
(766, 'Alaminos', 40),
(767, 'Bay', 40),
(768, 'Cabuyao', 40),
(769, 'Calauan', 40),
(770, 'Cavinti', 40),
(771, 'Famy', 40),
(772, 'Kalayaan', 40),
(773, 'Liliw', 40),
(774, 'Los Baños', 40),
(775, 'Luisiana', 40),
(776, 'Lumban', 40),
(777, 'Mabitac', 40),
(778, 'Magdalena', 40),
(779, 'Majayjay', 40),
(780, 'Nagcarlan', 40),
(781, 'Paete', 40),
(782, 'Pagsanjan', 40),
(783, 'Pakil', 40),
(784, 'Pangil', 40),
(785, 'Pila', 40),
(786, 'Rizal', 40),
(787, 'San Pedro', 40),
(788, 'Santa Cruz', 40),
(789, 'Santa Maria', 40),
(790, 'Siniloan', 40),
(791, 'Victoria', 40),
(792, 'Iligan City', 41),
(793, 'Bacolod', 41),
(794, 'Baloi', 41),
(795, 'Baroy', 41),
(796, 'Kapatagan', 41),
(797, 'Kauswagan', 41),
(798, 'Kolambugan', 41),
(799, 'Lala', 41),
(800, 'Linamon', 41),
(801, 'Magsaysay', 41),
(802, 'Maigo', 41),
(803, 'Matungao', 41),
(804, 'Munai', 41),
(805, 'Nunungan', 41),
(806, 'Pantao Ragat', 41),
(807, 'Pantar', 41),
(808, 'Poona Piagapo', 41),
(809, 'Salvador', 41),
(810, 'Sapad', 41),
(811, 'Sultan Naga Dimaporo', 41),
(812, 'Tagoloan', 41),
(813, 'Tangcal', 41),
(814, 'Tubod', 41),
(815, 'Marawi City', 42),
(816, 'Bacolod-Kalawi', 42),
(817, 'Balabagan', 42),
(818, 'Balindong', 42),
(819, 'Bayang', 42),
(820, 'Binidayan', 42),
(821, 'Buadiposo-Buntong', 42),
(822, 'Bubong', 42),
(823, 'Bumbaran', 42),
(824, 'Butig', 42),
(825, 'Calanogas', 42),
(826, 'Ditsaan-Ramain', 42),
(827, 'Ganassi', 42),
(828, 'Kapai', 42),
(829, 'Kapatagan', 42),
(830, 'Lumba-Bayabao', 42),
(831, 'Lumbaca-Unayan', 42),
(832, 'Lumbatan', 42),
(833, 'Lumbayanague', 42),
(834, 'Madalum', 42),
(835, 'Madamba', 42),
(836, 'Maguing', 42),
(837, 'Malabang', 42),
(838, 'Marantao', 42),
(839, 'Marogong', 42),
(840, 'Masiu', 42),
(841, 'Mulondo', 42),
(842, 'Pagayawan', 42),
(843, 'Piagapo', 42),
(844, 'Poona Bayabao', 42),
(845, 'Pualas', 42),
(846, 'Saguiaran', 42),
(847, 'Sultan Dumalondong', 42),
(848, 'Picong', 42),
(849, 'Tagoloan II', 42),
(850, 'Tamparan', 42),
(851, 'Taraka', 42),
(852, 'Tubaran', 42),
(853, 'Tugaya', 42),
(854, 'Wao', 42),
(855, 'Ormoc City', 43),
(856, 'Tacloban City', 43),
(857, 'Abuyog', 43),
(858, 'Alangalang', 43),
(859, 'Albuera', 43),
(860, 'Babatngon', 43),
(861, 'Barugo', 43),
(862, 'Bato', 43),
(863, 'Baybay', 43),
(864, 'Burauen', 43),
(865, 'Calubian', 43),
(866, 'Capoocan', 43),
(867, 'Carigara', 43),
(868, 'Dagami', 43),
(869, 'Dulag', 43),
(870, 'Hilongos', 43),
(871, 'Hindang', 43),
(872, 'Inopacan', 43),
(873, 'Isabel', 43),
(874, 'Jaro', 43),
(875, 'Javier', 43),
(876, 'Julita', 43),
(877, 'Kananga', 43),
(878, 'La Paz', 43),
(879, 'Leyte', 43),
(880, 'Liloan', 43),
(881, 'MacArthur', 43),
(882, 'Mahaplag', 43),
(883, 'Matag-ob', 43),
(884, 'Matalom', 43),
(885, 'Mayorga', 43),
(886, 'Merida', 43),
(887, 'Palo', 43),
(888, 'Palompon', 43),
(889, 'Pastrana', 43),
(890, 'San Isidro', 43),
(891, 'San Miguel', 43),
(892, 'Santa Fe', 43),
(893, 'Sogod', 43),
(894, 'Tabango', 43),
(895, 'Tabontabon', 43),
(896, 'Tanauan', 43),
(897, 'Tolosa', 43),
(898, 'Tunga', 43),
(899, 'Villaba', 43),
(900, 'Cotabato City', 44),
(901, 'Ampatuan', 44),
(902, 'Barira', 44),
(903, 'Buldon', 44),
(904, 'Buluan', 44),
(905, 'Datu Abdullah Sangki', 44),
(906, 'Datu Anggal Midtimbang', 44),
(907, 'Datu Blah T. Sinsuat', 44),
(908, 'Datu Hoffer Ampatuan', 44),
(909, 'Datu Montawal', 44),
(910, 'Datu Odin Sinsuat', 44),
(911, 'Datu Paglas', 44),
(912, 'Datu Piang', 44),
(913, 'Datu Salibo', 44),
(914, 'Datu Saudi-Ampatuan', 44),
(915, 'Datu Unsay', 44),
(916, 'General Salipada K. Pendatun', 44),
(917, 'Guindulungan', 44),
(918, 'Kabuntalan', 44),
(919, 'Mamasapano', 44),
(920, 'Mangudadatu', 44),
(921, 'Matanog', 44),
(922, 'Northern Kabuntalan', 44),
(923, 'Pagalungan', 44),
(924, 'Paglat', 44),
(925, 'Pandag', 44),
(926, 'Parang', 44),
(927, 'Rajah Buayan', 44),
(928, 'Shariff Aguak', 44),
(929, 'Shariff Saydona Mustapha', 44),
(930, 'South Upi', 44),
(931, 'Sultan Kudarat', 44),
(932, 'Sultan Mastura', 44),
(933, 'Sultan sa Barongis', 44),
(934, 'Talayan', 44),
(935, 'Talitay', 44),
(936, 'Upi', 44),
(937, 'Boac', 45),
(938, 'Buenavista', 45),
(939, 'Gasan', 45),
(940, 'Mogpog', 45),
(941, 'Santa Cruz', 45),
(942, 'Torrijos', 45),
(943, 'Masbate City', 46),
(944, 'Aroroy', 46),
(945, 'Baleno', 46),
(946, 'Balud', 46),
(947, 'Batuan', 46),
(948, 'Cataingan', 46),
(949, 'Cawayan', 46),
(950, 'Claveria', 46),
(951, 'Dimasalang', 46),
(952, 'Esperanza', 46),
(953, 'Mandaon', 46),
(954, 'Milagros', 46),
(955, 'Mobo', 46),
(956, 'Monreal', 46),
(957, 'Palanas', 46),
(958, 'Pio V. Corpuz', 46),
(959, 'Placer', 46),
(960, 'San Fernando', 46),
(961, 'San Jacinto', 46),
(962, 'San Pascual', 46),
(963, 'Uson', 46),
(964, 'Caloocan', 47),
(965, 'Las Piñas', 47),
(966, 'Makati', 47),
(967, 'Malabon', 47),
(968, 'Mandaluyong', 47),
(969, 'Manila', 47),
(970, 'Marikina', 47),
(971, 'Muntinlupa', 47),
(972, 'Navotas', 47),
(973, 'Parañaque', 47),
(974, 'Pasay', 47),
(975, 'Pasig', 47),
(976, 'Quezon City', 47),
(977, 'San Juan City', 47),
(978, 'Taguig', 47),
(979, 'Valenzuela City', 47),
(980, 'Pateros', 47),
(981, 'Oroquieta City', 48),
(982, 'Ozamiz City', 48),
(983, 'Tangub City', 48),
(984, 'Aloran', 48),
(985, 'Baliangao', 48),
(986, 'Bonifacio', 48),
(987, 'Calamba', 48),
(988, 'Clarin', 48),
(989, 'Concepcion', 48),
(990, 'Don Victoriano Chiongbian', 48),
(991, 'Jimenez', 48),
(992, 'Lopez Jaena', 48),
(993, 'Panaon', 48),
(994, 'Plaridel', 48),
(995, 'Sapang Dalaga', 48),
(996, 'Sinacaban', 48),
(997, 'Tudela', 48),
(998, 'Cagayan de Oro', 49),
(999, 'Gingoog City', 49),
(1000, 'Alubijid', 49),
(1001, 'Balingasag', 49),
(1002, 'Balingoan', 49),
(1003, 'Binuangan', 49),
(1004, 'Claveria', 49),
(1005, 'El Salvador', 49),
(1006, 'Gitagum', 49),
(1007, 'Initao', 49),
(1008, 'Jasaan', 49),
(1009, 'Kinoguitan', 49),
(1010, 'Lagonglong', 49),
(1011, 'Laguindingan', 49),
(1012, 'Libertad', 49),
(1013, 'Lugait', 49),
(1014, 'Magsaysay', 49),
(1015, 'Manticao', 49),
(1016, 'Medina', 49),
(1017, 'Naawan', 49),
(1018, 'Opol', 49),
(1019, 'Salay', 49),
(1020, 'Sugbongcogon', 49),
(1021, 'Tagoloan', 49),
(1022, 'Talisayan', 49),
(1023, 'Villanueva', 49),
(1024, 'Barlig', 50),
(1025, 'Bauko', 50),
(1026, 'Besao', 50),
(1027, 'Bontoc', 50),
(1028, 'Natonin', 50),
(1029, 'Paracelis', 50),
(1030, 'Sabangan', 50),
(1031, 'Sadanga', 50),
(1032, 'Sagada', 50),
(1033, 'Tadian', 50),
(1034, 'Bacolod City', 51),
(1035, 'Bago City', 51),
(1036, 'Cadiz City', 51),
(1037, 'Escalante City', 51),
(1038, 'Himamaylan City', 51),
(1039, 'Kabankalan City', 51),
(1040, 'La Carlota City', 51),
(1041, 'Sagay City', 51),
(1042, 'San Carlos City', 51),
(1043, 'Silay City', 51),
(1044, 'Sipalay City', 51),
(1045, 'Talisay City', 51),
(1046, 'Victorias City', 51),
(1047, 'Binalbagan', 51),
(1048, 'Calatrava', 51),
(1049, 'Candoni', 51),
(1050, 'Cauayan', 51),
(1051, 'Enrique B. Magalona', 51),
(1052, 'Hinigaran', 51),
(1053, 'Hinoba-an', 51),
(1054, 'Ilog', 51),
(1055, 'Isabela', 51),
(1056, 'La Castellana', 51),
(1057, 'Manapla', 51),
(1058, 'Moises Padilla', 51),
(1059, 'Murcia', 51),
(1060, 'Pontevedra', 51),
(1061, 'Pulupandan', 51),
(1062, 'Salvador Benedicto', 51),
(1063, 'San Enrique', 51),
(1064, 'Toboso', 51),
(1065, 'Valladolid', 51),
(1066, 'Bais City', 52),
(1067, 'Bayawan City', 52),
(1068, 'Canlaon City', 52),
(1069, 'Guihulngan City', 52),
(1070, 'Dumaguete City', 52),
(1071, 'Tanjay City', 52),
(1072, 'Amlan', 52),
(1073, 'Ayungon', 52),
(1074, 'Bacong', 52),
(1075, 'Basay', 52),
(1076, 'Bindoy', 52),
(1077, 'Dauin', 52),
(1078, 'Jimalalud', 52),
(1079, 'La Libertad', 52),
(1080, 'Mabinay', 52),
(1081, 'Manjuyod', 52),
(1082, 'Pamplona', 52),
(1083, 'San Jose', 52),
(1084, 'Santa Catalina', 52),
(1085, 'Siaton', 52),
(1086, 'Sibulan', 52),
(1087, 'Tayasan', 52),
(1088, 'Valencia', 52),
(1089, 'Vallehermoso', 52),
(1090, 'Zamboanguita', 52),
(1091, 'Allen', 53),
(1092, 'Biri', 53),
(1093, 'Bobon', 53),
(1094, 'Capul', 53),
(1095, 'Catarman', 53),
(1096, 'Catubig', 53),
(1097, 'Gamay', 53),
(1098, 'Laoang', 53),
(1099, 'Lapinig', 53),
(1100, 'Las Navas', 53),
(1101, 'Lavezares', 53),
(1102, 'Lope de Vega', 53),
(1103, 'Mapanas', 53),
(1104, 'Mondragon', 53),
(1105, 'Palapag', 53),
(1106, 'Pambujan', 53),
(1107, 'Rosario', 53),
(1108, 'San Antonio', 53),
(1109, 'San Isidro', 53),
(1110, 'San Jose', 53),
(1111, 'San Roque', 53),
(1112, 'San Vicente', 53),
(1113, 'Silvino Lobos', 53),
(1114, 'Victoria', 53),
(1115, 'Cabanatuan City', 54),
(1116, 'Gapan City', 54),
(1117, 'Science City of Muñoz', 54),
(1118, 'Palayan City', 54),
(1119, 'San Jose City', 54),
(1120, 'Aliaga', 54),
(1121, 'Bongabon', 54),
(1122, 'Cabiao', 54),
(1123, 'Carranglan', 54),
(1124, 'Cuyapo', 54),
(1125, 'Gabaldon', 54),
(1126, 'General Mamerto Natividad', 54),
(1127, 'General Tinio', 54),
(1128, 'Guimba', 54),
(1129, 'Jaen', 54),
(1130, 'Laur', 54),
(1131, 'Licab', 54),
(1132, 'Llanera', 54),
(1133, 'Lupao', 54),
(1134, 'Nampicuan', 54),
(1135, 'Pantabangan', 54),
(1136, 'Peñaranda', 54),
(1137, 'Quezon', 54),
(1138, 'Rizal', 54),
(1139, 'San Antonio', 54),
(1140, 'San Isidro', 54),
(1141, 'San Leonardo', 54),
(1142, 'Santa Rosa', 54),
(1143, 'Santo Domingo', 54),
(1144, 'Talavera', 54),
(1145, 'Talugtug', 54),
(1146, 'Zaragoza', 54),
(1147, 'Alfonso Castaneda', 55),
(1148, 'Ambaguio', 55),
(1149, 'Aritao', 55),
(1150, 'Bagabag', 55),
(1151, 'Bambang', 55),
(1152, 'Bayombong', 55),
(1153, 'Diadi', 55),
(1154, 'Dupax del Norte', 55),
(1155, 'Dupax del Sur', 55),
(1156, 'Kasibu', 55),
(1157, 'Kayapa', 55),
(1158, 'Quezon', 55),
(1159, 'Santa Fe', 55),
(1160, 'Solano', 55),
(1161, 'Villaverde', 55),
(1162, 'Abra de Ilog', 56),
(1163, 'Calintaan', 56),
(1164, 'Looc', 56),
(1165, 'Lubang', 56),
(1166, 'Magsaysay', 56),
(1167, 'Mamburao', 56),
(1168, 'Paluan', 56),
(1169, 'Rizal', 56),
(1170, 'Sablayan', 56),
(1171, 'San Jose', 56),
(1172, 'Santa Cruz', 56),
(1173, 'Calapan City', 57),
(1174, 'Baco', 57),
(1175, 'Bansud', 57),
(1176, 'Bongabong', 57),
(1177, 'Bulalacao', 57),
(1178, 'Gloria', 57),
(1179, 'Mansalay', 57),
(1180, 'Naujan', 57),
(1181, 'Pinamalayan', 57),
(1182, 'Pola', 57),
(1183, 'Puerto Galera', 57),
(1184, 'Roxas', 57),
(1185, 'San Teodoro', 57),
(1186, 'Socorro', 57),
(1187, 'Victoria', 57),
(1188, 'Puerto Princesa City', 58),
(1189, 'Aborlan', 58),
(1190, 'Agutaya', 58),
(1191, 'Araceli', 58),
(1192, 'Balabac', 58),
(1193, 'Bataraza', 58),
(1194, 'Brooke''s Point', 58),
(1195, 'Busuanga', 58),
(1196, 'Cagayancillo', 58),
(1197, 'Coron', 58),
(1198, 'Culion', 58),
(1199, 'Cuyo', 58),
(1200, 'Dumaran', 58),
(1201, 'El Nido', 58),
(1202, 'Kalayaan', 58),
(1203, 'Linapacan', 58),
(1204, 'Magsaysay', 58),
(1205, 'Narra', 58),
(1206, 'Quezon', 58),
(1207, 'Rizal', 58),
(1208, 'Roxas', 58),
(1209, 'San Vicente', 58),
(1210, 'Sofronio Española', 58),
(1211, 'Taytay', 58),
(1212, 'Angeles City', 59),
(1213, 'City of San Fernando', 59),
(1214, 'Apalit', 59),
(1215, 'Arayat', 59),
(1216, 'Bacolor', 59),
(1217, 'Candaba', 59),
(1218, 'Floridablanca', 59),
(1219, 'Guagua', 59),
(1220, 'Lubao', 59),
(1221, 'Mabalacat', 59),
(1222, 'Macabebe', 59),
(1223, 'Magalang', 59),
(1224, 'Masantol', 59),
(1225, 'Mexico', 59),
(1226, 'Minalin', 59),
(1227, 'Porac', 59),
(1228, 'San Luis', 59),
(1229, 'San Simon', 59),
(1230, 'Santa Ana', 59),
(1231, 'Santa Rita', 59),
(1232, 'Santo Tomas', 59),
(1233, 'Sasmuan', 59),
(1234, 'Alaminos City', 60),
(1235, 'Dagupan City', 60),
(1236, 'San Carlos City', 60),
(1237, 'Urdaneta City', 60),
(1238, 'Agno', 60),
(1239, 'Aguilar', 60),
(1240, 'Alcala', 60),
(1241, 'Anda', 60),
(1242, 'Asingan', 60),
(1243, 'Balungao', 60),
(1244, 'Bani', 60),
(1245, 'Basista', 60),
(1246, 'Bautista', 60),
(1247, 'Bayambang', 60),
(1248, 'Binalonan', 60),
(1249, 'Binmaley', 60),
(1250, 'Bolinao', 60),
(1251, 'Bugallon', 60),
(1252, 'Burgos', 60),
(1253, 'Calasiao', 60),
(1254, 'Dasol', 60),
(1255, 'Infanta', 60),
(1256, 'Labrador', 60),
(1257, 'Laoac', 60),
(1258, 'Lingayen', 60),
(1259, 'Mabini', 60),
(1260, 'Malasiqui', 60),
(1261, 'Manaoag', 60),
(1262, 'Mangaldan', 60),
(1263, 'Mangatarem', 60),
(1264, 'Mapandan', 60),
(1265, 'Natividad', 60),
(1266, 'Pozzorubio', 60),
(1267, 'Rosales', 60),
(1268, 'San Fabian', 60),
(1269, 'San Jacinto', 60),
(1270, 'San Manuel', 60),
(1271, 'San Nicolas', 60),
(1272, 'San Quintin', 60),
(1273, 'Santa Barbara', 60),
(1274, 'Santa Maria', 60),
(1275, 'Santo Tomas', 60),
(1276, 'Sison', 60),
(1277, 'Sual', 60),
(1278, 'Tayug', 60),
(1279, 'Umingan', 60),
(1280, 'Urbiztondo', 60),
(1281, 'Villasis', 60),
(1282, 'Lucena City', 61),
(1283, 'Tayabas City', 61),
(1284, 'Agdangan', 61),
(1285, 'Alabat', 61),
(1286, 'Atimonan', 61),
(1287, 'Buenavista', 61),
(1288, 'Burdeos', 61),
(1289, 'Calauag', 61),
(1290, 'Candelaria', 61),
(1291, 'Catanauan', 61),
(1292, 'Dolores', 61),
(1293, 'General Luna', 61),
(1294, 'General Nakar', 61),
(1295, 'Guinayangan', 61),
(1296, 'Gumaca', 61),
(1297, 'Infanta', 61),
(1298, 'Jomalig', 61),
(1299, 'Lopez', 61),
(1300, 'Lucban', 61),
(1301, 'Macalelon', 61),
(1302, 'Mauban', 61),
(1303, 'Mulanay', 61),
(1304, 'Padre Burgos', 61),
(1305, 'Pagbilao', 61),
(1306, 'Panukulan', 61),
(1307, 'Patnanungan', 61),
(1308, 'Perez', 61),
(1309, 'Pitogo', 61),
(1310, 'Plaridel', 61),
(1311, 'Polillo', 61),
(1312, 'Quezon', 61),
(1313, 'Real', 61),
(1314, 'Sampaloc', 61),
(1315, 'San Andres', 61),
(1316, 'San Antonio', 61),
(1317, 'San Francisco', 61),
(1318, 'San Narciso', 61),
(1319, 'Sariaya', 61),
(1320, 'Tagkawayan', 61),
(1321, 'Tiaong', 61),
(1322, 'Unisan', 61),
(1323, 'Aglipay', 62),
(1324, 'Cabarroguis', 62),
(1325, 'Diffun', 62),
(1326, 'Maddela', 62),
(1327, 'Nagtipunan', 62),
(1328, 'Saguday', 62),
(1329, 'Antipolo City', 63),
(1330, 'Angono', 63),
(1331, 'Baras', 63),
(1332, 'Binangonan', 63),
(1333, 'Cainta', 63),
(1334, 'Cardona', 63),
(1335, 'Jalajala', 63),
(1336, 'Morong', 63),
(1337, 'Pililla', 63),
(1338, 'Rodriguez', 63),
(1339, 'San Mateo', 63),
(1340, 'Tanay', 63),
(1341, 'Taytay', 63),
(1342, 'Teresa', 63),
(1343, 'Alcantara', 64),
(1344, 'Banton', 64),
(1345, 'Cajidiocan', 64),
(1346, 'Calatrava', 64),
(1347, 'Concepcion', 64),
(1348, 'Corcuera', 64),
(1349, 'Ferrol', 64),
(1350, 'Looc', 64),
(1351, 'Magdiwang', 64),
(1352, 'Odiongan', 64),
(1353, 'Romblon', 64),
(1354, 'San Agustin', 64),
(1355, 'San Andres', 64),
(1356, 'San Fernando', 64),
(1357, 'San Jose', 64),
(1358, 'Santa Fe', 64),
(1359, 'Santa Maria', 64),
(1360, 'Calbayog City', 65),
(1361, 'Catbalogan City', 65),
(1362, 'Almagro', 65),
(1363, 'Basey', 65),
(1364, 'Calbiga', 65),
(1365, 'Daram', 65),
(1366, 'Gandara', 65),
(1367, 'Hinabangan', 65),
(1368, 'Jiabong', 65),
(1369, 'Marabut', 65),
(1370, 'Matuguinao', 65),
(1371, 'Motiong', 65),
(1372, 'Pagsanghan', 65),
(1373, 'Paranas', 65),
(1374, 'Pinabacdao', 65),
(1375, 'San Jorge', 65),
(1376, 'San Jose De Buan', 65),
(1377, 'San Sebastian', 65),
(1378, 'Santa Margarita', 65),
(1379, 'Santa Rita', 65),
(1380, 'Santo Niño', 65),
(1381, 'Tagapul-an', 65),
(1382, 'Talalora', 65),
(1383, 'Tarangnan', 65),
(1384, 'Villareal', 65),
(1385, 'Zumarraga', 65),
(1386, 'Alabel', 66),
(1387, 'Glan', 66),
(1388, 'Kiamba', 66),
(1389, 'Maasim', 66),
(1390, 'Maitum', 66),
(1391, 'Malapatan', 66),
(1392, 'Malungon', 66),
(1393, 'Enrique Villanueva', 67),
(1394, 'Larena', 67),
(1395, 'Lazi', 67),
(1396, 'Maria', 67),
(1397, 'San Juan', 67),
(1398, 'Siquijor', 67),
(1399, 'Sorsogon City', 68),
(1400, 'Barcelona', 68),
(1401, 'Bulan', 68),
(1402, 'Bulusan', 68),
(1403, 'Casiguran', 68),
(1404, 'Castilla', 68),
(1405, 'Donsol', 68),
(1406, 'Gubat', 68),
(1407, 'Irosin', 68),
(1408, 'Juban', 68),
(1409, 'Magallanes', 68),
(1410, 'Matnog', 68),
(1411, 'Pilar', 68),
(1412, 'Prieto Diaz', 68),
(1413, 'Santa Magdalena', 68),
(1414, 'General Santos City', 69),
(1415, 'Koronadal City', 69),
(1416, 'Banga', 69),
(1417, 'Lake Sebu', 69),
(1418, 'Norala', 69),
(1419, 'Polomolok', 69),
(1420, 'Santo Niño', 69),
(1421, 'Surallah', 69),
(1422, 'T''boli', 69),
(1423, 'Tampakan', 69),
(1424, 'Tantangan', 69),
(1425, 'Tupi', 69),
(1426, 'Maasin City', 70),
(1427, 'Anahawan', 70),
(1428, 'Bontoc', 70),
(1429, 'Hinunangan', 70),
(1430, 'Hinundayan', 70),
(1431, 'Libagon', 70),
(1432, 'Liloan', 70),
(1433, 'Limasawa', 70),
(1434, 'Macrohon', 70),
(1435, 'Malitbog', 70),
(1436, 'Padre Burgos', 70),
(1437, 'Pintuyan', 70),
(1438, 'Saint Bernard', 70),
(1439, 'San Francisco', 70),
(1440, 'San Juan', 70),
(1441, 'San Ricardo', 70),
(1442, 'Silago', 70),
(1443, 'Sogod', 70),
(1444, 'Tomas Oppus', 70),
(1445, 'Tacurong City', 71),
(1446, 'Bagumbayan', 71),
(1447, 'Columbio', 71),
(1448, 'Esperanza', 71),
(1449, 'Isulan', 71),
(1450, 'Kalamansig', 71),
(1451, 'Lambayong', 71),
(1452, 'Lebak', 71),
(1453, 'Lutayan', 71),
(1454, 'Palimbang', 71),
(1455, 'President Quirino', 71),
(1456, 'Senator Ninoy Aquino', 71),
(1457, 'Banguingui', 72),
(1458, 'Hadji Panglima Tahil', 72),
(1459, 'Indanan', 72),
(1460, 'Jolo', 72),
(1461, 'Kalingalan Caluang', 72),
(1462, 'Lugus', 72),
(1463, 'Luuk', 72),
(1464, 'Maimbung', 72),
(1465, 'Old Panamao', 72),
(1466, 'Omar', 72),
(1467, 'Pandami', 72),
(1468, 'Panglima Estino', 72),
(1469, 'Pangutaran', 72),
(1470, 'Parang', 72),
(1471, 'Pata', 72),
(1472, 'Patikul', 72),
(1473, 'Siasi', 72),
(1474, 'Talipao', 72),
(1475, 'Tapul', 72),
(1476, 'Surigao City', 73),
(1477, 'Alegria', 73),
(1478, 'Bacuag', 73),
(1479, 'Basilisa', 73),
(1480, 'Burgos', 73),
(1481, 'Cagdianao', 73),
(1482, 'Claver', 73),
(1483, 'Dapa', 73),
(1484, 'Del Carmen', 73),
(1485, 'Dinagat', 73),
(1486, 'General Luna', 73),
(1487, 'Gigaquit', 73),
(1488, 'Libjo', 73),
(1489, 'Loreto', 73),
(1490, 'Mainit', 73),
(1491, 'Malimono', 73),
(1492, 'Pilar', 73),
(1493, 'Placer', 73),
(1494, 'San Benito', 73),
(1495, 'San Francisco', 73),
(1496, 'San Isidro', 73),
(1497, 'San Jose', 73),
(1498, 'Santa Monica', 73),
(1499, 'Sison', 73),
(1500, 'Socorro', 73),
(1501, 'Tagana-an', 73),
(1502, 'Tubajon', 73),
(1503, 'Tubod', 73),
(1504, 'Bislig City', 74),
(1505, 'Tandag City', 74),
(1506, 'Barobo', 74),
(1507, 'Bayabas', 74),
(1508, 'Cagwait', 74),
(1509, 'Cantilan', 74),
(1510, 'Carmen', 74),
(1511, 'Carrascal', 74),
(1512, 'Cortes', 74),
(1513, 'Hinatuan', 74),
(1514, 'Lanuza', 74),
(1515, 'Lianga', 74),
(1516, 'Lingig', 74),
(1517, 'Madrid', 74),
(1518, 'Marihatag', 74),
(1519, 'San Agustin', 74),
(1520, 'San Miguel', 74),
(1521, 'Tagbina', 74),
(1522, 'Tago', 74),
(1523, 'Tarlac City', 75),
(1524, 'Anao', 75),
(1525, 'Bamban', 75),
(1526, 'Camiling', 75),
(1527, 'Capas', 75),
(1528, 'Concepcion', 75),
(1529, 'Gerona', 75),
(1530, 'La Paz', 75),
(1531, 'Mayantoc', 75),
(1532, 'Moncada', 75),
(1533, 'Paniqui', 75),
(1534, 'Pura', 75),
(1535, 'Ramos', 75),
(1536, 'San Clemente', 75),
(1537, 'San Jose', 75),
(1538, 'San Manuel', 75),
(1539, 'Santa Ignacia', 75),
(1540, 'Victoria', 75),
(1541, 'Bongao', 76),
(1542, 'Languyan', 76),
(1543, 'Mapun', 76),
(1544, 'Panglima Sugala', 76),
(1545, 'Sapa-Sapa', 76),
(1546, 'Sibutu', 76),
(1547, 'Simunul', 76),
(1548, 'Sitangkai', 76),
(1549, 'South Ubian', 76),
(1550, 'Tandubas', 76),
(1551, 'Turtle Islands', 76),
(1552, 'Olongapo City', 77),
(1553, 'Botolan', 77),
(1554, 'Cabangan', 77),
(1555, 'Candelaria', 77),
(1556, 'Castillejos', 77),
(1557, 'Iba', 77),
(1558, 'Masinloc', 77),
(1559, 'Palauig', 77),
(1560, 'San Antonio', 77),
(1561, 'San Felipe', 77),
(1562, 'San Marcelino', 77),
(1563, 'San Narciso', 77),
(1564, 'Santa Cruz', 77),
(1565, 'Subic', 77),
(1566, 'Dapitan City', 78),
(1567, 'Dipolog City', 78),
(1568, 'Bacungan', 78),
(1569, 'Baliguian', 78),
(1570, 'Godod', 78),
(1571, 'Gutalac', 78),
(1572, 'Jose Dalman', 78),
(1573, 'Kalawit', 78),
(1574, 'Katipunan', 78),
(1575, 'La Libertad', 78),
(1576, 'Labason', 78),
(1577, 'Liloy', 78),
(1578, 'Manukan', 78),
(1579, 'Mutia', 78),
(1580, 'Piñan', 78),
(1581, 'Polanco', 78),
(1582, 'President Manuel A. Roxas', 78),
(1583, 'Rizal', 78),
(1584, 'Salug', 78),
(1585, 'Sergio Osmeña Sr.', 78),
(1586, 'Siayan', 78),
(1587, 'Sibuco', 78),
(1588, 'Sibutad', 78),
(1589, 'Sindangan', 78),
(1590, 'Siocon', 78),
(1591, 'Sirawai', 78),
(1592, 'Tampilisan', 78),
(1593, 'Pagadian City', 79),
(1594, 'Zamboanga City', 79),
(1595, 'Aurora', 79),
(1596, 'Bayog', 79),
(1597, 'Dimataling', 79),
(1598, 'Dinas', 79),
(1599, 'Dumalinao', 79),
(1600, 'Dumingag', 79),
(1601, 'Guipos', 79),
(1602, 'Josefina', 79),
(1603, 'Kumalarang', 79),
(1604, 'Labangan', 79),
(1605, 'Lakewood', 79),
(1606, 'Lapuyan', 79),
(1607, 'Mahayag', 79),
(1608, 'Margosatubig', 79),
(1609, 'Midsalip', 79),
(1610, 'Molave', 79),
(1611, 'Pitogo', 79),
(1612, 'Ramon Magsaysay', 79),
(1613, 'San Miguel', 79),
(1614, 'San Pablo', 79),
(1615, 'Sominot', 79),
(1616, 'Tabina', 79),
(1617, 'Tambulig', 79),
(1618, 'Tigbao', 79),
(1619, 'Tukuran', 79),
(1620, 'Vincenzo A. Sagun', 79),
(1621, 'Alicia', 80),
(1622, 'Buug', 80),
(1623, 'Diplahan', 80),
(1624, 'Imelda', 80),
(1625, 'Ipil', 80),
(1626, 'Kabasalan', 80),
(1627, 'Mabuhay', 80),
(1628, 'Malangas', 80),
(1629, 'Naga', 80),
(1630, 'Olutanga', 80),
(1631, 'Payao', 80),
(1632, 'Roseller Lim', 80),
(1633, 'Siay', 80),
(1634, 'Talusan', 80),
(1635, 'Titay', 80),
(1636, 'Tungawan', 80);

-- --------------------------------------------------------

--
-- Table structure for table `event_calendar`
--

CREATE TABLE `event_calendar` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `event_calendar`
--

INSERT INTO `event_calendar` (`id`, `event_date`, `title`, `description`, `date_created`) VALUES
(4, '2015-01-31', 'Philcare Vaccine Holiday', 'test test test', '2015-01-12 00:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `portal_department`
--

CREATE TABLE `portal_department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_department`
--

INSERT INTO `portal_department` (`dep_id`, `dep_name`) VALUES
(1, 'Mktg'),
(2, 'CSAD'),
(3, 'Call Center'),
(4, 'BRO based on company'),
(5, 'Customercare');

-- --------------------------------------------------------

--
-- Table structure for table `portal_dep_emails`
--

CREATE TABLE `portal_dep_emails` (
  `dep_email_id` int(11) NOT NULL,
  `dep_email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dep_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `portal_dl_forms`
--

CREATE TABLE `portal_dl_forms` (
  `dl_id` int(11) NOT NULL,
  `dl_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dl_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_dl_forms`
--

INSERT INTO `portal_dl_forms` (`dl_id`, `dl_name`, `dl_url`, `sort`, `date_created`, `date_modified`, `modified_by`) VALUES
(1, 'Individual Findings', 'https://mail-attachment.googleusercontent.com/attachment/u/0/?ui=2&ik=9eba2aa0ec&view=att&th=14a37808078b04fe&attid=0.1&disp=safe&zw&saduie=AG9B_P8Hu0Yxrpvwl4p0DteXvAbT&sadet=1418565019592&sads=nWiZAM4tOF1yK-if-_xjFBdH5QE', NULL, '2014-12-07 22:12:24', NULL, NULL),
(2, 'BR Website', 'https://doc-04-b8-docs.googleusercontent.com/docs/...', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portal_fav_provider`
--

CREATE TABLE `portal_fav_provider` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prov_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_coordinator` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_address` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_contact` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_code` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_lat` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_long` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_region` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_pin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `portal_feedbacks`
--

CREATE TABLE `portal_feedbacks` (
  `fbs_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `contact_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `comments` longtext COLLATE utf8_bin,
  `read_status` int(1) DEFAULT '0' COMMENT '0=''unread'',1=''read''',
  `date_created` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_feedbacks`
--

INSERT INTO `portal_feedbacks` (`fbs_id`, `user_id`, `subject`, `contact_no`, `comments`, `read_status`, `date_created`, `is_deleted`, `date_deleted`) VALUES
(4, 2, 'sdassdas asdasd  asdasd asd ', '122232321', 'asldkalksdaskdlas', 0, '2014-12-14 17:12:16', 0, NULL),
(5, 2, 'lsdma,', '1232323', 'alsdlamlms', 0, '2014-12-14 17:44:33', 0, NULL),
(6, 2, '1', '12312312', 'asdasdas asdas da sdas da sdas das das', 0, '2015-01-26 02:15:03', 0, NULL),
(7, 2, 'Suggestions', '1233333', '1dsdas', 0, '2015-01-26 02:16:19', 0, NULL),
(8, 2, 'Benefit Coverage & Availment', '123123123', 'asda', 0, '2015-03-13 08:30:36', 0, NULL),
(9, 2, 'Suggestions', 'asda', 'ASDAS', 0, '2015-03-13 08:35:03', 0, NULL),
(10, 2, 'Reimbursement & Claims', 'ASDAS', 'ASDASDAS', 0, '2015-03-13 08:35:17', 0, NULL),
(11, 2, 'Reimbursement & Claims', 'asdas', 'asdasds', 0, '2015-03-13 08:36:16', 0, NULL),
(12, 2, 'Benefit Coverage & Availment', 'c', 'asda', 0, '2015-03-13 08:36:37', 0, NULL),
(13, 2, 'Reimbursement & Claims', 'asdasdas', 'asdasdas', 0, '2015-03-13 08:37:14', 0, NULL),
(14, 2, 'Complaints & Compliments', 'asdas', 'asdas', 0, '2015-03-13 08:37:59', 0, NULL),
(15, 2, 'Complaints & Compliments', 'asdas', 'asdas', 0, '2015-03-13 08:39:50', 0, NULL),
(16, 2, 'Benefit Coverage & Availment', 'ASDAS', 'asdasdas', 0, '2015-03-13 08:40:41', 0, NULL),
(17, 2, 'Reimbursement & Claims', 'sdasd', 'asdas', 0, '2015-03-13 08:42:40', 0, NULL),
(18, 2, 'Benefit Coverage & Availment', 'asdas', 'asdasdas', 0, '2015-03-13 08:42:49', 0, NULL),
(19, 2, 'Complaints & Compliments', 'asda', 'asdas', 0, '2015-03-13 08:43:10', 0, NULL),
(20, 2, 'Complaints & Compliments', 'asda', 'asdas', 0, '2015-03-13 08:45:20', 0, NULL),
(21, 2, 'Complaints & Compliments', 'asda', 'asdas', 0, '2015-03-13 08:45:52', 0, NULL),
(22, 2, 'Reimbursement & Claims', 'asdas', 'asdas', 0, '2015-03-13 08:47:19', 0, NULL),
(23, 2, 'Suggestions', 'asdasdas', 'klkl', 0, '2015-03-13 08:47:50', 0, NULL),
(24, 2, 'Suggestions', 'asdasdas', 'klkl', 0, '2015-03-13 08:50:13', 0, NULL),
(25, 2, 'Suggestions', 'asdasdas', 'klkl', 0, '2015-03-13 08:51:12', 0, NULL),
(26, 2, 'Complaints & Compliments', 'hjh', 'hjh', 0, '2015-03-13 08:53:29', 0, NULL),
(27, 2, 'Complaints & Compliments', 'hjh', 'hjh', 0, '2015-03-13 08:54:17', 0, NULL),
(28, 2, 'Complaints & Compliments', 'hjh', 'hjh', 0, '2015-03-13 08:54:51', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portal_informations`
--

CREATE TABLE `portal_informations` (
  `info_id` int(11) NOT NULL,
  `terms_info` longtext COLLATE utf8_bin,
  `privacy_info` longtext COLLATE utf8_bin,
  `faq_info` longtext COLLATE utf8_bin,
  `logindesc` longtext COLLATE utf8_bin,
  `regdesc` longtext COLLATE utf8_bin,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_informations`
--

INSERT INTO `portal_informations` (`info_id`, `terms_info`, `privacy_info`, `faq_info`, `logindesc`, `regdesc`, `date_modified`, `modified_by`) VALUES
(1, '<div class="fusion-title title">\r\n<h2>Terms of Use</h2>\r\n\r\n<div class="title-sep-container">\r\n<div class="title-sep sep-double sep-dotted">&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<p>Use of the Site is subject to the following terms of use. PhilCare may modify these terms and conditions at any time, and such modifications shall be effective immediately upon posting the modified terms and conditions on the PhilCare Site. You agree to review the agreement periodically to be aware of such modifications, and your accessing or using the service constitutes your acceptance of the agreement as it appears at the time of your access or use. From time to time, PhilCare may offer website visitors the opportunity to participate in additional features or services through the PhilCare Site. You may be required to enter into additional agreements or authorizations before you can access such features or services.</p>\r\n\r\n<div class="fusion-title title">\r\n<h2>Intended for Users 18 and Older</h2>\r\n\r\n<div class="title-sep-container">\r\n<div class="title-sep sep-double sep-dotted">&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<p>The Site is intended for use by individuals 18 years of age or older. This website is not directed for use by children under the age of 18. Users under the age of 18 should get the assistance of a parent or guardian to use this site.</p>\r\n\r\n<p>You agree that you will not:</p>\r\n\r\n<ul>\r\n	<li>Upload or transmit any communications or content of any type that may infringe or violate any rights of any party</li>\r\n	<li>Use this website for any purpose in violation of local, national or international laws</li>\r\n	<li>Use this site as a means to distribute advertising or other unsolicited material to any third party</li>\r\n	<li>Use this website to post or transmit material that is unlawful, obscene, defamatory, threatening, harassing, abusive, slanderous, hateful or embarrassing to any other person or entity</li>\r\n	<li>Attempt to disable, &ldquo;hack&rdquo; or otherwise interfere with the proper functioning of this website</li>\r\n	<li>If you use any part of the Site requiring secure access, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer, and you agree to accept responsibility for all activities that occur under your account or password.</li>\r\n</ul>\r\n', '<p>We take your privacy seriously, and we want you to know how we collect, use, share and protect your information. In addition to this Privacy Policy, users of the PhilCare Site should consult the PhilCare site Terms and Conditions of use as well as any product specific terms and conditions that apply.</p>\r\n\r\n<p>This policy applies to PhilCare.com.ph and other Web locations under PhilCare&rsquo;s control.</p>\r\n\r\n<div class="fusion-title title">\r\n<h2>What Information We Collect</h2>\r\n\r\n<div class="title-sep-container">\r\n<div class="title-sep sep-double sep-dotted">&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<p>We respect the right to privacy of all visitors to the PhilCare Site. We do not collect information that would personally identify you unless you choose to provide it. For example, if you choose to join the community at the PhilCare Online Community, the Privacy Policy and Terms and Conditions of use of that site apply. The personal information that you submit is shared only with those people in the PhilCare organization who need this information to respond to your question or request. Information submitted through PhilCare Site&rsquo;s online forms may be collected to ensure technical functionality. It will also be utilized to address any inappropriate use of our website. We do not save personal information to use for other purposes, nor do we provide it to any other organizations.</p>\r\n\r\n<div class="fusion-title title">\r\n<h2>Email Communications, Newsletter and Related Services</h2>\r\n\r\n<div class="title-sep-container">\r\n<div class="title-sep sep-double sep-dotted">&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<p>PhilCare.com.ph provides you with the opportunity to receive communications from us or third parties. You can sign up for a free email newsletter. You can unsubscribe from this newsletter at any time.</p>\r\n\r\n<p>Email communications that you send to us via the email links on our site may be shared with a customer service representative, employee, medical expert or agent that is most able to address your inquiry. We make every effort to respond in a timely fashion once communications are received. Once we have responded to your communication, it is discarded or archived, depending on the nature of the inquiry.</p>\r\n\r\n<p>The email functionality on our site does not provide a completely secure and confidential means of communication. It&rsquo;s possible that your email communication may be accessed or viewed by another Internet user while in transit to us. If you wish to keep your communication private, do not use our email.</p>\r\n\r\n<p>You may decide at some point that you no longer wish to receive communications from our site. To stop receiving communications, send an email message to customercare@philcare.com.ph or send regular mail to the following postal address:</p>\r\n\r\n<p>PhilCare Website Master<br />\r\n5/F iACADEMY Building<br />\r\n6764 Ayala Avenue<br />\r\nMakati City, Philippines</p>\r\n', '<p>&nbsp;</p>\r\n\r\n<p><strong>Transition FAQs:</strong></p>\r\n\r\n<ol>\r\n	<li>Provider Network concerns (Accreditation/Existing network)</li>\r\n	<li>Co-Pay Process</li>\r\n	<li>Availment Process</li>\r\n	<li>Benefit Design</li>\r\n	<li>Merchant Partners</li>\r\n	<li>Reimbursement Process</li>\r\n	<li>ECU/APE &ndash; pending process confirmation</li>\r\n	<li>ID Replacement Process</li>\r\n	<li>Rates (Dependents)</li>\r\n</ol>\r\n\r\n<p><strong>Provider Network Concerns:</strong></p>\r\n\r\n<ol>\r\n	<li>Can I have my personal doctor/dentist accredited by PhilCare?</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>PhilCare has a list of affiliated provider. If member availed of any services in Outpatient procedure in a non-affiliated provider, this shall be shouldered by the member. Member may contact PhilCare Call Center Hotline to check nearest affiliated provider. Member may also request for affiliation of a non-affiliated provider with PhilCare. If provider is amenable, PhilCare may process affiliation within 30-45 calendar days from receipt of the affiliation request with contact details.</li>\r\n	<li>For confinements in Metro Manila, our Liaison Officer will coordinate with the member during their scheduled visit. Otherwise, the Coordinator or our authorized PhilCare representative will contact the member to advice of the extent of coverage.</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>Is it possible to request also from Philcare to accredit a hospital/clinic?</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>Yes. You just have to provide the provider&rsquo;s name and contact details. If provider is amenable, affiliation process as stated in item #1 will commence.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>If I avail at a non-accredited hospital for an emergency availment, can I reimburse?</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>Yes. PhilCares shall reimburse 100% of actual cost based on Philcare rates for the first 24 hours but net of co-pay amounts:</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>For In Patient Php 2,000 upon discharge</li>\r\n	<li>For Out Patient: Clinics Php 100; Hospitals Php 300</li>\r\n	<li>Non-accredited hospitals at Php 300</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Is there a way in which I can check if my doctor or provider is already accredited with Philcare?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. There are several ways in which you can check:</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>You may call our dedicated transition hot line (02) 802-7350 to ask. Note that the hot line will be available from Monday to Friday, 9:00 AM to 5:00 PM only.</li>\r\n	<li>You may also email Philcare at <a href="mailto:customercare@philcare.com.ph">customercare@philcare.com.ph</a> or <a href="mailto:ellen.sulapas@philcare.com.ph">ellen.sulapas@philcare.com.ph</a>. Philcare respond to member&rsquo;s email within 24 hours or on the next business day.</li>\r\n	<li>You may check also the Go! Mobile App, free downloadable application on Google Play and Apple Store. Go! Mobile has a find a provider functionality in which the members can check if a certain provider (Hospital and Clinic) is already accredited.</li>\r\n	<li>You may also check <a href="https://apps.philcare.com.ph/teletech/">https://apps.philcare.com.ph/teletech/</a> and click on Accredited Network</li>\r\n	<li>You may check mybenefits.teletech.com</li>\r\n</ul>\r\n\r\n<p style="margin-left:.75in">&nbsp;</p>\r\n\r\n<ol>\r\n	<li>How can I know if my accreditation request is already processed or approved?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Status can be asked thru the dedicated number and email addresses above.</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<ol>\r\n	<li>My personal doctor doesn&rsquo;t want to be accredited with Philcare, how can we go about it?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>As much as Philcare wanted to accredit every provider being requested by clients, the concurrence of the doctor will be very important. Philcare will provide list of accredited physicians or specialist that the member could check or be transferred.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Are major hospitals accredited by Philcare? Our current benefit design allows us to have access on The Medical City, Makati Medical Center, St. Luke&rsquo;s Quezon City etc.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Top Hospitals are Philcare accredited and was retained under the 2016 benefit design. Kindly note though that access to Asian Hospital &amp; Medical Center, St. Luke&rsquo;s Global City &amp; Healthway Clinics are not allowed.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Co-Pay Process:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1.&nbsp;&nbsp; Do we still have co-payment with Philcare?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Co-payment for Out-Patient, In-Patient and Emergency availment is still present. Below fixed amount will still be observed:</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Out-patient in Accredited Clinic: Php100.00</li>\r\n	<li>Out-patient in Accredited Hospital: Php300.00</li>\r\n	<li>In-patient: Php2,000 (payment upon discharge)</li>\r\n	<li>Emergency: Php300.00</li>\r\n</ul>\r\n\r\n<p style="margin-left:1.0in">&nbsp;</p>\r\n\r\n<p style="margin-left:.25in">2. With the previous provider, we were given list of accredited clinics wherein co-payment in&nbsp;&nbsp;&nbsp;&nbsp; consultation won&rsquo;t be applied; do we have the same with Philcare?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Philcare will be retaining the same list of providers with no co-payment. There will be additional clinics with no co-payment that Philcare was able to provide for Teletech.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3.&nbsp;&nbsp; What about owned clinics? Will there be no co-payment also?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Philcare Owned clinics will not be billing the members with co-payment, access to these owned clinics will be free and unlimited. You may refer to Philcare&rsquo;s member guide for the complete list.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>4.&nbsp;&nbsp; How will Philcare bill Teletech for the co-payment?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Philcare will be basing it thru the tapped transactions generated by our NFC cards, within the allowed cut-off, Philcare will be sending HR with the list of transactions and applicable co-payment (which will be used by HCS for salary deduction).</li>\r\n	<li>For members to have knowledge of their co-pay deductibles, Philcare will simultaneously send a SMS message and email each time a LOA is created. Note that cellphone # and email address will be emailed by Teletech to Philcare (to assure validity).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>5.&nbsp;&nbsp; What is tapped transaction? What is NFC card?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>NFC stands for Near Field Communication, all Philcare cards were now based under this technology. The NFC allows the provider to check the basic info and benefits of a member by just tapping the card to any NFC enabled device. The existence of basic info and benefits allows the provider already to issue Letter of Authorization (LOA) to the member. The LOA issuance will be the basis of Philcare for billing Teletech per each cut-off.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>6.&nbsp;&nbsp; What is LOA? How do I obtain it?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>The LOA stands for &ldquo;Letter of Authorization&rdquo; &ndash; This document certifies that specific lab/ancillaries/procedures/PF requested by an affiliated provider is covered by PhilCare. LOA is the proof that PhilCare will cover and pay for the said requested procedure/consult to a specialist.</li>\r\n	<li>LOA may be obtained from the LOA issuers/Medical Coordinators deployed per affiliated provider</li>\r\n	<li>This is a standard process across all HMOs</li>\r\n	<li>Validity of LOA is up to 3 days</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">7.&nbsp;&nbsp; I was issued a LOA but the availment did not push thru, will there still be a deduction on my salary for the co-pay amount?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>The tapping of your Philcare NFC card will enable the generation of the LOA. Once a LOA was generated, you&rsquo;ll receive a text and email message from Philcare which includes your availment info, co-pay amount and the hot line number to call for cancellation of LOA. Once a LOA is cancelled, the member will no longer be billed by Philcare for the applicable co-payment. In the event that within 90 days (Metro Manila) and 120 days (Provincial) the provider billed Philcare and was proven that the member indeed availed of the services he/she asked to cancel, the member then will be asked to pay the co-pay amount.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>8. &nbsp;&nbsp;&nbsp;How many times will I need to pay for co-pay in a given day?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>It depends. Please refer to the illustration below for guidance:</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Same day + Same provider + 1 or more availment = 1 co-payment</li>\r\n	<li>Same day + 2 providers + separate availment = 2 co-payment</li>\r\n	<li>Same day + 3 providers + separate availment = 3 co-payment</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; My LOA states that the validity period is 3 days, I wasn&rsquo;t able to do the consultation on the 1<sup>st</sup> day of LOA validity, do I still need to pay for the co-pay if I pursue availment on the next day?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>No. As the LOA is valid for the 3 days, the co-pay will only be applied on the day the LOA was issued.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">10.&nbsp;&nbsp;&nbsp;&nbsp; I heard that out-patient co-pay (Php300.00) for The Medical City (TMC) and Makati Medical Center (MMC) will be paid in cash, is this true?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Only for these two providers. LOA generation for TMC and MMC will be done thru Philcare&rsquo;s Quick Assist Center, the Quick Assist Representative will be taking the Php300.00 payment from the member and issue a corresponding Official Receipt (OR) after.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">11.&nbsp;&nbsp;&nbsp;&nbsp; My doctor asked me to undergo a diagnostic examination after our consultation, will I be charged again with co-pay as another LOA will be issued?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>It depends. If the diagnostic examination LOA will be issued by the same provider within the same day the consultation LOA was issued, member need not pay again. In the event that the member will be getting the LOA on another day, the applicable co-pay then will be applied.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">12.&nbsp;&nbsp;&nbsp;&nbsp; What will happen if the actual consultation fee is less than the co-pay amount?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>The provision on co-pay states that member has to pay the fixed co-pay amount or the actual cost, in this event, the actual cost will take part as the member&rsquo;s co-payment.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">13.&nbsp;&nbsp;&nbsp;&nbsp; What should I do if I want to cancel my LOA in The Medical City (TMC) and Makati Medical Center (MMC)?</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Member has to return within the day the Official Receipt (OR) given by Quick Assist Center Representative in TMC and MMC in exchange of Php300 co-pay outright payment.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Availment Process:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1.&nbsp;&nbsp;&nbsp; What is Medical Benefit Limit (MBL)?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>MBL is your maximum limit per illness or injury per member per year.</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>E.g. member was confined in February due to asthma, the applicable coverage will be up to MBL as pre-existing conditions are covered up to such for Teletech members. Come April the member was hospitalized again due to dengue, as asthma and dengue are not correlated diseases, the coverage for dengue will be up to MBL also.</li>\r\n</ul>\r\n\r\n<p style="margin-left:1.0in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Kindly note that Philcare will be basing the coverage on the final diagnosis of the doctor, it is important for every member to be vigilant on checking with the doctors the posting of the final diagnosis so as to be sure with the coverage.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>2.&nbsp;&nbsp;&nbsp; How can we avail of our benefits under PhilCare if we lost our ID cards?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>We highly suggest that you save your certificate number to ensure that you could provide this together with a valid ID for availment in lieu of the PhilCare card.</li>\r\n	<li>Please contact our PhilCare Customer Service Hotline +63(2)4621800 for assistance and endorsement.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3.&nbsp;&nbsp; Is PhilHealth integraded with the plan?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. This means that the members should file Philhealth for all their claims. Failure to do so will result in the member having to pay for the PhilHealth portion of the bill prior to discharge. Employees who paid the PhilHealth surcharge for their parents need not file PhilHealth documents.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>4.&nbsp;&nbsp; What is Medical Collectible?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>These are the amounts that we collect from the client/member which will not be shouldered by PhilCare. Note that members will be aware of their medical collectibles as Philcare Liaison Officers will give members a note as to the amount of their excess charges.</li>\r\n	<li>Liaison Officers (LO) are Philcare representatives assisting members who are currently confined, LOs will provide clarity in terms of Room &amp; Board, MBL and coverable items.</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<p>5.&nbsp;&nbsp;&nbsp; What are the Incremental/Express Charges?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Excess charges maybe applicable for those non coverable items. Incremental Charges is an additional financial resources if beyond the cost of usual care.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>6.&nbsp;&nbsp;&nbsp; Where can I secure Medical Certificate?</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Member employees can secure the medical certificate thru the Retainer Physician assigned at the site clinics. However, kindly take note that these Retainer Physicians will only issue out medical certificate for those who are seen by them. An employee who is seen outside the clinic and would be needing any medical certificates will not be covered under the program.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">7.&nbsp;&nbsp;&nbsp; What if I want to stay in a more expensive room, and am willing to pay for the accommodation, May I&nbsp; do so?<br />\r\n&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes, However, keep in mind that staying in a more expensive room also makes the other services (i.e., medicines, Professional fees, etc.) more expensive. The member will be charged for the excess over the entitlement provided in his plan and he/she should pay these charges upon discharge. (Approximately 30% of the total bill shall be charged to the patient, this includes excess room and board charges and doctor&rsquo;s fee).</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style="margin-left:22.5pt">&nbsp;&nbsp;&nbsp;&nbsp; 8.&nbsp;&nbsp;&nbsp; Is it true that EENT, Neurologists and Urologists issued a memorandum to all HMOs stating that they will charge extra Professional Fees?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes, and to avoid this, please coordinate with our Call Center before each availment in order for them to make arrangments with doctor who does not charge extra fees.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>What if, during the time of admission, all the rooms under my room category are occupied- what will I do?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>For Emergency Cases, PhilCare will waive the first 24 hours (except suite room) for the employees and dependents.</li>\r\n	<li>After the allowed waived hours, member has 3 options (for ER cases):</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>Member may opt to downgrade and maximize its limit</li>\r\n	<li>Member may transfer to a nearby affiliated provider with an available Room &amp; Board</li>\r\n	<li>Member may opt to stay in the upgraded Room and pay</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>For Elective/Scheduled confinements, this shall be shouldered by the provider</li>\r\n</ul>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<p><strong>&nbsp; Reimbursement Process:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>How long will it take to get my reimbursement?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>PhilCare&rsquo;s standard TAT (turn-around-time) for processing of check reimbursement is within 15-30 working days from the date that PhilCare receives the complete documents (duly accomplished reimbursement forms, OR, etc.)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Is it true that for Philcare a scanned or picture copy of the reimbursement form and required documents can be submitted first for evaluation prior to actual submission of original documents?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. To save time and to assure that members are aware already for the reimbursement status, a scanned or picture copy of the required documents can be emailed by the member to Phicare.</li>\r\n	<li>If the submitted documents passed the screening of Philcare&rsquo;s Claims Team, the member then will be asked to submit the original copy of documents.</li>\r\n	<li>The 15-30 days TAT will kick-in upon submission of the original documents</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>How will I be informed if my reimbursement request is approved or not? How many days will it take for Philcare to inform me?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Philcare Claims Team will email the member on the status of the reimbursement. The member has to be informed of the initial findings within 2-3 working days upon submission of scanned or picture copy of documents.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>What are the documents needed in availing reimbursement?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>The following are the required documents that must be submitted to PhilCare&rsquo;s Head Office within 30 calendar days from date of discharge from the hospital:</li>\r\n</ul>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Duly accomplished Claim Reimbursement Form</li>\r\n	<li>Original Official Receipts of all Hospital Bills</li>\r\n	<li>Original Receipts of the Professional Fees of the doctor</li>\r\n	<li>Statement of Account from where member was confined or treated</li>\r\n	<li>Original Individual Charge Slips or Itemized breakdown of charges to support the Statement of Account&nbsp;</li>\r\n	<li>For Inpatient Claims, Admitting History Report (to be obtained from the Medical Records Section of the hospital where patient was confined) Clinical Abstract, Admitting History and Medical Certificate.</li>\r\n	<li>Histopath/Surgical Report (if surgical operation was done)</li>\r\n	<li>Police Report in case of accident and medico legal cases.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Can I submit a certified true copy document?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>No. As much as Philcare wanted to grant every reimbursement request of members as possibly, only those who submit complete and correct documents can be processed. One of the basic requirement of Philcare is submission of original copy of documents.&nbsp;</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Will Philcare allow me to follow up the status of my reimbursement?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Member can email <a href="mailto:teletechclaims@philcare.com.ph">teletechclaims@philcare.com.ph</a> or <a href="mailto:ellen.sulapas@philcare.com.ph">ellen.sulapas@philcare.com.ph</a> for updates.</li>\r\n	<li>Philcare team will respond to member&rsquo;s query within 48 hours upon receipt of it.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Benefit Design:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>I wasn&rsquo;t able to attend the road show of Philcare, is there a way in which I can check my benefits?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. You may check <a href="https://apps.philcare.com.ph/teletech/">https://apps.philcare.com.ph/teletech/</a> &nbsp;as Philcare will upload an orientation video copy and booklet for reference.</li>\r\n	<li>You may also call (02) 802-7350 to ask or</li>\r\n	<li>Email the following Account Management personnel:</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Ellen Sulapas - <a href="mailto:ellen.sulapas@philcare.com.ph">ellen.sulapas@philcare.com.ph</a></li>\r\n	<li>Paul Flores &ndash; <a href="mailto:paul.flores@philcare.com.ph">paul.flores@philcare.com.ph</a></li>\r\n	<li>Lea Mendoza &ndash; <a href="mailto:lea.mendoza@philcare.com.ph">lea.mendoza@philcare.com.ph</a></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>Is there a significant change on our benefits for 2016?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Philcare enhanced the current benefit design of Teletech. Enhancement will be as follows:</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Pre-Existing condition coverage up to MBL for Rank and File</li>\r\n	<li>Waiver of hierarchy for dependents</li>\r\n	<li>Inclusion of Maternity Assistance coverage up to 10,000 for female employees and spouses of Male employees</li>\r\n	<li>Inclusion of married employees&rsquo; dependents under the voluntary program</li>\r\n	<li>Premium of dependents at a lower cost</li>\r\n	<li>Higher daily cap limits on Non-Tenured employees&rsquo; Room &amp; Board accommodation</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>For the dental coverage, will Philcare give us a list of their accredited dental providers?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. The dental provider of Teletech is Dental Network, a list will be provided to guide the members.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol style="list-style-type:lower-alpha">\r\n	<li>&nbsp;&nbsp;&nbsp;&nbsp;Are pre-existing conditions also covered for dependents?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Dependents are entitled to a pre-ex coverage up to MBL also.</li>\r\n</ul>\r\n\r\n<p style="margin-left:.75in">&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Is it possible to enhance my current benefits and pay Philcare directly (no intervention from Teletech)?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>No. Our program requires that enhancement should be done across the board. A member will not be allowed to enhance his/her own benefits as he/she deems fit. Philcare will only discuss benefit enhancement with Teletech&rsquo;s HCS team.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>There are some benefits that my dependents weren&rsquo;t able to use, can that be excluded? Will exclusion merit a lowered dependent rate?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>No. Our program requires that downgrade should be done across the board. A member will not be allowed to downgrade the benefits as he/she deems fit.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ID Replacement Process:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I accidentally lost my Philcare card, to whom can I request replacement and how much?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>For ID cards replacement, please access https://apps.philcare.com.ph/teletech/ and make an online request thru the feedback/request portion.</li>\r\n	<li>Once submitted, you may ask follow up from the following Philcare personnel:</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Ellen Sulapas - <a href="mailto:ellen.sulapas@philcare.com.ph">ellen.sulapas@philcare.com.ph</a></li>\r\n	<li>Paul Flores &ndash; <a href="mailto:paul.flores@philcare.com.ph">paul.flores@philcare.com.ph</a></li>\r\n	<li>Lea Mendoza &ndash; <a href="mailto:lea.mendoza@philcare.com.ph">lea.mendoza@philcare.com.ph</a></li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Kindly take note that replacement fee is Php168.00</li>\r\n	<li>A copy of the deposit slip for the payment of Php168.00 has to be attached on the replacement request. Only those with valid deposit slips will be accommodated.</li>\r\n	<li>Philcare will provide its bank details to HCS Team for reference.</li>\r\n	<li>Over all, process for ID replacement will be the following:</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Member to personally email request card replacement thru the request tab of Philcare-Teletech microsite - <a href="https://apps.philcare.com.ph/teletech/">https://apps.philcare.com.ph/teletech/</a></li>\r\n	<li>Member to attach copy of deposit slip in the request</li>\r\n	<li>Once received, Philcare will process request and contacts the member for feedback.</li>\r\n	<li>Philcare&rsquo;s feedback will be coursed thru the microsite</li>\r\n	<li>Philcare to release the ID cards to member&rsquo;s confirmed delivery address</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Merchant Partners:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1.&nbsp;&nbsp;&nbsp; I heard that Philcare has merchant partners, can Teletech members avail of the perks and discounts?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. You may call (02) 802-7350 and look for Ellen Sulapas to know of the perks and list of merchant providers.</li>\r\n	<li>You may also email the following Account Management personnel:</li>\r\n</ul>\r\n\r\n<ul style="list-style-type:circle">\r\n	<li>Ellen Sulapas - <a href="mailto:ellen.sulapas@philcare.com.ph">ellen.sulapas@philcare.com.ph</a></li>\r\n	<li>Paul Flores &ndash; <a href="mailto:paul.flores@philcare.com.ph">paul.flores@philcare.com.ph</a></li>\r\n	<li>Lea Mendoza &ndash; <a href="mailto:lea.mendoza@philcare.com.ph">lea.mendoza@philcare.com.ph</a></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Servicing:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1.&nbsp;&nbsp;&nbsp; Am I allowed to give my honest feedback on Philcare&rsquo;s service?</p>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Philcare would appreciate receiving comments/feedback that would help on making our servicing better. Our Teletech microsite - <a href="https://apps.philcare.com.ph/teletech/">https://apps.philcare.com.ph/teletech/</a>&nbsp; has feedback/comments functionality, your feedback will be handled by our Customer Experience Team.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Dependent Enrolment:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I have 4 qualified dependents, my spouse and my 3 children. Will Philcare allow their enrolment even if Teletech will only have share up to my 3<sup>rd</sup> dependent?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. As agreed with Teletech, enrollment of 4<sup>th</sup> dependent is still allowed but premium will be shouldered by the member. Note that shouldered premium will be 100% of total monthly rate.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I&rsquo;m married and I want to enroll my parents, will I be allowed?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Your parents can be enrolled under the Voluntary Program. Kindly note that the age eligibility of parents should not be more than 65 years old and payment will be shouldered by the member in full.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I&rsquo;m single and I want to enroll my siblings, will that be allowed?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Under the HMO program, you may enroll your siblings who are less than 22 years old and unmarried</li>\r\n	<li>If your siblings are already more than 22 but less than 25 years old, you may enroll them under the voluntary program. Kindly take note that payment will be shouldered by the member in full.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>Under the voluntary program, how much will the monthly rate be?</li>\r\n</ol>\r\n\r\n<p style="margin-left:.25in">&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Monthly rate per member will be Php542.00</li>\r\n</ul>\r\n\r\n<p style="margin-left:.75in">&nbsp;</p>\r\n\r\n<ol>\r\n	<li>&nbsp;&nbsp;&nbsp;&nbsp;I&rsquo;m separated and wishes not to include my spouse on dependent enrolment, what documents will Philcare require me to submit?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Part of the enhancement we offered for 2016 is the waiver of hierarchy enrolment, Teletech employees need not to follow the hierarchy requirement that spouses has to be enrolled first before coverage to children can kick-in. As such is already waived, member need not submit any document regarding separation to exclude the spouse on enrollment.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I have an adopted child but the adoption papers are still on the works, will Philcare allow me to enroll my child pending final confirmation of the Court?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Philcare will require the member to submit a copy of the petition to adopt as basis for enrolment.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>I have an illegitimate child; will Philcare allow me to enroll him/her (male employee)?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Yes. Provided in the birth certificate of the child, you acknowledged your paternal relationship.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>My dependent will turn over-age within the contract period, will Philcare terminate his/her coverage on his/her birthday?</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li>No. As a policy, Philcare will continue providing coverage up to the account&rsquo;s contract expiration &ndash; December 31, 2016.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<p style="margin-left:.5in">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '<p>Congratulations on your journey to wellness!</p>\r\n\r\n<p>The PhilCare Teletech Member Portal is your gateway to the perks of being a PhilCare member. Access and make changes to your account, schedule clinic appointments, download availment documents and many more.</p>\r\n', '<p>Lorem ipsum dolor eset it. Duis eget luctus mit. Class apent tecti ad litora torqent per conuba nostra.</p>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portal_messages`
--

CREATE TABLE `portal_messages` (
  `msg_id` int(11) NOT NULL,
  `sender` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `messages` longtext COLLATE utf8_bin,
  `is_deleted` int(2) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_messages`
--

INSERT INTO `portal_messages` (`msg_id`, `sender`, `subject`, `messages`, `is_deleted`, `deleted_by`, `date_created`) VALUES
(1, NULL, 'This is a test', '<p><img alt="" src="http://www.philcare.com.ph/wp-content/uploads/2014/11/01meningcoccal-disease3.jpg" style="height:326px; width:500px" /></p>\r\n\r\n<p><span style="color:rgb(116, 116, 116); font-family:arial,helvetica,sans-serif; font-size:12px">We believe that total health means acheiving a complete harmony of mind and body. It&rsquo;s achieving a state where you can enjoy life to the fullest. If you think this is the kind of health care that you deserve, hook up with us. Together, let&rsquo;s make health happen.</span></p>\r\n', 0, NULL, '2014-12-08 09:13:37'),
(2, NULL, 'test 2015', '<p>asdjaskdjasjkd askdjaksjdas aksjdkajsda akdkajsda kasdkjas</p>\r\n', 0, NULL, '2015-01-29 00:36:07'),
(3, NULL, 'Test', '<p>asadsd</p>\r\n', 0, NULL, '2015-12-23 09:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `portal_messages_receiver`
--

CREATE TABLE `portal_messages_receiver` (
  `rcv_msg_id` int(11) NOT NULL,
  `msg_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `read_status` int(2) DEFAULT '0' COMMENT '1=read, 0=unread',
  `is_deleted` int(2) DEFAULT '0' COMMENT '1=deleted, 0=active',
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_messages_receiver`
--

INSERT INTO `portal_messages_receiver` (`rcv_msg_id`, `msg_id`, `receiver_id`, `read_status`, `is_deleted`, `deleted_by`, `date_deleted`) VALUES
(2, 1, 2, 1, 0, NULL, NULL),
(3, 2, 2, 1, 0, NULL, NULL),
(4, 2, 13, 1, 0, NULL, NULL),
(5, 3, 2, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portal_news`
--

CREATE TABLE `portal_news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `is_video` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portal_news`
--

INSERT INTO `portal_news` (`news_id`, `title`, `description`, `is_video`, `status`, `created`) VALUES
(1, 'Test1', '<p>This is test no. 1</p>\r\n', 0, 1, '2015-12-23 08:09:19'),
(2, 'Test 2', '<p><strong><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans; font-size:11px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="color:#FF8C00"><span style="font-family:arial,helvetica,sans; font-size:11px">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</span></span></p>\r\n', 0, 1, '2015-12-23 08:22:23'),
(4, 'www.youtube.com/embed/ePbKGoIGAXY', '', 1, 1, '2015-12-28 06:53:48'),
(5, 'Test3', '<p>This is test23</p>\r\n', 0, 1, '2015-12-28 07:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `portal_pages`
--

CREATE TABLE `portal_pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `page_parent` int(2) DEFAULT NULL,
  `has_sub` int(2) DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `active_stat` int(2) DEFAULT '1',
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_pages`
--

INSERT INTO `portal_pages` (`page_id`, `page_name`, `page_parent`, `has_sub`, `page_url`, `active_stat`, `date_created`) VALUES
(1, 'Newsfeed', 0, 0, 'home', 1, NULL),
(2, 'Member Information', 0, 0, 'account', 1, NULL),
(3, 'Messages', 0, 0, 'messages', 0, NULL),
(4, 'My Health', 0, 1, 'health', 0, NULL),
(5, 'Providers', 0, 1, 'providers', 0, NULL),
(6, 'Calendar', 0, 1, 'calendar', 0, NULL),
(7, 'Wellness Buddies', 0, 0, 'wellness', 0, NULL),
(8, 'Rewards', 0, 0, 'rewards', 0, NULL),
(9, 'Customer Service', 0, 1, 'cservice', 0, NULL),
(10, 'FAQ', 0, 0, 'faq', 0, NULL),
(11, 'My Profile', 0, 2, 'account', 1, NULL),
(12, 'My Medical Information', 0, 2, 'account/mmi', 1, NULL),
(13, 'My Availment Record', 0, 2, 'account/mar', 1, NULL),
(14, 'My Benefits', 0, 2, 'account/benefits', 1, NULL),
(15, 'Health Risk Assessment', 0, 4, 'health', 1, NULL),
(16, 'BMI and Calorie Calculator', 0, 4, 'health/bmi', 1, NULL),
(17, 'Events', 0, 6, 'calendar', 0, NULL),
(18, 'Scheduled Appointment', 0, 6, 'calendar/sched', 1, NULL),
(19, 'Downloadable Forms', 0, 9, 'cservice', 1, NULL),
(20, 'Letter of Authorization Request', 0, 9, 'cservice/lar', 0, NULL),
(21, 'Temporary Membership Card', 0, 9, 'cservice/card', 0, NULL),
(22, 'Feedback', 0, 9, 'cservice/feedback', 1, NULL),
(23, 'Replacement of Cards', 0, 9, 'cservice/replacement', 0, NULL),
(24, 'Dashboard', 1, 0, 'admin', 1, NULL),
(25, 'Messages', 1, 1, NULL, 1, NULL),
(26, 'Customer Service', 1, 1, NULL, 1, NULL),
(27, 'Information', 1, 1, NULL, 1, NULL),
(28, 'Inbox', 0, 25, NULL, 0, NULL),
(29, 'Sent', 0, 25, 'messages/sent', 1, NULL),
(30, 'Create Message', 0, 25, 'messages/create', 1, NULL),
(31, 'Downloadable Forms', 0, 26, 'admin/dlforms', 1, NULL),
(32, 'FAQ', 0, 27, 'admin/faq', 1, NULL),
(33, 'Terms and Condition', 0, 27, 'admin/terms', 1, NULL),
(34, 'Privacy', 0, 27, 'admin/privacy', 1, NULL),
(35, 'My Provider', 0, 5, 'providers', 1, NULL),
(36, 'Find A Provider', 0, 0, 'providers/findp', 1, NULL),
(37, 'Feedbacks', 0, 26, 'admin/fbslist', 1, NULL),
(38, 'Others', 1, 1, NULL, 1, NULL),
(39, 'Login Descripton Content', 0, 38, 'admin/logdesc', 1, NULL),
(40, 'Reg Description Content', 0, 38, 'admin/regdesc', 1, NULL),
(41, 'Calendar', 1, 1, NULL, 1, NULL),
(42, 'Create Events', 0, 41, 'calendar/admincreateevents', 1, NULL),
(43, 'Event List', 0, 41, 'calendar/adminceventslist', 1, NULL),
(44, 'Add CS Recepient', 0, 26, 'admin/addrecep', 1, NULL),
(45, 'CS List', 0, 26, 'admin/viewallrec', 1, NULL),
(46, 'LOA History', 0, 0, 'loa', 1, NULL),
(47, 'Reimbursement', 0, 0, '#', 1, NULL),
(48, 'Service', 0, 0, '#', 1, NULL),
(49, 'Newsfeed', 1, 1, NULL, 1, NULL),
(50, 'Create Newsfeed', 0, 49, 'news/create_news', 1, NULL),
(51, 'List Newsfeed', 0, 49, 'news/', 1, NULL),
(52, 'Add Video Link', 0, 49, 'news/video_add', 1, NULL),
(53, 'Member Feedback', 0, 0, '#', 1, NULL),
(54, 'FAQ', 0, 0, 'faq', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portal_users`
--

CREATE TABLE `portal_users` (
  `user_id` int(11) NOT NULL,
  `certNo` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `fname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `lname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `user_level` int(11) UNSIGNED DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `is_activated` int(2) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `dateVerified` datetime DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `login_attempt` int(2) DEFAULT '0',
  `login_attempt_date` datetime DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `prepaid_access` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portal_users`
--

INSERT INTO `portal_users` (`user_id`, `certNo`, `email`, `username`, `password`, `fname`, `lname`, `user_level`, `bdate`, `is_activated`, `date_created`, `dateVerified`, `image`, `login_attempt`, `login_attempt_date`, `login_date`, `logout_date`, `prepaid_access`) VALUES
(1, '0', 'philadmin@gmail.com', 'philadmin', 'MTIzNDU21baaf03b9b4e7bff9869edad33dc803d', 'Admin', 'Phil', 1, '1989-09-29', 1, '2014-11-27 23:10:00', NULL, '1422289013.jpg', 4, '2015-05-04 01:01:08', NULL, NULL, NULL),
(3, '5443460', 'honeynatividad2@gmail.com', 'honeynatividad2@gmail.com', 'MTIzNDU21baaf03b9b4e7bff9869edad33dc803d', 'ALEX', 'PANGANIBAN', 3, '1970-02-16', 1, '2015-12-23 10:12:04', '2015-12-23 00:00:00', NULL, 0, NULL, NULL, NULL, 6),
(4, '6948060', 'honeynatividad@gmail.com', 'honeynatividad@gmail.com', 'MTIzNDU21baaf03b9b4e7bff9869edad33dc803d', 'SALVE REGINA', 'LUBIANO', 3, '1984-10-15', 1, '2015-12-29 10:12:23', '2015-12-29 00:00:00', NULL, 0, NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `portal_users_details`
--

CREATE TABLE `portal_users_details` (
  `details_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `firstname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `middlename` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `house_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `barangay` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `home_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `province` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `civil_stat` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `certno` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `cotact_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `agreement_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `agreement_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `benifit_limit` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_registered` datetime DEFAULT NULL,
  `date_verified` datetime DEFAULT NULL,
  `dental` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `hospitals` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `member_type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `package_desc` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `philhealth` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `plan_type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `policy_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `pre_ex` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `riders` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `room_desc` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `room_rate` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `subdivision` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `portal_users_other_info`
--

CREATE TABLE `portal_users_other_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `company_address` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `work_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `designation` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `portal_videos`
--

CREATE TABLE `portal_videos` (
  `video_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `file_name` varchar(128) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prepaid_access`
--

CREATE TABLE `prepaid_access` (
  `pa_id` int(11) NOT NULL,
  `prepaid_name` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prepaid_access`
--

INSERT INTO `prepaid_access` (`pa_id`, `prepaid_name`) VALUES
(1, 'ER'),
(2, 'IN'),
(3, 'GROUP'),
(4, 'SMART CHECKUP');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Abra'),
(2, 'Agusan del Norte'),
(3, 'Agusan del Sur'),
(4, 'Aklan'),
(5, 'Albay'),
(6, 'Antique'),
(7, 'Apayao'),
(8, 'Aurora'),
(9, 'Basilan'),
(10, 'Bataan'),
(11, 'Batanes'),
(12, 'Batangas'),
(13, 'Benguet'),
(14, 'Biliran'),
(15, 'Bohol'),
(16, 'Bukidnon'),
(17, 'Bulacan'),
(18, 'Cagayan'),
(19, 'Camarines Norte'),
(20, 'Camarines Sur'),
(21, 'Camiguin'),
(22, 'Capiz'),
(23, 'Catanduanes'),
(24, 'Cavite'),
(25, 'Cebu'),
(26, 'Compostela Valley'),
(27, 'Cotabato'),
(28, 'Davao del Norte'),
(29, 'Davao del Sur'),
(30, 'Davao Oriental'),
(31, 'Eastern Samar'),
(32, 'Guimaras'),
(33, 'Ifugao'),
(34, 'Ilocos Norte'),
(35, 'Ilocos Sur'),
(36, 'Iloilo'),
(37, 'Isabela'),
(38, 'Kalinga'),
(39, 'La Union'),
(40, 'Laguna'),
(41, 'Lanao del Norte'),
(42, 'Lanao del Sur'),
(43, 'Leyte'),
(44, 'Maguindanao'),
(45, 'Marinduque'),
(46, 'Masbate'),
(47, 'Metro Manila'),
(48, 'Misamis Occidental'),
(49, 'Misamis Oriental'),
(50, 'Mountain Province'),
(51, 'Negros Occidental'),
(52, 'Negros Oriental'),
(53, 'Northern Samar'),
(54, 'Nueva Ecija'),
(55, 'Nueva Vizcaya'),
(56, 'Occidental Mindoro'),
(57, 'Oriental Mindoro'),
(58, 'Palawan'),
(59, 'Pampanga'),
(60, 'Pangasinan'),
(61, 'Quezon'),
(62, 'Quirino'),
(63, 'Rizal'),
(64, 'Romblon'),
(65, 'Samar'),
(66, 'Sarangani'),
(67, 'Siquijor'),
(68, 'Sorsogon'),
(69, 'South Cotabato'),
(70, 'Southern Leyte'),
(71, 'Sultan Kudarat'),
(72, 'Sulu'),
(73, 'Surigao del Norte'),
(74, 'Surigao del Sur'),
(75, 'Tarlac'),
(76, 'Tawi-Tawi'),
(77, 'Zambales'),
(78, 'Zamboanga del Norte'),
(79, 'Zamboanga del Sur'),
(80, 'Zamboanga Sibugay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_calendar`
--
ALTER TABLE `event_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_department`
--
ALTER TABLE `portal_department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `portal_dep_emails`
--
ALTER TABLE `portal_dep_emails`
  ADD PRIMARY KEY (`dep_email_id`);

--
-- Indexes for table `portal_dl_forms`
--
ALTER TABLE `portal_dl_forms`
  ADD PRIMARY KEY (`dl_id`);

--
-- Indexes for table `portal_fav_provider`
--
ALTER TABLE `portal_fav_provider`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `portal_feedbacks`
--
ALTER TABLE `portal_feedbacks`
  ADD PRIMARY KEY (`fbs_id`);

--
-- Indexes for table `portal_informations`
--
ALTER TABLE `portal_informations`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `portal_messages`
--
ALTER TABLE `portal_messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `portal_messages_receiver`
--
ALTER TABLE `portal_messages_receiver`
  ADD PRIMARY KEY (`rcv_msg_id`);

--
-- Indexes for table `portal_news`
--
ALTER TABLE `portal_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `portal_pages`
--
ALTER TABLE `portal_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `portal_users`
--
ALTER TABLE `portal_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `portal_users_details`
--
ALTER TABLE `portal_users_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `portal_users_other_info`
--
ALTER TABLE `portal_users_other_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_videos`
--
ALTER TABLE `portal_videos`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `prepaid_access`
--
ALTER TABLE `prepaid_access`
  ADD PRIMARY KEY (`pa_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1637;
--
-- AUTO_INCREMENT for table `event_calendar`
--
ALTER TABLE `event_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `portal_department`
--
ALTER TABLE `portal_department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `portal_dep_emails`
--
ALTER TABLE `portal_dep_emails`
  MODIFY `dep_email_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portal_dl_forms`
--
ALTER TABLE `portal_dl_forms`
  MODIFY `dl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `portal_fav_provider`
--
ALTER TABLE `portal_fav_provider`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portal_feedbacks`
--
ALTER TABLE `portal_feedbacks`
  MODIFY `fbs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `portal_informations`
--
ALTER TABLE `portal_informations`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `portal_messages`
--
ALTER TABLE `portal_messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `portal_messages_receiver`
--
ALTER TABLE `portal_messages_receiver`
  MODIFY `rcv_msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `portal_news`
--
ALTER TABLE `portal_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `portal_pages`
--
ALTER TABLE `portal_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `portal_users`
--
ALTER TABLE `portal_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `portal_users_details`
--
ALTER TABLE `portal_users_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portal_users_other_info`
--
ALTER TABLE `portal_users_other_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portal_videos`
--
ALTER TABLE `portal_videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prepaid_access`
--
ALTER TABLE `prepaid_access`
  MODIFY `pa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
