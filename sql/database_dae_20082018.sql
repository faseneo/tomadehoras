-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2018 a las 16:53:11
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.0.30

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
  `alumno_ate_rut` varchar(10) DEFAULT NULL,
  `alumno_ate_fecha` date DEFAULT NULL,
  `alumno_ate_hora` time DEFAULT NULL,
  `alumno_ate_forma_atencion_id` int(11) NOT NULL,
  `alumno_ate_motivo_atencion_id` int(11) NOT NULL,
  `alumno_ate_detalle_atencion_id` int(11) NOT NULL,
  `alumno_ate_estado` tinyint(4) DEFAULT NULL,
  `alumno_ate_respuesta` varchar(500) DEFAULT NULL,
  `alumno_ate_seguimiento` tinyint(4) DEFAULT NULL,
  `alumno_ate_pendiente` varchar(200) DEFAULT NULL,
  `alumno_ate_adjunto_url` varchar(200) DEFAULT NULL,
  `alumno_ate_reserva_atencion_id` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `bloque_atencion`
--

CREATE TABLE `bloque_atencion` (
  `bloque_atencion_id` int(11) NOT NULL,
  `bloque_atencion_horario` time NOT NULL,
  `bloque_atencion_orden` int(11) NOT NULL,
  `bloque_atencion_estado` int(11) NOT NULL,
  `bloque_atencion_dia_atencion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloque_atencion_tiene_dae`
--

CREATE TABLE `bloque_atencion_tiene_dae` (
  `blo_ate_tiene_dae_id` int(11) NOT NULL,
  `blo_ate_tiene_dae_persona_dae_id` int(11) NOT NULL,
  `blo_ate_tiene_dae_bloque_atencion_id` int(11) NOT NULL,
  `blo_ate_tiene_dae_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `dia_atencion_num` int(11) DEFAULT NULL,
  `dia_atencion_mes` int(11) DEFAULT NULL,
  `dia_atencion_estado` int(11) DEFAULT NULL,
  `dia_atencion_semana_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `facultad_nombre` varchar(255) DEFAULT NULL
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
-- Estructura de tabla para la tabla `persona_dae_tiene_carreras`
--

CREATE TABLE `persona_dae_tiene_carreras` (
  `persona_dae_carr_id` int(11) NOT NULL,
  `persona_dae_carr_usuario_id` int(11) NOT NULL,
  `persona_dae_carr_carrera_id` int(11) NOT NULL,
  `usu_tiene_carr_fecha_asigna` datetime DEFAULT NULL,
  `usu_tiene_carr_estado` int(11) DEFAULT NULL
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
  `reserva_atencion_fecharegistro` timestamp NULL DEFAULT NULL,
  `reserva_atencion_estado` tinyint(4) DEFAULT NULL,
  `reserva_atencion_blo_ate_tiene_usu_id` int(11) NOT NULL
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
  `semana_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'lgarcia', '7ca3995ca262d405b973c838a2b4e487', 1, NULL, 1),
(2, 'calvarez', 'a4ebb0cb39195035bdd025e7d20a90dc', 0, NULL, 2),
(4, 'agarcia', '6e024e89638db03836d13d352497daa9', 1, NULL, 1),
(5, 'bbarahona', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 2),
(6, 'amanzo', '6deb4a7017bc6d5f24c0d8ee16a876dc', 1, NULL, 2),
(7, 'jromero', 'dc3f44fcc1f2b475bf18ee6d6c2c4d5c', 1, NULL, 2),
(8, 'ppiÃ±ones', '1f5ed3ea2d9391ac913b33d0fec5af95', 1, NULL, 3);

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
  ADD KEY `fk_alumno_atencion_detalle_atencion1_idx` (`alumno_ate_detalle_atencion_id`),
  ADD KEY `fk_alumno_atencion_reserva_atencion1_idx` (`alumno_ate_reserva_atencion_id`);

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
-- Indices de la tabla `bloque_atencion`
--
ALTER TABLE `bloque_atencion`
  ADD PRIMARY KEY (`bloque_atencion_id`),
  ADD KEY `fk_dia_bloque_dia_atencion1_idx` (`bloque_atencion_dia_atencion_id`);

--
-- Indices de la tabla `bloque_atencion_tiene_dae`
--
ALTER TABLE `bloque_atencion_tiene_dae`
  ADD PRIMARY KEY (`blo_ate_tiene_dae_id`),
  ADD KEY `fk_bloque_atencion_has_usuarios_usuarios1_idx` (`blo_ate_tiene_dae_persona_dae_id`),
  ADD KEY `fk_bloque_atencion_has_usuarios_bloque_atencion2_idx` (`blo_ate_tiene_dae_bloque_atencion_id`);

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
  ADD PRIMARY KEY (`dia_atencion_id`,`dia_atencion_semana_id`),
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
-- Indices de la tabla `hogar`
--
ALTER TABLE `hogar`
  ADD PRIMARY KEY (`hogar_id`),
  ADD KEY `fk_hogar_vivienda1_idx` (`hogar_vivienda_id`),
  ADD KEY `fk_hogar_comuna1_idx` (`hogar_comuna_id`);

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
-- Indices de la tabla `persona_dae_tiene_carreras`
--
ALTER TABLE `persona_dae_tiene_carreras`
  ADD PRIMARY KEY (`persona_dae_carr_usuario_id`,`persona_dae_carr_carrera_id`,`persona_dae_carr_id`),
  ADD KEY `fk_usuarios_has_carreras_carreras1_idx` (`persona_dae_carr_carrera_id`),
  ADD KEY `fk_usuarios_has_carreras_usuarios1_idx` (`persona_dae_carr_usuario_id`);

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
  ADD KEY `fk_reserva_atencion_bloque_atencion_tiene_usuarios1_idx` (`reserva_atencion_blo_ate_tiene_usu_id`);

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
-- AUTO_INCREMENT de la tabla `bloque_atencion`
--
ALTER TABLE `bloque_atencion`
  MODIFY `bloque_atencion_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `dia_atencion_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `hogar`
--
ALTER TABLE `hogar`
  MODIFY `hogar_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `semana_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_alumno_atencion_motivo_atencion1` FOREIGN KEY (`alumno_ate_motivo_atencion_id`) REFERENCES `motivo_atencion` (`motivo_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_atencion_reserva_atencion1` FOREIGN KEY (`alumno_ate_reserva_atencion_id`) REFERENCES `reserva_atencion` (`reserva_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `becas_periodo`
--
ALTER TABLE `becas_periodo`
  ADD CONSTRAINT `fk_becas_periodo_becas_internas1` FOREIGN KEY (`becas_periodo_becas_internas_id`) REFERENCES `becas_internas` (`becas_internas_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bloque_atencion`
--
ALTER TABLE `bloque_atencion`
  ADD CONSTRAINT `fk_dia_bloque_dia_atencion1` FOREIGN KEY (`bloque_atencion_dia_atencion_id`) REFERENCES `dia_atencion` (`dia_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bloque_atencion_tiene_dae`
--
ALTER TABLE `bloque_atencion_tiene_dae`
  ADD CONSTRAINT `fk_bloque_atencion_has_usuarios_bloque_atencion2` FOREIGN KEY (`blo_ate_tiene_dae_bloque_atencion_id`) REFERENCES `bloque_atencion` (`bloque_atencion_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bloque_atencion_has_usuarios_usuarios1` FOREIGN KEY (`blo_ate_tiene_dae_persona_dae_id`) REFERENCES `personas_dae` (`personas_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `hogar`
--
ALTER TABLE `hogar`
  ADD CONSTRAINT `fk_hogar_comuna1` FOREIGN KEY (`hogar_comuna_id`) REFERENCES `comuna` (`comuna_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hogar_vivienda1` FOREIGN KEY (`hogar_vivienda_id`) REFERENCES `vivienda` (`vivienda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `persona_dae_tiene_carreras`
--
ALTER TABLE `persona_dae_tiene_carreras`
  ADD CONSTRAINT `fk_usuarios_has_carreras_carreras1` FOREIGN KEY (`persona_dae_carr_carrera_id`) REFERENCES `carreras` (`carrera_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_carreras_usuarios1` FOREIGN KEY (`persona_dae_carr_usuario_id`) REFERENCES `personas_dae` (`personas_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva_atencion`
--
ALTER TABLE `reserva_atencion`
  ADD CONSTRAINT `fk_reserva_atencion_bloque_atencion_tiene_usuarios1` FOREIGN KEY (`reserva_atencion_blo_ate_tiene_usu_id`) REFERENCES `bloque_atencion_tiene_dae` (`blo_ate_tiene_dae_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_rol_usuario1` FOREIGN KEY (`usuarios_rol_id`) REFERENCES `rol_usuario` (`rol_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
