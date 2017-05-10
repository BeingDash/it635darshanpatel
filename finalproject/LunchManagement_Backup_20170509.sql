-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: LunchManagement
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `empdayoff`
--

DROP TABLE IF EXISTS `empdayoff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empdayoff` (
  `dayoffid` int(11) NOT NULL AUTO_INCREMENT,
  `empid` int(11) NOT NULL,
  `dayoffdate` varchar(10) NOT NULL,
  `reason` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`dayoffid`),
  KEY `fk_empdayoff_1_idx` (`empid`),
  CONSTRAINT `fk_empdayoff_1` FOREIGN KEY (`empid`) REFERENCES `employees` (`empid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empdayoff`
--

LOCK TABLES `empdayoff` WRITE;
/*!40000 ALTER TABLE `empdayoff` DISABLE KEYS */;
INSERT INTO `empdayoff` VALUES (1,3,'20170224','sick'),(2,4,'20170227','Miami'),(3,4,'20170228','Miami'),(4,7,'20170303','flu'),(5,5,'20170321','Traveling to HealthCare Conference'),(6,5,'20170322','Traveling to HealthCare Conference');
/*!40000 ALTER TABLE `empdayoff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Darshan Patel','1 Main St','','Passaic','NJ','07055','9731112222','darshan@gmail.com','work and study'),(2,'John Smith','11 Blaine St','Fl 3','Clifton','NJ','07013','9732112322','js1234@gmail.com',''),(3,'Lee Smulen','jfk boulevard St','apt1','newark','NJ','07062','9737651986','smulenl12@gmail.com','need a pay raise'),(4,'Francesca Sauchelli','Katherine St','','belleville','NJ','07071','9738874433','fansau3@gmail.com','work more'),(5,'Maria Martins','Clifton ave ','fl2','bloomfield','NJ','07077','9731116547','maria17@gmail.com','need to be fired soon'),(6,'Nelson Rodriguez','Hollywood ave ','','Little falls','NJ','07097','97300001231','rodri00@gmail.com','highly ambitious'),(7,'Donna Paquinn','15 Glassgow  St','apt35','Maple wood','NJ','07059','9731055444','paq44@gmail.com','want to marry a rich guy'),(8,'Deep Sethi','23 Howard pl ','fl7','Jersey city','NJ','07124','9731458080','deeps80@gmail.com','I love to play dirty politics'),(9,'Pratima Sugrim','503 Passaic St','','West orange','NJ','07011','9731112222','timakamala@gmail.com','I got rudimentary mind'),(10,'Miller Watson','Vanhauten ave ','apt9','East orange','NJ','07988','9732121767','watson67mil@gmail.com','Big trump supporter');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lunchinvoice`
--

DROP TABLE IF EXISTS `lunchinvoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lunchinvoice` (
  `lunchinvoiceid` int(11) NOT NULL AUTO_INCREMENT,
  `lunchinvoicedate` datetime DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT '0.00',
  `tax` decimal(10,2) GENERATED ALWAYS AS (((`amount` - `discount`) * 0.07)) VIRTUAL,
  `tip` decimal(10,2) DEFAULT '0.00',
  `subtotal` decimal(10,2) GENERATED ALWAYS AS ((((`amount` - `discount`) + `tax`) + `tip`)) VIRTUAL,
  `restaurantid` int(11) NOT NULL,
  PRIMARY KEY (`lunchinvoiceid`),
  KEY `fk_lunchinvoice_1_idx` (`restaurantid`),
  CONSTRAINT `fk_lunchinvoice_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lunchinvoice`
--

LOCK TABLES `lunchinvoice` WRITE;
/*!40000 ALTER TABLE `lunchinvoice` DISABLE KEYS */;
INSERT INTO `lunchinvoice` (`lunchinvoiceid`, `lunchinvoicedate`, `amount`, `discount`, `tip`, `restaurantid`) VALUES (1,'2017-02-20 00:00:00',100.00,0.00,13.00,1),(2,'2017-02-21 00:00:00',95.00,5.00,13.70,5),(3,'2017-02-22 00:00:00',103.00,0.00,15.00,7),(4,'2017-02-23 00:00:00',99.00,5.00,12.00,9),(5,'2017-02-24 00:00:00',100.00,0.00,14.00,1),(6,'2017-02-27 00:00:00',127.00,5.00,16.00,4),(7,'2017-02-28 00:00:00',113.00,3.00,15.00,6),(8,'2017-03-01 00:00:00',105.00,0.00,10.00,8),(9,'2017-03-02 00:00:00',102.00,0.00,13.00,10),(11,'2017-03-03 00:00:00',105.00,5.00,14.00,2);
/*!40000 ALTER TABLE `lunchinvoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lunchorder`
--

DROP TABLE IF EXISTS `lunchorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lunchorder` (
  `lunchorderid` int(11) NOT NULL AUTO_INCREMENT,
  `orderitem` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `lunchordercomment` varchar(500) DEFAULT NULL,
  `restaurantid` int(11) NOT NULL,
  `orderdate` varchar(10) NOT NULL,
  PRIMARY KEY (`lunchorderid`),
  KEY `fk_lunchorder_1_idx` (`uid`),
  KEY `fk_lunchorder_2_idx` (`restaurantid`),
  CONSTRAINT `fk_lunchorder_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lunchorder_2` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lunchorder`
--

LOCK TABLES `lunchorder` WRITE;
/*!40000 ALTER TABLE `lunchorder` DISABLE KEYS */;
INSERT INTO `lunchorder` VALUES (1,'chicken chalupa',1,NULL,1,'20170220'),(2,'mexican pizza extra fire sauce on side',2,NULL,1,'20170220'),(3,'veggie qusedilla',3,NULL,1,'20170220'),(4,'chalupa with beans',4,NULL,1,'20170220'),(5,'2 chicken chalupa',5,NULL,1,'20170220'),(6,'2 burritos',6,NULL,1,'20170220'),(7,'chicken chalupa and mexican pizza',7,NULL,1,'20170220'),(8,'crispy taco and chalupa with beans',8,NULL,1,'20170220'),(9,'3 crispy tacos',9,NULL,1,'20170220'),(10,'2 mexican pizzas and coke',10,NULL,1,'20170220'),(11,'plain personal pie',1,NULL,5,'20170221'),(12,'ceasar salad with chicken',2,NULL,5,'20170221'),(13,'personal pie with peperonni',3,NULL,5,'20170221'),(14,'personal pie with peperonni',4,NULL,5,'20170221'),(15,'2 veggie slices',5,NULL,5,'20170221'),(16,'italian salad with chicken',6,NULL,5,'20170221'),(17,'italian salad with chicken',7,NULL,5,'20170221'),(18,'romeos special pasta with red sauce',8,NULL,5,'20170221'),(19,'personal pie with peperonni',9,NULL,5,'20170221'),(20,'2 veggie slices',10,NULL,5,'20170221'),(21,'12 inch sub with chiken and all veggies',1,NULL,7,'20170222'),(22,'6 inch sub with all veggies no meat',2,NULL,7,'20170222'),(23,'6 inch sub with all veggies no meat',3,NULL,7,'20170222'),(24,'6 inch sub with all veggies no meat',4,NULL,7,'20170222'),(25,'12 inch sub with all veggies and beef',5,NULL,7,'20170222'),(26,'6 inch veggie sub and cookie',6,NULL,7,'20170222'),(27,'6 inch chicken sub with cookie and coke',7,NULL,7,'20170222'),(28,'12 inch sub with veggie patty',8,NULL,7,'20170222'),(29,'6 inch sub with italian bread and all veggie except mushroom',9,NULL,7,'20170222'),(30,'6 inch veggie sub with guac and coke',10,NULL,7,'20170222'),(31,'veggie bowl',1,NULL,9,'20170223'),(32,'chiken burrito',2,NULL,9,'20170223'),(33,'salad bowl with chicken',3,NULL,9,'20170223'),(34,'chips and salsa',4,NULL,9,'20170223'),(35,'veggie bowl',5,NULL,9,'20170223'),(36,'salad with chicken',6,NULL,9,'20170223'),(37,'nachos',7,NULL,9,'20170223'),(38,'bowl with beef',8,NULL,9,'20170223'),(39,'chips and salsa and coke',9,NULL,9,'20170223'),(40,'burrito',10,NULL,9,'20170223'),(41,'2 chicken chalupas',1,NULL,1,'20170224'),(42,'mexican pizza extra hot sauce on side',2,NULL,1,'20170224'),(44,'chalupa with beans',4,NULL,1,'20170224'),(45,'2 chicken chalupa no sour cream',5,NULL,1,'20170224'),(46,'1 burrito',6,NULL,1,'20170224'),(47,'chicken chalupa and mexican pizza',7,NULL,1,'20170224'),(48,'crispy taco and chalupa with beans',8,NULL,1,'20170224'),(49,'2 crispy tacos',9,NULL,1,'20170224'),(50,'2 mexican pizzas and coke',10,NULL,1,'20170224'),(51,'paneer naan and rice',1,NULL,4,'20170227'),(52,'chicken tikka ',2,NULL,4,'20170227'),(53,'navratan korma',3,NULL,4,'20170227'),(55,'pav bhaji',5,NULL,4,'20170227'),(56,'chiken biryani',6,NULL,4,'20170227'),(57,'paneer tikka',7,NULL,4,'20170227'),(58,'paneer tikka',8,NULL,4,'20170227'),(59,'butter chiken',9,NULL,4,'20170227'),(60,'special curry with naan',10,NULL,4,'20170227'),(61,'chiken naan and rice',1,NULL,6,'20170228'),(62,'paneer tikka ',2,NULL,6,'20170228'),(63,'indo chinese special',3,NULL,6,'20170228'),(65,'goat curry',5,NULL,6,'20170228'),(66,'lamb with veggies',6,NULL,6,'20170228'),(67,'paneer kati roll',7,NULL,6,'20170228'),(68,'egg curry',8,NULL,6,'20170228'),(69,'butter masala chicken',9,NULL,6,'20170228'),(70,'paneer tikka',10,NULL,6,'20170228'),(71,'special panera sandwich',1,NULL,8,'20170301'),(72,'greek salad',2,NULL,8,'20170301'),(73,'salad and soup lunch special',3,NULL,8,'20170301'),(74,'salad with bread on side',4,NULL,8,'20170301'),(75,'ceaser salad',5,NULL,8,'20170301'),(76,'special panera sandwich',6,NULL,8,'20170301'),(77,'greek salad',7,NULL,8,'20170301'),(78,'Salad and sandwich lunch special',8,NULL,8,'20170301'),(79,'panera veggie sandwich',9,NULL,8,'20170301'),(80,'Special panera salad',10,NULL,8,'20170301'),(81,'kosher special pasta with red sauce',1,NULL,10,'20170302'),(82,'burrito',2,NULL,10,'20170302'),(83,'ceaser salad with chicken',3,NULL,10,'20170302'),(84,'kosher special pasta with red sauce',4,NULL,10,'20170302'),(85,'person cheese pizza',5,NULL,10,'20170302'),(86,'personal pie ',6,NULL,10,'20170302'),(87,'italian salad',7,NULL,10,'20170302'),(88,'broccoli with garlic sauce',8,NULL,10,'20170302'),(89,'grilled veggies',9,NULL,10,'20170302'),(90,'bean burrito',10,NULL,10,'20170302'),(91,'mexican omelet with home fries',1,NULL,2,'20170303'),(92,'veggie omelet',2,NULL,2,'20170303'),(93,'egg salad',3,NULL,2,'20170303'),(94,'mexican omelet with toast',4,NULL,2,'20170303'),(95,'chicken salad',5,NULL,2,'20170303'),(96,'tick tock special',6,NULL,2,'20170303'),(98,'omelete with extra cheese',8,NULL,2,'20170303'),(99,'chicken salad',9,NULL,2,'20170303'),(100,'italian salad with beef',10,NULL,2,'20170303'),(122,'veggie bowl',1,NULL,9,'20170316'),(123,'chiken burrito',2,NULL,9,'20170316'),(124,'salad bowl with chicken',3,NULL,9,'20170316'),(125,'chips and salsa',4,NULL,9,'20170316'),(126,'veggie bowl',5,NULL,9,'20170316'),(127,'salad with chicken',6,NULL,9,'20170316'),(128,'nachos',7,NULL,9,'20170316'),(129,'bowl with beef',8,NULL,9,'20170316'),(130,'chips and salsa and coke',9,NULL,9,'20170316'),(131,'burrito',10,NULL,9,'20170316'),(132,'2 chicken chalupas',1,NULL,1,'20170317'),(133,'mexican pizza extra hot sauce on side',2,NULL,1,'20170317'),(134,'veggie qusedilla',3,NULL,1,'20170317'),(135,'chalupa with beans',4,NULL,1,'20170317'),(136,'2 chicken chalupa no sour cream',5,NULL,1,'20170317'),(137,'1 burrito',6,NULL,1,'20170317'),(138,'chicken chalupa and mexican pizza',7,NULL,1,'20170317'),(139,'crispy taco and chalupa with beans',8,NULL,1,'20170317'),(140,'2 crispy tacos',9,NULL,1,'20170317'),(141,'2 mexican pizzas and coke',10,NULL,1,'20170317'),(142,'paneer naan and rice',1,NULL,4,'20170320'),(143,'chicken tikka ',2,NULL,4,'20170320'),(144,'navratan korma',3,NULL,4,'20170320'),(145,'dosa',4,NULL,4,'20170320'),(146,'pav bhaji',5,NULL,4,'20170320'),(147,'chiken biryani',6,NULL,4,'20170320'),(148,'paneer tikka',7,NULL,4,'20170320'),(149,'paneer tikka',8,NULL,4,'20170320'),(150,'butter chiken',9,NULL,4,'20170320'),(151,'special curry with naan',10,NULL,4,'20170320'),(152,'chiken naan and rice',1,NULL,6,'20170321'),(153,'paneer tikka ',2,NULL,6,'20170321'),(154,'indo chinese special',3,NULL,6,'20170321'),(155,'biryani',4,NULL,6,'20170321'),(156,'lamb with veggies',6,NULL,6,'20170321'),(157,'paneer kati roll',7,NULL,6,'20170321'),(158,'egg curry',8,NULL,6,'20170321'),(159,'butter masala chicken',9,NULL,6,'20170321'),(163,'salad and soup lunch special',3,NULL,8,'20170322'),(164,'salad with bread on side',4,NULL,8,'20170322'),(165,'special panera sandwich',6,NULL,8,'20170322'),(166,'greek salad',7,NULL,8,'20170322'),(167,'Salad and sandwich lunch special',8,NULL,8,'20170322'),(168,'panera veggie sandwich',9,NULL,8,'20170322'),(169,'Special panera salad',10,NULL,8,'20170322'),(170,'paneer tikka',10,NULL,6,'20170321');
/*!40000 ALTER TABLE `lunchorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuitem`
--

DROP TABLE IF EXISTS `menuitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuitem`
--

LOCK TABLES `menuitem` WRITE;
/*!40000 ALTER TABLE `menuitem` DISABLE KEYS */;
INSERT INTO `menuitem` VALUES (1,'1','chalupa','3.50','','',1),(2,'2','qusedilla','4.50','','',1),(3,'3','burrito','4.00','','',1),(4,'4','nachos','2.50','','',1),(5,'5','chicken and rice','5.50','','',1),(6,'6','crispy taco','4.00','','',1),(7,'1','garden omlet','7.50','','',2),(8,'2','blackened salmon','12.50','','',2),(9,'3','tick tock special','15.50','','',2),(10,'4','volcano eggfry','6.50','','',2),(11,'5','brazilian egg mushroom fry','7.50','','',2),(12,'1','rava dosa','8.50','','',3),(13,'2','udupi tava masala dosa','9.50','','',3),(14,'3','double cheese masala dosa','8.50','','',3),(15,'4','onion masala dosa','7.50','','',3),(16,'1','dry manchurian','10.50','','',4),(17,'2','hakka noodles','11.50','','',4),(18,'3','chinese salmon fry','14.50','','',4),(19,'4','bollywood special bacon crispynoodles','14.50','','',4),(20,'5','yunkung chicken','7.50','','',4),(21,'1','romeos special pizza','11.50','','',5),(22,'2','mozerella sticks','3.50','','',5),(23,'3','grilled sandwich','7.50','','',5),(24,'4','chocolate crisp bread','8.50','','',5),(25,'1','paneer tikka masala','9.50','','',6),(26,'2','chicken curry','7.50','','',6),(27,'3','roasted bacon curry','11.50','','',6),(28,'1','chocolate chipcookie','1.50','','',7),(29,'2','strawberry colata','3.50','','',7),(30,'3','sub special sandwich','7.50','','',7),(31,'4','french fries','4.50','','',7),(32,'2','brown bread','3.50','','',8),(33,'3','garden salad','7.50','','pick the item',8),(34,'1','mexican soft tacos','5.50','','',9),(35,'2','roasted chicken salad','7.50','','',9),(36,'4','garden chicken bowl','11.50','','',9),(37,'1','kosher falafel','7.50','','pick upto 4 falafel balls',10),(38,'2','kosher salmon over rice','14.50','','',10),(39,'3','kosher veggie special','10.50','','pick up the vegetables',10);
/*!40000 ALTER TABLE `menuitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratingmaster`
--

DROP TABLE IF EXISTS `ratingmaster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratingmaster` (
  `rating` int(11) NOT NULL AUTO_INCREMENT,
  `ratingdescription` varchar(45) NOT NULL,
  PRIMARY KEY (`rating`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratingmaster`
--

LOCK TABLES `ratingmaster` WRITE;
/*!40000 ALTER TABLE `ratingmaster` DISABLE KEYS */;
INSERT INTO `ratingmaster` VALUES (1,'horrible'),(2,'bad'),(3,'average'),(4,'good'),(5,'excellent');
/*!40000 ALTER TABLE `ratingmaster` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES (1,'taco bell','123 rt 4 east','','teaneck','nj','07666','2018089191','','tacobell_teaneck@tacobell.com','Luis Sanchez - Manager','','Y'),(2,'tick tock diner','1 rt 46 east','','Little falls','nj','07667','2017935544','','ticktock46@tacobell.com','William Fernandez - Manager','','Y'),(3,'15 Golden tulip','13 clifton ave','','Parsipanny','nj','07846','2012450808','','golden15tulipo@gmail.com','Ceaser Oneil Ramdell - Manager','','Y'),(4,'Bollywood Grill','105 kathleen st','','newark','nj','07611','2013335191','','grill_bollywood@yahoo.com','Laxmikant Apte - Manager','','Y'),(5,'Romeos Pizza','100 paulison ave','','Passaic','nj','07055','2018085121','','pizzamiamor@gmail.com','Hepal patel - Manager','','Y'),(6,'Mausam','129 grove st','','belleville','nj','07612','2013535551','','mausam_indiancuisine@gmail.com','Dharmendra chandrana - Manager','','Y'),(7,'Subway','100 rt 295 east','','bonton','nj','07611','2018777191','','subton77@subway.com','Karen Mccenza - Manager','','Y'),(8,'Panera Bread','55 Main st','','clifton','nj','07146','2018069911','','panbread@panera.com','Maria cordova - Manager','','Y'),(9,'chipotle','10 teaneck st','','teaneck','nj','07666','2018088181','','chipotle_teaneck@chipotle.com','rojo Sanchez','','Y'),(10,'kosher experience','31 vermont st','','lodi','nj','07011','2018089232','','ke23@gmail.com','Lior Hod - Owner','','Y'),(11,'Olive Garden','Rt 3 CLifton',NULL,NULL,NULL,NULL,'9734445555',NULL,NULL,NULL,NULL,'Y'),(12,'Mi Rancho','123 Cedar Ln - Teaneck',NULL,NULL,NULL,NULL,'201-666-2222',NULL,NULL,NULL,NULL,'Y');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurantrecomendation`
--

DROP TABLE IF EXISTS `restaurantrecomendation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurantrecomendation` (
  `recomendationid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `recomendation` varchar(500) DEFAULT NULL,
  `recomendation_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recomendationid`),
  KEY `fk_restaurantrecomendation_1_idx` (`uid`),
  CONSTRAINT `fk_restaurantrecomendation_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurantrecomendation`
--

LOCK TABLES `restaurantrecomendation` WRITE;
/*!40000 ALTER TABLE `restaurantrecomendation` DISABLE KEYS */;
INSERT INTO `restaurantrecomendation` VALUES (1,1,'Olive Garden Rt 3 - it has great food','2017-03-19 00:59:39'),(2,1,'Cheese Cake Factory may be? - not sure theres one close by though.','2017-03-19 01:00:58'),(3,1,'Food from Trump Tower','2017-03-19 01:02:14'),(6,1,'Lets try out Sababa Grill. They have great falafel.','2017-03-20 19:07:33'),(7,8,'Pizza Hut please. Who doesnt like to eat cardboard pizza. They are everywhere.','2017-03-20 19:12:39'),(8,2,'White Castle','2017-03-20 19:13:18'),(9,2,'Jose Tejas - best mexican food','2017-03-20 19:19:54'),(10,8,'Burger King','2017-03-20 19:21:36'),(11,2,'test','2017-03-22 17:46:18'),(12,7,'Lets try Wendys? I am all in for Junk Food','2017-03-22 19:42:15');
/*!40000 ALTER TABLE `restaurantrecomendation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurantreview`
--

DROP TABLE IF EXISTS `restaurantreview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurantreview` (
  `reviewid` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `review` varchar(500) NOT NULL,
  `rating` int(1) NOT NULL,
  `review_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewid`),
  KEY `fk_restaurantreview_1_idx` (`restaurantid`),
  KEY `fk_restaurantreview_2_idx` (`uid`),
  KEY `fk_restaurantreview_3_idx` (`rating`),
  CONSTRAINT `fk_restaurantreview_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurantreview_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurantreview_3` FOREIGN KEY (`rating`) REFERENCES `ratingmaster` (`rating`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurantreview`
--

LOCK TABLES `restaurantreview` WRITE;
/*!40000 ALTER TABLE `restaurantreview` DISABLE KEYS */;
INSERT INTO `restaurantreview` VALUES (1,1,1,'Taco Bell has the best food ever. I love the fire sauce.',4,'2017-03-20 16:22:09'),(2,2,3,'Can we not do this place all the time?',3,'2017-03-20 16:22:09'),(3,1,8,'Taco Bell for President',5,'2017-03-20 16:22:09'),(4,7,7,'I do not like this place. Their subs are always soggy.',2,'2017-03-20 16:22:09'),(5,5,5,'I would rather starve.',1,'2017-03-20 16:22:09'),(6,6,1,'Awful Food',1,'2017-03-20 16:26:44'),(7,5,2,'Great Pizza',5,'2017-03-20 17:24:22'),(8,7,2,'could be better',3,'2017-03-20 17:25:36'),(9,8,2,'You are not my friend if you dont like Panera. Who doesnt like Panera?',5,'2017-03-20 17:38:07'),(11,10,2,'Why do we not have 0 as option? Enough said',1,'2017-03-20 17:40:35'),(12,10,8,'this is place is okay',2,'2017-03-20 17:41:26'),(14,9,6,'bowl all day everyday',5,'2017-03-20 20:39:44'),(15,11,7,'Great Food',5,'2017-03-20 20:48:06'),(16,1,7,'Great Food',2,'2017-03-20 20:59:38'),(17,8,7,'wish it was better',2,'2017-03-20 21:00:16'),(18,9,7,'love the burrito',4,'2017-03-20 21:01:12'),(19,5,3,'no one makes better pizza',5,'2017-03-20 21:02:20'),(20,1,3,'I love the chalupas and mexican pizzas.',5,'2017-03-20 21:04:31'),(21,1,1,'great place',4,'2017-03-22 00:02:14'),(22,1,8,'love the mexican pizza',5,'2017-03-22 17:21:04'),(23,5,2,'Romeos has the best pizza',5,'2017-03-22 19:39:49'),(24,1,1,'awesome food and customer service except extra taco sauce',4,'2017-05-07 18:43:31'),(25,6,1,'worst food i ever tried in my life',1,'2017-05-07 18:43:31'),(26,8,1,'my expectation did not meet the food quality, soup was tasteless and sandwich had a weird soury taste',1,'2017-05-07 18:43:31'),(27,5,1,'i love their pizza and i can literally eat it 24*7',5,'2017-05-07 18:43:31'),(28,2,1,'quite expensive food  and food was decent',3,'2017-05-07 18:43:31'),(29,3,1,'i didd not like their parking facilities otherwise food was good.',3,'2017-05-07 18:43:31'),(30,4,1,'I absolutely love this place, their chinese food is delicious',4,'2017-05-07 18:43:31'),(31,9,1,'good food with better prices',5,'2017-05-07 18:43:31'),(32,10,1,'It was my first ever experience and did not like food',2,'2017-05-07 18:43:31'),(33,2,1,'f',3,'2017-05-09 02:16:34'),(34,3,1,'g',2,'2017-05-09 02:17:20'),(35,4,1,'h',1,'2017-05-09 02:17:20'),(36,9,1,'i',5,'2017-05-09 02:17:20'),(37,10,1,'j',4,'2017-05-09 02:17:20'),(38,1,1,'a1',5,'2017-05-09 02:17:51'),(39,1,1,'fire sauce :)',5,'2017-05-09 16:24:31'),(40,7,1,'fake chicken',1,'2017-05-09 16:24:31'),(41,6,1,'worst food',1,'2017-05-09 16:24:31'),(42,8,1,'tomato soup is awesome',4,'2017-05-09 16:24:31'),(43,5,1,'Never had pizza this good',5,'2017-05-09 16:24:31'),(44,2,1,'great desert options',4,'2017-05-09 16:24:31'),(45,4,1,'Daal is delicious otherwise its okay',3,'2017-05-09 16:24:31'),(46,9,1,'burrito is underrated',4,'2017-05-09 16:24:31'),(47,10,1,'do me a favor and ignore this place',1,'2017-05-09 16:24:31');
/*!40000 ALTER TABLE `restaurantreview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurantschedule`
--

DROP TABLE IF EXISTS `restaurantschedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurantschedule` (
  `scheduleid` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantid` int(11) NOT NULL,
  `scheduledate` varchar(10) NOT NULL,
  PRIMARY KEY (`scheduleid`),
  KEY `fk_restaurantschedule_1_idx` (`restaurantid`),
  CONSTRAINT `fk_restaurantschedule_1` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`restaurantid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurantschedule`
--

LOCK TABLES `restaurantschedule` WRITE;
/*!40000 ALTER TABLE `restaurantschedule` DISABLE KEYS */;
INSERT INTO `restaurantschedule` VALUES (1,1,'20170206'),(2,3,'20170207'),(3,5,'20170208'),(4,7,'20170209'),(5,9,'20170210'),(6,2,'20170213'),(7,4,'20170214'),(8,6,'20170215'),(9,8,'20170216'),(10,10,'20170217'),(11,1,'20170220'),(12,5,'20170221'),(13,7,'20170222'),(14,9,'20170223'),(15,1,'20170224'),(16,4,'20170227'),(17,6,'20170228'),(18,8,'20170301'),(19,10,'20170302'),(20,2,'20170303'),(21,4,'20170320'),(22,6,'20170321'),(23,8,'20170322'),(24,10,'20170323'),(25,2,'20170324'),(26,9,'20170316'),(27,1,'20170317');
/*!40000 ALTER TABLE `restaurantschedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `roletype` varchar(50) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin'),(2,'user'),(3,'guest');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `create_timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `roleid` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `fk_user_1_idx` (`roleid`),
  CONSTRAINT `fk_user_1` FOREIGN KEY (`roleid`) REFERENCES `role` (`roleid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'root','de362bbdf11f2df30d12f318eeed87b8ee9e0c69c8ba61ed9a57695bbd91e481',1,'','2017-02-25 18:19:32',1),(2,'john','82dbb93f46459ee92764c7651d7c28ff32d09aed84a073923bd7e93c96b6e0dc',2,'','2017-02-25 18:19:32',2),(3,'lee','a064f7dcb7fa65311d9bb02b606c836f0f3576c502b0d1c2647fd2ce40177157',3,'','2017-02-25 18:19:32',2),(4,'f123','hahahareally',4,'','2017-02-25 18:19:32',2),(5,'maria1','passwordisnopassword',5,'','2017-02-25 18:19:32',2),(6,'nel24','secret123',6,'','2017-02-25 18:19:32',2),(7,'dondon','123456',7,'','2017-02-25 18:19:32',2),(8,'deep','notsodeep',8,'','2017-02-25 18:19:32',2),(9,'prats11','ilovegiants',9,'','2017-02-25 18:19:32',2),(10,'millernotlite','budnotlite',10,'','2017-02-25 18:19:32',2),(11,'lisaterry','guest123',NULL,'sheila@gmail.com','2017-02-25 18:22:13',3),(12,'waynerooney','ronaldomessi',NULL,'iamyourguest@gmail.com','2017-02-25 18:22:15',3),(13,'Hepal','38da0e140f54c340ab76d1af30882cf88d674dc6927babb43a0ecc8e5f159d14',NULL,'hp@gmail.com','2017-05-09 21:00:55',1),(14,'hashed','1a06df824ed741b53c785079a6347f00eec5af82f9850775409ca69dff4068a6',NULL,'hashed@test.com','2017-05-09 21:08:31',3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-09 22:53:42
