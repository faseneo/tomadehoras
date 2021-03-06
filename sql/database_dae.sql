-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2018 a las 16:53:41
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database_dae`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `generabloque` (IN `intervalo` INT, IN `id` INT)  NO SQL
BEGIN
	DECLARE hora TIME;
	DECLARE orden INT;	
	DECLARE tipo INT;	
	DECLARE estado INT;
	DECLARE i INT;
	DECLARE horainicio TIME;
	DECLARE horafin TIME;

	DECLARE horainciotarde TIME;
	DECLARE horafintarde TIME;

	DECLARE difmanana TIME;
	DECLARE diftarde TIME;

	DECLARE horaintervalo TIME;
    
	SET orden = 10;
	SET estado = 1;	
	SET tipo = 1;
  SET i = 1;

	select tipo_jornada_hora_inicio, tipo_jornada_hora_fin INTO horainicio,horafin from tipo_jornada where tipo_jornada_id=2;
	select tipo_jornada_hora_inicio, tipo_jornada_hora_fin INTO horainciotarde,horafintarde from tipo_jornada where tipo_jornada_id=3;

  SET horaintervalo =  MAKETIME(00,intervalo,00);

	SET difmanana = TIMEDIFF(horafin, horainicio);
	SET diftarde = TIMEDIFF(horafintarde, horainciotarde);

	SET hora = horainicio;
    WHILE hora<=horafin DO
			#SELECT hora;
			INSERT INTO hora_atencion (hora_atencion_hora, hora_atencion_orden, hora_atencion_tipo, hora_atencion_dia_atencion_id, hora_atencion_estado ) VALUES (hora,orden,tipo,id,estado); 
			SET hora = ADDTIME(hora, horaintervalo);
			SET orden = orden + 10;
    END WHILE;
	
	SET hora = horainciotarde;
    WHILE hora<=horafintarde DO
			#SELECT hora;
			INSERT INTO hora_atencion (hora_atencion_hora, hora_atencion_orden, hora_atencion_tipo, hora_atencion_dia_atencion_id, hora_atencion_estado ) VALUES (hora,orden,tipo,id,estado); 
			SET orden = orden + 10;
			SET hora = ADDTIME(hora, horaintervalo);
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `generadias` (IN `fechainicio` DATE, IN `idsemana` INT, IN `totaldias` INT)  NO SQL
BEGIN
	DECLARE dia INT;
	DECLARE mes INT;	
	DECLARE estado INT;
	DECLARE i INT;
  DECLARE fecha DATE;
	DECLARE existe INT;
	DECLARE id INT;
	DECLARE intervalo INT;	

	SET fecha = fechainicio;
	SET estado = 1;	
  SET i = 1;
	SET intervalo = 20;
	
    WHILE i<=totaldias DO
			SET dia = DAY(fecha);
			SET mes = MONTH(fecha);
											  
			SET existe = (SELECT COUNT(cal_feriadosbloqueados_fecha_inicio) AS total
												FROM calendario_feriadosbloqueados 
												WHERE (fecha BETWEEN cal_feriadosbloqueados_fecha_inicio AND cal_feriadosbloqueados_fecha_fin));
				IF existe = 0 THEN
					SET estado = 1;
				ELSE
					SET estado = 0;
				END IF;

			INSERT INTO dia_atencion (dia_atencion_dia, dia_atencion_mes, dia_atencion_semana_id, dia_atencion_fecha, dia_atencion_estado) VALUES (dia,mes,idsemana,fecha,estado); 
			SET id = last_insert_id();
			IF estado = 1 THEN
				CALL generabloque(intervalo,id);
			END IF;
			SET fecha = TIMESTAMPADD(DAY,i, fechainicio);
			SET i=i+1;

    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `generasemanas` (IN `fechainicio` DATE, IN `fechafin` DATE)  NO SQL
BEGIN	
  DECLARE numerosem INT;
	DECLARE numerosemfin INT;
	DECLARE totalsemana INT;
	DECLARE texto VARCHAR(30);
	DECLARE estado INT;
	DECLARE anio INT;
	DECLARE i INT;
  DECLARE primerdiasemana DATE;
	DECLARE ultimodiasemana DATE;
  DECLARE id INT;
	DECLARE existe INT;
	DECLARE totaldias INT;

	SET anio = YEAR(fechainicio);
	SET numerosem = WEEKOFYEAR(fechainicio);
	SET numerosemfin = WEEKOFYEAR(fechafin);
	SET totalsemana = (numerosemfin - numerosem)+1;    
	SET estado = 1;	
  SET i = 1;
  SET primerdiasemana = TIMESTAMPADD(DAY,(0-WEEKDAY(fechainicio)), fechainicio);

    WHILE i<=totalsemana DO
			SET ultimodiasemana = TIMESTAMPADD(DAY,5, primerdiasemana);
			IF ultimodiasemana > fechafin THEN
				SET ultimodiasemana = fechafin;
			END IF;
			SET totaldias = DATEDIFF(ultimodiasemana, primerdiasemana);  
			SET texto = CONCAT('Semana ',numerosem); 
			SET existe = (SELECT COUNT(cal_feriadosbloqueados_fecha_inicio) AS total
											FROM calendario_feriadosbloqueados 
											WHERE (primerdiasemana BETWEEN cal_feriadosbloqueados_fecha_inicio AND cal_feriadosbloqueados_fecha_fin)
											AND (ultimodiasemana BETWEEN cal_feriadosbloqueados_fecha_inicio AND cal_feriadosbloqueados_fecha_fin));
			IF existe = 0 THEN
				SET estado = 1;
			ELSE
				SET estado = 0;
			END IF;
			INSERT INTO semana (semana_numero, semana_agno, semana_texto, semana_fechalunes, semana_estado) VALUES (i, anio, texto, primerdiasemana, estado); 
			SET id = last_insert_id();
			/*SELECT id as ultimoinsert; */
			IF estado = 1 THEN
				CALL generadias(primerdiasemana,id,totaldias);
			END IF;

			SET primerdiasemana = TIMESTAMPADD(WEEK,1,primerdiasemana);
			SET numerosem = numerosem + 1;
			SET i=i+1;
    END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verificahora` ()  BEGIN
	#Routine body goes here...
DECLARE horainicio TIME;
DECLARE horafin TIME;

select tipo_jornada_hora_inicio, tipo_jornada_hora_fin INTO horainicio,horafin from tipo_jornada where tipo_jornada_id=2;

select horainicio;
select horafin;
/*PRINT horainicio;
PRINT horafin;*/

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verifica_fecha` ()  NO SQL
BEGIN
DECLARE existe INT;

SET existe =	(SELECT COUNT(cal_feriadosbloqueados_fecha_inicio) AS total
							FROM calendario_feriadosbloqueados 
							WHERE ('2018-02-05' BETWEEN cal_feriadosbloqueados_fecha_inicio AND cal_feriadosbloqueados_fecha_fin) AND ('2018-02-09' BETWEEN cal_feriadosbloqueados_fecha_inicio AND cal_feriadosbloqueados_fecha_fin));
select existe;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `actividad_id` int(11) NOT NULL,
  `actividad_codigo` int(11) NOT NULL,
  `actividad_nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjuntos`
--

CREATE TABLE `adjuntos` (
  `adjuntos_id` int(11) NOT NULL,
  `adjuntos_file_name` varchar(300) NOT NULL,
  `adjuntos_file_type` varchar(20) NOT NULL,
  `adjuntos_file_size` int(11) NOT NULL,
  `adjuntos_file_url` varchar(255) NOT NULL COMMENT 'directorio_prefijo_rut_timestap',
  `adjuntos_file_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adjuntos_alu_id` int(11) NOT NULL,
  `adjuntos_tipo_archivo_id` int(11) NOT NULL,
  `adjuntos_modulo_origen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda_dae`
--

CREATE TABLE `agenda_dae` (
  `agenda_dae_id` int(11) NOT NULL,
  `agenda_dae_personas_dae_id` int(11) NOT NULL,
  `agenda_dae_hora_atencion_id` int(11) NOT NULL,
  `agenda_dae_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alu_id` int(11) NOT NULL,
  `alu_codcli` varchar(15) NOT NULL,
  `alu_rut` varchar(12) NOT NULL,
  `alu_dv` varchar(1) NOT NULL,
  `alu_ap_pat` varchar(20) NOT NULL,
  `alu_ap_mat` varchar(20) NOT NULL,
  `alu_nombre1` varchar(20) NOT NULL,
  `alu_nombre2` varchar(20) NOT NULL,
  `alu_sexo` varchar(1) NOT NULL,
  `alu_dia_nac` int(2) NOT NULL,
  `alu_mes_nac` int(2) NOT NULL,
  `alu_anio_nac` int(4) NOT NULL,
  `alu_sede` varchar(20) NOT NULL,
  `alu_anio_ingreso` int(4) NOT NULL,
  `alu_correo` varchar(100) NOT NULL,
  `alu_telefono` varchar(15) NOT NULL,
  `alu_celular` varchar(15) NOT NULL,
  `alu_direccion` varchar(100) NOT NULL,
  `alu_comuna` varchar(30) NOT NULL,
  `alu_ciudad` varchar(30) NOT NULL,
  `alu_periodo` int(1) NOT NULL,
  `alu_periodo_mat` int(1) NOT NULL,
  `alu_anio_mat` int(4) NOT NULL,
  `alu_fecha_matricula` varchar(10) NOT NULL,
  `alu_periodo_vigencia` varchar(20) NOT NULL,
  `alu_jornada_id` int(11) NOT NULL,
  `alu_descripcion_situacion_academica_id` int(11) NOT NULL,
  `alu_estado_academico_id` int(11) NOT NULL,
  `alu_categoria_academica_id` int(11) NOT NULL,
  `alu_carrera_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_datos_externos`
--

CREATE TABLE `alumnos_datos_externos` (
  `alumnos_datos_ext_alu_id` int(11) NOT NULL,
  `alumnos_datos_ext_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_tiene_becasycreditos`
--

CREATE TABLE `alumnos_tiene_becasycreditos` (
  `alu_tiene_beca_id` int(11) NOT NULL,
  `alu_tiene_beca_fecha_postulacion` varchar(10) DEFAULT NULL,
  `alu_tiene_beca_alu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_atencion`
--

CREATE TABLE `alumno_atencion` (
  `alumno_ate_id` int(11) NOT NULL COMMENT 'viene de la tabla de alumnos de la base de dae',
  `alumno_ate_cod_cli` varchar(20) DEFAULT NULL COMMENT 'Sera llave foranea de tabla alumno',
  `alumno_ate_rut` varchar(8) DEFAULT NULL,
  `alumno_ate_dv` varchar(1) DEFAULT NULL,
  `alumno_ate_fecha` date DEFAULT NULL,
  `alumno_ate_hora` time DEFAULT NULL,
  `alumno_ate_forma_atencion_id` int(11) NOT NULL,
  `alumno_ate_motivo_atencion_id` int(11) NOT NULL,
  `alumno_ate_detalle_atencion_id` int(11) NOT NULL,
  `alumno_ate_respuesta` varchar(500) DEFAULT NULL,
  `alumno_ate_seguimiento` tinyint(4) DEFAULT NULL,
  `alumno_ate_pendiente` varchar(200) DEFAULT NULL,
  `alumno_ate_adjunto_url` varchar(200) DEFAULT NULL,
  `alumno_ate_reserva_atencion_id` int(11) NOT NULL,
  `alumno_ate_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_datos_anexos`
--

CREATE TABLE `alumno_datos_anexos` (
  `alu_dto_anexos_id` int(11) NOT NULL,
  `alu_dto_anexos_rut` varchar(10) DEFAULT NULL,
  `alu_dto_anexos_detalle_personal` varchar(400) DEFAULT NULL,
  `alu_dto_anexos_correo_umce` varchar(100) DEFAULT NULL,
  `alu_dto_anexos_apoyofamiliar` varchar(20) DEFAULT NULL COMMENT 'podria una tabla aparte... ver detalle con belen',
  `alu_dto_anexos_nombre_afamiliar` varchar(60) DEFAULT NULL,
  `alu_dto_anexos_celular_afamiliar` varchar(15) DEFAULT NULL,
  `alu_dto_anexos_correo_afamiliar` varchar(100) DEFAULT NULL,
  `alu_dto_anexos_tienehijos` tinyint(4) DEFAULT NULL,
  `alu_dto_anexos_numerohijos` tinyint(4) DEFAULT NULL,
  `alu_dto_anexos_tienediscapacidad` tinyint(4) DEFAULT NULL,
  `alu_dto_anexos_discapacidad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_hogar`
--

CREATE TABLE `alumno_hogar` (
  `alumno_hogar_hogar_id` int(11) NOT NULL,
  `alumno_hogar_alu_id` int(11) NOT NULL,
  `alumno_hogar_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alumno_hogar_fuas_id` int(11) NOT NULL,
  `alumno_hogar_resp_ingreso` enum('estudiante','asistente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alu_anexo_tiene_campo`
--

CREATE TABLE `alu_anexo_tiene_campo` (
  `alu_anexo_tiene_campo_id` int(11) NOT NULL,
  `alu_anexo_tiene_campo_alu_dto_anexos_id` int(11) NOT NULL,
  `alu_anexo_tiene_campo_nuevo_campo_id` int(11) NOT NULL,
  `alu_anexo_tiene_campo_valor` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asigna_carreras`
--

CREATE TABLE `asigna_carreras` (
  `asigna_carreras_id` int(11) NOT NULL,
  `asigna_carreras_personas_dae_id` int(11) NOT NULL,
  `asigna_carreras_carrera_id` int(11) NOT NULL,
  `asigna_carreras_fecha_asignacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asigna_carreras_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas_externas`
--

CREATE TABLE `becas_externas` (
  `becas_externas_id` int(11) NOT NULL,
  `becas_externas_nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas_internas`
--

CREATE TABLE `becas_internas` (
  `becas_internas_id` int(11) NOT NULL,
  `becas_internas_nombre` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas_periodo`
--

CREATE TABLE `becas_periodo` (
  `becas_periodo_id` int(11) NOT NULL,
  `becas_periodo_fecha_inicio` datetime NOT NULL,
  `becas_periodo_fecha_cierre` datetime NOT NULL,
  `becas_periodo_activo` tinyint(4) NOT NULL,
  `becas_periodo_becas_internas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario_feriadosbloqueados`
--

CREATE TABLE `calendario_feriadosbloqueados` (
  `cal_feriadosbloqueados_id` int(11) NOT NULL,
  `cal_feriadosbloqueados_fecha_inicio` date NOT NULL,
  `cal_feriadosbloqueados_fecha_fin` date NOT NULL,
  `cal_feriadosbloqueados_descripcion` varchar(255) NOT NULL,
  `cal_feriadosbloqueados_tipo_bloqueo_id` int(11) NOT NULL,
  `cal_feriadosbloqueados_tipo_jornada_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calendario_feriadosbloqueados`
--

INSERT INTO `calendario_feriadosbloqueados` (`cal_feriadosbloqueados_id`, `cal_feriadosbloqueados_fecha_inicio`, `cal_feriadosbloqueados_fecha_fin`, `cal_feriadosbloqueados_descripcion`, `cal_feriadosbloqueados_tipo_bloqueo_id`, `cal_feriadosbloqueados_tipo_jornada_id`) VALUES
(1, '2018-01-01', '2018-01-01', 'Año Nuevo', 1, 1),
(2, '2018-02-01', '2018-03-02', 'Vacaciones de Verano', 3, 1),
(3, '2018-03-30', '2018-03-30', 'Viernes Santo', 1, 1),
(4, '2018-04-30', '2018-04-30', 'Interferiado Umce', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `carrera_id` int(11) NOT NULL,
  `carrera_codigo` varchar(5) NOT NULL,
  `carrera_nombre` varchar(150) NOT NULL,
  `carrera_facultad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`carrera_id`, `carrera_codigo`, `carrera_nombre`, `carrera_facultad_id`) VALUES
(1, '2024', 'LICENCIATURA EN EDUCACION MATEMATICA Y PEDAGOGIA EN MATEMATICA', 3),
(2, '2091', 'LICENCIATURA EN EDUCACION CON MENCION EN FRANCES Y PEDAGOGIA EN FRANCES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_academica`
--

CREATE TABLE `categoria_academica` (
  `categoria_academica_id` int(11) NOT NULL,
  `categoria_academica_nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_atencion`
--

CREATE TABLE `codigo_atencion` (
  `codigo_atencion_id` int(11) NOT NULL,
  `codigo_atencion_codigo` varchar(10) NOT NULL,
  `codigo_atencion_observacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `codigo_atencion`
--

INSERT INTO `codigo_atencion` (`codigo_atencion_id`, `codigo_atencion_codigo`, `codigo_atencion_observacion`) VALUES
(1, '$$$', 'Prueba de día Lunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `comuna_id` int(11) NOT NULL,
  `comuna_nombre` varchar(30) NOT NULL,
  `comuna_region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_situacion_academica`
--

CREATE TABLE `descripcion_situacion_academica` (
  `descripcion_situacion_academica_id` int(11) NOT NULL,
  `descripcion_situacion_academica_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_atencion`
--

CREATE TABLE `detalle_atencion` (
  `detalle_atencion_id` int(11) NOT NULL,
  `detalle_atencion_texto` varchar(100) DEFAULT NULL,
  `detalle_atencion_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_atencion`
--

INSERT INTO `detalle_atencion` (`detalle_atencion_id`, `detalle_atencion_texto`, `detalle_atencion_estado`) VALUES
(1, 'CrÃ©dito', 1),
(2, 'Asistente social', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia_atencion`
--

CREATE TABLE `dia_atencion` (
  `dia_atencion_id` int(11) NOT NULL,
  `dia_atencion_dia` int(11) DEFAULT NULL,
  `dia_atencion_mes` int(11) DEFAULT NULL,
  `dia_atencion_semana_id` int(11) NOT NULL,
  `dia_atencion_fecha` date DEFAULT NULL,
  `dia_atencion_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dia_atencion`
--

INSERT INTO `dia_atencion` (`dia_atencion_id`, `dia_atencion_dia`, `dia_atencion_mes`, `dia_atencion_semana_id`, `dia_atencion_fecha`, `dia_atencion_estado`) VALUES
(1, 1, 1, 1, '2018-01-01', 0),
(2, 2, 1, 1, '2018-01-02', 1),
(3, 3, 1, 1, '2018-01-03', 1),
(4, 4, 1, 1, '2018-01-04', 1),
(5, 5, 1, 1, '2018-01-05', 1),
(6, 8, 1, 2, '2018-01-08', 1),
(7, 9, 1, 2, '2018-01-09', 1),
(8, 10, 1, 2, '2018-01-10', 1),
(9, 11, 1, 2, '2018-01-11', 1),
(10, 12, 1, 2, '2018-01-12', 1),
(11, 15, 1, 3, '2018-01-15', 1),
(12, 16, 1, 3, '2018-01-16', 1),
(13, 17, 1, 3, '2018-01-17', 1),
(14, 18, 1, 3, '2018-01-18', 1),
(15, 19, 1, 3, '2018-01-19', 1),
(16, 22, 1, 4, '2018-01-22', 1),
(17, 23, 1, 4, '2018-01-23', 1),
(18, 24, 1, 4, '2018-01-24', 1),
(19, 25, 1, 4, '2018-01-25', 1),
(20, 26, 1, 4, '2018-01-26', 1),
(21, 29, 1, 5, '2018-01-29', 1),
(22, 30, 1, 5, '2018-01-30', 1),
(23, 31, 1, 5, '2018-01-31', 1),
(24, 1, 2, 5, '2018-02-01', 0),
(25, 2, 2, 5, '2018-02-02', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_academico`
--

CREATE TABLE `estado_academico` (
  `estado_academico_id` int(11) NOT NULL,
  `estado_academico_nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

CREATE TABLE `estado_civil` (
  `estado_civil_id` int(11) NOT NULL,
  `estado_civil_tipo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_reserva`
--

CREATE TABLE `estado_reserva` (
  `estado_reserva_id` int(11) NOT NULL,
  `estado_reserva_texto` varchar(20) NOT NULL COMMENT 'reserva,anula,asiste,no asiste'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `estudios_id` int(11) NOT NULL,
  `estudios_codigo` int(11) NOT NULL,
  `estudios_tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `facultad_id` int(11) NOT NULL,
  `facultad_nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`facultad_id`, `facultad_nombre`) VALUES
(1, 'Facultad de Historia y Geografia'),
(2, 'Facultad de Artes y EducaciÃ³n FÃ­sica'),
(3, 'Facultad de Ciencias BÃ¡sicas'),
(4, 'Facultad de FilosofÃ­a y EducaciÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_atencion`
--

CREATE TABLE `forma_atencion` (
  `forma_atencion_id` int(11) NOT NULL,
  `forma_atencion_texto` varchar(15) DEFAULT NULL COMMENT 'presencial, correo, telefono',
  `forma_atencion_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `forma_atencion`
--

INSERT INTO `forma_atencion` (`forma_atencion_id`, `forma_atencion_texto`, `forma_atencion_estado`) VALUES
(0, 'Presencial', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuas`
--

CREATE TABLE `fuas` (
  `fuas_id` int(11) NOT NULL,
  `fuas_tiene_discapacidad` tinyint(4) NOT NULL,
  `fuas_discapacidad` varchar(50) NOT NULL,
  `fuas_pueblo_originario` varchar(50) NOT NULL,
  `fuas_nacionalidad_id` int(11) NOT NULL,
  `fuas_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fuas_alu_id` int(11) NOT NULL,
  `fuas_periodo_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuas_becas_externas`
--

CREATE TABLE `fuas_becas_externas` (
  `fuas_becas_externas_fuas_id` int(11) NOT NULL,
  `fuas_becas_externas_becas_externas_id` int(11) NOT NULL,
  `fuas_becas_externas_fecha_registro` datetime NOT NULL,
  `fuas_becas_externas_aceptada` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuas_periodo`
--

CREATE TABLE `fuas_periodo` (
  `fuas_periodo_id` varchar(10) NOT NULL COMMENT 'la forma de enumerarla deberia ser año + periodo = 201802',
  `fuas_periodo_fecha_inicio_proceso` datetime NOT NULL,
  `fuas_periodo_fecha_baja_form` datetime DEFAULT NULL,
  `fuas_periodo_fecha_cierre_proceso` datetime NOT NULL,
  `fuas_periodo_activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cambios`
--

CREATE TABLE `historial_cambios` (
  `historial_cambios_id` int(11) NOT NULL,
  `historial_cambios_tipo_cambio_id` int(11) NOT NULL,
  `historial_cambios_tabla` varchar(128) NOT NULL,
  `historial_cambios_pk` varchar(255) NOT NULL,
  `historial_cambios_campo_nombre` varchar(128) NOT NULL,
  `historial_cambios_valor_anterior` varchar(1000) NOT NULL,
  `historial_cambios_valor_nuevo` varchar(1000) NOT NULL,
  `historial_cambios_fecha_transaccion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `historial_cambios_usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hogar`
--

CREATE TABLE `hogar` (
  `hogar_id` int(11) NOT NULL,
  `hogar_direccion` varchar(100) NOT NULL,
  `hogar_comuna_id` int(11) NOT NULL,
  `hogar_ciudad` varchar(45) NOT NULL,
  `hogar_telefono` varchar(45) NOT NULL,
  `hogar_vivienda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_atencion`
--

CREATE TABLE `hora_atencion` (
  `hora_atencion_id` int(11) NOT NULL,
  `hora_atencion_hora` time NOT NULL,
  `hora_atencion_orden` int(11) NOT NULL COMMENT 'de 10 en 10',
  `hora_atencion_tipo` int(11) DEFAULT NULL COMMENT '1:normal,2:sobrecupo',
  `hora_atencion_dia_atencion_id` int(11) NOT NULL,
  `hora_atencion_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hora_atencion`
--

INSERT INTO `hora_atencion` (`hora_atencion_id`, `hora_atencion_hora`, `hora_atencion_orden`, `hora_atencion_tipo`, `hora_atencion_dia_atencion_id`, `hora_atencion_estado`) VALUES
(1, '09:00:00', 10, 1, 2, 1),
(2, '09:20:00', 20, 1, 2, 1),
(3, '09:40:00', 30, 1, 2, 1),
(4, '10:00:00', 40, 1, 2, 1),
(5, '10:20:00', 50, 1, 2, 1),
(6, '10:40:00', 60, 1, 2, 1),
(7, '11:00:00', 70, 1, 2, 1),
(8, '11:20:00', 80, 1, 2, 1),
(9, '11:40:00', 90, 1, 2, 1),
(10, '12:00:00', 100, 1, 2, 1),
(11, '12:20:00', 110, 1, 2, 1),
(12, '14:20:00', 120, 1, 2, 1),
(13, '14:40:00', 130, 1, 2, 1),
(14, '15:00:00', 140, 1, 2, 1),
(15, '15:20:00', 150, 1, 2, 1),
(16, '15:40:00', 160, 1, 2, 1),
(17, '16:00:00', 170, 1, 2, 1),
(18, '16:20:00', 180, 1, 2, 1),
(19, '09:00:00', 10, 1, 3, 1),
(20, '09:20:00', 20, 1, 3, 1),
(21, '09:40:00', 30, 1, 3, 1),
(22, '10:00:00', 40, 1, 3, 1),
(23, '10:20:00', 50, 1, 3, 1),
(24, '10:40:00', 60, 1, 3, 1),
(25, '11:00:00', 70, 1, 3, 1),
(26, '11:20:00', 80, 1, 3, 1),
(27, '11:40:00', 90, 1, 3, 1),
(28, '12:00:00', 100, 1, 3, 1),
(29, '12:20:00', 110, 1, 3, 1),
(30, '14:20:00', 120, 1, 3, 1),
(31, '14:40:00', 130, 1, 3, 1),
(32, '15:00:00', 140, 1, 3, 1),
(33, '15:20:00', 150, 1, 3, 1),
(34, '15:40:00', 160, 1, 3, 1),
(35, '16:00:00', 170, 1, 3, 1),
(36, '16:20:00', 180, 1, 3, 1),
(37, '09:00:00', 10, 1, 4, 1),
(38, '09:20:00', 20, 1, 4, 1),
(39, '09:40:00', 30, 1, 4, 1),
(40, '10:00:00', 40, 1, 4, 1),
(41, '10:20:00', 50, 1, 4, 1),
(42, '10:40:00', 60, 1, 4, 1),
(43, '11:00:00', 70, 1, 4, 1),
(44, '11:20:00', 80, 1, 4, 1),
(45, '11:40:00', 90, 1, 4, 1),
(46, '12:00:00', 100, 1, 4, 1),
(47, '12:20:00', 110, 1, 4, 1),
(48, '14:20:00', 120, 1, 4, 1),
(49, '14:40:00', 130, 1, 4, 1),
(50, '15:00:00', 140, 1, 4, 1),
(51, '15:20:00', 150, 1, 4, 1),
(52, '15:40:00', 160, 1, 4, 1),
(53, '16:00:00', 170, 1, 4, 1),
(54, '16:20:00', 180, 1, 4, 1),
(55, '09:00:00', 10, 1, 5, 1),
(56, '09:20:00', 20, 1, 5, 1),
(57, '09:40:00', 30, 1, 5, 1),
(58, '10:00:00', 40, 1, 5, 1),
(59, '10:20:00', 50, 1, 5, 1),
(60, '10:40:00', 60, 1, 5, 1),
(61, '11:00:00', 70, 1, 5, 1),
(62, '11:20:00', 80, 1, 5, 1),
(63, '11:40:00', 90, 1, 5, 1),
(64, '12:00:00', 100, 1, 5, 1),
(65, '12:20:00', 110, 1, 5, 1),
(66, '14:20:00', 120, 1, 5, 1),
(67, '14:40:00', 130, 1, 5, 1),
(68, '15:00:00', 140, 1, 5, 1),
(69, '15:20:00', 150, 1, 5, 1),
(70, '15:40:00', 160, 1, 5, 1),
(71, '16:00:00', 170, 1, 5, 1),
(72, '16:20:00', 180, 1, 5, 1),
(73, '09:00:00', 10, 1, 6, 1),
(74, '09:20:00', 20, 1, 6, 1),
(75, '09:40:00', 30, 1, 6, 1),
(76, '10:00:00', 40, 1, 6, 1),
(77, '10:20:00', 50, 1, 6, 1),
(78, '10:40:00', 60, 1, 6, 1),
(79, '11:00:00', 70, 1, 6, 1),
(80, '11:20:00', 80, 1, 6, 1),
(81, '11:40:00', 90, 1, 6, 1),
(82, '12:00:00', 100, 1, 6, 1),
(83, '12:20:00', 110, 1, 6, 1),
(84, '14:20:00', 120, 1, 6, 1),
(85, '14:40:00', 130, 1, 6, 1),
(86, '15:00:00', 140, 1, 6, 1),
(87, '15:20:00', 150, 1, 6, 1),
(88, '15:40:00', 160, 1, 6, 1),
(89, '16:00:00', 170, 1, 6, 1),
(90, '16:20:00', 180, 1, 6, 1),
(91, '09:00:00', 10, 1, 7, 1),
(92, '09:20:00', 20, 1, 7, 1),
(93, '09:40:00', 30, 1, 7, 1),
(94, '10:00:00', 40, 1, 7, 1),
(95, '10:20:00', 50, 1, 7, 1),
(96, '10:40:00', 60, 1, 7, 1),
(97, '11:00:00', 70, 1, 7, 1),
(98, '11:20:00', 80, 1, 7, 1),
(99, '11:40:00', 90, 1, 7, 1),
(100, '12:00:00', 100, 1, 7, 1),
(101, '12:20:00', 110, 1, 7, 1),
(102, '14:20:00', 120, 1, 7, 1),
(103, '14:40:00', 130, 1, 7, 1),
(104, '15:00:00', 140, 1, 7, 1),
(105, '15:20:00', 150, 1, 7, 1),
(106, '15:40:00', 160, 1, 7, 1),
(107, '16:00:00', 170, 1, 7, 1),
(108, '16:20:00', 180, 1, 7, 1),
(109, '09:00:00', 10, 1, 8, 1),
(110, '09:20:00', 20, 1, 8, 1),
(111, '09:40:00', 30, 1, 8, 1),
(112, '10:00:00', 40, 1, 8, 1),
(113, '10:20:00', 50, 1, 8, 1),
(114, '10:40:00', 60, 1, 8, 1),
(115, '11:00:00', 70, 1, 8, 1),
(116, '11:20:00', 80, 1, 8, 1),
(117, '11:40:00', 90, 1, 8, 1),
(118, '12:00:00', 100, 1, 8, 1),
(119, '12:20:00', 110, 1, 8, 1),
(120, '14:20:00', 120, 1, 8, 1),
(121, '14:40:00', 130, 1, 8, 1),
(122, '15:00:00', 140, 1, 8, 1),
(123, '15:20:00', 150, 1, 8, 1),
(124, '15:40:00', 160, 1, 8, 1),
(125, '16:00:00', 170, 1, 8, 1),
(126, '16:20:00', 180, 1, 8, 1),
(127, '09:00:00', 10, 1, 9, 1),
(128, '09:20:00', 20, 1, 9, 1),
(129, '09:40:00', 30, 1, 9, 1),
(130, '10:00:00', 40, 1, 9, 1),
(131, '10:20:00', 50, 1, 9, 1),
(132, '10:40:00', 60, 1, 9, 1),
(133, '11:00:00', 70, 1, 9, 1),
(134, '11:20:00', 80, 1, 9, 1),
(135, '11:40:00', 90, 1, 9, 1),
(136, '12:00:00', 100, 1, 9, 1),
(137, '12:20:00', 110, 1, 9, 1),
(138, '14:20:00', 120, 1, 9, 1),
(139, '14:40:00', 130, 1, 9, 1),
(140, '15:00:00', 140, 1, 9, 1),
(141, '15:20:00', 150, 1, 9, 1),
(142, '15:40:00', 160, 1, 9, 1),
(143, '16:00:00', 170, 1, 9, 1),
(144, '16:20:00', 180, 1, 9, 1),
(145, '09:00:00', 10, 1, 10, 1),
(146, '09:20:00', 20, 1, 10, 1),
(147, '09:40:00', 30, 1, 10, 1),
(148, '10:00:00', 40, 1, 10, 1),
(149, '10:20:00', 50, 1, 10, 1),
(150, '10:40:00', 60, 1, 10, 1),
(151, '11:00:00', 70, 1, 10, 1),
(152, '11:20:00', 80, 1, 10, 1),
(153, '11:40:00', 90, 1, 10, 1),
(154, '12:00:00', 100, 1, 10, 1),
(155, '12:20:00', 110, 1, 10, 1),
(156, '14:20:00', 120, 1, 10, 1),
(157, '14:40:00', 130, 1, 10, 1),
(158, '15:00:00', 140, 1, 10, 1),
(159, '15:20:00', 150, 1, 10, 1),
(160, '15:40:00', 160, 1, 10, 1),
(161, '16:00:00', 170, 1, 10, 1),
(162, '16:20:00', 180, 1, 10, 1),
(163, '09:00:00', 10, 1, 11, 1),
(164, '09:20:00', 20, 1, 11, 1),
(165, '09:40:00', 30, 1, 11, 1),
(166, '10:00:00', 40, 1, 11, 1),
(167, '10:20:00', 50, 1, 11, 1),
(168, '10:40:00', 60, 1, 11, 1),
(169, '11:00:00', 70, 1, 11, 1),
(170, '11:20:00', 80, 1, 11, 1),
(171, '11:40:00', 90, 1, 11, 1),
(172, '12:00:00', 100, 1, 11, 1),
(173, '12:20:00', 110, 1, 11, 1),
(174, '14:20:00', 120, 1, 11, 1),
(175, '14:40:00', 130, 1, 11, 1),
(176, '15:00:00', 140, 1, 11, 1),
(177, '15:20:00', 150, 1, 11, 1),
(178, '15:40:00', 160, 1, 11, 1),
(179, '16:00:00', 170, 1, 11, 1),
(180, '16:20:00', 180, 1, 11, 1),
(181, '09:00:00', 10, 1, 12, 1),
(182, '09:20:00', 20, 1, 12, 1),
(183, '09:40:00', 30, 1, 12, 1),
(184, '10:00:00', 40, 1, 12, 1),
(185, '10:20:00', 50, 1, 12, 1),
(186, '10:40:00', 60, 1, 12, 1),
(187, '11:00:00', 70, 1, 12, 1),
(188, '11:20:00', 80, 1, 12, 1),
(189, '11:40:00', 90, 1, 12, 1),
(190, '12:00:00', 100, 1, 12, 1),
(191, '12:20:00', 110, 1, 12, 1),
(192, '14:20:00', 120, 1, 12, 1),
(193, '14:40:00', 130, 1, 12, 1),
(194, '15:00:00', 140, 1, 12, 1),
(195, '15:20:00', 150, 1, 12, 1),
(196, '15:40:00', 160, 1, 12, 1),
(197, '16:00:00', 170, 1, 12, 1),
(198, '16:20:00', 180, 1, 12, 1),
(199, '09:00:00', 10, 1, 13, 1),
(200, '09:20:00', 20, 1, 13, 1),
(201, '09:40:00', 30, 1, 13, 1),
(202, '10:00:00', 40, 1, 13, 1),
(203, '10:20:00', 50, 1, 13, 1),
(204, '10:40:00', 60, 1, 13, 1),
(205, '11:00:00', 70, 1, 13, 1),
(206, '11:20:00', 80, 1, 13, 1),
(207, '11:40:00', 90, 1, 13, 1),
(208, '12:00:00', 100, 1, 13, 1),
(209, '12:20:00', 110, 1, 13, 1),
(210, '14:20:00', 120, 1, 13, 1),
(211, '14:40:00', 130, 1, 13, 1),
(212, '15:00:00', 140, 1, 13, 1),
(213, '15:20:00', 150, 1, 13, 1),
(214, '15:40:00', 160, 1, 13, 1),
(215, '16:00:00', 170, 1, 13, 1),
(216, '16:20:00', 180, 1, 13, 1),
(217, '09:00:00', 10, 1, 14, 1),
(218, '09:20:00', 20, 1, 14, 1),
(219, '09:40:00', 30, 1, 14, 1),
(220, '10:00:00', 40, 1, 14, 1),
(221, '10:20:00', 50, 1, 14, 1),
(222, '10:40:00', 60, 1, 14, 1),
(223, '11:00:00', 70, 1, 14, 1),
(224, '11:20:00', 80, 1, 14, 1),
(225, '11:40:00', 90, 1, 14, 1),
(226, '12:00:00', 100, 1, 14, 1),
(227, '12:20:00', 110, 1, 14, 1),
(228, '14:20:00', 120, 1, 14, 1),
(229, '14:40:00', 130, 1, 14, 1),
(230, '15:00:00', 140, 1, 14, 1),
(231, '15:20:00', 150, 1, 14, 1),
(232, '15:40:00', 160, 1, 14, 1),
(233, '16:00:00', 170, 1, 14, 1),
(234, '16:20:00', 180, 1, 14, 1),
(235, '09:00:00', 10, 1, 15, 1),
(236, '09:20:00', 20, 1, 15, 1),
(237, '09:40:00', 30, 1, 15, 1),
(238, '10:00:00', 40, 1, 15, 1),
(239, '10:20:00', 50, 1, 15, 1),
(240, '10:40:00', 60, 1, 15, 1),
(241, '11:00:00', 70, 1, 15, 1),
(242, '11:20:00', 80, 1, 15, 1),
(243, '11:40:00', 90, 1, 15, 1),
(244, '12:00:00', 100, 1, 15, 1),
(245, '12:20:00', 110, 1, 15, 1),
(246, '14:20:00', 120, 1, 15, 1),
(247, '14:40:00', 130, 1, 15, 1),
(248, '15:00:00', 140, 1, 15, 1),
(249, '15:20:00', 150, 1, 15, 1),
(250, '15:40:00', 160, 1, 15, 1),
(251, '16:00:00', 170, 1, 15, 1),
(252, '16:20:00', 180, 1, 15, 1),
(253, '09:00:00', 10, 1, 16, 1),
(254, '09:20:00', 20, 1, 16, 1),
(255, '09:40:00', 30, 1, 16, 1),
(256, '10:00:00', 40, 1, 16, 1),
(257, '10:20:00', 50, 1, 16, 1),
(258, '10:40:00', 60, 1, 16, 1),
(259, '11:00:00', 70, 1, 16, 1),
(260, '11:20:00', 80, 1, 16, 1),
(261, '11:40:00', 90, 1, 16, 1),
(262, '12:00:00', 100, 1, 16, 1),
(263, '12:20:00', 110, 1, 16, 1),
(264, '14:20:00', 120, 1, 16, 1),
(265, '14:40:00', 130, 1, 16, 1),
(266, '15:00:00', 140, 1, 16, 1),
(267, '15:20:00', 150, 1, 16, 1),
(268, '15:40:00', 160, 1, 16, 1),
(269, '16:00:00', 170, 1, 16, 1),
(270, '16:20:00', 180, 1, 16, 1),
(271, '09:00:00', 10, 1, 17, 1),
(272, '09:20:00', 20, 1, 17, 1),
(273, '09:40:00', 30, 1, 17, 1),
(274, '10:00:00', 40, 1, 17, 1),
(275, '10:20:00', 50, 1, 17, 1),
(276, '10:40:00', 60, 1, 17, 1),
(277, '11:00:00', 70, 1, 17, 1),
(278, '11:20:00', 80, 1, 17, 1),
(279, '11:40:00', 90, 1, 17, 1),
(280, '12:00:00', 100, 1, 17, 1),
(281, '12:20:00', 110, 1, 17, 1),
(282, '14:20:00', 120, 1, 17, 1),
(283, '14:40:00', 130, 1, 17, 1),
(284, '15:00:00', 140, 1, 17, 1),
(285, '15:20:00', 150, 1, 17, 1),
(286, '15:40:00', 160, 1, 17, 1),
(287, '16:00:00', 170, 1, 17, 1),
(288, '16:20:00', 180, 1, 17, 1),
(289, '09:00:00', 10, 1, 18, 1),
(290, '09:20:00', 20, 1, 18, 1),
(291, '09:40:00', 30, 1, 18, 1),
(292, '10:00:00', 40, 1, 18, 1),
(293, '10:20:00', 50, 1, 18, 1),
(294, '10:40:00', 60, 1, 18, 1),
(295, '11:00:00', 70, 1, 18, 1),
(296, '11:20:00', 80, 1, 18, 1),
(297, '11:40:00', 90, 1, 18, 1),
(298, '12:00:00', 100, 1, 18, 1),
(299, '12:20:00', 110, 1, 18, 1),
(300, '14:20:00', 120, 1, 18, 1),
(301, '14:40:00', 130, 1, 18, 1),
(302, '15:00:00', 140, 1, 18, 1),
(303, '15:20:00', 150, 1, 18, 1),
(304, '15:40:00', 160, 1, 18, 1),
(305, '16:00:00', 170, 1, 18, 1),
(306, '16:20:00', 180, 1, 18, 1),
(307, '09:00:00', 10, 1, 19, 1),
(308, '09:20:00', 20, 1, 19, 1),
(309, '09:40:00', 30, 1, 19, 1),
(310, '10:00:00', 40, 1, 19, 1),
(311, '10:20:00', 50, 1, 19, 1),
(312, '10:40:00', 60, 1, 19, 1),
(313, '11:00:00', 70, 1, 19, 1),
(314, '11:20:00', 80, 1, 19, 1),
(315, '11:40:00', 90, 1, 19, 1),
(316, '12:00:00', 100, 1, 19, 1),
(317, '12:20:00', 110, 1, 19, 1),
(318, '14:20:00', 120, 1, 19, 1),
(319, '14:40:00', 130, 1, 19, 1),
(320, '15:00:00', 140, 1, 19, 1),
(321, '15:20:00', 150, 1, 19, 1),
(322, '15:40:00', 160, 1, 19, 1),
(323, '16:00:00', 170, 1, 19, 1),
(324, '16:20:00', 180, 1, 19, 1),
(325, '09:00:00', 10, 1, 20, 1),
(326, '09:20:00', 20, 1, 20, 1),
(327, '09:40:00', 30, 1, 20, 1),
(328, '10:00:00', 40, 1, 20, 1),
(329, '10:20:00', 50, 1, 20, 1),
(330, '10:40:00', 60, 1, 20, 1),
(331, '11:00:00', 70, 1, 20, 1),
(332, '11:20:00', 80, 1, 20, 1),
(333, '11:40:00', 90, 1, 20, 1),
(334, '12:00:00', 100, 1, 20, 1),
(335, '12:20:00', 110, 1, 20, 1),
(336, '14:20:00', 120, 1, 20, 1),
(337, '14:40:00', 130, 1, 20, 1),
(338, '15:00:00', 140, 1, 20, 1),
(339, '15:20:00', 150, 1, 20, 1),
(340, '15:40:00', 160, 1, 20, 1),
(341, '16:00:00', 170, 1, 20, 1),
(342, '16:20:00', 180, 1, 20, 1),
(343, '09:00:00', 10, 1, 21, 1),
(344, '09:20:00', 20, 1, 21, 1),
(345, '09:40:00', 30, 1, 21, 1),
(346, '10:00:00', 40, 1, 21, 1),
(347, '10:20:00', 50, 1, 21, 1),
(348, '10:40:00', 60, 1, 21, 1),
(349, '11:00:00', 70, 1, 21, 1),
(350, '11:20:00', 80, 1, 21, 1),
(351, '11:40:00', 90, 1, 21, 1),
(352, '12:00:00', 100, 1, 21, 1),
(353, '12:20:00', 110, 1, 21, 1),
(354, '14:20:00', 120, 1, 21, 1),
(355, '14:40:00', 130, 1, 21, 1),
(356, '15:00:00', 140, 1, 21, 1),
(357, '15:20:00', 150, 1, 21, 1),
(358, '15:40:00', 160, 1, 21, 1),
(359, '16:00:00', 170, 1, 21, 1),
(360, '16:20:00', 180, 1, 21, 1),
(361, '09:00:00', 10, 1, 22, 1),
(362, '09:20:00', 20, 1, 22, 1),
(363, '09:40:00', 30, 1, 22, 1),
(364, '10:00:00', 40, 1, 22, 1),
(365, '10:20:00', 50, 1, 22, 1),
(366, '10:40:00', 60, 1, 22, 1),
(367, '11:00:00', 70, 1, 22, 1),
(368, '11:20:00', 80, 1, 22, 1),
(369, '11:40:00', 90, 1, 22, 1),
(370, '12:00:00', 100, 1, 22, 1),
(371, '12:20:00', 110, 1, 22, 1),
(372, '14:20:00', 120, 1, 22, 1),
(373, '14:40:00', 130, 1, 22, 1),
(374, '15:00:00', 140, 1, 22, 1),
(375, '15:20:00', 150, 1, 22, 1),
(376, '15:40:00', 160, 1, 22, 1),
(377, '16:00:00', 170, 1, 22, 1),
(378, '16:20:00', 180, 1, 22, 1),
(379, '09:00:00', 10, 1, 23, 1),
(380, '09:20:00', 20, 1, 23, 1),
(381, '09:40:00', 30, 1, 23, 1),
(382, '10:00:00', 40, 1, 23, 1),
(383, '10:20:00', 50, 1, 23, 1),
(384, '10:40:00', 60, 1, 23, 1),
(385, '11:00:00', 70, 1, 23, 1),
(386, '11:20:00', 80, 1, 23, 1),
(387, '11:40:00', 90, 1, 23, 1),
(388, '12:00:00', 100, 1, 23, 1),
(389, '12:20:00', 110, 1, 23, 1),
(390, '14:20:00', 120, 1, 23, 1),
(391, '14:40:00', 130, 1, 23, 1),
(392, '15:00:00', 140, 1, 23, 1),
(393, '15:20:00', 150, 1, 23, 1),
(394, '15:40:00', 160, 1, 23, 1),
(395, '16:00:00', 170, 1, 23, 1),
(396, '16:20:00', 180, 1, 23, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `ingresos_id` int(11) NOT NULL,
  `ingresos_rut` varchar(10) DEFAULT NULL,
  `ingresos_sueldo` int(11) DEFAULT NULL,
  `ingresos_honorarios` int(11) DEFAULT NULL,
  `ingresos_retiro` int(11) DEFAULT NULL,
  `ingresos_pension` int(11) DEFAULT NULL,
  `ingresos_actividad_independiente` int(11) DEFAULT NULL,
  `ingresos_otros` int(11) DEFAULT NULL,
  `ingresos_total` int(11) DEFAULT NULL,
  `ingresos_fecha_registro` timestamp NULL DEFAULT NULL,
  `ingresos_resp_ingreso` enum('estudiante','asistente') NOT NULL,
  `ingresos_fuas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `jornada_id` int(11) NOT NULL,
  `jornada_nombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_origen`
--

CREATE TABLE `modulo_origen` (
  `modulo_origen_id` int(11) NOT NULL,
  `modulo_origen_tipo` varchar(45) NOT NULL COMMENT '''becas'', ''fuas'', ''atencion'', cada vez que se cree un nuevo periodo de fuas , el sistema deberá crear una nueva instacia de fuas del tipo "fuas201802"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_atencion`
--

CREATE TABLE `motivo_atencion` (
  `motivo_atencion_id` int(11) NOT NULL,
  `motivo_atencion_texto` varchar(40) DEFAULT NULL,
  `motivo_atencion_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `motivo_atencion`
--

INSERT INTO `motivo_atencion` (`motivo_atencion_id`, `motivo_atencion_texto`, `motivo_atencion_estado`) VALUES
(1, 'Crédito', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidad`
--

CREATE TABLE `nacionalidad` (
  `nacionalidad_id` int(11) NOT NULL,
  `nacionalidad_pais` varchar(50) DEFAULT NULL,
  `nacionalidad_gentilicio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nuevo_campo`
--

CREATE TABLE `nuevo_campo` (
  `nuevo_campo_id` int(11) NOT NULL,
  `nuevo_campo_texto` varchar(60) DEFAULT NULL,
  `nuevo_campo_tipodato` varchar(20) DEFAULT NULL,
  `nuevo_campo_estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones`
--

CREATE TABLE `observaciones` (
  `observaciones_id` int(11) NOT NULL,
  `observaciones_comentario` varchar(500) DEFAULT NULL,
  `observaciones_fecha` timestamp NULL DEFAULT NULL,
  `fuas_fuas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `parentesco_id` int(11) NOT NULL,
  `parentesco_tipo` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_dae`
--

CREATE TABLE `personas_dae` (
  `personas_dae_id` int(11) NOT NULL,
  `personas_dae_nombres` varchar(30) NOT NULL,
  `personas_dae_apellidos` varchar(40) NOT NULL,
  `personas_dae_correo` varchar(100) DEFAULT NULL,
  `personas_dae_anexo` varchar(5) DEFAULT NULL,
  `personas_dae_usuarios_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas_dae`
--

INSERT INTO `personas_dae` (`personas_dae_id`, `personas_dae_nombres`, `personas_dae_apellidos`, `personas_dae_correo`, `personas_dae_anexo`, `personas_dae_usuarios_id`) VALUES
(1, 'Luis Alfonso ', 'GarcÃ­a Manzo', 'luis.garcia@umce.cl', '9069', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_hogar`
--

CREATE TABLE `personas_hogar` (
  `personas_hogar_personas_rel_id` int(11) NOT NULL,
  `personas_hogar_hogar_id` int(11) NOT NULL,
  `personas_hogar_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `personas_hogar_fuas_id` int(11) NOT NULL,
  `personas_hogar_resp_ingreso` enum('estudiante','asistente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_relacionadas`
--

CREATE TABLE `personas_relacionadas` (
  `personas_rel_id` int(11) NOT NULL,
  `personas_rel_rut` varchar(10) NOT NULL,
  `personas_rel_ap_pat` varchar(50) NOT NULL,
  `personas_rel_ap_mat` varchar(50) NOT NULL,
  `personas_rel_nombres` varchar(80) NOT NULL,
  `personas_rel_edad` int(11) NOT NULL,
  `personas_rel_sexo` char(1) DEFAULT NULL,
  `personas_rel_vive` tinyint(4) DEFAULT NULL,
  `personas_rel_prevision_social_id` int(11) NOT NULL,
  `personas_rel_estado_civil_id` int(11) NOT NULL,
  `personas_rel_parentesco_id` int(11) NOT NULL,
  `personas_rel_estudios_id` int(11) NOT NULL,
  `personas_rel_actividad_id` int(11) NOT NULL,
  `personas_rel_prevision_salud_id` int(11) NOT NULL,
  `personas_rel_alu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prevision_salud`
--

CREATE TABLE `prevision_salud` (
  `prevision_salud_id` int(11) NOT NULL,
  `prevision_salud_tipo` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prevision_social`
--

CREATE TABLE `prevision_social` (
  `prevision_social_id` int(11) NOT NULL,
  `prevision_social_tipo` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `region_id` int(11) NOT NULL,
  `region_nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_atencion`
--

CREATE TABLE `reserva_atencion` (
  `reserva_atencion_id` int(11) NOT NULL,
  `reserva_atencion_alumno_ate_id` int(11) NOT NULL,
  `reserva_atencion_agenda_dae_id` int(11) NOT NULL,
  `estado_reserva_estado_reserva_id` int(11) NOT NULL,
  `reserva_atencion_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`rol_id`, `rol_nombre`) VALUES
(1, 'Administrador'),
(2, 'Asistente'),
(3, 'Secretaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semana`
--

CREATE TABLE `semana` (
  `semana_id` int(11) NOT NULL,
  `semana_numero` int(11) NOT NULL,
  `semana_agno` int(11) NOT NULL,
  `semana_texto` varchar(45) NOT NULL,
  `semana_fechalunes` date NOT NULL,
  `semana_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `semana`
--

INSERT INTO `semana` (`semana_id`, `semana_numero`, `semana_agno`, `semana_texto`, `semana_fechalunes`, `semana_estado`) VALUES
(1, 1, 2018, 'Semana 1', '2018-01-01', 1),
(2, 2, 2018, 'Semana 2', '2018-01-08', 1),
(3, 3, 2018, 'Semana 3', '2018-01-15', 1),
(4, 4, 2018, 'Semana 4', '2018-01-22', 1),
(5, 5, 2018, 'Semana 5', '2018-01-29', 1),
(6, 6, 2018, 'Semana 6', '2018-02-05', 0),
(7, 7, 2018, 'Semana 7', '2018-02-12', 0),
(8, 8, 2018, 'Semana 8', '2018-02-19', 0),
(9, 9, 2018, 'Semana 9', '2018-02-26', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_archivo`
--

CREATE TABLE `tipo_archivo` (
  `tipo_archivo_id` int(11) NOT NULL,
  `tipo_archivo_texto` varchar(100) DEFAULT NULL,
  `tipo_archivo_prefijo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_bloqueo`
--

CREATE TABLE `tipo_bloqueo` (
  `tipo_bloqueo_id` int(11) NOT NULL,
  `tipo_bloqueo_descripcion` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_bloqueo`
--

INSERT INTO `tipo_bloqueo` (`tipo_bloqueo_id`, `tipo_bloqueo_descripcion`) VALUES
(1, 'Feriado Legal'),
(2, 'Inter-feriado Institucional'),
(3, 'Vacaciones'),
(4, 'Vacaciones de Invierno'),
(5, 'Receso Fiestas Patrias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE `tipo_cambio` (
  `tipo_cambio_id` int(11) NOT NULL,
  `tipo_cambio_descripcion` varchar(30) NOT NULL COMMENT 'elimina, modifica, inserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_jornada`
--

CREATE TABLE `tipo_jornada` (
  `tipo_jornada_id` int(11) NOT NULL,
  `tipo_jornada_descripcion` varchar(20) NOT NULL,
  `tipo_jornada_hora_inicio` time NOT NULL,
  `tipo_jornada_hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_jornada`
--

INSERT INTO `tipo_jornada` (`tipo_jornada_id`, `tipo_jornada_descripcion`, `tipo_jornada_hora_inicio`, `tipo_jornada_hora_fin`) VALUES
(1, 'Dia Completo', '09:00:00', '16:30:00'),
(2, 'Mañana', '09:00:00', '12:30:00'),
(3, 'Tarde', '14:20:00', '16:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL,
  `usuarios_username` varchar(100) NOT NULL,
  `usuarios_password` varchar(50) NOT NULL,
  `usuarios_activo` tinyint(4) NOT NULL,
  `usuarios_token_seguridad` varchar(255) DEFAULT NULL,
  `usuarios_rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_username`, `usuarios_password`, `usuarios_activo`, `usuarios_token_seguridad`, `usuarios_rol_id`) VALUES
(1, 'lgarcia', 'e2b23dafc9ca8ff2451e1b297803248e', 1, NULL, 1),
(2, 'calvarez', '82c2b9d88058a57f6c2d9c40e43ec01f', 0, NULL, 2),
(4, 'agarcia', '6e024e89638db03836d13d352497daa9', 1, NULL, 1),
(5, 'bbarahona', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 2),
(6, 'amanzo', '6deb4a7017bc6d5f24c0d8ee16a876dc', 1, NULL, 2),
(7, 'jromero', 'dc3f44fcc1f2b475bf18ee6d6c2c4d5c', 1, NULL, 2),
(8, 'ppiÃ±ones', '9d189d168a4249a863c95bdfe2180b16', 1, NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `vivienda_id` int(11) NOT NULL,
  `vivienda_tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`actividad_id`);

--
-- Indices de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD PRIMARY KEY (`adjuntos_id`),
  ADD KEY `fk_adjuntos_alumnos_datos_externos1_idx` (`adjuntos_alu_id`),
  ADD KEY `fk_adjuntos_tipo_archivo1_idx` (`adjuntos_tipo_archivo_id`),
  ADD KEY `fk_adjuntos_modulo_origen1_idx` (`adjuntos_modulo_origen_id`);

--
-- Indices de la tabla `agenda_dae`
--
ALTER TABLE `agenda_dae`
  ADD PRIMARY KEY (`agenda_dae_id`),
  ADD KEY `fk_personas_dae_has_hora_atencion_hora_atencion1_idx` (`agenda_dae_hora_atencion_id`),
  ADD KEY `fk_personas_dae_has_hora_atencion_personas_dae1_idx` (`agenda_dae_personas_dae_id`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alu_id`),
  ADD KEY `fk_alumnos_jornada_idx` (`alu_jornada_id`),
  ADD KEY `fk_alumnos_descripcion_situacion_academica1_idx` (`alu_descripcion_situacion_academica_id`),
  ADD KEY `fk_alumnos_estado_academico1_idx` (`alu_estado_academico_id`),
  ADD KEY `fk_alumnos_categoria_academica1_idx` (`alu_categoria_academica_id`),
  ADD KEY `fk_alumnos_carreras1_idx` (`alu_carrera_id`);

--
-- Indices de la tabla `alumnos_datos_externos`
--
ALTER TABLE `alumnos_datos_externos`
  ADD PRIMARY KEY (`alumnos_datos_ext_alu_id`),
  ADD KEY `fk_alumnos_datos_externos_usuarios1_idx` (`alumnos_datos_ext_username`);

--
-- Indices de la tabla `alumnos_tiene_becasycreditos`
--
ALTER TABLE `alumnos_tiene_becasycreditos`
  ADD PRIMARY KEY (`alu_tiene_beca_id`),
  ADD KEY `fk_alumnos_tiene_becasycreditos_alumnos_datos_externos1_idx` (`alu_tiene_beca_alu_id`);

--
-- Indices de la tabla `alumno_atencion`
--
ALTER TABLE `alumno_atencion`
  ADD PRIMARY KEY (`alumno_ate_id`),
  ADD KEY `fk_alumno_atencion_forma_atencion1_idx` (`alumno_ate_forma_atencion_id`),
  ADD KEY `fk_alumno_atencion_motivo_atencion1_idx` (`alumno_ate_motivo_atencion_id`),
  ADD KEY `fk_alumno_atencion_detalle_atencion1_idx` (`alumno_ate_detalle_atencion_id`);

--
-- Indices de la tabla `alumno_datos_anexos`
--
ALTER TABLE `alumno_datos_anexos`
  ADD PRIMARY KEY (`alu_dto_anexos_id`);

--
-- Indices de la tabla `alumno_hogar`
--
ALTER TABLE `alumno_hogar`
  ADD PRIMARY KEY (`alumno_hogar_hogar_id`,`alumno_hogar_alu_id`),
  ADD KEY `fk_hogar_has_alumnos_datos_externos_alumnos_datos_externos1_idx` (`alumno_hogar_alu_id`),
  ADD KEY `fk_hogar_has_alumnos_datos_externos_hogar1_idx` (`alumno_hogar_hogar_id`),
  ADD KEY `fk_alumno_hogar_fuas1_idx` (`alumno_hogar_fuas_id`);

--
-- Indices de la tabla `alu_anexo_tiene_campo`
--
ALTER TABLE `alu_anexo_tiene_campo`
  ADD PRIMARY KEY (`alu_anexo_tiene_campo_alu_dto_anexos_id`,`alu_anexo_tiene_campo_nuevo_campo_id`,`alu_anexo_tiene_campo_id`),
  ADD KEY `fk_alumno_datos_anexos_has_nuevo_campo_nuevo_campo1_idx` (`alu_anexo_tiene_campo_nuevo_campo_id`),
  ADD KEY `fk_alumno_datos_anexos_has_nuevo_campo_alumno_datos_anexos1_idx` (`alu_anexo_tiene_campo_alu_dto_anexos_id`);

--
-- Indices de la tabla `asigna_carreras`
--
ALTER TABLE `asigna_carreras`
  ADD PRIMARY KEY (`asigna_carreras_id`),
  ADD KEY `fk_personas_dae_has_carreras_carreras1_idx` (`asigna_carreras_carrera_id`),
  ADD KEY `fk_personas_dae_has_carreras_personas_dae1_idx` (`asigna_carreras_personas_dae_id`);

--
-- Indices de la tabla `becas_externas`
--
ALTER TABLE `becas_externas`
  ADD PRIMARY KEY (`becas_externas_id`);

--
-- Indices de la tabla `becas_internas`
--
ALTER TABLE `becas_internas`
  ADD PRIMARY KEY (`becas_internas_id`);

--
-- Indices de la tabla `becas_periodo`
--
ALTER TABLE `becas_periodo`
  ADD PRIMARY KEY (`becas_periodo_id`),
  ADD KEY `fk_becas_periodo_becas_internas1_idx` (`becas_periodo_becas_internas_id`);

--
-- Indices de la tabla `calendario_feriadosbloqueados`
--
ALTER TABLE `calendario_feriadosbloqueados`
  ADD PRIMARY KEY (`cal_feriadosbloqueados_id`),
  ADD KEY `fk_calendario_feriadosbloqueados_tipo_bloqueo1_idx` (`cal_feriadosbloqueados_tipo_bloqueo_id`),
  ADD KEY `fk_calendario_feriadosbloqueados_tipo_jornada1_idx` (`cal_feriadosbloqueados_tipo_jornada_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`carrera_id`),
  ADD KEY `fk_carreras_facultad1_idx` (`carrera_facultad_id`);

--
-- Indices de la tabla `categoria_academica`
--
ALTER TABLE `categoria_academica`
  ADD PRIMARY KEY (`categoria_academica_id`);

--
-- Indices de la tabla `codigo_atencion`
--
ALTER TABLE `codigo_atencion`
  ADD PRIMARY KEY (`codigo_atencion_id`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`comuna_id`,`comuna_region_id`),
  ADD KEY `fk_comuna_region1_idx` (`comuna_region_id`);

--
-- Indices de la tabla `descripcion_situacion_academica`
--
ALTER TABLE `descripcion_situacion_academica`
  ADD PRIMARY KEY (`descripcion_situacion_academica_id`);

--
-- Indices de la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  ADD PRIMARY KEY (`detalle_atencion_id`);

--
-- Indices de la tabla `dia_atencion`
--
ALTER TABLE `dia_atencion`
  ADD PRIMARY KEY (`dia_atencion_id`),
  ADD KEY `fk_dia_atencion_semana1_idx` (`dia_atencion_semana_id`);

--
-- Indices de la tabla `estado_academico`
--
ALTER TABLE `estado_academico`
  ADD PRIMARY KEY (`estado_academico_id`);

--
-- Indices de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  ADD PRIMARY KEY (`estado_civil_id`);

--
-- Indices de la tabla `estado_reserva`
--
ALTER TABLE `estado_reserva`
  ADD PRIMARY KEY (`estado_reserva_id`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`estudios_id`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`facultad_id`);

--
-- Indices de la tabla `forma_atencion`
--
ALTER TABLE `forma_atencion`
  ADD PRIMARY KEY (`forma_atencion_id`);

--
-- Indices de la tabla `fuas`
--
ALTER TABLE `fuas`
  ADD PRIMARY KEY (`fuas_id`),
  ADD KEY `fk_fuas_nacionalidad1_idx` (`fuas_nacionalidad_id`),
  ADD KEY `fk_fuas_alumnos_datos_externos1_idx` (`fuas_alu_id`),
  ADD KEY `fk_fuas_fuas_periodo1_idx` (`fuas_periodo_id`);

--
-- Indices de la tabla `fuas_becas_externas`
--
ALTER TABLE `fuas_becas_externas`
  ADD PRIMARY KEY (`fuas_becas_externas_fuas_id`,`fuas_becas_externas_becas_externas_id`),
  ADD KEY `fk_fuas_has_becas_externas_becas_externas1_idx` (`fuas_becas_externas_becas_externas_id`),
  ADD KEY `fk_fuas_has_becas_externas_fuas1_idx` (`fuas_becas_externas_fuas_id`);

--
-- Indices de la tabla `fuas_periodo`
--
ALTER TABLE `fuas_periodo`
  ADD PRIMARY KEY (`fuas_periodo_id`);

--
-- Indices de la tabla `historial_cambios`
--
ALTER TABLE `historial_cambios`
  ADD PRIMARY KEY (`historial_cambios_id`),
  ADD KEY `fk_historial_cambios_tipo_cambio1_idx` (`historial_cambios_tipo_cambio_id`),
  ADD KEY `fk_historial_cambios_usuarios1_idx` (`historial_cambios_usuarios_id`);

--
-- Indices de la tabla `hogar`
--
ALTER TABLE `hogar`
  ADD PRIMARY KEY (`hogar_id`),
  ADD KEY `fk_hogar_vivienda1_idx` (`hogar_vivienda_id`),
  ADD KEY `fk_hogar_comuna1_idx` (`hogar_comuna_id`);

--
-- Indices de la tabla `hora_atencion`
--
ALTER TABLE `hora_atencion`
  ADD PRIMARY KEY (`hora_atencion_id`),
  ADD KEY `fk_hora_atencion_dia_atencion1_idx` (`hora_atencion_dia_atencion_id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`ingresos_id`),
  ADD KEY `fk_ingresos_fuas1_idx` (`ingresos_fuas_id`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`jornada_id`);

--
-- Indices de la tabla `modulo_origen`
--
ALTER TABLE `modulo_origen`
  ADD PRIMARY KEY (`modulo_origen_id`);

--
-- Indices de la tabla `motivo_atencion`
--
ALTER TABLE `motivo_atencion`
  ADD PRIMARY KEY (`motivo_atencion_id`);

--
-- Indices de la tabla `nacionalidad`
--
ALTER TABLE `nacionalidad`
  ADD PRIMARY KEY (`nacionalidad_id`);

--
-- Indices de la tabla `nuevo_campo`
--
ALTER TABLE `nuevo_campo`
  ADD PRIMARY KEY (`nuevo_campo_id`);

--
-- Indices de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD PRIMARY KEY (`observaciones_id`),
  ADD KEY `fk_observaciones_fuas1_idx` (`fuas_fuas_id`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`parentesco_id`);

--
-- Indices de la tabla `personas_dae`
--
ALTER TABLE `personas_dae`
  ADD PRIMARY KEY (`personas_dae_id`),
  ADD KEY `fk_personas_dae_usuarios1_idx` (`personas_dae_usuarios_id`);

--
-- Indices de la tabla `personas_hogar`
--
ALTER TABLE `personas_hogar`
  ADD PRIMARY KEY (`personas_hogar_personas_rel_id`,`personas_hogar_hogar_id`),
  ADD KEY `fk_personas_relacionadas_has_hogar_hogar1_idx` (`personas_hogar_hogar_id`),
  ADD KEY `fk_personas_relacionadas_has_hogar_personas_relacionadas1_idx` (`personas_hogar_personas_rel_id`),
  ADD KEY `fk_personas_hogar_fuas1_idx` (`personas_hogar_fuas_id`);

--
-- Indices de la tabla `personas_relacionadas`
--
ALTER TABLE `personas_relacionadas`
  ADD PRIMARY KEY (`personas_rel_id`),
  ADD KEY `fk_persona_grupo_prevision_social1_idx` (`personas_rel_prevision_social_id`),
  ADD KEY `fk_persona_grupo_estado_civil1_idx` (`personas_rel_estado_civil_id`),
  ADD KEY `fk_persona_grupo_parentesco1_idx` (`personas_rel_parentesco_id`),
  ADD KEY `fk_persona_grupo_estudios1_idx` (`personas_rel_estudios_id`),
  ADD KEY `fk_persona_grupo_actividad1_idx` (`personas_rel_actividad_id`),
  ADD KEY `fk_persona_grupo_prevision_salud1_idx` (`personas_rel_prevision_salud_id`),
  ADD KEY `fk_personas_relacionadas_alumnos_datos_externos1_idx` (`personas_rel_alu_id`);

--
-- Indices de la tabla `prevision_salud`
--
ALTER TABLE `prevision_salud`
  ADD PRIMARY KEY (`prevision_salud_id`);

--
-- Indices de la tabla `prevision_social`
--
ALTER TABLE `prevision_social`
  ADD PRIMARY KEY (`prevision_social_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`region_id`);

--
-- Indices de la tabla `reserva_atencion`
--
ALTER TABLE `reserva_atencion`
  ADD PRIMARY KEY (`reserva_atencion_id`),
  ADD KEY `fk_alumno_atencion_has_agenda_dae_agenda_dae1_idx` (`reserva_atencion_agenda_dae_id`),
  ADD KEY `fk_alumno_atencion_has_agenda_dae_alumno_atencion1_idx` (`reserva_atencion_alumno_ate_id`),
  ADD KEY `fk_reserva_atencion_estado_reserva1_idx` (`estado_reserva_estado_reserva_id`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `semana`
--
ALTER TABLE `semana`
  ADD PRIMARY KEY (`semana_id`);

--
-- Indices de la tabla `tipo_archivo`
--
ALTER TABLE `tipo_archivo`
  ADD PRIMARY KEY (`tipo_archivo_id`);

--
-- Indices de la tabla `tipo_bloqueo`
--
ALTER TABLE `tipo_bloqueo`
  ADD PRIMARY KEY (`tipo_bloqueo_id`);

--
-- Indices de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD PRIMARY KEY (`tipo_cambio_id`);

--
-- Indices de la tabla `tipo_jornada`
--
ALTER TABLE `tipo_jornada`
  ADD PRIMARY KEY (`tipo_jornada_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`),
  ADD UNIQUE KEY `usuarios_username_UNIQUE` (`usuarios_username`),
  ADD KEY `fk_usuarios_rol_usuario1_idx` (`usuarios_rol_id`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`vivienda_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `actividad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  MODIFY `adjuntos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `agenda_dae`
--
ALTER TABLE `agenda_dae`
  MODIFY `agenda_dae_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumnos_tiene_becasycreditos`
--
ALTER TABLE `alumnos_tiene_becasycreditos`
  MODIFY `alu_tiene_beca_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alumno_atencion`
--
ALTER TABLE `alumno_atencion`
  MODIFY `alumno_ate_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'viene de la tabla de alumnos de la base de dae';

--
-- AUTO_INCREMENT de la tabla `alumno_datos_anexos`
--
ALTER TABLE `alumno_datos_anexos`
  MODIFY `alu_dto_anexos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asigna_carreras`
--
ALTER TABLE `asigna_carreras`
  MODIFY `asigna_carreras_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calendario_feriadosbloqueados`
--
ALTER TABLE `calendario_feriadosbloqueados`
  MODIFY `cal_feriadosbloqueados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `carrera_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria_academica`
--
ALTER TABLE `categoria_academica`
  MODIFY `categoria_academica_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codigo_atencion`
--
ALTER TABLE `codigo_atencion`
  MODIFY `codigo_atencion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `comuna_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descripcion_situacion_academica`
--
ALTER TABLE `descripcion_situacion_academica`
  MODIFY `descripcion_situacion_academica_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_atencion`
--
ALTER TABLE `detalle_atencion`
  MODIFY `detalle_atencion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dia_atencion`
--
ALTER TABLE `dia_atencion`
  MODIFY `dia_atencion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `estado_academico`
--
ALTER TABLE `estado_academico`
  MODIFY `estado_academico_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_civil`
--
ALTER TABLE `estado_civil`
  MODIFY `estado_civil_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_reserva`
--
ALTER TABLE `estado_reserva`
  MODIFY `estado_reserva_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `estudios_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `facultad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fuas`
--
ALTER TABLE `fuas`
  MODIFY `fuas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_cambios`
--
ALTER TABLE `historial_cambios`
  MODIFY `historial_cambios_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hogar`
--
ALTER TABLE `hogar`
  MODIFY `hogar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hora_atencion`
--
ALTER TABLE `hora_atencion`
  MODIFY `hora_atencion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `ingresos_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `jornada_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulo_origen`
--
ALTER TABLE `modulo_origen`
  MODIFY `modulo_origen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivo_atencion`
--
ALTER TABLE `motivo_atencion`
  MODIFY `motivo_atencion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nuevo_campo`
--
ALTER TABLE `nuevo_campo`
  MODIFY `nuevo_campo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `observaciones`
--
ALTER TABLE `observaciones`
  MODIFY `observaciones_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  MODIFY `parentesco_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas_dae`
--
ALTER TABLE `personas_dae`
  MODIFY `personas_dae_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas_relacionadas`
--
ALTER TABLE `personas_relacionadas`
  MODIFY `personas_rel_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prevision_salud`
--
ALTER TABLE `prevision_salud`
  MODIFY `prevision_salud_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prevision_social`
--
ALTER TABLE `prevision_social`
  MODIFY `prevision_social_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva_atencion`
--
ALTER TABLE `reserva_atencion`
  MODIFY `reserva_atencion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `semana`
--
ALTER TABLE `semana`
  MODIFY `semana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_bloqueo`
--
ALTER TABLE `tipo_bloqueo`
  MODIFY `tipo_bloqueo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_jornada`
--
ALTER TABLE `tipo_jornada`
  MODIFY `tipo_jornada_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  MODIFY `vivienda_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adjuntos`
--
ALTER TABLE `adjuntos`
  ADD CONSTRAINT `fk_adjuntos_alumnos_datos_externos1` FOREIGN KEY (`adjuntos_alu_id`) REFERENCES `alumnos_datos_externos` (`alumnos_datos_ext_alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adjuntos_modulo_origen1` FOREIGN KEY (`adjuntos_modulo_origen_id`) REFERENCES `modulo_origen` (`modulo_origen_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adjuntos_tipo_archivo1` FOREIGN KEY (`adjuntos_tipo_archivo_id`) REFERENCES `tipo_archivo` (`tipo_archivo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `agenda_dae`
--
ALTER TABLE `agenda_dae`
  ADD CONSTRAINT `fk_personas_dae_has_hora_atencion_hora_atencion1` FOREIGN KEY (`agenda_dae_hora_atencion_id`) REFERENCES `hora_atencion` (`hora_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_dae_has_hora_atencion_personas_dae1` FOREIGN KEY (`agenda_dae_personas_dae_id`) REFERENCES `personas_dae` (`personas_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumnos_carreras1` FOREIGN KEY (`alu_carrera_id`) REFERENCES `carreras` (`carrera_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_categoria_academica1` FOREIGN KEY (`alu_categoria_academica_id`) REFERENCES `categoria_academica` (`categoria_academica_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_descripcion_situacion_academica1` FOREIGN KEY (`alu_descripcion_situacion_academica_id`) REFERENCES `descripcion_situacion_academica` (`descripcion_situacion_academica_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_estado_academico1` FOREIGN KEY (`alu_estado_academico_id`) REFERENCES `estado_academico` (`estado_academico_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_jornada` FOREIGN KEY (`alu_jornada_id`) REFERENCES `jornada` (`jornada_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumnos_datos_externos`
--
ALTER TABLE `alumnos_datos_externos`
  ADD CONSTRAINT `fk_alumnos_datos_externos_alumnos1` FOREIGN KEY (`alumnos_datos_ext_alu_id`) REFERENCES `alumnos` (`alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumnos_datos_externos_usuarios1` FOREIGN KEY (`alumnos_datos_ext_username`) REFERENCES `usuarios` (`usuarios_username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumnos_tiene_becasycreditos`
--
ALTER TABLE `alumnos_tiene_becasycreditos`
  ADD CONSTRAINT `fk_alumnos_tiene_becasycreditos_alumnos_datos_externos1` FOREIGN KEY (`alu_tiene_beca_alu_id`) REFERENCES `alumnos_datos_externos` (`alumnos_datos_ext_alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno_atencion`
--
ALTER TABLE `alumno_atencion`
  ADD CONSTRAINT `fk_alumno_atencion_detalle_atencion1` FOREIGN KEY (`alumno_ate_detalle_atencion_id`) REFERENCES `detalle_atencion` (`detalle_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_atencion_forma_atencion1` FOREIGN KEY (`alumno_ate_forma_atencion_id`) REFERENCES `forma_atencion` (`forma_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_atencion_motivo_atencion1` FOREIGN KEY (`alumno_ate_motivo_atencion_id`) REFERENCES `motivo_atencion` (`motivo_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno_hogar`
--
ALTER TABLE `alumno_hogar`
  ADD CONSTRAINT `fk_alumno_hogar_fuas1` FOREIGN KEY (`alumno_hogar_fuas_id`) REFERENCES `fuas` (`fuas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hogar_has_alumnos_datos_externos_alumnos_datos_externos1` FOREIGN KEY (`alumno_hogar_alu_id`) REFERENCES `alumnos_datos_externos` (`alumnos_datos_ext_alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hogar_has_alumnos_datos_externos_hogar1` FOREIGN KEY (`alumno_hogar_hogar_id`) REFERENCES `hogar` (`hogar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alu_anexo_tiene_campo`
--
ALTER TABLE `alu_anexo_tiene_campo`
  ADD CONSTRAINT `fk_alumno_datos_anexos_has_nuevo_campo_alumno_datos_anexos1` FOREIGN KEY (`alu_anexo_tiene_campo_alu_dto_anexos_id`) REFERENCES `alumno_datos_anexos` (`alu_dto_anexos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_datos_anexos_has_nuevo_campo_nuevo_campo1` FOREIGN KEY (`alu_anexo_tiene_campo_nuevo_campo_id`) REFERENCES `nuevo_campo` (`nuevo_campo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asigna_carreras`
--
ALTER TABLE `asigna_carreras`
  ADD CONSTRAINT `fk_personas_dae_has_carreras_carreras1` FOREIGN KEY (`asigna_carreras_carrera_id`) REFERENCES `carreras` (`carrera_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_dae_has_carreras_personas_dae1` FOREIGN KEY (`asigna_carreras_personas_dae_id`) REFERENCES `personas_dae` (`personas_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `becas_periodo`
--
ALTER TABLE `becas_periodo`
  ADD CONSTRAINT `fk_becas_periodo_becas_internas1` FOREIGN KEY (`becas_periodo_becas_internas_id`) REFERENCES `becas_internas` (`becas_internas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calendario_feriadosbloqueados`
--
ALTER TABLE `calendario_feriadosbloqueados`
  ADD CONSTRAINT `fk_calendario_feriadosbloqueados_tipo_bloqueo1` FOREIGN KEY (`cal_feriadosbloqueados_tipo_bloqueo_id`) REFERENCES `tipo_bloqueo` (`tipo_bloqueo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calendario_feriadosbloqueados_tipo_jornada1` FOREIGN KEY (`cal_feriadosbloqueados_tipo_jornada_id`) REFERENCES `tipo_jornada` (`tipo_jornada_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD CONSTRAINT `fk_carreras_facultad1` FOREIGN KEY (`carrera_facultad_id`) REFERENCES `facultad` (`facultad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `fk_comuna_region1` FOREIGN KEY (`comuna_region_id`) REFERENCES `region` (`region_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `dia_atencion`
--
ALTER TABLE `dia_atencion`
  ADD CONSTRAINT `fk_dia_atencion_semana1` FOREIGN KEY (`dia_atencion_semana_id`) REFERENCES `semana` (`semana_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fuas`
--
ALTER TABLE `fuas`
  ADD CONSTRAINT `fk_fuas_alumnos_datos_externos1` FOREIGN KEY (`fuas_alu_id`) REFERENCES `alumnos_datos_externos` (`alumnos_datos_ext_alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fuas_fuas_periodo1` FOREIGN KEY (`fuas_periodo_id`) REFERENCES `fuas_periodo` (`fuas_periodo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fuas_nacionalidad1` FOREIGN KEY (`fuas_nacionalidad_id`) REFERENCES `nacionalidad` (`nacionalidad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fuas_becas_externas`
--
ALTER TABLE `fuas_becas_externas`
  ADD CONSTRAINT `fk_fuas_has_becas_externas_becas_externas1` FOREIGN KEY (`fuas_becas_externas_becas_externas_id`) REFERENCES `becas_externas` (`becas_externas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fuas_has_becas_externas_fuas1` FOREIGN KEY (`fuas_becas_externas_fuas_id`) REFERENCES `fuas` (`fuas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historial_cambios`
--
ALTER TABLE `historial_cambios`
  ADD CONSTRAINT `fk_historial_cambios_tipo_cambio1` FOREIGN KEY (`historial_cambios_tipo_cambio_id`) REFERENCES `tipo_cambio` (`tipo_cambio_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historial_cambios_usuarios1` FOREIGN KEY (`historial_cambios_usuarios_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hogar`
--
ALTER TABLE `hogar`
  ADD CONSTRAINT `fk_hogar_comuna1` FOREIGN KEY (`hogar_comuna_id`) REFERENCES `comuna` (`comuna_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hogar_vivienda1` FOREIGN KEY (`hogar_vivienda_id`) REFERENCES `vivienda` (`vivienda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hora_atencion`
--
ALTER TABLE `hora_atencion`
  ADD CONSTRAINT `fk_hora_atencion_dia_atencion1` FOREIGN KEY (`hora_atencion_dia_atencion_id`) REFERENCES `dia_atencion` (`dia_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `fk_ingresos_fuas1` FOREIGN KEY (`ingresos_fuas_id`) REFERENCES `fuas` (`fuas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `observaciones`
--
ALTER TABLE `observaciones`
  ADD CONSTRAINT `fk_observaciones_fuas1` FOREIGN KEY (`fuas_fuas_id`) REFERENCES `fuas` (`fuas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_dae`
--
ALTER TABLE `personas_dae`
  ADD CONSTRAINT `fk_personas_dae_usuarios1` FOREIGN KEY (`personas_dae_usuarios_id`) REFERENCES `usuarios` (`usuarios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_hogar`
--
ALTER TABLE `personas_hogar`
  ADD CONSTRAINT `fk_personas_hogar_fuas1` FOREIGN KEY (`personas_hogar_fuas_id`) REFERENCES `fuas` (`fuas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_relacionadas_has_hogar_hogar1` FOREIGN KEY (`personas_hogar_hogar_id`) REFERENCES `hogar` (`hogar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_relacionadas_has_hogar_personas_relacionadas1` FOREIGN KEY (`personas_hogar_personas_rel_id`) REFERENCES `personas_relacionadas` (`personas_rel_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personas_relacionadas`
--
ALTER TABLE `personas_relacionadas`
  ADD CONSTRAINT `fk_persona_grupo_actividad10` FOREIGN KEY (`personas_rel_actividad_id`) REFERENCES `actividad` (`actividad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_grupo_estado_civil10` FOREIGN KEY (`personas_rel_estado_civil_id`) REFERENCES `estado_civil` (`estado_civil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_grupo_estudios10` FOREIGN KEY (`personas_rel_estudios_id`) REFERENCES `estudios` (`estudios_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_grupo_parentesco10` FOREIGN KEY (`personas_rel_parentesco_id`) REFERENCES `parentesco` (`parentesco_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_grupo_prevision_salud10` FOREIGN KEY (`personas_rel_prevision_salud_id`) REFERENCES `prevision_salud` (`prevision_salud_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_grupo_prevision_social10` FOREIGN KEY (`personas_rel_prevision_social_id`) REFERENCES `prevision_social` (`prevision_social_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_relacionadas_alumnos_datos_externos1` FOREIGN KEY (`personas_rel_alu_id`) REFERENCES `alumnos_datos_externos` (`alumnos_datos_ext_alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva_atencion`
--
ALTER TABLE `reserva_atencion`
  ADD CONSTRAINT `fk_alumno_atencion_has_agenda_dae_agenda_dae1` FOREIGN KEY (`reserva_atencion_agenda_dae_id`) REFERENCES `agenda_dae` (`agenda_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_atencion_has_agenda_dae_alumno_atencion1` FOREIGN KEY (`reserva_atencion_alumno_ate_id`) REFERENCES `alumno_atencion` (`alumno_ate_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserva_atencion_estado_reserva1` FOREIGN KEY (`estado_reserva_estado_reserva_id`) REFERENCES `estado_reserva` (`estado_reserva_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_rol_usuario1` FOREIGN KEY (`usuarios_rol_id`) REFERENCES `rol_usuario` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
