# productkart
Just gitclone "https://github.com/Waseem1509/productkart.git" and run it on localhost without any changes.

Config to be changed for different environments:

productkart/product-cart/config/fn.database.php
productkart/product/public/config.php

DB Schema to be configured:

DB_NAME: product_details

CREATE TABLE `product_details` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `rating` int(11) DEFAULT NULL,
 `price` decimal(12,4) DEFAULT '0.0000',
 `discount` decimal(12,4) DEFAULT '0.0000',
 `brand` varchar(100) DEFAULT NULL,
 `color` varchar(100) DEFAULT NULL,
 `create_date` datetime NOT NULL,
 `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1
