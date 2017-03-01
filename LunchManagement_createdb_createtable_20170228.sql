CREATE DATABASE `LunchManagement`

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `empid` int(11) NOT NULL AUTO_INCREMENT,
  `empname` varchar(50) NOT NULL,
  `empaddress1` varchar(50) DEFAULT NULL,
  `empaddress2` varchar(50) DEFAULT NULL,
  `empcity` varchar(50) DEFAULT NULL,
  `empstate` varchar(10) DEFAULT NULL,
  `empzip` varchar(10) DEFAULT NULL,
  `empphone` varchar(25) DEFAULT NULL,
  `empemail` varchar(100) DEFAULT NULL,
  `empcomment` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`empid`)
);

DROP TABLE IF EXISTS `lunchinvoice`;
CREATE TABLE `lunchinvoice` (
  `lunchinvoiceid` int(11) NOT NULL AUTO_INCREMENT,
  `lunchinvoicedate` datetime DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT '0.00',
  `tax` decimal(10,2) DEFAULT NULL,
  `tip` decimal(10,2) DEFAULT '0.00',
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((((`amount` - `discount`) + `tax`) + `tip`)) VIRTUAL,
  `restaurantid` int(11) NOT NULL,
  PRIMARY KEY (`lunchinvoiceid`),
  KEY `fk_lunchinvoice_1_idx` (`restaurantid`),
  CONSTRAINT `fk_lunchinvoice_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `lunchorder`;
CREATE TABLE `lunchorder` (
  `lunchorderid` int(11) NOT NULL AUTO_INCREMENT,
  `itemid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `lunchordercomment` varchar(500) DEFAULT NULL,
  `restaurantid` int(11) NOT NULL,
  `orderdate` varchar(10) NOT NULL,
  PRIMARY KEY (`lunchorderid`),
  KEY `fk_lunchorder_1_idx` (`uid`),
  KEY `fk_lunchorder_2_idx` (`restaurantid`),
  CONSTRAINT `fk_lunchorder_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lunchorder_2` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
); 


DROP TABLE IF EXISTS `menuitem`;
CREATE TABLE `menuitem` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `menuitemid` varchar(50) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `price` varchar(50) DEFAULT NULL,
  `specials` varchar(50) DEFAULT NULL,
  `itemcomment` varchar(500) DEFAULT NULL,
  `restaurantid` int(11) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `fk_menuitem_1_idx` (`restaurantid`),
  CONSTRAINT `fk_menuitem_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
); 

DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE `restaurant` (
  `restaurantid` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantname` varchar(50) NOT NULL,
  `restaurantaddress1` varchar(50) DEFAULT NULL,
  `restaurantaddress2` varchar(50) DEFAULT NULL,
  `restaurantcity` varchar(50) DEFAULT NULL,
  `restaurantstate` varchar(10) DEFAULT NULL,
  `restaurantzip` varchar(10) DEFAULT NULL,
  `restaurantphone` varchar(25) DEFAULT NULL,
  `restaurantfax` varchar(25) DEFAULT NULL,
  `restaurantemail` varchar(100) DEFAULT NULL,
  `restaurantcontactperson` varchar(100) DEFAULT NULL,
  `restaurantcomment` varchar(500) DEFAULT NULL,
  `delivery` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`restaurantid`)
); 

DROP TABLE IF EXISTS `restaurantrecomendation`;
CREATE TABLE `restaurantrecomendation` (
  `recomendationid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `recomendation` varchar(500) DEFAULT NULL,
  `recomendation_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recomendationid`),
  KEY `fk_restaurantrecomendation_1_idx` (`uid`),
  CONSTRAINT `fk_restaurantrecomendation_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
); 


DROP TABLE IF EXISTS `restaurantreview`;
CREATE TABLE `restaurantreview` (
  `reviewid` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `review` varchar(500) DEFAULT NULL,
  `review_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewid`),
  KEY `fk_restaurantreview_1_idx` (`restaurantid`),
  KEY `fk_restaurantreview_2_idx` (`uid`),
  CONSTRAINT `fk_restaurantreview_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurantreview_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `restaurantschedule`;
CREATE TABLE `restaurantschedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantid` int(11) NOT NULL,
  `scheduledate` varchar(10) NOT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `fk_restaurantschedule_1_idx` (`restaurantid`),
  CONSTRAINT `fk_restaurantschedule_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `roletype` varchar(50) NOT NULL,
  PRIMARY KEY (`roleid`)
);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `create_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `roleid` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `fk_user_1_idx` (`roleid`),
  CONSTRAINT `fk_user_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
);

