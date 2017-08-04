-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.22-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп данных таблицы lesson7.basket: ~26 rows (приблизительно)
DELETE FROM `basket`;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` (`id`, `id_order`, `id_user`, `id_product`, `product_price`, `datetime_insert`) VALUES
	(3, 2, 1, 2, 250, '2017-07-03 21:24:33'),
	(74, 18, 1, 2, 250, '2017-07-29 18:34:57'),
	(75, 18, 1, 3, 250, '2017-07-29 18:37:07'),
	(76, 18, 1, 5, 200, '2017-07-29 18:37:12'),
	(77, 18, 1, 5, 200, '2017-07-29 18:37:18'),
	(83, 24, 1, 3, 250, '2017-07-29 20:06:09'),
	(84, 24, 1, 5, 200, '2017-07-29 20:06:20'),
	(87, 24, 1, 3, 250, '2017-07-29 20:21:53'),
	(88, 24, 1, 6, 200, '2017-07-29 20:23:14'),
	(89, 24, 1, 2, 250, '2017-07-29 20:24:54'),
	(90, 24, 1, 6, 200, '2017-07-29 20:25:50'),
	(91, 25, 1, 6, 200, '2017-07-29 20:27:11'),
	(92, 25, 1, 2, 250, '2017-07-29 20:27:16'),
	(94, 26, 1, 5, 200, '2017-07-29 20:31:02'),
	(96, 26, 1, 3, 250, '2017-07-29 20:32:02'),
	(101, 27, 1, 6, 200, '2017-07-29 20:49:06'),
	(102, 28, 1, 6, 200, '2017-07-29 21:08:12'),
	(103, 28, 1, 2, 250, '2017-07-29 21:08:18'),
	(104, 29, 1, 5, 200, '2017-07-29 21:12:34'),
	(105, 29, 1, 5, 200, '2017-07-29 21:12:38'),
	(106, 29, 1, 6, 200, '2017-07-29 21:12:42'),
	(107, 34, 1, 5, 200, '2017-07-29 21:14:02'),
	(108, 30, 2, 6, 200, '2017-07-29 21:14:53'),
	(109, 31, 2, 2, 250, '2017-07-29 21:21:42'),
	(112, 32, 2, 5, 200, '2017-07-29 21:31:55'),
	(116, 33, 2, 48, 100, '2017-08-03 20:37:43'),
	(117, 33, 2, 49, 100, '2017-08-03 20:37:51');
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.categories: ~6 rows (приблизительно)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`, `id_parent_category`) VALUES
	(1, 'Каталог продуктов', 0),
	(2, 'Обувь', 1),
	(3, 'Одежда', 1),
	(4, 'Аксессуары', 1),
	(5, 'Ботинки мужские', 2),
	(6, 'Ботинки женские', 2);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.orders: ~13 rows (приблизительно)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `id_user`, `datetime_create`, `datetime_update`, `amount`, `id_order_status`) VALUES
	(2, 1, '2017-07-03 21:24:56', '2017-08-03 18:07:36', 250, 4),
	(18, 1, '2017-07-29 18:37:25', '2017-08-01 18:40:27', 900, 4),
	(24, 1, '2017-07-29 20:21:40', '2017-07-29 20:27:02', 1350, 5),
	(25, 1, '2017-07-29 20:27:19', '2017-07-29 20:28:18', 450, 5),
	(26, 1, '2017-07-29 20:31:04', '2017-07-29 20:42:45', 450, 5),
	(27, 1, '2017-07-29 20:43:10', '2017-07-29 20:57:13', 450, 5),
	(28, 1, '2017-07-29 21:08:31', '2017-07-29 21:12:20', 450, 5),
	(29, 1, '2017-07-29 21:13:07', '2017-07-29 21:13:14', 600, 2),
	(30, 2, '2017-07-29 21:14:21', '2017-07-29 21:21:25', 650, 5),
	(31, 2, '2017-07-29 21:21:53', '2017-07-29 21:31:40', 250, 5),
	(32, 2, '2017-07-29 21:31:57', '2017-08-01 18:24:11', 200, 4),
	(33, 2, '2017-07-29 21:32:25', '2017-08-03 20:38:18', 200, 3),
	(34, 1, '2017-07-29 21:40:47', '2017-07-29 21:41:15', 200, 1);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.order_statuses: ~5 rows (приблизительно)
DELETE FROM `order_statuses`;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` (`id`, `status_name`) VALUES
	(1, 'Новый'),
	(2, 'Оформлен'),
	(3, 'Оплачен'),
	(4, 'Доставлен'),
	(5, 'Удалён');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.products: ~6 rows (приблизительно)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `product_name`, `product_sku`, `id_parent_product`, `product_price`, `deleted`) VALUES
	(1, 'Ботинки', 100000, NULL, 250, NULL),
	(2, 'Ботинки, размер 42, черные', 100000001, 1, 250, NULL),
	(3, 'Ботинки, размер 43, черные', 100000002, 1, 250, NULL),
	(4, 'Кеды', 100001, NULL, 200, NULL),
	(5, 'Кеды, размер 41, белые', 100001001, 4, 200, NULL),
	(6, 'Кеды, размер 42, синие', 100001002, 4, 200, NULL),
	(35, 'Сапоги', 100002, NULL, 111, '2017-08-03 20:30:45'),
	(46, 'Боты шмоты', 100000003, 1, 121, '2017-08-03 20:30:41'),
	(47, 'Галоши меховые', 100003, NULL, 100, NULL),
	(48, 'галоша правая дырявая', 100003001, 47, 100, NULL),
	(49, 'галоша левая рваная', 100003002, 47, 100, NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.product_properties: ~4 rows (приблизительно)
DELETE FROM `product_properties`;
/*!40000 ALTER TABLE `product_properties` DISABLE KEYS */;
INSERT INTO `product_properties` (`id`, `product_property_name`) VALUES
	(1, 'Photo'),
	(2, 'Size'),
	(3, 'Color'),
	(4, 'Categories');
/*!40000 ALTER TABLE `product_properties` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.product_properties_values: ~17 rows (приблизительно)
DELETE FROM `product_properties_values`;
/*!40000 ALTER TABLE `product_properties_values` DISABLE KEYS */;
INSERT INTO `product_properties_values` (`id`, `id_product`, `id_property`, `property_value`) VALUES
	(1, 1, 1, 'picture.png'),
	(2, 1, 1, 'picture2.png'),
	(3, 2, 1, 'picture3.png'),
	(4, 2, 2, '42'),
	(5, 2, 3, '#000'),
	(6, 1, 4, '5'),
	(8, 4, 1, 'picture12.png'),
	(9, 4, 4, '2'),
	(10, 2, 1, 'picture999.png'),
	(11, 5, 2, '41'),
	(12, 5, 3, 'white'),
	(13, 6, 3, 'blue'),
	(14, 6, 2, '42'),
	(15, 6, 1, 'picture11.png'),
	(16, 6, 1, 'picture123.png'),
	(17, 5, 1, 'picture124.png'),
	(18, 5, 1, 'picture125.png'),
	(37, 46, 1, 'мартинка.jpg'),
	(38, 46, 2, '12'),
	(39, 46, 3, 'крови'),
	(40, 48, 1, 'шмартинка.jpg'),
	(41, 48, 2, '48'),
	(42, 48, 3, 'болотный'),
	(43, 49, 1, 'шмартинка2.jpg'),
	(44, 49, 2, '12'),
	(45, 49, 3, 'болотный');
/*!40000 ALTER TABLE `product_properties_values` ENABLE KEYS */;

-- Дамп данных таблицы lesson7.users: ~2 rows (приблизительно)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `email`, `hash_pass`, `is_admin`) VALUES
	(1, 'Админ', 'Админ', NULL, 'admin@gb.local', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1),
	(2, 'Пользователь', 'Пользователь', NULL, 'user@gb.local', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
