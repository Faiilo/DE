-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 14 2026 г., 19:03
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `matpomosh_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Documents`
--

CREATE TABLE `Documents` (
  `id_document` int(11) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Osnovanie`
--

CREATE TABLE `Osnovanie` (
  `id_osnovanie` int(11) NOT NULL,
  `name_osnovanie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Requests`
--

CREATE TABLE `Requests` (
  `id_request` int(11) NOT NULL,
  `osnovanie_id` int(11) NOT NULL,
  `sostav_family` varchar(255) NOT NULL,
  `tip_home` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Reviews`
--

CREATE TABLE `Reviews` (
  `id_review` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--

CREATE TABLE `Roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Roles`
--

INSERT INTO `Roles` (`id_role`, `name_role`) VALUES
(1, 'Админ'),
(2, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `Statuses`
--

CREATE TABLE `Statuses` (
  `id_status` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Statuses`
--

INSERT INTO `Statuses` (`id_status`, `status_name`) VALUES
(1, 'Новая'),
(2, 'Одобрена'),
(3, 'Отклонена');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id_user`, `login`, `password`, `fio`, `phone`, `email`, `role_id`) VALUES
(1, 'Admin', 'KorokNET', 'Главный Администратор', '8(999)999-99-99', 'admin@mail.ru', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Documents`
--
ALTER TABLE `Documents`
  ADD PRIMARY KEY (`id_document`);

--
-- Индексы таблицы `Osnovanie`
--
ALTER TABLE `Osnovanie`
  ADD PRIMARY KEY (`id_osnovanie`);

--
-- Индексы таблицы `Requests`
--
ALTER TABLE `Requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `osnovanie_id` (`osnovanie_id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `review_id` (`review_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`id_review`);

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `Statuses`
--
ALTER TABLE `Statuses`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Documents`
--
ALTER TABLE `Documents`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Osnovanie`
--
ALTER TABLE `Osnovanie`
  MODIFY `id_osnovanie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Requests`
--
ALTER TABLE `Requests`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Statuses`
--
ALTER TABLE `Statuses`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Requests`
--
ALTER TABLE `Requests`
  ADD CONSTRAINT `Requests_ibfk_1` FOREIGN KEY (`osnovanie_id`) REFERENCES `Osnovanie` (`id_osnovanie`),
  ADD CONSTRAINT `Requests_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `Documents` (`id_document`),
  ADD CONSTRAINT `Requests_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id_user`),
  ADD CONSTRAINT `Requests_ibfk_4` FOREIGN KEY (`review_id`) REFERENCES `Reviews` (`id_review`),
  ADD CONSTRAINT `Requests_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `Statuses` (`id_status`);

--
-- Ограничения внешнего ключа таблицы `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
