--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.1
-- Dumped by pg_dump version 9.5.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: cappiutep; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA cappiutep;


ALTER SCHEMA cappiutep OWNER TO postgres;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = cappiutep, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: t_beneficio; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio (
    id_beneficio integer NOT NULL,
    nombre character varying(100) NOT NULL,
    descripcion character varying(500),
    fecha_ini date NOT NULL,
    fecha_fin date,
    max_dias_aprob integer NOT NULL,
    min_dias_aprob integer NOT NULL,
    min_dias_antiguedad integer NOT NULL,
    icono character varying(45),
    mostrar character(1) DEFAULT 1 NOT NULL,
    tipo_beneficio integer,
    tasa_interes integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_beneficio OWNER TO postgres;

--
-- Name: t_beneficio_condicion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio_condicion (
    id_beneficio_condicion integer NOT NULL,
    id_beneficio integer NOT NULL,
    tipo_docente integer NOT NULL,
    num_beneficio integer NOT NULL,
    monto_max numeric(10,2),
    monto_min numeric(10,2),
    max_fiadores integer,
    min_fiadores integer,
    haberes_req numeric(10,2),
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_beneficio_condicion OWNER TO postgres;

--
-- Name: t_beneficio_condicion_id_beneficio_condicion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_condicion_id_beneficio_condicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_condicion_id_beneficio_condicion_seq OWNER TO postgres;

--
-- Name: t_beneficio_condicion_id_beneficio_condicion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_condicion_id_beneficio_condicion_seq OWNED BY t_beneficio_condicion.id_beneficio_condicion;


--
-- Name: t_beneficio_flujo; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio_flujo (
    id_beneficio_flujo integer NOT NULL,
    id_beneficio integer NOT NULL,
    etapa character varying(45) NOT NULL,
    posicion integer,
    num_min_dias integer,
    num_max_dias integer,
    estatus character(1) DEFAULT 1 NOT NULL,
    cant_personas_aprueb integer NOT NULL
);


ALTER TABLE t_beneficio_flujo OWNER TO postgres;

--
-- Name: t_beneficio_flujo_id_beneficio_flujo_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_flujo_id_beneficio_flujo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_flujo_id_beneficio_flujo_seq OWNER TO postgres;

--
-- Name: t_beneficio_flujo_id_beneficio_flujo_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_flujo_id_beneficio_flujo_seq OWNED BY t_beneficio_flujo.id_beneficio_flujo;


--
-- Name: t_beneficio_id_beneficio_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_id_beneficio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_id_beneficio_seq OWNER TO postgres;

--
-- Name: t_beneficio_id_beneficio_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_id_beneficio_seq OWNED BY t_beneficio.id_beneficio;


--
-- Name: t_beneficio_plazo; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio_plazo (
    id_beneficio_plazo integer NOT NULL,
    id_beneficio integer NOT NULL,
    nombre_plazo character varying(45) NOT NULL,
    min_meses integer,
    max_meses integer,
    min_cuotas_esp integer,
    max_cuotas_esp integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_beneficio_plazo OWNER TO postgres;

--
-- Name: t_beneficio_plazo_id_beneficio_plazo_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_plazo_id_beneficio_plazo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_plazo_id_beneficio_plazo_seq OWNER TO postgres;

--
-- Name: t_beneficio_plazo_id_beneficio_plazo_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_plazo_id_beneficio_plazo_seq OWNED BY t_beneficio_plazo.id_beneficio_plazo;


--
-- Name: t_beneficio_requisito; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio_requisito (
    id_beneficio_requisito integer NOT NULL,
    id_beneficio integer NOT NULL,
    id_requisito integer NOT NULL,
    obligatorio character(1) NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date,
    estatus character(1)
);


ALTER TABLE t_beneficio_requisito OWNER TO postgres;

--
-- Name: t_beneficio_requisito_id_beneficio_requisito_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_requisito_id_beneficio_requisito_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_requisito_id_beneficio_requisito_seq OWNER TO postgres;

--
-- Name: t_beneficio_requisito_id_beneficio_requisito_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_requisito_id_beneficio_requisito_seq OWNED BY t_beneficio_requisito.id_beneficio_requisito;


--
-- Name: t_beneficio_solicitud; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_beneficio_solicitud (
    id_beneficio_solicitud integer NOT NULL,
    id_solicitante integer NOT NULL,
    id_beneficio integer NOT NULL,
    fecha date NOT NULL,
    monto numeric(11,2) NOT NULL,
    cuotas integer NOT NULL,
    interes_cuotas numeric(6,2) NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL,
    id_motivo_razon integer,
    observacion character varying(200),
    id_programa integer
);


ALTER TABLE t_beneficio_solicitud OWNER TO postgres;

--
-- Name: t_beneficio_solicitud_id_beneficio_solicitud_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_beneficio_solicitud_id_beneficio_solicitud_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_beneficio_solicitud_id_beneficio_solicitud_seq OWNER TO postgres;

--
-- Name: t_beneficio_solicitud_id_beneficio_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_beneficio_solicitud_id_beneficio_solicitud_seq OWNED BY t_beneficio_solicitud.id_beneficio_solicitud;


--
-- Name: t_bitacora_acceso; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_bitacora_acceso (
    id_bitacora_acceso integer NOT NULL,
    id_usuario integer,
    mensaje character varying NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    ip character varying NOT NULL,
    navegador character varying NOT NULL
);


ALTER TABLE t_bitacora_acceso OWNER TO postgres;

--
-- Name: t_bitacora_acceso_id_bitacora_acceso_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_bitacora_acceso_id_bitacora_acceso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_bitacora_acceso_id_bitacora_acceso_seq OWNER TO postgres;

--
-- Name: t_bitacora_acceso_id_bitacora_acceso_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_bitacora_acceso_id_bitacora_acceso_seq OWNED BY t_bitacora_acceso.id_bitacora_acceso;


--
-- Name: t_bitacora_general; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_bitacora_general (
    id_bitacora_general integer NOT NULL,
    id_usuario integer NOT NULL,
    servicio integer NOT NULL,
    ip character(16) NOT NULL,
    fecha date NOT NULL,
    hora time without time zone NOT NULL,
    operacion integer NOT NULL,
    navegador character varying(45) NOT NULL,
    mensaje character varying(100) NOT NULL
);


ALTER TABLE t_bitacora_general OWNER TO postgres;

--
-- Name: t_bitacora_general_id_bitacora_general_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_bitacora_general_id_bitacora_general_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_bitacora_general_id_bitacora_general_seq OWNER TO postgres;

--
-- Name: t_bitacora_general_id_bitacora_general_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_bitacora_general_id_bitacora_general_seq OWNED BY t_bitacora_general.id_bitacora_general;


--
-- Name: t_carga_fam; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_carga_fam (
    id_carga_fam integer NOT NULL,
    id_persona_beneficiario integer NOT NULL,
    id_persona_socio integer NOT NULL,
    parentesco integer NOT NULL,
    fecha_afiliacion date NOT NULL,
    fecha_egreso date,
    porcentaje numeric(86,2),
    estatus character(1) DEFAULT 1 NOT NULL,
    id_motivo integer,
    observacion character varying(250)
);


ALTER TABLE t_carga_fam OWNER TO postgres;

--
-- Name: t_carga_fam_condicion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_carga_fam_condicion (
    id_carga_fam_condicion integer NOT NULL,
    parentesco integer NOT NULL,
    sexo character varying(45) NOT NULL,
    edad_min integer,
    edad_max integer,
    max_personas integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_carga_fam_condicion OWNER TO postgres;

--
-- Name: t_carga_fam_condicion_id_carga_fam_condicion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_carga_fam_condicion_id_carga_fam_condicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_carga_fam_condicion_id_carga_fam_condicion_seq OWNER TO postgres;

--
-- Name: t_carga_fam_condicion_id_carga_fam_condicion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_carga_fam_condicion_id_carga_fam_condicion_seq OWNED BY t_carga_fam_condicion.id_carga_fam_condicion;


--
-- Name: t_carga_fam_id_carga_fam_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_carga_fam_id_carga_fam_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_carga_fam_id_carga_fam_seq OWNER TO postgres;

--
-- Name: t_carga_fam_id_carga_fam_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_carga_fam_id_carga_fam_seq OWNED BY t_carga_fam.id_carga_fam;


--
-- Name: t_cargo_caja_ahorro; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_cargo_caja_ahorro (
    id_cargo_caja integer NOT NULL,
    nombre character varying(45) NOT NULL,
    descripcion text,
    fecha_ini date NOT NULL,
    fecha_fin date,
    tipo_cargo integer NOT NULL,
    min_cant_personas integer,
    max_cant_personas integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_cargo_caja_ahorro OWNER TO postgres;

--
-- Name: t_cargo_caja_ahorro_id_cargo_caja_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_cargo_caja_ahorro_id_cargo_caja_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_cargo_caja_ahorro_id_cargo_caja_seq OWNER TO postgres;

--
-- Name: t_cargo_caja_ahorro_id_cargo_caja_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_cargo_caja_ahorro_id_cargo_caja_seq OWNED BY t_cargo_caja_ahorro.id_cargo_caja;


--
-- Name: t_ciudad; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_ciudad (
    id_ciudad integer NOT NULL,
    id_estado integer NOT NULL,
    descripcion character varying(200) NOT NULL,
    capital character(1) DEFAULT '0'::bpchar NOT NULL
);


ALTER TABLE t_ciudad OWNER TO postgres;

--
-- Name: t_ciudad_id_ciudad_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_ciudad_id_ciudad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_ciudad_id_ciudad_seq OWNER TO postgres;

--
-- Name: t_ciudad_id_ciudad_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_ciudad_id_ciudad_seq OWNED BY t_ciudad.id_ciudad;


--
-- Name: t_configuracion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_configuracion (
    mision text,
    vision text,
    historia text,
    clave_long_min integer,
    clave_long_max integer,
    clave_intentos_fallidos integer,
    clave_dias_caducidad integer,
    clave_dias_antes integer,
    clave_dif_anterior integer,
    clave_mayus character(1),
    clave_minus character(1),
    clave_caracteres character(1),
    clave_caracteres_validos character varying(15),
    preguntas_cant integer,
    sesion_min_expira integer,
    sesion_min_antes integer,
    porcentaje_patrono numeric,
    porcentaje_socio numeric,
    porcentaje_descuento_min numeric,
    porcentaje_descuento_max numeric,
    num_min_noches integer,
    num_max_noches integer,
    "num_min_acompañantes" integer,
    "num_max_acompañantes" integer,
    num_min_beneficiarios integer,
    num_max_beneficiarios integer,
    not_correo character(1),
    not_telf character(1),
    clave_num character(1),
    max_sesiones_abiertas character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_configuracion OWNER TO postgres;

--
-- Name: t_detalle_liquid; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_detalle_liquid (
    id_liquid integer NOT NULL,
    id_solicitud integer NOT NULL,
    monto numeric NOT NULL,
    forma_pago integer NOT NULL,
    ref_pago character varying NOT NULL,
    id_motivo_razon integer,
    observacion text,
    estatus character(1)
);


ALTER TABLE t_detalle_liquid OWNER TO postgres;

--
-- Name: t_detalle_liquid_id_liquid_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_detalle_liquid_id_liquid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_detalle_liquid_id_liquid_seq OWNER TO postgres;

--
-- Name: t_detalle_liquid_id_liquid_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_detalle_liquid_id_liquid_seq OWNED BY t_detalle_liquid.id_liquid;


--
-- Name: t_estado; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_estado (
    id_estado integer NOT NULL,
    estado character varying(250) NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_estado OWNER TO postgres;

--
-- Name: t_estado_id_estado_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_estado_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_estado_id_estado_seq OWNER TO postgres;

--
-- Name: t_estado_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_estado_id_estado_seq OWNED BY t_estado.id_estado;


--
-- Name: t_flujo_aprueba; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_flujo_aprueba (
    id_flujo_aprueba integer NOT NULL,
    id_beneficio_flujo integer NOT NULL,
    id_cargo_caja integer NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_flujo_aprueba OWNER TO postgres;

--
-- Name: t_flujo_aprueba_id_flujo_aprueba_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_flujo_aprueba_id_flujo_aprueba_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_flujo_aprueba_id_flujo_aprueba_seq OWNER TO postgres;

--
-- Name: t_flujo_aprueba_id_flujo_aprueba_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_flujo_aprueba_id_flujo_aprueba_seq OWNED BY t_flujo_aprueba.id_flujo_aprueba;


--
-- Name: t_haberes; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_haberes (
    id_haberes integer NOT NULL,
    id_persona integer NOT NULL,
    saldo numeric NOT NULL,
    saldo_bloq_prestamo numeric,
    saldo_bloq_fianza numeric,
    fecha_cierre date
);


ALTER TABLE t_haberes OWNER TO postgres;

--
-- Name: t_haberes_id_haberes_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_haberes_id_haberes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_haberes_id_haberes_seq OWNER TO postgres;

--
-- Name: t_haberes_id_haberes_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_haberes_id_haberes_seq OWNED BY t_haberes.id_haberes;


--
-- Name: t_icono; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_icono (
    id_icono integer NOT NULL,
    icono character varying(80) NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_icono OWNER TO postgres;

--
-- Name: t_icono_id_icono_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_icono_id_icono_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_icono_id_icono_seq OWNER TO postgres;

--
-- Name: t_icono_id_icono_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_icono_id_icono_seq OWNED BY t_icono.id_icono;


--
-- Name: t_lista; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_lista (
    id_lista integer NOT NULL,
    nombre character varying(60) NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL,
    bloqueado character(1)
);


ALTER TABLE t_lista OWNER TO postgres;

--
-- Name: t_lista_id_lista_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_lista_id_lista_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_lista_id_lista_seq OWNER TO postgres;

--
-- Name: t_lista_id_lista_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_lista_id_lista_seq OWNED BY t_lista.id_lista;


--
-- Name: t_lista_valor; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_lista_valor (
    id_lista_valor integer NOT NULL,
    id_lista integer NOT NULL,
    nombre_corto character varying(45),
    nombre_largo text NOT NULL,
    id_padre integer,
    posicion integer,
    estatus character(1) DEFAULT 1 NOT NULL,
    bloq character(1) DEFAULT 0 NOT NULL
);


ALTER TABLE t_lista_valor OWNER TO postgres;

--
-- Name: t_lista_valor_id_lista_valor_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_lista_valor_id_lista_valor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_lista_valor_id_lista_valor_seq OWNER TO postgres;

--
-- Name: t_lista_valor_id_lista_valor_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_lista_valor_id_lista_valor_seq OWNED BY t_lista_valor.id_lista_valor;


--
-- Name: t_modulo; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_modulo (
    id_modulo integer NOT NULL,
    descripcion character varying(45) NOT NULL,
    id_icono integer,
    id_padre integer,
    posicion integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_modulo OWNER TO postgres;

--
-- Name: t_modulo_id_modulo_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_modulo_id_modulo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_modulo_id_modulo_seq OWNER TO postgres;

--
-- Name: t_modulo_id_modulo_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_modulo_id_modulo_seq OWNED BY t_modulo.id_modulo;


--
-- Name: t_motivo_proceso; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_motivo_proceso (
    id_motivo_proceso integer NOT NULL,
    id_motivo integer NOT NULL,
    id_proceso integer NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_motivo_proceso OWNER TO postgres;

--
-- Name: t_motivo_proceso_id_motivo_proceso_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_motivo_proceso_id_motivo_proceso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_motivo_proceso_id_motivo_proceso_seq OWNER TO postgres;

--
-- Name: t_motivo_proceso_id_motivo_proceso_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_motivo_proceso_id_motivo_proceso_seq OWNED BY t_motivo_proceso.id_motivo_proceso;


--
-- Name: t_motivo_razon; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_motivo_razon (
    id_motivo_razon integer NOT NULL,
    nombre character varying(80) NOT NULL,
    descripcion character varying(200),
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_motivo_razon OWNER TO postgres;

--
-- Name: t_motivo_razon_id_motivo_razon_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_motivo_razon_id_motivo_razon_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_motivo_razon_id_motivo_razon_seq OWNER TO postgres;

--
-- Name: t_motivo_razon_id_motivo_razon_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_motivo_razon_id_motivo_razon_seq OWNED BY t_motivo_razon.id_motivo_razon;


--
-- Name: t_municipio; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_municipio (
    id_municipio integer NOT NULL,
    id_estado integer NOT NULL,
    municipio character varying(100) NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_municipio OWNER TO postgres;

--
-- Name: t_municipio_id_municipio_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_municipio_id_municipio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_municipio_id_municipio_seq OWNER TO postgres;

--
-- Name: t_municipio_id_municipio_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_municipio_id_municipio_seq OWNED BY t_municipio.id_municipio;


--
-- Name: t_noticia; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_noticia (
    id_noticia integer NOT NULL,
    titulo character varying NOT NULL,
    contenido text NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_noticia OWNER TO postgres;

--
-- Name: t_noticias_id_noticia_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_noticias_id_noticia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_noticias_id_noticia_seq OWNER TO postgres;

--
-- Name: t_noticias_id_noticia_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_noticias_id_noticia_seq OWNED BY t_noticia.id_noticia;


--
-- Name: t_operacion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_operacion (
    id_operacion integer NOT NULL,
    descripcion character varying(45) NOT NULL,
    id_icono integer,
    estatus character(1) NOT NULL
);


ALTER TABLE t_operacion OWNER TO postgres;

--
-- Name: t_operacion_id_operacion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_operacion_id_operacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_operacion_id_operacion_seq OWNER TO postgres;

--
-- Name: t_operacion_id_operacion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_operacion_id_operacion_seq OWNED BY t_operacion.id_operacion;


--
-- Name: t_organizacion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_organizacion (
    id_organizacion integer NOT NULL,
    razon_social character varying(200) NOT NULL,
    siglas character varying(45),
    telefono character varying(11),
    dir_fiscal text,
    email character varying(120),
    rif character varying(12),
    nit character varying(12) NOT NULL,
    estatus character(1) DEFAULT 1
);


ALTER TABLE t_organizacion OWNER TO postgres;

--
-- Name: t_organizacion_cuenta; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_organizacion_cuenta (
    id_org_cuenta integer NOT NULL,
    id_org integer NOT NULL,
    id_banco integer NOT NULL,
    num_cuenta character(20) NOT NULL,
    tipo_cuenta integer NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_organizacion_cuenta OWNER TO postgres;

--
-- Name: t_organizacion_cuenta_id_org_cuenta_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_organizacion_cuenta_id_org_cuenta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_organizacion_cuenta_id_org_cuenta_seq OWNER TO postgres;

--
-- Name: t_organizacion_cuenta_id_org_cuenta_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_organizacion_cuenta_id_org_cuenta_seq OWNED BY t_organizacion_cuenta.id_org_cuenta;


--
-- Name: t_organizacion_id_organizacion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_organizacion_id_organizacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_organizacion_id_organizacion_seq OWNER TO postgres;

--
-- Name: t_organizacion_id_organizacion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_organizacion_id_organizacion_seq OWNED BY t_organizacion.id_organizacion;


--
-- Name: t_parroquia; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_parroquia (
    id_parroquia integer NOT NULL,
    id_municipio integer NOT NULL,
    parroquia character varying(250) NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_parroquia OWNER TO postgres;

--
-- Name: t_parroquia_id_parroquia_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_parroquia_id_parroquia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_parroquia_id_parroquia_seq OWNER TO postgres;

--
-- Name: t_parroquia_id_parroquia_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_parroquia_id_parroquia_seq OWNED BY t_parroquia.id_parroquia;


--
-- Name: t_periodo; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_periodo (
    id_periodo integer NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date,
    estatus character(1) NOT NULL
);


ALTER TABLE t_periodo OWNER TO postgres;

--
-- Name: t_periodo_id_periodo_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_periodo_id_periodo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_periodo_id_periodo_seq OWNER TO postgres;

--
-- Name: t_periodo_id_periodo_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_periodo_id_periodo_seq OWNED BY t_periodo.id_periodo;


--
-- Name: t_persona; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_persona (
    id_persona integer NOT NULL,
    nacionalidad character(1) NOT NULL,
    cedula character varying NOT NULL,
    nombre1 character varying(45) NOT NULL,
    nombre2 character varying(45),
    apellido1 character varying(45) NOT NULL,
    apellido2 character varying(45),
    fecha_nacimiento date,
    sexo character(1),
    direccion character varying(200),
    estado_civil character varying(45),
    cod_telf_movil character varying(4),
    telf_movil character varying(7),
    cod_tel_oficina character varying(4),
    telf_oficina character varying(7),
    cod_telf_fijo character varying(4),
    telf_fijo character varying(7),
    id_condicion integer,
    id_sede integer,
    email character varying(120),
    id_ciudad integer,
    id_parroquia integer,
    estatus character(1) DEFAULT 1 NOT NULL,
    tipo_docente character varying(45),
    categ_docente character varying(45),
    dedic_docente character varying(45),
    salario numeric,
    fecha_ini_docente date
);


ALTER TABLE t_persona OWNER TO postgres;

--
-- Name: t_persona_aporte; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_persona_aporte (
    id_aporte integer NOT NULL,
    id_persona integer NOT NULL,
    monto numeric NOT NULL,
    fecha date NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_persona_aporte OWNER TO postgres;

--
-- Name: t_persona_aporte_id_aporte_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_persona_aporte_id_aporte_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_persona_aporte_id_aporte_seq OWNER TO postgres;

--
-- Name: t_persona_aporte_id_aporte_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_persona_aporte_id_aporte_seq OWNED BY t_persona_aporte.id_aporte;


--
-- Name: t_persona_caja; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_persona_caja (
    id_persona_caja integer NOT NULL,
    id_persona integer NOT NULL,
    id_cargo_caja integer NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date,
    condicion character(1) DEFAULT 0 NOT NULL,
    estatus character(1),
    id_motivo_razon integer,
    observacion text
);


ALTER TABLE t_persona_caja OWNER TO postgres;

--
-- Name: t_persona_caja_id_persona_caja_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_persona_caja_id_persona_caja_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_persona_caja_id_persona_caja_seq OWNER TO postgres;

--
-- Name: t_persona_caja_id_persona_caja_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_persona_caja_id_persona_caja_seq OWNED BY t_persona_caja.id_persona_caja;


--
-- Name: t_persona_cuenta_banco; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_persona_cuenta_banco (
    id_cuenta_banco integer NOT NULL,
    id_persona integer NOT NULL,
    id_banco integer NOT NULL,
    num_cuenta character varying(20) NOT NULL,
    tipo_cuenta integer NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_persona_cuenta_banco OWNER TO postgres;

--
-- Name: t_persona_cuenta_banco_id_cuenta_banco_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_persona_cuenta_banco_id_cuenta_banco_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_persona_cuenta_banco_id_cuenta_banco_seq OWNER TO postgres;

--
-- Name: t_persona_cuenta_banco_id_cuenta_banco_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_persona_cuenta_banco_id_cuenta_banco_seq OWNED BY t_persona_cuenta_banco.id_cuenta_banco;


--
-- Name: t_persona_id_persona_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_persona_id_persona_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_persona_id_persona_seq OWNER TO postgres;

--
-- Name: t_persona_id_persona_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_persona_id_persona_seq OWNED BY t_persona.id_persona;


--
-- Name: t_proceso_caja_ahorro; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_proceso_caja_ahorro (
    id_proceso integer NOT NULL,
    nombre character varying(45) NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_proceso_caja_ahorro OWNER TO postgres;

--
-- Name: t_proceso_caja_ahorro_id_proceso_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_proceso_caja_ahorro_id_proceso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_proceso_caja_ahorro_id_proceso_seq OWNER TO postgres;

--
-- Name: t_proceso_caja_ahorro_id_proceso_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_proceso_caja_ahorro_id_proceso_seq OWNED BY t_proceso_caja_ahorro.id_proceso;


--
-- Name: t_reporte; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_reporte (
    id_reporte integer NOT NULL,
    descripcion character varying(45) NOT NULL,
    estatus character(1) NOT NULL,
    url character varying(100) NOT NULL
);


ALTER TABLE t_reporte OWNER TO postgres;

--
-- Name: t_reporte_id_reporte_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_reporte_id_reporte_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_reporte_id_reporte_seq OWNER TO postgres;

--
-- Name: t_reporte_id_reporte_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_reporte_id_reporte_seq OWNED BY t_reporte.id_reporte;


--
-- Name: t_reporte_usuario; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_reporte_usuario (
    id_reporte_usuario integer NOT NULL,
    id_reporte integer NOT NULL,
    id_usuario integer NOT NULL
);


ALTER TABLE t_reporte_usuario OWNER TO postgres;

--
-- Name: t_servicio; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_servicio (
    id_servicio integer NOT NULL,
    id_modulo integer NOT NULL,
    descripcion character varying(45) NOT NULL,
    id_tipo_vista integer NOT NULL,
    id_icono integer,
    estatus character(1) DEFAULT 1 NOT NULL,
    url character varying,
    posicion integer
);


ALTER TABLE t_servicio OWNER TO postgres;

--
-- Name: t_servicio_operacion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_servicio_operacion (
    id_servicio_operacion integer NOT NULL,
    id_servicio integer NOT NULL,
    id_operacion integer NOT NULL,
    id_usuario integer NOT NULL,
    fecha_ini date,
    fecha_fin date
);


ALTER TABLE t_servicio_operacion OWNER TO postgres;

--
-- Name: t_servicio_operacion_id_servicio_operacion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_servicio_operacion_id_servicio_operacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_servicio_operacion_id_servicio_operacion_seq OWNER TO postgres;

--
-- Name: t_servicio_operacion_id_servicio_operacion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_servicio_operacion_id_servicio_operacion_seq OWNED BY t_servicio_operacion.id_servicio_operacion;


--
-- Name: t_servicio_posicion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_servicio_posicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_servicio_posicion_seq OWNER TO postgres;

--
-- Name: t_servicio_posicion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_servicio_posicion_seq OWNED BY t_servicio.posicion;


--
-- Name: t_solicitud_amortiza; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_solicitud_amortiza (
    id_solicitud_amortiza integer NOT NULL,
    id_solicitud integer NOT NULL,
    monto numeric NOT NULL,
    id_concepto integer NOT NULL,
    forma_pago character varying,
    ref_pago character varying,
    fecha_pago date,
    id_motivo_razon integer,
    observacion text,
    amort_fecha_lim_min date,
    amort_fecha_lim_max date,
    id_cuenta integer,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_solicitud_amortiza OWNER TO postgres;

--
-- Name: t_solicitud_amortiza_id_solicitud_amortiza_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_solicitud_amortiza_id_solicitud_amortiza_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_solicitud_amortiza_id_solicitud_amortiza_seq OWNER TO postgres;

--
-- Name: t_solicitud_amortiza_id_solicitud_amortiza_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_solicitud_amortiza_id_solicitud_amortiza_seq OWNED BY t_solicitud_amortiza.id_solicitud_amortiza;


--
-- Name: t_solicitud_aprueba; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_solicitud_aprueba (
    id_solicitud_aprueba integer NOT NULL,
    id_persona_caja integer NOT NULL,
    id_solicitud_flujo integer NOT NULL,
    fecha date NOT NULL
);


ALTER TABLE t_solicitud_aprueba OWNER TO postgres;

--
-- Name: t_solicitud_aprueba_id_solicitud_aprueba_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_solicitud_aprueba_id_solicitud_aprueba_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_solicitud_aprueba_id_solicitud_aprueba_seq OWNER TO postgres;

--
-- Name: t_solicitud_aprueba_id_solicitud_aprueba_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_solicitud_aprueba_id_solicitud_aprueba_seq OWNED BY t_solicitud_aprueba.id_solicitud_aprueba;


--
-- Name: t_solicitud_fiador; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_solicitud_fiador (
    id_solicitud_fiador integer NOT NULL,
    id_solicitud integer NOT NULL,
    id_fiador integer NOT NULL,
    monto numeric(11,2) NOT NULL,
    estatus character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE t_solicitud_fiador OWNER TO postgres;

--
-- Name: t_solicitud_fiador_id_solicitud_fiador_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_solicitud_fiador_id_solicitud_fiador_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_solicitud_fiador_id_solicitud_fiador_seq OWNER TO postgres;

--
-- Name: t_solicitud_fiador_id_solicitud_fiador_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_solicitud_fiador_id_solicitud_fiador_seq OWNED BY t_solicitud_fiador.id_solicitud_fiador;


--
-- Name: t_solicitud_flujo; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_solicitud_flujo (
    id_solicitud_flujo integer NOT NULL,
    id_beneficio_flujo integer NOT NULL,
    id_solicitud integer NOT NULL,
    fecha_entra date NOT NULL,
    fecha_sale date,
    observacion character varying(200)
);


ALTER TABLE t_solicitud_flujo OWNER TO postgres;

--
-- Name: t_solicitud_flujo_id_solicitud_flujo_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_solicitud_flujo_id_solicitud_flujo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_solicitud_flujo_id_solicitud_flujo_seq OWNER TO postgres;

--
-- Name: t_solicitud_flujo_id_solicitud_flujo_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_solicitud_flujo_id_solicitud_flujo_seq OWNED BY t_solicitud_flujo.id_solicitud_flujo;


--
-- Name: t_tipo_vista; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_tipo_vista (
    id_tipo_vista integer NOT NULL,
    descripcion character varying(45) NOT NULL,
    estatus character(1) NOT NULL
);


ALTER TABLE t_tipo_vista OWNER TO postgres;

--
-- Name: t_usuario; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_usuario (
    id_usuario integer NOT NULL,
    nombre character varying(8) NOT NULL,
    intentos integer DEFAULT 0 NOT NULL,
    inicio_sesion integer DEFAULT 0 NOT NULL,
    estatus character(1) DEFAULT 0 NOT NULL,
    id_persona integer NOT NULL
);


ALTER TABLE t_usuario OWNER TO postgres;

--
-- Name: t_usuario_clave; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_usuario_clave (
    id_usuario_clave integer NOT NULL,
    id_usuario character varying NOT NULL,
    clave character varying(80) NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date
);


ALTER TABLE t_usuario_clave OWNER TO postgres;

--
-- Name: t_usuario_clave_id_usuario_clave_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_usuario_clave_id_usuario_clave_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_usuario_clave_id_usuario_clave_seq OWNER TO postgres;

--
-- Name: t_usuario_clave_id_usuario_clave_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_usuario_clave_id_usuario_clave_seq OWNED BY t_usuario_clave.id_usuario_clave;


--
-- Name: t_usuario_id_usuario_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_usuario_id_usuario_seq OWNER TO postgres;

--
-- Name: t_usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_usuario_id_usuario_seq OWNED BY t_usuario.id_usuario;


--
-- Name: t_usuario_pregunta; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_usuario_pregunta (
    id_pregunta integer NOT NULL,
    id_usuario integer NOT NULL,
    pregunta character varying(80) NOT NULL,
    respuesta character varying(80) NOT NULL
);


ALTER TABLE t_usuario_pregunta OWNER TO postgres;

--
-- Name: t_usuario_pregunta_id_pregunta_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_usuario_pregunta_id_pregunta_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_usuario_pregunta_id_pregunta_seq OWNER TO postgres;

--
-- Name: t_usuario_pregunta_id_pregunta_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_usuario_pregunta_id_pregunta_seq OWNED BY t_usuario_pregunta.id_pregunta;


--
-- Name: t_vista_operacion; Type: TABLE; Schema: cappiutep; Owner: postgres
--

CREATE TABLE t_vista_operacion (
    id_vista_operacion integer NOT NULL,
    id_operacion integer NOT NULL,
    id_tipo_vista integer NOT NULL
);


ALTER TABLE t_vista_operacion OWNER TO postgres;

--
-- Name: t_vista_operacion_id_vista_operacion_seq; Type: SEQUENCE; Schema: cappiutep; Owner: postgres
--

CREATE SEQUENCE t_vista_operacion_id_vista_operacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE t_vista_operacion_id_vista_operacion_seq OWNER TO postgres;

--
-- Name: t_vista_operacion_id_vista_operacion_seq; Type: SEQUENCE OWNED BY; Schema: cappiutep; Owner: postgres
--

ALTER SEQUENCE t_vista_operacion_id_vista_operacion_seq OWNED BY t_vista_operacion.id_vista_operacion;


--
-- Name: id_beneficio; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio ALTER COLUMN id_beneficio SET DEFAULT nextval('t_beneficio_id_beneficio_seq'::regclass);


--
-- Name: id_beneficio_condicion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_condicion ALTER COLUMN id_beneficio_condicion SET DEFAULT nextval('t_beneficio_condicion_id_beneficio_condicion_seq'::regclass);


--
-- Name: id_beneficio_flujo; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_flujo ALTER COLUMN id_beneficio_flujo SET DEFAULT nextval('t_beneficio_flujo_id_beneficio_flujo_seq'::regclass);


--
-- Name: id_beneficio_plazo; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_plazo ALTER COLUMN id_beneficio_plazo SET DEFAULT nextval('t_beneficio_plazo_id_beneficio_plazo_seq'::regclass);


--
-- Name: id_beneficio_requisito; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_requisito ALTER COLUMN id_beneficio_requisito SET DEFAULT nextval('t_beneficio_requisito_id_beneficio_requisito_seq'::regclass);


--
-- Name: id_beneficio_solicitud; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_solicitud ALTER COLUMN id_beneficio_solicitud SET DEFAULT nextval('t_beneficio_solicitud_id_beneficio_solicitud_seq'::regclass);


--
-- Name: id_bitacora_acceso; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_bitacora_acceso ALTER COLUMN id_bitacora_acceso SET DEFAULT nextval('t_bitacora_acceso_id_bitacora_acceso_seq'::regclass);


--
-- Name: id_bitacora_general; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_bitacora_general ALTER COLUMN id_bitacora_general SET DEFAULT nextval('t_bitacora_general_id_bitacora_general_seq'::regclass);


--
-- Name: id_carga_fam; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_carga_fam ALTER COLUMN id_carga_fam SET DEFAULT nextval('t_carga_fam_id_carga_fam_seq'::regclass);


--
-- Name: id_carga_fam_condicion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_carga_fam_condicion ALTER COLUMN id_carga_fam_condicion SET DEFAULT nextval('t_carga_fam_condicion_id_carga_fam_condicion_seq'::regclass);


--
-- Name: id_cargo_caja; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_cargo_caja_ahorro ALTER COLUMN id_cargo_caja SET DEFAULT nextval('t_cargo_caja_ahorro_id_cargo_caja_seq'::regclass);


--
-- Name: id_ciudad; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_ciudad ALTER COLUMN id_ciudad SET DEFAULT nextval('t_ciudad_id_ciudad_seq'::regclass);


--
-- Name: id_liquid; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_detalle_liquid ALTER COLUMN id_liquid SET DEFAULT nextval('t_detalle_liquid_id_liquid_seq'::regclass);


--
-- Name: id_estado; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_estado ALTER COLUMN id_estado SET DEFAULT nextval('t_estado_id_estado_seq'::regclass);


--
-- Name: id_flujo_aprueba; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_flujo_aprueba ALTER COLUMN id_flujo_aprueba SET DEFAULT nextval('t_flujo_aprueba_id_flujo_aprueba_seq'::regclass);


--
-- Name: id_haberes; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_haberes ALTER COLUMN id_haberes SET DEFAULT nextval('t_haberes_id_haberes_seq'::regclass);


--
-- Name: id_icono; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_icono ALTER COLUMN id_icono SET DEFAULT nextval('t_icono_id_icono_seq'::regclass);


--
-- Name: id_lista; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_lista ALTER COLUMN id_lista SET DEFAULT nextval('t_lista_id_lista_seq'::regclass);


--
-- Name: id_lista_valor; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_lista_valor ALTER COLUMN id_lista_valor SET DEFAULT nextval('t_lista_valor_id_lista_valor_seq'::regclass);


--
-- Name: id_modulo; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_modulo ALTER COLUMN id_modulo SET DEFAULT nextval('t_modulo_id_modulo_seq'::regclass);


--
-- Name: id_motivo_proceso; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_motivo_proceso ALTER COLUMN id_motivo_proceso SET DEFAULT nextval('t_motivo_proceso_id_motivo_proceso_seq'::regclass);


--
-- Name: id_motivo_razon; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_motivo_razon ALTER COLUMN id_motivo_razon SET DEFAULT nextval('t_motivo_razon_id_motivo_razon_seq'::regclass);


--
-- Name: id_municipio; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_municipio ALTER COLUMN id_municipio SET DEFAULT nextval('t_municipio_id_municipio_seq'::regclass);


--
-- Name: id_noticia; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_noticia ALTER COLUMN id_noticia SET DEFAULT nextval('t_noticias_id_noticia_seq'::regclass);


--
-- Name: id_operacion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_operacion ALTER COLUMN id_operacion SET DEFAULT nextval('t_operacion_id_operacion_seq'::regclass);


--
-- Name: id_organizacion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_organizacion ALTER COLUMN id_organizacion SET DEFAULT nextval('t_organizacion_id_organizacion_seq'::regclass);


--
-- Name: id_org_cuenta; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_organizacion_cuenta ALTER COLUMN id_org_cuenta SET DEFAULT nextval('t_organizacion_cuenta_id_org_cuenta_seq'::regclass);


--
-- Name: id_parroquia; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_parroquia ALTER COLUMN id_parroquia SET DEFAULT nextval('t_parroquia_id_parroquia_seq'::regclass);


--
-- Name: id_periodo; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_periodo ALTER COLUMN id_periodo SET DEFAULT nextval('t_periodo_id_periodo_seq'::regclass);


--
-- Name: id_persona; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona ALTER COLUMN id_persona SET DEFAULT nextval('t_persona_id_persona_seq'::regclass);


--
-- Name: id_aporte; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_aporte ALTER COLUMN id_aporte SET DEFAULT nextval('t_persona_aporte_id_aporte_seq'::regclass);


--
-- Name: id_persona_caja; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_caja ALTER COLUMN id_persona_caja SET DEFAULT nextval('t_persona_caja_id_persona_caja_seq'::regclass);


--
-- Name: id_cuenta_banco; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_cuenta_banco ALTER COLUMN id_cuenta_banco SET DEFAULT nextval('t_persona_cuenta_banco_id_cuenta_banco_seq'::regclass);


--
-- Name: id_proceso; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_proceso_caja_ahorro ALTER COLUMN id_proceso SET DEFAULT nextval('t_proceso_caja_ahorro_id_proceso_seq'::regclass);


--
-- Name: id_reporte; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_reporte ALTER COLUMN id_reporte SET DEFAULT nextval('t_reporte_id_reporte_seq'::regclass);


--
-- Name: id_servicio_operacion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_servicio_operacion ALTER COLUMN id_servicio_operacion SET DEFAULT nextval('t_servicio_operacion_id_servicio_operacion_seq'::regclass);


--
-- Name: id_solicitud_amortiza; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_amortiza ALTER COLUMN id_solicitud_amortiza SET DEFAULT nextval('t_solicitud_amortiza_id_solicitud_amortiza_seq'::regclass);


--
-- Name: id_solicitud_aprueba; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_aprueba ALTER COLUMN id_solicitud_aprueba SET DEFAULT nextval('t_solicitud_aprueba_id_solicitud_aprueba_seq'::regclass);


--
-- Name: id_solicitud_fiador; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_fiador ALTER COLUMN id_solicitud_fiador SET DEFAULT nextval('t_solicitud_fiador_id_solicitud_fiador_seq'::regclass);


--
-- Name: id_solicitud_flujo; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_flujo ALTER COLUMN id_solicitud_flujo SET DEFAULT nextval('t_solicitud_flujo_id_solicitud_flujo_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('t_usuario_id_usuario_seq'::regclass);


--
-- Name: id_usuario_clave; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario_clave ALTER COLUMN id_usuario_clave SET DEFAULT nextval('t_usuario_clave_id_usuario_clave_seq'::regclass);


--
-- Name: id_pregunta; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario_pregunta ALTER COLUMN id_pregunta SET DEFAULT nextval('t_usuario_pregunta_id_pregunta_seq'::regclass);


--
-- Name: id_vista_operacion; Type: DEFAULT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_vista_operacion ALTER COLUMN id_vista_operacion SET DEFAULT nextval('t_vista_operacion_id_vista_operacion_seq'::regclass);


--
-- Data for Name: t_beneficio; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio (id_beneficio, nombre, descripcion, fecha_ini, fecha_fin, max_dias_aprob, min_dias_aprob, min_dias_antiguedad, icono, mostrar, tipo_beneficio, tasa_interes, estatus) FROM stdin;
2	Préstamo Personal	Préstamo que ofrece flexibilidad en su forma de pago con plazos cortos, medianos o largos, se cancela por descuentos de nómina, adicionalmente se ofrece la posibilidad de fijar cuotas especiales para facilitar la cancelación, debe ser respaldado por sus haberes y para cantidades mayores puede valerse de fiadores.	2000-01-01	\N	14	7	180	money	1	182	12	1
3	Préstamo para Reparación de Vehiculo	Préstamo destinado únicamente a reparar el vehículo del asociado, va respaldado por una reserva de dominio del vehículo a nombre de la Caja de Ahorros (CAPPIUTEP).	2016-01-01	\N	14	7	180	car	1	182	12	1
6	Préstamo Hipotecario	El Socio tendrá la posibilidad de optar por un préstamo para la adquisición, construcción o remodelación de vivienda principal, para el complemento de la inicial o liberación con la banca privada.	2000-01-01	\N	14	7	1825	home	1	182	12	1
4	Retiro Parcial	El socio podrá en cualquier momento solicitar retiros parciales de sus ahorros disponibles.	2000-01-01	\N	14	7	180	external share	1	184	0	1
5	Programa de Financiamiento	La Caja de Ahorros brinda a sus asociados la posibilidad de solicitar financiamientos para la adquisición de bienes.	2000-01-01	\N	14	7	180	add cart	1	183	0	1
7	Retiro Total	Se le liquidarán la totalidad de sus ahorros y se desvinculará de la Caja de Ahorros y sus beneficios; el Socio debe estar solvente con la Caja de Ahorros para poder solicitar un retiro total. 	2015-01-01	\N	14	7	30	share square\n	0	184	0	1
1	Préstamo Especial	Préstamo a corto plazo, se cancela por depósito bancario en una cuota única , no se realizarán descuentos por nómina para éste tipo de préstamo y sin embargo debe ser respaldado por sus haberes.	2000-01-01	\N	14	7	180	lightning	1	182	12	1
\.


--
-- Data for Name: t_beneficio_condicion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio_condicion (id_beneficio_condicion, id_beneficio, tipo_docente, num_beneficio, monto_max, monto_min, max_fiadores, min_fiadores, haberes_req, estatus) FROM stdin;
1	1	160	1	34000.00	1000.00	0	0	80.00	1
2	1	161	1	34000.00	1000.00	0	0	80.00	1
3	1	162	1	34000.00	1000.00	0	0	80.00	1
4	2	160	1	0.00	1000.00	4	4	80.00	1
5	2	161	1	0.00	1000.00	4	4	80.00	1
6	2	162	1	0.00	1000.00	4	4	80.00	1
7	3	160	1	500000.00	1000.00	0	0	0.00	1
8	3	161	1	500000.00	1000.00	0	0	0.00	1
9	3	162	1	500000.00	1000.00	0	0	0.00	1
10	4	160	1	0.00	1000.00	0	0	80.00	1
11	4	161	1	0.00	1000.00	0	0	80.00	1
12	4	162	1	0.00	1000.00	0	0	80.00	1
13	5	160	1	0.00	1000.00	0	0	80.00	1
14	5	161	1	0.00	1000.00	0	0	80.00	1
15	5	162	1	0.00	1000.00	0	0	80.00	1
16	6	160	1	0.00	1000.00	0	0	0.00	1
17	6	161	1	0.00	1000.00	0	0	0.00	1
18	6	162	1	0.00	1000.00	0	0	0.00	1
19	7	160	1	\N	\N	\N	\N	100.00	1
20	7	161	1	\N	\N	\N	\N	100.00	1
21	7	162	1	\N	\N	\N	\N	100.00	1
\.


--
-- Name: t_beneficio_condicion_id_beneficio_condicion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_condicion_id_beneficio_condicion_seq', 21, true);


--
-- Data for Name: t_beneficio_flujo; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio_flujo (id_beneficio_flujo, id_beneficio, etapa, posicion, num_min_dias, num_max_dias, estatus, cant_personas_aprueb) FROM stdin;
1	1	Análisis	1	7	14	1	1
2	1	Discución	2	7	14	1	3
3	1	Liquidación	3	7	14	1	1
4	2	Análisis	1	7	14	1	1
5	2	Discución	2	7	14	1	3
6	2	Liquidación	3	7	14	1	1
7	3	Análisis	1	7	14	1	1
8	3	Discución	2	7	14	1	3
9	3	Liquidación	3	7	14	1	1
10	4	Análisis	1	7	14	1	1
11	4	Discución	2	7	14	1	3
12	4	Liquidación	3	7	14	1	1
13	5	Análisis	1	7	14	1	1
14	5	Discución	2	7	14	1	3
15	5	Liquidación	3	7	14	1	1
\.


--
-- Name: t_beneficio_flujo_id_beneficio_flujo_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_flujo_id_beneficio_flujo_seq', 1, false);


--
-- Name: t_beneficio_id_beneficio_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_id_beneficio_seq', 7, true);


--
-- Data for Name: t_beneficio_plazo; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio_plazo (id_beneficio_plazo, id_beneficio, nombre_plazo, min_meses, max_meses, min_cuotas_esp, max_cuotas_esp, estatus) FROM stdin;
1	1	Corto	6	6	0	0	1
2	2	Corto	24	24	4	4	1
3	2	Mediano	48	48	8	8	1
4	2	Largo	72	72	12	12	1
5	3	Corto	24	24	4	4	1
6	3	Mediano	48	48	8	8	1
7	3	Largo	72	72	12	12	1
8	5	Corto	24	24	4	4	1
9	5	Mediano	48	48	8	8	1
10	5	Largo	72	72	12	12	1
\.


--
-- Name: t_beneficio_plazo_id_beneficio_plazo_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_plazo_id_beneficio_plazo_seq', 1, false);


--
-- Data for Name: t_beneficio_requisito; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio_requisito (id_beneficio_requisito, id_beneficio, id_requisito, obligatorio, fecha_ini, fecha_fin, estatus) FROM stdin;
6	1	87	1	2016-04-29	\N	1
7	1	88	1	2016-04-29	\N	1
8	2	87	1	2016-04-29	\N	1
9	2	88	1	2016-04-29	\N	1
10	2	104	1	2016-04-29	\N	1
11	2	108	0	2016-04-29	\N	1
12	2	103	1	2016-04-29	\N	1
13	6	87	1	2016-05-13	\N	1
14	6	89	1	2016-05-13	\N	1
15	6	90	1	2016-05-13	\N	1
16	6	94	1	2016-05-13	\N	1
17	6	91	1	2016-05-13	\N	1
18	6	93	1	2016-05-13	\N	1
19	6	95	0	2016-05-13	\N	1
20	6	96	0	2016-05-13	\N	1
21	6	97	0	2016-05-13	\N	1
22	3	87	1	2016-05-13	\N	1
23	3	88	1	2016-05-13	\N	1
24	5	88	1	2016-05-13	\N	1
25	5	104	1	2016-05-13	\N	1
26	4	87	1	2016-05-13	\N	1
27	4	104	1	2016-05-13	\N	1
\.


--
-- Name: t_beneficio_requisito_id_beneficio_requisito_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_requisito_id_beneficio_requisito_seq', 27, true);


--
-- Data for Name: t_beneficio_solicitud; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_beneficio_solicitud (id_beneficio_solicitud, id_solicitante, id_beneficio, fecha, monto, cuotas, interes_cuotas, estatus, id_motivo_razon, observacion, id_programa) FROM stdin;
3	5	1	2016-05-12	30000.00	1	12.00	1	\N	\N	\N
\.


--
-- Name: t_beneficio_solicitud_id_beneficio_solicitud_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_beneficio_solicitud_id_beneficio_solicitud_seq', 3, true);


--
-- Data for Name: t_bitacora_acceso; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_bitacora_acceso (id_bitacora_acceso, id_usuario, mensaje, fecha, hora, ip, navegador) FROM stdin;
57	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-01	20:56:12.161977		
58	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-04	20:26:21.679353		
59	2	El usuario 20810360 ha sido bloqueado por superar el máximo número de intentos por ingresar Usuario/Contraseña incorrecta.	2016-05-04	20:26:30.170694		
60	2	El usuario 20810360 inició sesión exitosamente.	2016-05-04	20:27:20.666448		
61	2	El usuario cerró sesión	2016-05-04	21:00:42.673058		
62	6	El usuario  inició sesión por primera vez.	2016-05-04	21:00:48.737409		
63	6	El usuario ha configurado su contraseña, preguntas y respuestas de seguridad	2016-05-04	21:01:34.355632		
64	6	El usuario cerró sesión	2016-05-04	21:09:22.30669		
65	2	El usuario 20810360 inició sesión exitosamente.	2016-05-04	21:09:31.135759		
66	2	El usuario cerró sesión	2016-05-04	22:31:56.632582		
67	6	El usuario 1234567 inició sesión exitosamente.	2016-05-04	22:32:04.598474		
68	6	El usuario cerró sesión	2016-05-04	22:40:51.82435		
69	2	El usuario 20810360 inició sesión exitosamente.	2016-05-04	22:41:00.004896		
70	2	El usuario cerró sesión	2016-05-04	23:24:06.183777		
71	2	El usuario 20810360 inició sesión exitosamente.	2016-05-05	14:21:27.004876		
72	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-05	21:19:19.59493		
73	2	El usuario  trató de iniciar más sesiones de las permitidas por la configuración del sistema.	2016-05-05	21:19:29.292021		
74	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-05	21:20:28.941812		
75	2	El usuario 20810360 inició sesión exitosamente.	2016-05-05	21:21:09.539399		
76	2	El usuario cerró sesión	2016-05-06	00:05:03.686923		
77	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-07	15:00:26.879164		
78	2	El usuario 20810360 inició sesión exitosamente.	2016-05-07	15:01:12.996574		
79	6	El usuario 1234567 inició sesión exitosamente.	2016-05-07	21:37:48.323669		
80	2	El usuario  trató de iniciar más sesiones de las permitidas por la configuración del sistema.	2016-05-07	22:42:36.439791		
81	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-07	22:43:14.825321		
82	2	El usuario 20810360 inició sesión exitosamente.	2016-05-07	22:43:27.04877		
83	2	El usuario  trató de iniciar más sesiones de las permitidas por la configuración del sistema.	2016-05-07	23:24:06.30821		
84	2	El usuario 20810360 inició sesión exitosamente.	2016-05-07	23:24:27.095729		
85	6	El usuario cerró sesión	2016-05-08	01:07:29.549458		
86	2	El usuario cerró sesión	2016-05-08	01:09:38.906054		
87	2	El usuario 20810360 inició sesión exitosamente.	2016-05-08	14:07:55.827467		
88	2	El usuario cerró sesión	2016-05-09	12:16:49.999		
89	2	El usuario 20810360 inició sesión exitosamente.	2016-05-09	12:17:03.962		
90	2	El usuario cerró sesión	2016-05-09	12:18:08.578		
91	6	El usuario 1234567 inició sesión exitosamente.	2016-05-09	12:18:47.069		
92	6	El usuario cerró sesión	2016-05-09	12:41:49.292		
93	2	El usuario 20810360 inició sesión exitosamente.	2016-05-09	12:41:58.434		
94	1	El usuario  inició sesión por primera vez.	2016-05-09	14:39:19.41		
95	1	El usuario ha configurado su contraseña, preguntas y respuestas de seguridad	2016-05-09	14:40:02.091		
96	2	El usuario 20810360 inició sesión exitosamente.	2016-05-11	09:25:08.604		
97	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-11	09:28:18.896		
98	2	El usuario 20810360 inició sesión exitosamente.	2016-05-11	09:29:03.278		
99	1	El usuario 21560435 ingresó una contraseña incorrecta.	2016-05-12	12:41:14.664		
100	1	El usuario 21560435 inició sesión exitosamente.	2016-05-12	12:41:35.396		
101	1	El usuario cerró sesión	2016-05-12	17:24:35.699		
102	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-12	17:25:16.441		
103	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-12	17:25:29.611		
104	2	El usuario 20810360 ha sido bloqueado por superar el máximo número de intentos por ingresar Usuario/Contraseña incorrecta.	2016-05-12	17:25:43.7		
105	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-12	17:26:12.068		
106	2	El usuario 20810360 ingresó una contraseña incorrecta.	2016-05-12	17:26:26.997		
107	2	El usuario  inició sesión por primera vez.	2016-05-12	17:27:50.597		
108	2	El usuario 20810360 inició sesión exitosamente.	2016-05-12	17:29:50.541		
109	2	El usuario 20810360 inició sesión exitosamente.	2016-05-12	17:55:38.303		
110	2	El usuario cerró sesión	2016-05-12	17:56:49.92		
111	2	El usuario 20810360 inició sesión exitosamente.	2016-05-12	22:11:46.163955		
112	2	El usuario 20810360 inició sesión exitosamente.	2016-05-12	22:28:40.140664		
113	2	El usuario cerró sesión	2016-05-12	22:35:11.466493		
114	6	El usuario 1234567 inició sesión exitosamente.	2016-05-12	22:37:24.576391		
115	6	El usuario cerró sesión	2016-05-13	01:06:41.2789		
116	2	El usuario 20810360 inició sesión exitosamente.	2016-05-13	01:09:37.41531		
117	4	El usuario  inició sesión por primera vez.	2016-05-13	01:45:42.128415		
118	2	El usuario cerró sesión	2016-05-13	02:32:59.121493		
\.


--
-- Name: t_bitacora_acceso_id_bitacora_acceso_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_bitacora_acceso_id_bitacora_acceso_seq', 118, true);


--
-- Data for Name: t_bitacora_general; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_bitacora_general (id_bitacora_general, id_usuario, servicio, ip, fecha, hora, operacion, navegador, mensaje) FROM stdin;
\.


--
-- Name: t_bitacora_general_id_bitacora_general_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_bitacora_general_id_bitacora_general_seq', 1, false);


--
-- Data for Name: t_carga_fam; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_carga_fam (id_carga_fam, id_persona_beneficiario, id_persona_socio, parentesco, fecha_afiliacion, fecha_egreso, porcentaje, estatus, id_motivo, observacion) FROM stdin;
\.


--
-- Data for Name: t_carga_fam_condicion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_carga_fam_condicion (id_carga_fam_condicion, parentesco, sexo, edad_min, edad_max, max_personas, estatus) FROM stdin;
\.


--
-- Name: t_carga_fam_condicion_id_carga_fam_condicion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_carga_fam_condicion_id_carga_fam_condicion_seq', 1, false);


--
-- Name: t_carga_fam_id_carga_fam_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_carga_fam_id_carga_fam_seq', 1, false);


--
-- Data for Name: t_cargo_caja_ahorro; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_cargo_caja_ahorro (id_cargo_caja, nombre, descripcion, fecha_ini, fecha_fin, tipo_cargo, min_cant_personas, max_cant_personas, estatus) FROM stdin;
1	Asociado	Docente afiliado a la Caja de Ahorros	2000-01-01	\N	152	1	9999	1
2	Analista de Crédito	Analista de Crédito Persona encargada de realizar los análisis correspondientes a las solicitudes de préstamo y programas de financiamiento.	2000-01-01	\N	153	1	10	1
3	Presidente	Presidente del Consejo Administrativo, junto con los otros miembros del Consejo se encarga de la administración y gestión financiera de la Caja de Ahorros, tiene un papel decisivo en la aprobación de solicitudes de cualquier tipo.	2000-01-01	\N	154	1	1	1
4	Tesorero	Tesorero del Consejo Administrativo, junto con los otros miembros del Consejo se encarga de la administración y gestión financiera de la Caja de Ahorros, tiene un papel decisivo en la aprobación de solicitudes de cualquier tipo.	2000-01-01	\N	154	1	1	1
5	Secretario	Secretario del Consejo Administrativo, junto con los otros miembros del Consejo se encarga de la administración y gestión financiera de la Caja de Ahorros, tiene un papel decisivo en la aprobación de solicitudes de cualquier tipo.	2000-01-01	\N	154	1	1	1
\.


--
-- Name: t_cargo_caja_ahorro_id_cargo_caja_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_cargo_caja_ahorro_id_cargo_caja_seq', 1, false);


--
-- Data for Name: t_ciudad; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_ciudad (id_ciudad, id_estado, descripcion, capital) FROM stdin;
\.


--
-- Name: t_ciudad_id_ciudad_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_ciudad_id_ciudad_seq', 1, false);


--
-- Data for Name: t_configuracion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_configuracion (mision, vision, historia, clave_long_min, clave_long_max, clave_intentos_fallidos, clave_dias_caducidad, clave_dias_antes, clave_dif_anterior, clave_mayus, clave_minus, clave_caracteres, clave_caracteres_validos, preguntas_cant, sesion_min_expira, sesion_min_antes, porcentaje_patrono, porcentaje_socio, porcentaje_descuento_min, porcentaje_descuento_max, num_min_noches, num_max_noches, "num_min_acompañantes", "num_max_acompañantes", num_min_beneficiarios, num_max_beneficiarios, not_correo, not_telf, clave_num, max_sesiones_abiertas) FROM stdin;
Fomentar el hábito del ahorro entre sus asociados acorde a su capacidad económica; y mediante la implementación y puesta en marcha en un conjunto de préstamos, servicios y convenios, impulsar el crecimiento en la calidad de vida de los mismos.	Utilizar eficientemente los recursos humanos, tecnológicos, financieros y estructurales, que respondan a los objetivos organizacionales de CAPPIUTEP, para que procuren el mayor rendimiento económico y social de sus asociados.	La Caja de Ahorro y Préstamo de los Profesores del Instituto Universitario de Tecnología del Estado Portuguesa CAPPIUTEP, es una asociación civil sin fines de lucros, autónoma, con personalidad jurídica propia, con 17 años de funcionamiento, tiempo durante el cual se ha venido fortaleciendo con el objetivo de contar con una organización social, con apego al marco legal vigente. 	8	16	3	300	7	3	1	1	1	? $ - / @ ! % .	2	30	1	10	10	0	25	2	10	0	5	0	99	1	0	1	3
\.


--
-- Data for Name: t_detalle_liquid; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_detalle_liquid (id_liquid, id_solicitud, monto, forma_pago, ref_pago, id_motivo_razon, observacion, estatus) FROM stdin;
\.


--
-- Name: t_detalle_liquid_id_liquid_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_detalle_liquid_id_liquid_seq', 1, false);


--
-- Data for Name: t_estado; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_estado (id_estado, estado, estatus) FROM stdin;
1	Amazonas	0
2	Anzoátegui	0
3	Apure	0
4	Aragua	0
6	Bolívar	0
7	Carabobo	0
9	Delta Amacuro	0
10	Falcón	0
11	Guárico	0
13	Mérida	0
14	Miranda	0
15	Monagas	0
16	Nueva Esparta	0
18	Sucre	0
19	Táchira	0
21	Vargas	0
22	Yaracuy	0
23	Zulia	0
24	Distrito Capital	0
25	Dependencias Federales	0
17	Portuguesa	1
5	Barinas	1
20	Trujillo	1
8	Cojedes	1
12	Lara	1
\.


--
-- Name: t_estado_id_estado_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_estado_id_estado_seq', 1, false);


--
-- Data for Name: t_flujo_aprueba; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_flujo_aprueba (id_flujo_aprueba, id_beneficio_flujo, id_cargo_caja, estatus) FROM stdin;
1	1	2	1
2	2	3	1
3	2	4	1
4	2	5	1
5	3	2	1
6	4	2	1
7	5	3	1
8	5	4	1
9	5	5	1
10	6	2	1
11	7	2	1
12	8	3	1
13	8	4	1
14	8	5	1
15	9	2	1
16	10	2	1
17	11	3	1
18	11	4	1
19	11	5	1
20	12	2	1
21	13	2	1
22	14	3	1
23	14	4	1
24	14	5	1
25	15	2	1
\.


--
-- Name: t_flujo_aprueba_id_flujo_aprueba_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_flujo_aprueba_id_flujo_aprueba_seq', 1, false);


--
-- Data for Name: t_haberes; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_haberes (id_haberes, id_persona, saldo, saldo_bloq_prestamo, saldo_bloq_fianza, fecha_cierre) FROM stdin;
1	2	10000	\N	\N	2016-01-31
2	2	103000	\N	\N	2016-02-29
3	2	106000	\N	\N	2016-03-31
4	1	50000	\N	\N	2016-04-25
\.


--
-- Name: t_haberes_id_haberes_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_haberes_id_haberes_seq', 4, true);


--
-- Data for Name: t_icono; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_icono (id_icono, icono, estatus) FROM stdin;
1	alarm	1
2	alarm slash	1
3	alarm outline	1
4	alarm slash outline	1
5	at	1
6	browser	1
7	bug	1
8	calendar outline	1
9	calendar	1
10	cloud	1
11	code	1
12	comment	1
13	comments	1
14	comment outline	1
15	comments outline	1
16	copyright	1
17	dashboard	1
18	dropdown	1
19	external square	1
20	external	1
21	eyedropper	1
22	feed	1
23	find	1
24	heartbeat	1
25	history	1
26	home	1
27	idea	1
28	inbox	1
29	lab	1
30	mail	1
31	mail outline	1
32	mail square	1
33	map	1
34	options	1
35	paint brush	1
36	payment	1
37	phone	1
38	phone square	1
39	privacy	1
40	protect	1
41	search	1
42	setting	1
43	settings	1
44	shop	1
45	sidebar	1
46	signal	1
47	sitemap	1
48	tag	1
49	tags	1
50	tasks	1
51	terminal	1
52	text telephone	1
53	ticket	1
54	trophy	1
55	wifi	1
56	adjust	1
57	add user	1
58	add to cart	1
59	archive	1
60	ban	1
61	bookmark	1
62	call	1
63	call square	1
64	cloud download	1
65	cloud upload	1
66	compress	1
67	configure	1
68	download	1
69	edit	1
70	erase	1
71	exchange	1
72	external share	1
73	expand	1
74	filter	1
75	flag	1
76	flag outline	1
77	forward mail	1
78	hide	1
79	in cart	1
80	lock	1
81	pin	1
82	print	1
83	random	1
84	recycle	1
85	refresh	1
86	remove bookmark	1
87	remove user	1
88	repeat	1
89	reply all	1
90	reply	1
91	retweet	1
92	send	1
93	send outline	1
94	share alternate	1
95	share alternate square	1
96	share	1
97	share square	1
98	sign in	1
99	sign out	1
100	theme	1
101	translate	1
102	undo	1
103	unhide	1
104	unlock alternate	1
105	unlock	1
106	upload	1
107	wait	1
108	wizard	1
109	write	1
110	write square	1
111	announcement	1
112	birthday	1
113	flag	1
114	help	1
115	help circle	1
116	info	1
117	info circle	1
118	warning	1
119	warning circle	1
120	warning sign	1
121	child	1
122	doctor	1
123	handicap	1
124	spy	1
125	student	1
126	user	1
127	users	1
128	female	1
129	gay	1
130	heterosexual	1
131	intergender	1
132	lesbian	1
133	male	1
134	man	1
135	neuter	1
136	non binary transgender	1
137	transgender	1
138	other gender	1
139	other gender horizontal	1
140	other gender vertical	1
141	woman	1
142	grid layout	1
143	list layout	1
144	block layout	1
145	zoom	1
146	zoom out	1
147	resize vertical	1
148	resize horizontal	1
149	maximize	1
150	crop	1
151	anchor	1
152	bar	1
153	bomb	1
154	book	1
155	bullseye	1
156	calculator	1
157	checkered flag	1
158	cocktail	1
159	diamond	1
160	fax	1
161	fire extinguisher	1
162	fire	1
163	gift	1
164	leaf	1
165	legal	1
166	lemon	1
167	life ring	1
168	lightning	1
169	magnet	1
170	money	1
171	moon	1
172	plane	1
173	puzzle	1
174	rain	1
175	road	1
176	rocket	1
177	shipping	1
178	soccer	1
179	suitcase	1
180	sun	1
181	travel	1
182	treatment	1
183	world	1
184	asterisk	1
185	certificate	1
186	circle	1
187	circle notched	1
188	circle thin	1
189	crosshairs	1
190	cube	1
191	cubes	1
192	ellipsis horizontal	1
193	ellipsis vertical	1
194	quote left	1
195	quote right	1
196	spinner	1
197	square	1
198	square outline	1
199	add circle	1
200	add square	1
201	check circle	1
202	check circle outline	1
203	check square	1
204	checkmark box	1
205	checkmark	1
206	minus circle	1
207	minus	1
208	minus square	1
209	minus square outline	1
210	move	1
211	plus	1
212	plus square outline	1
213	radio	1
214	remove circle	1
215	remove circle outline	1
216	remove	1
217	selected radio	1
218	toggle off	1
219	toggle on	1
220	area chart	1
221	bar chart	1
222	camera retro	1
223	newspaper	1
224	film	1
225	line chart	1
226	photo	1
227	pie chart	1
228	sound	1
229	angle double down	1
230	angle double left	1
231	angle double right	1
232	angle double up	1
233	angle down	1
234	angle left	1
235	angle right	1
236	angle up	1
237	arrow circle down	1
238	arrow circle left	1
239	arrow circle outline down	1
240	arrow circle outline left	1
241	arrow circle outline right	1
242	arrow circle outline up	1
243	arrow circle right	1
244	arrow circle up	1
245	arrow down	1
246	arrow left	1
247	arrow right	1
248	arrow up	1
249	caret down	1
250	caret left	1
251	caret right	1
252	caret up	1
253	chevron circle down	1
254	chevron circle left	1
255	chevron circle right	1
256	chevron circle up	1
257	chevron down	1
258	chevron left	1
259	chevron right	1
260	chevron up	1
261	long arrow down	1
262	long arrow left	1
263	long arrow right	1
264	long arrow up	1
265	pointing down	1
266	pointing left	1
267	pointing right	1
268	pointing up	1
269	toggle down	1
270	toggle left	1
271	toggle right	1
272	toggle up	1
273	desktop	1
274	disk outline	1
275	file archive outline	1
276	file audio outline	1
277	file code outline	1
278	file excel outline	1
279	file	1
280	file image outline	1
281	file outline	1
282	file pdf outline	1
283	file powerpoint outline	1
284	file text	1
285	file text outline	1
286	file video outline	1
287	file word outline	1
288	folder	1
289	folder open	1
290	folder open outline	1
291	folder outline	1
292	game	1
293	keyboard	1
294	laptop	1
295	level down	1
296	level up	1
297	mobile	1
298	power	1
299	plug	1
300	tablet	1
301	trash	1
302	trash outline	1
303	barcode	1
304	css3	1
305	database	1
306	fork	1
307	html5	1
308	openid	1
309	qrcode	1
310	rss	1
311	rss square	1
312	server	1
313	empty heart	1
314	empty star	1
315	frown	1
316	heart	1
317	meh	1
318	smile	1
319	star half empty	1
320	star half	1
321	star	1
322	thumbs down	1
323	thumbs outline down	1
324	thumbs outline up	1
325	thumbs up	1
326	backward	1
327	eject	1
328	fast backward	1
329	fast forward	1
330	forward	1
331	music	1
332	mute	1
333	pause	1
334	play	1
335	record	1
336	step backward	1
337	step forward	1
338	stop	1
339	unmute	1
340	video play	1
341	video play outline	1
342	volume down	1
343	volume off	1
344	volume up	1
345	building	1
346	building outline	1
347	car	1
348	coffee	1
349	emergency	1
350	first aid	1
351	food	1
352	h	1
353	hospital	1
354	location arrow	1
355	marker	1
356	military	1
357	paw	1
358	space shuttle	1
359	spoon	1
360	taxi	1
361	tree	1
362	university	1
363	columns	1
364	sort alphabet ascending	1
365	sort alphabet descending	1
366	sort ascending	1
367	sort content ascending	1
368	sort content descending	1
369	sort descending	1
370	sort	1
371	sort numeric ascending	1
372	sort numeric descending	1
373	table	1
374	align center	1
375	align justify	1
376	align left	1
377	align right	1
378	attach	1
379	bold	1
380	copy	1
381	cut	1
382	font	1
383	header	1
384	indent	1
385	italic	1
386	linkify	1
387	list	1
388	ordered list	1
389	outdent	1
390	paragraph	1
391	paste	1
392	save	1
393	strikethrough	1
394	subscript	1
395	superscript	1
396	text height	1
397	text width	1
398	underline	1
399	unlink	1
400	unordered list	1
401	dollar	1
402	euro	1
403	lira	1
404	pound	1
405	ruble	1
406	rupee	1
407	shekel	1
408	won	1
409	yen	1
410	american express	1
411	discover	1
412	google wallet	1
413	mastercard	1
414	paypal card	1
415	paypal	1
416	stripe	1
417	visa	1
418	adn	1
419	android	1
420	angellist	1
421	apple	1
422	behance	1
423	behance square	1
424	bitbucket	1
425	bitbucket square	1
426	bitcoin	1
427	buysellads	1
428	codepen	1
429	connectdevelop	1
430	dashcube	1
431	delicious	1
432	deviantart	1
433	digg	1
434	dribbble	1
435	dropbox	1
436	drupal	1
437	empire	1
438	facebook	1
439	facebook square	1
440	flickr	1
441	forumbee	1
442	foursquare	1
443	git	1
444	git square	1
445	github alternate	1
446	github	1
447	github square	1
448	gittip	1
449	google	1
450	google plus	1
451	google plus square	1
452	hacker news	1
453	instagram	1
454	ioxhost	1
455	joomla	1
456	jsfiddle	1
457	lastfm	1
458	lastfm square	1
459	leanpub	1
460	linkedin	1
461	linkedin square	1
462	linux	1
463	maxcdn	1
464	meanpath	1
465	medium	1
466	pagelines	1
467	pied piper alternate	1
468	pied piper	1
469	pinterest	1
470	pinterest square	1
471	qq	1
472	rebel	1
473	reddit	1
474	reddit square	1
475	renren	1
476	sellsy	1
477	shirtsinbulk	1
478	simplybuilt	1
479	skyatlas	1
480	skype	1
481	slack	1
482	slideshare	1
483	soundcloud	1
484	spotify	1
485	stack exchange	1
486	stack overflow	1
487	steam	1
488	steam square	1
489	stumbleupon circle	1
490	stumbleupon	1
491	tencent weibo	1
492	trello	1
493	tumblr	1
494	tumblr square	1
495	twitch	1
496	twitter	1
497	twitter square	1
498	viacoin	1
499	vimeo	1
500	vine	1
501	vk	1
502	wechat	1
503	weibo	1
504	whatsapp	1
505	windows	1
506	wordpress	1
507	xing	1
508	xing square	1
509	yahoo	1
510	yelp	1
511	youtube	1
512	youtube play	1
513	youtube square	1
\.


--
-- Name: t_icono_id_icono_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_icono_id_icono_seq', 1, false);


--
-- Data for Name: t_lista; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_lista (id_lista, nombre, estatus, bloqueado) FROM stdin;
1	Estado Civíl	1	1
2	Sexo	1	1
3	Sedes	1	0
4	Operadoras Telf. Móvil	1	0
5	Codigos de Area Telf. Fija	1	0
6	Requisitos de Beneficios	1	0
7	Bancos	1	0
8	Tipos de Cuenta	1	0
9	Nacionalidades	1	0
10	Condiciones de Usuario	1	0
11	Condiciones de Socio	1	0
12	Tipos de Cargo de Caja de Ahorro	1	0
13	Cargos de Caja de Ahorro	1	0
14	Tipos de Docente	1	0
15	Dedicaciones de Docente	1	0
16	Categorias de Docente	1	0
17	Parentescos de Beneficiarios	1	1
18	Condición de Período	1	0
19	Tipo de Beneficio	1	1
20	Formas de Pago	1	1
21	Conceptos de Pago	1	1
22	Programas de Financiamiento	1	1
\.


--
-- Name: t_lista_id_lista_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_lista_id_lista_seq', 22, true);


--
-- Data for Name: t_lista_valor; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_lista_valor (id_lista_valor, id_lista, nombre_corto, nombre_largo, id_padre, posicion, estatus, bloq) FROM stdin;
1	1	\N	Soltero	\N	1	1	1
2	1	\N	Casado	\N	2	1	1
3	1	\N	Viudo	\N	3	1	1
4	1	\N	Divorciado	\N	4	1	1
5	2	M	Masculino	\N	\N	1	1
6	2	F	Femenino	\N	\N	1	1
7	3	\N	Acarigua	\N	1	1	0
8	3	\N	Turén	\N	2	1	0
9	3	\N	Guanare	\N	3	1	0
10	4	\N	0414	\N	\N	1	1
11	4	\N	0424	\N	\N	1	1
12	4	\N	0416	\N	\N	1	1
13	4	\N	0426	\N	\N	1	1
14	4	\N	0412	\N	\N	1	1
15	5	\N	0248	\N	\N	1	1
16	5	\N	0281	\N	\N	1	1
17	5	\N	0282	\N	\N	1	1
18	5	\N	0283	\N	\N	1	1
19	5	\N	0285	\N	\N	1	1
20	5	\N	0292	\N	\N	1	1
21	5	\N	0240	\N	\N	1	1
22	5	\N	0247	\N	\N	1	1
23	5	\N	0278	\N	\N	1	1
24	5	\N	0243	\N	\N	1	1
25	5	\N	0244	\N	\N	1	1
26	5	\N	0246	\N	\N	1	1
27	5	\N	0273	\N	\N	1	1
28	5	\N	0278	\N	\N	1	1
29	5	\N	0284	\N	\N	1	1
30	5	\N	0285	\N	\N	1	1
31	5	\N	0286	\N	\N	1	1
32	5	\N	0288	\N	\N	1	1
33	5	\N	0289	\N	\N	1	1
34	5	\N	0241	\N	\N	1	1
35	5	\N	0242	\N	\N	1	1
36	5	\N	0243	\N	\N	1	1
37	5	\N	0245	\N	\N	1	1
38	5	\N	0249	\N	\N	1	1
39	5	\N	0258	\N	\N	1	1
40	5	\N	0287	\N	\N	1	1
41	5	\N	0212	\N	\N	1	1
42	5	\N	0259	\N	\N	1	1
43	5	\N	0268	\N	\N	1	1
44	5	\N	0269	\N	\N	1	1
45	5	\N	0279	\N	\N	1	1
46	5	\N	0235	\N	\N	1	1
47	5	\N	0238	\N	\N	1	1
48	5	\N	0246	\N	\N	1	1
49	5	\N	0247	\N	\N	1	1
50	5	\N	0251	\N	\N	1	1
51	5	\N	0252	\N	\N	1	1
52	5	\N	0253	\N	\N	1	1
53	5	\N	0271	\N	\N	1	1
54	5	\N	0274	\N	\N	1	1
55	5	\N	0275	\N	\N	1	1
56	5	\N	0212	\N	\N	1	1
57	5	\N	0234	\N	\N	1	1
58	5	\N	0239	\N	\N	1	1
59	5	\N	0287	\N	\N	1	1
60	5	\N	0291	\N	\N	1	1
61	5	\N	0292	\N	\N	1	1
62	5	\N	0295	\N	\N	1	1
63	5	\N	0255	\N	\N	1	1
64	5	\N	0256	\N	\N	1	1
65	5	\N	0257	\N	\N	1	1
66	5	\N	0272	\N	\N	1	1
67	5	\N	0293	\N	\N	1	1
68	5	\N	0294	\N	\N	1	1
69	5	\N	0275	\N	\N	1	1
70	5	\N	0276	\N	\N	1	1
71	5	\N	0277	\N	\N	1	1
72	5	\N	0278	\N	\N	1	1
73	5	\N	0271	\N	\N	1	1
74	5	\N	0272	\N	\N	1	1
75	5	\N	0212	\N	\N	1	1
76	5	\N	0251	\N	\N	1	1
77	5	\N	0253	\N	\N	1	1
78	5	\N	0254	\N	\N	1	1
79	5	\N	0262	\N	\N	1	1
80	5	\N	0263	\N	\N	1	1
81	5	\N	0264	\N	\N	1	1
82	5	\N	0265	\N	\N	1	1
83	5	\N	0266	\N	\N	1	1
84	5	\N	0267	\N	\N	1	1
85	5	\N	0271	\N	\N	1	1
86	5	\N	0275	\N	\N	1	1
87	6	\N	Fotocopia de la cédula de identidad.	\N	\N	1	0
88	6	\N	Último comprobante de pago (fotocopia).	\N	\N	1	0
89	6	\N	Avalúo del inmueble efectuado por un perito evaluador, legalmente autorizado para ese fin.	\N	\N	1	0
90	6	\N	Plano de la Planta, Terreno, Construcción.	\N	\N	1	0
91	6	\N	Documento de Propiedad debidamente registrado.	\N	\N	1	0
92	6	\N	Certificación libre de gravámenes	\N	\N	1	0
93	6	\N	Presupuesto de construcción, avalado por un perito legalmente autorizado para tal fin.	\N	\N	1	0
94	6	\N	Carta de compromiso del propietario hacia el comprador.	\N	\N	1	0
95	6	\N	Presupuesto de valor de la vivienda (adquisición).	\N	\N	1	0
96	6	\N	Documento de hipoteca constituida (liberacion).	\N	\N	1	0
97	6	\N	Saldo deudor del inmueble (liberacion).	\N	\N	1	0
98	6	\N	Constancia de trabajo actualizada especificando el ingreso.	\N	\N	1	0
99	6	\N	Declaracion jurada y notariada de no poseer vivienda propia.	\N	\N	1	0
100	6	\N	Hipoteca a favor de CAPPIUTEP (tramitado por CAPPIUTEP)	\N	\N	1	0
101	6	\N	Balance personal suscrito por un Contador Público colegiado, debidamente visado y soportado en lo posible.	\N	\N	1	0
102	6	\N	Seguro de vida, incendio y terremoto, a favor de CAPPIUTEP (tramitado por CAPPIUTEP).	\N	\N	1	0
103	6	\N	Tabla de Amortización.	\N	\N	1	0
104	6	\N	Estado de cuenta.	\N	\N	1	0
105	6	\N	Plano de la remodelación firmado por un perito o arquitecto.	\N	\N	1	0
106	6	\N	Presupuesto de la remodelación y/o ampliación.	\N	\N	1	0
107	6	\N	Fotografía del inmueble (antes y después).	\N	\N	1	0
108	6	\N	Estado de cuenta de los Fiadores.	\N	\N	1	0
109	6	\N	Comprobante de depósito bancario a nombre de CAPPIUTEP.	\N	\N	1	0
110	7	0001	BANCO CENTRAL DE VENEZUELA	\N	\N	1	1
111	7	0102	BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL	\N	\N	1	1
112	7	0104	VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL	\N	\N	1	1
113	7	0105	BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL	\N	\N	1	1
114	7	0108	BANCO PROVINCIAL, S.A. BANCO UNIVERSAL	\N	\N	1	1
115	7	0114	BANCO DEL CARIBE, C.A. BANCO UNIVERSAL	\N	\N	1	1
116	7	0115	BANCO EXTERIOR, C.A. BANCO UNIVERSAL	\N	\N	1	1
117	7	0116	BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.	\N	\N	1	1
118	7	0128	BANCO CARONI, C.A. BANCO UNIVERSAL	\N	\N	1	1
119	7	0134	BANESCO BANCO UNIVERSAL S.A.C.A.	\N	\N	1	1
120	7	0137	BANCO SOFITASA BANCO UNIVERSAL, C.A.	\N	\N	1	1
121	7	0138	BANCO PLAZA, BANCO UNIVERSAL C.A.	\N	\N	1	1
122	7	0146	BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.	\N	\N	1	1
123	7	0149	BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO	\N	\N	1	1
124	7	0151	BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL	\N	\N	1	1
125	7	0156	100% BANCO, BANCO COMERCIAL, C.A.	\N	\N	1	1
126	7	0157	DELSUR BANCO UNIVERSAL, C.A.	\N	\N	1	1
127	7	0163	BANCO DEL TESORO, C.A. BANCO UNIVERSAL	\N	\N	1	1
128	7	0166	BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL	\N	\N	1	1
129	7	0168	BANCRECER S.A. BANCO DE DESARROLLO	\N	\N	1	1
130	7	0169	MI BANCO, BANCO MICROFINANCIERO, C.A.	\N	\N	1	1
131	7	0171	BANCO ACTIVO, C.A. BANCO UNIVERSAL	\N	\N	1	1
132	7	0172	BANCAMIGA BANCO MICROFINANCIERO, C.A.	\N	\N	1	1
133	7	0173	BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL	\N	\N	1	1
134	7	0174	BANPLUS BANCO UNIVERAL, C.A.	\N	\N	1	1
135	7	0175	BANCO BICENTENARIO BANCO UNIVERSAL, C.A.	\N	\N	1	1
136	7	0176	NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL	\N	\N	1	1
137	7	0177	BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.	\N	\N	1	1
138	7	0190	CITIBANK N.A.	\N	\N	1	1
139	7	0191	BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL	\N	\N	1	1
140	7	0601	INSTITUTO MUNICIPAL DE CRÉDITO POPULAR	\N	\N	1	1
141	8	\N	Ahorros	\N	\N	1	1
142	8	\N	Corriente	\N	\N	1	1
143	9	V	Venezolano	\N	\N	1	1
144	9	E	Extranjero	\N	\N	1	1
145	10	\N	Nuevo	\N	\N	1	1
146	10	\N	Activo	\N	\N	1	1
147	10	\N	Bloqueado	\N	\N	1	1
148	10	\N	Inactivo	\N	\N	1	1
149	11	\N	Solvente	\N	\N	1	1
150	11	\N	No Solvente	\N	\N	1	1
151	11	\N	Retirado	\N	\N	1	1
152	12	\N	Asociado	\N	1	1	0
153	12	\N	Personal Administrativo	\N	2	1	0
154	12	\N	Consejo Administrativo	\N	3	1	0
155	13	\N	Socio	152	\N	1	0
156	13	\N	Analista	153	\N	1	0
157	13	\N	Presidente	154	\N	1	0
158	13	\N	Tesorero	154	\N	1	0
159	13	\N	Secretario	154	\N	1	0
160	14	\N	Docente Ordinario	\N	\N	1	0
161	14	\N	Docente Contratado	\N	\N	1	0
162	14	\N	Personal Administrativo	\N	\N	1	0
163	15	\N	Tiempo Convencional	\N	\N	1	0
164	15	\N	Medio Tiempo	\N	\N	1	0
165	15	\N	Tiempo Completo	\N	\N	1	0
166	15	\N	Exclusiva	\N	\N	1	0
167	16	\N	Instructor	\N	\N	1	0
168	16	\N	Asistente	\N	\N	1	0
169	16	\N	Agregado	\N	\N	1	0
170	16	\N	Asociado	\N	\N	1	0
171	16	\N	Titular	\N	\N	1	0
172	17	\N	Padre	\N	\N	1	1
173	17	\N	Madre	\N	\N	1	1
174	17	\N	Hermano	\N	\N	1	1
175	17	\N	Cónyugue	\N	\N	1	1
176	17	\N	Hijo	\N	\N	1	1
178	18	\N	Nunca Abierto	\N	\N	1	1
179	18	\N	Abierto	\N	\N	1	1
180	18	\N	Pre-Cerrado	\N	\N	1	1
181	18	\N	Cerrado	\N	\N	1	1
182	19	\N	Préstamo	\N	\N	1	1
183	19	\N	Financiamiento	\N	\N	1	1
184	19	\N	Retiro	\N	\N	1	1
185	19	\N	Otro	\N	\N	1	1
186	20	\N	Efectivo	\N	\N	1	1
187	20	\N	Cheque	\N	\N	1	1
188	20	\N	Transferencia	\N	\N	1	1
189	21	\N	Abono a cuenta	\N	\N	1	1
190	21	\N	Cancelación total	\N	\N	1	1
191	21	\N	Cancelación couta especial	\N	\N	1	1
192	22	\N	Línea Blanca	\N	\N	1	0
193	22	\N	Línea Marrón	\N	\N	1	0
194	22	\N	Computación y equipos electrónicos	\N	\N	1	0
195	22	\N	Teléfonos Celulares	\N	\N	1	0
196	22	\N	Neumáticos	\N	\N	1	0
197	22	\N	Crédito Hipotecario	\N	\N	1	0
198	22	\N	Vehículo	\N	\N	1	0
199	22	\N	Filtros de Agua	\N	\N	1	0
200	22	\N	Acciones de Clubes	\N	\N	1	0
201	22	\N	Fondo de Salud	\N	\N	1	0
\.


--
-- Name: t_lista_valor_id_lista_valor_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_lista_valor_id_lista_valor_seq', 542, true);


--
-- Data for Name: t_modulo; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_modulo (id_modulo, descripcion, id_icono, id_padre, posicion, estatus) FROM stdin;
1	Administrar	47	\N	3	1
5	Bitácoras	103	\N	5	1
3	Socio	126	\N	1	1
4	Beneficios	256	\N	2	1
2	Configuración	43	\N	4	1
\.


--
-- Name: t_modulo_id_modulo_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_modulo_id_modulo_seq', 5, true);


--
-- Data for Name: t_motivo_proceso; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_motivo_proceso (id_motivo_proceso, id_motivo, id_proceso, estatus) FROM stdin;
\.


--
-- Name: t_motivo_proceso_id_motivo_proceso_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_motivo_proceso_id_motivo_proceso_seq', 1, false);


--
-- Data for Name: t_motivo_razon; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_motivo_razon (id_motivo_razon, nombre, descripcion, estatus) FROM stdin;
\.


--
-- Name: t_motivo_razon_id_motivo_razon_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_motivo_razon_id_motivo_razon_seq', 1, false);


--
-- Data for Name: t_municipio; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_municipio (id_municipio, id_estado, municipio, estatus) FROM stdin;
1	1	Alto Orinoco	1
2	1	Atabapo	1
3	1	Atures	1
4	1	Autana	1
5	1	Manapiare	1
6	1	Maroa	1
7	1	Río Negro	1
8	2	Anaco	1
9	2	Aragua	1
10	2	Manuel Ezequiel Bruzual	1
11	2	Diego Bautista Urbaneja	1
12	2	Fernando Peñalver	1
13	2	Francisco Del Carmen Carvajal	1
14	2	General Sir Arthur McGregor	1
15	2	Guanta	1
16	2	Independencia	1
17	2	José Gregorio Monagas	1
18	2	Juan Antonio Sotillo	1
19	2	Juan Manuel Cajigal	1
20	2	Libertad	1
21	2	Francisco de Miranda	1
22	2	Pedro María Freites	1
23	2	Píritu	1
24	2	San José de Guanipa	1
25	2	San Juan de Capistrano	1
26	2	Santa Ana	1
27	2	Simón Bolívar	1
28	2	Simón Rodríguez	1
29	3	Achaguas	1
30	3	Biruaca	1
31	3	Muñóz	1
32	3	Páez	1
33	3	Pedro Camejo	1
34	3	Rómulo Gallegos	1
35	3	San Fernando	1
36	4	Atanasio Girardot	1
37	4	Bolívar	1
38	4	Camatagua	1
39	4	Francisco Linares Alcántara	1
40	4	José Ángel Lamas	1
41	4	José Félix Ribas	1
42	4	José Rafael Revenga	1
43	4	Libertador	1
44	4	Mario Briceño Iragorry	1
45	4	Ocumare de la Costa de Oro	1
46	4	San Casimiro	1
47	4	San Sebastián	1
48	4	Santiago Mariño	1
49	4	Santos Michelena	1
50	4	Sucre	1
51	4	Tovar	1
52	4	Urdaneta	1
53	4	Zamora	1
54	5	Alberto Arvelo Torrealba	1
55	5	Andrés Eloy Blanco	1
56	5	Antonio José de Sucre	1
57	5	Arismendi	1
58	5	Barinas	1
59	5	Bolívar	1
60	5	Cruz Paredes	1
61	5	Ezequiel Zamora	1
62	5	Obispos	1
63	5	Pedraza	1
64	5	Rojas	1
65	5	Sosa	1
66	6	Caroní	1
67	6	Cedeño	1
68	6	El Callao	1
69	6	Gran Sabana	1
70	6	Heres	1
71	6	Piar	1
72	6	Angostura (Raúl Leoni)	1
73	6	Roscio	1
74	6	Sifontes	1
75	6	Sucre	1
76	6	Padre Pedro Chien	1
77	7	Bejuma	1
78	7	Carlos Arvelo	1
79	7	Diego Ibarra	1
80	7	Guacara	1
81	7	Juan José Mora	1
82	7	Libertador	1
83	7	Los Guayos	1
84	7	Miranda	1
85	7	Montalbán	1
86	7	Naguanagua	1
87	7	Puerto Cabello	1
88	7	San Diego	1
89	7	San Joaquín	1
90	7	Valencia	1
91	8	Anzoátegui	1
92	8	Tinaquillo	1
93	8	Girardot	1
94	8	Lima Blanco	1
95	8	Pao de San Juan Bautista	1
96	8	Ricaurte	1
97	8	Rómulo Gallegos	1
98	8	San Carlos	1
99	8	Tinaco	1
100	9	Antonio Díaz	1
101	9	Casacoima	1
102	9	Pedernales	1
103	9	Tucupita	1
104	10	Acosta	1
105	10	Bolívar	1
106	10	Buchivacoa	1
107	10	Cacique Manaure	1
108	10	Carirubana	1
109	10	Colina	1
110	10	Dabajuro	1
111	10	Democracia	1
112	10	Falcón	1
113	10	Federación	1
114	10	Jacura	1
115	10	José Laurencio Silva	1
116	10	Los Taques	1
117	10	Mauroa	1
118	10	Miranda	1
119	10	Monseñor Iturriza	1
120	10	Palmasola	1
121	10	Petit	1
122	10	Píritu	1
123	10	San Francisco	1
124	10	Sucre	1
125	10	Tocópero	1
126	10	Unión	1
127	10	Urumaco	1
128	10	Zamora	1
129	11	Camaguán	1
130	11	Chaguaramas	1
131	11	El Socorro	1
132	11	José Félix Ribas	1
133	11	José Tadeo Monagas	1
134	11	Juan Germán Roscio	1
135	11	Julián Mellado	1
136	11	Las Mercedes	1
137	11	Leonardo Infante	1
138	11	Pedro Zaraza	1
139	11	Ortíz	1
140	11	San Gerónimo de Guayabal	1
141	11	San José de Guaribe	1
142	11	Santa María de Ipire	1
143	11	Sebastián Francisco de Miranda	1
144	12	Andrés Eloy Blanco	1
145	12	Crespo	1
146	12	Iribarren	1
147	12	Jiménez	1
148	12	Morán	1
149	12	Palavecino	1
150	12	Simón Planas	1
151	12	Torres	1
152	12	Urdaneta	1
179	13	Alberto Adriani	1
180	13	Andrés Bello	1
181	13	Antonio Pinto Salinas	1
182	13	Aricagua	1
183	13	Arzobispo Chacón	1
184	13	Campo Elías	1
185	13	Caracciolo Parra Olmedo	1
186	13	Cardenal Quintero	1
187	13	Guaraque	1
188	13	Julio César Salas	1
189	13	Justo Briceño	1
190	13	Libertador	1
191	13	Miranda	1
192	13	Obispo Ramos de Lora	1
193	13	Padre Noguera	1
194	13	Pueblo Llano	1
195	13	Rangel	1
196	13	Rivas Dávila	1
197	13	Santos Marquina	1
198	13	Sucre	1
199	13	Tovar	1
200	13	Tulio Febres Cordero	1
201	13	Zea	1
223	14	Acevedo	1
224	14	Andrés Bello	1
225	14	Baruta	1
226	14	Brión	1
227	14	Buroz	1
228	14	Carrizal	1
229	14	Chacao	1
230	14	Cristóbal Rojas	1
231	14	El Hatillo	1
232	14	Guaicaipuro	1
233	14	Independencia	1
234	14	Lander	1
235	14	Los Salias	1
236	14	Páez	1
237	14	Paz Castillo	1
238	14	Pedro Gual	1
239	14	Plaza	1
240	14	Simón Bolívar	1
241	14	Sucre	1
242	14	Urdaneta	1
243	14	Zamora	1
258	15	Acosta	1
259	15	Aguasay	1
260	15	Bolívar	1
261	15	Caripe	1
262	15	Cedeño	1
263	15	Ezequiel Zamora	1
264	15	Libertador	1
265	15	Maturín	1
266	15	Piar	1
267	15	Punceres	1
268	15	Santa Bárbara	1
269	15	Sotillo	1
270	15	Uracoa	1
271	16	Antolín del Campo	1
272	16	Arismendi	1
273	16	García	1
274	16	Gómez	1
275	16	Maneiro	1
276	16	Marcano	1
277	16	Mariño	1
278	16	Península de Macanao	1
279	16	Tubores	1
280	16	Villalba	1
281	16	Díaz	1
282	17	Agua Blanca	1
283	17	Araure	1
284	17	Esteller	1
285	17	Guanare	1
286	17	Guanarito	1
287	17	Monseñor José Vicente de Unda	1
288	17	Ospino	1
289	17	Páez	1
290	17	Papelón	1
291	17	San Genaro de Boconoíto	1
292	17	San Rafael de Onoto	1
293	17	Santa Rosalía	1
294	17	Sucre	1
295	17	Turén	1
296	18	Andrés Eloy Blanco	1
297	18	Andrés Mata	1
298	18	Arismendi	1
299	18	Benítez	1
300	18	Bermúdez	1
301	18	Bolívar	1
302	18	Cajigal	1
303	18	Cruz Salmerón Acosta	1
304	18	Libertador	1
305	18	Mariño	1
306	18	Mejía	1
307	18	Montes	1
308	18	Ribero	1
309	18	Sucre	1
310	18	Valdéz	1
341	19	Andrés Bello	1
342	19	Antonio Rómulo Costa	1
343	19	Ayacucho	1
344	19	Bolívar	1
345	19	Cárdenas	1
346	19	Córdoba	1
347	19	Fernández Feo	1
348	19	Francisco de Miranda	1
349	19	García de Hevia	1
350	19	Guásimos	1
351	19	Independencia	1
352	19	Jáuregui	1
353	19	José María Vargas	1
354	19	Junín	1
355	19	Libertad	1
356	19	Libertador	1
357	19	Lobatera	1
358	19	Michelena	1
359	19	Panamericano	1
360	19	Pedro María Ureña	1
361	19	Rafael Urdaneta	1
362	19	Samuel Darío Maldonado	1
363	19	San Cristóbal	1
364	19	Seboruco	1
365	19	Simón Rodríguez	1
366	19	Sucre	1
367	19	Torbes	1
368	19	Uribante	1
369	19	San Judas Tadeo	1
370	20	Andrés Bello	1
371	20	Boconó	1
372	20	Bolívar	1
373	20	Candelaria	1
374	20	Carache	1
375	20	Escuque	1
376	20	José Felipe Márquez Cañizalez	1
377	20	Juan Vicente Campos Elías	1
378	20	La Ceiba	1
379	20	Miranda	1
380	20	Monte Carmelo	1
381	20	Motatán	1
382	20	Pampán	1
383	20	Pampanito	1
384	20	Rafael Rangel	1
385	20	San Rafael de Carvajal	1
386	20	Sucre	1
387	20	Trujillo	1
388	20	Urdaneta	1
389	20	Valera	1
390	21	Vargas	1
391	22	Arístides Bastidas	1
392	22	Bolívar	1
407	22	Bruzual	1
408	22	Cocorote	1
409	22	Independencia	1
410	22	José Antonio Páez	1
411	22	La Trinidad	1
412	22	Manuel Monge	1
413	22	Nirgua	1
414	22	Peña	1
415	22	San Felipe	1
416	22	Sucre	1
417	22	Urachiche	1
418	22	José Joaquín Veroes	1
441	23	Almirante Padilla	1
442	23	Baralt	1
443	23	Cabimas	1
444	23	Catatumbo	1
445	23	Colón	1
446	23	Francisco Javier Pulgar	1
447	23	Páez	1
448	23	Jesús Enrique Losada	1
449	23	Jesús María Semprún	1
450	23	La Cañada de Urdaneta	1
451	23	Lagunillas	1
452	23	Machiques de Perijá	1
453	23	Mara	1
454	23	Maracaibo	1
455	23	Miranda	1
456	23	Rosario de Perijá	1
457	23	San Francisco	1
458	23	Santa Rita	1
459	23	Simón Bolívar	1
460	23	Sucre	1
461	23	Valmore Rodríguez	1
462	24	Libertador	1
\.


--
-- Name: t_municipio_id_municipio_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_municipio_id_municipio_seq', 1, false);


--
-- Data for Name: t_noticia; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_noticia (id_noticia, titulo, contenido, fecha_ini, fecha_fin, estatus) FROM stdin;
\.


--
-- Name: t_noticias_id_noticia_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_noticias_id_noticia_seq', 1, false);


--
-- Data for Name: t_operacion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_operacion (id_operacion, descripcion, id_icono, estatus) FROM stdin;
1	REGISTRAR	\N	1
2	EDITAR	\N	1
3	ACTIVAR/DESACTIVAR	\N	1
4	EXPORTAR/IMPRIMIR	\N	1
5	APROBAR	\N	1
6	RECHAZAR	\N	1
7	SOLICITAR	\N	1
\.


--
-- Name: t_operacion_id_operacion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_operacion_id_operacion_seq', 1, false);


--
-- Data for Name: t_organizacion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_organizacion (id_organizacion, razon_social, siglas, telefono, dir_fiscal, email, rif, nit, estatus) FROM stdin;
1	Caja de Ahorro y Préstamo de los Profesores del Instituto Universitario de Tecnología del Estado Portuguesa	CAPPIUTEP	02556144078	Avenida Circunvalación Sur, diagonal a la Cruz Roja, dentro de las instalaciones de la U.P.T.P. Acarigua, Estado Portuguesa.	cappiutep@hotmail.com	J301399188		1
\.


--
-- Data for Name: t_organizacion_cuenta; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_organizacion_cuenta (id_org_cuenta, id_org, id_banco, num_cuenta, tipo_cuenta, estatus) FROM stdin;
\.


--
-- Name: t_organizacion_cuenta_id_org_cuenta_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_organizacion_cuenta_id_org_cuenta_seq', 1, false);


--
-- Name: t_organizacion_id_organizacion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_organizacion_id_organizacion_seq', 1, true);


--
-- Data for Name: t_parroquia; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_parroquia (id_parroquia, id_municipio, parroquia, estatus) FROM stdin;
1	1	Alto Orinoco	1
2	1	Huachamacare Acanaña	1
3	1	Marawaka Toky Shamanaña	1
4	1	Mavaka Mavaka	1
5	1	Sierra Parima Parimabé	1
6	2	Ucata Laja Lisa	1
7	2	Yapacana Macuruco	1
8	2	Caname Guarinuma	1
9	3	Fernando Girón Tovar	1
10	3	Luis Alberto Gómez	1
11	3	Pahueña Limón de Parhueña	1
12	3	Platanillal Platanillal	1
13	4	Samariapo	1
14	4	Sipapo	1
15	4	Munduapo	1
16	4	Guayapo	1
17	5	Alto Ventuari	1
18	5	Medio Ventuari	1
19	5	Bajo Ventuari	1
20	6	Victorino	1
21	6	Comunidad	1
22	7	Casiquiare	1
23	7	Cocuy	1
24	7	San Carlos de Río Negro	1
25	7	Solano	1
26	8	Anaco	1
27	8	San Joaquín	1
28	9	Cachipo	1
29	9	Aragua de Barcelona	1
30	11	Lechería	1
31	11	El Morro	1
32	12	Puerto Píritu	1
33	12	San Miguel	1
34	12	Sucre	1
35	13	Valle de Guanape	1
36	13	Santa Bárbara	1
37	14	El Chaparro	1
38	14	Tomás Alfaro	1
39	14	Calatrava	1
40	15	Guanta	1
41	15	Chorrerón	1
42	16	Mamo	1
43	16	Soledad	1
44	17	Mapire	1
45	17	Piar	1
46	17	Santa Clara	1
47	17	San Diego de Cabrutica	1
48	17	Uverito	1
49	17	Zuata	1
50	18	Puerto La Cruz	1
51	18	Pozuelos	1
52	19	Onoto	1
53	19	San Pablo	1
54	20	San Mateo	1
55	20	El Carito	1
56	20	Santa Inés	1
57	20	La Romereña	1
58	21	Atapirire	1
59	21	Boca del Pao	1
60	21	El Pao	1
61	21	Pariaguán	1
62	22	Cantaura	1
63	22	Libertador	1
64	22	Santa Rosa	1
65	22	Urica	1
66	23	Píritu	1
67	23	San Francisco	1
68	24	San José de Guanipa	1
69	25	Boca de Uchire	1
70	25	Boca de Chávez	1
71	26	Pueblo Nuevo	1
72	26	Santa Ana	1
73	27	Bergatín	1
74	27	Caigua	1
75	27	El Carmen	1
76	27	El Pilar	1
77	27	Naricual	1
78	27	San Crsitóbal	1
79	28	Edmundo Barrios	1
80	28	Miguel Otero Silva	1
81	29	Achaguas	1
82	29	Apurito	1
83	29	El Yagual	1
84	29	Guachara	1
85	29	Mucuritas	1
86	29	Queseras del medio	1
87	30	Biruaca	1
88	31	Bruzual	1
89	31	Mantecal	1
90	31	Quintero	1
91	31	Rincón Hondo	1
92	31	San Vicente	1
93	32	Guasdualito	1
94	32	Aramendi	1
95	32	El Amparo	1
96	32	San Camilo	1
97	32	Urdaneta	1
98	33	San Juan de Payara	1
99	33	Codazzi	1
100	33	Cunaviche	1
101	34	Elorza	1
102	34	La Trinidad	1
103	35	San Fernando	1
104	35	El Recreo	1
105	35	Peñalver	1
106	35	San Rafael de Atamaica	1
107	36	Pedro José Ovalles	1
108	36	Joaquín Crespo	1
109	36	José Casanova Godoy	1
110	36	Madre María de San José	1
111	36	Andrés Eloy Blanco	1
112	36	Los Tacarigua	1
113	36	Las Delicias	1
114	36	Choroní	1
115	37	Bolívar	1
116	38	Camatagua	1
117	38	Carmen de Cura	1
118	39	Santa Rita	1
119	39	Francisco de Miranda	1
120	39	Moseñor Feliciano González	1
121	40	Santa Cruz	1
122	41	José Félix Ribas	1
123	41	Castor Nieves Ríos	1
124	41	Las Guacamayas	1
125	41	Pao de Zárate	1
126	41	Zuata	1
127	42	José Rafael Revenga	1
128	43	Palo Negro	1
129	43	San Martín de Porres	1
130	44	El Limón	1
131	44	Caña de Azúcar	1
132	45	Ocumare de la Costa	1
133	46	San Casimiro	1
134	46	Güiripa	1
135	46	Ollas de Caramacate	1
136	46	Valle Morín	1
137	47	San Sebastían	1
138	48	Turmero	1
139	48	Arevalo Aponte	1
140	48	Chuao	1
141	48	Samán de Güere	1
142	48	Alfredo Pacheco Miranda	1
143	49	Santos Michelena	1
144	49	Tiara	1
145	50	Cagua	1
146	50	Bella Vista	1
147	51	Tovar	1
148	52	Urdaneta	1
149	52	Las Peñitas	1
150	52	San Francisco de Cara	1
151	52	Taguay	1
152	53	Zamora	1
153	53	Magdaleno	1
154	53	San Francisco de Asís	1
155	53	Valles de Tucutunemo	1
156	53	Augusto Mijares	1
157	54	Sabaneta	1
158	54	Juan Antonio Rodríguez Domínguez	1
159	55	El Cantón	1
160	55	Santa Cruz de Guacas	1
161	55	Puerto Vivas	1
162	56	Ticoporo	1
163	56	Nicolás Pulido	1
164	56	Andrés Bello	1
165	57	Arismendi	1
166	57	Guadarrama	1
167	57	La Unión	1
168	57	San Antonio	1
169	58	Barinas	1
170	58	Alberto Arvelo Larriva	1
171	58	San Silvestre	1
172	58	Santa Inés	1
173	58	Santa Lucía	1
174	58	Torumos	1
175	58	El Carmen	1
176	58	Rómulo Betancourt	1
177	58	Corazón de Jesús	1
178	58	Ramón Ignacio Méndez	1
179	58	Alto Barinas	1
180	58	Manuel Palacio Fajardo	1
181	58	Juan Antonio Rodríguez Domínguez	1
182	58	Dominga Ortiz de Páez	1
183	59	Barinitas	1
184	59	Altamira de Cáceres	1
185	59	Calderas	1
186	60	Barrancas	1
187	60	El Socorro	1
188	60	Mazparrito	1
189	61	Santa Bárbara	1
190	61	Pedro Briceño Méndez	1
191	61	Ramón Ignacio Méndez	1
192	61	José Ignacio del Pumar	1
193	62	Obispos	1
194	62	Guasimitos	1
195	62	El Real	1
196	62	La Luz	1
197	63	Ciudad Bolívia	1
198	63	José Ignacio Briceño	1
199	63	José Félix Ribas	1
200	63	Páez	1
201	64	Libertad	1
202	64	Dolores	1
203	64	Santa Rosa	1
204	64	Palacio Fajardo	1
205	65	Ciudad de Nutrias	1
206	65	El Regalo	1
207	65	Puerto Nutrias	1
208	65	Santa Catalina	1
209	66	Cachamay	1
210	66	Chirica	1
211	66	Dalla Costa	1
212	66	Once de Abril	1
213	66	Simón Bolívar	1
214	66	Unare	1
215	66	Universidad	1
216	66	Vista al Sol	1
217	66	Pozo Verde	1
218	66	Yocoima	1
219	66	5 de Julio	1
220	67	Cedeño	1
221	67	Altagracia	1
222	67	Ascensión Farreras	1
223	67	Guaniamo	1
224	67	La Urbana	1
225	67	Pijiguaos	1
226	68	El Callao	1
227	69	Gran Sabana	1
228	69	Ikabarú	1
229	70	Catedral	1
230	70	Zea	1
231	70	Orinoco	1
232	70	José Antonio Páez	1
233	70	Marhuanta	1
234	70	Agua Salada	1
235	70	Vista Hermosa	1
236	70	La Sabanita	1
237	70	Panapana	1
238	71	Andrés Eloy Blanco	1
239	71	Pedro Cova	1
240	72	Raúl Leoni	1
241	72	Barceloneta	1
242	72	Santa Bárbara	1
243	72	San Francisco	1
244	73	Roscio	1
245	73	Salóm	1
246	74	Sifontes	1
247	74	Dalla Costa	1
248	74	San Isidro	1
249	75	Sucre	1
250	75	Aripao	1
251	75	Guarataro	1
252	75	Las Majadas	1
253	75	Moitaco	1
254	76	Padre Pedro Chien	1
255	76	Río Grande	1
256	77	Bejuma	1
257	77	Canoabo	1
258	77	Simón Bolívar	1
259	78	Güigüe	1
260	78	Carabobo	1
261	78	Tacarigua	1
262	79	Mariara	1
263	79	Aguas Calientes	1
264	80	Ciudad Alianza	1
265	80	Guacara	1
266	80	Yagua	1
267	81	Morón	1
268	81	Yagua	1
269	82	Tocuyito	1
270	82	Independencia	1
271	83	Los Guayos	1
272	84	Miranda	1
273	85	Montalbán	1
274	86	Naguanagua	1
275	87	Bartolomé Salóm	1
276	87	Democracia	1
277	87	Fraternidad	1
278	87	Goaigoaza	1
279	87	Juan José Flores	1
280	87	Unión	1
281	87	Borburata	1
282	87	Patanemo	1
283	88	San Diego	1
284	89	San Joaquín	1
285	90	Candelaria	1
286	90	Catedral	1
287	90	El Socorro	1
288	90	Miguel Peña	1
289	90	Rafael Urdaneta	1
290	90	San Blas	1
291	90	San José	1
292	90	Santa Rosa	1
293	90	Negro Primero	1
294	91	Cojedes	1
295	91	Juan de Mata Suárez	1
296	92	Tinaquillo	1
297	93	El Baúl	1
298	93	Sucre	1
299	94	La Aguadita	1
300	94	Macapo	1
301	95	El Pao	1
302	96	El Amparo	1
303	96	Libertad de Cojedes	1
304	97	Rómulo Gallegos	1
305	98	San Carlos de Austria	1
306	98	Juan Ángel Bravo	1
307	98	Manuel Manrique	1
308	99	General en Jefe José Laurencio Silva	1
309	100	Curiapo	1
310	100	Almirante Luis Brión	1
311	100	Francisco Aniceto Lugo	1
312	100	Manuel Renaud	1
313	100	Padre Barral	1
314	100	Santos de Abelgas	1
315	101	Imataca	1
316	101	Cinco de Julio	1
317	101	Juan Bautista Arismendi	1
318	101	Manuel Piar	1
319	101	Rómulo Gallegos	1
320	102	Pedernales	1
321	102	Luis Beltrán Prieto Figueroa	1
322	103	San José (Delta Amacuro)	1
323	103	José Vidal Marcano	1
324	103	Juan Millán	1
325	103	Leonardo Ruíz Pineda	1
326	103	Mariscal Antonio José de Sucre	1
327	103	Monseñor Argimiro García	1
328	103	San Rafael (Delta Amacuro)	1
329	103	Virgen del Valle	1
330	10	Clarines	1
331	10	Guanape	1
332	10	Sabana de Uchire	1
333	104	Capadare	1
334	104	La Pastora	1
335	104	Libertador	1
336	104	San Juan de los Cayos	1
337	105	Aracua	1
338	105	La Peña	1
339	105	San Luis	1
340	106	Bariro	1
341	106	Borojó	1
342	106	Capatárida	1
343	106	Guajiro	1
344	106	Seque	1
345	106	Zazárida	1
346	106	Valle de Eroa	1
347	107	Cacique Manaure	1
348	108	Norte	1
349	108	Carirubana	1
350	108	Santa Ana	1
351	108	Urbana Punta Cardón	1
352	109	La Vela de Coro	1
353	109	Acurigua	1
354	109	Guaibacoa	1
355	109	Las Calderas	1
356	109	Macoruca	1
357	110	Dabajuro	1
358	111	Agua Clara	1
359	111	Avaria	1
360	111	Pedregal	1
361	111	Piedra Grande	1
362	111	Purureche	1
363	112	Adaure	1
364	112	Adícora	1
365	112	Baraived	1
366	112	Buena Vista	1
367	112	Jadacaquiva	1
368	112	El Vínculo	1
369	112	El Hato	1
370	112	Moruy	1
371	112	Pueblo Nuevo	1
372	113	Agua Larga	1
373	113	El Paují	1
374	113	Independencia	1
375	113	Mapararí	1
376	114	Agua Linda	1
377	114	Araurima	1
378	114	Jacura	1
379	115	Tucacas	1
380	115	Boca de Aroa	1
381	116	Los Taques	1
382	116	Judibana	1
383	117	Mene de Mauroa	1
384	117	San Félix	1
385	117	Casigua	1
386	118	Guzmán Guillermo	1
387	118	Mitare	1
388	118	Río Seco	1
389	118	Sabaneta	1
390	118	San Antonio	1
391	118	San Gabriel	1
392	118	Santa Ana	1
393	119	Boca del Tocuyo	1
394	119	Chichiriviche	1
395	119	Tocuyo de la Costa	1
396	120	Palmasola	1
397	121	Cabure	1
398	121	Colina	1
399	121	Curimagua	1
400	122	San José de la Costa	1
401	122	Píritu	1
402	123	San Francisco	1
403	124	Sucre	1
404	124	Pecaya	1
405	125	Tocópero	1
406	126	El Charal	1
407	126	Las Vegas del Tuy	1
408	126	Santa Cruz de Bucaral	1
409	127	Bruzual	1
410	127	Urumaco	1
411	128	Puerto Cumarebo	1
412	128	La Ciénaga	1
413	128	La Soledad	1
414	128	Pueblo Cumarebo	1
415	128	Zazárida	1
416	113	Churuguara	1
417	129	Camaguán	1
418	129	Puerto Miranda	1
419	129	Uverito	1
420	130	Chaguaramas	1
421	131	El Socorro	1
422	132	Tucupido	1
423	132	San Rafael de Laya	1
424	133	Altagracia de Orituco	1
425	133	San Rafael de Orituco	1
426	133	San Francisco Javier de Lezama	1
427	133	Paso Real de Macaira	1
428	133	Carlos Soublette	1
429	133	San Francisco de Macaira	1
430	133	Libertad de Orituco	1
431	134	Cantaclaro	1
432	134	San Juan de los Morros	1
433	134	Parapara	1
434	135	El Sombrero	1
435	135	Sosa	1
436	136	Las Mercedes	1
437	136	Cabruta	1
438	136	Santa Rita de Manapire	1
439	137	Valle de la Pascua	1
440	137	Espino	1
441	138	San José de Unare	1
442	138	Zaraza	1
443	139	San José de Tiznados	1
444	139	San Francisco de Tiznados	1
445	139	San Lorenzo de Tiznados	1
446	139	Ortiz	1
447	140	Guayabal	1
448	140	Cazorla	1
449	141	San José de Guaribe	1
450	141	Uveral	1
451	142	Santa María de Ipire	1
452	142	Altamira	1
453	143	El Calvario	1
454	143	El Rastro	1
455	143	Guardatinajas	1
456	143	Capital Urbana Calabozo	1
457	144	Quebrada Honda de Guache	1
458	144	Pío Tamayo	1
459	144	Yacambú	1
460	145	Fréitez	1
461	145	José María Blanco	1
462	146	Catedral	1
463	146	Concepción	1
464	146	El Cují	1
465	146	Juan de Villegas	1
466	146	Santa Rosa	1
467	146	Tamaca	1
468	146	Unión	1
469	146	Aguedo Felipe Alvarado	1
470	146	Buena Vista	1
471	146	Juárez	1
472	147	Juan Bautista Rodríguez	1
473	147	Cuara	1
474	147	Diego de Lozada	1
475	147	Paraíso de San José	1
476	147	San Miguel	1
477	147	Tintorero	1
478	147	José Bernardo Dorante	1
479	147	Coronel Mariano Peraza 	1
480	148	Bolívar	1
481	148	Anzoátegui	1
482	148	Guarico	1
483	148	Hilario Luna y Luna	1
484	148	Humocaro Alto	1
485	148	Humocaro Bajo	1
486	148	La Candelaria	1
487	148	Morán	1
488	149	Cabudare	1
489	149	José Gregorio Bastidas	1
490	149	Agua Viva	1
491	150	Sarare	1
492	150	Buría	1
493	150	Gustavo Vegas León	1
494	151	Trinidad Samuel	1
495	151	Antonio Díaz	1
496	151	Camacaro	1
497	151	Castañeda	1
498	151	Cecilio Zubillaga	1
499	151	Chiquinquirá	1
500	151	El Blanco	1
501	151	Espinoza de los Monteros	1
502	151	Lara	1
503	151	Las Mercedes	1
504	151	Manuel Morillo	1
505	151	Montaña Verde	1
506	151	Montes de Oca	1
507	151	Torres	1
508	151	Heriberto Arroyo	1
509	151	Reyes Vargas	1
510	151	Altagracia	1
511	152	Siquisique	1
512	152	Moroturo	1
513	152	San Miguel	1
514	152	Xaguas	1
515	179	Presidente Betancourt	1
516	179	Presidente Páez	1
517	179	Presidente Rómulo Gallegos	1
518	179	Gabriel Picón González	1
519	179	Héctor Amable Mora	1
520	179	José Nucete Sardi	1
521	179	Pulido Méndez	1
522	180	La Azulita	1
523	181	Santa Cruz de Mora	1
524	181	Mesa Bolívar	1
525	181	Mesa de Las Palmas	1
526	182	Aricagua	1
527	182	San Antonio	1
528	183	Canagua	1
529	183	Capurí	1
530	183	Chacantá	1
531	183	El Molino	1
532	183	Guaimaral	1
533	183	Mucutuy	1
534	183	Mucuchachí	1
535	184	Fernández Peña	1
536	184	Matriz	1
537	184	Montalbán	1
538	184	Acequias	1
539	184	Jají	1
540	184	La Mesa	1
541	184	San José del Sur	1
542	185	Tucaní	1
543	185	Florencio Ramírez	1
544	186	Santo Domingo	1
545	186	Las Piedras	1
546	187	Guaraque	1
547	187	Mesa de Quintero	1
548	187	Río Negro	1
549	188	Arapuey	1
550	188	Palmira	1
551	189	San Cristóbal de Torondoy	1
552	189	Torondoy	1
553	190	Antonio Spinetti Dini	1
554	190	Arias	1
555	190	Caracciolo Parra Pérez	1
556	190	Domingo Peña	1
557	190	El Llano	1
558	190	Gonzalo Picón Febres	1
559	190	Jacinto Plaza	1
560	190	Juan Rodríguez Suárez	1
561	190	Lasso de la Vega	1
562	190	Mariano Picón Salas	1
563	190	Milla	1
564	190	Osuna Rodríguez	1
565	190	Sagrario	1
566	190	El Morro	1
567	190	Los Nevados	1
568	191	Andrés Eloy Blanco	1
569	191	La Venta	1
570	191	Piñango	1
571	191	Timotes	1
572	192	Eloy Paredes	1
573	192	San Rafael de Alcázar	1
574	192	Santa Elena de Arenales	1
575	193	Santa María de Caparo	1
576	194	Pueblo Llano	1
577	195	Cacute	1
578	195	La Toma	1
579	195	Mucuchíes	1
580	195	Mucurubá	1
581	195	San Rafael	1
582	196	Gerónimo Maldonado	1
583	196	Bailadores	1
584	197	Tabay	1
585	198	Chiguará	1
586	198	Estánquez	1
587	198	Lagunillas	1
588	198	La Trampa	1
589	198	Pueblo Nuevo del Sur	1
590	198	San Juan	1
591	199	El Amparo	1
592	199	El Llano	1
593	199	San Francisco	1
594	199	Tovar	1
595	200	Independencia	1
596	200	María de la Concepción Palacios Blanco	1
597	200	Nueva Bolivia	1
598	200	Santa Apolonia	1
599	201	Caño El Tigre	1
600	201	Zea	1
601	223	Aragüita	1
602	223	Arévalo González	1
603	223	Capaya	1
604	223	Caucagua	1
605	223	Panaquire	1
606	223	Ribas	1
607	223	El Café	1
608	223	Marizapa	1
609	224	Cumbo	1
610	224	San José de Barlovento	1
611	225	El Cafetal	1
612	225	Las Minas	1
613	225	Nuestra Señora del Rosario	1
614	226	Higuerote	1
615	226	Curiepe	1
616	226	Tacarigua de Brión	1
617	227	Mamporal	1
618	228	Carrizal	1
619	229	Chacao	1
620	230	Charallave	1
621	230	Las Brisas	1
622	231	El Hatillo	1
623	232	Altagracia de la Montaña	1
624	232	Cecilio Acosta	1
625	232	Los Teques	1
626	232	El Jarillo	1
627	232	San Pedro	1
628	232	Tácata	1
629	232	Paracotos	1
630	233	Cartanal	1
631	233	Santa Teresa del Tuy	1
632	234	La Democracia	1
633	234	Ocumare del Tuy	1
634	234	Santa Bárbara	1
635	235	San Antonio de los Altos	1
636	236	Río Chico	1
637	236	El Guapo	1
638	236	Tacarigua de la Laguna	1
639	236	Paparo	1
640	236	San Fernando del Guapo	1
641	237	Santa Lucía del Tuy	1
642	238	Cúpira	1
643	238	Machurucuto	1
644	239	Guarenas	1
645	240	San Antonio de Yare	1
646	240	San Francisco de Yare	1
647	241	Leoncio Martínez	1
648	241	Petare	1
649	241	Caucagüita	1
650	241	Filas de Mariche	1
651	241	La Dolorita	1
652	242	Cúa	1
653	242	Nueva Cúa	1
654	243	Guatire	1
655	243	Bolívar	1
656	258	San Antonio de Maturín	1
657	258	San Francisco de Maturín	1
658	259	Aguasay	1
659	260	Caripito	1
660	261	El Guácharo	1
661	261	La Guanota	1
662	261	Sabana de Piedra	1
663	261	San Agustín	1
664	261	Teresen	1
665	261	Caripe	1
666	262	Areo	1
667	262	Capital Cedeño	1
668	262	San Félix de Cantalicio	1
669	262	Viento Fresco	1
670	263	El Tejero	1
671	263	Punta de Mata	1
672	264	Chaguaramas	1
673	264	Las Alhuacas	1
674	264	Tabasca	1
675	264	Temblador	1
676	265	Alto de los Godos	1
677	265	Boquerón	1
678	265	Las Cocuizas	1
679	265	La Cruz	1
680	265	San Simón	1
681	265	El Corozo	1
682	265	El Furrial	1
683	265	Jusepín	1
684	265	La Pica	1
685	265	San Vicente	1
686	266	Aparicio	1
687	266	Aragua de Maturín	1
688	266	Chaguamal	1
689	266	El Pinto	1
690	266	Guanaguana	1
691	266	La Toscana	1
692	266	Taguaya	1
693	267	Cachipo	1
694	267	Quiriquire	1
695	268	Santa Bárbara	1
696	269	Barrancas	1
697	269	Los Barrancos de Fajardo	1
698	270	Uracoa	1
699	271	Antolín del Campo	1
700	272	Arismendi	1
701	273	García	1
702	273	Francisco Fajardo	1
703	274	Bolívar	1
704	274	Guevara	1
705	274	Matasiete	1
706	274	Santa Ana	1
707	274	Sucre	1
708	275	Aguirre	1
709	275	Maneiro	1
710	276	Adrián	1
711	276	Juan Griego	1
712	276	Yaguaraparo	1
713	277	Porlamar	1
714	278	San Francisco de Macanao	1
715	278	Boca de Río	1
716	279	Tubores	1
717	279	Los Baleales	1
718	280	Vicente Fuentes	1
719	280	Villalba	1
720	281	San Juan Bautista	1
721	281	Zabala	1
722	283	Capital Araure	1
723	283	Río Acarigua	1
724	284	Capital Esteller	1
725	284	Uveral	1
726	285	Guanare	1
727	285	Córdoba	1
728	285	San José de la Montaña	1
729	285	San Juan de Guanaguanare	1
730	285	Virgen de la Coromoto	1
731	286	Guanarito	1
732	286	Trinidad de la Capilla	1
733	286	Divina Pastora	1
734	287	Monseñor José Vicente de Unda	1
735	287	Peña Blanca	1
736	288	Capital Ospino	1
737	288	Aparición	1
738	288	La Estación	1
739	289	Páez	1
740	289	Payara	1
741	289	Pimpinela	1
742	289	Ramón Peraza	1
743	290	Papelón	1
744	290	Caño Delgadito	1
745	291	San Genaro de Boconoito	1
746	291	Antolín Tovar	1
747	292	San Rafael de Onoto	1
748	292	Santa Fe	1
749	292	Thermo Morles	1
750	293	Santa Rosalía	1
751	293	Florida	1
752	294	Sucre	1
753	294	Concepción	1
754	294	San Rafael de Palo Alzado	1
755	294	Uvencio Antonio Velásquez	1
756	294	San José de Saguaz	1
757	294	Villa Rosa	1
758	295	Turén	1
759	295	Canelones	1
760	295	Santa Cruz	1
761	295	San Isidro Labrador	1
762	296	Mariño	1
763	296	Rómulo Gallegos	1
764	297	San José de Aerocuar	1
765	297	Tavera Acosta	1
766	298	Río Caribe	1
767	298	Antonio José de Sucre	1
768	298	El Morro de Puerto Santo	1
769	298	Puerto Santo	1
770	298	San Juan de las Galdonas	1
771	299	El Pilar	1
772	299	El Rincón	1
773	299	General Francisco Antonio Váquez	1
774	299	Guaraúnos	1
775	299	Tunapuicito	1
776	299	Unión	1
777	300	Santa Catalina	1
778	300	Santa Rosa	1
779	300	Santa Teresa	1
780	300	Bolívar	1
781	300	Maracapana	1
782	302	Libertad	1
783	302	El Paujil	1
784	302	Yaguaraparo	1
785	303	Cruz Salmerón Acosta	1
786	303	Chacopata	1
787	303	Manicuare	1
788	304	Tunapuy	1
789	304	Campo Elías	1
790	305	Irapa	1
791	305	Campo Claro	1
792	305	Maraval	1
793	305	San Antonio de Irapa	1
794	305	Soro	1
795	306	Mejía	1
796	307	Cumanacoa	1
797	307	Arenas	1
798	307	Aricagua	1
799	307	Cogollar	1
800	307	San Fernando	1
801	307	San Lorenzo	1
802	308	Villa Frontado (Muelle de Cariaco)	1
803	308	Catuaro	1
804	308	Rendón	1
805	308	San Cruz	1
806	308	Santa María	1
807	309	Altagracia	1
808	309	Santa Inés	1
809	309	Valentín Valiente	1
810	309	Ayacucho	1
811	309	San Juan	1
812	309	Raúl Leoni	1
813	309	Gran Mariscal	1
814	310	Cristóbal Colón	1
815	310	Bideau	1
816	310	Punta de Piedras	1
817	310	Güiria	1
818	341	Andrés Bello	1
819	342	Antonio Rómulo Costa	1
820	343	Ayacucho	1
821	343	Rivas Berti	1
822	343	San Pedro del Río	1
823	344	Bolívar	1
824	344	Palotal	1
825	344	General Juan Vicente Gómez	1
826	344	Isaías Medina Angarita	1
827	345	Cárdenas	1
828	345	Amenodoro Ángel Lamus	1
829	345	La Florida	1
830	346	Córdoba	1
831	347	Fernández Feo	1
832	347	Alberto Adriani	1
833	347	Santo Domingo	1
834	348	Francisco de Miranda	1
835	349	García de Hevia	1
836	349	Boca de Grita	1
837	349	José Antonio Páez	1
838	350	Guásimos	1
839	351	Independencia	1
840	351	Juan Germán Roscio	1
841	351	Román Cárdenas	1
842	352	Jáuregui	1
843	352	Emilio Constantino Guerrero	1
844	352	Monseñor Miguel Antonio Salas	1
845	353	José María Vargas	1
846	354	Junín	1
847	354	La Petrólea	1
848	354	Quinimarí	1
849	354	Bramón	1
850	355	Libertad	1
851	355	Cipriano Castro	1
852	355	Manuel Felipe Rugeles	1
853	356	Libertador	1
854	356	Doradas	1
855	356	Emeterio Ochoa	1
856	356	San Joaquín de Navay	1
857	357	Lobatera	1
858	357	Constitución	1
859	358	Michelena	1
860	359	Panamericano	1
861	359	La Palmita	1
862	360	Pedro María Ureña	1
863	360	Nueva Arcadia	1
864	361	Delicias	1
865	361	Pecaya	1
866	362	Samuel Darío Maldonado	1
867	362	Boconó	1
868	362	Hernández	1
869	363	La Concordia	1
870	363	San Juan Bautista	1
871	363	Pedro María Morantes	1
872	363	San Sebastián	1
873	363	Dr. Francisco Romero Lobo	1
874	364	Seboruco	1
875	365	Simón Rodríguez	1
876	366	Sucre	1
877	366	Eleazar López Contreras	1
878	366	San Pablo	1
879	367	Torbes	1
880	368	Uribante	1
881	368	Cárdenas	1
882	368	Juan Pablo Peñalosa	1
883	368	Potosí	1
884	369	San Judas Tadeo	1
885	370	Araguaney	1
886	370	El Jaguito	1
887	370	La Esperanza	1
888	370	Santa Isabel	1
889	371	Boconó	1
890	371	El Carmen	1
891	371	Mosquey	1
892	371	Ayacucho	1
893	371	Burbusay	1
894	371	General Ribas	1
895	371	Guaramacal	1
896	371	Vega de Guaramacal	1
897	371	Monseñor Jáuregui	1
898	371	Rafael Rangel	1
899	371	San Miguel	1
900	371	San José	1
901	372	Sabana Grande	1
902	372	Cheregüé	1
903	372	Granados	1
904	373	Arnoldo Gabaldón	1
905	373	Bolivia	1
906	373	Carrillo	1
907	373	Cegarra	1
908	373	Chejendé	1
909	373	Manuel Salvador Ulloa	1
910	373	San José	1
911	374	Carache	1
912	374	La Concepción	1
913	374	Cuicas	1
914	374	Panamericana	1
915	374	Santa Cruz	1
916	375	Escuque	1
917	375	La Unión	1
918	375	Santa Rita	1
919	375	Sabana Libre	1
920	376	El Socorro	1
921	376	Los Caprichos	1
922	376	Antonio José de Sucre	1
923	377	Campo Elías	1
924	377	Arnoldo Gabaldón	1
925	378	Santa Apolonia	1
926	378	El Progreso	1
927	378	La Ceiba	1
928	378	Tres de Febrero	1
929	379	El Dividive	1
930	379	Agua Santa	1
931	379	Agua Caliente	1
932	379	El Cenizo	1
933	379	Valerita	1
934	380	Monte Carmelo	1
935	380	Buena Vista	1
936	380	Santa María del Horcón	1
937	381	Motatán	1
938	381	El Baño	1
939	381	Jalisco	1
940	382	Pampán	1
941	382	Flor de Patria	1
942	382	La Paz	1
943	382	Santa Ana	1
944	383	Pampanito	1
945	383	La Concepción	1
946	383	Pampanito II	1
947	384	Betijoque	1
948	384	José Gregorio Hernández	1
949	384	La Pueblita	1
950	384	Los Cedros	1
951	385	Carvajal	1
952	385	Campo Alegre	1
953	385	Antonio Nicolás Briceño	1
954	385	José Leonardo Suárez	1
955	386	Sabana de Mendoza	1
956	386	Junín	1
957	386	Valmore Rodríguez	1
958	386	El Paraíso	1
959	387	Andrés Linares	1
960	387	Chiquinquirá	1
961	387	Cristóbal Mendoza	1
962	387	Cruz Carrillo	1
963	387	Matriz	1
964	387	Monseñor Carrillo	1
965	387	Tres Esquinas	1
966	388	Cabimbú	1
967	388	Jajó	1
968	388	La Mesa de Esnujaque	1
969	388	Santiago	1
970	388	Tuñame	1
971	388	La Quebrada	1
972	389	Juan Ignacio Montilla	1
973	389	La Beatriz	1
974	389	La Puerta	1
975	389	Mendoza del Valle de Momboy	1
976	389	Mercedes Díaz	1
977	389	San Luis	1
978	390	Caraballeda	1
979	390	Carayaca	1
980	390	Carlos Soublette	1
981	390	Caruao Chuspa	1
982	390	Catia La Mar	1
983	390	El Junko	1
984	390	La Guaira	1
985	390	Macuto	1
986	390	Maiquetía	1
987	390	Naiguatá	1
988	390	Urimare	1
989	391	Arístides Bastidas	1
990	392	Bolívar	1
991	407	Chivacoa	1
992	407	Campo Elías	1
993	408	Cocorote	1
994	409	Independencia	1
995	410	José Antonio Páez	1
996	411	La Trinidad	1
997	412	Manuel Monge	1
998	413	Salóm	1
999	413	Temerla	1
1000	413	Nirgua	1
1001	414	San Andrés	1
1002	414	Yaritagua	1
1003	415	San Javier	1
1004	415	Albarico	1
1005	415	San Felipe	1
1006	416	Sucre	1
1007	417	Urachiche	1
1008	418	El Guayabo	1
1009	418	Farriar	1
1010	441	Isla de Toas	1
1011	441	Monagas	1
1012	442	San Timoteo	1
1013	442	General Urdaneta	1
1014	442	Libertador	1
1015	442	Marcelino Briceño	1
1016	442	Pueblo Nuevo	1
1017	442	Manuel Guanipa Matos	1
1018	443	Ambrosio	1
1019	443	Carmen Herrera	1
1020	443	La Rosa	1
1021	443	Germán Ríos Linares	1
1022	443	San Benito	1
1023	443	Rómulo Betancourt	1
1024	443	Jorge Hernández	1
1025	443	Punta Gorda	1
1026	443	Arístides Calvani	1
1027	444	Encontrados	1
1028	444	Udón Pérez	1
1029	445	Moralito	1
1030	445	San Carlos del Zulia	1
1031	445	Santa Cruz del Zulia	1
1032	445	Santa Bárbara	1
1033	445	Urribarrí	1
1034	446	Carlos Quevedo	1
1035	446	Francisco Javier Pulgar	1
1036	446	Simón Rodríguez	1
1037	446	Guamo-Gavilanes	1
1038	448	La Concepción	1
1039	448	San José	1
1040	448	Mariano Parra León	1
1041	448	José Ramón Yépez	1
1042	449	Jesús María Semprún	1
1043	449	Barí	1
1044	450	Concepción	1
1045	450	Andrés Bello	1
1046	450	Chiquinquirá	1
1047	450	El Carmelo	1
1048	450	Potreritos	1
1049	451	Libertad	1
1050	451	Alonso de Ojeda	1
1051	451	Venezuela	1
1052	451	Eleazar López Contreras	1
1053	451	Campo Lara	1
1054	452	Bartolomé de las Casas	1
1055	452	Libertad	1
1056	452	Río Negro	1
1057	452	San José de Perijá	1
1058	453	San Rafael	1
1059	453	La Sierrita	1
1060	453	Las Parcelas	1
1061	453	Luis de Vicente	1
1062	453	Monseñor Marcos Sergio Godoy	1
1063	453	Ricaurte	1
1064	453	Tamare	1
1065	454	Antonio Borjas Romero	1
1066	454	Bolívar	1
1067	454	Cacique Mara	1
1068	454	Carracciolo Parra Pérez	1
1069	454	Cecilio Acosta	1
1070	454	Cristo de Aranza	1
1071	454	Coquivacoa	1
1072	454	Chiquinquirá	1
1073	454	Francisco Eugenio Bustamante	1
1074	454	Idelfonzo Vásquez	1
1075	454	Juana de Ávila	1
1076	454	Luis Hurtado Higuera	1
1077	454	Manuel Dagnino	1
1078	454	Olegario Villalobos	1
1079	454	Raúl Leoni	1
1080	454	Santa Lucía	1
1081	454	Venancio Pulgar	1
1082	454	San Isidro	1
1083	455	Altagracia	1
1084	455	Faría	1
1085	455	Ana María Campos	1
1086	455	San Antonio	1
1087	455	San José	1
1088	456	Donaldo García	1
1089	456	El Rosario	1
1090	456	Sixto Zambrano	1
1091	457	San Francisco	1
1092	457	El Bajo	1
1093	457	Domitila Flores	1
1094	457	Francisco Ochoa	1
1095	457	Los Cortijos	1
1096	457	Marcial Hernández	1
1097	458	Santa Rita	1
1098	458	El Mene	1
1099	458	Pedro Lucas Urribarrí	1
1100	458	José Cenobio Urribarrí	1
1101	459	Rafael Maria Baralt	1
1102	459	Manuel Manrique	1
1103	459	Rafael Urdaneta	1
1104	460	Bobures	1
1105	460	Gibraltar	1
1106	460	Heras	1
1107	460	Monseñor Arturo Álvarez	1
1108	460	Rómulo Gallegos	1
1109	460	El Batey	1
1110	461	Rafael Urdaneta	1
1111	461	La Victoria	1
1112	461	Raúl Cuenca	1
1113	447	Sinamaica	1
1114	447	Alta Guajira	1
1115	447	Elías Sánchez Rubio	1
1116	447	Guajira	1
1117	462	Altagracia	1
1118	462	Antímano	1
1119	462	Caricuao	1
1120	462	Catedral	1
1121	462	Coche	1
1122	462	El Junquito	1
1123	462	El Paraíso	1
1124	462	El Recreo	1
1125	462	El Valle	1
1126	462	La Candelaria	1
1127	462	La Pastora	1
1128	462	La Vega	1
1129	462	Macarao	1
1130	462	San Agustín	1
1131	462	San Bernardino	1
1132	462	San José	1
1133	462	San Juan	1
1134	462	San Pedro	1
1135	462	Santa Rosalía	1
1136	462	Santa Teresa	1
1137	462	Sucre (Catia)	1
1138	462	23 de enero	1
\.


--
-- Name: t_parroquia_id_parroquia_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_parroquia_id_parroquia_seq', 1, false);


--
-- Data for Name: t_periodo; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_periodo (id_periodo, fecha_ini, fecha_fin, estatus) FROM stdin;
1	2016-01-01	2016-01-31	0
2	2016-02-01	2016-02-29	0
3	2016-03-01	2016-03-31	0
4	2016-04-01	\N	1
\.


--
-- Name: t_periodo_id_periodo_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_periodo_id_periodo_seq', 4, true);


--
-- Data for Name: t_persona; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_persona (id_persona, nacionalidad, cedula, nombre1, nombre2, apellido1, apellido2, fecha_nacimiento, sexo, direccion, estado_civil, cod_telf_movil, telf_movil, cod_tel_oficina, telf_oficina, cod_telf_fijo, telf_fijo, id_condicion, id_sede, email, id_ciudad, id_parroquia, estatus, tipo_docente, categ_docente, dedic_docente, salario, fecha_ini_docente) FROM stdin;
1	V	21560435	Saul	Alexander	Martinez	Montañez	1992-05-15	\N	Frente a malariologia	\N	0424	5468942	\N	\N			149	7	saul.alexander522@gmail.com	\N	739	1	162			\N	\N
2	V	20810360	Edgar		Sarzalejo		1991-12-16	\N	Frente a Llano Mall	\N	0414	5586097	\N	\N			149	7	edgar.dsh@gmail.com	\N	739	1	161	171	165	\N	2010-09-14
3	V	25697165	Eduardo	Eldalnes	Bigott		1985-03-29	\N	Villas del Pilar o a veces en la Goajira	\N	0424	5737806	\N	\N			149	7	eduardo.bigott@gmail.com	\N	722	1	162			\N	1970-01-01
4	V	24243750	Richard		Noguera		1993-04-20	\N	Apartaderos	\N			\N	\N			149	7	richardnoguera4@gmail.com	\N	294	1	160	169	164	\N	2011-04-01
5	V	20640235	Genesis		García		1991-10-09	\N	Araure-Acarigua	\N			\N	\N			149	7	genesis.bigott@gmail.com	\N	722	1	162			\N	1970-01-01
6	V	1234567	Jesus		Fernandez		1959-03-12	\N	Av. 25 con calle 12	\N	0424	5572143	\N	\N			149	7	jesus@tmail.com	\N	739	1	160	171	166	15000	2016-03-09
\.


--
-- Data for Name: t_persona_aporte; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_persona_aporte (id_aporte, id_persona, monto, fecha, estatus) FROM stdin;
\.


--
-- Name: t_persona_aporte_id_aporte_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_persona_aporte_id_aporte_seq', 1, false);


--
-- Data for Name: t_persona_caja; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_persona_caja (id_persona_caja, id_persona, id_cargo_caja, fecha_ini, fecha_fin, condicion, estatus, id_motivo_razon, observacion) FROM stdin;
6	2	1	2015-04-29	\N	0	\N	\N	\N
15	6	1	2016-05-05	\N	0	\N	\N	\N
9	5	2	2016-04-29	\N	0	\N	\N	\N
8	4	5	2016-04-29	\N	0	\N	\N	\N
7	3	3	2016-04-29	\N	0	\N	\N	\N
5	1	1	2015-01-01	\N	0	\N	\N	\N
\.


--
-- Name: t_persona_caja_id_persona_caja_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_persona_caja_id_persona_caja_seq', 15, true);


--
-- Data for Name: t_persona_cuenta_banco; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_persona_cuenta_banco (id_cuenta_banco, id_persona, id_banco, num_cuenta, tipo_cuenta, estatus) FROM stdin;
\.


--
-- Name: t_persona_cuenta_banco_id_cuenta_banco_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_persona_cuenta_banco_id_cuenta_banco_seq', 1, false);


--
-- Name: t_persona_id_persona_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_persona_id_persona_seq', 4, true);


--
-- Data for Name: t_proceso_caja_ahorro; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_proceso_caja_ahorro (id_proceso, nombre, estatus) FROM stdin;
\.


--
-- Name: t_proceso_caja_ahorro_id_proceso_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_proceso_caja_ahorro_id_proceso_seq', 1, false);


--
-- Data for Name: t_reporte; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_reporte (id_reporte, descripcion, estatus, url) FROM stdin;
\.


--
-- Name: t_reporte_id_reporte_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_reporte_id_reporte_seq', 1, false);


--
-- Data for Name: t_reporte_usuario; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_reporte_usuario (id_reporte_usuario, id_reporte, id_usuario) FROM stdin;
\.


--
-- Data for Name: t_servicio; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_servicio (id_servicio, id_modulo, descripcion, id_tipo_vista, id_icono, estatus, url, posicion) FROM stdin;
16	2	Sistema	4	43	1	ConfigSistema.php	\N
12	1	Socios y Personal	1	127	1	AdminSocios.php	\N
21	2	Usuarios	2	127	1	ConfigUsuarios.php	\N
24	2	Definición de Roles	4	127	1	ConfigRoles.php	\N
8	1	Gestión de Solicitudes	7	290	1	SolicitudGestion.php	\N
22	5	Acceso	5	103	1	BitacoraAcceso.php	\N
14	1	Anuncios	1	111	1	Anuncios.php	\N
2	3	Beneficiarios	2	127	1	SocioBeneficiarios.php	\N
20	2	Estructura Geográfica	2	33	1	ConfigEstado.php	\N
6	4	Financiamientos	3	44	1	Financiamientos.php	\N
3	3	Haberes	5	59	1	Haberes.php	\N
19	2	Listas y Combos	1	400	1	ConfigLista.php	\N
1	3	Mis Datos	4	126	1	MisDatos.php	\N
17	2	Módulos	1	190	1	ConfigModulo.php	\N
23	5	Operaciones	5	103	1	BitacoraOperaciones.php	\N
4	3	Perfil de Usuario	4	126	1	UsuarioPerfil.php	\N
11	1	Períodos	1	8	1	Periodos.php	\N
5	4	Préstamos	3	170	1	Prestamos.php	\N
10	1	Reglas de Negocio	4	154	1	ConfigOrganizacionReglas.php	\N
7	4	Retiros	3	72	1	Retiros.php	\N
18	2	Servicios	1	191	1	ConfigServicio.php	\N
13	1	Beneficios	1	256	1	ConfigBeneficio.php	\N
15	2	Cargos de la Caja de Ahorros	1	94	1	ConfigCargosCajaAhorro.php	\N
9	2	Organización	4	346	1	ConfigOrganizacion.php	\N
25	2	Carga de Datos	4	106	1	ConfigCargaMasiva.php	\N
\.


--
-- Data for Name: t_servicio_operacion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_servicio_operacion (id_servicio_operacion, id_servicio, id_operacion, id_usuario, fecha_ini, fecha_fin) FROM stdin;
290	24	2	2	\N	\N
296	19	2	2	\N	\N
298	19	4	2	\N	\N
300	17	2	2	\N	\N
302	17	3	2	\N	\N
304	18	2	2	\N	\N
306	18	4	2	\N	\N
308	1	2	2	\N	\N
396	1	2	5	\N	\N
397	3	4	5	\N	\N
398	4	2	5	\N	\N
399	5	4	5	\N	\N
400	5	7	5	\N	\N
401	6	4	5	\N	\N
402	6	7	5	\N	\N
403	7	4	5	\N	\N
404	7	7	5	\N	\N
405	8	6	5	\N	\N
406	8	5	5	\N	\N
407	8	4	5	\N	\N
408	9	2	5	\N	\N
409	10	2	5	\N	\N
414	12	1	5	\N	\N
415	12	2	5	\N	\N
416	12	3	5	\N	\N
417	12	4	5	\N	\N
418	13	1	5	\N	\N
419	13	2	5	\N	\N
387	1	2	6	\N	\N
388	3	4	6	\N	\N
390	5	4	6	\N	\N
391	5	7	6	\N	\N
392	6	4	6	\N	\N
393	6	7	6	\N	\N
394	7	4	6	\N	\N
395	7	7	6	\N	\N
420	13	3	5	\N	\N
421	13	4	5	\N	\N
456	1	2	4	\N	\N
457	3	4	4	\N	\N
459	5	4	4	\N	\N
460	5	7	4	\N	\N
461	6	4	4	\N	\N
462	6	7	4	\N	\N
463	7	4	4	\N	\N
464	7	7	4	\N	\N
465	8	6	4	\N	\N
466	8	5	4	\N	\N
467	8	4	4	\N	\N
468	9	2	4	\N	\N
469	10	2	4	\N	\N
470	11	4	4	\N	\N
471	11	1	4	\N	\N
472	11	2	4	\N	\N
473	11	3	4	\N	\N
474	12	1	4	\N	\N
475	12	2	4	\N	\N
476	12	3	4	\N	\N
477	12	4	4	\N	\N
478	13	1	4	\N	\N
479	13	2	4	\N	\N
480	13	3	4	\N	\N
481	13	4	4	\N	\N
482	14	1	4	\N	\N
483	14	2	4	\N	\N
484	14	3	4	\N	\N
485	14	4	4	\N	\N
252	12	1	2	\N	\N
253	12	2	2	\N	\N
254	12	3	2	\N	\N
255	12	4	2	\N	\N
256	8	4	2	\N	\N
257	8	5	2	\N	\N
258	8	6	2	\N	\N
263	13	1	2	\N	\N
264	13	2	2	\N	\N
265	13	3	2	\N	\N
266	13	4	2	\N	\N
267	15	1	2	\N	\N
268	15	2	2	\N	\N
269	15	3	2	\N	\N
270	15	4	2	\N	\N
271	9	2	2	\N	\N
276	10	2	2	\N	\N
277	6	4	2	\N	\N
278	6	7	2	\N	\N
279	5	7	2	\N	\N
280	5	4	2	\N	\N
281	7	4	2	\N	\N
282	7	7	2	\N	\N
283	22	4	2	\N	\N
285	16	2	2	\N	\N
295	19	1	2	\N	\N
297	19	3	2	\N	\N
299	17	1	2	\N	\N
301	17	4	2	\N	\N
303	18	1	2	\N	\N
305	18	3	2	\N	\N
307	3	4	2	\N	\N
486	1	2	3	\N	\N
487	3	4	3	\N	\N
488	4	2	3	\N	\N
489	5	4	3	\N	\N
490	5	7	3	\N	\N
491	6	4	3	\N	\N
492	6	7	3	\N	\N
493	7	4	3	\N	\N
494	7	7	3	\N	\N
495	8	6	3	\N	\N
496	8	5	3	\N	\N
497	8	4	3	\N	\N
498	9	2	3	\N	\N
499	10	2	3	\N	\N
508	13	1	3	\N	\N
509	13	2	3	\N	\N
510	13	3	3	\N	\N
511	13	4	3	\N	\N
516	1	2	1	\N	\N
517	3	4	1	\N	\N
519	5	4	1	\N	\N
520	5	7	1	\N	\N
521	6	4	1	\N	\N
522	6	7	1	\N	\N
523	7	4	1	\N	\N
524	7	7	1	\N	\N
525	12	1	3	\N	\N
526	12	2	3	\N	\N
527	12	3	3	\N	\N
528	12	4	3	\N	\N
529	25	2	2	\N	\N
\.


--
-- Name: t_servicio_operacion_id_servicio_operacion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_servicio_operacion_id_servicio_operacion_seq', 529, true);


--
-- Name: t_servicio_posicion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_servicio_posicion_seq', 23, true);


--
-- Data for Name: t_solicitud_amortiza; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_solicitud_amortiza (id_solicitud_amortiza, id_solicitud, monto, id_concepto, forma_pago, ref_pago, fecha_pago, id_motivo_razon, observacion, amort_fecha_lim_min, amort_fecha_lim_max, id_cuenta, estatus) FROM stdin;
\.


--
-- Name: t_solicitud_amortiza_id_solicitud_amortiza_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_solicitud_amortiza_id_solicitud_amortiza_seq', 1, false);


--
-- Data for Name: t_solicitud_aprueba; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_solicitud_aprueba (id_solicitud_aprueba, id_persona_caja, id_solicitud_flujo, fecha) FROM stdin;
\.


--
-- Name: t_solicitud_aprueba_id_solicitud_aprueba_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_solicitud_aprueba_id_solicitud_aprueba_seq', 1, false);


--
-- Data for Name: t_solicitud_fiador; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_solicitud_fiador (id_solicitud_fiador, id_solicitud, id_fiador, monto, estatus) FROM stdin;
\.


--
-- Name: t_solicitud_fiador_id_solicitud_fiador_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_solicitud_fiador_id_solicitud_fiador_seq', 1, false);


--
-- Data for Name: t_solicitud_flujo; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_solicitud_flujo (id_solicitud_flujo, id_beneficio_flujo, id_solicitud, fecha_entra, fecha_sale, observacion) FROM stdin;
\.


--
-- Name: t_solicitud_flujo_id_solicitud_flujo_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_solicitud_flujo_id_solicitud_flujo_seq', 1, false);


--
-- Data for Name: t_tipo_vista; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_tipo_vista (id_tipo_vista, descripcion, estatus) FROM stdin;
1	MAESTRO	1
2	MAESTRO/DETALLE	1
3	TRANSACCIÓN	1
4	CONFIGURACIÓN	1
5	REPORTE	1
6	MENU	1
7	TRANSACCION/ANALISIS	1
\.


--
-- Data for Name: t_usuario; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_usuario (id_usuario, nombre, intentos, inicio_sesion, estatus, id_persona) FROM stdin;
5	20640235	0	0	0	5
4	24243750	0	0	0	4
3	25697165	0	0	0	3
1	21560435	0	1	1	1
6	1234567	0	1	1	6
2	20810360	0	2	1	2
\.


--
-- Data for Name: t_usuario_clave; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_usuario_clave (id_usuario_clave, id_usuario, clave, fecha_ini, fecha_fin) FROM stdin;
6	3	25697165	2016-04-29	\N
7	4	24243750	2016-04-29	\N
8	5	20640235	2016-04-29	\N
5	2	20810360	2016-04-29	2016-05-01
12	2	123Edg@r	2016-05-01	\N
13	6	1234567	2016-05-05	2016-05-04
14	6	Jesus!123	2016-05-04	\N
4	1	21560435	2016-04-27	2016-05-09
15	1	Saul$123	2016-05-09	\N
\.


--
-- Name: t_usuario_clave_id_usuario_clave_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_usuario_clave_id_usuario_clave_seq', 15, true);


--
-- Name: t_usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_usuario_id_usuario_seq', 4, true);


--
-- Data for Name: t_usuario_pregunta; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_usuario_pregunta (id_pregunta, id_usuario, pregunta, respuesta) FROM stdin;
3	2	Ciudad	Tokyo
4	2	Perro	Gato
5	6	Perro	Gato
6	6	Color	Azul
7	1	a	a
8	1	b	b
\.


--
-- Name: t_usuario_pregunta_id_pregunta_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_usuario_pregunta_id_pregunta_seq', 8, true);


--
-- Data for Name: t_vista_operacion; Type: TABLE DATA; Schema: cappiutep; Owner: postgres
--

COPY t_vista_operacion (id_vista_operacion, id_operacion, id_tipo_vista) FROM stdin;
1	1	1
2	2	1
3	3	1
4	4	1
5	1	2
6	2	2
7	3	2
8	4	2
9	7	3
10	4	3
11	2	4
12	4	5
13	4	7
14	5	7
15	6	7
\.


--
-- Name: t_vista_operacion_id_vista_operacion_seq; Type: SEQUENCE SET; Schema: cappiutep; Owner: postgres
--

SELECT pg_catalog.setval('t_vista_operacion_id_vista_operacion_seq', 1, false);


--
-- Name: t_beneficio_condicion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_condicion
    ADD CONSTRAINT t_beneficio_condicion_pkey PRIMARY KEY (id_beneficio_condicion);


--
-- Name: t_beneficio_flujo_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_flujo
    ADD CONSTRAINT t_beneficio_flujo_pkey PRIMARY KEY (id_beneficio_flujo);


--
-- Name: t_beneficio_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio
    ADD CONSTRAINT t_beneficio_pkey PRIMARY KEY (id_beneficio);


--
-- Name: t_beneficio_plazo_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_plazo
    ADD CONSTRAINT t_beneficio_plazo_pkey PRIMARY KEY (id_beneficio_plazo);


--
-- Name: t_beneficio_requisito_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_requisito
    ADD CONSTRAINT t_beneficio_requisito_pkey PRIMARY KEY (id_beneficio_requisito);


--
-- Name: t_beneficio_solicitud_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_beneficio_solicitud
    ADD CONSTRAINT t_beneficio_solicitud_pkey PRIMARY KEY (id_beneficio_solicitud);


--
-- Name: t_bitacora_acceso_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_bitacora_acceso
    ADD CONSTRAINT t_bitacora_acceso_pkey PRIMARY KEY (id_bitacora_acceso);


--
-- Name: t_bitacora_general_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_bitacora_general
    ADD CONSTRAINT t_bitacora_general_pkey PRIMARY KEY (id_bitacora_general);


--
-- Name: t_carga_fam_condicion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_carga_fam_condicion
    ADD CONSTRAINT t_carga_fam_condicion_pkey PRIMARY KEY (id_carga_fam_condicion);


--
-- Name: t_carga_fam_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_carga_fam
    ADD CONSTRAINT t_carga_fam_pkey PRIMARY KEY (id_carga_fam);


--
-- Name: t_cargo_caja_ahorro_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_cargo_caja_ahorro
    ADD CONSTRAINT t_cargo_caja_ahorro_pkey PRIMARY KEY (id_cargo_caja);


--
-- Name: t_ciudad_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_ciudad
    ADD CONSTRAINT t_ciudad_pkey PRIMARY KEY (id_ciudad);


--
-- Name: t_detalle_liquid_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_detalle_liquid
    ADD CONSTRAINT t_detalle_liquid_pkey PRIMARY KEY (id_liquid);


--
-- Name: t_detalle_liquid_ref_pago_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_detalle_liquid
    ADD CONSTRAINT t_detalle_liquid_ref_pago_key UNIQUE (ref_pago);


--
-- Name: t_estado_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_estado
    ADD CONSTRAINT t_estado_pkey PRIMARY KEY (id_estado);


--
-- Name: t_flujo_aprueba_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_flujo_aprueba
    ADD CONSTRAINT t_flujo_aprueba_pkey PRIMARY KEY (id_flujo_aprueba);


--
-- Name: t_haberes_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_haberes
    ADD CONSTRAINT t_haberes_pkey PRIMARY KEY (id_haberes);


--
-- Name: t_icono_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_icono
    ADD CONSTRAINT t_icono_pkey PRIMARY KEY (id_icono);


--
-- Name: t_lista_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_lista
    ADD CONSTRAINT t_lista_pkey PRIMARY KEY (id_lista);


--
-- Name: t_lista_valor_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_lista_valor
    ADD CONSTRAINT t_lista_valor_pkey PRIMARY KEY (id_lista_valor);


--
-- Name: t_modulo_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_modulo
    ADD CONSTRAINT t_modulo_pkey PRIMARY KEY (id_modulo);


--
-- Name: t_motivo_proceso_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_motivo_proceso
    ADD CONSTRAINT t_motivo_proceso_pkey PRIMARY KEY (id_motivo_proceso);


--
-- Name: t_motivo_razon_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_motivo_razon
    ADD CONSTRAINT t_motivo_razon_pkey PRIMARY KEY (id_motivo_razon);


--
-- Name: t_municipio_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_municipio
    ADD CONSTRAINT t_municipio_pkey PRIMARY KEY (id_municipio);


--
-- Name: t_noticias_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_noticia
    ADD CONSTRAINT t_noticias_pkey PRIMARY KEY (id_noticia);


--
-- Name: t_operacion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_operacion
    ADD CONSTRAINT t_operacion_pkey PRIMARY KEY (id_operacion);


--
-- Name: t_organizacion_cuenta_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_organizacion_cuenta
    ADD CONSTRAINT t_organizacion_cuenta_pkey PRIMARY KEY (id_org_cuenta);


--
-- Name: t_organizacion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_organizacion
    ADD CONSTRAINT t_organizacion_pkey PRIMARY KEY (id_organizacion);


--
-- Name: t_parroquia_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_parroquia
    ADD CONSTRAINT t_parroquia_pkey PRIMARY KEY (id_parroquia);


--
-- Name: t_periodo_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_periodo
    ADD CONSTRAINT t_periodo_pkey PRIMARY KEY (id_periodo);


--
-- Name: t_persona_aporte_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_aporte
    ADD CONSTRAINT t_persona_aporte_pkey PRIMARY KEY (id_aporte);


--
-- Name: t_persona_caja_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_caja
    ADD CONSTRAINT t_persona_caja_pkey PRIMARY KEY (id_persona_caja);


--
-- Name: t_persona_cedula_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona
    ADD CONSTRAINT t_persona_cedula_key UNIQUE (cedula);


--
-- Name: t_persona_cuenta_banco_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona_cuenta_banco
    ADD CONSTRAINT t_persona_cuenta_banco_pkey PRIMARY KEY (id_cuenta_banco);


--
-- Name: t_persona_id_persona_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona
    ADD CONSTRAINT t_persona_id_persona_key UNIQUE (id_persona);


--
-- Name: t_persona_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_persona
    ADD CONSTRAINT t_persona_pkey PRIMARY KEY (id_persona, cedula);


--
-- Name: t_proceso_caja_ahorro_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_proceso_caja_ahorro
    ADD CONSTRAINT t_proceso_caja_ahorro_pkey PRIMARY KEY (id_proceso);


--
-- Name: t_reporte_descripcion_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_reporte
    ADD CONSTRAINT t_reporte_descripcion_key UNIQUE (descripcion);


--
-- Name: t_reporte_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_reporte
    ADD CONSTRAINT t_reporte_pkey PRIMARY KEY (id_reporte);


--
-- Name: t_reporte_usuario_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_reporte_usuario
    ADD CONSTRAINT t_reporte_usuario_pkey PRIMARY KEY (id_reporte_usuario);


--
-- Name: t_servicio_operacion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_servicio_operacion
    ADD CONSTRAINT t_servicio_operacion_pkey PRIMARY KEY (id_servicio_operacion);


--
-- Name: t_servicio_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_servicio
    ADD CONSTRAINT t_servicio_pkey PRIMARY KEY (id_servicio);


--
-- Name: t_solicitud_amortiza_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_amortiza
    ADD CONSTRAINT t_solicitud_amortiza_pkey PRIMARY KEY (id_solicitud_amortiza);


--
-- Name: t_solicitud_aprueba_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_aprueba
    ADD CONSTRAINT t_solicitud_aprueba_pkey PRIMARY KEY (id_solicitud_aprueba);


--
-- Name: t_solicitud_fiador_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_fiador
    ADD CONSTRAINT t_solicitud_fiador_pkey PRIMARY KEY (id_solicitud_fiador);


--
-- Name: t_solicitud_flujo_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_solicitud_flujo
    ADD CONSTRAINT t_solicitud_flujo_pkey PRIMARY KEY (id_solicitud_flujo);


--
-- Name: t_tipo_vista_descripcion_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_tipo_vista
    ADD CONSTRAINT t_tipo_vista_descripcion_key UNIQUE (descripcion);


--
-- Name: t_tipo_vista_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_tipo_vista
    ADD CONSTRAINT t_tipo_vista_pkey PRIMARY KEY (id_tipo_vista);


--
-- Name: t_usuario_clave_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario_clave
    ADD CONSTRAINT t_usuario_clave_pkey PRIMARY KEY (id_usuario_clave);


--
-- Name: t_usuario_nombre_key; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario
    ADD CONSTRAINT t_usuario_nombre_key UNIQUE (nombre);


--
-- Name: t_usuario_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario
    ADD CONSTRAINT t_usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: t_usuario_pregunta_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario_pregunta
    ADD CONSTRAINT t_usuario_pregunta_pkey PRIMARY KEY (id_pregunta);


--
-- Name: t_vista_operacion_pkey; Type: CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_vista_operacion
    ADD CONSTRAINT t_vista_operacion_pkey PRIMARY KEY (id_vista_operacion);


--
-- Name: t_detalle_liquid_id_solicitud_fkey; Type: FK CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_detalle_liquid
    ADD CONSTRAINT t_detalle_liquid_id_solicitud_fkey FOREIGN KEY (id_solicitud) REFERENCES t_beneficio_solicitud(id_beneficio_solicitud);


--
-- Name: t_haberes_id_persona_fkey; Type: FK CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_haberes
    ADD CONSTRAINT t_haberes_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES t_persona(id_persona);


--
-- Name: t_usuario_id_persona_fkey; Type: FK CONSTRAINT; Schema: cappiutep; Owner: postgres
--

ALTER TABLE ONLY t_usuario
    ADD CONSTRAINT t_usuario_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES t_persona(id_persona);


--
-- Name: cappiutep; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA cappiutep FROM PUBLIC;
REVOKE ALL ON SCHEMA cappiutep FROM postgres;
GRANT ALL ON SCHEMA cappiutep TO postgres;
GRANT ALL ON SCHEMA cappiutep TO PUBLIC;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

