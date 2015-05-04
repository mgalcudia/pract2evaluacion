-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2015 a las 10:39:01
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `practica2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `anuncio` text COLLATE utf8_spanish2_ci,
  `oculto` tinyint(1) DEFAULT '0',
  `cod_interno` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `anuncio`, `oculto`, `cod_interno`) VALUES
(1, 'Animales y plantas', 'En esta categoría podrá encontrar todos los libros relacionado con los Animales y las Plantas', NULL, 0, 'cat01'),
(2, 'Arte', 'En esta categoría podrán encontrar todos lo relacionado con el arte', NULL, 0, 'cat02'),
(3, 'Autoayuda', 'En esta categoria encontrareis todo lo relacionado con la autoayuda', NULL, 0, 'cat03'),
(4, 'Biografias y Memorias', 'En esta categoria encontrareis lo relacionado con las biografias y las memorias de otras personas', NULL, 0, 'cat04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('16de47dd88f5bd3b2355ac2a6cda1641', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36', 1430177142, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`id` int(11) NOT NULL,
  `provincia_id` char(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dni` char(9) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codpostal` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` char(1) COLLATE utf8_spanish2_ci DEFAULT 'a'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `provincia_id`, `nombre`, `usuario`, `password`, `email`, `apellidos`, `dni`, `direccion`, `codpostal`, `activo`) VALUES
(14, '05', 'manuel', 'miusuario', '25f9e794323b453885f5181f1b624d0b', 'correo@correo.com', 'garcia', '28780108r', 'mi direccion', '21005', 'a'),
(15, '02', 'usuario2 modificado', 'usuario2', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'malcudia@gmail.com', 'apellido2 modificado', '44220423w', 'direccion2 modificado', '21005', 'a'),
(16, '01', 'usuario3', 'usuario3', '5a54c609c08a0ab3f7f8eef1365bfda6', 'malcudia@gmail.com', 'usuarioApellido', '28780108r', 'mi direccion', '21005', 'a'),
(17, '01', 'usuario3', 'usuario3', '5a54c609c08a0ab3f7f8eef1365bfda6', 'malcudia@gmail.com', 'usuarioApellido', '28780108r', 'mi direccion', '21005', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
`id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio_venta` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=108 ;

--
-- Volcado de datos para la tabla `linea_pedido`
--

INSERT INTO `linea_pedido` (`id`, `pedido_id`, `producto_id`, `precio_venta`, `descuento`, `iva`, `cantidad`) VALUES
(101, 82, 6, 17, NULL, 21, 1),
(102, 82, 22, 10, NULL, NULL, 1),
(103, 83, 33, 18, NULL, NULL, 1),
(104, 83, 37, 35, NULL, NULL, 1),
(105, 84, 22, 10, NULL, NULL, 1),
(106, 84, 24, 18, NULL, NULL, 1),
(107, 84, 26, 23, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `codpostal` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `provincia` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish2_ci DEFAULT 'p',
  `fecha_pedido` datetime DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=85 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `nombre`, `apellidos`, `email`, `dni`, `codpostal`, `provincia`, `estado`, `fecha_pedido`, `direccion`, `cantidad`, `importe`) VALUES
(82, 15, 'usuario2 modificado', 'apellido2 modificado', 'malcudia@gmail.com', '44220423w', '21005', '02', 'c', '2015-04-24 00:00:00', 'direccion2 modificado', 2, '27.00'),
(83, 15, 'usuario2 modificado', 'apellido2 modificado', 'malcudia@gmail.com', '44220423w', '21005', '02', 'p', '2015-04-24 00:00:00', 'direccion2 modificado', 2, '53.00'),
(84, 15, 'usuario2 modificado', 'apellido2 modificado', 'malcudia@gmail.com', '44220423w', '21005', '02', 'p', '2015-04-24 00:00:00', 'direccion2 modificado', 3, '51.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `precioVenta` decimal(8,2) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `imagen` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `iva` int(11) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `anuncio` text COLLATE utf8_spanish2_ci,
  `oculto` tinyint(1) DEFAULT '0',
  `destacado` tinyint(1) DEFAULT '1',
  `fec_inicio_desta` datetime DEFAULT NULL,
  `fec_fin_desta` datetime DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cod_interno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `nombre`, `precioVenta`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `oculto`, `destacado`, `fec_inicio_desta`, `fec_fin_desta`, `cantidad`, `cod_interno`) VALUES
(1, 1, 'Sensibilidad E Inteligencia En El Mundo', '13.00', 0, 'imagenes/animalesyplantas/sens.jpg', 21, 'Las plantas podrían perfectamente vivir sin nosotros, en cambio nosotros sin ellas nos extinguiríamos en un breve período de tiempo. Es más, en el planeta Tierra existe tan sólo un 0,3% de vida animal frente a un 99,7% de vida vegetal. Y sin embargo expresiones como ''vegetar'' o ''ser un vegetal'' indican en casi todas las lenguas unas condiciones de vida reducidas a la mínima expresión. Cuando pensamos en las plantas, nos sentimos tentados a atribuirles dos características: inmovilidad e insensibilidad. ', NULL, 1, 1, NULL, NULL, 0, 'catAn01'),
(2, 1, 'Las Migraciones De Los Animales', '38.00', 0, 'imagenes/animalesyplantas/migracion.jpg', 21, 'Este espectacular volumen ilustrado sigue a las manadas de ñúes y cebras por el Serengueti en su camino hacia nuevos pastos, corretea por la isla de Navidad con miles de cangrejos rojos terrestres en busca de pareja, nada con salmones y ballenas por aguas dulces y saladas hasta antiguos lugares de desove y de cría, y sigue a bandadas de aves y nubes de insectos en su bús- queda de comida. Con impresionantes ilustraciones y numero- sos mapas, el libro expone de forma clara e inteligible las formas básicas de los comportamientos migratorios, así como diversas cuestiones sobre orientación.', NULL, 0, 1, NULL, NULL, 86, 'catAn02'),
(3, 1, 'Del Huerto A La Despensa Y A La Mesa', '21.00', 0, 'imagenes/animalesyplantas/huerto.jpg', 21, 'En esta ocasión, Mariano Bueno nos enseña cómo conservar los excedentes de nuestros huertos y aquellos frutos y plantas que podemos recoger en el bosque, como las setas, para disfrutar de ellos en nuestra cocina durante todo el año. Paso a paso, explica todas las técnicas de conservación caseras y ecológicas: . Secado y deshidratación . Deshidratación por difusión osmótica . Conservas al baño maría . Zumos . Frío y congelados . Vinagre y encurtidos . Maceración en aceite . Salazones . Alcohol, las conservas espirituosas . Lactofermentados (Chucrut, Pickles y otras) . ', NULL, 1, 1, NULL, NULL, 89, 'catAn03'),
(4, 1, 'Los Árboles Frutales', '22.00', 0, 'imagenes/animalesyplantas/frutales.jpg', 21, 'Es muy importante que el agricultor o el aficionado estén al día en todo lo referente al cultivo de árboles frutales: injertos, podas, propagación de especies, clima y suelo adecuado, especies y variedades, etc. El lector encontrará en este libro amplia información que le ayudará a solucionar los problemas son los que puede encontrarse y a poner en pleno rendimiento sus árboles frutales.', NULL, 1, 1, NULL, NULL, 100, 'catAn04'),
(5, 1, 'Jardinerìa Tècnicas Pràcticas', '29.00', 0, 'imagenes/animalesyplantas/jardineria.jpg', 21, 'La primera parte está dedicada a la concepción de un jardín, la segunda habla de la selección de plantas más apropiada para cada tipo de espacio destinado a jardín y finalmente se han incluido todas las técnicas necesarias para el mantenimiento correcto de un jardín en cualquier estación.', NULL, 1, 1, NULL, NULL, 100, 'catAn05'),
(6, 1, 'Enciclopedia De Jardineria', '17.00', 0, 'imagenes/animalesyplantas/enciclopedia.jpg', 21, 'La clave del éxito en jardinería es la planificación, tanto de las necesidades como de las aspiraciones.\r\n	Por eso este volumen comienza explicando todos los aspectos relacionados con la planificación. Cada una de las partes y plantas que se pueden incluir en un jardín son analizadas exhaustivamente y se ofrecen muchas ideas y consejos sobre ellas.\r\n	También se detallan las tareas que se deben realizar en cada estación del año para poder establecer las prioridades en cada momento.', NULL, 1, 1, NULL, NULL, 80, 'catAn06'),
(7, 1, 'Bonsai', '29.00', 0, 'imagenes/animalesyplantas/bonsai.jpg', 21, 'Transforme su árbol en un bonsái o consiga que su ejemplar se desarrolle con armonía,\r\n	asegurando su longevidad y e incluso la producción de flores y frutos.', NULL, 0, 1, NULL, NULL, 100, 'catAn07'),
(8, 1, 'El Bosque. Descubrir, Disfrutar Y Degustar', '29.00', 0, 'imagenes/animalesyplantas/bosque.jpg', 21, 'Las salidas al bosque son una de las opciones preferidas a la hora de organizar una actividad familiar para el fin de semana.	Son excursiones que complementan los aprendizajes adquiridos en la escuela, refuerzan el respeto por el medio ambiente y pueden proporcionar un sinfín de recursos para enriquecer el tiempo libre. Destinado al ocio de toda la familia, este libro está pensado  para descubrir el bosque, y por ello se explican las características de los diferentes tipos de bosques de la península Ibérica, las especies más habituales y la riqueza de los espacios protegidos.', NULL, 0, 1, NULL, NULL, 100, 'catAn08'),
(9, 1, 'El Césped', '29.00', 0, 'imagenes/animalesyplantas/cesped.jpg', 21, 'El hombre ha vivido siempre rodeado de vegetación que ha utilizado para facilitar su existencia. La importancia de las plantas para la Humanidad está basada en la reputación y en los conocimientos recopilados sobre ellas que las generaciones han ido transmitiendo a la largo de los siglos. Esta experiencia colectiva permitió los grandes avances de la agricultura y el aprovechamiento de las plantas para otros fines, científicos o industriales, además de los basados en la alimentación y el ocio. Los textos bíblicos se hicieron eco de la relación del hombre con su entorno y ofrecieron los primeros testimonios escritos sobre el valor simbólico de los árboles y los arbustos.', NULL, 0, 1, NULL, NULL, 150, 'catAn09'),
(10, 1, 'Las Plantas En La Biblia', '29.00', 0, 'imagenes/animalesyplantas/lasplantas.jpg', 21, 'Transforme su árbol en un bonsái o consiga que su ejemplar se desarrolle con armonía,asegurando su longevidad y e incluso la producción de flores y frutos.', NULL, 0, 1, NULL, NULL, 153, 'catAn10'),
(11, 2, 'Chineasy  ', '52.00', 0, 'imagenes/artes/chinesay.jpg', 21, 'Chineasy es un método visual creado para hacer de la lectura de los caracteres chinos algo divertido y fácil. Mediante el aprendizaje de los caracteres más utilizados, los lectores aprenderán con rapidez los conceptos y palabras básicas, y ganarán seguridad y comprensión de la lengua y la cultura chinas. ¿Cómo funciona? Interiorizando primero los caracteres más sencillos a través de divertidas ilustraciones, aprenderemos a combinarlos y crear nuevas palabras y conceptos.', NULL, 0, 1, NULL, NULL, 100, 'catArt01'),
(12, 2, 'Arte Y Realidad En El Barroco I', '32.00', 0, 'imagenes/artes/barroco.jpg', 21, 'Los nuevos criterios de la graduación en Historia del Arte han contemplado el fragmentar el estudio de la plástica del siglo XVII -y de un buen segmento cronológico del siglo XVIII- a partir de un concepto tan polémico y conflictivo como el de realismo, un término que, hasta los años treinta del siglo XX,  se usó muy excepcionalmente para calificar las producciones pictóricas o escultóricas del Barroco. ', NULL, 1, 1, NULL, NULL, 90, 'catArt02'),
(13, 2, 'Historia Del Arte Clásico En La Antigüedad ', '19.00', 0, 'imagenes/artes/clasico.jpg', 21, 'Los nuevos criterios de la graduación en Historia del Arte han contemplado el fragmentar el estudio de la plástica del siglo XVII -y de un buen segmento cronológico del siglo XVIII- a partir de un concepto tan polémico y conflictivo como el de realismo, un término que, hasta los años treinta del siglo XX,se usó muy excepcionalmente para calificar las producciones pictóricas o escultóricas del Barroco. ', NULL, 1, 1, NULL, NULL, 200, 'catArt03'),
(15, 2, 'El Amor Es Cosa De Monstruos', '15.00', 0, 'imagenes/artes/elamor.jpg', 21, 'Ilustraciones cargadas de ternura en la que los monstruos más tiernos son \r\nlos protagonistas. Un libro interactivo con el lector: contiene tests: y tú, ¿qué tipo de monstruo eres en el amor?; ¿sabes si estás enamorado?; listas de Spotify: canciones que amansan a las fieras, instrucciones sobre cómo enamorar a un monstruo.', NULL, 1, 1, NULL, NULL, 490, 'catArt05'),
(16, 2, 'La Historia Del Arte', '48.00', 0, 'imagenes/artes/historiaarte.jpg', 21, 'El libro de arte más célebre y popular de todos los tiempos ha sido un éxito de ventas durante más de cinco décadas, con traducciones a 34 idiomas.\r\nPresenta la historia del arte en forma de discurso narrativo, una cadena viva que aún hoy comunica la época contemporánea con la era de las pirámides.', NULL, 1, 1, NULL, NULL, 588, 'catArt06'),
(17, 2, '3 Tomos Cadiz Phenicia', '69.00', 0, 'imagenes/artes/3tomos.jpg', 21, 'Cádiz fenicia, con el examen de varias noticias antiguas de España,\r\nque conservan los escritores hebreos, fenicios, griegos, romanos y árabes. Obra publicada en tres tomos.', NULL, 0, 1, NULL, NULL, 598, 'catArt07'),
(18, 2, 'Kit Qué Hacer Cuando En La\r\n Pantalla Aparece', '70.00', NULL, 'imagenes/artes/kit.jpg', 21, 'Paula Bonet es una de las autoras revelación de este año, con más de 10.000 ejemplares vendidos desde marzo. Estas Navidades presentamos un Kit ideal para regalar que hará las delicias de todos los seguidores de la artista. El pack incluye: ? 1 caja con diseño de Paula Bonet en la que podrás guardar lo que tú quieras ? 1 ejemplar del libro\r\n  ', NULL, 0, 1, NULL, NULL, 600, 'catArt08'),
(19, 2, '40 Años De Queen', '70.00', 0, 'imagenes/artes/queen.jpg', 21, 'Queen es una de las bandas más influyentes de la historia. Han vendido cientos\r\n de millones de discos y vídeos en todo el mundo, y han batido numerosos récords, como celebrar el concierto más multitudinario de la\r\n  historia, mantenerse en las listas de éxitos más semanas que cualquier otro grupo o ser cabeza de cartel en los mejores festivales.\r\n   ', NULL, 0, 1, NULL, NULL, 600, 'catArt09'),
(20, 2, 'Comprender Las Grandes Obras De La Pintura', '100.00', 0, 'imagenes/artes/comprender.jpg', 21, 'Un libro-regalo, tan interesante por el contenido como sugerente por su \r\npresentación. Con más de 500 reproducciones de alta calidad y más de 40 facsímiles de dibujos, grabados, cartas y otros documentos,\r\n es un paseo esclarecedor por las grandes obras de la pintura occidental de los últimos 600 años. ', NULL, 0, 1, NULL, NULL, 600, 'catArt10'),
(21, 3, 'Sí, Tú Puedes', '18.00', 0, 'imagenes/autoayuda/situpuede.jpg', 21, 'La vida es un largo camino del que conocemos su origen, pero no sabemos ni su fin ni cómo transcurrirán sus etapas. Durante nuestra andadura alcanzamos cimas, momentos felices en los que nos sentimos motivados,\r\nqueridos, protagonistas de nuestro propio éxito, pero también transitamos por valles donde todo es monotonía o nos encontramos con obstáculos que debemos ir sorteando.', NULL, 0, 1, NULL, NULL, 100, 'catAuto01'),
(22, 3, 'Destroza Este Diario', '10.00', 0, 'imagenes/autoayuda/destroza.jpg', 21, '¿Sientes que deberías plasmar todo tu potencial artístico, pero no sabes cómo? Destroza este diario es el libro con el que te podrás sentir cual Damien Hirst disecando tiburones. La modernísima Keri Smith anima a los propietarios de este diario a cometer actos ?destructivos? agujereando sus páginas, añadiendo fotos para dibujar encima o pintando con café, con la intención de experimentar el verdadero  proceso creativo.', NULL, 1, 1, NULL, NULL, 84, 'catAuto02'),
(23, 3, 'Gente Tóxica', '18.00', 0, 'imagenes/autoayuda/gente.jpg', 21, 'En nuestra vida cotidiana no podemos evitar encontrarnos con personas problemáticas. Jefes autoritarios y descalificadores, vecinos quejosos, compañeros de trabajo o estudio envidiosos, parientes que siempre nos echan la culpa de todo, hombres y mujeres arrogantes, irascibles o mentirosos… Todas estas personas «tóxicas» nos producen malestar,\r\n pero algunas pueden arruinarnos la vida, destruir nuestros sueños o alejarnos de nuestras metas.', NULL, 0, 1, NULL, NULL, 100, 'catAuto03'),
(24, 3, 'El Arte De No Amargarse La Vida', '18.00', 0, 'imagenes/autoayuda/amargarse.jpg', 21, 'La vida es para disfrutarla: amar, aprender, descubrir... y eso sólo lo podremos hacer\r\n cuando hayamos superado nuestros miedos y descubramos El arte de no amargarse la vida.En la línea de los grandes libros de psicología para\r\n el gran público Rafael Santandreu, expone en esta obra un método práctico, claro y científicamente demostrado,  para caminar hacia el \r\n cambio psicológico. Nuestro destino es convertirnos en personas más fuertes y felices. ', NULL, 1, 1, NULL, NULL, 84, 'catAuto04'),
(25, 3, 'Aquí, Cada Cual Con Sus Cosas', '18.00', 0, 'imagenes/autoayuda/cadacual.jpg', 21, 'La youtuber Yellow Mellow se asoma a las páginas de este libro con una batería de\r\n recomen¬daciones imprescindibles para sobrevivir en estos tiempos. Un conjunto de re¬flexiones personales sobre algunos de los grandes\r\n temas universales, que te ayudarán a manejarte en tu día a día y a sobrellevar esas situaciones cotidianas de las que no siempre salimos airosos.', NULL, 0, 1, NULL, NULL, 300, 'catAuto05'),
(26, 3, 'Autoestima Automática', '23.00', 0, 'imagenes/autoayuda/automatica.jpg', 21, 'Si analizamos la mayoría de los problemas psicológicos que nos causan inseguridad,\r\n estrés e incluso depresión, comprobaremos que tienen su base en una falta de autoestima. Tener una buena autoestima no es creernos mejor\r\n  que los demás o mostrarnos más seguros al defender nuestras posiciones o intereses, sino que se basa en creer que tenemos las habilidades.', NULL, 1, 1, NULL, NULL, 299, 'catAuto06'),
(27, 3, 'Cosas No Aburridas Para Ser La Mar De Feliz', '25.00', NULL, 'imagenes/autoayuda/cosas.jpg', NULL, 'Sumergirse en estas páginas es dejarse sorprender por el mundo de Mr.Wonderful del que\r\n uno sale transformado y con una gran sonrisa. Leer estas páginas es un chapuzón en el mar en agosto, es tener agujetas en el estómago\r\ndespués de tanto reir...Tienes entre tus manos un decálogo ilustrado sobre la felicidad contado como quien habla con un amigo,\r\nsincero y transparente.Cosas no aburridas para ser la mar de feliz es el libro menos libro del mundo entero: es una experiencia,\r\nuna sonrisa, es como un espejo, un regalo, es un cuaderno y un álbum. Este libro es simplemente, buen rollo asegurado.', NULL, 0, 1, NULL, NULL, 300, 'catAuto07'),
(28, 3, 'Los 88 Peldaños Del Éxito', '30.00', NULL, 'imagenes/autoayuda/88peldaños.jpg', NULL, 'Tras una brillante carrera como emprendedor, Anxo Pérez observó que existe una serie \r\nde claves -a las que el autor se refiere como Peldaños- que, correctamente asimiladas, se convierten en aceleradores del éxito.\r\nEn este libro, el autor nos ofrece 88 claves para triunfar en la vida y en la empresa: precisas, prácticas y tremendamente efectivas,\r\ncuya aplicación es de efecto inmediato. Dichos Peldaños acelerarán tu carrera hacia tus objetivos, te permitirán aprovechar el potencial\r\nque ya llevas dentro y te ayudarán a conseguir tus retos desde el mismo día en que los leas. Este libro revolucionará tu vida personal\r\ny profesional.', NULL, 0, 1, NULL, NULL, 300, 'catAuto08'),
(29, 3, 'Biografía Del Silencio ', '35.00', NULL, 'imagenes/autoayuda/silencio.jpg', NULL, 'Basta un año de meditación perseverante, o incluso medio, para percatarse de que se \r\npuede vivir de otra forma. La meditación nos con-centra, nos devuelve a casa, nos enseña a convivir con nuestro ser, nos agrieta la \r\nestructura de nuestra personalidad hasta que, de tanto meditar, la grieta se ensancha y la vieja personalidad se rompe y, como una flor, \r\ncomienza a nacer una nueva. Meditar es asistir a este fascinante y tremendo proceso de muerte y renacimiento. Gracias a la meditación el \r\nautor ha ido descubriendo que no hay yo y mundo, sino que mundo y yo son una misma y única cosa.', NULL, 0, 1, NULL, NULL, 300, 'catAuto09'),
(30, 3, 'Si No Te Gusta Tu Vida, ¡Cámbiala!', '40.00', NULL, 'imagenes/autoayuda/cambiala.jpg', NULL, 'Jesús Calleja, el aventurero más carismático de la televisión, es alguien que jamás ha \r\npuesto excusas entre él y sus sueños, ya que su vida ha sido un constante ejercicio de superación que le ha permitido llevar a la práctica \r\nnumerosos proyectos que, a priori, parecían imposibles. Este libro no narra sólo las asombrosas aventuras de un hombre decidido a romper \r\ntodos los límites. Es sobre todo un manual lleno de valiosas ideas y consejos para todo aquel que no se conforma con la rutina y la \r\npasividad. A partir del lema «Si no te gusta tu vida, ¡cámbiala!», en estas páginas nos entrenaremos para empezar ahora la vida que \r\nsiempre hemos anhelado.', NULL, 0, 1, NULL, NULL, 300, 'catAuto10'),
(31, 4, 'Las Ultimas Horas De José Antonio', '22.00', NULL, 'imagenes/biografiasymemorias/ultimas.jpg', NULL, 'El estudio más completo sobre el proceso y la ejecución de José Antonio. Los\r\n documentos inéditos descubiertos por Zavala constituyen una aportación fundamental e indispensable para conocer las últimas horas de vida\r\n  del líder de Falange» STANLEY G. PAYNE A las diez horas del día 14 de marzo de 1936, José Antonio Primo de Rivera fue arrestado en Madrid,\r\n  bajo la acusación de posesión ilícita de armas, e ingresó al día siguiente, de noche, en la antigua celda de Largo Caballero en la cárcel \r\n  Modelo de la misma ciudad. ', NULL, 0, 1, NULL, NULL, 100, 'catBio01'),
(32, 4, 'La Luz De Miki Roque', '10.00', NULL, 'imagenes/biografiasymemorias/miki.jpg', NULL, 'Epílogo de Carles Puyol ¿Cómo divorciar el miedo del futuro? ¿Cómo cambiar \r\nel transcurrir por el vivir? ¿Por qué pensar que la mayoría de las prohibiciones nacen del prohibido? ¿Por qué creer que el poder se \r\nconstruye con el intento? El 4 de marzo de 2011, a Miki Roqué le diagnosticaron un tumor maligno en la pelvis. Falleció casi 16 meses \r\ndespués, el 24 de junio de 2012, con sólo 23 años. Durante ese proceso delicado, repleto de emociones, el futbolista del Betis lideró \r\nde principio a fin cada una de las decisiones, fue dejando mensajes, enseñanzas, valores y transmitiendo una energía superior. Nunca \r\nseparó sus sueños de la realidad, buscó armonizar cada uno de los días y, en distintas situaciones, hasta logró transformar un dolor \r\nextremo en belleza. Alrededor de 70 personas, testigos privilegiados de una luz, dieron un testimonio conmovedor sobre un ser que ya \r\nes eterno.', NULL, 0, 1, NULL, NULL, 100, 'catBio02'),
(33, 4, 'El Amor De Mi Vida. Recapitular Para Sanar', '18.00', NULL, 'imagenes/biografiasymemorias/elamor.jpg', NULL, 'Este es un libro duro, sincero, divertido, humano. Esta es una historia real.\r\nEsta es mi historia. Sofía Cristo, la hija menor de Bárbara Rey y Ángel Cristo, relata en un libro duro y eminentemente real su \r\nexperiencia al lado del amor de su vida: la droga, una compañera que ha pululado a su alrededor desde que era una niña y a quien se \r\nha tenido que enfrentar. Una vez recuperada, después de más de un año en un centro de rehabilitación, la DJ profesional renace de sus \r\ncenizas para romper de manera definitiva con el que ha sido hasta ahora el amor de su vida y para compartir con los demás su testimonio \r\nde superación.', NULL, 1, 1, NULL, NULL, 97, 'catBio03'),
(34, 4, 'Gente, Años, Vida', '20.00', NULL, 'imagenes/biografiasymemorias/gente.jpg', NULL, 'El nombre Iliá Erenburg se relaciona, en primer lugar, con el intelectual que \r\ncolaboró sin reservas con el régimen soviético, y, en segundo lugar, con su amigo Vasili Grossman, con el que escribió, en colaboración \r\ncon terceros, el terrible El libro negro. Novelista criticado en su país, en 1932 aceptó ser corresponsal del Izvestia en París, \r\nconvirtiéndose en un relevante periodista oficial que describía a Stalin como «un capitán que permanece junto al timón con el viento de \r\ncostado, mirando la oscuridad profunda de la noche con un enorme peso sobre sus hombros». Sus memorias, escritas al final de su vida y \r\nque hoy presentamos por primera vez íntegras al lector español, son un documento de primer orden para conocer aspectos fundamentales de \r\nla convulsa historia del siglo XX. Aunque incómodas para el régimen soviético (hasta 1990 no fueron editadas enteras y sin censura), no \r\ndejan de ser los recuerdos de alguien que, en su relación con los más relevantes intelectuales europeos, intentó atraerlos a la propaganda \r\ndel comunismo.', NULL, 1, 1, NULL, NULL, 100, 'catBio04'),
(35, 4, 'El Diario De Frida Kahlo', '23.00', NULL, 'imagenes/biografiasymemorias/diario.jpg', NULL, 'Publicado en su totalidad, el diario de Frida Kahlo refleja los últimos diez años \r\nde una vida turbulenta. Este documento, a veces apasionado, otras sorprendente e íntimo, custodiado bajo llave durante aproximadamente \r\ncuarenta años, revela nuevos rasgos de la compleja personalidad de esta destacada artista mexicana. Editado por la Vaca Independiente y \r\ndistribuido en exclusiva por Editorial RM, este personal documento editado en un facsímil a todo color, aporta un nuevo enfoque para \r\ncomprender mejor la original y enérgica visión del mundo de esta mexicana.', NULL, 1, 1, NULL, NULL, 299, 'catBio06'),
(36, 4, 'Para Vos Nací', '25.00', NULL, 'imagenes/biografiasymemorias/para.jpg', NULL, 'Teresa de Cepeda y Ahumada ha cumplido sus primeros quinientos años de vida, y \r\nsu figura y sus palabras llegan a nosotros tan intensos y refrescantes como lo fueron en su época: puede que incluso más, a través de una \r\nvoz muy especial,  la de Espido Freire, quien a modo de diario comparte lo que podría ser un mes con Teresa de Jesús.  Un mes que le \r\nofrece al lector el resultado de haber pasado, a su vez  la autora,  varios meses con Teresa, con la intención de acercar a la vida \r\nreal una forma de afrontar la existencia que puede tener sentido en nuestros días.   Parte biografía alternativa,  parte meditación \r\nsobre sus pensamientos y frases más relevantes, Epido Freire dialoga con Teresa sobre la dificultad de ser mujer en un mundo de hombres, \r\nel conflicto entre la espiritualidad y la acción, el espíritu de superación, la enfermedad mental, la escritura como terapia, los viajes, \r\nel ansia por el conocimiento, la necesidad del buen vivir/del buen morir, las relaciones con la familia como fuente de crecimiento o \r\ndelimitación, la amistad hombre mujer, la vida contemplativa?  hasta construir una completa y original guía de vida.', NULL, 1, 1, NULL, NULL, 300, 'catBio07'),
(37, 4, 'Amor Y Capital', '35.00', NULL, 'imagenes/biografiasymemorias/amor.jpg', NULL, 'Amor y Capital revela la rara vez entrevista humanidad del hombre cuyas \r\nobras iban a transformar el mundo después de su muerte. Pero es también un vívido relato en torno a la mujer que le dio la fuerza \r\nnecesaria para proseguir en sus esfuerzos para lograrlo. Karl Marx era un estudiante con pocos medios y de incierto futuro cuando \r\nJenny von Westphalen, la cautivadora hija de un barón prusiano, se enamoró de él. Juntos recorrieron Europa esquivando distintos \r\ngobiernos, cada vez más alarmados por las ideas revolucionarias de Marx. Pero en la vida de la pareja no todo era lucha política. \r\nComo Mary Gabriel nos cuenta, Marx idolatraba a sus hijos y esposa, era un bromista al que le gustaban las fiestas familiares y un \r\nhombre capaz de experimentar salvajes entusiasmos, uno de los cuales casi destruye su matrimonio.', NULL, 1, 1, NULL, NULL, 299, 'catBio09'),
(38, 4, 'Eisenhower', '40.00', NULL, 'imagenes/biografiasymemorias/einserhower.jpg', NULL, 'A todo el mundo le gustaba lke», se decía. Dwight D. Eisenhower fue, de hecho, \r\nuna curiosa combinación: afectuoso y extravertido por fuera, pero frío y, a menudo, sorprendentemente egoísta. En noviembre de 1942, \r\nEisenhower era general al mando de las fuerzas angloamericanas que invadieron el norte de África. A finales de 1943 fue elegido para \r\ndirigir las fuerzas aliadas que preparaban la invasión de Europa occidental e impidió que las tropas alemanas triunfaran en Occidente. \r\nEra el obvio comandante supremo de las fuerzas en Europa de la Alianza Atlántica en 1951, cuando los norteamericanos decidieron respaldar \r\nsu participación en la defensa de Europa con un importante contingente militar. ', NULL, 0, 1, NULL, NULL, 300, 'catBio10'),
(39, 4, 'El Tiempo Amarillo', '30.00', NULL, 'imagenes/biografiasymemorias/amarillo.jpg', NULL, 'El título de estas memorias procede de unos versos de Miguel Hernández: \r\n«... un día / se pondrá el tiempo amarillo / sobre mi fotografía». A través de más de 600 páginas, pese a que el autor dijo una vez que \r\nno le gustan nada los libros gordos y que «es mucho mejor no fiarse de las memorias», El tiempo amarillo brinda al lector una mirada \r\nmuy personal sobre varias décadas de nuestro país, y también sobre sí mismo. En ella analiza su vida como colegial, cómo adquirió \r\nconciencia de clase, sus intereses políticos o hasta las memorias que tomó como referencia para escribir las suyas.', NULL, 1, 1, NULL, NULL, 300, 'catBio08'),
(40, 4, 'La Condesa Se Confiesa', '18.00', NULL, 'imagenes/biografiasymemorias/condesa.jpg', NULL, '¿Me busqué a mí misma y encontré a Dios. Busqué a Dios y me encontré a mí \r\nmisma?. Proverbio sufí. Crucé los mares y los cielos infinidad de veces en pos de mi felicidad, pero sobre todo por el afán de hallar lo \r\nmaterial: el lujo y el dinero, la fama y el poder; a veces todos ellos escondidos tras los múltiples disfraces del amor. Viví en el \r\ntorbellino de muchas aventuras. Probé demasiadas veces la dulce miel del placer pero también probé la amarga hiel de la desdicha. \r\nInvito al lector a que venga y camine un rato conmigo y comparta las glorias y las vicisitudes de una mujer que ha luchado, que ha \r\nganado y, también, que ha perdido; que ha llorado y ha sufrido; una mujer que, por encima de todo, ha celebrado con suma gratitud y \r\ngozo lo intensamente vivido.', NULL, 1, 1, NULL, NULL, 298, 'catBio05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id` char(2) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`) VALUES
('01', 'Alava'),
('02', 'Albacete'),
('03', 'Alicante'),
('04', 'Almera'),
('05', 'Avila'),
('06', 'Badajoz'),
('07', 'Balears (Illes)'),
('08', 'Barcelona'),
('09', 'Burgos'),
('10', 'Cáceres'),
('11', 'Cádiz'),
('12', 'Castellón'),
('13', 'Ciudad Real'),
('14', 'Córdoba'),
('15', 'Coruña (A)'),
('16', 'Cuenca'),
('17', 'Girona'),
('18', 'Granada'),
('19', 'Guadalajara'),
('20', 'Guipzcoa'),
('21', 'Huelva'),
('22', 'Huesca'),
('23', 'Jaén'),
('24', 'León'),
('25', 'Lleida'),
('26', 'Rioja (La)'),
('27', 'Lugo'),
('28', 'Madrid'),
('29', 'Málaga'),
('30', 'Murcia'),
('31', 'Navarra'),
('32', 'Ourense'),
('33', 'Asturias'),
('34', 'Palencia'),
('35', 'Palmas (Las)'),
('36', 'Pontevedra'),
('37', 'Salamanca'),
('38', 'Santa Cruz de Tenerife'),
('39', 'Cantabria'),
('40', 'Segovia'),
('41', 'Sevilla'),
('42', 'Soria'),
('43', 'Tarragona'),
('44', 'Teruel'),
('45', 'Toledo'),
('46', 'Valencia'),
('47', 'Valladolid'),
('48', 'Vizcaya'),
('49', 'Zamora'),
('50', 'Zaragoza'),
('51', 'Ceuta'),
('52', 'Melilla');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cliente_provincia1_idx` (`provincia_id`), ADD FULLTEXT KEY `activo` (`activo`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pedido_has_producto_producto1_idx` (`producto_id`), ADD KEY `fk_pedido_has_producto_pedido_idx` (`pedido_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pedido_cliente1_idx` (`cliente_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_producto_categoria1_idx` (`categoria_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `fk_cliente_provincia1` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
ADD CONSTRAINT `fk_pedido_has_producto_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pedido_has_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
