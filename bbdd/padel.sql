DROP DATABASE IF EXISTS `PADEL`;
CREATE DATABASE `PADEL` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `PADEL`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `PADEL`@`localhost`;
	DROP USER `PADEL`@`localhost`;

--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `padelUser`@`localhost` IDENTIFIED BY 'padel19';
GRANT USAGE ON *.* TO `padelUser`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `PADEL`.* TO `padelUser`@`localhost` WITH GRANT OPTION;

CREATE TABLE IF NOT EXISTS USUARIO(

	ID_USUARIO INT(10) AUTO_INCREMENT,
	USERNAME VARCHAR(255) NOT NULL,
	PASSWD VARCHAR(255) NOT NULL,
  NOMBRE VARCHAR(255) NOT NULL,
	EMAIL VARCHAR(255) NOT NULL,
	ROL ENUM('ADMINISTRADOR', 'DEPORTISTA') NOT NULL,
  SEXO ENUM('HOMBRE', 'MUJER') NOT NULL,
  NIVEL INT(10) NOT NULL,

	CONSTRAINT PK_USUARIO PRIMARY KEY(ID_USUARIO)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO USUARIO VALUES(0,'admin','admin','','','ADMINISTRADOR','',0);

CREATE TABLE IF NOT EXISTS PISTA (

  ID_PISTA int(10) AUTO_INCREMENT,
  TIPO_PISTA ENUM('ABIERTA','CERRADA') NOT NULL,
  
  CONSTRAINT PK_PISTA PRIMARY KEY(ID_PISTA)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO PISTA VALUES(NULL,'ABIERTA');
INSERT INTO PISTA VALUES(NULL,'ABIERTA');
INSERT INTO PISTA VALUES(NULL,'CERRADA');
INSERT INTO PISTA VALUES(NULL,'CERRADA');


CREATE TABLE IF NOT EXISTS RESERVA(

  ID_RESERVA INT(10) AUTO_INCREMENT,
  FECHA DATE NOT NULL,
  PRECIO FLOAT(10,2) NOT NULL,
  USUARIO_RESERVA INT(10) NOT NULL,
  PISTA_RESERVA INT(10) NOT NULL,

  CONSTRAINT FK_USUARIO FOREIGN KEY(USUARIO_RESERVA) REFERENCES USUARIO(ID_USUARIO) ON DELETE CASCADE,
  CONSTRAINT FK_PISTA FOREIGN KEY(PISTA_RESERVA) REFERENCES PISTA(ID_PISTA) ON DELETE CASCADE,
  CONSTRAINT PK_RESERVA PRIMARY KEY(ID_RESERVA)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS PAGO(
  ID_PAGO INT(10) AUTO_INCREMENT,
  TIPO_PAGO ENUM('EFECTIVO','TARJETA') NOT NULL,
  ESTADO_PAGO ENUM('REALIZADO','PENDIENTE') NOT NULL,
  RESERVA_PAGO INT(10) NOT NULL,
  CANTIDAD FLOAT(10,2) NOT NULL,

  CONSTRAINT FK_RESERVA FOREIGN KEY(RESERVA_PAGO) REFERENCES RESERVA(ID_RESERVA) ON DELETE CASCADE,
  CONSTRAINT PK_PAGO PRIMARY KEY(ID_PAGO)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS CALENDARIO (
  ID_CALENDARIO INT(10) AUTO_INCREMENT,
  FECHA_CALENDARIO DATE NOT NULL,
  ESTADO_CALENDARIO ENUM('LIBRE','OCUPADO') NOT NULL,
  PISTA_CALENDARIO INT(10) NOT NULL,

  CONSTRAINT FK_PISTA_CALENDARIO FOREIGN KEY(PISTA_CALENDARIO) REFERENCES PISTA(ID_PISTA) ON DELETE CASCADE,
  CONSTRAINT PK_CALENDARIO PRIMARY KEY(ID_CALENDARIO)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS PARTIDO (
  ID_PARTIDO INT(10) AUTO_INCREMENT,
  FECHA_PARTIDO DATE NOT NULL,
  PRECIO_PARTIDO FLOAT(10,2) NOT NULL,
  ESTADO_PARTIDO ENUM('ABIERTO','CERRADO') NOT NULL,
  FECHA_FIN_INSCRIPCION DATE NOT NULL,

  CONSTRAINT PK_PARTIDO PRIMARY KEY(ID_PARTIDO)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS INSCRIPCIONPARTIDO (
  ID_INSCRIPCION_PARTIDO INT(10) NOT NULL,
  ID_INSCRIPCION_USUARIO INT(10) NOT NULL,

  CONSTRAINT PK_PARTIDO PRIMARY KEY(ID_INSCRIPCION_PARTIDO, ID_INSCRIPCION_USUARIO)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS NOTIFICACION (
  ID_NOTIFICACION INT(10) AUTO_INCREMENT,
  ID_USUARIO_NOTIFICACION INT(10) NOT NULL,
  MENSAJE VARCHAR(255) NOT NULL,

  CONSTRAINT PK_NOTIFICACION PRIMARY KEY(ID_NOTIFICACION),
   CONSTRAINT FK_USUARIO_NOTIFICACION FOREIGN KEY(ID_USUARIO_NOTIFICACION) REFERENCES USUARIO(ID_USUARIO) ON DELETE CASCADE
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;