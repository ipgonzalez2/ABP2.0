drop database if exists `padel`;
create database `padel` default character set utf8 collate utf8_general_ci;
--
-- seleccionamos para usar
--
use `padel`;
--
-- damos permiso uso y borramos el usuario que queremos crear por si existe
--
-- grant usage on * . * to `padel`@`localhost`;
-- drop user `padel`@`localhost`;

--
-- creamos el usuario y le damos password,damos permiso de uso y damos permisos sobre la base de datos.
--
create user if not exists `padeluser`@`localhost` identified by 'padel19';
grant usage on *.* to `padeluser`@`localhost` require none with max_queries_per_hour 0 max_connections_per_hour 0 max_updates_per_hour 0 max_user_connections 0;
grant all privileges on `padel`.* to `padeluser`@`localhost` with grant option;

create table if not exists usuario(

	id_usuario int(10) auto_increment,
	username varchar(255) not null,
	passwd varchar(255) not null,
  nombre varchar(255) not null,
	email varchar(255) not null,
	rol enum('administrador', 'deportista') not null,
  sexo enum('hombre', 'mujer') not null ,
  nivel int(10) not null,
  socio bool not null,

	constraint pk_usuario primary key(id_usuario)

)engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists pista (

  id_pista int(10) auto_increment,
  tipo_pista enum('abierta','cerrada') not null,
  
  constraint pk_pista primary key(id_pista)

) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists calendario (
  fecha_calendario date not null,
  pista_calendario int(10) not null,
  estado_calendario enum('libre','ocupado') not null,
  hora_calendario time not null,

  constraint pk_calendario primary key(fecha_calendario, hora_calendario,pista_calendario),
  constraint fk_pista_calendario foreign key(pista_calendario) references pista(id_pista) on delete cascade

) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists partido (
  id_partido int(10) auto_increment,
  fecha_partido date not null,
  precio_partido float(10,2) not null,
  estado_partido enum('abierto','cerrado') not null,
  fecha_fin_inscripcion date not null,
  hora_partido time not null,

  constraint pk_partido primary key(id_partido)

) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists inscripcionpartido (
  id_inscripcion_partido int(10) not null,
  id_inscripcion_usuario int(10) not null,

  constraint fk_inscripcion_partido foreign key(id_inscripcion_partido) references partido(id_partido) on delete cascade,
  constraint fk_inscripcion_usuario foreign key(id_inscripcion_usuario) references usuario(id_usuario) on delete cascade,
  constraint pk_partido primary key(id_inscripcion_partido, id_inscripcion_usuario)
  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists notificacion (
  id_notificacion int(10) auto_increment,
  id_usuario_notificacion int(10) not null,
  mensaje varchar(255) not null,

  constraint pk_notificacion primary key(id_notificacion),
  constraint fk_usuario_notificacion foreign key(id_usuario_notificacion) references usuario(id_usuario) on delete cascade
  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists campeonato (
  id_campeonato int(10) auto_increment,
  nombre_campeonato varchar(255) not null,
  fecha_inicio date not null,
  fecha_fin date not null,
  precio_campeonato float(10,2) not null,
  fecha_limite_inscripcion date not null,
  estado_campeonato enum('abierto','cerrado'),

  constraint pk_campeonato primary key(id_campeonato)
  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists categorianivel (
  id_categorianivel int(10) auto_increment,
  categoria enum('masculina','femenina','mixto'),
  nivel enum('1','2','3'),
  campeonato int(10) not null,

  constraint pk_categorianivel primary key(id_categorianivel),
  constraint fk_campeonato foreign key(campeonato) references campeonato(id_campeonato) on delete cascade
  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists grupo (
  id_grupo int(10) auto_increment,
  categorianivel_grupo int(10) not null,
  numParejas int(10) not null,

  constraint pk_grupo primary key(id_grupo),
  constraint fk_categorianivel_grupo foreign key(categorianivel_grupo) references categorianivel(id_categorianivel) on delete cascade
  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists pareja (
  id_pareja int(10) auto_increment,
  deportista1 int(10) not null,
  deportista2 int(10) not null,
  categorianivel int(10) not null,
  grupo int(10),
  puntos int(10) default 0,

  constraint pk_pareja primary key(id_pareja),
  constraint fk_deportista1 foreign key(deportista1) references usuario(id_usuario) on delete cascade,
  constraint fk_deportista2 foreign key(deportista2) references usuario(id_usuario) on delete cascade,
  constraint fk_categorianivel foreign key(categorianivel) references categorianivel(id_categorianivel) on delete cascade,
  constraint fk_grupo foreign key(grupo) references grupo(id_grupo) on delete cascade

  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists enfrentamiento (
  id_enfrentamiento int(10) auto_increment,
  pareja1 int(10) not null,
  pareja2 int(10) not null,
  resultado1 int(10),
  resultado2 int(10),
  grupo_enfrentamiento int(10) not null,
  tipo_enfrentamiento enum("liga", "playoff") not null,
  estado_enfrentamiento enum("abierto", "cerrado") not null,
  fecha_enfrentamiento date not null,
  hora_enfrentamiento time not null,

  constraint pk_enfrentamiento primary key(id_enfrentamiento),
  constraint fk_pareja1 foreign key(pareja1) references pareja(id_pareja) on delete cascade,
  constraint fk_pareja2 foreign key(pareja2) references pareja(id_pareja) on delete cascade,
  constraint fk_frupo_enf foreign key(grupo_enfrentamiento) references grupo(id_grupo) on delete cascade

  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists confirmacion (
  id_enfrentamiento int(10) not null,
  deportista int(10) not null,

  constraint pk_enfrentamiento primary key(id_enfrentamiento, deportista),
  constraint fk_enfrentamiento_conf foreign key(id_enfrentamiento) references enfrentamiento(id_enfrentamiento) on delete cascade,
  constraint fk_deportista_conf foreign key(deportista) references usuario(id_usuario) on delete cascade

  
) engine=innodb default charset=latin1 collate=latin1_spanish_ci;


create table if not exists reserva(

  id_reserva int(10) auto_increment,
  fecha date not null,
  precio float(10,2),
  usuario_reserva int(10),
  pista_reserva int(10) not null,
  hora time not null,
  partido_reserva int(10),
  enfrentamiento int(10),

  constraint fk_usuario foreign key(usuario_reserva) references usuario(id_usuario) on delete cascade,
  constraint fk_pista foreign key(pista_reserva) references pista(id_pista) on delete cascade,
  constraint fk_enfrentamiento foreign key(enfrentamiento) references enfrentamiento(id_enfrentamiento) on delete cascade,
   constraint fk_partido foreign key(partido_reserva) references partido(id_partido) on delete cascade,
  constraint pk_reserva primary key(id_reserva)

) engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists clase(

	id_clase int(10) auto_increment,
  usuario_clase int(10) not null,
  precio float(10,2) not null,
	duracion int(10),

	constraint pk_clase primary key(id_clase),
  constraint fk_usuario_clase foreign key(usuario_clase) references usuario(id_usuario) on delete cascade


)engine=innodb default charset=latin1 collate=latin1_spanish_ci;

create table if not exists pago(

	id_pago int(10) auto_increment,
  usuario_pago int(10) not null,
  precio float(10,2) not null,
	reserva_pago int(10),
	partido_pago int(10),
  campeonato_pago int(10),
  clase_pago int(10),
	estado_pago enum('pagado', 'pendiente') not null,
  fecha_valido date,

	constraint pk_pago primary key(id_pago),
  constraint fk_usuario_pago foreign key(usuario_pago) references usuario(id_usuario) on delete cascade,
  constraint fk_reserva_pago foreign key(reserva_pago) references reserva(id_reserva) on delete cascade,
  constraint fk_partido_pago foreign key(partido_pago) references partido(id_partido) on delete cascade,
  constraint fk_campeonato_pago foreign key(campeonato_pago) references campeonato(id_campeonato) on delete cascade,
  constraint fk_clase_pago foreign key(clase_pago) references clase(id_clase) on delete cascade


)engine=innodb default charset=latin1 collate=latin1_spanish_ci;



