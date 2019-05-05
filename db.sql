/*
SQLyog Community v13.0.1 (64 bit)
MySQL - 5.1.33-community : Database - bus-tracker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bus-tracker` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bus-tracker`;

/*Table structure for table `bus` */

DROP TABLE IF EXISTS `bus`;

CREATE TABLE `bus` (
  `driver` varchar(100) NOT NULL,
  `route_codename` varchar(50) NOT NULL,
  `seat_total` int(11) DEFAULT NULL,
  `plate_number` varchar(50) DEFAULT NULL,
  `is_full` tinyint(1) DEFAULT '0',
  `firebase_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bus` */

insert  into `bus`(`driver`,`route_codename`,`seat_total`,`plate_number`,`is_full`,`firebase_id`) values 
('john','T5',100,'SA84930',0,'-Le0BoL4I4YA17Ir4D2L'),
('ahmad','T5',100,'ZAC8594',0,'-Le0BsKqr3nmN9OYvxMg'),
('marvin','T3',100,'SA7779',0,'-Le0ByNu6fHauQR_ELfb'),
('gillaleo','T5',100,'SAB7777',0,'-Le0DlgZ9ttLYLk5RwjP'),
('gillaleo','T5',100,'XX8979',0,'-Le5Jh5-3-8LNKPdjrQc');

/*Table structure for table `driver` */

DROP TABLE IF EXISTS `driver`;

CREATE TABLE `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `driver` */

insert  into `driver`(`id`,`name`) values 
(2,'JOHN'),
(3,'AHMAD'),
(4,'MARVIN'),
(5,'GILALEO'),
(6,'ZULKARNAIN');

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `codename` varchar(50) NOT NULL,
  `route_array` text NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `route_start` varchar(50) NOT NULL,
  `route_end` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `routes` */

insert  into `routes`(`codename`,`route_array`,`route_name`,`route_start`,`route_end`) values 
('T3','6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230,6.035872-116.116665,6.041379-116.123201,6.045237-116.128109,6.050041-116.133079,6.045205-116.130234,6.045163-116.128441,6.040422-116.124328','TESTING3','6.033250,116.118115','6.033450,116.113050'),
('T5','6.0364908-116.1203991,6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230,6.035872-116.116665,6.041379-116.123201,6.045237-116.128109,6.050041-116.133079,6.045205-116.130234,6.045163-116.128441,6.040422-116.124328,6.042159-116.125114','TESTING5','6.040422,116.124328','6.042159,116.125114');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user` */

/*Table structure for table `waypoints` */

DROP TABLE IF EXISTS `waypoints`;

CREATE TABLE `waypoints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stop_name` text NOT NULL,
  `stop_location` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `waypoints` */

insert  into `waypoints`(`id`,`stop_name`,`stop_location`) values 
(4,'FKJ','6.0364908,116.1203991'),
(5,'PPIB','6.033250, 116.118115'),
(6,'DEWAN RESITAL','6.032428, 116.115643'),
(7,'IPB','6.033450, 116.113050'),
(8,'IPMB','6.035582, 116.113230'),
(9,'CANSELORI','6.035872, 116.116665'),
(10,'CAFE','6.041379, 116.123201'),
(11,'DKP BARU','6.045237, 116.128109'),
(12,'FPSK','6.050041, 116.133079'),
(13,'PALAPES','6.045205, 116.130234'),
(14,'PADANG KAWAD','6.045163, 116.128441'),
(15,'TM','6.040422, 116.124328'),
(16,'TF','6.042159, 116.125114');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
