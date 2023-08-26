CREATE TABLE `user_sessions` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user_id` int(11) NOT NULL,
     `session_id` text NOT NULL,
     `data` text NOT NULL,
     `expiry_at` datetime NOT NULL,
     `is_valid` tinyint(1) NOT NULL DEFAULT 1,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci