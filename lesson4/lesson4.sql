-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 26 2017 г., 07:54
-- Версия сервера: 10.1.22-MariaDB
-- Версия PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_goods` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `id_goods`, `quantity`, `id_order`) VALUES
(1, 12, 1, 1),
(2, 13, 12, 1),
(3, 10, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `address`) VALUES
(1, 'Вася', 79222222, 'г.Москва Большая Лубянка 38'),
(2, 'Петя', 7912999999, 'г.Сургут ул. 30 лет Победы д. 48'),
(6, 'Коля', 109223546468, 'Еще какой то адрес');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `good_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `good_name`, `price`) VALUES
(1, 'Товар 1', 1),
(2, 'Товар 2', 2),
(3, 'Товар 3', 3),
(4, 'Товар 4', 4),
(5, 'Товар 5', 5),
(6, 'Товар 6', 6),
(7, 'Товар 7', 7),
(8, 'Товар 8', 8),
(9, 'Товар 9', 9),
(10, 'Товар 10', 10),
(11, 'Товар 11', 11),
(12, 'Товар 12', 12),
(13, 'Товар 13', 13),
(14, 'Товар 14', 14),
(15, 'Товар 15', 15),
(16, 'Товар 16', 16),
(17, 'Товар 17', 17),
(18, 'Товар 18', 18),
(19, 'Товар 19', 19),
(20, 'Товар 20', 20),
(21, 'Товар 21', 21),
(22, 'Товар 22', 22),
(23, 'Товар 23', 23),
(24, 'Товар 24', 24),
(25, 'Товар 25', 25),
(26, 'Товар 26', 26),
(27, 'Товар 27', 27),
(28, 'Товар 28', 28),
(29, 'Товар 29', 29),
(30, 'Товар 30', 30),
(31, 'Товар 31', 31),
(32, 'Товар 32', 32),
(33, 'Товар 33', 33),
(34, 'Товар 34', 34),
(35, 'Товар 35', 35),
(36, 'Товар 36', 36),
(37, 'Товар 37', 37),
(38, 'Товар 38', 38),
(39, 'Товар 39', 39),
(40, 'Товар 40', 40),
(41, 'Товар 41', 41),
(42, 'Товар 42', 42),
(43, 'Товар 43', 43),
(44, 'Товар 44', 44),
(45, 'Товар 45', 45),
(46, 'Товар 46', 46),
(47, 'Товар 47', 47),
(48, 'Товар 48', 48),
(49, 'Товар 49', 49),
(50, 'Товар 50', 50),
(51, 'Товар 51', 51),
(52, 'Товар 52', 52),
(53, 'Товар 53', 53),
(54, 'Товар 54', 54),
(55, 'Товар 55', 55),
(56, 'Товар 56', 56),
(57, 'Товар 57', 57),
(58, 'Товар 58', 58),
(59, 'Товар 59', 59),
(60, 'Товар 60', 60),
(61, 'Товар 61', 61),
(62, 'Товар 62', 62),
(63, 'Товар 63', 63),
(64, 'Товар 64', 64),
(65, 'Товар 65', 65),
(66, 'Товар 66', 66),
(67, 'Товар 67', 67),
(68, 'Товар 68', 68),
(69, 'Товар 69', 69),
(70, 'Товар 70', 70),
(71, 'Товар 71', 71),
(72, 'Товар 72', 72),
(73, 'Товар 73', 73),
(74, 'Товар 74', 74),
(75, 'Товар 75', 75),
(76, 'Товар 76', 76),
(77, 'Товар 77', 77),
(78, 'Товар 78', 78),
(79, 'Товар 79', 79),
(80, 'Товар 80', 80),
(81, 'Товар 81', 81),
(82, 'Товар 82', 82),
(83, 'Товар 83', 83),
(84, 'Товар 84', 84),
(85, 'Товар 85', 85),
(86, 'Товар 86', 86),
(87, 'Товар 87', 87),
(88, 'Товар 88', 88),
(89, 'Товар 89', 89),
(90, 'Товар 90', 90),
(91, 'Товар 91', 91),
(92, 'Товар 92', 92),
(93, 'Товар 93', 93),
(94, 'Товар 94', 94),
(95, 'Товар 95', 95),
(96, 'Товар 96', 96),
(97, 'Товар 97', 97),
(98, 'Товар 98', 98),
(99, 'Товар 99', 99),
(100, 'Товар 100', 100),
(101, 'Товар 101', 101),
(102, 'Товар 102', 102),
(103, 'Товар 103', 103),
(104, 'Товар 104', 104),
(105, 'Товар 105', 105),
(106, 'Товар 106', 106),
(107, 'Товар 107', 107),
(108, 'Товар 108', 108),
(109, 'Товар 109', 109),
(110, 'Товар 110', 110);

-- --------------------------------------------------------

--
-- Структура таблицы `goods_description`
--

CREATE TABLE `goods_description` (
  `id` int(11) NOT NULL,
  `id_goods` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `goods_description`
--

INSERT INTO `goods_description` (`id`, `id_goods`, `description`) VALUES
(1, 1, 'Нечто 1'),
(2, 2, 'Нечто 2'),
(3, 3, 'Нечто 3'),
(4, 4, 'Нечто 4'),
(5, 5, 'Нечто 5'),
(6, 6, 'Нечто 6'),
(7, 7, 'Нечто 7'),
(8, 8, 'Нечто 8'),
(9, 9, 'Нечто 9'),
(10, 10, 'Нечто 10'),
(11, 11, 'Нечто 11'),
(12, 12, 'Нечто 12'),
(13, 13, 'Нечто 13'),
(14, 14, 'Нечто 14'),
(15, 15, 'Нечто 15'),
(16, 16, 'Нечто 16'),
(17, 17, 'Нечто 17'),
(18, 18, 'Нечто 18'),
(19, 19, 'Нечто 19'),
(20, 20, 'Нечто 20'),
(21, 21, 'Нечто 21'),
(22, 22, 'Нечто 22'),
(23, 23, 'Нечто 23'),
(24, 24, 'Нечто 24'),
(25, 25, 'Нечто 25'),
(26, 26, 'Нечто 26'),
(27, 27, 'Нечто 27'),
(28, 28, 'Нечто 28'),
(29, 29, 'Нечто 29'),
(30, 30, 'Нечто 30'),
(31, 31, 'Нечто 31'),
(32, 32, 'Нечто 32'),
(33, 33, 'Нечто 33'),
(34, 34, 'Нечто 34'),
(35, 35, 'Нечто 35'),
(36, 36, 'Нечто 36'),
(37, 37, 'Нечто 37'),
(38, 38, 'Нечто 38'),
(39, 39, 'Нечто 39'),
(40, 40, 'Нечто 40'),
(41, 41, 'Нечто 41'),
(42, 42, 'Нечто 42'),
(43, 43, 'Нечто 43'),
(44, 44, 'Нечто 44'),
(45, 45, 'Нечто 45'),
(46, 46, 'Нечто 46'),
(47, 47, 'Нечто 47'),
(48, 48, 'Нечто 48'),
(49, 49, 'Нечто 49'),
(50, 50, 'Нечто 50'),
(51, 51, 'Нечто 51'),
(52, 52, 'Нечто 52'),
(53, 53, 'Нечто 53'),
(54, 54, 'Нечто 54'),
(55, 55, 'Нечто 55'),
(56, 56, 'Нечто 56'),
(57, 57, 'Нечто 57'),
(58, 58, 'Нечто 58'),
(59, 59, 'Нечто 59'),
(60, 60, 'Нечто 60'),
(61, 61, 'Нечто 61'),
(62, 62, 'Нечто 62'),
(63, 63, 'Нечто 63'),
(64, 64, 'Нечто 64'),
(65, 65, 'Нечто 65'),
(66, 66, 'Нечто 66'),
(67, 67, 'Нечто 67'),
(68, 68, 'Нечто 68'),
(69, 69, 'Нечто 69'),
(70, 70, 'Нечто 70'),
(71, 71, 'Нечто 71'),
(72, 72, 'Нечто 72'),
(73, 73, 'Нечто 73'),
(74, 74, 'Нечто 74'),
(75, 75, 'Нечто 75'),
(76, 76, 'Нечто 76'),
(77, 77, 'Нечто 77'),
(78, 78, 'Нечто 78'),
(79, 79, 'Нечто 79'),
(80, 80, 'Нечто 80'),
(81, 81, 'Нечто 81'),
(82, 82, 'Нечто 82'),
(83, 83, 'Нечто 83'),
(84, 84, 'Нечто 84'),
(85, 85, 'Нечто 85'),
(86, 86, 'Нечто 86'),
(87, 87, 'Нечто 87'),
(88, 88, 'Нечто 88'),
(89, 89, 'Нечто 89'),
(90, 90, 'Нечто 90'),
(91, 91, 'Нечто 91'),
(92, 92, 'Нечто 92'),
(93, 93, 'Нечто 93'),
(94, 94, 'Нечто 94'),
(95, 95, 'Нечто 95'),
(96, 96, 'Нечто 96'),
(97, 97, 'Нечто 97'),
(98, 98, 'Нечто 98'),
(99, 99, 'Нечто 99'),
(100, 100, 'Нечто 100'),
(101, 101, 'Нечто 101'),
(102, 102, 'Нечто 102'),
(103, 103, 'Нечто 103'),
(104, 104, 'Нечто 104'),
(105, 105, 'Нечто 105'),
(106, 106, 'Нечто 106'),
(107, 107, 'Нечто 107'),
(108, 108, 'Нечто 108');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `checked` tinyint(1) NOT NULL,
  `shipped` tinyint(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_client`, `checked`, `shipped`, `date`) VALUES
(1, 1, 0, 0, '2017-06-01'),
(3, 2, 0, 0, '2017-06-02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `basket_ibfk_1` (`id_goods`),
  ADD KEY `id_order` (`id_order`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods_description`
--
ALTER TABLE `goods_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_goods` (`id_goods`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT для таблицы `goods_description`
--
ALTER TABLE `goods_description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`id_goods`) REFERENCES `goods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `goods_description`
--
ALTER TABLE `goods_description`
  ADD CONSTRAINT `goods_description_ibfk_1` FOREIGN KEY (`id_goods`) REFERENCES `goods` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
