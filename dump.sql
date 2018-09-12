SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `email`, `pass`, `type`) VALUES
(1, 'user@mail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1),
(2, 'company@mail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2),
(3, 'company2@mail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 2),
(4, 'user2@mail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 1);

CREATE TABLE `vacancies` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `vacancies` (`id`, `user_id`, `title`, `content`, `salary`, `created_at`) VALUES
(1, 2, 'PHP developer', 'We are Looking for a php developer.', 1000, '2018-09-01 19:07:37'),
(2, 3, 'Javascript developer', 'Javascript developer is needed.', 1000, '2018-09-01 19:07:50'),
(3, 3, 'Go developer', 'we need a Go developer', 3000, '2018-09-06 23:39:05');


ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `vacancies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
