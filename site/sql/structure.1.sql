CREATE TABLE `ingredient` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `meal_ingredient` (
  `meal_id` mediumint(8) unsigned NOT NULL,
  `ingredient_id` mediumint(8) unsigned NOT NULL,
  KEY `fk_meal_link` (`meal_id`),
  KEY `fk_ingredient_link` (`ingredient_id`),
  CONSTRAINT `meal_ingredient_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`id`),
  CONSTRAINT `meal_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;