-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2022 a las 18:42:33
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `about_title` varchar(255) DEFAULT NULL,
  `about_sub_title` varchar(255) DEFAULT NULL,
  `about_text` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abouts`
--

INSERT INTO `abouts` (`id`, `url_string`, `about_title`, `about_sub_title`, `about_text`, `picture`) VALUES
(1, 'our-story', 'Our Story', '', 'Serquis and Associates is an award-winning Landscape Architecture firm with over 20 years of experience creating designs that combine beauty and human comfort, resulting in a true sense of place. In collaboration with our clients and multi-disciplinary teams, each project is a unique creation influenced by site and environment, an enriching process that concludes with a landscape connecting people to places.', 'space-019.jpeg'),
(2, 'design-philosophy', 'Design Philosophy', '', 'Successful designs should engage the environment, have fluency among history, land forms and architecture, express rhythm with textures and interest among the seasons. We believe there is a close connection between balancing human needs and preserving what nature has given us to enjoy, and that beautiful surroundings nourish the human spirit. We are passionate about communities, whether they be rural or urban settings. We truly understand the social impact where clear landscape design helps connection between community and peoples, where they relate to and learn from the natural and built environment. We create multi-disciplinary teams, including the client, catering to each and every project to form think tanks that inspire ideas that are most appropriate to the site and users.', 'IMG_1390.jpeg'),
(3, 'solange-serquis', 'Solange Serquis', 'Landscape Architect, Firm Owner, and Lead Designer', 'Landscape Architect, Firm Owner, and Lead Designer Solange studied at the University of Buenos Aires completing a program inclusive of architecture, agricultural science and landscape architecture, with a final thesis in “Healing Gardens”. Solange will provide landscape architecture services as the primary local landscape architect. Solange’s design background focuses on integrating process-design with the ecological concepts and educational opportunities for master planning and landscape design. She has worked in both private, public and non-profit organization design environments on community, educational, and agricultural projects. Solange is the principal of Serquis + Associates as well as a very active participant in the community. With Spanish as her first language and English her second, Solange works passionately assisting numerous social-kids-educational-friendly events where she merges her knowledge and activism for educational landscapes and the relationship between indoor-outdoor spaces with her desire to help the young.', 'Solange-Serquis-1200-72.jpg'),
(5, 'our-home-the-trailhead', 'Our Home: The Trailhead', '', 'Our office is located here, a place that inspires us every day. A building within a landscape. The Trailhead is a hub for Santa Fe\'s stopover, work, and play lifestyle; bringing heart-centered connection to every facet of your life. Located at the edge of downtown, The Trailhead embodies human-centered design; allowing the community to grow organically in a space devoted to living, working, and playing. Stop in for a cup of coffee, stay to work, or stay in one of our on-site Airbnb\'s. We are part of the pulse of Santa Fe.', 'Trailhead-space-1200px-72ppi.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `affiliations`
--

CREATE TABLE `affiliations` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `entity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `affiliations`
--

INSERT INTO `affiliations` (`id`, `url_string`, `entity`) VALUES
(1, 'member-american-society-of-landscape-architecture-asla', 'Member, American Society of Landscape Architecture, ASLA'),
(2, 'member-international-federation-of-landscape-architects-ifla', 'Member, International Federation of Landscape Architects, IFLA'),
(3, 'registered-landscape-architect-new-mexico-no-449', 'Registered Landscape Architect, New Mexico, No. 449'),
(4, 'native-plant-society', 'Native Plant Society'),
(5, 'member-the-natural-teachers-network', 'Member, The Natural Teachers Network');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_collaborators_and_collaborator_areas`
--

CREATE TABLE `associated_collaborators_and_collaborator_areas` (
  `id` int(11) NOT NULL,
  `collaborators_id` int(11) NOT NULL DEFAULT 0,
  `collaborator_areas_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `associated_collaborators_and_collaborator_areas`
--

INSERT INTO `associated_collaborators_and_collaborator_areas` (`id`, `collaborators_id`, `collaborator_areas_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 3),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_projects_and_categories`
--

CREATE TABLE `associated_projects_and_categories` (
  `id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL DEFAULT 0,
  `categories_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `associated_projects_and_categories`
--

INSERT INTO `associated_projects_and_categories` (`id`, `projects_id`, `categories_id`) VALUES
(1, 3, 1),
(2, 3, 3),
(3, 4, 4),
(4, 2, 1),
(5, 2, 2),
(6, 5, 3),
(7, 6, 1),
(8, 7, 4),
(9, 8, 1),
(10, 8, 2),
(11, 9, 1),
(12, 9, 3),
(13, 9, 4),
(14, 10, 2),
(15, 11, 1),
(16, 11, 2),
(17, 13, 1),
(18, 13, 2),
(19, 14, 2),
(20, 16, 1),
(21, 16, 2),
(22, 17, 1),
(23, 18, 1),
(24, 18, 2),
(25, 19, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_projects_and_clients`
--

CREATE TABLE `associated_projects_and_clients` (
  `id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL DEFAULT 0,
  `clients_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `associated_projects_and_clients`
--

INSERT INTO `associated_projects_and_clients` (`id`, `projects_id`, `clients_id`) VALUES
(1, 2, 6),
(2, 8, 1),
(3, 13, 2),
(4, 15, 5),
(5, 17, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_projects_and_collaborators`
--

CREATE TABLE `associated_projects_and_collaborators` (
  `id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL DEFAULT 0,
  `collaborators_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `associated_projects_and_collaborators`
--

INSERT INTO `associated_projects_and_collaborators` (`id`, `projects_id`, `collaborators_id`) VALUES
(1, 11, 1),
(2, 19, 3),
(3, 19, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associated_projects_and_tags`
--

CREATE TABLE `associated_projects_and_tags` (
  `id` int(11) NOT NULL,
  `projects_id` int(11) NOT NULL DEFAULT 0,
  `tags_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `associated_projects_and_tags`
--

INSERT INTO `associated_projects_and_tags` (`id`, `projects_id`, `tags_id`) VALUES
(1, 3, 2),
(2, 3, 7),
(3, 2, 2),
(4, 2, 11),
(5, 2, 7),
(6, 2, 3),
(7, 2, 5),
(8, 6, 12),
(9, 6, 3),
(10, 6, 13),
(11, 6, 11),
(12, 9, 1),
(13, 10, 2),
(14, 10, 1),
(15, 10, 7),
(16, 13, 12),
(17, 13, 4),
(18, 13, 7),
(19, 13, 11),
(20, 19, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `award_title` varchar(255) DEFAULT NULL,
  `award_info` varchar(255) DEFAULT NULL,
  `award_link` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `awards`
--

INSERT INTO `awards` (`id`, `award_title`, `award_info`, `award_link`, `year`) VALUES
(1, 'Build Home & Garden Awards', 'Best Independent Landscape Architecture Firm - USA', 'https://www.build-review.com/winners/serquis-associates-landscape-architecture/', 2021),
(2, 'Best Outdoor Space and PEOPLE’S CHOICE Award', 'Haciendas: A Virtual Parade of Homes #2 Zachary & Sons Homes', 'https://sfahba.com/project/zachary-and-sons/', 2020),
(3, 'Haciendas Parade of Homes Awards', 'Best Outdoor Living Space & Grand Hacienda', 'https://sfahba.com/parade-of-homes/', 2018),
(4, 'US Representative at Japan’s World Flower Garden Show', '', 'https://www.huistenbosch.co.jp/event/fgs/', 2015),
(5, 'Haciendas Parade of Homes Awards', 'Best Outdoor Living Space', '', 2011),
(6, 'Design Competition Winners', '2nd Place Winner', '', 2011),
(7, 'LIHTC Design Competition', '2nd Place Winner', '', 2011),
(8, 'HGTV', 'Landscapers Challenge in Cerrillos NM', '', 2003),
(9, 'Urban Planning Design, national contest Railyard Park, Buenos Aires -25 acres-', '1st prize Master+Schematic Design', '', 2000),
(10, 'Multiple Residential Design Awards', '', '', 1999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `url_string`, `category_name`) VALUES
(1, 'featured', 'Featured'),
(2, 'residential', 'Residential'),
(3, 'comercial--public-developments', 'Comercial - Public Developments'),
(4, 'lookbooks', 'Lookbooks');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `telephone_number` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `since` date DEFAULT NULL,
  `last_contact` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `url_string`, `client_name`, `client_email`, `telephone_number`, `address`, `details`, `since`, `last_contact`, `active`) VALUES
(1, 'alpern', 'alpern', '', '', '', '', '2021-12-01', '2021-12-28 21:14:00', 1),
(2, 'bunkowski_hoopes', 'Bunkowski_Hoopes', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0),
(3, 'gourynieto-club-casitas', 'Goury-Nieto Club Casitas', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0),
(4, 'ligier_annelaure', 'Ligier_Anne-Laure', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0),
(5, 'reidrobnette', 'REID-ROBNETTE', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0),
(6, 'rizzo', 'Rizzo', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0),
(7, 'schneider', 'Schneider', '', '', '', '', '1970-01-01', '1970-01-01 01:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collaborators`
--

CREATE TABLE `collaborators` (
  `id` int(11) NOT NULL,
  `collaborator_name` varchar(255) DEFAULT NULL,
  `collaborator_email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `collaborator_telephone` varchar(255) DEFAULT NULL,
  `collaborator_address` varchar(255) DEFAULT NULL,
  `last_contact` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collaborators`
--

INSERT INTO `collaborators` (`id`, `collaborator_name`, `collaborator_email`, `contact_person`, `collaborator_telephone`, `collaborator_address`, `last_contact`) VALUES
(1, 'Ash Photography', 'ash@photography.com', '', '', '', '2021-12-29 01:36:00'),
(2, 'Daniel-Photographer', '', '', '', '', '2021-12-31 08:13:00'),
(3, 'Peter', '', '', '', '', '2021-12-31 08:13:00'),
(4, 'Rangewest gallery Madrid NM', '', '', '', '', '2021-12-31 08:14:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collaborator_areas`
--

CREATE TABLE `collaborator_areas` (
  `id` int(11) NOT NULL,
  `area` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `collaborator_areas`
--

INSERT INTO `collaborator_areas` (`id`, `area`) VALUES
(1, 'Photographer'),
(2, 'Art'),
(3, 'Contractor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homepage_pictures`
--

CREATE TABLE `homepage_pictures` (
  `id` int(11) NOT NULL,
  `link_name` varchar(255) DEFAULT NULL,
  `picture_link` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `homepage_pictures`
--

INSERT INTO `homepage_pictures` (`id`, `link_name`, `picture_link`, `picture`) VALUES
(1, 'Trailhead', 'https://www.trailheadsantafe.com/', 'Trailhead-2500x1406.jpg'),
(2, 'Design', 'https://serquis.com/projects/our_work', 'Design-GabriellaMarks-2500x2406-100ppiprogresive.jpg'),
(3, 'People', 'https://serquis.com/about', 'People-GabriellaMarks-2500x1406-100-progressive.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `houzz_pictures`
--

CREATE TABLE `houzz_pictures` (
  `id` int(11) NOT NULL,
  `picture_link` varchar(255) DEFAULT NULL,
  `award_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `houzz_pictures`
--

INSERT INTO `houzz_pictures` (`id`, `picture_link`, `award_year`) VALUES
(1, 'https://st.hzcdn.com/static/badge_16_7@2x.png', 2015),
(2, 'https://st.hzcdn.com/static/badge_22_7@2x.png', 2016),
(3, 'https://st.hzcdn.com/static/badge_41_7@2x.png', 2017),
(4, 'https://st.hzcdn.com/static/badge_44_7@2x.png', 2018),
(5, 'https://st.hzcdn.com/static/badge_47_7@2x.png', 2019),
(6, 'https://st.hzcdn.com/static/badge_54_7@2x.png', 2021);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_links`
--

CREATE TABLE `menu_links` (
  `id` int(11) NOT NULL,
  `menu_title` varchar(50) NOT NULL,
  `menu_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menu_links`
--

INSERT INTO `menu_links` (`id`, `menu_title`, `menu_path`) VALUES
(1, 'About', 'about'),
(2, 'Projects', 'projects/our_work'),
(3, 'Contact', 'contactus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `picture_name` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `target_module` varchar(255) NOT NULL,
  `target_module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pictures`
--

INSERT INTO `pictures` (`id`, `picture_name`, `priority`, `target_module`, `target_module_id`) VALUES
(5, 'rizzoconvWxc.jpg', 2, 'projects', 2),
(6, 'rizzocas9aJ2.jpg', 8, 'projects', 2),
(7, 'rizzocoutzkM.jpg', 5, 'projects', 2),
(8, 'rizzoflo9PYu.jpg', 7, 'projects', 2),
(9, 'rizzoentmcjB.jpg', 6, 'projects', 2),
(10, 'rizzodryJrWP.jpg', 4, 'projects', 2),
(11, 'rizzogeovjYh.jpg', 9, 'projects', 2),
(12, 'rizzogrev5M7.jpg', 10, 'projects', 2),
(13, 'rizzolanGCM5.jpg', 3, 'projects', 2),
(14, 'rizzomasBdXZ.jpg', 13, 'projects', 2),
(15, 'rizzoplaQj6v.jpg', 12, 'projects', 2),
(16, 'rizzostaaaPj.jpg', 11, 'projects', 2),
(17, 'rizzosunc6nU.jpg', 1, 'projects', 2),
(18, 'trailhea9s8Q.jpg', 8, 'projects', 3),
(19, 'trailhea8U7d.jpg', 5, 'projects', 3),
(20, 'trailheagrn5.jpg', 2, 'projects', 3),
(21, 'trailhea2NP2.jpg', 7, 'projects', 3),
(22, 'trailheadtDX.jpg', 3, 'projects', 3),
(23, 'trailheaK822.jpg', 10, 'projects', 3),
(24, 'trailheamV9k.jpg', 6, 'projects', 3),
(25, 'trailheaKssK.jpg', 13, 'projects', 3),
(26, 'trailhea3f5j.jpg', 12, 'projects', 3),
(27, 'trailheasbvS.jpg', 9, 'projects', 3),
(28, 'trailheagqAW.jpg', 11, 'projects', 3),
(29, 'trailheaFEqn.jpg', 4, 'projects', 3),
(30, 'trailhea5JcW.jpg', 1, 'projects', 3),
(31, 'lalunaco96Eg.jpg', 1, 'projects', 5),
(32, 'lalunaena4fE.jpg', 1, 'projects', 5),
(33, 'lalunaaeTHvB.jpg', 1, 'projects', 5),
(34, 'lalunaputrKx.jpg', 1, 'projects', 5),
(35, 'lalunacuKc5Q.jpg', 1, 'projects', 5),
(36, 'lalunapaft6U.jpg', 1, 'projects', 5),
(37, 'lalunashaKDp.jpg', 1, 'projects', 5),
(38, 'lalunawaJds7.jpg', 1, 'projects', 5),
(39, 'lalunawam9tR.jpg', 1, 'projects', 5),
(40, 'lalunawaegpN.jpg', 1, 'projects', 5),
(41, 'japanconkDSV.jpg', 1, 'projects', 6),
(42, 'japanconms22.jpg', 1, 'projects', 6),
(43, 'japanconurcu.jpg', 1, 'projects', 6),
(44, 'japancon5dwa.jpg', 1, 'projects', 6),
(45, 'japanconMuDE.jpg', 1, 'projects', 6),
(46, 'japanconydnu.jpg', 1, 'projects', 6),
(47, 'japanconCySC.jpg', 1, 'projects', 6),
(48, 'japanconLY33.jpg', 1, 'projects', 6),
(49, 'contemprX6R8.jpg', 1, 'projects', 8),
(50, 'desertlahnU6.jpg', 1, 'projects', 8),
(51, 'desertlae7sH.jpg', 1, 'projects', 8),
(52, 'moderninYd9S.jpg', 1, 'projects', 8),
(53, 'SAfrontee7My.jpg', 1, 'projects', 8),
(54, 'acequiatRYLg.jpg', 1, 'projects', 9),
(55, 'acequiateaDv.jpg', 1, 'projects', 9),
(56, 'acequiatxDej.jpg', 1, 'projects', 9),
(57, 'acequiatU7JA.jpg', 1, 'projects', 9),
(58, 'acequiatht5G.jpg', 1, 'projects', 9),
(59, 'acequiatNtq7.jpg', 1, 'projects', 9),
(60, 'acequiatwEdr.jpg', 1, 'projects', 9),
(61, 'acequiatztuy.jpg', 1, 'projects', 9),
(62, 'acequiatKQaQ.jpg', 1, 'projects', 9),
(63, 'nativedephKn.jpg', 1, 'projects', 10),
(64, 'nativede2XeA.jpg', 1, 'projects', 10),
(65, 'nativedeuzeu.jpg', 1, 'projects', 10),
(66, 'nativedefPbW.jpg', 1, 'projects', 10),
(67, 'nativede6Vpy.jpg', 1, 'projects', 10),
(68, 'nativedeHJGH.jpg', 1, 'projects', 10),
(69, 'nativedeB8Fh.jpg', 1, 'projects', 10),
(70, 'SAgeometnEFv.jpg', 1, 'projects', 11),
(71, 'SAmetalsdyPy.jpg', 1, 'projects', 11),
(72, 'SAFronte6rbX.jpg', 1, 'projects', 11),
(73, 'SALandsccg8y.jpg', 1, 'projects', 11),
(74, 'SAPlantsFPKd.jpg', 1, 'projects', 11),
(75, 'SASculptgVmZ.jpg', 1, 'projects', 11),
(76, 'SAsidede57ff.jpg', 1, 'projects', 11),
(77, 'SATallgrPhJp.jpg', 1, 'projects', 11),
(78, 'SAgoldenBCS5.jpeg', 1, 'projects', 13),
(79, 'SAbocceb6bqj.jpg', 1, 'projects', 13),
(80, 'SAgeometcpWE.jpg', 1, 'projects', 13),
(81, 'SAhidden75RS.jpeg', 1, 'projects', 13),
(82, 'SAdesertMw2c.jpg', 1, 'projects', 13),
(83, 'SAlavandZFSP.jpeg', 1, 'projects', 13),
(84, 'SAlightgYL58.jpg', 1, 'projects', 13),
(85, 'SAnative2uVf.jpg', 1, 'projects', 13),
(86, 'SAnightsGgV4.jpg', 1, 'projects', 13),
(87, 'SAsidestMckf.jpg', 1, 'projects', 13),
(88, 'SASkyvieXhEs.jpg', 1, 'projects', 13),
(89, 'desertvidjbs.jpeg', 1, 'projects', 14),
(90, 'desertvin9Pk.jpeg', 1, 'projects', 14),
(91, 'desertviuZvx.jpeg', 1, 'projects', 14),
(92, 'desertviTkXm.jpeg', 1, 'projects', 14),
(93, 'desertviR7BD.jpeg', 1, 'projects', 14),
(94, 'desertviY5Am.jpeg', 1, 'projects', 14),
(95, 'desertvir9SY.jpeg', 1, 'projects', 14),
(96, 'desertviT3Nj.jpeg', 1, 'projects', 14),
(97, 'SABrickB6T7f.jpg', 1, 'projects', 15),
(98, 'SAlightgTPzB.jpg', 1, 'projects', 15),
(99, 'SADetailGUcX.jpg', 1, 'projects', 15),
(100, 'SArednatDGdL.jpg', 1, 'projects', 15),
(101, 'SAbrickp3jtL.jpg', 1, 'projects', 15),
(102, 'SAcoyote33zX.jpg', 1, 'projects', 15),
(103, 'supermodT4Ju.jpg', 1, 'projects', 16),
(104, 'supermodEggy.jpg', 1, 'projects', 16),
(105, 'supermodgm48.jpg', 1, 'projects', 16),
(106, 'supermod5keR.jpg', 1, 'projects', 16),
(107, 'supermodpnGN.jpg', 1, 'projects', 16),
(108, 'supermod2mKm.jpg', 1, 'projects', 16),
(109, 'supermodWkGY.jpg', 1, 'projects', 16),
(110, 'supermodD3Sf.jpg', 1, 'projects', 16),
(111, 'skyhouseqPpd.jpg', 1, 'projects', 18),
(112, 'skyhouseL3QM.jpg', 1, 'projects', 18),
(113, 'skyhouse8HBe.jpg', 1, 'projects', 18),
(114, 'skyhouseekz4.jpg', 1, 'projects', 18),
(115, 'skyhouseSzub.jpg', 1, 'projects', 18),
(116, 'skyhouseQ6Gs.jpg', 1, 'projects', 18),
(117, 'skyhouse2KkQ.jpg', 1, 'projects', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `project_title` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `issuu_code` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `project_folder` varchar(255) DEFAULT NULL,
  `best_pic_folder` varchar(255) DEFAULT NULL,
  `postcard` tinyint(1) DEFAULT NULL,
  `cost_from` int(11) DEFAULT NULL,
  `cost_to` int(11) DEFAULT NULL,
  `final_cost` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `live_on_website` tinyint(1) DEFAULT NULL,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `url_string`, `project_title`, `project_name`, `location`, `project_description`, `issuu_code`, `start_date`, `finish_date`, `project_folder`, `best_pic_folder`, `postcard`, `cost_from`, `cost_to`, `final_cost`, `date_created`, `live_on_website`, `picture`) VALUES
(1, 'retreat-home', 'Retreat Home', 'Goury-Nieto Club Casitas', 'Retreat Home', 'The home is an escape. With the proximity to the golf course and clubhouse, it is the perfect location to retreat and enjoy the leisurely parts of life. Thus, the celebration of the tranquil was a driving factor in the landscape design. Our palette was one approach to achieve this serenity. We refined the walkways and portals, using a light tile that contrasts with the dark color of the oil-rubbed steel that defines the edges in the landscape. Smooth white pebbles are found within steel planters throughout the site. These pebbles become a powerful, yet quiet, statement when paired with the gravel mulch that is used as ground cover for the entirety of the site. Through materiality and a sensitive definition of spaces, we have provided our clients with a design that will be timeless, offering them serene outdoor living to enjoy over the years. The library patio wall was the confluence design By S+A craft by Josh Gannon and an art piece from their Gallery Rangewest', NULL, '2021-12-01', '0000-00-00', '', '', 1, 0, 0, 0, 1622005200, 1, 'Hero-img-web-res-2500w.jpg'),
(2, 'native--ultracontemporary', 'Native & Ultra-Contemporary', 'Rizzo', 'santa fe New Mexico', '', NULL, '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640934988, 1, 'rizzo-hero.jpg'),
(3, 'trailhead-design-source', 'Trailhead Design Source', 'Trailhead Design Source', '922 Shoofly St', 'A building within a landscape. The Trailhead is a hub for Santa Fe\'s stopover, work, and play lifestyle; bringing heart-centered connection to every facet of your life. Located at the edge of downtown, The Trailhead embodies human-centered design; allowing the community to grow organically in a space devoted to living, working, and playing. Stop in for a cup of coffee, stay to work, or stay in one of our on-site Airbnb\'s. We are part of the pulse of Santa Fe.', NULL, '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640935230, 1, 'trailhead-hero.jpg'),
(4, 'lookbook-portfolio-2013', 'Lookbook: Portfolio 2013', 'Lookbook: Portfolio 2013', '', '', '8177829/6281220', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640935854, 1, 'portfolio-lookbook-2013.jpg'),
(5, 'luna-public-space', 'Luna Public Space', 'Luna Public Space', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', 'Nextcloud/serquis/PHOTOS/2015/luna', 0, 0, 0, 0, 1640936288, 1, 'laluna-hero.jpg'),
(6, 'japan-flower--garden-show', 'Japan Flower & Garden Show', 'Japan Contest', 'Nagasaki, Japan', 'Desert Sense\r\nwith an Urban Style\r\nThis outdoor living space emulates and is inspired by our native high desert\r\nin the Southwest region of the United States and our diverse cultures.\r\nThe desert evokes a sense of awe...\r\nto appreciate it all,\r\none must look not only at the big picture\r\nbut down to its finest details;\r\nit teaches us that no event is small.\r\nThe design is meant to show that,\r\nmuch like our rugged yet soft desert, it contains a rich palette of color and texture.\r\nWhere natural decay is allowed to reveal strength & versatility while undergoing a\r\ngraceful aging.\r\nThe night-scape was designed by evoking a falling stars,\r\none of the most beautiful events on the desert,\r\nto emphasize the importance\r\nand the echo of our desert night\'s thunderstorms.2015 Japan Flower & Garden Show – My Country, My CultureLocation – Nagasaki, JapanClient – Japan “Gardening World Cup” 2015Scope of Services – International Residential Garden Exhibiting Themes Taken from Solange’s home in New Mexico.\r\nhttps://www.houzz.com/hznb/projects/desert-garden-from-santa-fe-nm-to-japan-pj-vj~2097008', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640936445, 1, 'japan-contest-hero.jpg'),
(7, 'landscape-for-discovery', 'Landscape for Discovery', 'Landscape for Discovery', 'Santa Fe New Mexico', 'Successful designs should engage people with their environment, have fluency among landforms and architecture, and express nature’s rhythms through seasonal interest and textures. We believe there is a close connection between balancing human needs and preserving what nature has given us to enjoy. We are passionate about researching and creating high quality sustainable yet economic alternatives for individuals and communities, whether they are in rural or urban settings. We create and participate in multidisciplinary teams, including the client, for each individual project. Together we form think tanks that inspire ideas that are most appropriate to the site and the end users.', '8177829/8990614', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640936602, 1, 'postcards-educational.jpg'),
(8, 'luxurious-modern', 'Luxurious Modern', 'TierraConcept-Alper-Kaye-19', 'Santa Fe New Mexico', 'We focused on transitioning the architecture i nto the natural l andscape surrounding the house as well ascomplementing the golf course adjacent to the property. View corridors of both the owners, our clients,and the surrounding neighbors were considered. Our goal i s to give all a beautiful sight to view.', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640936716, 1, 'hero-desert-nightscape.jpg'),
(9, 'acequia-trail-underpass-lookbook', 'Acequia Trail Underpass Lookbook', 'Acequia Trail Underpass Lookbook', 'Santa Fe New Mexico', 'e. With the proximity to the golf course and clubhouse, it is the perfect location to retreat and enjoy the leisurely parts of life. Thus, the celebration of the tranquil was a driving factor in the landscape design. Our palette was one approach to achieve this serenity. We refined the walkways and portals, using a light tile that contrasts with the dark color of the oil-rubbed steel that defines the edges in the landscape. Smooth white pebbles are found within steel planters throughout the site. These pebbles become a powerful, yet quiet, statement when paired with the gravel mulch that is used as ground cover for the entirety of the site. Through materiality and a sensitive definition \r\nhttps://issuu.com/byfranziska/docs/acequiatrailunderpass', '33728358/62309763', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640936875, 1, 'heroacequiatrail.jpg'),
(10, 'native-desert-home', 'Native Desert Home', 'Ligier_Anne-Laure', 'Santa Fe New Mexico', 'clauoutis house', '', '0000-00-00', '0000-00-00', '', '/Users/ailublue/Nextcloud/serquis/PHOTOS/2019/Ligier_Anne-Laure/selection', 0, 0, 0, 0, 1640936992, 1, 'native-desert-home-hero.jpg'),
(11, 'blending-in-to-nature', 'Blending in to Nature', 'Lucero', 'Albuquerque', '', '', '0000-00-00', '0000-00-00', 'Z:\\00-SS-2018\\Hoopes Craig\\Susan-Charlie-Lucero', 'Z:\\Photos_Professional\\ASH_2019\\AW_Photos_2019-07-17_UNSORTED\\Lucero', 0, 0, 0, 0, 1640937192, 1, 'hero-S+A-path-and-shadows.jpg'),
(12, 'sunny-landscape', 'Sunny Landscape', 'Thomas', 'Rio Rancho', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937303, 1, 'IMG_0355.jpeg'),
(13, 'galisteo-preserve', 'Galisteo Preserve', 'Bunkowski_Hoopes', 'Santa Fe New Mexico', 'Having the opportunity to weave with a strong hardscape i nto the architectural design, the Anasazi spiral\r\nguided us to create a ripple effect that moves textures and forms. Views, sculptural pieces, metal accents,\r\nornamental pots, water features, kitchen and pollinator gardens, and a bocce ball court were all carefully\r\ncurated to participate i n i ntentional vignettes.', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937399, 1, 'S+A-Hero-Inner-patio-design.jpg'),
(14, 'desert-view', 'Desert View', 'PatStanley', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937575, 1, 'desert-view-hero.jpg'),
(15, 'red-brick', 'Red Brick', 'REID-ROBNETTE', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937671, 1, 'hero-S+A-brick-patio.jpg'),
(16, 'super-modern-remodel', 'Super Modern Remodel', 'Sibley Residence', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937765, 1, 'super-modern-remodel-hero.jpg'),
(17, 'restful-garden', 'Restful Garden', 'Schneider Residence', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937888, 1, 'IMG_0144.jpeg'),
(18, 'sky-house', 'Sky House', 'Frame Residence', 'Santa Fe New Mexico', '', '', '0000-00-00', '0000-00-00', '', '', 0, 0, 0, 0, 1640937997, 1, 'sky-house-hero.jpg'),
(19, 'contemporary-home', 'Contemporary Home', 'Lang Residence', 'Santa Fe New Mexico', 'Smooth white pebbles are found within steel planters throughout the site. Thus, the celebration of the tranquil was a driving factor in the landscape design. Our palette was one approach to achieve this serenity. We refined the walkways and portals, using a light tile that contrasts with the dark color of the oil-rubbed steel that defines the edges in the landscape. Smooth white pebbles are found within steel planters throughout the site. These pebbles become a powerful, yet quiet, statement when paired with the gravel mulch that is used as ground cover for the entirety of the site. Through materiality and a sensitive definition of spaces, we have provided our clients with a design that will be timeless, offering them serene outdoor living to enjoy over the years. The library patio wall was the confluence design By S+A craft by Josh Gannon and an art piece from their Gallery Rangewest', '', '0000-00-00', '0000-00-00', 'Z:\\00-SS-2019\\Lang-2HaciendaRincon', '', 0, 0, 0, 0, 1640938114, 1, 'IMG_1357-1.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `publication_title` varchar(255) DEFAULT NULL,
  `publication_media` varchar(255) DEFAULT NULL,
  `media_link` varchar(255) DEFAULT NULL,
  `published_date` int(11) DEFAULT NULL,
  `live_on_website` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `url_string`, `publication_title`, `publication_media`, `media_link`, `published_date`, `live_on_website`) VALUES
(1, 'features-serquis-myhouzz-backyard-makeover-neil-patrick-harris-surprises-his-older-brother-with-a-home-makeover-that-takes-his-breath-away', 'Features Serquis MyHouzz Backyard Makeover Neil Patrick Harris Surprises His Older Brother With A Home Makeover That Takes His Breath Away', 'People Magazine', 'https://people.com/home/neil-patrick-harris-surprises-older-brother-zen-backyard-den-renovation/', 1558069200, 1),
(2, 'join-us-for-a-journey-through-a-world-of-taste-showhouse-santa-fe-2018', 'Join Us For A Journey Through “A World Of Taste” ShowHouse Santa Fe 2018', 'Santa Fe The Home Issue', '', 1578031200, 1),
(3, 'people-magazine-myhouzz-backyard-makeover-neil-patrick-harris-surprises-his-older-brother-with-a-home-makeover-that-takes-his-breath-away', 'People Magazine MyHouzz Backyard Makeover Neil Patrick Harris Surprises His Older Brother With A Home Makeover That Takes His Breath Away', 'People Magazine', 'https://people.com/home/neil-patrick-harris-surprises-older-brother-zen-backyard-den-renovation/', 1615528800, 1),
(4, 'lookbook-acequia-underpass', 'Lookbook: Acequia Underpass', 'Issuu', 'https://issuu.com/byfranziska/docs/acequiatrailunderpass', 1318741200, 1),
(5, 'santa-fean-the-home-issue', 'Santa Fean The Home Issue', 'Santa Fean', '', 1625288400, 1),
(6, 'collaboration-with-prull-custom-builders-2018-haciendas-a-parade-of-homes', 'Collaboration With Prull Custom Builders 2018 Haciendas A Parade of Homes', 'Prull', 'https://prull.com/', 1558069200, 1),
(7, 'interview-on-all-things-real-estate-ktrc', 'Interview On All Things Real Estate, KTRC', 'KTRC', 'https://santafe.com/ktrc/podcasts/all-things-real-estate-first-hour-august-19-2018', 1534654800, 1),
(8, 'western-art-and-architecture-collaboration-we-are-thrilled-to-have-one-of-our-projects-featured-in-the-magazine-western-art-and-architecture', 'Western Art And Architecture Collaboration We are thrilled to have one of our projects featured in the magazine Western Art and Architecture!', 'Western Art and Architecture', 'http://westernartandarchitecture.com/april-may-2018/angles-trapezoids-amid-high-desert-skyline', 1525150800, 1),
(9, 'santa-fe-new-mexican-bounty-in-permaculture-the-st-francis-underpass-project-acequia-underpass-project', 'Santa Fe New Mexican— Bounty In Permaculture The St. Francis Underpass Project (Acequia Underpass Project)', 'Santa Fe New Mexican', 'https://www.santafenewmexican.com/life/home/bounty-in-permaculture/article_5ebac7f9-a58b-54e2-ba88-779b7f8942c4.html', 1525582800, 1),
(10, 'the-trailheadgiving-life-to-the-baca-railyard-to-view-more-about-this-exciting-development-in-santa-fe-go-to-httpswwwtrailheadsantafecom', 'The Trailhead—Giving Life To The Baca Railyard To view more about this exciting development in Santa Fe, go to https://www.trailheadsantafe.com/', 'Santa Fe New Mexican', 'https://www.santafenewmexican.com/life/home/hub-developing-at-baca-railyard/article_794a9bac-8e7f-554b-8985-f98de962ad71.html', 1530421200, 1),
(11, 'lookbook-landscapes-for-discovery', 'Lookbook: Landscapes For Discovery', 'Issuu', 'https://issuu.com/serquislandscapes/docs/solange-serquis-landscapes-for-disc', 1400562000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections_texts`
--

CREATE TABLE `sections_texts` (
  `id` int(11) NOT NULL,
  `page` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `page_content` text DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `meta_keywords` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sections_texts`
--

INSERT INTO `sections_texts` (`id`, `page`, `title`, `page_content`, `page_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Home', 'Connecting people with places', 'Serquis and Associates is an award-winning Landscape Architecture firm with over 20 years of experience creating designs that combine beauty and human comfort, resulting in a true sense of place. In collaboration with our clients and multi-disciplinary teams, each project is a unique creation influenced by site and environment, an enriching process that concludes with a landscape connecting people to places.', 'Serquis + Associates Landscape Architecture', 'Serquis + Associates has provided independent design work and successfully collaborated in teams for more than fifteen years designing landscapes for commercial', 'landscape architecture, design,new mexico, desert'),
(2, 'About', 'We belive', 'We believe there is a close connection between balancing human needs and preserving what nature has given us to enjoy, and that beautiful surroundings nourish the human spirit.', 'About us: the story behind Serquis + Associates Landscape Architecture. Services, Awards and Affiliations Serquis + Associates Landscape Architecture', 'Serquis and Associates is an award-winning Landscape Architecture firm with over 20 years of experience creating designs that combine beauty and human comfort, resulting in a true sense of place.', 'design philosophy, inspiration, landscape development, connecting, unique creati'),
(3, 'Projects', 'Projects', '', 'Projects designed by Serquis + Associates Landscape Architecture', 'Look to our Landscape Architecture Projects in New Mexico. We have Commercial-Public, Featured Developments, Residential and Ludic Landscapes', 'Commercial, Featured, Residential,Ludic Landscapes New Mexico Landscape'),
(4, 'Contact', 'Contact', 'START A CONVERSATION', 'Contact us  Serquis + Associates Landscape Architecture', 'Contains information about how to get in touch with Serquis + Associates.  Serquis + Associates 922A Shoofly St, Suite #201 Santa Fe, NM 87505 T: (505) 629 – 1009 contact@serquis.com.', 'contact Serquis + Associates, contact us, get in touch with Serquis, Serquis + A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `svg_logos`
--

CREATE TABLE `svg_logos` (
  `id` int(11) NOT NULL,
  `place_logo` varchar(255) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `svg_tag` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `svg_logos`
--

INSERT INTO `svg_logos` (`id`, `place_logo`, `image_name`, `svg_tag`) VALUES
(1, 'Header', 'S+A-full-logo-small.svg', '<svg id=\"Layer_1\" data-name=\"Layer 1\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 939.93 193.97\"><defs><style>.cls-1,.cls-7{fill:#e5a724;}.cls-2{fill:#4e4d4d;}.cls-3{fill:#807f80;}.cls-4{fill:#99a539;}.cls-5{fill:#959743;}.cls-6{fill:#e6e7e8;}.cls-7{fill-rule:evenodd;}.cls-8{fill:#98a539;}</style></defs><polygon class=\"cls-1\" points=\"528.63 62.19 527.33 68.12 512.76 68.12 512.76 83.23 506.86 84.35 506.86 68.12 491.07 68.12 492.2 62.19 506.86 62.19 506.86 47.07 512.76 45.96 512.76 62.19 528.63 62.19\"/><path class=\"cls-2\" d=\"M200.24,166.42l-.08-56.88h3v53.92H217l.12,3Zm33.91,0,8.69-56.8h3.24l9.37,56.8H252l-3.51-19.36h-7.68l-3.47,19.36Zm6.53-22.31h7.57l-4-28.84Zm31.62,22.31h2.91V121.21l11.49,45.21h2.38V109.69h-2.83v43l-10.89-43-3.06.07Zm33.94,0V109.91h7.05a7.26,7.26,0,0,1,3.66.74,8.6,8.6,0,0,1,3,4.1,36.09,36.09,0,0,1,2.43,9.62,103.18,103.18,0,0,1,.78,13.42,113.27,113.27,0,0,1-.52,11.44,54,54,0,0,1-1.4,8.19,26.18,26.18,0,0,1-1.87,5.12,7.86,7.86,0,0,1-2.44,2.88,5.78,5.78,0,0,1-3.32,1Zm2.62-2.33h4.29a6.94,6.94,0,0,0,2.57-1.81A16.46,16.46,0,0,0,318,157a36.68,36.68,0,0,0,1.57-7.9q.3-3.76.74-11.34a103.25,103.25,0,0,0-1.41-16.36,33.59,33.59,0,0,0-2.24-7.64,5.5,5.5,0,0,0-3.62-1.26h-4.21Zm35.31-31.8q0,3.41,3.14,3.4h7.9q2.84,0,2.84,3.55v21.12a7.5,7.5,0,0,1-1.14,4.14,4.48,4.48,0,0,1-3.79,1.92h-7.9a3.91,3.91,0,0,1-2.84-1.85,6,6,0,0,1-1.12-3.77V148.39h2.61v10.42a8.85,8.85,0,0,0,.6,3.69q.6,1.26,2.76,1.26h3.66a3.89,3.89,0,0,0,3.24-1.33,5.58,5.58,0,0,0,1.05-3.55l-.12-16.69c.08-2.31-1-3.5-3.13-3.55h-6.71q-3.89,0-3.88-5v-18a7.55,7.55,0,0,1,1.13-4.14,4.48,4.48,0,0,1,3.79-1.92h7.91a3.61,3.61,0,0,1,3.06,1.85,7,7,0,0,1,.89,3.77v12.41h-2.61V117.15a8.85,8.85,0,0,0-.6-3.69q-.59-1.26-2.76-1.26H347a2.25,2.25,0,0,0-2.07,1.33,7.35,7.35,0,0,0-.73,3.55l0,12.85Zm34.85,5v-7.38l0-12.85a7.35,7.35,0,0,1,.73-3.55,2.25,2.25,0,0,1,2.07-1.33H387q2.17,0,2.76,1.26a8.85,8.85,0,0,1,.6,3.69v10.42H393V115.16a5.44,5.44,0,0,0-1.34-3.77,5,5,0,0,0-3.66-1.85h-6.86a4.5,4.5,0,0,0-3.79,1.92,7.55,7.55,0,0,0-1.13,4.14v44.76a8,8,0,0,0,1.06,4.06,4.23,4.23,0,0,0,3.71,2h7.31a4.32,4.32,0,0,0,3.43-1.85,6,6,0,0,0,1.12-3.77V148.39h-2.61v10.42a9,9,0,0,1-.59,3.69q-.6,1.26-2.76,1.26H383.2c-1.79,0-2.93-.45-3.43-1.33a7.6,7.6,0,0,1-.75-3.7V137.31Zm31.74,29.11,8.69-56.8h3.24l9.37,56.8h-3.47l-3.51-19.36H417.4l-3.47,19.36Zm6.53-22.31h7.57l-4-28.84Zm31.6,22.31V109.65h9.21a5.51,5.51,0,0,1,4.24,1.55,12.13,12.13,0,0,1,2.31,5.41,39,39,0,0,1,.88,8.55,26.93,26.93,0,0,1-1.48,9.79q-1.47,3.74-2.89,4.65a13,13,0,0,1-4.1,1.56l-2.24,0h-3.21v25.23Zm2.76-27.48H457a9.15,9.15,0,0,0,3.74-2.81,14.09,14.09,0,0,0,1.64-4.43,46.58,46.58,0,0,0,.93-6.9,50,50,0,0,0-1.38-9.42c-.65-2.32-2.51-3.72-5.6-4.21l-4.66.11Zm32.15,27.48V109.76h16.37l0,2.59H486.71V135.8h12.38v2.92H486.71v24.89h13.87l.11,2.81Zm63,0,8.69-56.8h3.25l9.36,56.8h-3.47l-3.5-19.36h-7.69L550,166.42Zm6.53-22.31h7.57l-4-28.84ZM585,166.42V109.58h9.21a5.52,5.52,0,0,1,4.23,1.53,12,12,0,0,1,2.32,5.41,39.21,39.21,0,0,1,.87,8.57,31.5,31.5,0,0,1-1.43,10.19q-1.44,4.14-4.42,5.25a12.86,12.86,0,0,1,1.64,2.84,58.25,58.25,0,0,1,2.27,7.54l3.66,15.51h-3.47l-2.76-11.86q-1.23-5.13-2-7.85a18.84,18.84,0,0,0-1.39-3.78,4.69,4.69,0,0,0-1.25-1.52,3.33,3.33,0,0,0-1.53-.25h-3.21v25.26Zm2.76-27.48h5.11a4.67,4.67,0,0,0,3.5-2.14,16.94,16.94,0,0,0,1.64-4.66,43.41,43.41,0,0,0,.9-7.27,34.08,34.08,0,0,0-1.08-9.53c-.72-2.39-2.48-3.73-5.26-4h-4.81Zm35-1.47-.14-5-.07-2.36-.32-12.85a7.3,7.3,0,0,1,.62-3.56,2.26,2.26,0,0,1,2-1.39l5.15-.15c1.44,0,2.37.36,2.79,1.18a8.83,8.83,0,0,1,.71,3.67l.29,10.42,2.61-.08-.35-12.4a5.42,5.42,0,0,0-1.45-3.73,5,5,0,0,0-3.71-1.74l-6.86.19a4.5,4.5,0,0,0-3.73,2,7.56,7.56,0,0,0-1,4.17l.07,2.36,1.14,40,.06,2.36a8.1,8.1,0,0,0,1.18,4,4.22,4.22,0,0,0,3.77,1.89l7.31-.21a4.31,4.31,0,0,0,3.37-1.94,6,6,0,0,0,1-3.8l-.36-12.4-2.61.07.3,10.41a9.11,9.11,0,0,1-.49,3.71c-.38.85-1.28,1.29-2.73,1.33l-3.65.11c-1.79.05-3-.36-3.47-1.24a7.67,7.67,0,0,1-.85-3.67l-.47-16.53Zm35,1.17v27.78h-3V109.69h2.83v26H669v-26h2.54v56.73h-3V142.19l.12-3.47-3.25-.08Zm56.1-28.95h16.86v2.66h-7.31v54.07h-2.69V112.35h-6.86Zm-22.68-.07h2.65v56.72h-2.68V112.28Zm57.6,56.8V109.76h16.38l0,2.59H751.7V135.8h12.39v2.92H751.7v24.89h13.88l.11,2.81Zm37.75-29.11v-7.38l0-12.85a7.47,7.47,0,0,1,.73-3.55,2.27,2.27,0,0,1,2.07-1.33h5.15q2.16,0,2.76,1.26a8.85,8.85,0,0,1,.6,3.69v10.42h2.61V115.16a5.4,5.4,0,0,0-1.35-3.77,5,5,0,0,0-3.65-1.85h-6.86a4.48,4.48,0,0,0-3.79,1.92,7.48,7.48,0,0,0-1.14,4.14v44.76a8.06,8.06,0,0,0,1.06,4.06,4.23,4.23,0,0,0,3.72,2h7.31a4.33,4.33,0,0,0,3.43-1.85,6,6,0,0,0,1.12-3.77V148.39h-2.61v10.42a8.85,8.85,0,0,1-.6,3.69q-.6,1.26-2.76,1.26h-3.66c-1.79,0-2.93-.45-3.43-1.33a7.61,7.61,0,0,1-.74-3.7V137.31Zm31.84-27.62h16.86v2.66h-7.31v54.07h-2.68V112.35h-6.87Zm34.85,50.52a7.49,7.49,0,0,0,1.2,4.29c.79,1.18,2.19,1.82,4.18,1.92h6.23c2-.1,3.38-.74,4.17-1.92a7.49,7.49,0,0,0,1.2-4.29V109.69h-3v49.19a5.63,5.63,0,0,1-1,3.55,4.09,4.09,0,0,1-3.4,1.33h-1.94a4.32,4.32,0,0,1-3.58-1.33,5.63,5.63,0,0,1-1-3.55V109.69h-3v50.52Zm34.87,6.21V109.58h9.22a5.53,5.53,0,0,1,4.23,1.53,11.86,11.86,0,0,1,2.31,5.41,38.59,38.59,0,0,1,.88,8.57,31.21,31.21,0,0,1-1.44,10.19c-.95,2.76-2.43,4.51-4.42,5.25a12.92,12.92,0,0,1,1.65,2.84,58.25,58.25,0,0,1,2.27,7.54l3.66,15.51H903l-2.76-11.86c-.82-3.42-1.5-6-2-7.85a18.71,18.71,0,0,0-1.4-3.78,4.56,4.56,0,0,0-1.25-1.52,3.27,3.27,0,0,0-1.53-.25h-3.2v25.26Zm2.76-27.48H896a4.69,4.69,0,0,0,3.51-2.14,17.28,17.28,0,0,0,1.64-4.66,43.41,43.41,0,0,0,.9-7.27,34.08,34.08,0,0,0-1.08-9.53q-1.1-3.59-5.26-4h-4.82ZM923,166.42V109.76H939.4l0,2.59H925.94V135.8h12.38v2.92H925.94v24.89h13.87l.12,2.81Z\"/><path class=\"cls-3\" d=\"M595.16,87.8l-8.46,2.32L576.42,69.33h-24L541.85,90.12l-8.63-2.32,30.62-60.4Zm-22.6-26.28L564.31,45,556,61.52Zm54.77,15.54A11.7,11.7,0,0,1,623,86.47a16.58,16.58,0,0,1-11,3.65,18.57,18.57,0,0,1-8.46-1.81,20,20,0,0,1-6.64-5.66l5.9-4.81a14.19,14.19,0,0,0,4,3A10.24,10.24,0,0,0,611.54,82a9.61,9.61,0,0,0,5-1.2A4.63,4.63,0,0,0,619,76.63q0-4.12-10.67-7.13T597.66,57.39a11.65,11.65,0,0,1,4.47-9.31,16,16,0,0,1,10.63-3.74,17,17,0,0,1,7.07,1.54,21,21,0,0,1,6.11,4.21l-5.11,5.76A17.61,17.61,0,0,0,617,52.93a8.79,8.79,0,0,0-4.3-1.12A8.29,8.29,0,0,0,608,53.14a4.57,4.57,0,0,0-2,4.08q0,3.87,10.67,6.87T627.33,77.06Zm35.66,0a11.7,11.7,0,0,1-4.38,9.41,16.58,16.58,0,0,1-11,3.65,18.57,18.57,0,0,1-8.46-1.81,19.85,19.85,0,0,1-6.63-5.66l5.89-4.81a14.19,14.19,0,0,0,4,3A10.24,10.24,0,0,0,647.2,82a9.64,9.64,0,0,0,5-1.2,4.64,4.64,0,0,0,2.42-4.21q0-4.12-10.66-7.13T633.33,57.39a11.64,11.64,0,0,1,4.46-9.31,16,16,0,0,1,10.63-3.74,17,17,0,0,1,7.07,1.54,21,21,0,0,1,6.11,4.21l-5.11,5.76a17.61,17.61,0,0,0-3.86-2.92,8.76,8.76,0,0,0-4.3-1.12,8.29,8.29,0,0,0-4.68,1.33,4.57,4.57,0,0,0-2,4.08q0,3.87,10.67,6.87T663,77.06Zm52.82-10q0,10.14-6.64,16.62a22.78,22.78,0,0,1-16.61,6.49,23.31,23.31,0,0,1-16.83-6.53A21.83,21.83,0,0,1,669,67.19,21.66,21.66,0,0,1,675.86,51a22.85,22.85,0,0,1,16.44-6.66A23.27,23.27,0,0,1,709,50.87,21.39,21.39,0,0,1,715.81,67Zm-8.24-.08A15.18,15.18,0,1,0,692.48,82a14.92,14.92,0,0,0,10.84-4.12Q707.57,73.8,707.57,66.93ZM761.27,83a22.74,22.74,0,0,1-17.09,7.13,21.68,21.68,0,0,1-16-6.79,22.18,22.18,0,0,1-6.68-16.14,22.78,22.78,0,0,1,6.33-16.07,21.65,21.65,0,0,1,16.57-7.21,24.15,24.15,0,0,1,8.8,1.66,31.37,31.37,0,0,1,8.11,4.63l-5.46,5.91a22.35,22.35,0,0,0-5.47-3.33,15.88,15.88,0,0,0-6-1.05,15.09,15.09,0,0,0-14.58,14.55,15.48,15.48,0,0,0,4.43,11.2,14.72,14.72,0,0,0,11,4.56,13.54,13.54,0,0,0,5.56-1.2,18.79,18.79,0,0,0,5-3.35ZM779,33.84l-5.2,6.7-5.47-6.7,5.47-6.7Zm-1.3,54.65-8,1.11V46.23l8-1.2Zm45.8-.09-8,1.12V84.45a12.8,12.8,0,0,1-4.89,4.25,14.6,14.6,0,0,1-6.53,1.42q-7.6,0-12.32-4.51T787,73.54a14.54,14.54,0,0,1,4.85-11A17.18,17.18,0,0,1,804.15,58a18.3,18.3,0,0,1,6.18,1,14.81,14.81,0,0,1,5.15,3.31V58.77q0-4.12-3.2-5.76-2.43-1.2-7.35-1.2a30.05,30.05,0,0,0-6.35.73,31.56,31.56,0,0,0-6.35,2.11l1.82-8.59a59.74,59.74,0,0,1,6.85-1.25,54.66,54.66,0,0,1,6.68-.47q7.11,0,11.19,3.43,4.68,4,4.69,11.86Zm-7.64-14.64A6.74,6.74,0,0,0,812.66,68a11.66,11.66,0,0,0-6.81-2.22,12.84,12.84,0,0,0-7,1.88,6.81,6.81,0,0,0-3.47,6c0,3,1,5.16,3,6.58a12.88,12.88,0,0,0,7.46,1.88,11.25,11.25,0,0,0,7-2.26A7.28,7.28,0,0,0,815.82,73.76Zm40.85,7.88a3.6,3.6,0,0,0,1.05-.2l-1.57,7.74a5.3,5.3,0,0,1-1.21.17,42.11,42.11,0,0,1-5.55.42q-6.42,0-9.8-3.59-3.65-3.86-3.65-11.66V52.76h-6.76l3-7.48h3.81v-11l8-2.15V45.28h12.23v7.48H843.92V74.44q0,7.52,7.81,7.52a38.19,38.19,0,0,0,4.94-.32ZM904,56.36,872.12,74.91a17,17,0,0,0,4.6,5A13.09,13.09,0,0,0,884.18,82a21.23,21.23,0,0,0,9.1-2.06,42.94,42.94,0,0,0,7.9-5.06l1.73,8.5a36.22,36.22,0,0,1-8.8,5,26.38,26.38,0,0,1-9.5,1.72,23.32,23.32,0,0,1-16.83-6.62,21.69,21.69,0,0,1-6.85-16.23A23,23,0,0,1,884,44.34,22.63,22.63,0,0,1,895.8,47.6,20.66,20.66,0,0,1,904,56.36Zm-12-1.58a11.26,11.26,0,0,0-8-3,14.91,14.91,0,0,0-14.73,14.73l0,1.56Zm47,22.28a11.7,11.7,0,0,1-4.38,9.41,16.58,16.58,0,0,1-11,3.65,18.57,18.57,0,0,1-8.46-1.81,19.85,19.85,0,0,1-6.63-5.66l5.89-4.81a14.09,14.09,0,0,0,4,3A10.19,10.19,0,0,0,923.21,82a9.63,9.63,0,0,0,5-1.2,4.63,4.63,0,0,0,2.43-4.21q0-4.12-10.67-7.13T909.33,57.39a11.67,11.67,0,0,1,4.46-9.31,16,16,0,0,1,10.63-3.74,17,17,0,0,1,7.07,1.54,21.22,21.22,0,0,1,6.12,4.21l-5.12,5.76a17.38,17.38,0,0,0-3.86-2.92,8.76,8.76,0,0,0-4.3-1.12,8.29,8.29,0,0,0-4.68,1.33,4.57,4.57,0,0,0-2,4.08q0,3.87,10.67,6.87T939,77.06Z\"/><path class=\"cls-4\" d=\"M229.73,59.35q7.46,4.47,7.46,13.59a15.72,15.72,0,0,1-5.86,12.47,20.28,20.28,0,0,1-13.58,5,23.4,23.4,0,0,1-10.53-2.33,24.16,24.16,0,0,1-8.38-7l6.6-5.53a24.06,24.06,0,0,0,5.29,5,13,13,0,0,0,7,1.83,11.82,11.82,0,0,0,7.38-2.24,8.21,8.21,0,0,0,3.29-7q0-5.59-7.37-8.52Q214.1,62,207.26,59.36,199.79,55,199.8,45.85a14.31,14.31,0,0,1,5.64-12,22.22,22.22,0,0,1,14-4.34,20.28,20.28,0,0,1,9.28,2.19,21.37,21.37,0,0,1,7.38,6.14L230,44a19.78,19.78,0,0,0-5-4.72,13.56,13.56,0,0,0-6.85-1.63,10.82,10.82,0,0,0-6.76,2.11,7,7,0,0,0-2.78,5.89q0,5.34,7.11,8.17t14.06,5.51Zm56.47-3.13L254.36,74.77a16.78,16.78,0,0,0,4.6,5,13,13,0,0,0,7.46,2.15,21.35,21.35,0,0,0,9.1-2.06,43.6,43.6,0,0,0,7.9-5.07l1.73,8.5a36.61,36.61,0,0,1-8.8,5,26.37,26.37,0,0,1-9.5,1.71A23.31,23.31,0,0,1,250,83.36a21.71,21.71,0,0,1-6.85-16.23A23,23,0,0,1,266.25,44.2,22.53,22.53,0,0,1,278,47.46,20.66,20.66,0,0,1,286.2,56.22Zm-12-1.58a11.3,11.3,0,0,0-8-3A14.91,14.91,0,0,0,251.5,66.4l0,1.55Zm46.68-10.36-3.91,8H315.6q-7.12,0-10.33,5.5-2.68,4.54-2.69,12.45V88.34l-8,1.12V46.08l8-1.2v8.85a18.47,18.47,0,0,1,5.95-7.3,15.08,15.08,0,0,1,8.8-2.49c.58,0,1.17,0,1.78.08S320.31,44.17,320.89,44.28Zm48.93,58.58-7.8.94V83.27a20.85,20.85,0,0,1-15.6,6.7,21.12,21.12,0,0,1-16.08-6.82,23,23,0,0,1-6.4-16.28,22.18,22.18,0,0,1,6.49-15.93,22,22,0,0,1,24.18-5.11A27.34,27.34,0,0,1,362,50.64V46l7.8-1.2ZM362,67a14.56,14.56,0,0,0-4.51-11,15.62,15.62,0,0,0-11.19-4.29,13,13,0,0,0-9.94,4.51,14.91,14.91,0,0,0-4.12,10.35,15.69,15.69,0,0,0,4,11,12.94,12.94,0,0,0,10,4.38,15.72,15.72,0,0,0,11.41-4.25A14.29,14.29,0,0,0,362,67Zm57,21.3-8,1.11v-6a21.28,21.28,0,0,1-6.22,5A17,17,0,0,1,397.18,90q-6.69,0-10.7-4.12-4.26-4.38-4.26-11.94V46l8-1.2V73.91a7.15,7.15,0,0,0,2.61,5.84,10.18,10.18,0,0,0,6.71,2.15A10.46,10.46,0,0,0,408,78.29q3-3.6,3-9.79V46l8-1.2ZM440.5,33.7l-5.2,6.69-5.47-6.69L435.3,27Zm-1.3,54.64-8,1.12V46.08l8-1.2Zm39-11.42a11.66,11.66,0,0,1-4.38,9.4,16.53,16.53,0,0,1-11,3.65,18.7,18.7,0,0,1-8.46-1.8,19.77,19.77,0,0,1-6.63-5.67l5.89-4.81a14.22,14.22,0,0,0,4,3,10.37,10.37,0,0,0,4.77,1.16,9.67,9.67,0,0,0,5-1.2,4.65,4.65,0,0,0,2.42-4.21q0-4.12-10.66-7.13T448.5,57.25A11.66,11.66,0,0,1,453,47.93a16,16,0,0,1,10.63-3.73,17,17,0,0,1,7.07,1.54A20.85,20.85,0,0,1,476.77,50l-5.11,5.75a17.93,17.93,0,0,0-3.86-2.92,8.86,8.86,0,0,0-4.3-1.11A8.21,8.21,0,0,0,458.82,53a4.57,4.57,0,0,0-2,4.08q0,3.87,10.67,6.87T478.16,76.92Z\"/><path class=\"cls-5\" d=\"M72,84.85A623.32,623.32,0,0,0,7.5,33.45v1.1C32.86,52.33,54,69.85,72,87.55Z\"/><path class=\"cls-5\" d=\"M72,82.16a551.86,551.86,0,0,0-48.53-55H22.16A444.42,444.42,0,0,1,72,86.12Z\"/><path class=\"cls-5\" d=\"M72,56.29c-6.48-9.44-13.56-19.21-21.4-29.16H49.38C57.8,38,65.3,48.62,72,59.15Z\"/><rect class=\"cls-6\" x=\"7.5\" y=\"102.38\" width=\"64.54\" height=\"64.46\"/><rect class=\"cls-6\" x=\"82.83\" y=\"27.13\" width=\"64.46\" height=\"64.46\"/><rect class=\"cls-6\" x=\"7.54\" y=\"27.13\" width=\"64.46\" height=\"64.46\"/><path class=\"cls-5\" d=\"M94,91.59c-3.45-6.15-7.16-12.47-11.12-18.87v4.13c2.78,5,5.48,9.85,8,14.74Z\"/><rect class=\"cls-6\" x=\"82.83\" y=\"102.38\" width=\"64.46\" height=\"64.46\"/><path class=\"cls-7\" d=\"M137,38.59c-2.36,1.43,2.61,4.47,3.2,5.4,0,0,4.47,2.27,3.12,2.86s-.51,1.94-2,1.43c-7.92-3-3.37,3.54-1,3,1.26-.26,3.79,3.7.25,4.46-1.52.34-20-3.62-18.2-2.36,2.69,1.86,19.8,6.83,17,8.85-1.1.76-18.54-7.16-17.53-3.71,1.35,4.72,20.9,5.14,22.92,13.23.42,1.52-12.22-3.37-11.88-3,5.06,7.5-1.52,3.54-4.89,3.88s10.87,6.06,11.21,7.5c.59,2.19-6.66,12.47-7.75,8.34s-7.92-3.79-8.18-7.42c-.33-3.45,11.55,2.7,11.46,1.77-.16-4.8-15.25-9.69-19.8-13.31-2.27-1.77-2.19-5.39,2-3.37,2,1,7.59,4.3,9.61,2.7,2.95-2.53-16.09-9.27-19.89-12.64-1.09-.93-9.6-7-1.17-8.09,8.84-1.18,27.72,1.6,27.72,1.18-.42-2.45-2.95-2.61-5.14-3.2-5.65-1.35-35.22-5.23-29-7.08s16.1.5,26,1.85c3.29.42,6.24,1.52,6,.51s1.09-1.27-.26-2.53c-1.51-1.52-22.49-4.55-21.82-6.07s2.7-2.27,5.31-2.78c.93-.25-1.35-2-1.35-2-3-1.26-12-.84-10.62-2.87,1.52-2.1,15.51,1.77,11.21-1-5.65-3.7-18.2-8.09-19.8-9.86v-.59h.08c5.06-3.2,20.56,8.52,21.15,4.64.26-1.6-5.22-3.79-5.64-5.06-4-10.44,44.82,14.33,27.72,25.28m-3.62,52v0Z\"/><path class=\"cls-8\" d=\"M154.87,192.54c-12.38-25.37-29.15-51.23-53-77.69-3.71-4-7.5-8.17-11.54-12.3H86.54l2.69,3c23.51,26.12,47.19,62.43,59.49,87.54ZM72,84.85A662.88,662.88,0,0,0,0,28.14l2.27,2.7C29.91,49.88,52.83,68.67,72,87.55Z\"/><path class=\"cls-8\" d=\"M129.59,192.37c-7.83-26.8-20-54.6-39-84-1.26-1.94-2.53-3.87-3.88-5.81H82.91c17.45,28.31,33.2,64.46,40.53,89.48ZM72,82.16C54.52,59.15,32.44,34.88,4.8,8.93l1.77,3C34,37.58,55.19,62,72,86Z\"/><path class=\"cls-8\" d=\"M130.94,194c-4.63-27.39-13.48-56.12-29-87.13-.68-1.43-1.44-2.86-2.11-4.29H96.14C109.71,132,120.58,168.1,124.88,193ZM94,91.68c-3.46-6.15-7.17-12.39-11.13-18.79V77c2.78,4.89,5.48,9.86,7.92,14.67ZM72,56.29A658.56,658.56,0,0,0,28.4,0l1.43,3.12A507.6,507.6,0,0,1,72,59.15Z\"/></svg>'),
(2, 'Footer', 'S+A-Iconwhite.svg', '<svg id=\"Layer_1\" data-name=\"Layer 1\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 265.72 332.8\"><defs><style>.cls-1{fill:#959743;}.cls-2{fill:#fff;}.cls-3{fill:#e5a724;fill-rule:evenodd;}.cls-4{fill:#98a539;}</style></defs><path class=\"cls-1\" d=\"M123.61,145.58C92.52,117,56,87.61,12.87,57.39v1.88c43.51,30.51,79.8,60.58,110.74,90.94Z\"/><path class=\"cls-1\" d=\"M123.61,141A948.88,948.88,0,0,0,40.33,46.55H38c34.41,34.55,62.45,68.09,85.59,101.2Z\"/><path class=\"cls-1\" d=\"M123.61,96.57c-11.14-16.19-23.28-33-36.72-50H84.72C99.17,65.2,112,83.42,123.61,101.49Z\"/><rect class=\"cls-2\" x=\"12.87\" y=\"175.65\" width=\"110.74\" height=\"110.59\"/><rect class=\"cls-2\" x=\"142.11\" y=\"46.55\" width=\"110.59\" height=\"110.59\"/><rect class=\"cls-2\" x=\"12.94\" y=\"46.55\" width=\"110.59\" height=\"110.59\"/><path class=\"cls-1\" d=\"M161.19,157.15c-5.92-10.56-12.29-21.4-19.08-32.39v7.09c4.77,8.53,9.4,16.91,13.73,25.3Z\"/><rect class=\"cls-2\" x=\"142.11\" y=\"175.65\" width=\"110.59\" height=\"110.59\"/><path class=\"cls-3\" d=\"M235.07,66.21c-4,2.46,4.48,7.67,5.49,9.26,0,0,7.66,3.9,5.35,4.91-2.46.87-.87,3.33-3.47,2.46-13.59-5.06-5.78,6.07-1.73,5.2,2.16-.43,6.5,6.36.43,7.67-2.6.57-34.26-6.22-31.23-4,4.63,3.18,34,11.71,29.21,15.18-1.88,1.3-31.81-12.29-30.07-6.36,2.31,8.09,35.85,8.81,39.32,22.69.72,2.6-21-5.78-20.39-5.06,8.68,12.87-2.6,6.07-8.38,6.65-5.93.58,18.65,10.41,19.23,12.87,1,3.76-11.42,21.4-13.3,14.31s-13.59-6.5-14-12.72c-.57-5.93,19.81,4.63,19.66,3-.28-8.24-26.16-16.63-34-22.85-3.9-3-3.76-9.25,3.47-5.78,3.47,1.74,13,7.37,16.48,4.63,5.06-4.34-27.61-15.9-34.12-21.69-1.88-1.59-16.48-12-2-13.88,15.18-2,47.56,2.75,47.56,2-.72-4.19-5.06-4.48-8.82-5.5-9.68-2.31-60.43-9-49.73-12.14s27.62.87,44.53,3.18c5.64.72,10.7,2.6,10.26.87s1.88-2.17-.43-4.34c-2.6-2.6-38.6-7.81-37.44-10.41s4.62-3.9,9.11-4.77c1.59-.43-2.32-3.47-2.32-3.47-5.2-2.17-20.53-1.44-18.21-4.91,2.6-3.62,26.6,3,19.22-1.74-9.68-6.36-31.22-13.88-34-16.91v-1h.14c8.68-5.5,35.28,14.6,36.29,8,.44-2.75-9-6.51-9.68-8.68-6.8-17.92,76.91,24.58,47.56,43.37m-6.22,89.2v0Z\"/><path class=\"cls-4\" d=\"M265.72,330.34c-21.26-43.52-50-87.9-90.94-133.29-6.36-6.94-12.86-14-19.8-21.11h-6.51L153.1,181c40.33,44.82,81,107.13,102.06,150.21ZM123.61,145.58C89.34,114.21,48.72,81.83,0,48.29l3.9,4.62c47.42,32.68,86.74,64.91,119.71,97.3Z\"/><path class=\"cls-4\" d=\"M222.35,330.05c-13.45-46-34.27-93.68-66.94-144.13-2.17-3.33-4.34-6.65-6.65-10h-6.5c29.92,48.58,57,110.6,69.53,153.53ZM123.61,141C93.54,101.49,55.66,59.85,8.24,15.33l3,5.2c47,44,83.41,85.87,112.33,127.08Z\"/><path class=\"cls-4\" d=\"M224.66,332.8c-7.95-47-23.13-96.29-49.73-149.49-1.16-2.45-2.46-4.91-3.62-7.37H165c23.28,50.45,41.93,112.47,49.3,155.27ZM161.34,157.29c-5.93-10.55-12.29-21.25-19.08-32.24v7.09c4.77,8.38,9.39,16.91,13.59,25.15ZM123.61,96.57A1135.54,1135.54,0,0,0,48.72,0l2.46,5.35a872,872,0,0,1,72.43,96.14Z\"/></svg>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `url_string` varchar(255) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `url_string`, `tag_name`) VALUES
(1, 'concrete', 'Concrete'),
(2, 'contemporary', 'Contemporary'),
(3, 'desert', 'Desert'),
(4, 'fence', 'Fence'),
(5, 'firepit', 'FirePit'),
(6, 'metal', 'Metal'),
(7, 'native-plants', 'Native Plants'),
(8, 'parade-of-homes', 'Parade of Homes'),
(9, 'patterns', 'Patterns'),
(10, 'sculpture', 'Sculpture'),
(11, 'water-feature', 'Water Feature'),
(12, 'custom-design', 'Custom Design'),
(13, 'ludic-landscapes', 'Ludic Landscapes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `testimonial_title` varchar(255) DEFAULT NULL,
  `testimonial_name` varchar(255) DEFAULT NULL,
  `testimonial_text` text DEFAULT NULL,
  `date_posted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `testimonials`
--

INSERT INTO `testimonials` (`id`, `testimonial_title`, `testimonial_name`, `testimonial_text`, `date_posted`) VALUES
(1, 'PROFESSIONAL AND CREATIVE', 'Prull Custom Builders', 'Solange is an extremely talented and thoughtful Landscape Architect, often being challenged by the difficult New Mexico terrain. It not only takes a trained eye from a design & aesthetics perspective, but also the experience and knowledge of the local environment in which to plan for the long term, consistently delivering a successful result. Each project is uniquely designed to the specifications of both the owners and the elements of their home. Solange and her team are incredibly professional and creative in each & every execution, which is why we consider them one of our valued preferred partners. They are a pleasure to work with, regardless of project scale or size.', '2019-07-11'),
(2, 'passionate landscape architect', 'Gabriel Browne Architect & Builder Praxis', 'Solange is a passionate designer, and a consummate professional. In twenty years as an Architect, I have never met a landscape architects with such talent, passion, and professionalism. I recommend her wholeheartedly, and look forward to our next chance to work together.', '2021-08-03'),
(3, 'A cohesive signature design', 'Sibley', 'Solange and her Team brought incredible creativity and vision to our whole house re-landscaping project. Able to look beyond what had been put in place previously, they recycled plants and materials while creating a cohesive signature design. They were equally attentive during installation and worked well in the field solving problems, adjusting design elements, and evolving concepts. I had one disappointment at the end of the project: my time with this wonderful group of people was at an end.', '2020-07-15'),
(4, 'gift to landscaping in santa fe', 'Pat Stanley', 'Solange is a gifted landscape architect. She is an excellent communicator and listener. She was very thorough in learning about my needs and took special care to be on site multiple times before she presented a design. She created a unique and outstanding solution to both the entrance to the house and the back patio— both difficult areas– and connected them through the use of creative and stunning hardscape. In addition, it was a pleasure to work with her. She is upbeat, fun, enthusiastic, smart, creative, patient and hard working. No matter what the problem she was there for me and readily solved whatever issue was at hand. I could not recommend her more highly. I think she is a gift to landscaping here in Santa Fe!', '2021-05-25'),
(5, 'a pleasure to work with', 'Catherine Mahoney-Myron', 'Solange did an amazing job on the landscape design for our house! It perfectly reflects the home design, it’s beautiful and easy to maintain. Our site has several level changes and Solange made amazing spaces that flow beautifully from one area to another. Every vantage point is a unique and gorgeous space. Solange and her entire crew are a pleasure to work with.', '2021-05-25'),
(6, 'from blank slate to beautiful backyard', 'Cindy Thomas', 'Our home was a new build and our backyard was a blank slate of dirt and weeds. Solange made it her top priority to understand our taste and how we hoped to utilize the space. She then created a design that exceeded anything I could imagine. We had Solange and her team oversee the installation as well. She was frequently onsite making sure every detail was right. I could not be happier with the work Serquis + Associates did.', '2020-11-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_administrators`
--

CREATE TABLE `trongate_administrators` (
  `id` int(11) NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `trongate_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trongate_administrators`
--

INSERT INTO `trongate_administrators` (`id`, `username`, `password`, `trongate_user_id`) VALUES
(1, 'admin', '$2y$11$SoHZDvbfLSRHAi3WiKIBiu.tAoi/GCBBO4HRxVX1I3qQkq3wCWfXi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_comments`
--

CREATE TABLE `trongate_comments` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `date_created` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `target_table` varchar(125) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_tokens`
--

CREATE TABLE `trongate_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(125) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `expiry_date` int(11) DEFAULT NULL,
  `code` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trongate_tokens`
--

INSERT INTO `trongate_tokens` (`id`, `token`, `user_id`, `expiry_date`, `code`) VALUES
(62, 'szj2h2yCEiQUAGv9gJQq-bUTWLKxHb9V', 1, 1641231592, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_users`
--

CREATE TABLE `trongate_users` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trongate_users`
--

INSERT INTO `trongate_users` (`id`, `code`, `user_level_id`) VALUES
(1, 'v9hEDQytDqJdWKuM68wqYWuXv5NSGdtM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trongate_user_levels`
--

CREATE TABLE `trongate_user_levels` (
  `id` int(11) NOT NULL,
  `level_title` varchar(125) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trongate_user_levels`
--

INSERT INTO `trongate_user_levels` (`id`, `level_title`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `website_owners`
--

CREATE TABLE `website_owners` (
  `id` int(11) NOT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `website_address` varchar(255) DEFAULT NULL,
  `website_address_2` varchar(255) DEFAULT NULL,
  `website_phone` varchar(20) DEFAULT NULL,
  `website_email` varchar(255) DEFAULT NULL,
  `houzz_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `trailhead_link` varchar(255) DEFAULT NULL,
  `facebook__google_scripts` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `website_owners`
--

INSERT INTO `website_owners` (`id`, `owner`, `website_name`, `website_address`, `website_address_2`, `website_phone`, `website_email`, `houzz_link`, `facebook_link`, `instagram_link`, `trailhead_link`, `facebook__google_scripts`, `picture`) VALUES
(1, 'Serquis + Associates', 'Serquis + Associates Landscape Architecture', '922A Shoofly St, Suite #201', 'Santa Fe, NM 87505', 'T: (505) 629 - 1009', 'contact@serquis.com', 'https://www.houzz.com/professionals/landscape-architects-and-landscape-designers/serquis-associates-landscape-architecture-pfvwus-pf~2080433733?', 'https://www.facebook.com/serquis.associates/', 'https://www.instagram.com/serquis.associates/?hl=es', 'https://www.trailheadsantafe.com/', '(function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0\"; fjs.parentNode.insertBefore(js, fjs); })(document, \"script\", \"facebook-jssdk\");', 'logo-typo serquislogo left big.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `affiliations`
--
ALTER TABLE `affiliations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_collaborators_and_collaborator_areas`
--
ALTER TABLE `associated_collaborators_and_collaborator_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_projects_and_categories`
--
ALTER TABLE `associated_projects_and_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_projects_and_clients`
--
ALTER TABLE `associated_projects_and_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_projects_and_collaborators`
--
ALTER TABLE `associated_projects_and_collaborators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `associated_projects_and_tags`
--
ALTER TABLE `associated_projects_and_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `collaborator_areas`
--
ALTER TABLE `collaborator_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `homepage_pictures`
--
ALTER TABLE `homepage_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `houzz_pictures`
--
ALTER TABLE `houzz_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_links`
--
ALTER TABLE `menu_links`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sections_texts`
--
ALTER TABLE `sections_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `svg_logos`
--
ALTER TABLE `svg_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_comments`
--
ALTER TABLE `trongate_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `website_owners`
--
ALTER TABLE `website_owners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `affiliations`
--
ALTER TABLE `affiliations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `associated_collaborators_and_collaborator_areas`
--
ALTER TABLE `associated_collaborators_and_collaborator_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `associated_projects_and_categories`
--
ALTER TABLE `associated_projects_and_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `associated_projects_and_clients`
--
ALTER TABLE `associated_projects_and_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `associated_projects_and_collaborators`
--
ALTER TABLE `associated_projects_and_collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `associated_projects_and_tags`
--
ALTER TABLE `associated_projects_and_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `collaborator_areas`
--
ALTER TABLE `collaborator_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `homepage_pictures`
--
ALTER TABLE `homepage_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `houzz_pictures`
--
ALTER TABLE `houzz_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `menu_links`
--
ALTER TABLE `menu_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sections_texts`
--
ALTER TABLE `sections_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `svg_logos`
--
ALTER TABLE `svg_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `trongate_administrators`
--
ALTER TABLE `trongate_administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_comments`
--
ALTER TABLE `trongate_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trongate_tokens`
--
ALTER TABLE `trongate_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `trongate_users`
--
ALTER TABLE `trongate_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `trongate_user_levels`
--
ALTER TABLE `trongate_user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `website_owners`
--
ALTER TABLE `website_owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
