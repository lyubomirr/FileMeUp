CREATE DATABASE IF NOT EXISTS `filemeup` COLLATE utf8_general_ci;
USE `filemeup`;

START TRANSACTION;

CREATE TABLE `Users` (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Folders` (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  ownerId int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (ownerId) REFERENCES Users(id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Files` (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  folderId int(11) NOT NULL,
  description varchar(255) NULL,
  size int(11) NOT NULL,
  extension varchar(10) NULL,
  location varchar(180) NOT NULL,
  storeDate datetime NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (folderId) REFERENCES Folders(id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Links` (
  id int(11) NOT NULL AUTO_INCREMENT,
  token varchar(100) NOT NULL,
  fileId int(11) NOT NULL,
  password varchar(100) NULL,
  validUntil datetime NULL,
  sharesLeft int(6) NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (fileId) REFERENCES Files(id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `externalapps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `externalapps` (`id`, `name`, `url`) VALUES
(1, 'MeTube', 'http://localhost:8080/videoapp?videoUrl=%s');

CREATE TABLE `extensiontoapp` (
  `id` int(11) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `appId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `extensiontoapp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `extension` (`extension`),
  ADD KEY `appId` (`appId`);

INSERT INTO `extensiontoapp` (`id`, `extension`, `appId`) VALUES
(1, 'mp4', 1);

ALTER TABLE `extensiontoapp`
  ADD CONSTRAINT `fk_extensiontoapp_externalapps` FOREIGN KEY (`appId`) REFERENCES `externalapps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;