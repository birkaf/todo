-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 05 2021 г., 21:07
-- Версия сервера: 5.7.19-0ubuntu0.16.04.1
-- Версия PHP: 7.0.33-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name_task` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `end_task` date DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name_task`, `description`, `user_id`, `deadline`, `end_task`, `status`) VALUES
(1, 'Купить хлеб', 'По пути домой зайти в магазин купить хлеб', 2, '2021-08-03', '2021-08-04', 3),
(2, 'Сделать тестовое задание', 'Необходимо создать приложение, которое представляет собой список задач со статусами', 1, '2021-08-05', '2021-08-05', 3),
(5, 'Задача 1', 'Нужно что-то сделать 1', 2, '2021-08-03', NULL, 1),
(6, 'Задача 2', 'Нужно что-то сделать 2', 1, '2021-08-13', NULL, 1),
(7, 'Задача 3', 'Нужно что-то сделать 3', 2, '2021-08-16', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fam` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `otch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fam`, `name`, `otch`) VALUES
(1, 'Конев', 'Константин', 'Викторович'),
(2, 'Алексеев', 'Василий', 'Дмитриевич'),
(3, 'Бурдун', 'Олег', 'Анатольевич');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
