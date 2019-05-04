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
  `seat_total` int(11) DEFAULT NULL,
  `driver_array` text,
  `plate_number` varchar(50) DEFAULT NULL,
  `is_full` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `bus` */

insert  into `bus`(`seat_total`,`driver_array`,`plate_number`,`is_full`) values 
(100,NULL,'SA84930',0),
(100,NULL,'SM5678',0),
(100,NULL,'SA7779',0),
(100,NULL,'SM3468',0),
(100,NULL,'KL8909',0);

/*Table structure for table `routes` */

DROP TABLE IF EXISTS `routes`;

CREATE TABLE `routes` (
  `bus_id` varchar(50) NOT NULL,
  `route_array` text NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `route_start` varchar(50) NOT NULL,
  `route_end` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `routes` */

insert  into `routes`(`bus_id`,`route_array`,`route_name`,`route_start`,`route_end`) values 
('KL8909','6.033250-116.118115,6.032428-116.115643','KOLEJ KEDIAMAN TUN MUSTAPHA','6.0364908,116.1203991','6.042159,116.125114'),
('SA7779','6.0364908-116.1203991,6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230,6.035872-116.116665,6.041379-116.123201,6.045237-116.128109,6.050041-116.133079,6.045205-116.130234,6.045163-116.128441,6.040422-116.124328,6.042159-116.125114','KOLEJ KEDIAMAN EXCELLENT','6.040422,116.124328','6.042159,116.125114'),
('SM5678','6.0364908-116.1203991,6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230','SHORT','6.0364908,116.1203991','6.040422,116.124328');

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
