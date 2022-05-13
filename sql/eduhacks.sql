-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2022 a las 08:46:17
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eduhacks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_pertany`
--

CREATE TABLE `categoria_pertany` (
  `idctf` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria_pertany`
--

INSERT INTO `categoria_pertany` (`idctf`, `idcategoria`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 8),
(4, 9),
(5, 10),
(5, 9),
(6, 11),
(7, 2),
(8, 12),
(8, 2),
(9, 13),
(9, 2),
(10, 2),
(11, 2),
(11, 14),
(12, 13),
(12, 15),
(12, 16),
(13, 17),
(13, 18),
(13, 19),
(14, 2),
(14, 7),
(14, 20),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 12),
(17, 21),
(18, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `idcategoria` int(11) NOT NULL,
  `nom_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`idcategoria`, `nom_categoria`) VALUES
(1, 'osint'),
(2, 'alvic'),
(3, 'criptografia'),
(4, 'plaintext'),
(5, 'tryhackme'),
(6, 'sample'),
(7, 'hacking'),
(8, 'comandos'),
(9, 'python'),
(10, 'si'),
(11, 'catalans'),
(12, 'hola'),
(13, 'llorca'),
(14, 'aaa'),
(15, 'exemple'),
(16, 'ctf'),
(17, 'php'),
(18, 'gon'),
(19, 'aprovat'),
(20, 'facilito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `completarctf`
--

CREATE TABLE `completarctf` (
  `idctf` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `AchieveDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `completarctf`
--

INSERT INTO `completarctf` (`idctf`, `iduser`, `AchieveDate`) VALUES
(4, 13, '2022-04-21 23:39:42'),
(4, 12, '2022-04-21 23:39:43'),
(3, 13, '2022-04-21 23:39:47'),
(3, 12, '2022-04-21 23:39:49'),
(4, 14, '2022-04-22 18:55:38'),
(3, 14, '2022-04-22 18:55:44'),
(2, 14, '2022-04-22 18:55:51'),
(1, 14, '2022-04-22 18:55:58'),
(5, 14, '2022-04-22 18:58:01'),
(6, 14, '2022-04-22 18:59:00'),
(11, 12, '2022-04-30 20:27:49'),
(11, 13, '2022-05-04 20:32:31'),
(9, 13, '2022-05-04 20:34:40'),
(1, 13, '2022-05-04 21:07:36'),
(12, 13, '2022-05-04 21:08:41'),
(7, 13, '2022-05-05 08:30:09'),
(13, 13, '2022-05-07 16:02:11'),
(10, 13, '2022-05-07 16:02:49'),
(8, 13, '2022-05-07 16:02:55'),
(6, 13, '2022-05-07 16:03:11'),
(5, 13, '2022-05-07 16:03:25'),
(2, 13, '2022-05-07 16:03:33'),
(14, 13, '2022-05-07 17:13:02'),
(14, 16, '2022-05-07 17:57:09'),
(16, 13, '2022-05-07 19:03:34'),
(15, 13, '2022-05-07 19:03:41'),
(18, 17, '2022-05-07 20:13:07'),
(18, 13, '2022-05-12 10:52:25'),
(17, 13, '2022-05-12 10:52:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctf`
--

CREATE TABLE `ctf` (
  `idctf` int(11) NOT NULL,
  `titol` varchar(50) DEFAULT NULL,
  `descripcio` varchar(255) DEFAULT NULL,
  `dataPublicacio` datetime DEFAULT NULL,
  `fitxerPath` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `puntuacio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ctf`
--

INSERT INTO `ctf` (`idctf`, `titol`, `descripcio`, `dataPublicacio`, `fitxerPath`, `flag`, `iduser`, `puntuacio`) VALUES
(1, 'OSINT a algu de ALVIC', 'Necessitem conseguir el nom duna persona amb la que el gon havia treballat, PISTA: treballa a alvic.', '2022-04-21 23:34:34', NULL, '$2y$10$UDEDVkYuo2O0dTxR71S9/ummpJuRGbFVWFC8ErSMLJa6VD1Ftgjra', 13, 20),
(2, 'Criptografia', 'Our Cryptography challenges have historically been paper-and-pencil options, requiring less raw, technical skill to complete. The category is meant to be a more approachable option for participants who favor puzzles instead of hacking or coding. The examp', '2022-04-21 23:35:03', NULL, '$2y$10$UFC5RtNtM/6ovI/gzYtJuOPtMNlUdOojU.234z359fcOachXojwzq', 12, 5),
(3, 'CTF Tryhackme', 'In CTF competitions, the flag is typically a snippet of code, a piece of hardware on a network, or perhaps a file. In other cases, the competition may progress through a series of questions, like a race.', '2022-04-21 23:36:50', '../CTF_files/CTF_file_3.png', '$2y$10$O97F7cHQr/xKFCL2CjjazeV5Q5kuxMNsA5EqdW714Rf57aO.un/e6', 13, 20),
(4, 'Inyección de comandos', 'Command Injection is a vulnerability that allows an attacker to submit system commands to a computer running a website. This happens when the application fails to encode user input that goes into a system shell. It is very common to see this vulnerability', '2022-04-21 23:37:40', '../CTF_files/CTF_file_4.png', '$2y$10$qH2p6q21psAL6Ymi4xLXcekZW2XP7wG2yyebCkfXnbAnLuU2QzLem', 12, 5),
(5, 'exemple', 'tot aixo es python', '2022-04-22 18:57:45', '../CTF_files/CTF_file_5.txt', '$2y$10$YOe8ZZfe5vMrBhZnkNscWOcuEuzltY9nC01DJ1o1VI6ongVqTmcNG', 14, 20),
(6, 'exempl2', 'patata', '2022-04-22 18:58:22', NULL, '$2y$10$iumoGTnEAn7MxS05CNVm0.4B3SKSx01Ggs.2QGI0AMWJ70OiaJiKW', 14, 5),
(7, 'prueba', 'aaa', '2022-04-29 12:39:58', NULL, '$2y$10$clYtJn44NxagasK6Hf.n4.i5IqT/J/ffT2B/vyxSIa5log1xGo.pC', 12, 5),
(8, 'prueba2', 'hola', '2022-04-30 19:55:35', NULL, '$2y$10$NVeNfZhqeQvmw85uj86tJu0G02x2CHPSUnmwb6Bs1oONGdZVHCIle', 12, 5),
(9, 'titol', 'descripcio', '2022-04-30 20:03:25', NULL, '$2y$10$Cre01DYYYHE1MzgnltRgFu1kxQSD3MP2yXe9T2poI/RWW2kYgUrTy', 13, 12),
(10, 'alvic', 'alvic', '2022-04-30 20:27:00', NULL, '$2y$10$iZ1geJNVMwd6m6hEqw4rJuEU.vM0gdENOgVJ8IVSwxZXIWYo1qz0O', 13, 12),
(11, 'alvicprueba', 'aaaaa', '2022-04-30 20:27:10', NULL, '$2y$10$OXN31P.ZuiEYsk5ANGnV8u8XkngEqTR4uUUGKOgfMR1Qej735Fcw2', 12, 5),
(12, 'OSINT a algu de ALVIC', 'Necessitem conseguir el nom duna persona amb la que el gon havia treballat, PISTA: treballa a alvic.', '2022-05-04 21:08:34', NULL, '$2y$10$1fDil4q7ZIj73yQJS4boquOmG4h30fC01fiK7OnUXxKzwTavtIjOW', 13, 13),
(13, 'PresentacioPHP', 'PHP Benvinguts', '2022-05-07 16:01:54', '../CTF_files/CTF_file_13.png', '$2y$10$bzJfe8INSjXr89.C/nzeze2EOJa0WNhHFGJA48t0i7Ns8beesZXnS', 13, 5),
(14, 'OSINT a algu de ALVIC', 'Necessitem conseguir el nom duna persona amb la que el gon havia treballat, PISTA: treballa a alvic.', '2022-05-07 17:12:43', NULL, '$2y$10$gdsoLczBJVyRICPpSQAI1.tQqPtll3T0VAxOhyIlC7RIDGRDXBHyS', 13, 20),
(15, 'OSINT a algu de ALVIC', 'descripcio', '2022-05-07 18:59:29', NULL, '$2y$10$36Uh63s9uSvtJUqNnpMx2uyUCd.pTjXsKn85y9/QDW8XiWXxGE9hW', 13, 12),
(16, 'OSINT a algu de ALVIC', 'Necessitem conseguir el nom duna persona amb la que el gon havia treballat, PISTA: treballa a alvic.', '2022-05-07 19:00:08', NULL, '$2y$10$iUobSGWwyVclt27waQM.CONRnt6UaRsdAGhBvFmVVjhRPOskqruJ6', 13, 12),
(17, 'titol2', 'descrpcio2', '2022-05-07 19:04:39', NULL, '$2y$10$5yLhk0Ijr1oi5BW5V4NI6ue.GDUtqnHWRMdLOUpTHMNeuPnSIq7OO', 12, 5),
(18, 'titol2', 'descrpcio2', '2022-05-07 19:05:19', NULL, '$2y$10$oVh5xo48.3uq5k7OsAY.z.ivV1f3IG9lPWDrb/OaBPqgx1gFCLg.i', 12, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacio`
--

CREATE TABLE `puntuacio` (
  `iduser` int(11) NOT NULL,
  `nom_user` varchar(100) NOT NULL,
  `puntuacio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntuacio`
--

INSERT INTO `puntuacio` (`iduser`, `nom_user`, `puntuacio`) VALUES
(12, 'sebi', 30),
(13, 'llorca', 186),
(14, 'guillem', 75),
(16, 'ethernaldribba', 20),
(17, 'llorca123', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `passHash` varchar(60) DEFAULT NULL,
  `userFirstName` varchar(60) DEFAULT NULL,
  `userLastName` varchar(120) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `activationDate` datetime DEFAULT NULL,
  `removeDate` datetime DEFAULT NULL,
  `lastSignIn` datetime DEFAULT NULL,
  `activationCode` char(64) DEFAULT NULL,
  `resetPassCode` char(64) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `expireDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `mail`, `username`, `passHash`, `userFirstName`, `userLastName`, `creationDate`, `activationDate`, `removeDate`, `lastSignIn`, `activationCode`, `resetPassCode`, `active`, `expireDate`) VALUES
(11, 'marcllorlor5@gmail.com', 'llorca2', '$2y$10$okE/h8Z./yMTZ6DiuRv87uChHa8DWtINRHXcOTIpIq.W7fvVmaalO', 'Marc', 'Llorca', '2022-02-04 13:04:41', '2022-02-04 13:04:52', NULL, '2022-02-04 13:05:49', '3c02f33c1807ee009cfce50c8e593d18c539d78ab5648b597ce10f8ea6b419a0', '0a3167342805ed00b0adb928af78fe578444307edcdc36bd3ee2119cf9d29c05', 1, '2022-05-07 17:57:21'),
(12, 'e.melendo@hotmail.com', 'sebi', '$2y$10$/p6U4SpYPCas4h53zf5ujuJebwDhQ4nRP3UYGVCjlX0.mGF4Af4Ki', '', '', '2022-02-11 12:52:09', '2022-02-11 12:52:50', NULL, '2022-05-13 08:18:36', '4a503792448e00e07bb3ee7af065d3a7a564c85bb24586a0940945d93cbf96f9', 'f45cc2aea239eadfdb3636e2c82ce828061ab3e49155632ac4b55496957d1ea7', 1, '2022-04-21 20:18:00'),
(13, 'marcllorlor@gmail.com', 'llorca', '$2y$10$m7SIyzjqG8efYXDLDtSJp.j5Dy/nWR3YQ/yalMqqsr9yAnw.yIHuC', 'marc', 'llorca', '2022-02-17 20:02:12', '2022-02-17 20:02:19', NULL, '2022-05-12 18:39:18', '5c9fddd0927840bb9be7754f8819ad0076e2931999b3e262171a1807df0af35c', '60de9320c3076722e020ce46429b80883ac6b32e91ca1002e626abcfe55f3ab5', 1, '2022-05-07 15:56:57'),
(14, 'marc.llorcal@educem.net', 'guillem', '$2y$10$3jmp5qDuXPBK0rXosgIa1eKu5xgeFImkwT188hrnCJ1hTKiMVt/c.', 'Guillem', 'Moratalla', '2022-04-22 12:51:13', '2022-04-22 12:51:33', NULL, '2022-04-22 18:55:28', 'e76ff9d0b24c03d659a19156b78ba333d60c1cf810bf1f73d25cbff0ff2b9598', '05987f3356d13b7dc3b146b423ed04312a828b0efa15959061508a21a2605375', 1, NULL),
(16, 'ethernaldribba@gmail.com', 'ethernaldribba', '$2y$10$9f3Af1IDmT4sTtEHWUEWfu4gmAMqpDCb3jU/EbFsprzsvV2MAx1O6', 'alex', 'tarrega', '2022-05-07 17:56:50', '2022-05-07 17:56:57', NULL, '2022-05-07 17:57:05', 'c3d7f1e7382f29423a846c5567d9a19105a53a529e4187a6d172ef1cacc34878', 'cd247af94ef8c47a6474d5242b569897c0361f4109bae369112767d30a50e521', 1, NULL),
(17, 'marcllorlor123@gmail.com', 'llorca123', '$2y$10$DmsZLNNqiGWA3mKuL1.JlezNEfnD34ILT4Wb9fp/gaA8fzFMYRLY6', '1231', '3', '2022-05-07 20:12:24', '2022-05-07 20:12:51', NULL, '2022-05-07 20:13:01', '93027c6206e936e806db2ce7c3cd76eec73adcd9d1d6e3b44514d511e1a377d4', '97602329e13447b88527f054c8b473f0b83c2d16e83389020ad6fb9721cd3661', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `ctf`
--
ALTER TABLE `ctf`
  ADD PRIMARY KEY (`idctf`);

--
-- Indices de la tabla `puntuacio`
--
ALTER TABLE `puntuacio`
  ADD PRIMARY KEY (`iduser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `ctf`
--
ALTER TABLE `ctf`
  MODIFY `idctf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
