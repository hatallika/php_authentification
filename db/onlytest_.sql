-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Окт 02 2023 г., 17:28
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `onlytest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `phone`, `pass`, `hash`) VALUES
(1, 'admin', 'test1@test.ru', '+79274669723', '$2y$10$DXOQvi165r4Oct..djxupuxzhwwTkxURsBUgj05uEfzTFziMhEXuK', '12616014916519d4e75e6d69.71351492'),
(2, 'user', 'test2@test.ru', '+77880988088', '$2y$10$DXOQvi165r4Oct..djxupuxzhwwTkxURsBUgj05uEfzTFziMhEXuK', '89412248615a1d955e2887.37449076'),
(3, 'username', 'test3@test.ru', '+74576769900', '123456', '123456'),
(4, 'test', 'test', '323232323', '$2y$10$MiDxWvG3yguqJ.HANKsrnOBGbsK6onoMnQVch69F8RWjEueUQT5UK', '800447367651745aa5d90c9.62311484'),
(10, 'wewe', 'wewe', 'ewe', '$2y$10$5F4WW8CCJ01ml5ldqSkq9OWVrZR0Gpd/b8zI7DfohjXi6yPcJALqm', '72983328765198cd1b48501.26686261'),
(11, 'test112112323223', '2323@sdsd.ru', '121', '$2y$10$u5nYql.X0k3kdnQYWCPnaOBiwB1wpLEXuXAv8op8RPbwCeqxOjchy', '62496024265198d1af281b1.29239444'),
(12, 'test777', 'test777', '+7898878988', '$2y$10$x3ATbI51HXjFiD9hFVgHUuC5ZP81NXTWHJ3A.Q4LGIKwhSTkmSzme', '9515133066519d557773008.44805787'),
(13, 'test555', 'test555', '12334', '$2y$10$5Ofbu2iRKj73d9bTG0XmCOFifEbdFiAwXGj7hylwHo3ujU3KM6qfW', '51543727651abfd03780b4.27392444');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
