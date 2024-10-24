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


-- Dumping database structure for db_spk
CREATE DATABASE IF NOT EXISTS `db_spk` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_spk`;

-- Dumping structure for table db_spk.hasil_kmeans
CREATE TABLE IF NOT EXISTS `hasil_kmeans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_alternatif` int DEFAULT NULL,
  `cluster` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_alternatif` (`id_alternatif`),
  CONSTRAINT `hasil_kmeans_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `tbl_alternatif` (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_spk.hasil_kmeans: ~2 rows (approximately)
INSERT INTO `hasil_kmeans` (`id`, `id_alternatif`, `cluster`) VALUES
	(1, 1, 0),
	(2, 2, 0),
	(3, 3, 0),
	(4, 4, 0),
	(5, 7, 0),
	(6, 8, 0),
	(7, 10, 0),
	(8, 5, 1),
	(9, 6, 1),
	(10, 9, 1);

-- Dumping structure for table db_spk.tbl_admin
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_spk.tbl_admin: ~1 rows (approximately)
INSERT INTO `tbl_admin` (`id_admin`, `nama`, `username`, `password`) VALUES
	(1, 'Rosal', 'rosal', 'rosal');

-- Dumping structure for table db_spk.tbl_alternatif
CREATE TABLE IF NOT EXISTS `tbl_alternatif` (
  `id_alternatif` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nip` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_spk.tbl_alternatif: ~2 rows (approximately)
INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama`, `jabatan`, `nip`) VALUES
	(1, 'A1', 'guru', '123'),
	(2, 'A2', 'guru', '456'),
	(3, 'A3', 'guru', '789'),
	(4, 'A4', 'guru', '012'),
	(5, 'A5', 'guru', '345'),
	(6, 'A6', 'guru', '678'),
	(7, 'A7', 'guru', '901'),
	(8, 'A8', 'guru', '234'),
	(9, 'A9', 'guru', '567'),
	(10, 'A10', 'guru', '890');

-- Dumping structure for table db_spk.tbl_bobot
CREATE TABLE IF NOT EXISTS `tbl_bobot` (
  `id_bobot` int NOT NULL AUTO_INCREMENT,
  `w1` double NOT NULL,
  `w2` double NOT NULL,
  `w3` double NOT NULL,
  `w4` double NOT NULL,
  PRIMARY KEY (`id_bobot`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_spk.tbl_bobot: ~1 rows (approximately)
INSERT INTO `tbl_bobot` (`id_bobot`, `w1`, `w2`, `w3`, `w4`) VALUES
	(1, 0.27, 0.28, 0.23, 0.22);

-- Dumping structure for table db_spk.tbl_nilai
CREATE TABLE IF NOT EXISTS `tbl_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_alternatif` int NOT NULL,
  `c1` int NOT NULL,
  `c2` int NOT NULL,
  `c3` int NOT NULL,
  `c4` int NOT NULL,
  `skor` double DEFAULT NULL,
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_spk.tbl_nilai: ~10 rows (approximately)
INSERT INTO `tbl_nilai` (`id_nilai`, `id_alternatif`, `c1`, `c2`, `c3`, `c4`, `skor`) VALUES
	(1, 1, 85, 2, 4, 2, 0.84),
	(2, 2, 86, 3, 2, 3, 0.872),
	(3, 3, 88, 2, 3, 3, 0.865),
	(4, 4, 87, 3, 4, 3, 1),
	(5, 5, 83, 3, 3, 3, 0.616),
	(6, 6, 84, 3, 3, 2, 0.565),
	(7, 7, 88, 4, 3, 2, 0.938),
	(8, 8, 87, 3, 3, 2, 0.859),
	(9, 9, 82, 4, 3, 2, 0.611),
	(10, 10, 89, 3, 4, 2, 0.927);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
