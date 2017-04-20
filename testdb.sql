CREATE DATABASE `testdb`;
USE `testdb`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userrole` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


uploadedfiles(expid,file,type,size)

CREATE TABLE IF NOT EXISTS `uploadedfiles` (
`id` INT( 8 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`expid` int(8) NOT NULL,
`file` VARCHAR( 100 ) NOT NULL ,
`type` VARCHAR( 10 ) NOT NULL ,
`size` INT NOT NULL
) ENGINE = MYISAM ;