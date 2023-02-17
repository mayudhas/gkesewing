-- --------------------------------------------------------
-- Host:                         172.17.10.10
-- Server version:               10.5.16-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gkesewing
DROP DATABASE IF EXISTS `gkesewing`;
CREATE DATABASE IF NOT EXISTS `gkesewing` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gkesewing`;

-- Dumping structure for table gkesewing.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_code` int(11) unsigned NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `uti_account_post_id` int(11) NOT NULL,
  `uti_account_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.customer
DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_phone` varchar(15) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.employee
DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) NOT NULL,
  `employee_phone` varchar(15) DEFAULT NULL,
  `employee_type` enum('Tetap','Freelance') NOT NULL,
  `employee_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  `employee_photo_path` text DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.ledger
DROP TABLE IF EXISTS `ledger`;
CREATE TABLE IF NOT EXISTS `ledger` (
  `ledger_code` char(20) NOT NULL,
  `ledger_number` int(11) NOT NULL,
  `ledger_name` varchar(255) DEFAULT NULL,
  `ledger_desc` text NOT NULL,
  `ledger_date` date NOT NULL,
  `transaction_code` varchar(20) DEFAULT NULL,
  `spending_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ledger_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.ledger_detail
DROP TABLE IF EXISTS `ledger_detail`;
CREATE TABLE IF NOT EXISTS `ledger_detail` (
  `ledger_detail_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ledger_code` char(20) NOT NULL,
  `account_code` int(11) unsigned NOT NULL,
  `uti_account_post_id` int(11) unsigned NOT NULL,
  `ledger_detail_score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ledger_detail_id`) USING BTREE,
  KEY `account_code` (`account_code`) USING BTREE,
  KEY `ledger_id` (`ledger_code`) USING BTREE,
  KEY `uti_account_post_id` (`uti_account_post_id`),
  CONSTRAINT `ledger_detail_ibfk_1` FOREIGN KEY (`account_code`) REFERENCES `account` (`account_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(225) NOT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_link` varchar(225) NOT NULL,
  `menu_sort` int(11) NOT NULL,
  `menu_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.menu_role
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `menu_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL,
  `user_level_id` int(11) unsigned NOT NULL,
  `menu_role_action` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`menu_role_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `level` (`user_level_id`) USING BTREE,
  CONSTRAINT `FK_menu_role_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_menu_role_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_buy` int(11) NOT NULL,
  `uti_product_category_id` int(11) unsigned NOT NULL,
  `product_status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 Aktif, 0 Tidak Aktif',
  PRIMARY KEY (`product_id`),
  KEY `FK_product_uti_product_category` (`uti_product_category_id`),
  CONSTRAINT `FK_product_uti_product_category` FOREIGN KEY (`uti_product_category_id`) REFERENCES `uti_product_category` (`uti_product_category_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_company` varchar(255) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_phone` varchar(15) NOT NULL,
  `supplier_address` text NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.transaction
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_code` varchar(20) NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_desc` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`transaction_code`) USING BTREE,
  KEY `employee_id` (`employee_id`),
  KEY `customer_phone` (`customer_phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.transaction_detail
DROP TABLE IF EXISTS `transaction_detail`;
CREATE TABLE IF NOT EXISTS `transaction_detail` (
  `transaction_detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT 0,
  `transaction_detail_price` double NOT NULL DEFAULT 0,
  `transaction_detail_quantity` double NOT NULL DEFAULT 0,
  `transaction_detail_total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`transaction_detail_id`),
  KEY `transaction_code` (`transaction_code`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `FK_transaction_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaction_detail_transaction` FOREIGN KEY (`transaction_code`) REFERENCES `transaction` (`transaction_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.transaction_detail_temp
DROP TABLE IF EXISTS `transaction_detail_temp`;
CREATE TABLE IF NOT EXISTS `transaction_detail_temp` (
  `detail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(20) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `transaction_detail_discount` float NOT NULL DEFAULT 0,
  `transaction_detail_price` double NOT NULL DEFAULT 0,
  `transaction_detail_quantity` double NOT NULL DEFAULT 0,
  `transaction_detail_total` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`detail_id`) USING BTREE,
  KEY `transaction_code` (`transaction_code`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.transaction_spending
DROP TABLE IF EXISTS `transaction_spending`;
CREATE TABLE IF NOT EXISTS `transaction_spending` (
  `spending_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `spending_date` date NOT NULL,
  `spending_desc` text NOT NULL,
  `spending_total` double NOT NULL,
  `spending_photo_path` text NOT NULL,
  `is_ledger` bit(1) NOT NULL DEFAULT b'0' COMMENT '0 = Belum BKU, 1 = Sudah BKU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`spending_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) unsigned NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_is_active` int(11) NOT NULL DEFAULT 1,
  `employee_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `FK_user_user_level` (`user_level_id`),
  KEY `FK_user_employee` (`employee_id`),
  CONSTRAINT `FK_user_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`user_level_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.user_level
DROP TABLE IF EXISTS `user_level`;
CREATE TABLE IF NOT EXISTS `user_level` (
  `user_level_id` int(11) unsigned NOT NULL,
  `user_level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_level_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.uti_account_group
DROP TABLE IF EXISTS `uti_account_group`;
CREATE TABLE IF NOT EXISTS `uti_account_group` (
  `uti_account_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_group_name` varchar(50) NOT NULL,
  `uti_account_group_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.uti_account_post
DROP TABLE IF EXISTS `uti_account_post`;
CREATE TABLE IF NOT EXISTS `uti_account_post` (
  `uti_account_post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_account_post_name` varchar(50) NOT NULL,
  `uti_account_post_alias` char(5) NOT NULL,
  PRIMARY KEY (`uti_account_post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table gkesewing.uti_product_category
DROP TABLE IF EXISTS `uti_product_category`;
CREATE TABLE IF NOT EXISTS `uti_product_category` (
  `uti_product_category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uti_product_category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`uti_product_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for trigger gkesewing.menus_after_insert
DROP TRIGGER IF EXISTS `menus_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `menus_after_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
insert menu_role (menu_id, user_level_id, menu_role_action) values (new.menu_id, 1, 1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
