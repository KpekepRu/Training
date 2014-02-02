-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 02 2014 г., 20:46
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mainbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `my_info`
--

CREATE TABLE IF NOT EXISTS `my_info` (
  `Index` int(11) NOT NULL,
  `Name` varchar(10) COLLATE utf8_bin NOT NULL,
  `Surname` varchar(15) COLLATE utf8_bin NOT NULL,
  `Course` int(11) NOT NULL,
  `Faculty` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Index`),
  UNIQUE KEY `Index` (`Index`),
  KEY `Index_2` (`Index`),
  KEY `Index_3` (`Index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Мои данные';

--
-- Дамп данных таблицы `my_info`
--

INSERT INTO `my_info` (`Index`, `Name`, `Surname`, `Course`, `Faculty`) VALUES
(1, 'Ilshat', 'Ahmetov', 2, 'VMK'),
(2, 'Iskander', 'Sharipov', 2, 'VMK'),
(3, 'Maxim', 'Efimov', 2, 'VMK'),
(4, 'Nadir', 'Manahov', 2, 'VMK');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Login` text COLLATE utf8_bin NOT NULL,
  `Password` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Login`, `Password`) VALUES
('User', '123'),
('Kpekep', 'qwe');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
