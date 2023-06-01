DROP TABLE IF EXISTS `users`;

CREATE TABLE
    `users` (
        `id` char(36) NOT NULL,
        `name` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `salt` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
    ) DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `pictures`;

CREATE TABLE
    `pictures` (
        `id` char(36) NOT NULL,
        `user_id` char(36) NOT NULL,
        `file_path` varchar(255) NOT NULL,
        `name` varchar(50) NOT NULL DEFAULT 'Без названия',
        `description` varchar(280) DEFAULT NULL,
        `num_of_views` int DEFAULT '0',
        `md5_hash` char(32) NOT NULL,
        `upload_time` datetime NOT NULL,
        `num_of_comment` int NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        UNIQUE KEY `unq_md5_hash` (`md5_hash`),
        KEY `user_id` (`user_id`),
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ) DEFAULT CHARACTER SET = utf8;

DROP TABLE IF EXISTS `comments`;

CREATE TABLE
    `comments` (
        `id` char(36) NOT NULL,
        `user_id` char(36) NOT NULL,
        `picture_id` char(36) NOT NULL,
        `comment_text` varchar(280) NOT NULL,
        `edited` tinyint(1) DEFAULT '0',
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `picture_id` (`picture_id`),
        KEY `user_id` (`user_id`),
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
        FOREIGN KEY (`picture_id`) REFERENCES `pictures` (`id`)
    ) DEFAULT CHARACTER SET = utf8;