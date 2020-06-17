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
  owner_id int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (owner_id) REFERENCES Users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;
