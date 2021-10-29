create database fixPoint collate utf8mb4_spanish_ci;

use fixPoint;

create table usuario (
    dni char(9) primary key,
    nombre varchar(10) not null,
    apellidos varchar(30) not null,
    administrador boolean not null default false,
    password varchar(255) not null,
    email varchar(30) not null unique,
    activo boolean not null default false
);

create table categoria (
    idCategoria int primary key auto_increment,
    nombre varchar(15) unique
);

create table herramienta (
    id_herramienta int primary key auto_increment,
    nombre varchar(15) not null unique,
    modelo varchar(15) not null,
    marca varchar(15) not null,
    disponible boolean not null,
    observaciones varchar(60),
    idCategoria int not null,
    constraint fk_idCategoria_herramienta foreign key (idCategoria)
        references categoria (idCategoria)
        on update cascade
);

create table alquiler (
    dni char(9),
    id_herramienta int,
    fechaInicio date not null,
    dias int not null,
    constraint pk_alquiler primary key (dni , id_herramienta),
    constraint ch_dias check (dias > 0),
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
    fecha         date    default current_timestamp,
    nombreMaquina varchar(15)           not null unique,
    revisada      boolean default false not null,
    ocurrencia    varchar(70)           not null,
    propuesta     varchar(70)           not null,
    averias       varchar(80)           not null,
    solucion      varchar(70)           not null
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
    numpaso int,
    numficha int,
    detalle varchar(200) not null,
    foto varchar(255),
    constraint pk_paso primary key (numpaso, numficha),
    constraint fk_numFicha_paso foreign key (numFicha) references guiaDespiece (numFicha) on update cascade
);

