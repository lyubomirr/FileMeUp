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
  FOREIGN KEY (ownerId) REFERENCES Users(id)
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
  lastModifiedDate datetime NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (folderId) REFERENCES Folders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;
