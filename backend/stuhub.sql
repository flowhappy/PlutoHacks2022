CREATE TABLE `article` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `title` varchar(100) DEFAULT NULL,
 `content` longtext,
 `type` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8

CREATE TABLE `type` (
 `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `users` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `username` varchar(10) DEFAULT NULL,
 `password` varchar(10) DEFAULT NULL,
 `points` int(250) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8
