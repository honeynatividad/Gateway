/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.16 : Database - pportal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pportal` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `pportal`;

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1637 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `event_calendar` */

DROP TABLE IF EXISTS `event_calendar`;

CREATE TABLE `event_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_date` date NOT NULL,
  `title` varchar(250) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_dep_emails` */

DROP TABLE IF EXISTS `portal_dep_emails`;

CREATE TABLE `portal_dep_emails` (
  `dep_email_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dep_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dep_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_department` */

DROP TABLE IF EXISTS `portal_department`;

CREATE TABLE `portal_department` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_dl_forms` */

DROP TABLE IF EXISTS `portal_dl_forms`;

CREATE TABLE `portal_dl_forms` (
  `dl_id` int(11) NOT NULL AUTO_INCREMENT,
  `dl_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `dl_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`dl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_fav_provider` */

DROP TABLE IF EXISTS `portal_fav_provider`;

CREATE TABLE `portal_fav_provider` (
  `fav_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `prov_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_coordinator` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_address` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_contact` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_code` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_lat` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_long` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `prov_region` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_pin` datetime DEFAULT NULL,
  PRIMARY KEY (`fav_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_feedbacks` */

DROP TABLE IF EXISTS `portal_feedbacks`;

CREATE TABLE `portal_feedbacks` (
  `fbs_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `contact_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `comments` longtext COLLATE utf8_bin,
  `read_status` int(1) DEFAULT '0' COMMENT '0=''unread'',1=''read''',
  `date_created` datetime DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0',
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`fbs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_informations` */

DROP TABLE IF EXISTS `portal_informations`;

CREATE TABLE `portal_informations` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `terms_info` longtext COLLATE utf8_bin,
  `privacy_info` longtext COLLATE utf8_bin,
  `faq_info` longtext COLLATE utf8_bin,
  `logindesc` longtext COLLATE utf8_bin,
  `regdesc` longtext COLLATE utf8_bin,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_messages` */

DROP TABLE IF EXISTS `portal_messages`;

CREATE TABLE `portal_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) DEFAULT NULL,
  `subject` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `messages` longtext COLLATE utf8_bin,
  `is_deleted` int(2) DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_messages_receiver` */

DROP TABLE IF EXISTS `portal_messages_receiver`;

CREATE TABLE `portal_messages_receiver` (
  `rcv_msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `read_status` int(2) DEFAULT '0' COMMENT '1=read, 0=unread',
  `is_deleted` int(2) DEFAULT '0' COMMENT '1=deleted, 0=active',
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`rcv_msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_pages` */

DROP TABLE IF EXISTS `portal_pages`;

CREATE TABLE `portal_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `page_parent` int(2) DEFAULT NULL,
  `has_sub` int(2) DEFAULT NULL,
  `page_url` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `active_stat` int(2) DEFAULT '1',
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_users` */

DROP TABLE IF EXISTS `portal_users`;

CREATE TABLE `portal_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `certNo` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `fname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `lname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `user_level` int(11) unsigned DEFAULT NULL,
  `bdate` date DEFAULT NULL,
  `is_activated` int(2) DEFAULT '0',
  `date_created` datetime DEFAULT NULL,
  `dateVerified` datetime DEFAULT NULL,
  `image` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `login_attempt` int(2) DEFAULT '0',
  `login_attempt_date` datetime DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `prepaid_access` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_users_details` */

DROP TABLE IF EXISTS `portal_users_details`;

CREATE TABLE `portal_users_details` (
  `details_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `firstname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `middlename` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `house_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `barangay` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `home_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `province` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `sex` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `civil_stat` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `certno` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `cotact_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `agreement_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `agreement_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `benifit_limit` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_registered` datetime DEFAULT NULL,
  `date_verified` datetime DEFAULT NULL,
  `dental` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `hospitals` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `member_type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `package_desc` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `philhealth` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `plan_type` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `policy_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `pre_ex` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `riders` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `room_desc` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `room_rate` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `subdivision` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `portal_users_other_info` */

DROP TABLE IF EXISTS `portal_users_other_info`;

CREATE TABLE `portal_users_other_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `company_address` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `work_no` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `designation` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `prepaid_access` */

DROP TABLE IF EXISTS `prepaid_access`;

CREATE TABLE `prepaid_access` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `prepaid_name` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `provinces` */

DROP TABLE IF EXISTS `provinces`;

CREATE TABLE `provinces` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
