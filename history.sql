CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` mediumtext NOT NULL,
  `markup` mediumtext NOT NULL,
  `time_checked` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci	
