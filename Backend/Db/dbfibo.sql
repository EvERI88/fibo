-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 24 2025 г., 09:20
-- Версия сервера: 8.0.41
-- Версия PHP: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fibo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'Паста', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(2, 'Пицца', 1, '2025-03-12 05:10:54', '2025-03-12 05:10:54'),
(3, 'Бургеры', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(4, 'Cупы', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(5, 'Салаты', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(6, 'Напитки', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(7, 'Десерты', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(8, 'Супы', 1, '2025-03-07 05:24:55', '2025-03-07 05:24:55'),
(9, 'Акции', 1, '2025-03-07 05:24:56', '2025-03-07 05:24:56'),
(10, 'Комбо', 1, '2025-03-11 12:15:35', '2025-03-11 12:15:35'),
(14, 'Комбос', 0, '2025-03-10 23:34:44', '2025-03-10 23:37:35'),
(15, 'Комбооо', 0, '2025-03-10 23:36:38', '2025-03-10 23:36:38');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `number` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `products` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `selected_time` text NOT NULL,
  `price` int NOT NULL,
  `method_pay` text NOT NULL,
  `report_bonus` tinyint(1) NOT NULL,
  `without_change` tinyint(1) NOT NULL,
  `name` text NOT NULL,
  `change_money` int NOT NULL,
  `updated_at` timestamp NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `promo_code_id` int NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `number`, `user_id`, `address`, `products`, `selected_time`, `price`, `method_pay`, `report_bonus`, `without_change`, `name`, `change_money`, `updated_at`, `is_active`, `promo_code_id`) VALUES
(9, '7600', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 1, 0, 'Valery', 0, '2025-03-24 02:00:46', 1, 3),
(10, '2178', 9, 'Адрес - Блюхера\nДом - 12\nНомер квартиры - 123\nПодъезд - 12313\nНаличие домофона - 2131\nЭтаж - 123\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1 / id: 3 name: Спагетти quantity: 1 / id: 6 name: рожочки quantity: 1 / id: 7 name: рожочки quantity: 1', 'Побыстрее', 0, 'cash', 0, 0, 'Valery', 0, '2025-03-24 02:01:45', 1, 2),
(11, '3973', 9, 'Адрес - fhgddgfh\nДом - 56\nНомер квартиры - 56\nПодъезд - 56\nНаличие домофона - 56\nЭтаж - 56\nКомментарий - \n  ', 'id: 7 name: рожочки quantity: 1', 'Побыстрее', 0, 'cash', 0, 0, 'Valery', 0, '2025-03-24 02:13:03', 1, 2),
(12, '3872', 9, 'Адрес - 465456\nДом - 56\nНомер квартиры - 56\nПодъезд - 56\nНаличие домофона - 56\nЭтаж - 56\nКомментарий - \n  ', 'id: 6 name: рожочки quantity: 1 / id: 7 name: рожочки quantity: 1', 'Побыстрее', 0, 'cash', 0, 0, 'Valery', 0, '2025-03-24 02:24:27', 1, 2),
(13, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:36:03', 1, 1),
(14, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:36:18', 1, 2),
(15, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:37:49', 1, 2),
(16, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:48:53', 1, 2),
(17, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:49:39', 1, 1),
(18, '4444', 9, 'Адрес - 5656868\nДом - 7676\nНомер квартиры - 7676\nПодъезд - 67\nНаличие домофона - 67\nЭтаж - 67\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1', 'Побыстрее', 4, 'cash', 0, 1, 'Valery', 0, '2025-03-24 02:49:56', 1, 2),
(19, '8238', 9, 'Адрес - Блюхера\nДом - 77\nНомер квартиры - 7\nПодъезд - 77\nНаличие домофона - 7\nЭтаж - 77\nКомментарий - \n  ', 'id: 1 name: Песто quantity: 1 / id: 3 name: Спагетти quantity: 1 / id: 6 name: рожочки quantity: 1', 'Побыстрее', 0, 'cash', 0, 0, 'Valery', 0, '2025-03-24 02:52:17', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `is_new`, `description`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Песто', 4, 'none', 1, 'песто', '2025-03-06 07:09:39', '2025-03-06 07:09:39', 1),
(3, 'Спагетти', 100, 'none', 0, 'Итальянское название длинной тонкой прямой вермишели, нитевидных макаронных изделий длиной до 50—75 см и диаметром около 2 мм', '2025-03-06 07:10:21', '2025-03-07 03:41:53', 1),
(4, 'Пепперони', 100, 'none', 1, 'Чтобы понять, насколько острой может быть итальянская пицца пепперони, достаточно узнать ее второе имя – «Дьявольская пицца». В нее, помимо острой колбаски, добавляют шампиньоны и сыр моцарелла', '2025-03-06 07:11:13', '2025-03-06 07:11:13', 2),
(5, 'Маргарита', 100, 'none', 1, 'традиционная итальянская пицца, пожалуй, самая популярная в мире, даже меню любой пиццерии начинается, как правило, именно с неё', '2025-03-06 07:11:46', '2025-03-06 07:11:46', 2),
(6, 'рожочки', 100, 'images/products/ьуь.jpg', 0, 'Итальянское название длинной тонкой прямой вермишели, нитевидных макаронных изделий длиной до 50—75 см и диаметром около 2 мм', '2025-03-06 07:13:25', '2025-03-10 05:25:11', 1),
(7, 'рожочки', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 0, 'Итальянское название длинной тонкой прямой вермишели, нитевидных макаронных изделий длиной до 50—75 см и диаметром около 2 мм', '2025-03-06 23:57:14', '2025-03-11 04:18:07', 1),
(8, 'Рожки', 1000000, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-07 01:41:50', '2025-03-07 01:41:50', 1),
(9, 'Рожки', 1000000, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-07 03:42:16', '2025-03-07 03:42:16', 1),
(17, 'Мак', 1000000, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-07 03:56:02', '2025-03-07 03:56:02', 1),
(18, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 04:34:28', '2025-03-10 04:34:28', 1),
(19, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 04:35:02', '2025-03-10 04:35:02', 1),
(22, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 04:37:08', '2025-03-10 04:37:08', 1),
(23, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 04:43:16', '2025-03-10 04:43:16', 1),
(24, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:02:25', '2025-03-10 06:02:25', 1),
(25, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:02:35', '2025-03-10 06:02:35', 1),
(26, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:03:31', '2025-03-10 06:03:31', 1),
(27, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:05:23', '2025-03-10 06:05:23', 1),
(28, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:06:35', '2025-03-10 06:06:35', 1),
(29, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:06:49', '2025-03-10 06:06:49', 1),
(30, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:07:08', '2025-03-10 06:07:08', 1),
(31, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:07:39', '2025-03-10 06:07:39', 1),
(32, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:07:40', '2025-03-10 06:07:40', 1),
(33, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:07:43', '2025-03-10 06:07:43', 1),
(34, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:17:45', '2025-03-10 06:17:45', 1),
(35, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:18:02', '2025-03-10 06:18:02', 1),
(36, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:18:04', '2025-03-10 06:18:04', 1),
(37, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:18:13', '2025-03-10 06:18:13', 1),
(38, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:19:14', '2025-03-10 06:19:14', 1),
(39, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:22:54', '2025-03-10 06:22:54', 1),
(40, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:26:32', '2025-03-10 06:26:32', 1),
(41, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:26:42', '2025-03-10 06:26:42', 1),
(42, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:26:48', '2025-03-10 06:26:48', 1),
(43, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:31:14', '2025-03-10 06:31:14', 1),
(44, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:31:40', '2025-03-10 06:31:40', 1),
(45, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:31:45', '2025-03-10 06:31:45', 1),
(46, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:32:01', '2025-03-10 06:32:01', 1),
(47, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:32:18', '2025-03-10 06:32:18', 1),
(48, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:32:27', '2025-03-10 06:32:27', 1),
(49, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:32:50', '2025-03-10 06:32:50', 1),
(50, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:33:10', '2025-03-10 06:33:10', 1),
(51, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:46:57', '2025-03-10 06:46:57', 1),
(52, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:48:09', '2025-03-10 06:48:09', 1),
(53, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:49:40', '2025-03-10 06:49:40', 1),
(54, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:49:52', '2025-03-10 06:49:52', 1),
(55, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:51:00', '2025-03-10 06:51:00', 1),
(56, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 06:54:23', '2025-03-10 06:54:23', 1),
(57, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:03:09', '2025-03-10 07:03:09', 1),
(58, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:34:08', '2025-03-10 07:34:08', 1),
(59, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:35:43', '2025-03-10 07:35:43', 1),
(60, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:35:46', '2025-03-10 07:35:46', 1),
(61, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:37:06', '2025-03-10 07:37:06', 1),
(62, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 07:39:08', '2025-03-10 07:39:08', 1),
(64, 'adsassad', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-10 22:56:58', '2025-03-10 22:56:58', 1),
(65, '3536455433', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-10 22:59:07', '2025-03-10 22:59:07', 1),
(66, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 23:03:36', '2025-03-10 23:03:36', 1),
(67, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-10 23:10:12', '2025-03-10 23:10:12', 1),
(68, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 00:35:17', '2025-03-11 00:35:17', 1),
(69, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 00:51:36', '2025-03-11 00:51:36', 1),
(70, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 00:52:24', '2025-03-11 00:52:24', 1),
(71, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 00:52:47', '2025-03-11 00:52:47', 1),
(72, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 00:53:13', '2025-03-11 00:53:13', 1),
(73, 'adsassad', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 01:05:02', '2025-03-11 01:05:02', 1),
(74, '3536455433', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:42:36', '2025-03-11 01:42:36', 1),
(75, '3536455433', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:42:57', '2025-03-11 01:42:57', 1),
(76, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:44:39', '2025-03-11 01:44:39', 1),
(77, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:46:00', '2025-03-11 01:46:00', 1),
(78, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:46:50', '2025-03-11 01:46:50', 1),
(79, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:47:10', '2025-03-11 01:47:10', 1),
(80, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:47:18', '2025-03-11 01:47:18', 1),
(81, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:47:42', '2025-03-11 01:47:42', 1),
(82, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:49:54', '2025-03-11 01:49:54', 1),
(83, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:50:57', '2025-03-11 01:50:57', 1),
(84, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:51:34', '2025-03-11 01:51:34', 1),
(85, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:51:47', '2025-03-11 01:51:47', 1),
(86, 's', 1, 'none', 1, 'У этих макарон приятный золотистый цвет, особый вкус, а еще они хорошо сохраняют форму при варке. Высший сорт, Группа В. Не содержит ГМО.', '2025-03-11 01:54:11', '2025-03-11 01:54:11', 1),
(87, 'фывфывфыв', 123, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 01:56:28', '2025-03-11 01:56:28', 1),
(88, 'фывфывфыв', 12, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:00:53', '2025-03-11 02:00:53', 1),
(89, 'фывфывфыв', 12, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:01:34', '2025-03-11 02:01:34', 1),
(90, 'фывфывфыв', 12, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:01:43', '2025-03-11 02:01:43', 1),
(91, 'фы', 1, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:01:49', '2025-03-11 02:01:49', 1),
(92, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:07:32', '2025-03-11 02:07:32', 1),
(93, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:11:10', '2025-03-11 02:11:10', 1),
(94, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:11:43', '2025-03-11 02:11:43', 1),
(95, 'фы', 1, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:13:33', '2025-03-11 02:13:33', 1),
(96, 'фы', 1, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:13:45', '2025-03-11 02:13:45', 1),
(97, 'фы', 1, 'images/products/ьуь.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:14:26', '2025-03-11 02:14:26', 1),
(98, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:14:53', '2025-03-11 02:14:53', 1),
(99, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:14:55', '2025-03-11 02:14:55', 1),
(100, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:15:00', '2025-03-11 02:15:00', 1),
(101, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:15:43', '2025-03-11 02:15:43', 1),
(102, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:15:48', '2025-03-11 02:15:48', 1),
(103, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:15:56', '2025-03-11 02:15:56', 1),
(104, 'фы', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:16:01', '2025-03-11 02:16:01', 1),
(105, 'фыddd', 1, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:16:14', '2025-03-11 02:16:14', 1),
(106, 'фыddd', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:16:16', '2025-03-11 02:16:16', 1),
(107, 'фыddd', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:16:19', '2025-03-11 02:16:19', 1),
(108, 'фыdddsss', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:16:22', '2025-03-11 02:16:22', 1),
(109, 'фыdddsss', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:17:08', '2025-03-11 02:17:08', 1),
(110, 'фыdddsss', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:17:33', '2025-03-11 02:17:33', 1),
(111, 'фыdddsss', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:17:50', '2025-03-11 02:17:50', 1),
(112, 'фы', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:20:53', '2025-03-11 02:20:53', 1),
(113, 'ф', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:20:56', '2025-03-11 02:20:56', 1),
(114, 'фsssssfff', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:56:17', '2025-03-11 02:56:17', 1),
(115, 'фsssssfff', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:57:00', '2025-03-11 02:57:00', 1),
(116, 'фsssssfff', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 02:57:05', '2025-03-11 02:57:05', 1),
(117, 'фsssssfff', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 03:03:52', '2025-03-11 03:03:52', 1),
(118, 'фsssssfff', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 03:10:50', '2025-03-11 03:10:50', 1),
(119, 'фssssввввв', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 04:16:46', '2025-03-11 04:16:46', 1),
(120, 'фssssввввв', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 04:16:53', '2025-03-11 04:16:53', 1),
(121, 'фssssввввв', 123, 'images/products/photo_2024-12-12_11-17-29.jpg', 1, '\"123adsasdads\"', '2025-03-11 04:17:10', '2025-03-11 04:17:10', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `promo_code`
--

CREATE TABLE `promo_code` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `discount` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `promo_code`
--

INSERT INTO `promo_code` (`id`, `code`, `discount`, `status`) VALUES
(1, 7777, 100, 0),
(2, 7777, 100, 1),
(3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `telephone`, `password`, `is_admin`) VALUES
(1, 'Admin', '2147483647', 'asdsadsad', 1),
(8, 'Admin', '12987654321', '123231', 1),
(9, 'Valery', '89511238303', '$2y$10$BiyNrdyA35nalwxOU.gsB.xIcGstTWbILwLb8pXvcxdn.wP9b2R1e', 1),
(10, 'Valery', '89511238304', '$2y$10$SgSfOZkOsBtdwZJoYNapkuuIxOL75tT9ogopwyUOTEN/RTJmEdhM.', 1),
(14, 'Valery', '89511238305', '$2y$10$4g5jyqa9p5vsJu4nJX5pHOQa8OOshj5ar7gZh6zQ4Gu6YUjXtaqUe', 1),
(17, 'Valery', '89511238306', '$2y$10$jPWkNwBrAaFKxQjN/ggCCead2EYdlywAQltE1j0VvQAVzbaUjYIRe', 1),
(19, 'Valery', '89511238307', '$2y$10$.LohcGy172tfZhM8LAWE6O3Ex/DnrD8WoSbLfqKb5/.vX66MOqM3q', 1),
(20, 'asdadsdasdsa', '32232323343', '$2y$10$IfRBk5zFcRyT5jLRceZkNerzHZ4JNvcIgOmhaIx8hbiszLxBnAB9W', 0),
(21, 'pedro', '89502700555', '$2y$10$yuPELZVqi8MpDOT8vRPXaOxsAuHa96VdjYCi54V7WOVid307LRzvO', 0),
(22, 'DIMASO', '11111111111', '$2y$10$kDH2rK5zsvsqFhzOQyQbyejbW3XvBTI2/hrSHYmCf5Bn9Nw/6su0a', 0),
(23, '12345', '99999999999', '$2y$10$Ov.JFxla.X4ztIhPyjuIUuG9DsEEzJC5QuuXub84XYmG4mis7Siem', 0),
(24, '22222', '22222222222', '$2y$10$P2DEm3C491t6EBcXkvWmr.nv1JGq1MD4yRf1P.JA66dv99OiFAVgC', 0),
(25, '33333', '33333333333', '$2y$10$Mg.6HU0nTHDm3/Q5/QCHvOrvDZiGsDW6gMcundfI7GlCJqpjKJCBu', 0),
(26, '55555555', '44444444444', '$2y$10$AWm9Ag6qGlU6gW8SFDcL6.IOd6Ub/Ovq.Buq8HwCDkudncb8js3Vi', 0),
(27, '00000', '00000000000', '$2y$10$wps8O1v5vZ1fyFsTRF5q1.0ZtjmnnH3vb/YCEXDwzagzLhwOMMbuq', 0),
(28, '55555', '55555555555', '$2y$10$bUJFKU8PBpc73vEJTn7hd.wsyzrwbHwrCKcIFNTi30PFWUIPGXtyW', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `promo_code_id` (`promo_code_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT для таблицы `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`promo_code_id`) REFERENCES `promo_code` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
