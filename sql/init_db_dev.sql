
DROP DATABASE IF EXISTS topmafia;
CREATE DATABASE IF NOT EXISTS topmafia CHARACTER SET utf8;
CREATE USER IF NOT EXISTS 'topmafia' IDENTIFIED BY 'topmafia';
GRANT ALL PRIVILEGES ON topmafia.* TO 'topmafia';
FLUSH PRIVILEGES;

USE topmafia;

CREATE TABLE `users` (
  `id`            int(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  -- case sensitive approach in users tables for username, email and password
  `username`      varchar(52)  CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email`         varchar(317) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password`      TINYTEXT     CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `isAdmin`       TINYINT(1)   NOT NULL DEFAULT 0,
  `isPlayer`      TINYINT(1)   NOT NULL DEFAULT 1,
  `isVerified`    TINYINT(1)   NOT NULL DEFAULT 0,
  `gender`        ENUM( 'Male', 'Female' ),
  `createdAt`     datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt`     datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

CREATE TABLE `sessions` (
  `id`                 int(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId`             INT(11)      UNSIGNED NOT NULL,
  `accessToken`        VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `accessTokenExpiry`  DATETIME     NOT NULL,
  `ip`                 VARCHAR(40)  NOT NULL,
  `userAgent`          VARCHAR(200) NOT NULL,
  `refreshToken`       VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `refreshTokenExpiry` DATETIME     NOT NULL,
  `createdAt`          DATETIME     NOT NULL DEFAULT current_timestamp(),
  `updatedAt`          DATETIME     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  CONSTRAINT `session_user_pk` PRIMARY KEY (`id`, `userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `sessions`
  ADD KEY `userId` (`userId`);
ALTER TABLE `sessions`
  ADD CONSTRAINT `session_user_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

CREATE TABLE `apptokens` (
  `id`         int(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId`     INT(11)      UNSIGNED NOT NULL,
  `token`      VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type`       ENUM( 'accountverification', 'passwordreset' ),
  `createdAt`  DATETIME NOT     NULL DEFAULT current_timestamp(),
  `consumedAt` DATETIME DEFAULT NULL,
  CONSTRAINT `apptoken_user_pk` PRIMARY KEY (`id`, `userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `apptokens`
  ADD KEY `userId` (`userId`);
ALTER TABLE `apptokens`
  ADD CONSTRAINT `apptoken_user_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

CREATE TABLE `bannedips`(
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip`                  VARCHAR(40)  NOT NULL,
  `createdAt`           DATETIME NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `bannedemails`(
  `id`            int(11)      UNSIGNED  NOT NULL AUTO_INCREMENT,
  `email`         varchar(317) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL, 
  `createdAt`     DATETIME     NOT NULL  DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE sponsorships (
  `id`          INT(11)      UNSIGNED NOT NULL AUTO_INCREMENT,
  `sponsorId`   INT(11)      UNSIGNED NOT NULL,
  `sponsoredId` INT(11)      UNSIGNED NOT NULL,
  `ip`          VARCHAR(40)  NOT NULL,
  `userAgent`   VARCHAR(200) NOT NULL,
  `isVerified`  TINYINT(1)   NOT NULL DEFAULT 0,
  `createdAt`   DATETIME     NOT NULL  DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `sponsorships`
  ADD KEY `sponsorId` (`sponsorId`);
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsor_user_fk` FOREIGN KEY (`sponsorId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE `sponsorships`
  ADD KEY `sponsoredId` (`sponsoredId`);
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsored_user_fk` FOREIGN KEY (`sponsoredId`) REFERENCES `users` (`id`) ON DELETE CASCADE;