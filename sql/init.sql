CREATE DATABASE `dropzone`;

use dropzone;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `name` varchar(255),
  `encrypted_password` varchar(255) NOT NULL,
  `created` datetime,
  `updated` datetime
) ENGINE=InnoDB;
ALTER TABLE users CHANGE updated_at updated datetime;
ALTER TABLE users CHANGE created_at created datetime;

CREATE TABLE `contents`(
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_dir` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `created` datetime
) ENGINE=InnoDB;
alter table contents add FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
