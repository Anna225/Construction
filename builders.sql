/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.32-MariaDB : Database - builders
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`builders` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `builders`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(45) NOT NULL,
  `status_category` int(11) NOT NULL,
  `order_category` int(11) NOT NULL,
  `colour_category` varchar(45) NOT NULL,
  `logoclass_category` varchar(45) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id_category`,`name_category`,`status_category`,`order_category`,`colour_category`,`logoclass_category`) values 
(2,'Feeds',0,1,'0','fa fa-bitbucket'),
(3,'Expenses',0,0,'5','fa fa-shopping-cart'),
(4,'Medicines',0,1,'5','fa fa-ambulance'),
(5,'Vaccine',0,2,'5','fa fa-eyedropper'),
(6,'Labour',0,3,'5','fa fa-users'),
(7,'Machines',0,4,'5','fa fa-truck'),
(9,'Additive',0,2,'0','fa fa-bitbucket'),
(10,'Birth Cycle',0,7,'0','fa fa-recycle');

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `fk_countries` int(11) NOT NULL,
  `orderby` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cities` */

insert  into `cities`(`id`,`name`,`fk_countries`,`orderby`,`status`) values 
(1,'Lahore',54,1,1),
(4,'Islamabad',54,2,1),
(5,'Karachi',54,3,1),
(6,'Multan',54,4,1),
(7,'',0,0,0);

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`id`,`name`,`orderby`,`status`) values 
(54,'Pakistan',1,1),
(55,'England',2,1),
(56,'American',3,1),
(57,'Africa',4,1),
(58,'China',5,1);

/*Table structure for table `menusetting` */

DROP TABLE IF EXISTS `menusetting`;

CREATE TABLE `menusetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `maincate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `menusetting` */

insert  into `menusetting`(`id`,`name`,`url`,`orderby`,`status`,`icon`,`maincate`) values 
(5,'Dashboard','setting',1,1,'icon-speedometer','setting'),
(6,'Categories','setting/categories',2,1,'fa fa-folder-open','setting'),
(7,'Types','setting/types',3,1,'fa fa-bars','setting'),
(8,'Countries','setting/countries',4,1,'fa fa-group','setting'),
(9,'Cities','setting/cities',5,1,'fa fa-envelope','setting'),
(10,'Societies','setting/societies',6,1,'fa fa-calendar-check-o','setting'),
(11,'Req Cate','setting/reqcategories',7,1,'fa fa-folder-open','setting'),
(12,'Status Cate','setting/statuscategories',8,1,'fa fa-folder-open','setting');

/*Table structure for table `office_categories` */

DROP TABLE IF EXISTS `office_categories`;

CREATE TABLE `office_categories` (
  `id_categories` int(11) NOT NULL AUTO_INCREMENT,
  `name_categories` varchar(45) DEFAULT NULL,
  `orderby_categories` int(11) DEFAULT NULL,
  `status_categories` int(11) DEFAULT NULL,
  `icon_categories` varchar(50) NOT NULL,
  `bg_colour_categoires` varchar(50) NOT NULL,
  `textclass_categories` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `office_categories` */

insert  into `office_categories`(`id_categories`,`name_categories`,`orderby_categories`,`status_categories`,`icon_categories`,`bg_colour_categoires`,`textclass_categories`) values 
(1,'Construction',1,0,'far fa-building','bg-success','text-success'),
(2,'Renovation',2,0,'fas fa-tools','bg-orange','text-orange'),
(3,'Design',3,0,'fas fa-shopping-cart','bg-primary','text-primary'),
(4,'Propriety',4,0,'fas fa-pencil-ruler','bg-danger','text-danger');

/*Table structure for table `office_clients` */

DROP TABLE IF EXISTS `office_clients`;

CREATE TABLE `office_clients` (
  `id_clients` int(11) NOT NULL AUTO_INCREMENT,
  `name_clients` varchar(45) NOT NULL,
  `refby_clients` varchar(50) DEFAULT NULL,
  `date_clients` date NOT NULL,
  `fk_categories` int(11) NOT NULL,
  `fk_status` int(11) NOT NULL,
  `cnic_clients` varchar(50) DEFAULT NULL,
  `fk_office_types` int(11) NOT NULL,
  `fk_cities` int(11) NOT NULL,
  `fk_societies` int(11) NOT NULL,
  `phone_clients` varchar(50) NOT NULL,
  PRIMARY KEY (`id_clients`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

/*Data for the table `office_clients` */

insert  into `office_clients`(`id_clients`,`name_clients`,`refby_clients`,`date_clients`,`fk_categories`,`fk_status`,`cnic_clients`,`fk_office_types`,`fk_cities`,`fk_societies`,`phone_clients`) values 
(76,'Usman Nawaz','1','2020-01-13',1,1,NULL,0,0,0,'03471041008');

/*Table structure for table `office_requests` */

DROP TABLE IF EXISTS `office_requests`;

CREATE TABLE `office_requests` (
  `id_requests` int(11) NOT NULL AUTO_INCREMENT,
  `fk_office_clients` int(11) NOT NULL,
  `date_requests` date NOT NULL,
  `note` text,
  `fk_office_subcategories` int(11) NOT NULL,
  `fk_office_types` int(11) NOT NULL,
  `fk_city` int(11) NOT NULL,
  `fk_society` int(11) NOT NULL,
  `fk_status` int(11) NOT NULL,
  `address_clients` varchar(100) NOT NULL,
  `fk_reqcategory` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `byteam` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_requests`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `office_requests` */

insert  into `office_requests`(`id_requests`,`fk_office_clients`,`date_requests`,`note`,`fk_office_subcategories`,`fk_office_types`,`fk_city`,`fk_society`,`fk_status`,`address_clients`,`fk_reqcategory`,`updated_date`,`byteam`) values 
(57,76,'2020-01-13','pending',1,47,1,7,1,'166 Shaheen Block',2,'0000-00-00 00:00:00',NULL);

/*Table structure for table `office_subcategories` */

DROP TABLE IF EXISTS `office_subcategories`;

CREATE TABLE `office_subcategories` (
  `id_subcategories` int(11) NOT NULL AUTO_INCREMENT,
  `name_subcategories` varchar(45) DEFAULT NULL,
  `orderby_subcategories` int(11) DEFAULT NULL,
  `status_subcategories` int(11) DEFAULT NULL,
  `fk_office_categories` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_subcategories`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `office_subcategories` */

insert  into `office_subcategories`(`id_subcategories`,`name_subcategories`,`orderby_subcategories`,`status_subcategories`,`fk_office_categories`) values 
(1,'Grey Structure',1,0,1),
(2,'Finishing',2,0,1),
(4,'Repair House',1,0,2),
(11,'Residential Plot',1,0,4),
(13,'Commercial Plot',2,0,4),
(15,'Supervision ',3,0,1),
(16,'Labour Rate',4,0,1),
(17,'Repair Commerical',2,0,2),
(18,'Working Plan',2,0,3),
(19,'3D Interior',2,0,3),
(20,'Buy Residential House',3,1,4),
(23,'Sale House',1,1,4),
(27,'Repair Garden',3,1,2),
(28,'Repair Office',4,1,2),
(29,'Front 3D',3,1,3),
(30,'Garden 3D',4,1,3);

/*Table structure for table `office_types` */

DROP TABLE IF EXISTS `office_types`;

CREATE TABLE `office_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `office_types` */

insert  into `office_types`(`id`,`name`,`orderby`,`status`) values 
(38,'3 Marla',2,0),
(39,'5 Marla',4,0),
(40,'4 Marla',3,0),
(41,'2 Marla',1,0),
(42,'6 Marla',5,0),
(44,'7 Marla',6,0),
(45,'8 Marla',7,0),
(46,'9 Marla',8,0),
(47,'10 Marla',9,0),
(48,'11 Marla',10,0),
(49,'12 Marla',11,0),
(50,'13 Marla',12,13),
(51,'14 Marla',13,0),
(53,'15 Marla',15,1),
(55,'16 Marla',16,1),
(56,'22 Marla',22,1),
(57,'17 Marla',17,1);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `fk_company` int(11) NOT NULL,
  `fk_project` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `status_payment_order` int(11) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`id_order`,`fk_company`,`fk_project`,`date_order`,`status_payment_order`) values 
(1,10,6,'2020-03-04',1),
(2,28,7,'2020-03-05',0),
(3,28,7,'2020-03-10',0);

/*Table structure for table `orders_mobmenu` */

DROP TABLE IF EXISTS `orders_mobmenu`;

CREATE TABLE `orders_mobmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `maincate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `orders_mobmenu` */

insert  into `orders_mobmenu`(`id`,`name`,`url`,`orderby`,`status`,`icon`,`maincate`) values 
(15,'Dashboard','invoices/createdinvoices',1,1,'icon-speedometer','orders'),
(16,'Open Invoices','invoices/filterbyopen',2,1,'fa fa-folder-open','orders'),
(17,'Closed Invoices','invoices/filterbyclosed',3,1,'fa fa-folder','orders');

/*Table structure for table `orders_prodvend` */

DROP TABLE IF EXISTS `orders_prodvend`;

CREATE TABLE `orders_prodvend` (
  `id_opd` int(11) NOT NULL AUTO_INCREMENT,
  `fk_prodvend_opd` int(11) NOT NULL,
  `fk_orders_opd` int(11) NOT NULL,
  `date_delivery_opd` date NOT NULL,
  `qty_opd` int(11) NOT NULL,
  `price_opd` float NOT NULL,
  `status_delivery_opd` int(11) NOT NULL,
  PRIMARY KEY (`id_opd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `orders_prodvend` */

insert  into `orders_prodvend`(`id_opd`,`fk_prodvend_opd`,`fk_orders_opd`,`date_delivery_opd`,`qty_opd`,`price_opd`,`status_delivery_opd`) values 
(1,7,1,'2020-03-04',1000,2,1),
(2,9,2,'2020-03-05',1000,2,0),
(3,9,2,'2020-03-05',2300,23,0),
(4,9,3,'2020-03-10',105,5600,0);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `class` varchar(45) NOT NULL,
  `text_class` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `packages` */

insert  into `packages`(`id`,`title`,`status`,`orderby`,`class`,`text_class`) values 
(1,'A+',1,1,'package1','text-package1'),
(2,'A',1,2,'package2','text-package2'),
(3,'B',1,3,'package3','text-package3');

/*Table structure for table `packages_companies` */

DROP TABLE IF EXISTS `packages_companies`;

CREATE TABLE `packages_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `fk_countries` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `packages_companies` */

insert  into `packages_companies`(`id`,`title`,`status`,`orderby`,`fk_countries`) values 
(10,'dulux',1,1,55),
(11,'chawla',1,2,54),
(12,'tariq',1,2,54),
(13,'ghani',1,1,54),
(14,'alco',1,4,54),
(16,'labour',1,1,54),
(17,'diamond',1,3,54),
(18,'sundras',1,5,54),
(19,'master',1,5,54),
(20,'ash wood',1,3,56),
(21,'african tee',1,3,57),
(22,'naeem trading',1,1,54),
(23,'Railing Company',1,4,54),
(24,'saeed & sons',1,1,54),
(25,'the range',1,1,54),
(26,'custom made',1,1,54),
(27,'others expensive',1,1,54),
(28,'zaheer timber',1,10,54),
(29,'al noor',1,1,54),
(30,'mi',1,1,54),
(31,'cladstone (tuf tile)',1,1,54),
(32,'master tiles',1,3,54),
(33,'rockwall company',1,1,54),
(34,'nafees marble',1,1,54),
(35,'moda',1,5,54),
(36,'waqas electric',1,8,54),
(37,'wallpaper company',1,16,54),
(38,'mehfuz company',1,5,54),
(39,'electro gallery',1,1,54),
(40,'karwan',1,1,54),
(41,'zaman raksha',1,1,54),
(42,'fakir hussain bricks',1,1,54),
(43,'sand company',1,3,54),
(44,'crush company',1,1,54),
(45,'termite pipes company',1,1,54),
(46,'bajar company',1,1,54),
(48,'waqar electric',1,1,54),
(49,'welding company',1,1,54);

/*Table structure for table `packages_data` */

DROP TABLE IF EXISTS `packages_data`;

CREATE TABLE `packages_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_packages` int(11) NOT NULL,
  `fk_stages_subcategories` int(11) NOT NULL,
  `fk_products_jn_substages` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=366 DEFAULT CHARSET=latin1;

/*Data for the table `packages_data` */

insert  into `packages_data`(`id`,`fk_packages`,`fk_stages_subcategories`,`fk_products_jn_substages`) values 
(125,1,7,5),
(129,2,7,6),
(131,1,8,8),
(132,2,8,8),
(133,3,8,8),
(134,1,9,9),
(135,2,9,10),
(136,3,9,11),
(137,1,10,12),
(138,2,10,12),
(139,3,10,13),
(140,1,12,14),
(141,3,12,17),
(142,2,12,15),
(143,3,7,18),
(144,1,13,19),
(145,2,13,19),
(146,3,13,19),
(147,1,14,20),
(148,2,14,21),
(149,3,14,22),
(150,1,11,23),
(151,2,11,24),
(152,3,11,25),
(153,1,15,26),
(154,1,17,27),
(155,1,16,28),
(156,2,16,29),
(157,2,15,30),
(158,2,17,31),
(159,3,17,32),
(160,3,16,29),
(161,3,15,33),
(162,1,19,34),
(163,1,20,35),
(164,1,21,36),
(165,1,22,37),
(166,1,23,38),
(167,1,24,39),
(168,1,25,40),
(169,0,26,41),
(170,1,26,41),
(172,1,27,43),
(173,1,28,44),
(174,1,18,45),
(175,1,77,46),
(176,2,18,47),
(177,3,18,48),
(178,2,19,49),
(179,3,19,49),
(180,2,20,50),
(181,3,20,51),
(182,2,21,52),
(183,3,21,53),
(184,2,22,54),
(185,3,22,55),
(186,2,23,56),
(187,3,23,57),
(188,2,24,58),
(189,3,24,59),
(190,2,25,60),
(191,3,25,61),
(193,2,26,62),
(194,3,26,63),
(195,2,27,64),
(196,3,27,65),
(197,2,28,66),
(198,3,28,67),
(200,2,77,68),
(201,3,77,69),
(202,1,29,70),
(203,1,30,71),
(204,1,31,72),
(205,1,32,73),
(206,1,33,74),
(207,1,34,75),
(208,1,35,76),
(209,1,36,77),
(210,1,37,78),
(211,1,38,79),
(212,1,39,80),
(213,1,40,81),
(214,1,41,82),
(215,1,48,83),
(216,2,29,84),
(217,2,30,85),
(218,2,31,86),
(219,2,32,87),
(220,2,33,88),
(221,2,34,89),
(222,2,35,90),
(223,2,36,91),
(224,2,37,92),
(225,2,38,93),
(226,2,39,94),
(227,2,40,95),
(228,2,48,97),
(229,2,41,96),
(230,1,78,98),
(231,2,78,99),
(232,3,78,100),
(233,3,48,101),
(234,3,29,102),
(235,3,30,103),
(236,3,31,104),
(237,3,32,105),
(238,3,33,106),
(239,3,34,107),
(240,3,35,108),
(241,3,36,109),
(242,3,37,110),
(243,3,38,111),
(244,3,39,94),
(245,3,40,95),
(246,3,41,112),
(247,1,42,113),
(248,2,42,114),
(249,3,42,115),
(250,1,43,116),
(251,2,43,117),
(252,3,43,118),
(253,1,44,119),
(254,2,44,120),
(255,3,44,121),
(256,1,46,122),
(257,2,46,123),
(258,3,46,124),
(259,1,47,125),
(261,2,47,126),
(262,3,47,127),
(263,1,79,128),
(264,2,79,129),
(265,3,79,130),
(266,1,80,131),
(267,2,80,132),
(268,3,80,133),
(269,1,49,134),
(270,2,49,135),
(271,3,49,136),
(272,1,50,137),
(273,2,50,138),
(274,3,50,139),
(275,1,81,140),
(276,2,81,141),
(277,3,81,142),
(278,1,51,143),
(279,2,51,144),
(280,3,51,145),
(281,1,53,146),
(282,2,53,147),
(283,3,53,148),
(284,1,52,149),
(285,2,52,150),
(286,3,52,151),
(287,1,54,152),
(288,2,54,153),
(289,3,54,154),
(290,1,55,155),
(291,2,55,156),
(292,3,55,157),
(293,1,56,158),
(294,2,56,159),
(295,3,56,160),
(296,1,82,161),
(297,3,82,162),
(298,2,82,162),
(299,1,63,164),
(300,2,63,165),
(301,3,63,166),
(302,1,64,167),
(303,2,64,168),
(304,3,64,169),
(305,1,65,170),
(306,2,65,171),
(307,3,65,172),
(308,1,66,173),
(309,2,66,174),
(310,3,66,175),
(311,1,67,176),
(312,2,67,177),
(313,3,67,178),
(314,1,68,180),
(315,2,68,181),
(316,3,68,182),
(317,1,74,183),
(318,2,74,184),
(319,3,74,185),
(320,1,72,186),
(321,2,72,187),
(322,3,72,188),
(323,1,73,189),
(324,2,73,190),
(325,3,73,191),
(326,1,83,192),
(328,3,83,194),
(329,2,83,193),
(330,1,62,195),
(331,2,62,196),
(332,3,62,197),
(333,1,86,198),
(334,1,84,199),
(335,2,84,200),
(336,2,86,198),
(337,1,85,201),
(338,2,85,202),
(339,1,87,203),
(340,2,87,204),
(341,2,88,206),
(342,1,88,205),
(343,1,89,210),
(344,2,89,208),
(345,1,90,211),
(346,2,90,212),
(347,1,91,213),
(348,2,91,214),
(349,1,92,215),
(350,2,92,216),
(351,1,94,217),
(352,2,94,218),
(353,1,95,219),
(355,2,95,221),
(356,1,96,222),
(357,2,96,222),
(358,1,97,223),
(359,2,97,224),
(360,1,98,225),
(361,2,98,226),
(362,1,99,227),
(363,2,99,228),
(364,1,100,229),
(365,2,100,230);

/*Table structure for table `packages_houses` */

DROP TABLE IF EXISTS `packages_houses`;

CREATE TABLE `packages_houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `class` varchar(45) NOT NULL,
  `text_class` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `packages_houses` */

insert  into `packages_houses`(`id`,`title`,`status`,`orderby`,`class`,`text_class`) values 
(4,'5 Marla',1,1,'package1','text-danger'),
(5,'10 Marla',1,1,'package1','text-success'),
(6,'20 Marla',1,1,'package1','text-primary');

/*Table structure for table `packages_mobmenu` */

DROP TABLE IF EXISTS `packages_mobmenu`;

CREATE TABLE `packages_mobmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `maincate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `packages_mobmenu` */

insert  into `packages_mobmenu`(`id`,`name`,`url`,`orderby`,`status`,`icon`,`maincate`) values 
(15,'Dashboard','packages',1,1,'icon-speedometer','packages'),
(16,'Packages','packages/packages/all',5,1,'fa fa-folder-open','packages'),
(17,'Companies','packages/companiesjoinlist',3,1,'fa fa-industry','packages'),
(18,'Stage Cate','packages/stagecategories',2,1,'fa fa-folder-open','packages'),
(19,'Products','packages/productslist',4,1,'fa fa-bars','packages');

/*Table structure for table `packages_products` */

DROP TABLE IF EXISTS `packages_products`;

CREATE TABLE `packages_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `fk_companies` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

/*Data for the table `packages_products` */

insert  into `packages_products`(`id`,`title`,`fk_companies`,`status`,`orderby`,`type`) values 
(1,'1.6',11,1,1,1),
(2,'1.2',11,1,2,1),
(3,'1.2',12,1,3,1),
(4,'1.6',12,1,2,1),
(5,'5',13,1,2,1),
(6,'8',13,1,2,1),
(8,'12',13,1,1,1),
(9,'10',13,1,7,1),
(10,'1.2',14,1,5,1),
(11,'Looking Glass & Others',13,1,6,0),
(12,'Professional Labour',16,1,1,0),
(13,'Normal Labour',16,1,1,0),
(14,'Water Mate Wall Paint',10,1,1,0),
(15,'Plastic Emulation Wall Paint ',10,1,2,0),
(16,'Polish Dulux ICI',10,1,1,0),
(17,'Filling Dulux ICI',10,1,4,0),
(18,'Filling Diamond ',17,1,6,0),
(19,'Polish Sundras',18,1,4,0),
(20,'Master Paint For Wall',19,1,1,0),
(21,'Ash Wood Doors',28,1,1,3),
(22,'African Tee - Door Frames',28,1,1,3),
(23,'MelaMine',22,1,1,5),
(24,'UV',22,1,1,5),
(25,'Wardrobes UV',22,1,1,5),
(26,'Stair Railing',23,1,1,4),
(27,'Doors Locks & Fitting',24,1,1,3),
(28,'Ceiling Sheet',25,1,1,5),
(29,'Feature Wall',26,1,1,3),
(30,'mdf - lamination & others',27,1,1,0),
(31,'Yellow Pine',28,1,1,3),
(32,'Ply Doors',22,1,1,5),
(33,'Kyle ',28,1,4,3),
(34,'UV',29,1,1,5),
(35,'Spanish Washroom Tiles',30,1,1,2),
(36,'China Washroom Tiles',30,1,2,2),
(37,'Grage Tuf Tile',31,1,1,3),
(38,'Bond & Others',27,1,1,0),
(39,'Washroom Master Tiles',32,1,1,2),
(40,'Floor Tile Master Tiles',32,1,3,2),
(41,'Rockwall',33,1,1,3),
(42,'Stair Marble',34,1,1,3),
(43,'Corian',22,1,1,3),
(44,'Grey Night',34,1,2,3),
(45,'Garden & Others',27,1,3,3),
(46,'Plumber - Contractor',16,1,1,3),
(47,'Sonex Shower Sets',35,1,1,5),
(48,'Gorhee Shower Sets',35,1,4,5),
(49,'Fasail Shower Sets',35,1,3,5),
(50,'Bath Accessories Set',35,1,6,5),
(51,'Porta Internal Comods',35,1,1,5),
(52,'Porta External  Comods',35,1,5,5),
(53,'China Comods',35,1,6,5),
(54,'Porta Seat',35,1,1,5),
(55,'China Seat',35,1,7,5),
(56,'Venty China Made',35,1,1,5),
(57,'Venty Bowl ',35,1,6,5),
(58,'Others Expensive',27,1,7,5),
(59,'Gm Wire Full House',36,1,1,5),
(60,'English Cable Full House',36,1,6,5),
(61,'Breakers - Schneider ',36,1,7,5),
(62,'Ceiling Lights - Philips ',36,1,8,5),
(63,'China Ceiling Lights',36,1,10,5),
(64,'Opal - Fitting',36,1,21,5),
(65,'Tj Fitting',36,1,19,5),
(66,'Wall Light China',36,1,19,5),
(67,'Chandeliers  China',36,1,20,5),
(68,'Electric Extra',27,1,8,5),
(69,'Ceiling Work',26,1,23,3),
(70,'China Wallpaper',37,1,1,5),
(71,'Dubai Wallpaper',37,1,15,5),
(72,'Korea',37,1,23,5),
(73,'Rockwall',38,1,1,5),
(74,'Grafi ',38,1,2,3),
(75,'All Kitchen Tools',39,1,12,5),
(76,'Cement',40,1,1,5),
(77,'Cement',41,1,1,5),
(78,'Bricks A+',42,1,1,5),
(79,'Bricks A',42,1,2,5),
(80,'Model 60 Grade Steel',40,1,3,5),
(81,'Model 40 Grade Steel',40,1,1,5),
(82,'Kohenoor 40 Grade Steel',40,1,5,5),
(83,'Ravi Sand - Sadeeq',43,1,6,3),
(84,'Margala Crush - Adil',44,1,1,4),
(85,'Rohi Crush - Adil',44,1,2,4),
(86,'Bajar Sargoda  - Adil',44,1,4,5),
(87,'Bajar Dina - Adil',44,1,3,4),
(88,'Termite Pipes',45,1,5,3),
(89,'Broken Bricks Rori - Sadeeq',46,1,1,4),
(90,'Electric Pipes Gm & Popular',48,1,1,5),
(91,'High Density - Local',48,1,1,5),
(92,'Sanitary Pipes Popular',48,1,1,5),
(93,'Main Gate',49,1,1,3),
(94,'Grills ',49,1,1,3),
(95,'Grey Other Expensive',27,1,5,3);

/*Table structure for table `packages_products_jn_substages` */

DROP TABLE IF EXISTS `packages_products_jn_substages`;

CREATE TABLE `packages_products_jn_substages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_stages_subcategories` int(11) NOT NULL,
  `fk_packages_products` int(11) NOT NULL,
  `fk_packages` int(11) NOT NULL,
  `rate` varchar(45) DEFAULT NULL,
  `vendor` varchar(45) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) DEFAULT NULL,
  `package_title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=latin1;

/*Data for the table `packages_products_jn_substages` */

insert  into `packages_products_jn_substages`(`id`,`fk_stages_subcategories`,`fk_packages_products`,`fk_packages`,`rate`,`vendor`,`qty`,`status`,`orderby`,`package_title`) values 
(5,7,1,1,'435','Nasrulla',0,1,1,'1.6 mm Chawla - A+'),
(6,7,2,2,'390','Nasrulla',0,1,1,'1.2 mm Chawla - A'),
(8,8,5,1,'105','Nasrulla',0,1,1,'5 mm Ghani - A+'),
(9,9,6,1,'800','Nasrulla',0,1,3,'Cut Work 800 Rs - A+'),
(10,9,6,2,'600','Nasrulla',0,1,4,'Cut Work 600 Rs - A'),
(11,9,6,3,'400','Nasrulla',0,1,3,'Cut Work 400 Rs - B'),
(12,10,5,1,'550','Nasrulla',0,1,5,'5 mm Ghani - A+'),
(13,10,5,3,'260','Nasrulla',0,1,6,'5 mm Ghani - B'),
(14,12,8,1,'565','Nasrulla',0,1,5,'12 mm Ghani - A+'),
(15,12,9,2,'555','Nasrulla',0,1,9,'10 mm Ghani - A'),
(17,12,8,3,'415','Nasrulla',0,1,8,'Steel Railing Terrace - B'),
(18,7,10,3,'375','Nasrulla',0,1,8,'1.2 Alco - B'),
(19,13,6,1,'750','Nasrulla',0,1,10,'8 mm Ghani - All'),
(20,14,11,1,'15','Nasrulla',0,1,6,'5 mm Ghani - A+'),
(21,14,11,2,'8','Nasrulla',0,1,7,'5 mm Ghani - A'),
(22,14,11,3,'7','Umair',0,1,8,'5 mm Ghani - B'),
(23,11,12,1,'83','Ajmal',0,1,1,'Professional Labour - A+ 270k'),
(24,11,12,2,'77','Ajmal',0,1,2,'Professional Labour - A 250k'),
(25,11,13,3,'67','Ajmal',0,1,3,'Normal Labour Works - B 230k'),
(26,15,14,1,'37','Ici Paint Bahria',0,1,2,'Water Mate Dulux ICI - A+ 120k'),
(27,17,16,1,'24.60','Ici Paint Bahria',0,1,2,'Dulux ICI - A+ 80K'),
(28,16,17,1,'21.50','Ici Paint Bahria',0,1,3,'Dulux ICI - A+ 70K'),
(29,16,18,2,'19','Ici Paint Bahria',0,1,6,'Diamond - A 61k'),
(30,15,15,2,'33.8','Ici Paint Bahria',0,1,6,'Plastic Emulation Dulux ICI - A 110k'),
(31,17,16,2,'23','Ici Paint Bahria',0,1,7,'Dulux ICI - A 75k'),
(32,17,19,3,'12.3','Ajmal',0,1,6,'Sundras Polish - B 40k'),
(33,15,20,3,'17','Ajmal',0,1,6,'Master Paint - B 55k'),
(34,19,21,1,'5600','Zaheer Timber',0,1,1,'Ash Wood - Main Door A+'),
(35,20,21,1,'5600','Zaheer Timber',0,1,2,'Ash Wood - Internal A+'),
(36,21,22,1,'3600','Zaheer Timber',0,1,3,'African Tee - Door Frames A+'),
(37,22,23,1,'12000','Naeem Trading',0,1,1,'MelaMine 12000 PKR - A+'),
(38,23,24,1,'12000','Naeem Trading',0,1,2,'Acrylic UV 12000 PKR - A+ '),
(39,24,25,1,'10000','Naeem Trading',0,1,3,'UV 10000 PKR - A+ '),
(40,25,26,1,'2200','Shehzad Railing',0,1,1,'Wooden & Glass - 110k A+ (2200 Rs)'),
(41,26,27,1,'29.3','Umair',0,1,1,'Range 95000 PKR - A+'),
(43,27,28,1,'7.7','The Range',0,1,1,'Full House - 25k A+ (20Qty)'),
(44,28,29,1,'28','Umair',0,1,1,'Feature Wall 3 Rooms - A+ 90k'),
(45,18,12,1,'80','Jabar',0,1,1,'Professional Labour - A+ 260k'),
(46,77,30,1,'92','Umair',0,1,1,'Local Made - A+ 300k '),
(47,18,12,2,'73','Jabar',0,1,1,'Professional Labour - A 240k'),
(48,18,13,3,'70','Jabar',0,1,3,'Normal Labour Works - B 225k'),
(49,19,31,2,'3150','Zaheer Timber',0,1,1,'Yellow Pine - A 3150 Rs'),
(50,20,31,2,'3150','Zaheer Timber',0,1,1,'Yellow Pine - A 3150 Rs'),
(51,20,32,3,'1730','Naeem Trading',0,1,1,'Ply Doors - B 180k'),
(52,21,31,2,'1800','Zaheer Timber',0,1,1,'Yellow Pine A Quality - A 1800 Rs'),
(53,21,33,3,'1500','Zaheer Timber',0,1,8,'Kyle Wood - B 1500 Rs'),
(54,22,24,2,'9000','Naeem Trading',0,1,1,'Uv 9000 RS - A '),
(55,22,34,3,'6000','Al Noor',0,1,1,'UV 6000 RS - B'),
(56,23,24,2,'8000','Naeem Trading',0,1,10,'UV 8000 RS - A'),
(57,23,34,3,'6000','Al Noor',0,1,1,'UV 6000 RS - B'),
(58,24,24,2,'7500','Naeem Trading',0,1,8,'UV 7500 RS - A'),
(59,24,34,3,'4500','Al Noor',0,1,11,'UV 4500 RS - B'),
(60,25,26,2,'1700','Shehzad Railing',0,1,1,'Wooden & Steel - 85k A (1700 Rs)'),
(61,25,26,3,'1200','Shehzad Railing',0,1,1,'Steel Railing - B 60k (1200 Rs)'),
(62,26,27,2,'23','Umair',0,1,1,'Range 75000 RS - A'),
(63,26,27,3,'14','saeed & sons',0,1,1,'Range 45000 - B'),
(64,27,28,2,'4.60','The Range',0,1,7,'Drawing & 2 Tv Lounge - 15k A'),
(65,27,28,3,'0','The Range',0,1,11,'Without Wooden - B '),
(66,28,29,2,'9','Umair',0,1,1,'Feature Wall 1 Room - A 30k'),
(67,28,29,3,'0','Umair',0,1,20,'Only Wallpapers - B (No Feature Wall)'),
(68,77,30,2,'89','Umair',0,1,1,'Local Made - A 290k '),
(69,77,30,3,'84.6','Umair',0,1,11,'Local Made - B 275k '),
(70,29,35,1,'3000','Fida',0,1,1,'Spanish Range 3000 RS - A+'),
(71,30,36,1,'2000','Fida',0,1,2,'China A+ Range 2000 RS - A+'),
(72,31,36,1,'1800','Fida',0,1,3,'China Range 1800 RS - A+'),
(73,32,36,1,'1400','Fida',0,1,16,'China Range 1400 RS - A+'),
(74,33,35,1,'2500','Fida',0,1,17,'Turkish Range 2500 RS - A+'),
(75,34,36,1,'2200','Fida',0,1,22,'Wooden Tile Range 2200 RS - A+'),
(76,35,36,1,'2200','Fida',0,1,0,'China 24 x 48 Range 2200 RS - A+'),
(77,36,36,1,'2200','Fida',0,1,12,'China 24 x 48 Range 2200 RS - A+'),
(78,37,35,1,'2200','Fida',0,1,11,'Spanish Range 2200 RS - A+'),
(79,38,35,1,'2000','Fida',0,1,23,'Spanish Range 2000 RS - A+'),
(80,39,36,1,'1600','Fida',0,1,23,'China Range 1600 RS - A+'),
(81,40,37,1,'120','Adnan ',0,1,1,'Tuf Tile Range 120RS - A+'),
(82,41,35,1,'3000','Fida',0,1,19,'Spanish Range 3000 RS - A+'),
(83,48,12,1,'65','Asif',0,1,1,'Professional Labour - A+ 210K'),
(84,29,35,2,'2500','Fida',0,1,12,'Spanish & China Range 2500Rs - A'),
(85,30,36,2,'1800','fida',0,1,17,'China Range 1800 Rs - A'),
(86,31,36,2,'1700','Fida',0,1,14,'China Range 1700 Rs - A'),
(87,32,36,2,'1200','Fida',0,1,12,'China Range 1200 Rs - A'),
(88,33,36,2,'2200','Fida',0,1,17,'China Range 2200 Rs - A'),
(89,34,36,2,'1800','Fida',0,1,19,'China Range 1800 Rs - A'),
(90,35,36,2,'1800','Fida',0,1,20,'China 32 x 32 Range 1800 Rs - A'),
(91,36,36,2,'1800','Fida',0,1,17,'China 32 x 32 Range 1800 Rs - A'),
(92,37,36,2,'1800','Fida',0,1,1,'China Range 1800 Rs - A'),
(93,38,36,2,'1600','Fida',0,1,18,'China Range 1600 Rs - A'),
(94,39,36,2,'1300','fida',0,1,20,'China Range 1300 Rs - A'),
(95,40,37,2,'100','Adnan',0,1,21,'Tuf Tile Range 100RS - A'),
(96,41,35,2,'2500','Fida',0,1,10,'Spanish Range 2500 Rs - A'),
(97,48,12,2,'65','fida',0,1,10,'Professional Labour - A 210K'),
(98,78,38,1,'38.5','Umair',0,1,10,'Bond & Others - A+ 125k'),
(99,78,38,2,'31','Umair',0,1,5,'Bond & Others - A 100k'),
(100,78,38,3,'29','Umair',0,1,5,'Bond & Others - B 95k'),
(101,48,13,3,'57','Asif',0,1,20,'Normal Labour Works - B 185k'),
(102,29,36,3,'1800','Fida',0,1,1,'China Range 1800 Rs - B'),
(103,30,39,3,'1400','Umair',0,1,1,'Master Tile Range 1400 Rs - B'),
(104,31,39,3,'1400','Umair',0,1,2,'Master Tiles Range 1400 Rs - B'),
(105,32,36,3,'1200','fida',0,1,12,'China Range 1200 Rs - B'),
(106,33,36,3,'1800','Fida',0,1,12,'China Range 1800 Rs - B'),
(107,34,36,3,'1600','Fida',0,1,10,'China Range 1600 Rs - B'),
(108,35,39,3,'1600','Master',0,1,20,'Master Tile 24 x 24 Range 1600 Rs - B'),
(109,36,40,3,'1600','Master',0,1,19,'Master Tile 24 x 24 Range 1600 Rs - B'),
(110,37,36,3,'1400','Fida',0,1,12,'China Range 1400 Rs - A'),
(111,38,41,3,'0','umair',0,1,11,'Only Rockwall - Front No Tiles Works'),
(112,41,36,3,'1800','Fida',0,1,20,'China Range 1800 Rs - B'),
(113,42,42,1,'900','Iftihar',0,1,1,'Grey Night Range 900 Rs - A+'),
(114,42,42,2,'500','Iftihar',0,1,1,'Grey Night Range 500 Rs - A'),
(115,42,42,3,'300','Iftihar',0,1,3,'Grey Night Range 300 Rs - A'),
(116,43,43,1,'1650','Umair',0,1,1,'Corian Range 1650 Rs - A+'),
(117,43,44,2,'500','Iftihar',0,1,3,'Grey Night Range 500 Rs - A'),
(118,43,44,3,'350','Iftihar',0,1,3,'Grey Night Range 350 Rs - B'),
(119,44,44,1,'1050','Iftihar',0,1,4,'Grey Night Range 1050 Rs - A+'),
(120,44,44,2,'500','Iftihar',0,1,4,'Grey Night Range 500 Rs - A'),
(121,44,44,3,'350','Iftihar',0,1,3,'Grey Night Range 350 Rs - B'),
(122,46,43,1,'1650','Naeem Trading',0,1,15,'Corian Range 1650 Rs - A+'),
(123,46,44,2,'1050','Iftihar',0,1,5,'Grey Night Range 1050 Rs - A'),
(124,46,44,3,'500','Iftihar',0,1,6,'Grey Night Range 500 Rs - B'),
(125,47,44,1,'950','Iftihar',0,1,6,'Grey Night Range 950 Rs - A+'),
(126,47,44,2,'500','Iftihar',0,1,6,'Grey Night Range 500 Rs - A'),
(127,47,44,3,'350','Iftihar',0,1,8,'Grey Night Range 350 Rs - B'),
(128,79,44,1,'300','Iftihar',0,1,5,'Grey Night Range 300 Rs - A+'),
(129,79,44,2,'300','Iftihar',0,1,6,'Grey Night Range 300 Rs - A'),
(130,79,44,3,'200','Iftihar',0,1,8,'Marble Range 200 Rs - B'),
(131,80,45,1,'500','Iftihar',0,1,6,'Grey Night Range 500 Rs - A+'),
(132,80,45,2,'400','Iftihar',0,1,7,'Grey Night Range 400 Rs - A'),
(133,80,45,3,'300','Iftihar',0,1,8,'Grey Night Range 300 Rs - B'),
(134,49,12,1,'12.30','Fiaz',0,1,5,'Professional Labour - A+ 40K'),
(135,49,12,2,'12.3','Fiaz`',0,1,6,'Professional Labour - A 40K'),
(136,49,12,3,'12.3','Fiaz',0,1,7,'Professional Labour - B 40K'),
(137,50,48,1,'32000','Moda',0,1,1,'Grohee Range 32000 Rs - A+'),
(138,50,47,2,'18000','Moda',0,1,1,'Sonex Range 18000 Rs - A'),
(139,50,49,3,'14000','Moda',0,1,6,'Fasail Range 14000 Rs - B'),
(140,81,47,1,'25000','Moda',0,1,7,'Sonex Range 25000 Rs - A+'),
(141,81,47,2,'18000','Moda',0,1,5,'Sonex Range 18000 Rs - A'),
(142,81,49,3,'12000','moda',0,1,8,'Fasail Range 12000 Rs - B'),
(143,51,50,1,'8000','Moda',0,1,6,'Range 8000 Rs - A+'),
(144,51,50,2,'5500','Moda',0,1,6,'Range 5500 Rs - A'),
(145,51,50,3,'4500','Moda',0,1,6,'Range 4500 Rs - B'),
(146,53,51,1,'40000','Moda',0,1,6,'2 Pz Porta Range 40000 Rs - A+'),
(147,53,51,2,'20000','moda',0,1,8,'1 Pz Porta Range 40000 Rs - A'),
(148,53,51,3,'0','Moda',0,1,10,'Not Included - B '),
(149,52,52,1,'14000','moda',0,1,5,'4 Pz Porta Range 14000 Rs Each - A+'),
(150,52,52,2,'11000','moda',0,1,6,'5 Pz Porta Range 11000 Rs Each - A'),
(151,52,53,3,'6000','Moda',0,1,7,'5 Pz China Range 6000 Rs Each - B'),
(152,54,54,1,'6000','moda',0,1,7,'1 Pz Porta Range 6000 Rs Each - A+'),
(153,54,55,2,'3000','moda',0,1,8,'1 Pz China Range 3000 Rs Each - A'),
(154,54,55,3,'6000','moda',0,1,7,'2 Pz China Range 3000 Rs Each - B'),
(155,55,56,1,'25000','moda',0,1,6,'Imported Range 25000 Rs - A+'),
(156,55,56,2,'0','moda',0,1,8,'Not Included - A'),
(157,55,56,3,'0','moda',0,1,8,'Not Included - B '),
(158,56,57,1,'10000','moda',0,1,7,'5 Pz Moda Range 10000 Rs - A+'),
(159,56,57,2,'8000','moda',0,1,8,'6 Pz Moda Range 8000 Rs - A'),
(160,56,57,3,'6000','Moda',0,1,8,'6 Pz Porta Range 6000 Rs - B'),
(161,82,58,1,'7.4','Umair',0,1,8,'Extra Works - A+ 24k'),
(162,82,58,2,'7.4','Umair',0,1,7,'Extra Works - A 24k'),
(163,82,58,3,'7.4','umair',0,1,8,'Extra Works - B 24k'),
(164,63,59,1,'38','waqas',0,1,8,'Gm Cable - A+ 123k Full House'),
(165,63,59,2,'38','waqas',0,1,8,'Gm Cable - A 123k Full House'),
(166,63,60,3,'36.5','waqas',0,1,9,'English Cable - B 118k '),
(167,64,61,1,'665','waqas',0,1,8,'Schneider German - A+ 12k'),
(168,64,61,2,'665','waqas',0,1,8,'Schneider German - A 12k'),
(169,64,61,3,'665','waqas',0,1,8,'Schneider German - B 12k'),
(170,65,62,1,'27.5','Umair',0,1,10,'Philips Panel Light 180 Pz - A+ 90k'),
(171,65,63,2,'16.5','umair',0,1,13,'Brighto Panel Light 180 Pz - A 54k'),
(172,65,63,3,'12.8','umair',0,1,18,'China Imported 180 Pz - B 40k'),
(173,66,64,1,'15.4','umair',0,1,8,'Opal Imported - A+ 50k'),
(174,66,65,2,'10.50','umair',0,1,21,'Tj Imported - A 34k'),
(175,66,65,3,'8.5','umair',0,1,25,'Tj Imported - B 29k'),
(176,67,66,1,'2000','umair',0,1,20,'China Imported Range 2000 Rs - A+ 36k'),
(177,67,66,2,'1600','umair',0,1,25,'China Imported Range 1600 Rs - A 29k'),
(178,67,66,3,'1000','umair',0,1,26,'China Imported Range 1000 Rs - B'),
(180,68,67,1,'40000','umair',0,1,40,'3 Pz Range 40000 Rs Each - A+ 120k'),
(181,68,67,2,'30000','umiar',0,1,41,'3 Pz Range 30000 Rs Each - A 90k'),
(182,68,67,3,'15000','Umair',0,1,45,'3 Pz Range 15000 Rs Each - B 45k'),
(183,74,69,1,'54','Azmat',0,1,8,'Professional Design - A+ 175k'),
(184,74,69,2,'55','Azmat',0,1,30,'Professional Design - A 175k'),
(185,74,69,3,'53','Azmat',0,1,35,'Professional Design - B 165k'),
(186,72,68,1,'35','Umair',0,1,45,'Electric Extra - A+ 112k'),
(187,72,68,2,'35','umair',0,1,45,'Electric Extra - A 112k'),
(188,72,68,3,'21','umair',0,1,55,'Electric Extra - A 68k'),
(189,73,71,1,'30','bilal',0,1,12,'Dubai Range 3500 Rs - A+ 100k'),
(190,73,72,2,'25','bilal',0,1,25,'Korea Range 3000 Rs - A 80k'),
(191,73,70,3,'25','Bilal',0,1,25,'China Range 2500 Rs - B 80k'),
(192,83,73,1,'29','Mehfuz',0,1,29,'Rockwall - A+ 95k'),
(193,83,73,2,'29','Mehfux',0,1,35,'Rockwall - A 95k'),
(194,83,41,3,'29','mehfux',0,1,55,'Grafitti - B 95k'),
(195,62,75,1,'50','umair',0,1,55,'Microwave & Others - A+ 160k'),
(196,62,75,2,'18','umair',0,1,67,'Microwave & Others - A 60k'),
(197,62,75,3,'18','umair',0,1,70,'Microwave & Others - B 60k'),
(198,86,76,1,'540','Hammad',0,1,1,'Bestway | Dg | Maple - A+ 540 Rs'),
(199,84,78,1,'10','Fakir Hussain',0,1,1,'Awal A+ Quality Bricks - A+ 10800 RS'),
(200,84,79,2,'9','Fakir',0,1,2,'Awal A Quality Bricks - A 9800 RS'),
(201,85,80,1,'113','Hammad',0,1,3,'Modal | Mughal 60 Grade - A+ 113 Rs'),
(202,85,82,2,'108','Hammad',0,1,5,'Kohenoor | Nazir 40 Grade - A 108 Rs'),
(203,87,83,1,'35.3','Sadeeq',0,1,4,'Chanab (Lenter) | Ravi (Others) - A+ 115k'),
(204,87,83,2,'29','Sadeeq',0,1,1,'Ravi Sand Full House - A 95k'),
(205,88,84,1,'78.5','Adil',0,1,1,'Margala Crush - A+ 78.5 RS '),
(206,88,85,2,'66','Adil',0,1,2,'Rohi & Sargoda - A 66 Rs'),
(208,89,86,2,'42','Adil',0,1,1,'Sargoda - A 42 Rs'),
(209,0,87,1,'48','Adil',0,1,7,'Dina - A+ 48 Rs'),
(210,89,87,1,'48','Adil',0,1,3,'Dina - A+ 48 Rs'),
(211,90,88,1,'3.7','Zahoor',0,1,5,'Included Full House - A+ 12k'),
(212,90,88,2,'0','Zahoor',0,1,5,'Not Included - A '),
(213,91,89,1,'3.70','Umair',0,1,1,'Kacha Works Mixed With Bajar - A+ 12k '),
(214,91,89,2,'14.75','Umair',0,1,8,'Kacha Works - A 48k No Bajar Mixed'),
(215,92,90,1,'20','Waqar Orchard',0,1,1,'Gm | Popular - A+ 65k '),
(216,92,91,2,'10.75','Waqar Orchard',0,1,7,'High Density Local Made - A 35k'),
(217,94,92,1,'70','umair',0,1,8,'Popular Company - A+ 225k'),
(218,94,92,2,'70','umair',0,1,8,'Popular Company - A 225k'),
(219,95,12,1,'370','Sajid',0,1,1,'Professional Labour A+ - Sajid 12Lac'),
(220,96,12,2,'330','Farooq',0,1,1,'Professional Labour A - Farooq 10Lac75K'),
(221,95,12,2,'330','Farooq',0,1,1,'Professional Labour A - Farooq 10Lac75K'),
(222,96,12,1,'9.5','Usman',0,1,2,'Professional Labour A+ - A+ 33k'),
(223,97,12,1,'20','fiaz',0,1,3,'Professional Labour A+ - A+ 65k'),
(224,97,12,2,'20','Fiaz',0,1,4,'Professional Labour A+ - A+ 65k'),
(225,98,93,1,'18.5','Tahir Gate',0,1,6,'Range 75000 RS | 16 Gage - A+ 60k'),
(226,98,93,2,'14','Uamir',0,1,5,'Range 55000 Rs | 16 Gage - A 45k '),
(227,99,94,1,'21.50','tahir',0,1,4,'16 Gage | 4\" Space | 3 Sutar - A+ 70k'),
(228,99,94,2,'0','Tahir',0,1,8,'Not Included - A '),
(229,100,95,1,'61.5','Umair',0,1,6,'Full House Plaster | Rcc Lenter | Rcc Stairs - A+ 200k'),
(230,100,95,2,'57.80','Umair',0,1,7,'Full House Plaster | Rcc Lenter | Rcc Stairs - A 188k');

/*Table structure for table `packages_quantity` */

DROP TABLE IF EXISTS `packages_quantity`;

CREATE TABLE `packages_quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_stages_subcategories` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  `fk_packages_houses` int(11) NOT NULL,
  `qty` varchar(45) NOT NULL,
  `fk_packages` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

/*Data for the table `packages_quantity` */

insert  into `packages_quantity`(`id`,`fk_stages_subcategories`,`type`,`status`,`orderby`,`fk_packages_houses`,`qty`,`fk_packages`) values 
(3,7,3,1,1,5,'485',1),
(4,7,3,1,2,4,'250',1),
(5,7,3,1,1,6,'700',1),
(6,9,3,1,3,5,'100',1),
(7,8,3,1,4,5,'485',1),
(8,10,3,1,4,5,'150',1),
(9,12,3,1,5,5,'60',1),
(10,13,3,1,1,5,'8',1),
(11,14,3,1,5,5,'3250',1),
(12,11,3,1,1,5,'3250',1),
(13,15,3,1,1,5,'3250',1),
(14,16,3,1,2,5,'3250',1),
(15,17,3,1,4,5,'3250',1),
(16,18,3,1,1,5,'3250',1),
(17,19,3,1,1,5,'15',1),
(18,20,3,1,2,5,'105',1),
(19,21,3,1,1,5,'42',1),
(20,22,4,1,5,5,'5',1),
(21,23,4,1,1,5,'4',1),
(22,24,4,1,1,5,'7',1),
(23,25,5,1,1,5,'50',1),
(24,26,3,1,1,5,'3250',1),
(25,27,3,1,2,5,'3250',1),
(26,28,3,1,1,5,'3250',1),
(27,77,3,1,1,5,'3250',1),
(28,29,2,1,1,5,'72',1),
(29,30,2,1,2,5,'90',1),
(30,31,2,1,3,5,'12',1),
(31,32,2,1,4,5,'12',1),
(32,33,2,1,5,5,'22',1),
(33,34,2,1,7,5,'22',1),
(34,35,2,1,12,5,'60',1),
(35,36,2,1,13,5,'105',1),
(37,37,2,1,15,5,'18',1),
(38,38,2,1,17,5,'52',1),
(39,39,2,1,19,5,'45',1),
(40,40,3,1,20,5,'600',1),
(41,41,2,1,21,5,'10',1),
(42,48,3,1,23,5,'3250',1),
(43,78,3,1,10,5,'3250',1),
(44,42,3,1,1,5,'350',1),
(45,79,3,1,1,5,'108',1),
(46,46,3,1,12,5,'18',0),
(47,47,3,1,3,5,'22',1),
(48,43,3,1,4,5,'55',1),
(49,44,3,1,6,5,'50',1),
(50,80,3,1,7,5,'40',1),
(51,49,3,1,1,5,'3250',1),
(52,50,5,1,2,5,'2',1),
(53,51,5,1,2,5,'5',1),
(54,52,5,1,4,5,'4',1),
(55,53,5,1,6,5,'2',1),
(56,54,5,1,1,5,'1',1),
(58,56,5,1,4,5,'6',1),
(59,55,5,1,6,5,'1',1),
(60,81,5,1,1,5,'3',1),
(61,82,3,1,8,5,'3250',1),
(62,63,3,1,1,5,'3250',1),
(63,64,5,1,1,5,'18',1),
(64,65,3,1,5,5,'3250',1),
(65,66,5,1,20,5,'3250',1),
(66,67,5,1,9,5,'18',1),
(67,68,5,1,8,5,'3',1),
(68,72,3,1,1,5,'3250',3),
(69,74,3,1,10,5,'3250',1),
(70,73,3,1,56,5,'3250',1),
(71,83,3,1,20,5,'3250',1),
(72,62,3,1,70,5,'3250',1),
(73,84,5,1,1,5,'85000',1),
(74,85,5,1,2,5,'6000',1),
(75,86,5,1,3,5,'1150',1),
(76,87,5,1,4,5,'3250',1),
(77,88,3,1,7,5,'2700',1),
(78,89,4,1,9,5,'800',1),
(79,90,3,1,12,5,'3250',1),
(80,91,4,1,13,5,'3250',1),
(81,92,3,1,14,5,'3250',1),
(82,93,3,1,16,5,'3250',1),
(83,94,3,1,18,5,'3250',1),
(84,95,3,1,1,5,'3250',1),
(85,96,3,1,1,5,'3250',1),
(86,97,3,1,1,5,'3250',1),
(87,98,3,1,1,5,'3250',1),
(88,99,3,1,4,5,'3250',2),
(89,100,3,1,6,5,'3250',1);

/*Table structure for table `packages_stages_categories` */

DROP TABLE IF EXISTS `packages_stages_categories`;

CREATE TABLE `packages_stages_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `fk_catetype` int(11) NOT NULL,
  `icon_image` varchar(45) DEFAULT NULL,
  `class` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `packages_stages_categories` */

insert  into `packages_stages_categories`(`id`,`title`,`status`,`orderby`,`fk_catetype`,`icon_image`,`class`) values 
(26,'alluminium & glass',1,1,2,'img/avatar1.jpg','fab fa-windows'),
(27,'paint ',1,2,2,'img/avatar1.jpg','fas fa-palette'),
(28,'wood',1,1,2,'img/avatar1.jpg','fas fa-door-open'),
(29,'tiles',1,4,2,'img/avatar1.jpg','fas fa-square'),
(30,'marble',1,5,2,'img/avatar1.jpg','fas fa-object-ungroup'),
(31,'saintry',1,6,2,'img/avatar1.jpg','fas fa-toilet'),
(32,'kitchens',1,8,2,'img/avatar1.jpg','fab fa-kickstarter-k'),
(33,'electric',1,8,2,'img/avatar1.jpg','fas fa-lightbulb'),
(34,'wallpapers',1,10,2,'img/avatar1.jpg','fab fa-google-wallet'),
(35,'ceiling',1,12,2,'img/avatar1.jpg','fas fa-ruler-combined'),
(38,'material information',1,1,1,'img/avatar1.jpg',''),
(39,'grey labour',1,2,1,'img/avatar1.jpg',''),
(40,'included items',1,4,1,'img/avatar1.jpg','');

/*Table structure for table `packages_stages_subcategories` */

DROP TABLE IF EXISTS `packages_stages_subcategories`;

CREATE TABLE `packages_stages_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `orderby` int(11) DEFAULT NULL,
  `fk_stages_categories` int(11) NOT NULL,
  `image_class` varchar(50) DEFAULT NULL,
  `with_image` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

/*Data for the table `packages_stages_subcategories` */

insert  into `packages_stages_subcategories`(`id`,`title`,`status`,`orderby`,`fk_stages_categories`,`image_class`,`with_image`) values 
(7,'windows alluminium',1,1,26,NULL,NULL),
(8,'windows glass',1,2,26,NULL,NULL),
(9,'door glass',1,3,26,NULL,NULL),
(10,'wardrobes & cabinets glass',1,4,26,NULL,NULL),
(11,'paint contractor',1,1,27,NULL,NULL),
(12,'terrace glass & alluminium',1,5,26,NULL,NULL),
(13,'main gate name plates',1,6,26,NULL,NULL),
(14,'looking glass & others',1,7,26,NULL,NULL),
(15,'wall paint',1,2,27,NULL,NULL),
(16,'wall filling',1,3,27,NULL,NULL),
(17,'wood polish',1,4,27,NULL,NULL),
(18,'wood contractor',1,1,28,NULL,NULL),
(19,'main entrance doors',1,2,28,NULL,NULL),
(20,'internal doors',1,3,28,NULL,NULL),
(21,'doors frame',1,4,28,NULL,NULL),
(22,'kitchen uv ground floor',1,5,28,NULL,NULL),
(23,'kitchen uv first floor',1,6,28,NULL,NULL),
(24,'wardrobes & lcd uv',1,7,28,NULL,NULL),
(25,'stair railing',1,8,28,NULL,NULL),
(26,'doors locks & handle fitting',1,8,28,NULL,NULL),
(27,'wooden ceiling design',1,9,28,NULL,NULL),
(28,'bedroom niches',1,12,28,NULL,NULL),
(29,'2 master washrooms',1,1,29,NULL,NULL),
(30,'3 other washrooms',1,3,29,NULL,NULL),
(31,'powder room',1,4,29,NULL,NULL),
(32,'servant washroom',1,5,29,NULL,NULL),
(33,'lobbies - floor',1,5,29,NULL,NULL),
(34,'drawing & dinning - floor',1,6,29,NULL,NULL),
(35,'tv halls - floor',1,7,29,NULL,NULL),
(36,'bed rooms - floor',1,8,29,NULL,NULL),
(37,'terrace ',1,9,29,NULL,NULL),
(38,'front elevation',1,10,29,NULL,NULL),
(39,'passage  ',1,11,29,NULL,NULL),
(40,'grage ',1,12,29,NULL,NULL),
(41,'kitchen walls',1,13,29,NULL,NULL),
(42,'stairs',1,1,30,NULL,NULL),
(43,'master kitchen slab',1,2,30,NULL,NULL),
(44,'second kitchen slab',1,3,30,NULL,NULL),
(46,'Vanities -  2 Washroom',1,6,30,NULL,NULL),
(47,'vanities - 3 Washroom',1,8,30,NULL,NULL),
(48,'tiles contractor',1,1,29,NULL,NULL),
(49,'plumber - contractor',1,1,31,NULL,NULL),
(50,'2 Master Shower Sets',1,2,31,NULL,NULL),
(51,'5 accessories sets',1,3,31,NULL,NULL),
(52,'commodes - simple',1,6,31,NULL,NULL),
(53,'commodes - internal',1,7,31,NULL,NULL),
(54,'seats',1,8,31,NULL,NULL),
(55,'venities',1,9,31,NULL,NULL),
(56,'bowls',1,11,31,NULL,NULL),
(62,'accessories & others',1,9,32,NULL,NULL),
(63,'wires',1,1,33,NULL,NULL),
(64,'breakers',1,2,33,NULL,NULL),
(65,'ceiling lights',1,3,33,NULL,NULL),
(66,'fitting',1,4,33,NULL,NULL),
(67,'wall lights',1,5,33,NULL,NULL),
(68,'chandeliers',1,5,33,NULL,NULL),
(72,'Others Stuff',1,11,33,NULL,NULL),
(73,'wallpaper',1,1,34,NULL,NULL),
(74,'ceiling',1,1,35,NULL,NULL),
(77,'mdf - lamination & others',1,13,28,NULL,NULL),
(78,'bond & others',1,10,29,NULL,NULL),
(79,'windows marble',1,5,30,NULL,NULL),
(80,'garden & others',1,5,30,NULL,NULL),
(81,'3 others shower sets',1,1,31,NULL,NULL),
(82,'others expensive',1,7,31,NULL,NULL),
(83,'exterior paint',1,4,27,NULL,NULL),
(84,'bricks',1,1,38,'material-bricks',1),
(85,'steel',1,2,38,'material-steel',1),
(86,'cement',1,3,38,'material-cement',1),
(87,'sand',1,4,38,'material-sand',1),
(88,'crush',1,5,38,'material-crush',1),
(89,'bajar',1,6,38,'material-bajar',1),
(90,'termite pipes',1,7,38,'material-termitepipes',1),
(91,'broken bricks',1,8,38,'material-brokenbricks',1),
(92,'electric pipes',1,10,38,'material-electricpipes',1),
(94,'sanitary & sewerage',1,12,38,'material-saintry',1),
(95,'grey contractor',1,1,39,'',NULL),
(96,'electric contractor',1,2,39,'',NULL),
(97,'plumber',1,4,39,'',NULL),
(98,'main gate',1,1,40,'material-maingate',NULL),
(99,'grills ',1,4,40,'material-grills',NULL),
(100,'grey more detalis ',1,4,40,'material-more',NULL);

/*Table structure for table `packages_stg_jn_comp` */

DROP TABLE IF EXISTS `packages_stg_jn_comp`;

CREATE TABLE `packages_stg_jn_comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_stages_categories` int(11) NOT NULL,
  `fk_companies` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `packages_stg_jn_comp` */

insert  into `packages_stg_jn_comp`(`id`,`fk_stages_categories`,`fk_companies`,`status`,`orderby`) values 
(7,27,10,1,1),
(8,26,11,1,2),
(9,26,12,1,2),
(10,26,13,1,2),
(11,26,14,1,4),
(12,27,15,1,1),
(13,28,16,1,1),
(14,27,17,1,4),
(15,27,18,1,3),
(16,27,19,1,5),
(17,28,20,1,4),
(18,28,21,1,1),
(19,28,22,1,1),
(20,28,23,1,1),
(21,28,24,1,1),
(22,28,25,1,1),
(23,28,26,1,1),
(24,28,27,1,1),
(25,28,28,1,10),
(26,28,29,1,6),
(27,29,31,1,1),
(28,29,32,1,12),
(29,27,33,1,1),
(30,30,22,1,1),
(31,31,35,1,1),
(32,33,36,1,1),
(33,34,37,1,8),
(34,27,38,1,20),
(35,33,39,1,1),
(36,38,40,1,1),
(37,38,41,1,2),
(38,38,42,1,2),
(39,38,43,1,1),
(40,38,44,1,1),
(41,38,45,1,2),
(42,38,46,1,1),
(43,38,48,1,2),
(44,40,49,1,1);

/*Table structure for table `payments_credit` */

DROP TABLE IF EXISTS `payments_credit`;

CREATE TABLE `payments_credit` (
  `id_credit` int(11) NOT NULL AUTO_INCREMENT,
  `amount_payment_credit` float NOT NULL,
  `fk_project` int(11) NOT NULL,
  `date_payment_credit` date NOT NULL,
  `type_payment_credit` int(11) NOT NULL,
  `info_payment_credit` varchar(45) DEFAULT NULL,
  `balance` float NOT NULL,
  PRIMARY KEY (`id_credit`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `payments_credit` */

insert  into `payments_credit`(`id_credit`,`amount_payment_credit`,`fk_project`,`date_payment_credit`,`type_payment_credit`,`info_payment_credit`,`balance`) values 
(1,60000,6,'2020-03-01',1,'This is test credit',0),
(2,55000,7,'2020-03-05',2,'This is test credit2',5000),
(3,65000,9,'2020-03-10',3,'This is test credit3',-5000);

/*Table structure for table `payments_labour` */

DROP TABLE IF EXISTS `payments_labour`;

CREATE TABLE `payments_labour` (
  `id_labour` int(11) NOT NULL AUTO_INCREMENT,
  `amount_payment_labour` float NOT NULL,
  `fk_team` int(11) NOT NULL,
  `fk_project` int(11) NOT NULL,
  `date_payment_labour` date NOT NULL,
  `type_payment_labour` int(11) NOT NULL,
  `info_payment_labour` varchar(45) DEFAULT NULL,
  `balance` float NOT NULL,
  PRIMARY KEY (`id_labour`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `payments_labour` */

insert  into `payments_labour`(`id_labour`,`amount_payment_labour`,`fk_team`,`fk_project`,`date_payment_labour`,`type_payment_labour`,`info_payment_labour`,`balance`) values 
(1,50000,1,6,'2020-03-01',1,'This is labour test1',0),
(2,30000,2,7,'2020-03-05',2,'This is labour test2',20000),
(3,55000,3,9,'2020-03-10',3,'This is labour test3',-5000);

/*Table structure for table `payments_mobmenu` */

DROP TABLE IF EXISTS `payments_mobmenu`;

CREATE TABLE `payments_mobmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `maincate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `payments_mobmenu` */

insert  into `payments_mobmenu`(`id`,`name`,`url`,`orderby`,`status`,`icon`,`maincate`) values 
(15,'Invoice Payments','payments/payments',1,1,'icon-speedometer','payments'),
(16,'Credit Payment','payments/credit',2,1,'fa fa-credit-card','payments'),
(17,'Labour Payment','payments/labour',3,1,'fa fa-credit-card','payments');

/*Table structure for table `payments_opd` */

DROP TABLE IF EXISTS `payments_opd`;

CREATE TABLE `payments_opd` (
  `id_payment_opd` int(11) NOT NULL AUTO_INCREMENT,
  `fk_orders_prodvent` int(11) NOT NULL,
  `amount_payment_opd` float NOT NULL,
  `date_payment_opd` date NOT NULL,
  `status_payment_opd` int(11) NOT NULL,
  `type_payment_opd` int(11) NOT NULL,
  `info_payment_opd` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_payment_opd`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `payments_opd` */

insert  into `payments_opd`(`id_payment_opd`,`fk_orders_prodvent`,`amount_payment_opd`,`date_payment_opd`,`status_payment_opd`,`type_payment_opd`,`info_payment_opd`) values 
(3,1,2000,'2020-03-04',2,3,'Paid To Anna By Paypal'),
(4,2,1000,'2020-03-05',1,2,'Anna test info in add payments'),
(5,3,5880000,'2020-03-10',1,1,'Paid Cash');

/*Table structure for table `phone` */

DROP TABLE IF EXISTS `phone`;

CREATE TABLE `phone` (
  `id_phone` int(11) NOT NULL AUTO_INCREMENT,
  `number_phone` varchar(20) NOT NULL,
  `status_phone` int(11) NOT NULL,
  `orderby_phone` int(11) NOT NULL,
  `section_phone` varchar(100) NOT NULL,
  `type_phone` int(11) NOT NULL,
  `fk_office_clients` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `phone` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name_product` varchar(45) NOT NULL,
  `fk_subcategories` int(11) NOT NULL,
  `status_product` int(11) NOT NULL,
  `order_product` int(11) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id_product`,`name_product`,`fk_subcategories`,`status_product`,`order_product`) values 
(7,'aaaaaaaaaaa',13,0,1),
(8,'bbbb',30,0,1),
(9,'Ash Wood',19,0,1);

/*Table structure for table `products_join_companies` */

DROP TABLE IF EXISTS `products_join_companies`;

CREATE TABLE `products_join_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_product` int(11) DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `products_join_companies` */

insert  into `products_join_companies`(`id`,`fk_product`,`fk_company`) values 
(1,7,12),
(2,7,10),
(3,8,10),
(4,8,11),
(5,7,14),
(6,9,28);

/*Table structure for table `prodvend` */

DROP TABLE IF EXISTS `prodvend`;

CREATE TABLE `prodvend` (
  `id_prodvend` int(11) NOT NULL AUTO_INCREMENT,
  `fk_products_prodvend` int(11) NOT NULL,
  `fk_vendors_prodvend` int(11) NOT NULL,
  `date_prodvend` date NOT NULL,
  `status_prodvend` int(11) NOT NULL,
  `order_prodvend` int(11) NOT NULL,
  PRIMARY KEY (`id_prodvend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prodvend` */

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id_projects` int(11) NOT NULL AUTO_INCREMENT,
  `name_projects` varchar(50) NOT NULL,
  `fk_office_types` int(11) NOT NULL,
  `fk_office_categories` int(11) NOT NULL,
  `fk_office_clients` int(11) NOT NULL,
  `date_projects` date NOT NULL,
  `fk_city` int(11) NOT NULL,
  `fk_society` int(11) NOT NULL,
  `fk_country` int(11) NOT NULL,
  PRIMARY KEY (`id_projects`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `projects` */

/*Table structure for table `projects_list` */

DROP TABLE IF EXISTS `projects_list`;

CREATE TABLE `projects_list` (
  `id_project` int(11) NOT NULL AUTO_INCREMENT,
  `name_project` varchar(255) NOT NULL,
  `joined_client` int(11) DEFAULT NULL,
  `amount_project` varchar(50) DEFAULT NULL,
  `amount_team` varchar(50) DEFAULT NULL,
  `address_project` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `images_project` varchar(255) NOT NULL,
  PRIMARY KEY (`id_project`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `projects_list` */

insert  into `projects_list`(`id_project`,`name_project`,`joined_client`,`amount_project`,`amount_team`,`address_project`,`start_date`,`end_date`,`images_project`) values 
(6,'Anna Home123',16,'60000','50000','China123','2020-02-29','2020-03-26','uploads/projects/project1582485801.jpg'),
(7,'460 Johar',14,'60000','50000','Johar Blaock Bahria Town','2020-02-22','2020-03-10','uploads/projects/project1583857096.jpg'),
(9,'Project1',16,'60000','50000','pakistan1','2020-03-10','2020-03-31','uploads/projects/project1583856231.jpg');

/*Table structure for table `projects_mobmenu` */

DROP TABLE IF EXISTS `projects_mobmenu`;

CREATE TABLE `projects_mobmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `orderby` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `maincate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `projects_mobmenu` */

insert  into `projects_mobmenu`(`id`,`name`,`url`,`orderby`,`status`,`icon`,`maincate`) values 
(15,'Dashboard','projects',1,1,'icon-speedometer','products'),
(16,'Under Construction','projects/underconstruction',2,1,'fa fa-folder-open','products'),
(17,'Pending','projects/pending',3,1,'fa fa-spinner','products'),
(18,'Completed','projects/completed',4,1,'fa fa-check-circle fa-lg','products');

/*Table structure for table `req_categories` */

DROP TABLE IF EXISTS `req_categories`;

CREATE TABLE `req_categories` (
  `id_categories` int(11) NOT NULL AUTO_INCREMENT,
  `name_categories` varchar(45) DEFAULT NULL,
  `orderby_categories` int(11) DEFAULT NULL,
  `status_categories` int(11) DEFAULT NULL,
  `class_categories` varchar(50) NOT NULL,
  `bg_colour` varchar(50) NOT NULL,
  `url_categories` varchar(50) NOT NULL,
  `show_counter` int(11) NOT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `req_categories` */

insert  into `req_categories`(`id_categories`,`name_categories`,`orderby_categories`,`status_categories`,`class_categories`,`bg_colour`,`url_categories`,`show_counter`) values 
(1,'Meetings',4,1,'fa fa-calendar-check-o','meetingbg','office/meetings',1),
(2,'Quotations',3,1,'fa fa-table','qoutationbg','office/quotations',1),
(3,'Buy & Sales',7,1,'fa fa-cart-plus','buysalebg','office/buysale',1),
(4,'Drawings',5,1,'fas fa-pencil-ruler','drawingbg','office/drawings',1),
(5,'Calls',6,1,'fa fa-phone','callsbg','office/calls',1),
(6,'Tasks',8,1,'fa fa-tasks','tasksbg','office/tasks',1),
(7,'Visits',7,1,'fas fa-eye','visitsbg','office/visits',1),
(8,'Requests',2,1,'fa fa-envelope','visitsbg','office/requests',1),
(9,'Clients',1,1,'fa fa-group','visitsbg','office/clients',0),
(11,'Dashborad',1,1,'icon-speedometer','primary','office',1);

/*Table structure for table `reqct_jn_stct` */

DROP TABLE IF EXISTS `reqct_jn_stct`;

CREATE TABLE `reqct_jn_stct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_req_categories` int(11) NOT NULL,
  `fk_status_categories` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `reqct_jn_stct` */

insert  into `reqct_jn_stct`(`id`,`fk_req_categories`,`fk_status_categories`,`status`,`orderby`) values 
(1,1,1,1,1),
(2,1,2,1,2),
(3,1,3,1,3),
(4,1,4,1,4),
(5,2,1,1,1),
(6,2,10,1,2),
(7,2,12,1,3),
(8,3,1,1,1),
(9,3,7,1,2),
(10,3,8,1,3),
(11,3,3,1,4),
(12,2,13,1,4),
(13,3,6,1,2),
(14,4,1,1,1),
(15,4,11,1,2),
(16,4,14,1,3),
(17,4,9,1,4),
(18,5,1,1,1),
(19,5,15,1,2),
(20,6,1,1,1),
(21,6,6,1,2),
(22,6,8,1,3),
(23,6,3,1,4),
(24,7,1,1,1),
(25,7,16,1,2),
(26,4,5,1,5);

/*Table structure for table `requests` */

DROP TABLE IF EXISTS `requests`;

CREATE TABLE `requests` (
  `id_requests` int(11) NOT NULL AUTO_INCREMENT,
  `fk_office_clients` int(11) NOT NULL,
  `date_requests` date NOT NULL,
  `fk_reqcategories` int(11) NOT NULL,
  `exdate_requests` date NOT NULL,
  `status_requests` int(11) NOT NULL,
  `progress_requests` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_requests`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `requests` */

insert  into `requests`(`id_requests`,`fk_office_clients`,`date_requests`,`fk_reqcategories`,`exdate_requests`,`status_requests`,`progress_requests`,`updated_date`) values 
(23,40,'2019-12-21',1,'2019-12-21',0,10,'0000-00-00 00:00:00'),
(24,40,'2019-12-21',1,'2019-12-21',1,45,'0000-00-00 00:00:00'),
(25,40,'2019-12-21',1,'2019-12-21',1,45,'0000-00-00 00:00:00'),
(26,40,'2019-12-21',1,'2019-12-21',1,45,'0000-00-00 00:00:00');

/*Table structure for table `societies` */

DROP TABLE IF EXISTS `societies`;

CREATE TABLE `societies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `fk_cities` int(11) NOT NULL,
  `orderby` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `societies` */

insert  into `societies`(`id`,`name`,`fk_cities`,`orderby`,`status`) values 
(7,'Bahria Town',1,1,1),
(8,'Bahria Town',5,2,1),
(9,'Al Kabir Town',1,3,1),
(10,'Bahria Orchard',1,3,1),
(11,'Gulshan Ravi',1,4,1);

/*Table structure for table `status_categories` */

DROP TABLE IF EXISTS `status_categories`;

CREATE TABLE `status_categories` (
  `id_categories` int(11) NOT NULL AUTO_INCREMENT,
  `name_categories` varchar(45) DEFAULT NULL,
  `orderby_categories` int(11) DEFAULT NULL,
  `status_categories` int(11) DEFAULT NULL,
  `class_categories` varchar(50) NOT NULL,
  `bg_colour` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `status_categories` */

insert  into `status_categories`(`id_categories`,`name_categories`,`orderby_categories`,`status_categories`,`class_categories`,`bg_colour`,`count`) values 
(1,'Pending',1,1,'fa fa-circle-o-notch fa-spin fa-lg','pending',1),
(2,'Confirmed',2,1,'fa fa-check-circle fa-lg','confirmed',1),
(3,'Cancelled',18,1,'fa fa-close fa-lg','canceled',0),
(4,'Met',15,1,'fa fa-handshake-o fa-lg','approved',0),
(5,'Approved',12,1,'fa fa-check fa-lg','approved',0),
(6,'Progress..',5,1,'fa fa-hourglass-start fa-lg','confirmed',1),
(7,'Dealing',4,1,'fa fa-retweet fa-lg','confirmed',1),
(8,'Done',8,1,'fa fa-check-circle fa-lg','approved',0),
(9,'Submited',9,1,'fa fa-check fa-lg','approved',0),
(10,'Sent',10,1,'fa fa-envelope fa-lg','approved',0),
(11,'Making',3,1,'fa fa-spinner fa-lg','confirmed',1),
(12,'Waiting..',2,1,'fa fa-user-circle fa-lg','pink',1),
(13,'Gone',19,1,'fa fa-close fa-lg','canceled',0),
(14,'Delivered',14,1,'fa fa-truck fa-lg','approved',0),
(15,'Called',15,1,'fa fa-phone-square fa-lg','approved',0),
(16,'Visited',16,1,'fa fa-eye fa-lg','approved',0),
(17,'Paid',17,1,'fa fa-money fa-lg','approved',0),
(18,'Not Paid',6,1,'fa fa-money fa-lg','pink',1);

/*Table structure for table `subcategories` */

DROP TABLE IF EXISTS `subcategories`;

CREATE TABLE `subcategories` (
  `id_subcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name_subcategory` varchar(45) NOT NULL,
  `status_subcategory` int(11) NOT NULL,
  `order_subcategory` int(11) NOT NULL,
  `fk_category_subcategory` int(11) NOT NULL,
  PRIMARY KEY (`id_subcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `subcategories` */

insert  into `subcategories`(`id_subcategory`,`name_subcategory`,`status_subcategory`,`order_subcategory`,`fk_category_subcategory`) values 
(2,'Silage',0,0,2),
(3,'Wanda',0,1,2),
(4,'Vitamins',0,2,9),
(5,'Pregnacy',0,3,4),
(6,'Minerals',0,4,9),
(7,'Cows Items',0,1,7),
(8,'Semens',0,1,10),
(9,'Transport ',0,1,3),
(10,'Anti Biotic',0,2,4);

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_role` enum('superadmin','manager','office member','client') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`user_id`,`user_name`,`user_email`,`user_password`,`user_role`,`created_date`,`last_login_date`) values 
(1,'maniking','usmancf@gmail.com','e10adc3949ba59abbe56e057f20f883e','superadmin','2020-03-12 03:14:32','2020-03-12 03:14:32'),
(13,'asd','asd@asd','7815696ecbf1c96e6894b779456d330e','office member','2020-02-24 05:12:11','0000-00-00 00:00:00'),
(14,'Mani(Client1)','client1@email.com','698d51a19d8a121ce581499d7b701668','client','2020-03-05 15:53:01','0000-00-00 00:00:00'),
(15,'Umar(Client2)','client2@email.com','bcbe3365e6ac95ea2c0343a2395834dd','client','2020-03-05 15:53:32','0000-00-00 00:00:00'),
(16,'Client3','client3@email.com','310dcbbf4cce62f762a2aaa148d556bd','client','2020-03-05 15:54:10','0000-00-00 00:00:00'),
(17,'Client4','client4@email.com','550a141f12de6341fba65b0ad0433500','client','2020-03-05 15:54:36','0000-00-00 00:00:00');

/*Table structure for table `teams` */

DROP TABLE IF EXISTS `teams`;

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL,
  `fk_category` int(11) NOT NULL,
  `fk_subcategory` int(11) NOT NULL,
  `phone1` varchar(50) NOT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `teams` */

insert  into `teams`(`team_id`,`team_name`,`fk_category`,`fk_subcategory`,`phone1`,`phone2`,`added_date`) values 
(1,'Team Name1',27,15,'1111111','2222222','2020-03-11'),
(2,'Team Name2',28,20,'33333333','44444444','2020-03-11'),
(3,'Team Name3',29,32,'55555555','66666666','2020-03-11');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `email` varchar(255) NOT NULL COMMENT 'Email Address',
  `contact_no` varchar(50) NOT NULL COMMENT 'Contact No',
  `created_at` varchar(20) NOT NULL COMMENT 'Created date',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='datatable demo table';

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`contact_no`,`created_at`) values 
(1,'usman','usmancf@gmail.com','03471041006','2019-12-12'),
(2,'shahab zafar','shahab@gmail.com','0233344444','2019-11-11'),
(3,'shahab zafar2','shahab@gmail.com2','0233344444','2019-11-11'),
(4,'shahab zafar3','shahab@gmail.com2','0233344444','2019-10-11'),
(5,'shahab zafar3','shahab@gmail.com2','0233344444','2019-12-11'),
(6,'shahab zafar3','shahab@gmail.com2','0233344444','2019-09-11'),
(7,'shahab zafar3','shahab@gmail.com2','0233344444','2019-09-11'),
(8,'shahab zafar3','shahab@gmail.com2','0233344444','2019-09-11'),
(9,'shahab zafar3','shahab@gmail.com2','0233344444','2019-09-11'),
(10,'shahab zafar3','shahab@gmail.com2','0233344444','2019-09-11'),
(11,'shahab zafar3','shahab@gmail.com2','0233344444','2019-10-11'),
(12,'shahab zafar3','shahab@gmail.com2','0233344444','2019-10-11'),
(13,'shahab zafar3','shahab@gmail.com2','0233344444','2019-11-11'),
(14,'shahab zafar3','shahab@gmail.com2','0233344444','2018-11-11'),
(15,'shahab zafar3','shahab@gmail.com2','0233344444','2019-05-11'),
(16,'shahab zafar3','shahab@gmail.com2','0233344444','2019-05-11'),
(17,'shahab zafar3','shahab@gmail.com2','0233344444','2019-05-11'),
(18,'shahab zafar3','shahab@gmail.com2','0233344444','2017-05-11');

/*Table structure for table `vendors` */

DROP TABLE IF EXISTS `vendors`;

CREATE TABLE `vendors` (
  `id_vendors` int(11) NOT NULL AUTO_INCREMENT,
  `name_vendors` varchar(45) NOT NULL,
  `company_vendors` varchar(100) DEFAULT NULL,
  `contact_vendors` varchar(45) NOT NULL,
  `adress_vendors` text,
  `status_vendors` int(11) NOT NULL,
  `added_date_vendors` date NOT NULL,
  PRIMARY KEY (`id_vendors`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `vendors` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
