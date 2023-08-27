CREATE TABLE `logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` text NOT NULL,
    `message` text NOT NULL,
    `context` text DEFAULT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci