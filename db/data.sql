/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.12-MariaDB : Database - inventory
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventory`;

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(120) DEFAULT '',
  `foto` varchar(250) DEFAULT '',
  `harga` double DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `stok` double DEFAULT 0,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `product` */

insert  into `product`(`id`,`nama`,`foto`,`harga`,`deskripsi`,`stok`,`insert_at`,`user_insert`,`update_at`,`user_update`) values 
(3,'Thermo Gun','202101060508.jpg',1700000,'',19,'2021-01-06 11:08:50','admin',NULL,''),
(4,'Gelas','202101060509.jpg',120000,'',90,'2021-01-06 11:09:10','admin',NULL,'');

/*Table structure for table `tb_menu` */

DROP TABLE IF EXISTS `tb_menu`;

CREATE TABLE `tb_menu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `label` varchar(120) DEFAULT '',
  `icon` varchar(60) DEFAULT '',
  `url` varchar(120) DEFAULT '',
  `fungsi` varchar(30) DEFAULT '',
  `method` varchar(30) DEFAULT '',
  `parent` int(20) DEFAULT 0,
  `urutan` double DEFAULT 0,
  `status` int(1) DEFAULT 1,
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `tb_menu` */

insert  into `tb_menu`(`id`,`label`,`icon`,`url`,`fungsi`,`method`,`parent`,`urutan`,`status`,`insert_at`,`user_insert`,`update_at`,`user_update`) values 
(1,'menu_dashboard','nav-icon fas fa-tachometer-alt','Main/index','Main','index',0,1,1,'2020-07-09 09:01:15','',NULL,''),
(4,'menu_logout','nav-icon fas fa-lock','','','',0,9999,1,'2020-07-09 11:08:32','',NULL,''),
(5,'menu_manajemen_menu','nav-icon fas fa-user','Menu/user','Menu','user',0,9998,1,'2020-07-24 13:19:07','',NULL,''),
(6,'menu_change_password','nav-icon fas fa-exchange-alt','User/change_password','User','change_password',0,9997,1,'2020-07-24 13:29:43','',NULL,''),
(7,'menu_management_user','nav-icon fas fa-user','User/index','User','index',0,9996,1,'2020-07-24 14:00:41','',NULL,''),
(31,'menu_products','nav-icon fas fa-box','Product/index','Product','index',0,2,1,'2021-01-06 09:58:52','',NULL,'');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `password` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `profile_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `image` varchar(250) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `phone` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `email` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `session` varchar(120) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  `language` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT 'english',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `update_at` datetime DEFAULT NULL,
  `user_update` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id`,`username`,`password`,`profile_name`,`image`,`phone`,`email`,`session`,`last_login`,`language`,`insert_at`,`user_insert`,`update_at`,`user_update`,`status`) values 
(1,'admin','7cfa28cde915ea86f0906b343435ce28','Super Admin','','','admin@localhost','b99d9c1af09425ab0d7c72e0708d1d5e','2021-01-06 09:54:41','english','2020-07-09 08:59:23','-','2020-07-27 10:51:09','admin',1);

/*Table structure for table `tb_user_menu` */

DROP TABLE IF EXISTS `tb_user_menu`;

CREATE TABLE `tb_user_menu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_menu` int(20) DEFAULT 0,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  `insert_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_insert` varchar(60) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user_menu` */

insert  into `tb_user_menu`(`id`,`id_menu`,`username`,`insert_at`,`user_insert`) values 
(73,1,'jpg','2020-08-18 15:01:35','admin'),
(74,2,'jpg','2020-08-18 15:01:35','admin'),
(75,3,'jpg','2020-08-18 15:01:35','admin'),
(76,4,'jpg','2020-08-18 15:01:35','admin'),
(77,6,'jpg','2020-08-18 15:01:35','admin'),
(78,9,'jpg','2020-08-18 15:01:35','admin'),
(79,1,'indo','2020-08-19 13:47:23','admin'),
(80,3,'indo','2020-08-19 13:47:23','admin'),
(81,4,'indo','2020-08-19 13:47:23','admin'),
(82,6,'indo','2020-08-19 13:47:23','admin'),
(83,9,'indo','2020-08-19 13:47:23','admin'),
(109,1,'budi','2020-08-19 15:29:09','admin'),
(110,2,'budi','2020-08-19 15:29:09','admin'),
(111,3,'budi','2020-08-19 15:29:09','admin'),
(112,4,'budi','2020-08-19 15:29:09','admin'),
(113,9,'budi','2020-08-19 15:29:09','admin'),
(155,1,'admin','2021-01-06 09:59:04','admin'),
(156,7,'admin','2021-01-06 09:59:04','admin'),
(157,6,'admin','2021-01-06 09:59:04','admin'),
(158,5,'admin','2021-01-06 09:59:04','admin'),
(159,4,'admin','2021-01-06 09:59:04','admin'),
(160,31,'admin','2021-01-06 09:59:04','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
