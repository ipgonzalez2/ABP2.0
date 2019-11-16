-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2019 a las 17:18:25
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `padel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `fecha_calendario` date NOT NULL,
  `pista_calendario` int(10) NOT NULL,
  `estado_calendario` enum('libre','ocupado') COLLATE latin1_spanish_ci NOT NULL,
  `hora_calendario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

CREATE TABLE `campeonato` (
  `id_campeonato` int(10) NOT NULL,
  `nombre_campeonato` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio_campeonato` float(10,2) NOT NULL,
  `fecha_limite_inscripcion` date NOT NULL,
  `estado_campeonato` enum('abierto','cerrado') COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`id_campeonato`, `nombre_campeonato`, `fecha_inicio`, `fecha_fin`, `precio_campeonato`, `fecha_limite_inscripcion`, `estado_campeonato`) VALUES
(1, 'campeonato 1', '2019-11-18', '2019-12-08', 12.00, '2019-11-15', 'abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorianivel`
--

CREATE TABLE `categorianivel` (
  `id_categorianivel` int(10) NOT NULL,
  `categoria` enum('masculina','femenina','mixto') COLLATE latin1_spanish_ci DEFAULT NULL,
  `nivel` enum('1','2','3') COLLATE latin1_spanish_ci DEFAULT NULL,
  `campeonato` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categorianivel`
--

INSERT INTO `categorianivel` (`id_categorianivel`, `categoria`, `nivel`, `campeonato`) VALUES
(1, 'masculina', '1', 1),
(2, 'femenina', '1', 1),
(3, 'mixto', '1', 1),
(4, 'masculina', '2', 1),
(5, 'femenina', '2', 1),
(6, 'mixto', '2', 1),
(7, 'masculina', '3', 1),
(8, 'femenina', '3', 1),
(9, 'mixto', '3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcionpartido`
--

CREATE TABLE `inscripcionpartido` (
  `id_inscripcion_partido` int(10) NOT NULL,
  `id_inscripcion_usuario` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id_notificacion` int(10) NOT NULL,
  `id_usuario_notificacion` int(10) NOT NULL,
  `mensaje` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(10) NOT NULL,
  `tipo_pago` enum('efectivo','tarjeta') COLLATE latin1_spanish_ci NOT NULL,
  `estado_pago` enum('realizado','pendiente') COLLATE latin1_spanish_ci NOT NULL,
  `reserva_pago` int(10) NOT NULL,
  `cantidad` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pareja`
--

CREATE TABLE `pareja` (
  `id_pareja` int(10) NOT NULL,
  `deportista1` int(10) NOT NULL,
  `deportista2` int(10) NOT NULL,
  `categorianivel` int(10) NOT NULL,
  `grupo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pareja`
--

INSERT INTO `pareja` (`id_pareja`, `deportista1`, `deportista2`, `categorianivel`, `grupo`) VALUES
(1, 2, 3, 3, NULL),
(2, 4, 5, 3, NULL),
(3, 6, 7, 2, NULL),
(4, 8, 9, 1, NULL),
(5, 10, 11, 3, NULL),
(6, 12, 13, 1, NULL),
(7, 14, 15, 1, NULL),
(8, 16, 17, 3, NULL),
(9, 18, 19, 1, NULL),
(10, 20, 21, 2, NULL),
(11, 22, 23, 3, NULL),
(12, 24, 25, 1, NULL),
(13, 26, 27, 3, NULL),
(14, 28, 29, 3, NULL),
(15, 30, 31, 2, NULL),
(16, 32, 33, 3, NULL),
(17, 34, 35, 2, NULL),
(18, 36, 37, 3, NULL),
(19, 38, 39, 3, NULL),
(20, 40, 41, 3, NULL),
(21, 42, 43, 2, NULL),
(22, 44, 45, 3, NULL),
(23, 46, 47, 2, NULL),
(24, 48, 49, 2, NULL),
(25, 50, 51, 3, NULL),
(26, 52, 53, 2, NULL),
(27, 54, 55, 3, NULL),
(28, 56, 57, 3, NULL),
(29, 58, 59, 3, NULL),
(30, 60, 61, 3, NULL),
(31, 62, 63, 1, NULL),
(32, 64, 65, 3, NULL),
(33, 66, 67, 2, NULL),
(34, 68, 69, 2, NULL),
(35, 70, 71, 2, NULL),
(36, 72, 73, 2, NULL),
(37, 74, 75, 3, NULL),
(38, 76, 77, 1, NULL),
(39, 78, 79, 3, NULL),
(40, 80, 81, 1, NULL),
(41, 82, 83, 2, NULL),
(42, 84, 85, 3, NULL),
(43, 86, 87, 2, NULL),
(44, 88, 89, 2, NULL),
(45, 90, 91, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id_partido` int(10) NOT NULL,
  `fecha_partido` date NOT NULL,
  `precio_partido` float(10,2) NOT NULL,
  `estado_partido` enum('abierto','cerrado') COLLATE latin1_spanish_ci NOT NULL,
  `fecha_fin_inscripcion` date NOT NULL,
  `hora_partido` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pista`
--

CREATE TABLE `pista` (
  `id_pista` int(10) NOT NULL,
  `tipo_pista` enum('abierta','cerrada') COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pista`
--

INSERT INTO `pista` (`id_pista`, `tipo_pista`) VALUES
(1, 'abierta'),
(2, 'abierta'),
(3, 'cerrada'),
(4, 'cerrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `precio` float(10,2) NOT NULL,
  `usuario_reserva` int(10) DEFAULT NULL,
  `pista_reserva` int(10) NOT NULL,
  `hora` time NOT NULL,
  `partido_reserva` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `username` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `passwd` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `rol` enum('administrador','deportista') COLLATE latin1_spanish_ci NOT NULL,
  `sexo` enum('hombre','mujer') COLLATE latin1_spanish_ci NOT NULL,
  `nivel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `passwd`, `nombre`, `email`, `rol`, `sexo`, `nivel`) VALUES
(1, 'admin', 'admin', '', '', 'administrador', 'hombre', 0),
(2, 'adene0', 'nnTeSMN', 'Alfreda Dene', 'adene0@marriott.com', 'deportista', 'mujer', 1),
(3, 'tpridgeon1', 'PShBJhL', 'Tom Pridgeon', 'tpridgeon1@chronoengine.com', 'deportista', 'hombre', 1),
(4, 'afurley2', 'YHTycQb', 'Alessandra Furley', 'afurley2@diigo.com', 'deportista', 'hombre', 1),
(5, 'efer3', 'sTwMuzrIm', 'Eugenio Fer', 'efer3@guardian.co.uk', 'deportista', 'mujer', 1),
(6, 'mheine4', 'zKNqHMy', 'Mona Heine', 'mheine4@upenn.edu', 'deportista', 'mujer', 1),
(7, 'dsiflet5', '7wflpOuP6', 'Drusie Siflet', 'dsiflet5@woothemes.com', 'deportista', 'mujer', 1),
(8, 'dcarnell6', '9xIdL2nUQXlE', 'Dollie Carnell', 'dcarnell6@cnbc.com', 'deportista', 'hombre', 1),
(9, 'akohnen7', 'UhMw2msmL', 'Angelico Kohnen', 'akohnen7@amazon.com', 'deportista', 'hombre', 1),
(10, 'bgallagher8', 'uhJj8F', 'Bard Gallagher', 'bgallagher8@sogou.com', 'deportista', 'hombre', 1),
(11, 'csarra9', 'jajXst', 'Clayborne Sarra', 'csarra9@jimdo.com', 'deportista', 'mujer', 1),
(12, 'vchippa', 'UV4eoLSph', 'Valeda Chipp', 'vchippa@prweb.com', 'deportista', 'hombre', 1),
(13, 'hrichardetb', 'ZL1hk31Kw', 'Harrietta Richardet', 'hrichardetb@twitter.com', 'deportista', 'hombre', 1),
(14, 'pmogenotc', 'Tbc9HuUpjw4A', 'Percival Mogenot', 'pmogenotc@wired.com', 'deportista', 'hombre', 1),
(15, 'sprebbled', '1i6uLZAVX259', 'Skylar Prebble', 'sprebbled@is.gd', 'deportista', 'hombre', 1),
(16, 'jgandere', 'EnmdApQ6', 'Jan Gander', 'jgandere@bigcartel.com', 'deportista', 'hombre', 1),
(17, 'garchanbaultf', 'Ydh6f3FfZs', 'Gabbey Archanbault', 'garchanbaultf@mapquest.com', 'deportista', 'mujer', 1),
(18, 'jyardg', 'T8DnpL', 'Jillayne Yard', 'jyardg@statcounter.com', 'deportista', 'hombre', 1),
(19, 'klangtonh', 'l5wsD1p5VuN', 'Kurt Langton', 'klangtonh@irs.gov', 'deportista', 'hombre', 1),
(20, 'dfitcheti', 'kcfWlze', 'Daphene Fitchet', 'dfitcheti@hatena.ne.jp', 'deportista', 'mujer', 1),
(21, 'rbrabenderj', 'iJNcOV36TPY1', 'Renaldo Brabender', 'rbrabenderj@mysql.com', 'deportista', 'mujer', 1),
(22, 'hhenworthk', 'WyFa7fzV8y', 'Harris Henworth', 'hhenworthk@cpanel.net', 'deportista', 'hombre', 1),
(23, 'jcallenderl', 'vs5O47Gn4KhJ', 'Joice Callender', 'jcallenderl@scribd.com', 'deportista', 'mujer', 1),
(24, 'aokellm', 'nT1rzx7EEXtn', 'Adelind Okell', 'aokellm@mashable.com', 'deportista', 'hombre', 1),
(25, 'ograndn', 'A7kQcUW2ci', 'Ola Grand', 'ograndn@squidoo.com', 'deportista', 'hombre', 1),
(26, 'jcatoo', 'Ce96bn', 'Jeannette Cato', 'jcatoo@army.mil', 'deportista', 'mujer', 1),
(27, 'mratcliffep', 'qw6FWdTp9s', 'Morgen Ratcliffe', 'mratcliffep@ifeng.com', 'deportista', 'hombre', 1),
(28, 'badamovitzq', 'Q2dr1fEcxfin', 'Brady Adamovitz', 'badamovitzq@ftc.gov', 'deportista', 'mujer', 1),
(29, 'kgeorgievr', 'BGZ2NQaZ4kSc', 'Kip Georgiev', 'kgeorgievr@google.com.au', 'deportista', 'hombre', 1),
(30, 'pbrufords', '9QkFVWWiK', 'Phillida Bruford', 'pbrufords@howstuffworks.com', 'deportista', 'mujer', 1),
(31, 'drihanekt', 'TZGEjHYy', 'Davin Rihanek', 'drihanekt@nba.com', 'deportista', 'mujer', 1),
(32, 'kroostanu', '37qGE2Qffb', 'Katlin Roostan', 'kroostanu@a8.net', 'deportista', 'hombre', 1),
(33, 'lmansonv', '7a4WhfSYL', 'Lorne Manson', 'lmansonv@example.com', 'deportista', 'mujer', 1),
(34, 'hgendrickew', 'U6yl0Kz0y', 'Hew Gendricke', 'hgendrickew@t.co', 'deportista', 'mujer', 1),
(35, 'mlobx', 'UXjkW2p', 'Marena Lob', 'mlobx@yahoo.com', 'deportista', 'mujer', 1),
(36, 'psearjeanty', 'wHnw5zvnk', 'Prudy Searjeant', 'psearjeanty@berkeley.edu', 'deportista', 'mujer', 1),
(37, 'jbunningz', 'NH3LeYtsPG', 'Jordana Bunning', 'jbunningz@linkedin.com', 'deportista', 'hombre', 1),
(38, 'llocks10', 'FafKPuL50X', 'Land Locks', 'llocks10@cloudflare.com', 'deportista', 'hombre', 1),
(39, 'lpymar11', 'laJn25', 'Liv Pymar', 'lpymar11@multiply.com', 'deportista', 'mujer', 1),
(40, 'kposse12', 'Mf7wFJpleXHy', 'Kandy Posse', 'kposse12@moonfruit.com', 'deportista', 'hombre', 1),
(41, 'fspeke13', 'zw7ve7', 'Farly Speke', 'fspeke13@macromedia.com', 'deportista', 'mujer', 1),
(42, 'putteridge14', 'sMJQjYi6VGg', 'Pembroke Utteridge', 'putteridge14@blogtalkradio.com', 'deportista', 'mujer', 1),
(43, 'sdukesbury15', 'BWm0OEnwXA0h', 'Scotty Dukesbury', 'sdukesbury15@weebly.com', 'deportista', 'mujer', 1),
(44, 'rmouth16', '6kGqo7V', 'Rollie Mouth', 'rmouth16@jimdo.com', 'deportista', 'mujer', 1),
(45, 'hdackombe17', 'dw0kLO4Jzz', 'Honor Dackombe', 'hdackombe17@scribd.com', 'deportista', 'hombre', 1),
(46, 'rdinkin18', 'sVNm5z6BKHy', 'Rodney Dinkin', 'rdinkin18@networksolutions.com', 'deportista', 'mujer', 1),
(47, 'cspreadbury19', 'MmTuyvj0Hzw', 'Carolyn Spreadbury', 'cspreadbury19@digg.com', 'deportista', 'mujer', 1),
(48, 'tgrishinov1a', 'rhSiHt9zIpK', 'Teressa Grishinov', 'tgrishinov1a@usatoday.com', 'deportista', 'mujer', 1),
(49, 'ckullmann1b', 'Gp1kqf0dp3', 'Claus Kullmann', 'ckullmann1b@cbc.ca', 'deportista', 'mujer', 1),
(50, 'ccowlin1c', 'kp8voqfJs6', 'Chlo Cowlin', 'ccowlin1c@sciencedaily.com', 'deportista', 'hombre', 1),
(51, 'ddingle1d', 'hjZ1qvZAD9U', 'Darline Dingle', 'ddingle1d@google.com.au', 'deportista', 'mujer', 1),
(52, 'lheugh1e', 'IrKlBooxoi', 'Louisa Heugh', 'lheugh1e@flickr.com', 'deportista', 'mujer', 1),
(53, 'jmckerrow1f', 'JHLTemN', 'Joice McKerrow', 'jmckerrow1f@smugmug.com', 'deportista', 'mujer', 1),
(54, 'lheineking1g', '4CVq0FlAU', 'Luella Heineking', 'lheineking1g@etsy.com', 'deportista', 'mujer', 1),
(55, 'killes1h', 'SeRrR9cZiNY', 'Kayle Illes', 'killes1h@hubpages.com', 'deportista', 'hombre', 1),
(56, 'blumby1i', 'k8RfG2DX26i', 'Brittaney Lumby', 'blumby1i@illinois.edu', 'deportista', 'hombre', 1),
(57, 'gcarneck1j', 'dmy17IFTmoO', 'Gwennie Carneck', 'gcarneck1j@parallels.com', 'deportista', 'mujer', 1),
(58, 'ljan1k', 'bJ7EykcJMaLo', 'Leroi Jan', 'ljan1k@nih.gov', 'deportista', 'hombre', 1),
(59, 'edelgardo1l', '6YGg41Eapl', 'Enrichetta Delgardo', 'edelgardo1l@shinystat.com', 'deportista', 'mujer', 1),
(60, 'mscotchmer1m', 'aLMUtwfDsIJ', 'Mannie Scotchmer', 'mscotchmer1m@weebly.com', 'deportista', 'mujer', 1),
(61, 'slinturn1n', 'Ms6Un5', 'Sayres Linturn', 'slinturn1n@weebly.com', 'deportista', 'hombre', 1),
(62, 'lwhifen1o', 'FkJhRZh', 'Lelah Whifen', 'lwhifen1o@mayoclinic.com', 'deportista', 'hombre', 1),
(63, 'aflieg1p', 'pRtuTjNxx8', 'Amalie Flieg', 'aflieg1p@technorati.com', 'deportista', 'hombre', 1),
(64, 'eleethem1q', 'tkNtBthq4gol', 'Ebenezer Leethem', 'eleethem1q@amazon.co.jp', 'deportista', 'hombre', 1),
(65, 'sscartifield1r', 'KB0O2Ddr', 'Shea Scartifield', 'sscartifield1r@forbes.com', 'deportista', 'mujer', 1),
(66, 'epotte1s', 'jZDv4r2', 'Essa Potte', 'epotte1s@studiopress.com', 'deportista', 'mujer', 1),
(67, 'gbeynke1t', 'VEsFEes93', 'Giffard Beynke', 'gbeynke1t@feedburner.com', 'deportista', 'mujer', 1),
(68, 'apoints1u', 'a8DxDzFOLK52', 'Agneta Points', 'apoints1u@privacy.gov.au', 'deportista', 'mujer', 1),
(69, 'fdaintry1v', '34fWngINfk', 'Falito Daintry', 'fdaintry1v@salon.com', 'deportista', 'mujer', 1),
(70, 'bfewless1w', 'cpAhRHx', 'Bianca Fewless', 'bfewless1w@buzzfeed.com', 'deportista', 'mujer', 1),
(71, 'mboncoeur1x', 'eUZgoZI', 'Murvyn Boncoeur', 'mboncoeur1x@dell.com', 'deportista', 'mujer', 1),
(72, 'mshuttle1y', 'pFfqTQ4QA', 'Modesta Shuttle', 'mshuttle1y@google.fr', 'deportista', 'mujer', 1),
(73, 'tstrugnell1z', '6qs6F0vIRz', 'Trace Strugnell', 'tstrugnell1z@pen.io', 'deportista', 'mujer', 1),
(74, 'etoolan20', 'HSpqVChaqC', 'Eric Toolan', 'etoolan20@chicagotribune.com', 'deportista', 'hombre', 1),
(75, 'mzelley21', '0O5zyLI5hFPf', 'Merlina Zelley', 'mzelley21@umn.edu', 'deportista', 'mujer', 1),
(76, 'syaakov22', 'dEZd6Zfrylm', 'Shanda Yaakov', 'syaakov22@phoca.cz', 'deportista', 'hombre', 1),
(77, 'shewertson23', 'ZiugVK', 'Skipp Hewertson', 'shewertson23@over-blog.com', 'deportista', 'hombre', 1),
(78, 'csterte24', '3uBMNN', 'Christian Sterte', 'csterte24@goo.ne.jp', 'deportista', 'hombre', 1),
(79, 'cmatresse25', 'O99BmHRS4', 'Chanda Matresse', 'cmatresse25@ftc.gov', 'deportista', 'mujer', 1),
(80, 'gflorence26', 'a2I0Awu', 'Gary Florence', 'gflorence26@ycombinator.com', 'deportista', 'hombre', 1),
(81, 'vlow27', '7luQTNg9', 'Valentino Low', 'vlow27@barnesandnoble.com', 'deportista', 'hombre', 1),
(82, 'mfoskew28', 'toflG8tB', 'Mathew Foskew', 'mfoskew28@google.ca', 'deportista', 'mujer', 1),
(83, 'echesters29', 'alQSVW8qu7B', 'Elane Chesters', 'echesters29@blogspot.com', 'deportista', 'mujer', 1),
(84, 'vsmieton2a', 'cOpTnPSK', 'Vincenz Smieton', 'vsmieton2a@discovery.com', 'deportista', 'hombre', 1),
(85, 'figlesiaz2b', 'Ek1zgSVMvi', 'Flem Iglesiaz', 'figlesiaz2b@surveymonkey.com', 'deportista', 'mujer', 1),
(86, 'amuehler2c', 'zX7CNcrF5qR', 'Amos Muehler', 'amuehler2c@google.ca', 'deportista', 'mujer', 1),
(87, 'sle2d', 'NyknfcAwPa', 'Sim Le Provest', 'sle2d@vinaora.com', 'deportista', 'mujer', 1),
(88, 'dstrutt2e', 'atirGzZks', 'Daisie Strutt', 'dstrutt2e@google.co.jp', 'deportista', 'mujer', 1),
(89, 'gelvey2f', '558pCKwCz32', 'Gertruda Elvey', 'gelvey2f@de.vu', 'deportista', 'mujer', 1),
(90, 'umirfield2g', 'sp7GwsOfpTHd', 'Ursala Mirfield', 'umirfield2g@addthis.com', 'deportista', 'mujer', 1),
(91, 'jcoldbath2h', 'VRypWNnb', 'Juliet Coldbath', 'jcoldbath2h@va.gov', 'deportista', 'hombre', 1),
(92, 'alillyman2i', 'Seg4Ga', 'Andreas Lillyman', 'alillyman2i@va.gov', 'deportista', 'mujer', 1),
(93, 'swakelin2j', 'qpcBuSIH', 'Sylas Wakelin', 'swakelin2j@ox.ac.uk', 'deportista', 'hombre', 1),
(94, 'cdoxey2k', 'SDI7OZ', 'Cirilo Doxey', 'cdoxey2k@upenn.edu', 'deportista', 'hombre', 1),
(95, 'fmonkeman2l', 'V4FVKwZL', 'Florella Monkeman', 'fmonkeman2l@cpanel.net', 'deportista', 'mujer', 1),
(96, 'lickovic2m', '5wl14NCw4mCZ', 'Lennard Ickovic', 'lickovic2m@elegantthemes.com', 'deportista', 'hombre', 1),
(97, 'brevans2n', 'MIVOXca', 'Basile Revans', 'brevans2n@blogger.com', 'deportista', 'hombre', 1),
(98, 'tbritcher2o', 'd0yXIDHzS', 'Tremayne Britcher', 'tbritcher2o@sohu.com', 'deportista', 'mujer', 1),
(99, 'kcurtois2p', 'xLx7Omt7SFe', 'Koren Curtois', 'kcurtois2p@list-manage.com', 'deportista', 'hombre', 1),
(100, 'nclamo2q', 'IoDk0U', 'Nanci Clamo', 'nclamo2q@prnewswire.com', 'deportista', 'hombre', 1),
(101, 'chovel2r', 'RNDW1CeYRU', 'Catlaina Hovel', 'chovel2r@artisteer.com', 'deportista', 'mujer', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`fecha_calendario`,`hora_calendario`,`pista_calendario`),
  ADD KEY `fk_pista_calendario` (`pista_calendario`);

--
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`id_campeonato`);

--
-- Indices de la tabla `categorianivel`
--
ALTER TABLE `categorianivel`
  ADD PRIMARY KEY (`id_categorianivel`),
  ADD KEY `fk_campeonato` (`campeonato`);

--
-- Indices de la tabla `inscripcionpartido`
--
ALTER TABLE `inscripcionpartido`
  ADD PRIMARY KEY (`id_inscripcion_partido`,`id_inscripcion_usuario`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `fk_usuario_notificacion` (`id_usuario_notificacion`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_reserva` (`reserva_pago`);

--
-- Indices de la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD PRIMARY KEY (`id_pareja`),
  ADD KEY `fk_deportista1` (`deportista1`),
  ADD KEY `fk_deportista2` (`deportista2`),
  ADD KEY `fk_categorianivel` (`categorianivel`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id_partido`);

--
-- Indices de la tabla `pista`
--
ALTER TABLE `pista`
  ADD PRIMARY KEY (`id_pista`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_usuario` (`usuario_reserva`),
  ADD KEY `fk_pista` (`pista_reserva`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `id_campeonato` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorianivel`
--
ALTER TABLE `categorianivel`
  MODIFY `id_categorianivel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id_notificacion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pareja`
--
ALTER TABLE `pareja`
  MODIFY `id_pareja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id_partido` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pista`
--
ALTER TABLE `pista`
  MODIFY `id_pista` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `fk_pista_calendario` FOREIGN KEY (`pista_calendario`) REFERENCES `pista` (`id_pista`) ON DELETE CASCADE;

--
-- Filtros para la tabla `categorianivel`
--
ALTER TABLE `categorianivel`
  ADD CONSTRAINT `fk_campeonato` FOREIGN KEY (`campeonato`) REFERENCES `campeonato` (`id_campeonato`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `fk_usuario_notificacion` FOREIGN KEY (`id_usuario_notificacion`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_reserva` FOREIGN KEY (`reserva_pago`) REFERENCES `reserva` (`id_reserva`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pareja`
--
ALTER TABLE `pareja`
  ADD CONSTRAINT `fk_categorianivel` FOREIGN KEY (`categorianivel`) REFERENCES `categorianivel` (`id_categorianivel`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_deportista1` FOREIGN KEY (`deportista1`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_deportista2` FOREIGN KEY (`deportista2`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_pista` FOREIGN KEY (`pista_reserva`) REFERENCES `pista` (`id_pista`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_reserva`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;