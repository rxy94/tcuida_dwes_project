-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 07-12-2024 a las 15:50:58
-- Versión del servidor: 11.5.2-MariaDB-ubu2404
-- Versión de PHP: 8.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tcuida`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergia`
--

CREATE TABLE `alergia` (
  `idAlergia` int(11) NOT NULL,
  `nomAlergia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alergia`
--

INSERT INTO `alergia` (`idAlergia`, `nomAlergia`) VALUES
(1, 'Pollen Allergy'),
(2, 'Dust Mite Allergy'),
(3, 'Peanut Allergy'),
(4, 'Milk Allergy'),
(5, 'Egg Allergy'),
(6, 'Shellfish Allergy'),
(7, 'Tree Nut Allergy'),
(8, 'Soy Allergy'),
(9, 'Wheat Allergy'),
(10, 'Insect Sting Allergy'),
(11, 'Latex Allergy'),
(12, 'Dog Allergy'),
(13, 'Cat Allergy'),
(14, 'Mold Allergy'),
(15, 'Grass Allergy'),
(16, 'Citrus Allergy'),
(17, 'Chocolate Allergy'),
(18, 'Fish Allergy'),
(19, 'Dust Allergy'),
(20, 'Fragrance Allergy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico`
--

CREATE TABLE `diagnostico` (
  `idDiag` int(11) NOT NULL,
  `nomDiag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `diagnostico`
--

INSERT INTO `diagnostico` (`idDiag`, `nomDiag`) VALUES
(1, 'Hypertension'),
(2, 'Diabetes'),
(3, 'Asthma'),
(4, 'Migraine'),
(5, 'Back Pain'),
(6, 'Anxiety'),
(7, 'Depression'),
(8, 'Insomnia'),
(9, 'Heart Disease'),
(10, 'Arthritis'),
(11, 'Obesity'),
(12, 'Gastroesophageal Reflux Disease'),
(13, 'Cancer'),
(14, 'Kidney Disease'),
(15, 'Stroke'),
(16, 'Tuberculosis'),
(17, 'Pneumonia'),
(18, 'Chronic Obstructive Pulmonary Disease'),
(19, 'Celiac Disease'),
(20, 'Lung Cancer'),
(21, 'Alzheimer\'s Disease'),
(22, 'Parkinson\'s Disease'),
(23, 'Multiple Sclerosis'),
(24, 'Epilepsy'),
(25, 'Gout'),
(26, 'Chronic Fatigue Syndrome'),
(27, 'Sickle Cell Anemia'),
(28, 'HIV/AIDS'),
(29, 'Blood Pressure Disorder'),
(30, 'Rheumatoid Arthritis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `idEsp` int(11) NOT NULL,
  `nomEsp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idEsp`, `nomEsp`) VALUES
(1, 'Family Medicine'),
(2, 'Internal medicine'),
(3, 'Surgery'),
(4, 'Neurology'),
(5, 'Psychiatry'),
(6, 'Plastic Surgery'),
(7, 'Urology'),
(8, 'OB/GYN'),
(9, 'Anesthesiology'),
(10, 'Preventive Medicine'),
(11, 'Orthopedics'),
(12, 'Ophthalmology'),
(13, 'Dermatology'),
(14, 'Cardiology'),
(15, 'Gastroenterology'),
(16, 'Oncology'),
(17, 'Rheumatology'),
(18, 'Endocrinology'),
(19, 'Nephrology'),
(20, 'Infectious Diseases');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

CREATE TABLE `medico` (
  `idMed` int(11) NOT NULL,
  `nomMed` varchar(100) NOT NULL,
  `apeMed` varchar(100) NOT NULL,
  `numColegiado` varchar(9) DEFAULT NULL,
  `contactoMed` varchar(20) NOT NULL,
  `emailMed` varchar(100) NOT NULL,
  `fotoMed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`idMed`, `nomMed`, `apeMed`, `numColegiado`, `contactoMed`, `emailMed`, `fotoMed`) VALUES
(1, 'Shelton', 'Greader', '282814468', '576 643 4462', 'sgreader0@livejournal.com', 'http://dummyimage.com/157x197.png/ff4444/ffffff'),
(2, 'Mella', 'Seivertsen', '282828111', '516 933 2835', 'mseivertsen1@csmonitor.com', 'http://dummyimage.com/217x168.png/cc0000/ffffff'),
(3, 'Grier', 'Randal', '282828112', '949 609 4239', 'grandal2@senate.gov', 'http://dummyimage.com/126x179.png/ff4444/ffffff'),
(4, 'North', 'Nattriss', '282828113', '317 347 5660', 'nnattriss3@bandcamp.com', 'http://dummyimage.com/189x101.png/5fa2dd/ffffff'),
(5, 'Brocky', 'Huchot', '282828110', '526 460 6466', 'bhuchot4@phpbb.com', 'http://dummyimage.com/121x207.png/5fa2dd/ffffff'),
(6, 'Lebbie', 'Willment', '282828114', '414 593 1478', 'lwillment5@independent.co.uk', 'http://dummyimage.com/235x205.png/5fa2dd/ffffff'),
(7, 'Koren', 'Challes', '282854172', '747 728 2853', 'kchalles6@vistaprint.com', 'http://dummyimage.com/220x178.png/ff4444/ffffff'),
(8, 'Brady', 'Grundwater', '123456789', '715 719 3707', 'bgrundwater7@cocolog-nifty.com', 'http://dummyimage.com/126x248.png/cc0000/ffffff'),
(9, 'Bidget', 'Sidon', '234569879', '391 327 8084', 'bsidon8@guardian.co.uk', 'http://dummyimage.com/239x187.png/dddddd/000000'),
(10, 'Madeline', 'Astlatt', '159634786', '960 466 4383', 'mastlatt9@blogger.com', 'http://dummyimage.com/160x123.png/5fa2dd/ffffff'),
(11, 'John', 'Doe', '654987123', '952368694', 'johndoe@tcuida.com', 'https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available'),
(12, 'Jane', 'Donna', '546971236', '693476352', 'janedonna@tcuida.com', 'https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available'),
(13, 'Jenny', 'Doe', '23698745', '963 758 253', 'jenny@tcuida.com', 'https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available'),
(14, 'Poppy', 'Doe', '256348965', '658932456', 'poppydoe@tcuida.com', 'https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available'),
(15, 'Jackie', 'Doe', '256134789', '658 964 756', 'jackie@tcuida.com', 'https://dummyimage.com/250x250/494b54/ffffff.png&text=img+not+available');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico_especialidad`
--

CREATE TABLE `medico_especialidad` (
  `idMed` int(11) NOT NULL,
  `idEsp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medico_especialidad`
--

INSERT INTO `medico_especialidad` (`idMed`, `idEsp`) VALUES
(1, 1),
(3, 1),
(5, 1),
(9, 1),
(11, 2),
(13, 2),
(10, 3),
(13, 3),
(14, 3),
(4, 4),
(14, 4),
(2, 5),
(2, 6),
(3, 7),
(9, 8),
(6, 9),
(4, 10),
(12, 11),
(7, 13),
(5, 14),
(11, 15),
(15, 16),
(8, 17),
(12, 17),
(7, 18),
(15, 18),
(8, 19),
(10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idPac` int(11) NOT NULL,
  `nomPac` varchar(100) NOT NULL,
  `apePac` varchar(100) NOT NULL,
  `dniPac` varchar(10) NOT NULL,
  `fechaNac` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `contactoPac` varchar(20) NOT NULL,
  `numHistoria` varchar(10) NOT NULL,
  `dirPaciente` varchar(100) NOT NULL,
  `idMed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idPac`, `nomPac`, `apePac`, `dniPac`, `fechaNac`, `genero`, `contactoPac`, `numHistoria`, `dirPaciente`, `idMed`) VALUES
(1, 'Sallee', 'Perford', '56065926L', '1980-05-15', 'female', '285 722 2290', '8083149721', '00465 Straubel Parkway', 1),
(2, 'Ezra', 'Riggeard', '70607015M', '1990-07-22', 'female', '225 586 3735', '9732232609', '21 Bluejay Crossing', 1),
(3, 'Aurthur', 'Eadon', '94024829L', '1985-03-11', 'male', '692 817 1780', '8860750350', '0311 Pleasure Avenue', 1),
(4, 'Myriam', 'MacPadene', '50197733X', '1992-06-30', 'female', '294 652 4837', '0810521784', '9723 Gina Place', 4),
(5, 'Courtney', 'Stiven', '58763762S', '1988-12-18', 'female', '319 767 1562', '7638366417', '44 Pierstorff Junction', 5),
(6, 'Harriette', 'Alderton', '25601278T', '1977-11-04', 'female', '343 459 7996', '5682936035', '612 Kedzie Terrace', 5),
(7, 'Blondie', 'Whitelock', '34073998N', '1991-01-20', 'female', '642 231 2432', '4038352609', '9025 Village Green Terrace', 7),
(8, 'Britni', 'Plaster', '37521010P', '1984-10-09', 'female', '105 481 5861', '8041225799', '7228 Mesta Street', 8),
(9, 'Valaree', 'Gwynn', '91063211Q', '1995-02-14', 'female', '993 503 4412', '7238812932', '09015 Bunting Hill', 9),
(10, 'Valencia', 'Escot', '65074954H', '1983-09-02', 'female', '739 584 7995', '7614499972', '5594 Forest Dale Way', 9),
(11, 'Broddy', 'Claringbold', '32076209U', '1982-04-27', 'male', '111 209 4475', '7521764471', '34944 Browning Avenue', 9),
(12, 'Amabelle', 'Adair', '82674666A', '1993-05-19', 'female', '177 619 1454', '7664125820', '9565 Drewry Road', 6),
(13, 'Fraser', 'Bugg', '20554587A', '1990-07-06', 'male', '540 801 1766', '1642662216', '82222 Kenwood Parkway', 6),
(14, 'Chucho', 'Vass', '55046917B', '1987-09-22', 'male', '566 105 2094', '4290741959', '4 Tennessee Road', 6),
(15, 'Warde', 'Pashbee', '01757041C', '1981-01-13', 'male', '173 942 0155', '4814132034', '6 Westend Avenue', 3),
(16, 'Kathleen', 'Dufour', '55493369Z', '1986-03-05', 'female', '291 176 5712', '1439614490', '116 Rutledge Circle', 3),
(17, 'Arleyne', 'Philippon', '15796076B', '1989-04-14', 'female', '210 591 1749', '3021645623', '05313 Lighthouse Bay Crossing', 2),
(18, 'Ariel', 'Chestnut', '80364580R', '1994-10-10', 'female', '391 222 8203', '9629490072', '399 Lake View Place', 2),
(19, 'Hunter', 'Tilzey', '55522151S', '1983-12-20', 'male', '652 898 9526', '7670773782', '0 Bartelt Pass', 2),
(20, 'Carmela', 'McGettigan', '03597348D', '1992-05-03', 'female', '445 446 4827', '5996768291', '37 Kinsman Road', 2),
(21, 'Pepita', 'Doe', '45697832M', '1980-08-12', 'female', '695364785', '2369745184', 'Calle prueba 3, Malaga', 11),
(22, 'Maria', 'Doe', '58691234T', '1991-09-15', 'female', '654321985', '5698712364', 'Calle Prueba 4, Malaga', 13),
(23, 'Dolores', 'Doe', '48923675P', '1964-06-25', 'female', '956321756', '7589612365', 'Calle Prueba 5, Malaga', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_alergia`
--

CREATE TABLE `paciente_alergia` (
  `idPac` int(11) NOT NULL,
  `idAlergia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente_alergia`
--

INSERT INTO `paciente_alergia` (`idPac`, `idAlergia`) VALUES
(15, 1),
(22, 1),
(15, 2),
(16, 3),
(17, 4),
(17, 5),
(17, 6),
(18, 7),
(18, 8),
(19, 9),
(19, 10),
(20, 11),
(20, 12),
(23, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_diagnostico`
--

CREATE TABLE `paciente_diagnostico` (
  `idPac` int(11) NOT NULL,
  `idDiag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente_diagnostico`
--

INSERT INTO `paciente_diagnostico` (`idPac`, `idDiag`) VALUES
(1, 1),
(14, 1),
(22, 1),
(1, 2),
(14, 2),
(23, 2),
(2, 3),
(13, 3),
(3, 4),
(17, 4),
(22, 4),
(3, 5),
(16, 5),
(4, 6),
(5, 7),
(5, 8),
(6, 9),
(18, 9),
(7, 10),
(15, 10),
(23, 10),
(7, 11),
(16, 11),
(8, 12),
(9, 13),
(20, 13),
(9, 14),
(20, 14),
(10, 15),
(17, 15),
(11, 16),
(19, 16),
(11, 17),
(19, 17),
(12, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsu` int(11) NOT NULL,
  `nomUsu` varchar(100) NOT NULL,
  `apeUsu` varchar(100) NOT NULL,
  `emailUsu` varchar(100) NOT NULL,
  `claveUsu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsu`, `nomUsu`, `apeUsu`, `emailUsu`, `claveUsu`) VALUES
(1, 'Mordecai', 'Riddel', 'mriddel0@vistaprint.com', '935870df31376f4917c8d1a2ad6fd3e4'),
(2, 'Leshia', 'Curme', 'lcurme1@weather.com', '8336e6067f1af874cfa4fca98e1b3590'),
(3, 'Robenia', 'Bett', 'rbett2@pen.io', 'fac50baa8b7a639090b0f737389a1d21'),
(4, 'Roderick', 'Pates', 'rpates3@xinhuanet.com', '2dd30d1df11d6291f1dcc26bf14766da'),
(5, 'Maible', 'Fleckno', 'mfleckno4@umich.edu', '4b5e8aa5e9b0bac1c54b850a3e93b752'),
(6, 'Brad', 'Stedson', 'bstedson5@opensource.org', '4abf488c030233c3a5d7303e706fb9c6'),
(7, 'Renae', 'Snasdell', 'rsnasdell6@dailymail.co.uk', '325fe71fe27d9b6f4efc3cd321a9172f'),
(8, 'Stafani', 'Fallows', 'sfallows7@ft.com', '0e53ade4fa12c7410907280d8af04e80'),
(9, 'Ileane', 'Lavigne', 'ilavigne8@springer.com', '231c2c2ac72ee2be0887fd11a980502e'),
(10, 'Forbes', 'Bitten', 'fbitten9@wikia.com', '45555b0d28cccb657719fd7422150333'),
(11, 'Ruyi', 'Xia', 'ruyi@probando.com', 'e10adc3949ba59abbe56e057f20f883e'),
(12, 'pepito', 'marinero', 'pepito@marinero.com', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'Jonny', 'Doe', 'prueba@tcuida.com', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'Teresa', 'Doe', 'teresadoe@tcuida.com', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergia`
--
ALTER TABLE `alergia`
  ADD PRIMARY KEY (`idAlergia`);

--
-- Indices de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  ADD PRIMARY KEY (`idDiag`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`idEsp`);

--
-- Indices de la tabla `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`idMed`),
  ADD UNIQUE KEY `numColegiado` (`numColegiado`);

--
-- Indices de la tabla `medico_especialidad`
--
ALTER TABLE `medico_especialidad`
  ADD PRIMARY KEY (`idMed`,`idEsp`),
  ADD KEY `fk_especialidad-medico_especialidad` (`idEsp`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPac`),
  ADD UNIQUE KEY `numHistorialClinico` (`numHistoria`),
  ADD UNIQUE KEY `dniPac` (`dniPac`),
  ADD KEY `fk_medico-paciente` (`idMed`);

--
-- Indices de la tabla `paciente_alergia`
--
ALTER TABLE `paciente_alergia`
  ADD PRIMARY KEY (`idPac`,`idAlergia`),
  ADD KEY `fk_alergia-paciente_alergia` (`idAlergia`);

--
-- Indices de la tabla `paciente_diagnostico`
--
ALTER TABLE `paciente_diagnostico`
  ADD PRIMARY KEY (`idPac`,`idDiag`),
  ADD KEY `fk_diagnostico-paciente_diagnostico` (`idDiag`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergia`
--
ALTER TABLE `alergia`
  MODIFY `idAlergia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `diagnostico`
--
ALTER TABLE `diagnostico`
  MODIFY `idDiag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `idEsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `medico`
--
ALTER TABLE `medico`
  MODIFY `idMed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medico_especialidad`
--
ALTER TABLE `medico_especialidad`
  ADD CONSTRAINT `fk_especialidad-medico_especialidad` FOREIGN KEY (`idEsp`) REFERENCES `especialidad` (`idEsp`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medico-medico_especialidad` FOREIGN KEY (`idMed`) REFERENCES `medico` (`idMed`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_medico-paciente` FOREIGN KEY (`idMed`) REFERENCES `medico` (`idMed`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_alergia`
--
ALTER TABLE `paciente_alergia`
  ADD CONSTRAINT `fk_alergia-paciente_alergia` FOREIGN KEY (`idAlergia`) REFERENCES `alergia` (`idAlergia`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paciente-paciente_alergia` FOREIGN KEY (`idPac`) REFERENCES `paciente` (`idPac`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `paciente_diagnostico`
--
ALTER TABLE `paciente_diagnostico`
  ADD CONSTRAINT `fk_diagnostico-paciente_diagnostico` FOREIGN KEY (`idDiag`) REFERENCES `diagnostico` (`idDiag`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paciente-paciente_diagnostico` FOREIGN KEY (`idPac`) REFERENCES `paciente` (`idPac`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
