-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table fkkiosk.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
); 
-- Dumping data for table fkkiosk.admin: ~0 rows (approximately)
INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
	(1, 'admin', '1234', 'admin@gmail.com');

-- Dumping structure for table fkkiosk.kiosk
CREATE TABLE IF NOT EXISTS `kiosk` (
  `id_kiosk` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL DEFAULT '0',
  `kiosk_name` varchar(500) NOT NULL DEFAULT '0',
  `operating_hours` varchar(500) NOT NULL DEFAULT '0',
  `kiosk_information` varchar(500) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT '0',
  `kiosk_img_dir` longtext NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id_kiosk`)
); 

-- Dumping data for table fkkiosk.kiosk: ~2 rows (approximately)
INSERT INTO `kiosk` (`id_kiosk`, `id_user`, `kiosk_name`, `operating_hours`, `kiosk_information`, `status`, `kiosk_img_dir`, `updated_at`) VALUES
	(4, 1, 'Vendor Kiosk 1', '9.00 a.m - 10.00 p.m', 'vendor kiosk 1', 'open', 'none', '2023-12-27 04:59:50'),
	(5, 7, 'Ali Kiosk', '9.00 a.m - 10.00 p.m', 'Ali kiosk', 'open', 'none', '2024-01-13 08:33:17');

-- Dumping structure for table fkkiosk.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `id_kiosk` int NOT NULL DEFAULT '0',
  `menu_name` varchar(500) DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT '0',
  `image_dir` longtext NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id_menu`)
); 

-- Dumping data for table fkkiosk.menu: ~5 rows (approximately)
INSERT INTO `menu` (`id_menu`, `id_kiosk`, `menu_name`, `price`, `status`, `image_dir`, `updated_at`) VALUES
	(3, 4, 'Nasi Goreng Kampung', 8.5, 'available', 'none', '2023-12-27 05:00:14'),
	(4, 4, 'Nasi Goreng Kampung', 8.5, 'unavailable', 'none', '2023-12-27 05:00:26'),
	(5, 4, 'Mee Goreng Daging', 6.5, 'available', 'none', '2024-01-09 16:48:09'),
	(6, 5, 'Maggi Goreng', 9.2, 'available', 'none', '2024-01-13 08:33:49'),
	(7, 5, 'Teh o ais', 1.5, 'available', 'none', '2024-01-13 08:34:02');

-- Dumping structure for table fkkiosk.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `role` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `document` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_user`)
);

-- Dumping data for table fkkiosk.user: ~2 rows (approximately)
INSERT INTO `user` (`id_user`, `role`, `name`, `phone`, `email`, `password`, `document`, `status`) VALUES
	(1, 'vendor', 'Muhammad Hanif', '0198888888', 'vendor@gmail.com', '1234', 'user.pdf', 'Approved'),
	(2, 'user', 'Nur Atirah', '0198888888', 'user@gmail.com', '1234', 'vendor.pdf', 'Approved'),
	(7, 'vendor', 'Ahmad Ali', '0109533882', 'ali@gmail.com', '1234', 'BCS2243 Project Instruction_SEM I_202324.pdf', 'Approved');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
