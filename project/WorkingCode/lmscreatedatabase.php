#!/usr/bin/php

 <?php
$servername = $argv[1];
$username = $argv[2];
$password = $argv[3];


// Creating Connection
$db = new mysqli($servername,$username,$password);
if ($db->connect_error) {
    die("Either the username and password is incorrect or you do not have privileges Connection failed: " . $db->connect_error);
}


// Creating database
$query = "DROP DATABASE IF EXISTS lmstest;

CREATE DATABASE lmstest;

USE lmstest;

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


DROP TABLE IF EXISTS `ratingmaster`;
CREATE TABLE `ratingmaster` (
  `rating` INT NOT NULL AUTO_INCREMENT,
  `ratingdescription` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`rating`));

DROP TABLE IF EXISTS `restaurantreview`;
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

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Darshan Patel','1 Main St','','Passaic','NJ','07055','9731112222','darshan@gmail.com','work and study');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('John Smith','11 Blaine St','Fl 3','Clifton','NJ','07013','9732112322','js1234@gmail.com','');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Lee Smulen','jfk boulevard St','apt1','newark','NJ','07062','9737651986','smulenl12@gmail.com','need a pay raise');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Francesca Sauchelli','Katherine St','','belleville','NJ','07071','9738874433','fansau3@gmail.com','work more');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Maria Martins','Clifton ave ','fl2','bloomfield','NJ','07077','9731116547','maria17@gmail.com','need to be fired soon');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Nelson Rodriguez','Hollywood ave ','','Little falls','NJ','07097','97300001231','rodri00@gmail.com','highly ambitious');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Donna Paquinn','15 Glassgow  St','apt35','Maple wood','NJ','07059','9731055444','paq44@gmail.com','want to marry a rich guy');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Deep Sethi','23 Howard pl ','fl7','Jersey city','NJ','07124','9731458080','deeps80@gmail.com','I love to play dirty politics');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Pratima Sugrim','503 Passaic St','','West orange','NJ','07011','9731112222','timakamala@gmail.com','I got rudimentary mind');

insert into employees (empname, empaddress1,empaddress2,empcity,empstate,empzip,empphone,empemail,empcomment) values ('Miller Watson','Vanhauten ave ','apt9','East orange','NJ','07988','9732121767','watson67mil@gmail.com','Big trump supporter');



insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('taco bell','123 rt 4 east','','teaneck','nj','07666','2018089191','','tacobell_teaneck@tacobell.com','Luis Sanchez - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('tick tock diner','1 rt 46 east','','Little falls','nj','07667','2017935544','','ticktock46@tacobell.com','William Fernandez - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('15 Golden tulip','13 clifton ave','','Parsipanny','nj','07846','2012450808','','golden15tulipo@gmail.com','Ceaser Oneil Ramdell - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('Bollywood Grill','105 kathleen st','','newark','nj','07611','2013335191','','grill_bollywood@yahoo.com','Laxmikant Apte - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('Romeos Pizza','100 paulison ave','','Passaic','nj','07055','2018085121','','pizzamiamor@gmail.com','Hepal patel - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('Mausam','129 grove st','','belleville','nj','07612','2013535551','','mausam_indiancuisine@gmail.com','Dharmendra chandrana - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('Subway','100 rt 295 east','','bonton','nj','07611','2018777191','','subton77@subway.com','Karen Mccenza - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('Panera Bread','55 Main st','','clifton','nj','07146','2018069911','','panbread@panera.com','Maria cordova - Manager','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('chipotle','10 teaneck st','','teaneck','nj','07666','2018088181','','chipotle_teaneck@chipotle.com','rojo Sanchez','','Y');

insert into restaurant (restaurantname,restaurantaddress1,restaurantaddress2,restaurantcity,restaurantstate,restaurantzip,restaurantphone,restaurantfax,restaurantemail,restaurantcontactperson,restaurantcomment,delivery)
values
('kosher experience','31 vermont st','','lodi','nj','07011','2018089232','','ke23@gmail.com','Lior Hod - Owner','','Y');



insert into role (roletype)
values ('admin');

insert into role (roletype)
values ('user');

insert into role (roletype)
values ('guest');


insert into user (uname,password,empid,email,roleid)
values ('root','rootpassword',1,'',1);

insert into user (uname,password,empid,email,roleid)
values ('john','ihatepwd',2,'',2);

insert into user (uname,password,empid,email,roleid)
values ('lee','coolguy1',3,'',2);

insert into user (uname,password,empid,email,roleid)
values ('f123','hahahareally',4,'',2);

insert into user (uname,password,empid,email,roleid)
values ('maria1','passwordisnopassword',5,'',2);

insert into user (uname,password,empid,email,roleid)
values ('nel24','secret123',6,'',2);

insert into user (uname,password,empid,email,roleid)
values ('dondon','123456',7,'',2);

insert into user (uname,password,empid,email,roleid)
values ('deep','notsodeep',8,'',2);

insert into user (uname,password,empid,email,roleid)
values ('prats11','ilovegiants',9,'',2);

insert into user (uname,password,empid,email,roleid)
values ('millernotlite','budnotlite',10,'',2);

insert into user (uname,password,empid,email,roleid)
values ('lisaterry','guest123',null,'sheila@gmail.com',3);

insert into user (uname,password,empid,email,roleid)
values ('waynerooney','ronaldomessi',null,'iamyourguest@gmail.com',3);




insert into restaurantschedule (restaurantid,scheduledate)
values (1,20170206);

insert into restaurantschedule (restaurantid,scheduledate)
values (3,20170207);

insert into restaurantschedule (restaurantid,scheduledate)
values (5,20170208);

insert into restaurantschedule (restaurantid,scheduledate)
values (7,20170209);

insert into restaurantschedule (restaurantid,scheduledate)
values (9,20170210);



insert into restaurantschedule (restaurantid,scheduledate)
values (2,20170213);

insert into restaurantschedule (restaurantid,scheduledate)
values (4,20170214);

insert into restaurantschedule (restaurantid,scheduledate)
values (6,20170215);

insert into restaurantschedule (restaurantid,scheduledate)
values (8,20170216);

insert into restaurantschedule (restaurantid,scheduledate)
values (10,20170217);



insert into restaurantschedule (restaurantid,scheduledate)
values (1,20170220);

insert into restaurantschedule (restaurantid,scheduledate)
values (5,20170221);

insert into restaurantschedule (restaurantid,scheduledate)
values (7,20170222);

insert into restaurantschedule (restaurantid,scheduledate)
values (9,20170223);

insert into restaurantschedule (restaurantid,scheduledate)
values (1,20170224);



insert into restaurantschedule (restaurantid,scheduledate)
values (4,20170227);

insert into restaurantschedule (restaurantid,scheduledate)
values (6,20170228);

insert into restaurantschedule (restaurantid,scheduledate)
values (8,20170301);

insert into restaurantschedule (restaurantid,scheduledate)
values (10,20170302);

insert into restaurantschedule (restaurantid,scheduledate)
values (2,20170303);



insert into restaurantschedule (restaurantid,scheduledate)
values (4,20170320);

insert into restaurantschedule (restaurantid,scheduledate)
values (6,20170321);

insert into restaurantschedule (restaurantid,scheduledate)
values (8,20170322);

insert into restaurantschedule (restaurantid,scheduledate)
values (10,20170323);

insert into restaurantschedule (restaurantid,scheduledate)
values (2,20170324);



Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken chalupa',1,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('mexican pizza extra fire sauce on side',2,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie qusedilla',3,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chalupa with beans',4,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 chicken chalupa',5,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 burritos',6,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken chalupa and mexican pizza',7,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('crispy taco and chalupa with beans',8,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('3 crispy tacos',9,1,20170220);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 mexican pizzas and coke',10,1,20170220);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('plain personal pie',1,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('ceasar salad with chicken',2,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('personal pie with peperonni',3,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('personal pie with peperonni',4,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 veggie slices',5,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('italian salad with chicken',6,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('italian salad with chicken',7,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('romeos special pasta with red sauce',8,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('personal pie with peperonni',9,5,20170221);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 veggie slices',10,5,20170221);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('12 inch sub with chiken and all veggies',1,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch sub with all veggies no meat',2,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch sub with all veggies no meat',3,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch sub with all veggies no meat',4,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('12 inch sub with all veggies and beef',5,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch veggie sub and cookie',6,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch chicken sub with cookie and coke',7,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('12 inch sub with veggie patty',8,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch sub with italian bread and all veggie except mushroom',9,7,20170222);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('6 inch veggie sub with guac and coke',10,7,20170222);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie bowl',1,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chiken burrito',2,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('salad bowl with chicken',3,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chips and salsa',4,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie bowl',5,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('salad with chicken',6,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('nachos',7,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('bowl with beef',8,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chips and salsa and coke',9,9,20170223);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('burrito',10,9,20170223);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 chicken chalupas',1,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('mexican pizza extra hot sauce on side',2,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie qusedilla',3,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chalupa with beans',4,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 chicken chalupa no sour cream',5,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('1 burrito',6,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken chalupa and mexican pizza',7,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('crispy taco and chalupa with beans',8,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 crispy tacos',9,1,20170224);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('2 mexican pizzas and coke',10,1,20170224);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer naan and rice',1,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken tikka ',2,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('navratan korma',3,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('dosa',4,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('pav bhaji',5,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chiken biryani',6,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer tikka',7,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer tikka',8,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('butter chiken',9,4,20170227);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('special curry with naan',10,4,20170227);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chiken naan and rice',1,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer tikka ',2,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('indo chinese special',3,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('biryani',4,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('goat curry',5,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('lamb with veggies',6,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer kati roll',7,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('egg curry',8,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('butter masala chicken',9,6,20170228);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('paneer tikka',10,6,20170228);

Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('special panera sandwich',1,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('greek salad',2,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('salad and soup lunch special',3,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('salad with bread on side',4,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('ceaser salad',5,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('special panera sandwich',6,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('greek salad',7,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('Salad and sandwich lunch special',8,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('panera veggie sandwich',9,8,20170301);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('Special panera salad',10,8,20170301);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('kosher special pasta with red sauce',1,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('burrito',2,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('ceaser salad with chicken',3,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('kosher special pasta with red sauce',4,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('person cheese pizza',5,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('personal pie ',6,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('italian salad',7,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('broccoli with garlic sauce',8,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('grilled veggies',9,10,20170302);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('bean burrito',10,10,20170302);


Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('mexican omelet with home fries',1,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie omelet',2,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('egg salad',3,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('mexican omelet with toast',4,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken salad',5,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('tick tock special',6,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('veggie omelete no mushroom',7,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('omelete with extra cheese',8,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('chicken salad',9,2,20170303);
Insert into lunchorder (orderitem,uid,restaurantid,orderdate)
values ('italian salad with beef',10,2,20170303);




insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170220',100,0,13,1);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170221',95,5,13.70,5);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170222',103,0,15,7);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170223',99,5,12,9);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170224',100,0,14,1);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170227',127,5,16,4);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170228',113,3,15,6);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170301',105,0,10,8);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170302',102,0,13,10);
insert into lunchinvoice (lunchinvoicedate,amount,discount,tip,restaurantid)
values ('20170303',105,5,14,2);


INSERT INTO `LunchManagement`.`ratingmaster` (`ratingdescription`) VALUES ('horrible');
INSERT INTO `LunchManagement`.`ratingmaster` (`ratingdescription`) VALUES ('bad');
INSERT INTO `LunchManagement`.`ratingmaster` (`ratingdescription`) VALUES ('average');
INSERT INTO `LunchManagement`.`ratingmaster` (`ratingdescription`) VALUES ('good');
INSERT INTO `LunchManagement`.`ratingmaster` (`ratingdescription`) VALUES ('excellent');



insert restaurantreview (restaurantid,uid,review,rating)
values (1,1,'Taco Bell has the best food ever. I love the fire sauce.',4)
,(2,3,'Can we not do this place all the time?',3)
,(1,8,'Taco Bell for President',5)
,(7,7,'I do not like this place. Their subs are always soggy.',2)
,(5,5,'I would rather starve.',1);





";


if ($db->multi_query($query) === TRUE) {
    echo "Database created successfully".PHP_EOL;
} else {
    echo "Error creating database: " . $db->error . PHP_EOL;
}

$db->close();
?> 






