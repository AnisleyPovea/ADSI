-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2024 a las 00:47:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarPersona` (IN `new_persona_id` INT, IN `new_nroDocumento` VARCHAR(20), IN `new_nombres` VARCHAR(50), IN `new_apellidos` VARCHAR(50), IN `new_fecha_nacimiento` DATE, IN `new_genero` VARCHAR(15), IN `new_estado` VARCHAR(15))   BEGIN
	UPDATE sgp_personas
	SET 
    nro_documento = new_nroDocumento,
    nombres =new_nombres,
    apellidos = new_apellidos,
    fecha_nacimiento = new_fecha_nacimiento,
    genero = new_genero,
    estado = new_estado
    WHERE id = new_persona_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscarPersona` (IN `new_persona_id` INT(11))   BEGIN
SELECT
   id,
   nro_documento,
   nombres,
   apellidos,
   fecha_nacimiento,
   genero,
   estado
FROM sgp_personas
WHERE id = new_persona_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarPersonas` (IN `new_persona_id` INT(11))   BEGIN
UPDATE sgp_personas
SET
estado = 'Inactivo'
WHERE id = new_persona_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPersona` (IN `new_nroDocumento` VARCHAR(20), IN `new_nombres` VARCHAR(50), IN `new_apellidos` VARCHAR(50), IN `new_fecha_nacimiento` DATE, IN `new_genero` VARCHAR(15))   BEGIN
	INSERT INTO sgp_personas(nro_documento,nombres,apellidos,fecha_nacimiento,genero
                            )
    VALUES (new_nroDocumento,new_nombres,new_apellidos,new_fecha_nacimiento,new_genero);END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPersonas` (IN `new_nroDocumento` VARCHAR(20), IN `new_nombres` VARCHAR(50), IN `new_apellidos` VARCHAR(50), IN `new_fecha_nacimiento` DATE, IN `new_genero` VARCHAR(15))   BEGIN
	INSERT INTO sgp_personas(nro_documento,nombre,apellidos,fecha_nacimiento,genero
                            )
    VALUES (new_nroDocumento,new_nombres,new_apellidos,new_fecha_nacimiento,new_genero);END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sgp_personas`
--

CREATE TABLE `sgp_personas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_documento` varchar(20) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(15) DEFAULT NULL,
  `estado` enum('Activo','inactivo') DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `sgp_personas`
--

INSERT INTO `sgp_personas` (`id`, `nro_documento`, `nombres`, `apellidos`, `fecha_nacimiento`, `genero`, `estado`) VALUES
(1, '2343034', 'Karen', 'Torres', '2023-02-05', 'Femenino', 'inactivo'),
(2, '9983645', 'Manuel', 'Castillo', '2000-11-05', 'Masculino', 'Activo'),
(3, '71039987', 'Gleidi', 'Martinez', '1990-12-28', 'Femenino', 'Activo'),
(4, '30961446', 'Paul', 'Uribe', '1990-11-22', 'Masculino', 'Activo'),
(5, '12583342', 'Aurelio', 'Beans', '1984-09-02', 'Masculino', 'Activo'),
(6, '11112', 'Nombre Act', 'Apellido act', '1999-01-01', 'Masculino', 'inactivo'),
(7, '11111', 'Nombre 1', 'Apellido 1', '2023-02-04', 'Femenino', 'Activo');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_personas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_personas` (
`id` int(10) unsigned
,`nro_documento` varchar(20)
,`nombre` varchar(100)
,`fecha_nac` varchar(10)
,`estado` enum('Activo','inactivo')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_personas`
--
DROP TABLE IF EXISTS `view_personas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_personas`  AS SELECT `sgp_personas`.`id` AS `id`, `sgp_personas`.`nro_documento` AS `nro_documento`, concat(`sgp_personas`.`nombres`,'',`sgp_personas`.`apellidos`) AS `nombre`, date_format(`sgp_personas`.`fecha_nacimiento`,'%d/%m/%Y') AS `fecha_nac`, `sgp_personas`.`estado` AS `estado` FROM `sgp_personas` WHERE `sgp_personas`.`estado` = 'Activo' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sgp_personas`
--
ALTER TABLE `sgp_personas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sgp_personas`
--
ALTER TABLE `sgp_personas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
