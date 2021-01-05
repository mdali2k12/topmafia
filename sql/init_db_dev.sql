
DROP DATABASE IF EXISTS topmafia;
CREATE DATABASE IF NOT EXISTS topmafia CHARACTER SET utf8;
CREATE USER IF NOT EXISTS 'topmafia' IDENTIFIED BY 'topmafia';
GRANT ALL PRIVILEGES ON topmafia.* TO 'topmafia';
FLUSH PRIVILEGES;

USE topmafia;

CREATE TABLE `users` (
  `id`            int(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName`     varchar(26)           NULL,
  `lastName`      varchar(26)           NULL,
  -- case sensitive approach in users tables for username, email and password
  `username`      varchar(52)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email`         varchar(317) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password`      TINYTEXT     CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `isAdmin`       TINYINT(1) NOT NULL DEFAULT 0,
  `isPlayer`      TINYINT(1) NOT NULL DEFAULT 1,
  `createdAt`     datetime              NOT NULL DEFAULT current_timestamp(),
  `updatedAt`     datetime              NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

CREATE TABLE `sessions` (
  `id`                 int(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId`             INT(11)      UNSIGNED NOT NULL,
  `accessToken`        VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accessTokenExpiry`  DATETIME              NOT NULL,
  `refreshToken`       VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `refreshTokenExpiry` DATETIME              NOT NULL,
  `createdAt`          DATETIME              NOT NULL DEFAULT current_timestamp(),
  `updatedAt`          DATETIME              NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `sessions`
  ADD UNIQUE KEY `unique_accessToken`  (`accessToken`),
  ADD UNIQUE KEY `unique_refreshToken` (`refreshToken`),
  ADD KEY `userId` (`userId`);
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;