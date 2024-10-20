CREATE TABLE 
`biblioteca`.`usuario` (
    `DNI` VARCHAR(9) NOT NULL , 
    `NOMBRE` VARCHAR(20) NOT NULL , 
    `APELLIDO` VARCHAR(30) NOT NULL , 
    `DIRECCION` VARCHAR(40) NOT NULL , 
    PRIMARY KEY (`DNI`)
    ) ENGINE = InnoDB;

CREATE TABLE 
`biblioteca`.`libro` (
    `CODIGO` INT(11) NOT NULL AUTO_INCREMENT , 
    `TITULO` VARCHAR(40) NOT NULL , 
    `AUTOR` VARCHAR(40) NOT NULL , 
    PRIMARY KEY (`CODIGO`)
    ) ENGINE = InnoDB;

CREATE TABLE 
`biblioteca`.`prestar` (
    `DNI_USUARIO` VARCHAR(9) NOT NULL , 
    `CODIGO_LIBRO` INT(11) NOT NULL , 
    `FECHA_ENTREGA` DATE NOT NULL , 
    PRIMARY KEY (`DNI_USUARIO`, `CODIGO_LIBRO`, `FECHA_ENTREGA`), 
    INDEX `FK_DNI_USUARIO` (`DNI_USUARIO`), 
    INDEX `FK_COD_LIBRO` (`CODIGO_LIBRO`)
    ) ENGINE = InnoDB;

ALTER TABLE `prestar`
ADD FOREIGN KEY (`CODIGO_LIBRO`) REFERENCES `libro`(`CODIGO`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `prestar`
ADD FOREIGN KEY (`DNI_USUARIO`) REFERENCES `usuario`(`DNI`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `prestar`
DROP FOREIGN KEY FK_COD_LIBRO, DROP FOREIGN KEY FK_DNI_USUARIO;

ALTER TABLE `prestar`
ADD CONSTRAINT FK_COD_LIBRO FOREIGN KEY (CODIGO_LIBRO) REFERENCES libro(CODIGO) ON DELETE CASCADE ON UPDATE RESTRICT,
ADD CONSTRAINT FK_DNI_USUARIO FOREIGN KEY (DNI_USUARIO) REFERENCES usuario(DNI) ON DELETE CASCADE ON UPDATE RESTRICT;



INSERT INTO `usuario` (`DNI`, `NOMBRE`, `APELLIDO`, `DIRECCION`) VALUES
('12345678A', 'Juan', 'Pérez', 'Calle Falsa 123'),
('23456789B', 'María', 'García', 'Avenida Siempreviva 456'),
('34567890C', 'Luis', 'Martínez', 'Calle Luna 789'),
('45678901D', 'Ana', 'López', 'Plaza Sol 101'),
('56789012E', 'Carlos', 'Sánchez', 'Calle Estrella 202'),
('67890123F', 'Lucía', 'Fernández', 'Avenida Primavera 303'),
('78901234G', 'Jorge', 'Torres', 'Calle Rayo 404'),
('89012345H', 'Sofía', 'Gómez', 'Calle Truenos 505'),
('90123456I', 'Pablo', 'Díaz', 'Avenida Lluvia 606'),
('01234567J', 'Carmen', 'Romero', 'Calle Árbol 707'),
('11234568K', 'Raúl', 'Moreno', 'Plaza Río 808'),
('21234569L', 'Elena', 'Vega', 'Calle Monte 909'),
('31234560M', 'José', 'Ruiz', 'Avenida Laguna 1010'),
('41234561N', 'Teresa', 'Silva', 'Calle Brisa 1111'),
('51234562O', 'Alberto', 'Ortega', 'Avenida Sierra 1212'),
('61234563P', 'Marta', 'Navarro', 'Calle Mar 1313'),
('71234564Q', 'Manuel', 'Ríos', 'Calle Playa 1414'),
('81234565R', 'Laura', 'Pascual', 'Calle Bosque 1515'),
('91234566S', 'Fernando', 'Castro', 'Calle Viento 1616'),
('01234567T', 'Isabel', 'Reyes', 'Avenida Cielo 1717');

INSERT INTO `libro` (`TITULO`, `AUTOR`) VALUES
('Cien Años de Soledad', 'Gabriel García Márquez'),
('Don Quijote de la Mancha', 'Miguel de Cervantes'),
('La Sombra del Viento', 'Carlos Ruiz Zafón'),
('El Principito', 'Antoine de Saint-Exupéry'),
('Crónica de una Muerte Anunciada', 'Gabriel García Márquez'),
('El Amor en los Tiempos del Cólera', 'Gabriel García Márquez'),
('1984', 'George Orwell'),
('Rebelión en la Granja', 'George Orwell'),
('Rayuela', 'Julio Cortázar'),
('La Metamorfosis', 'Franz Kafka'),
('Fahrenheit 451', 'Ray Bradbury'),
('Matar a un Ruiseñor', 'Harper Lee'),
('Los Miserables', 'Victor Hugo'),
('El Nombre de la Rosa', 'Umberto Eco'),
('El Señor de los Anillos', 'J.R.R. Tolkien'),
('Harry Potter y la Piedra Filosofal', 'J.K. Rowling'),
('El Hobbit', 'J.R.R. Tolkien'),
('El Juego del Ángel', 'Carlos Ruiz Zafón'),
('La Colmena', 'Camilo José Cela'),
('Pedro Páramo', 'Juan Rulfo');

INSERT INTO `prestar` (`DNI_USUARIO`, `CODIGO_LIBRO`, `FECHA_ENTREGA`) VALUES
('12345678A', 1, '2024-10-01'),
('23456789B', 2, '2024-10-02'),
('34567890C', 3, '2024-10-03'),
('45678901D', 4, '2024-10-04'),
('56789012E', 5, '2024-10-05'),
('67890123F', 6, '2024-10-06'),
('78901234G', 7, '2024-10-07'),
('89012345H', 8, '2024-10-08'),
('90123456I', 9, '2024-10-09'),
('01234567J', 10, '2024-10-10'),
('11234568K', 11, '2024-10-11'),
('21234569L', 12, '2024-10-12'),
('31234560M', 13, '2024-10-13'),
('41234561N', 14, '2024-10-14'),
('51234562O', 15, '2024-10-15'),
('61234563P', 16, '2024-10-16'),
('71234564Q', 17, '2024-10-17'),
('81234565R', 18, '2024-10-18'),
('91234566S', 19, '2024-10-19'),
('01234567T', 20, '2024-10-20');
