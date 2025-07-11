-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3311
-- Generation Time: Jun 29, 2025 at 12:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `body` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `changed` varchar(25) NOT NULL DEFAULT 'false',
  `date_action` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `post_id`, `user_id`, `changed`, `date_action`) VALUES
(140, 'thye', 103, 15, 'false', '2025-06-25 00:30:01'),
(141, 'Беру один день в неделю полностью без учёбы — помогает перезагрузиться.', 103, 3, 'false', '2025-06-25 00:44:35'),
(142, 'Очень понимаю, сам недавно был в таком состоянии.', 103, 11, 'false', '2025-06-25 00:44:35'),
(143, 'Меньше соцсетей вечером и больше сна — помогает.', 103, 15, 'false', '2025-06-25 00:44:35'),
(144, 'Спасибо всем за советы, постараюсь внедрить!', 103, 1, 'false', '2025-06-25 00:44:35'),
(145, 'Первым делом — стакан воды и немного тишины.', 104, 1, 'false', '2025-06-25 00:44:35'),
(146, 'Я включаю музыку и делаю пару отжиманий :)', 104, 11, 'false', '2025-06-25 00:44:35'),
(147, 'Кофе и планирование дня — классика.', 104, 15, 'false', '2025-06-25 00:44:35'),
(148, 'Я бегаю по утрам, потом душ — бодрит супер!', 104, 2, 'false', '2025-06-25 00:44:35'),
(149, 'Если можешь совмещать — почему бы и нет?', 105, 2, 'false', '2025-06-25 00:44:35'),
(150, 'Сложно, если график нестабильный, лучше фриланс.', 105, 3, 'false', '2025-06-25 00:44:35'),
(151, 'Я начал с 4 часов в неделю, нормально зашло.', 105, 1, 'false', '2025-06-25 00:44:35'),
(152, 'Главное — не жертвовать сном.', 105, 15, 'false', '2025-06-25 00:44:35'),
(153, 'Пробуй таймер на 25 минут (техника \"Помидора\").', 106, 2, 'false', '2025-06-25 00:44:35'),
(154, 'Я составляю список задач с утра и вычёркиваю — приятно.', 106, 15, 'false', '2025-06-25 00:44:35'),
(155, 'Ставлю дедлайны даже если их нет.', 106, 11, 'false', '2025-06-25 00:44:35'),
(156, 'Сейчас пробую ограничить YouTube — надеюсь поможет.', 106, 1, 'false', '2025-06-25 00:44:35'),
(157, '“Магия утра” — реально помогает изменить рутину.', 107, 2, 'false', '2025-06-25 00:44:35'),
(158, '“Тонкое искусство пофигизма” — помогла проще смотреть на жизнь.', 107, 15, 'false', '2025-06-25 00:44:35'),
(159, '“Поток” Чиксентмихайи — очень глубокая.', 107, 11, 'false', '2025-06-25 00:44:35'),
(160, 'Спасибо, добавил в список!', 107, 1, 'false', '2025-06-25 00:44:35'),
(161, 'Начни с официальной документации php.net.', 108, 2, 'false', '2025-06-25 00:44:36'),
(162, 'Сделай свою первую форму регистрации.', 108, 3, 'false', '2025-06-25 00:44:36'),
(163, 'Спасибо, уже начал с базового CRUD.', 108, 1, 'false', '2025-06-25 00:44:36'),
(164, 'Попробуй создать блог с комментариями — хороший опыт.', 108, 15, 'false', '2025-06-25 00:44:36'),
(165, 'Режим сна решает. Старайся ложиться в одно и то же время.', 109, 1, 'false', '2025-06-25 00:44:36'),
(166, 'Спорт вечером сильно помогает.', 109, 2, 'false', '2025-06-25 00:44:36'),
(167, 'Попробуй исключить кофе после 16:00.', 109, 15, 'false', '2025-06-25 00:44:36'),
(168, 'Спасибо всем, реально стоящие советы.', 109, 3, 'false', '2025-06-25 00:44:36'),
(169, 'Используй подготовленные запросы — mysqli_prepare.', 112, 1, 'false', '2025-06-25 00:44:36'),
(170, 'Обязательно фильтруй ввод от пользователя.', 112, 2, 'false', '2025-06-25 00:44:36'),
(171, 'PDO + bindParam() отлично работает.', 112, 15, 'false', '2025-06-25 00:44:36'),
(172, 'Спасибо, теперь понятнее.', 112, 17, 'false', '2025-06-25 00:44:36'),
(173, 'Попробуй пройти профориентационные тесты.', 113, 2, 'false', '2025-06-25 00:44:36'),
(174, 'Занимайся тем, к чему сам тянешься без давления.', 113, 3, 'false', '2025-06-25 00:44:36'),
(175, 'Не бойся менять направление — это нормально.', 113, 15, 'false', '2025-06-25 00:44:36'),
(176, 'Спасибо, стал чуть спокойнее после прочтения.', 113, 1, 'false', '2025-06-25 00:44:36'),
(177, 'Кофе с корицей — мой любимый ритуал.', 114, 11, 'false', '2025-06-25 00:44:36'),
(178, 'Иногда заменяю на какао — тоже бодрит.', 114, 1, 'false', '2025-06-25 00:44:36'),
(179, 'Главное — не пить больше 2 кружек в день.', 114, 2, 'false', '2025-06-25 00:44:36'),
(180, 'Иногда пробую обходиться без него, но сложно.', 114, 15, 'false', '2025-06-25 00:44:36'),
(181, 'Читайте то, что интересно — тогда втягиваешься.', 115, 1, 'false', '2025-06-25 00:44:36'),
(182, 'Я читаю 10 минут перед сном, каждый день.', 115, 2, 'false', '2025-06-25 00:44:36'),
(183, 'Аудиокниги помогают, особенно в дороге.', 115, 15, 'false', '2025-06-25 00:44:36'),
(184, 'Начал с лёгких книг и перешёл на серьёзные.', 115, 4, 'false', '2025-06-25 00:44:36'),
(185, 'yes\r\n', 105, 1, 'false', '2025-06-25 01:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Пользователь',
  `user` varchar(255) NOT NULL,
  `action` text NOT NULL,
  `date_action` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `role`, `user`, `action`, `date_action`) VALUES
(416, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 00:56:52'),
(417, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 00:56:53'),
(418, 'Модератор', 'test', 'Удалил комментарии к посту с идентификатором: 30', '2025-05-12 00:56:57'),
(419, 'Модератор', 'test', 'Удалил комментарии к посту с идентификатором: 30', '2025-05-12 00:57:00'),
(420, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 01:04:21'),
(421, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 01:04:31'),
(422, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 01:05:51'),
(423, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 01:11:33'),
(424, 'Модератор', 'test', 'Удалил комментарии к посту с идентификатором: 30', '2025-05-12 01:11:37'),
(425, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-12 01:14:50'),
(426, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 26', '2025-05-12 01:15:10'),
(427, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 27', '2025-05-12 01:34:51'),
(428, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 30', '2025-05-13 23:42:54'),
(429, 'Создатель', 'Emil', 'Добавил комментарии к своему посту с идентификатором: 1', '2025-05-13 23:46:14'),
(430, 'Создатель', 'Emil', 'Добавил комментарии к своему посту с идентификатором: 1', '2025-05-14 00:02:56'),
(431, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 12', '2025-05-14 00:09:57'),
(432, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 12', '2025-05-14 00:10:28'),
(433, 'Создатель', 'Emil', 'Удалил комментарии к посту с идентификатором: 12', '2025-05-14 00:10:38'),
(434, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 97', '2025-05-14 00:47:49'),
(435, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 18', '2025-05-14 01:05:24'),
(436, 'Создатель', 'Emil', 'Добавил новый пост с id: 98', '2025-05-14 01:17:15'),
(437, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 98', '2025-05-14 01:21:22'),
(438, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 98', '2025-05-14 01:31:54'),
(439, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 98', '2025-05-14 01:41:20'),
(440, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 98', '2025-05-14 01:43:00'),
(441, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 98', '2025-05-14 01:43:16'),
(442, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 98', '2025-05-14 01:43:25'),
(443, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 41', '2025-05-16 12:25:41'),
(444, 'Создатель', 'Emil', 'Добавил новый пост с id: 99', '2025-05-16 12:26:21'),
(445, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 99', '2025-05-16 12:26:42'),
(446, 'Создатель', 'Emil', 'Изменил пост с идентификатором: 99', '2025-05-16 12:27:01'),
(447, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 99', '2025-05-16 12:27:09'),
(448, 'Создатель', 'Emil', 'Добавил новый пост с id: 100', '2025-05-16 12:27:41'),
(449, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 12', '2025-05-16 12:29:39'),
(450, 'Пользователь', 'Mustafa', 'Добавил комментарии к посту с идентификатором: 12', '2025-05-16 12:30:25'),
(451, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 19', '2025-05-19 01:01:36'),
(452, 'Создатель', 'Emil', 'Удалил комментарии к посту с идентификатором: 30', '2025-05-19 01:04:57'),
(453, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 26', '2025-05-19 01:56:41'),
(454, 'Создатель', 'Emil', 'Добавил новый пост с id: 101', '2025-05-22 02:19:12'),
(455, 'Создатель', 'Emil', 'Добавил новый пост с id: 102', '2025-05-22 02:21:57'),
(456, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 102', '2025-05-22 02:23:35'),
(457, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 42', '2025-05-22 02:30:32'),
(458, 'Создатель', 'Emil', 'Удалил комментарии к посту с идентификатором: 42', '2025-05-22 02:30:35'),
(459, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 42', '2025-05-22 02:32:25'),
(460, 'Создатель', 'Emil', 'Удалил свой комментарии к своему посту с идентификатором: 42', '2025-05-22 02:32:28'),
(461, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 42', '2025-05-22 02:33:22'),
(462, 'Создатель', 'Emil', 'Удалил свой комментарии к своему посту с идентификатором: 42', '2025-05-22 02:33:25'),
(463, 'Модератор', 'test', 'Добавил комментарии к посту с идентификатором: 42', '2025-05-22 02:33:47'),
(464, 'Создатель', 'Emil', 'Удалил комментарий пользователя к своему посту с идентификатором: 42', '2025-05-22 02:34:09'),
(465, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 101', '2025-05-22 02:37:05'),
(466, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 30', '2025-06-07 10:50:32'),
(467, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 1', '2025-06-24 23:45:44'),
(468, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 100', '2025-06-24 23:58:17'),
(469, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 12', '2025-06-25 00:10:24'),
(470, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 18', '2025-06-25 00:10:24'),
(471, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 19', '2025-06-25 00:10:25'),
(472, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 26', '2025-06-25 00:10:25'),
(473, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 27', '2025-06-25 00:10:27'),
(474, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 35', '2025-06-25 00:10:27'),
(475, 'Создатель', 'Emil', 'Удалил свой пост с идентификатором: 42', '2025-06-25 00:10:28'),
(476, 'Создатель', 'Emil', 'Удалил пост с идентификатором: 46', '2025-06-25 00:10:30'),
(477, 'Создатель', 'Emil', 'Добавил новый пост с id: 103', '2025-06-25 00:10:46'),
(478, 'Пользователь', 'Artur', 'Добавил новый пост с id: 104', '2025-06-25 00:11:22'),
(479, 'Модератор', 'SoulDust', 'Добавил новый пост с id: 105', '2025-06-25 00:11:42'),
(480, 'Пользователь', 'Mustafa', 'Добавил новый пост с id: 106', '2025-06-25 00:12:17'),
(481, 'Создатель', 'Emil', 'Добавил новый пост с id: 107', '2025-06-25 00:12:50'),
(482, 'Создатель', 'Emil', 'Добавил новый пост с id: 108', '2025-06-25 00:13:20'),
(483, 'Пользователь', 'Mustafa', 'Добавил новый пост с id: 109', '2025-06-25 00:13:53'),
(484, 'Пользователь', 'Mustafa', 'Добавил новый пост с id: 110', '2025-06-25 00:15:57'),
(485, 'Пользователь', 'Mustafa', 'Добавил новый пост с id: 111', '2025-06-25 00:16:21'),
(486, 'Пользователь', 'Mustafa', 'Удалил свой пост с идентификатором: 111', '2025-06-25 00:16:39'),
(487, 'Пользователь', 'Mustafa', 'Удалил свой пост с идентификатором: 110', '2025-06-25 00:16:40'),
(488, 'Модератор', 'test', 'Добавил новый пост с id: 112', '2025-06-25 00:17:18'),
(489, 'Создатель', 'Emil', 'Добавил новый пост с id: 113', '2025-06-25 00:17:59'),
(490, 'Модератор', 'SoulDust', 'Добавил новый пост с id: 114', '2025-06-25 00:18:28'),
(491, 'Пользователь', 'Argen', 'Добавил новый пост с id: 115', '2025-06-25 00:19:11'),
(492, 'Пользователь', 'Artur', 'Добавил комментарии к посту с идентификатором: 103', '2025-06-25 00:20:39'),
(493, 'Модератор', 'SoulDust', 'Добавил комментарии к посту с идентификатором: 103', '2025-06-25 00:21:01'),
(494, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 103', '2025-06-25 00:21:19'),
(495, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 104', '2025-06-25 00:22:23'),
(496, 'Пользователь', 'Mustafa', 'Добавил комментарии к посту с идентификатором: 104', '2025-06-25 00:22:44'),
(497, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 105', '2025-06-25 00:23:07'),
(498, 'Пользователь', 'Artur', 'Добавил комментарии к посту с идентификатором: 105', '2025-06-25 00:23:37'),
(499, 'Модератор', 'SoulDust', 'Добавил комментарии к посту с идентификатором: 106', '2025-06-25 00:24:12'),
(500, 'Пользователь', 'Mustafa', 'Добавил комментарии к посту с идентификатором: 106', '2025-06-25 00:24:32'),
(501, 'Пользователь', 'Artur', 'Добавил комментарии к посту с идентификатором: 107', '2025-06-25 00:24:58'),
(502, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 107', '2025-06-25 00:25:15'),
(503, 'Модератор', 'SoulDust', 'Добавил комментарии к посту с идентификатором: 107', '2025-06-25 00:26:08'),
(504, 'Модератор', 'SoulDust', 'Добавил комментарии к посту с идентификатором: 103', '2025-06-25 00:30:01'),
(505, 'Создатель', 'Emil', 'Убрал модерку с пользователя Altynay', '2025-06-25 00:46:59'),
(506, 'Модератор', 'SoulDust', 'удалил пользователя с именем: PDO', '2025-06-25 01:14:54'),
(507, 'Модератор', 'SoulDust', 'Создал нового пользователя с id: 88', '2025-06-25 01:15:06'),
(508, 'Модератор', 'SoulDust', 'удалил пользователя с именем: r4', '2025-06-25 01:15:10'),
(509, 'Модератор', 'SoulDust', 'Создал нового пользователя с id: 89', '2025-06-25 01:18:38'),
(510, 'Модератор', 'SoulDust', 'удалил пользователя с именем: gt', '2025-06-25 01:18:43'),
(511, 'Создатель', 'Emil', 'Создал нового пользователя с id: 90', '2025-06-25 01:19:06'),
(512, 'Создатель', 'Emil', 'Убрал модерку с пользователя gr', '2025-06-25 01:19:11'),
(513, 'Создатель', 'Emil', 'удалил пользователя с именем: gr', '2025-06-25 01:19:15'),
(514, 'Создатель', 'Emil', 'Добавил комментарии к посту с идентификатором: 105', '2025-06-25 01:24:22'),
(515, 'Создатель', 'Emil', 'Создал нового пользователя с id: 91', '2025-06-26 00:28:51'),
(516, 'Создатель', 'Emil', 'Создал нового пользователя с id: 92', '2025-06-29 01:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `changed` varchar(20) NOT NULL DEFAULT 'Поль',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `changed`, `user_id`) VALUES
(103, 'Как не выгореть во время учёбы?', 'Последние недели просто нет сил. Учёба, проекты, бессонные ночи... Кто как справляется?', 'Поль', 1),
(104, 'Ваши утренние ритуалы', 'Интересно, как люди начинают день. Что вы делаете первым делом утром?', 'Поль', 3),
(105, 'Стоит ли работать во время учёбы?', 'Думаю устроиться на подработку, но боюсь не справляться с учёбой. Поделитесь опытом.', 'Поль', 15),
(106, 'Как бороться с прокрастинацией?', 'Я сажусь за дело и через 10 минут уже на YouTube. Как вы боретесь с этим?', 'Поль', 11),
(107, 'Топ книг, которые вас реально изменили', 'Иногда одна книга может изменить мышление. Поделитесь своими открытиями.', 'Поль', 1),
(108, 'Как начать с PHP?', '	Я только начал изучать PHP, с чего лучше всего начать?', 'Поль', 1),
(109, 'Не могу высыпаться, даже если сплю по 8 часов', 'У кого было такое: спишь 8 часов, а просыпаешься как будто вообще не отдыхал? Это что, стресс, питание, режим? Поделитесь опытом.', 'Поль', 11),
(112, 'Как защититься от SQL-инъекций?', 'Я читал про SQL-инъекции. Подскажите, как правильно защищаться от них в PHP?', 'Поль', 17),
(113, 'Как понять, чем заниматься в жизни?', 'Учусь, вроде бы всё нормально, но чувствую, что просто иду по течению. Нет чёткого понимания, чем хочу заниматься. Как вы нашли своё дело? Или ещё ищете?', 'Поль', 1),
(114, 'Кто тоже не может без кофе с утра?', 'Проснуться без кружки кофе — просто не вариант. Иногда думаю, не перебор ли это. А у вас как?', 'Поль', 15),
(115, 'Как заставить себя читать книги?', 'Хочу читать больше, но постоянно отвлекаюсь. Начинаю — и бросаю. Кто как приучил себя читать регулярно?', 'Поль', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'Пользователь',
  `reg_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `reg_date`) VALUES
(1, 'Emil', '$2y$10$GETEsw.UXQTGT1yf9Y', 'Создатель', '2024-09-26'),
(2, 'Altynay', '$2y$10$EM20oPs3PT.xMkSPlF', 'Пользователь', '2024-09-23'),
(3, 'Artur', '$2y$10$Q5mbQhWg5C3vmgUkff', 'Пользователь', '2024-09-23'),
(4, 'Argen', '$2y$10$AyV0dXYAgWHvkqd0YG', 'Пользователь', '2024-09-23'),
(6, 'Aygul', '$2y$10$6nWHewnW3SAqJBf507', 'Пользователь', '2024-09-23'),
(11, 'Mustafa', '$2y$10$YDqTjZpypw5a6VlCdL', 'Пользователь', '2024-09-23'),
(15, 'SoulDust', '$2y$10$g.ctzBS2xhpv/vIs4v', 'Модератор', '2024-09-24'),
(17, 'test', '$2y$10$APE0jjsZTeOImxAmhE', 'Модератор', '2024-10-02'),
(92, 'Ivan', '$2y$10$mruJyqiJs5NuCIkKJV', 'Пользователь', '2025-06-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
