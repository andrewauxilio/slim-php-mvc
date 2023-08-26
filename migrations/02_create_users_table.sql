CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `email` text NOT NULL,
     `password` text NOT NULL,
     `first_name` varchar(255) NOT NULL,
     `last_name` varchar(255) NOT NULL,
     `birth_date` date NOT NULL,
     `role` varchar(255) NOT NULL,
     `bio` text NOT NULL,
     `created_at` datetime NOT NULL,
     `updated_at` datetime NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci