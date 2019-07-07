/* Creación de la base de datos y el usuario para la conexión*/

/* CREATE DATABASE api_prueba; */

/* CREATE USER 'prueba'@'localhost' IDENTIFIED BY 'prueba'; */

/* GRANT ALL PRIVILEGES ON api_prueba.* TO 'prueba'@'localhost'; */

/* Correr el archivo en la consola */

/* mysql -u prueba -p api_prueba < tablas.sql */

/*Tabla de estudiantes */

CREATE TABLE estudiante (   est_codigo smallint unsigned not null auto_increment, /*Llave primaria de la tabla*/ 
                            est_nombre varchar(20) not null, /* Nombre del estudiante*/
                            est_apellido varchar(20) not null, /*Apellido del estudiante*/
                            est_edad integer not null,/*Edad del estidiante*/
                            est_correo varchar(60) not null, /* Correo del estudiante*/
                            est_cursos_asociados varchar(100) not null, /*Se maneja en formato id1-id2-id3-id4 --id* pk de la tabla cursos*/
                            constraint pk_estudiante primary key (est_codigo) ); 

/*Tabla para los cursos  */                          
CREATE TABLE curso (        cur_codigo smallint unsigned not null auto_increment, /*Llave primaria de la tabla */
                            cur_nombre varchar(20) not null, /*Nombre del curso*/
                            cur_horario varchar(11) not null, /*El horario se maneja como string en formato 00:00-24:00*/
                            cur_fecha_inicio date not null, /*Fecha de Inicio del curso*/
                            cur_fecha_fin date not null, /* Fecha de fin del curso*/
                            cur_nun_est_asociados integer not null, /*Número de estudiantes asociados*/
                            constraint pk_curso primary key (cur_codigo) ); 

/*Insert estudiantes iniciales*/

INSERT INTO estudiante (est_nombre, est_apellido, est_edad, est_correo, est_cursos_asociados) 
VALUES  ('Adriana', 'trujillo', 22, 'adriana@example.com', '1-2-3'),
        ('Felipe', 'Perez', 21, 'felipe@example.com', '1-3'),
        ('Juan', 'Torres', 25, 'juan@example.com', '3');

/*Insert cursos iniciales*/

INSERT INTO curso (cur_nombre, cur_horario, cur_fecha_inicio, cur_fecha_fin, cur_nun_est_asociados) 
VALUES  ('Programación en C', '10:00-13:00', '2019-11-05', '2019-12-05', 3),
        ('Algoritmia', '14:00-16:00', '2019-11-05', '2019-12-05', 4),
        ('PRL', '13:00-15:00', '2019-11-05', '2019-12-05', 1);