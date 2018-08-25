/*
SQLyog Community v11.51 (64 bit)
MySQL - 10.0.17-MariaDB : Database - kaskecil
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kaskecil` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kaskecil`;

/*Table structure for table `biaya` */

DROP TABLE IF EXISTS `biaya`;

CREATE TABLE `biaya` (
  `no_biaya` char(8) NOT NULL,
  `nm_biaya` char(25) DEFAULT NULL,
  PRIMARY KEY (`no_biaya`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `biaya` */

/*Table structure for table `kas_kecil` */

DROP TABLE IF EXISTS `kas_kecil`;

CREATE TABLE `kas_kecil` (
  `no_kaskecil` char(8) NOT NULL,
  `tgl_kaskecil` date DEFAULT NULL,
  `jml_transaksi` int(25) DEFAULT NULL,
  `nm_akun` char(25) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `no_penerimaan` char(8) DEFAULT NULL,
  `no_pengeluaran` char(8) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_kaskecil`),
  KEY `no_penerimaan` (`no_penerimaan`),
  KEY `no_pengeluaran` (`no_pengeluaran`),
  CONSTRAINT `kas_kecil_ibfk_1` FOREIGN KEY (`no_penerimaan`) REFERENCES `penerimaan_kk` (`no_penerimaan`),
  CONSTRAINT `kas_kecil_ibfk_2` FOREIGN KEY (`no_pengeluaran`) REFERENCES `pengeluaran_kk` (`no_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kas_kecil` */

/*Table structure for table `penerimaan_kk` */

DROP TABLE IF EXISTS `penerimaan_kk`;

CREATE TABLE `penerimaan_kk` (
  `no_penerimaan` char(8) NOT NULL,
  `tgl_penerimaan` date DEFAULT NULL,
  `nm_penerimaan` char(25) DEFAULT NULL,
  `jml_penerimaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_penerimaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `penerimaan_kk` */

/*Table structure for table `pengeluaran_kk` */

DROP TABLE IF EXISTS `pengeluaran_kk`;

CREATE TABLE `pengeluaran_kk` (
  `no_pengeluaran` char(8) NOT NULL,
  `tgl_pengeluaran` date DEFAULT NULL,
  `jml_pengeluaran` int(11) DEFAULT NULL,
  `nm_pengeluaran` char(25) DEFAULT NULL,
  `no_biaya` char(8) NOT NULL,
  PRIMARY KEY (`no_pengeluaran`),
  KEY `FOREIGN` (`no_biaya`),
  CONSTRAINT `no_biaya` FOREIGN KEY (`no_biaya`) REFERENCES `biaya` (`no_biaya`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengeluaran_kk` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengguna` */

insert  into `pengguna`(`username`,`password`) values ('admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
