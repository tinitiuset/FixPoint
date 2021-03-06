create database fixPoint collate utf8mb4_spanish_ci;

use fixPoint;

create table usuario
(
    dni           char(9) primary key,
    nombre        varchar(30)  not null,
    apellidos     varchar(30)  not null,
    administrador boolean      not null default false,
    password      varchar(255) not null,
    email         varchar(50)  not null unique,
    activo        boolean      not null default false
);

create table categoria
(
    idCategoria int primary key auto_increment,
    nombre      varchar(15) unique
);
/*LAS FOTOS DE LAS HERRAMIENTAS SE GUARDAN EN IMG/HERRAMIENTAS*/
create table herramienta
(
    id_herramienta int primary key auto_increment,
    nombre         varchar(200) not null unique,
    modelo         varchar(70),
    marca          varchar(70),
    disponible     boolean      not null,
    foto           varchar(200) not null,
    observaciones  varchar(255),
    idCategoria    int          not null,
    constraint fk_idCategoria_herramienta foreign key (idCategoria)
        references categoria (idCategoria)
        on update cascade
);

create table alquiler
(
    dni            char(9),
    id_herramienta int,
    fechaInicio    date not null,
    fechaFin       date not null,
    constraint pk_alquiler primary key (dni, id_herramienta),
    constraint fk_DNI_alquiler foreign key (dni)
        references usuario (dni)
        on update cascade,
    constraint fk_IDHERRAMIENTA_alquiler foreign key (id_herramienta)
        references herramienta (id_herramienta)
        on update cascade
);

create table guiaDespiece
(
    numFicha      int primary key auto_increment,
    fecha         timestamp default current_timestamp,
    nombreMaquina varchar(15)             not null unique,
    revisada      boolean   default false not null,
    ocurrencia    varchar(70)             not null,
    propuesta     varchar(70)             not null,
    averias       varchar(80)             not null,
    solucion      varchar(70)             not null,
    foto          varchar(255)            not null
);

create table creadorGuia
(
    dni      char(9),
    numFicha int,
    constraint pk_creadorGuia primary key (dni, numFicha),
    constraint fk_DNI_creadorGuia foreign key (dni) references usuario (dni) on update cascade,
    constraint fk_numFicha_creadorGuia foreign key (numFicha) references guiaDespiece (numFicha) on update cascade
);

create table paso
(
    numpaso  int,
    numficha int,
    detalle  varchar(200) not null,
    foto     varchar(255),
    constraint pk_paso primary key (numpaso, numficha),
    constraint fk_numFicha_paso foreign key (numFicha) references guiaDespiece (numFicha) on update cascade
);

create table solicitudaonacion
(
    id        int primary key auto_increment,
    nombre    varchar(30) not null,
    apellidos varchar(30) not null,
    email     varchar(50) not null,
    telefono  int(9),
    donacion  text
);

create table solicitudalquiler
(
    id_solicitud      int primary key auto_increment,
    dni               char(9),
    nombre            varchar(30) not null,
    apellidos         varchar(30) not null,
    email             varchar(50) not null,
    id_herramienta    int,
    disponible        boolean     not null default false,
    alquiler_atendido boolean     not null default false

);

create table alquileres_eliminados
(
    id             int primary key auto_increment,
    dni            char(9),
    id_herramienta int,
    fechaInicio    date not null,
    fechaFin       date not null

);

/* USUARIO ADMINISTRADOR*/
/*INSERT INTO `usuario` (`dni`, `nombre`, `apellidos`, `administrador`, `password`, `email`)
VALUES ('00000000A', 'Administrador', 'Administrador', '1', '', 'administracion@fixpoint.com');*/

/*INSERCIONES TABLA CATEGORIA*/
INSERT INTO `categoria` (`nombre`)
values ('Basicas');

INSERT INTO `categoria` (`nombre`)
values ('Medicion');

INSERT INTO `categoria` (`nombre`)
values ('fijacion');

INSERT INTO `categoria` (`nombre`)
values ('corte');


/*INSERCIONES TABLA HERRAMIENTA*/
INSERT INTO `herramienta` (`nombre`, `marca`, `disponible`, `foto`, `observaciones`, `idCategoria`)
values ('Alicate de corte 19mm', 'acesa', true, 'Alicate de corte 19mm.jpg',
        'Alicate de corte marca ACESA fabricado en espa??a.', 1);

INSERT INTO `herramienta` (`nombre`, `disponible`, `foto`, `observaciones`, `idCategoria`)
values ('Alicate de punta plana', true, 'Alicate de punta plana.jpg',
        'Alicate de punta plana, buen estado.', 1);

INSERT INTO `herramienta` (`nombre`, `marca`, `modelo`, `disponible`, `foto`, `idCategoria`)
values ('Calibre Saturn 150mm', 'Mitutoyo', '150', true,
        'Calibre Saturn 150mm.jpg'
           , 2);

INSERT INTO `herramienta` (`nombre`, `marca`, `modelo`, `disponible`, `foto`, `observaciones`, `idCategoria`)
values ('Taladro dexter power', 'dexter', 'power', true,
        'Radial HITACHI.jpg'
           , 'Taladro percutor DEXTER POWER de 900W', 3);

INSERT INTO `herramienta` (`nombre`, `marca`, `disponible`, `foto`, `observaciones`, `idCategoria`)
values ('Radial HITACHI', 'HITACHI', true,
        'Taladro dexter power.jpg'
           , 'Radial HITACHI con maletin.', 4);

/* CREACION TRIGGERS */

CREATE TRIGGER alquiler_herramienta
    AFTER INSERT
    ON solicitudAlquiler
    FOR EACH ROW
    INSERT INTO alquiler(dni, id_herramienta, fechaInicio)
    VALUES (NEW.dni, NEW.id_herramienta, CURRENT_DATE());

CREATE TRIGGER ELIMALQ_AD
    AFTER DELETE
    ON alquiler
    FOR EACH ROW
    INSERT INTO alquileres_eliminados (dni, id_herramienta, fechaInicio, fechaFin)
    VALUES (old.dni, old.id_herramienta, old.fechaInicio, old.fechaFin);