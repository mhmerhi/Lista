CREATE TABLE `household_item_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `household_item` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_household_item_type` (`type_id`),
  CONSTRAINT `fk_household_item_type` FOREIGN KEY (`type_id`) REFERENCES `household_item_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;