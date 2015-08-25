-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: toko_ponsel_wahyu
-- ------------------------------------------------------
-- Server version	5.6.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `kabupaten`
--

DROP TABLE IF EXISTS `kabupaten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kabupaten` (
  `kode_kabupaten` varchar(20) NOT NULL,
  `kode_propinsi_on_kabupaten` varchar(20) NOT NULL,
  `nama_kabupaten` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_kabupaten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kabupaten`
--

LOCK TABLES `kabupaten` WRITE;
/*!40000 ALTER TABLE `kabupaten` DISABLE KEYS */;
INSERT INTO `kabupaten` VALUES ('1434895349','1434894277','BANJARNEGARA');
/*!40000 ALTER TABLE `kabupaten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kecamatan`
--

DROP TABLE IF EXISTS `kecamatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kecamatan` (
  `kode_kecamatan` varchar(20) NOT NULL,
  `kode_kabupaten_on_kecamatan` varchar(20) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  `biaya_pengiriman` double NOT NULL,
  PRIMARY KEY (`kode_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kecamatan`
--

LOCK TABLES `kecamatan` WRITE;
/*!40000 ALTER TABLE `kecamatan` DISABLE KEYS */;
INSERT INTO `kecamatan` VALUES ('1434896565','1434895349','PUNGGELAN',40000),('1434896726','1434895349','WANADADI',30000);
/*!40000 ALTER TABLE `kecamatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konfirmasi_transaksi`
--

DROP TABLE IF EXISTS `konfirmasi_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konfirmasi_transaksi` (
  `kode_konfirmasi` varchar(20) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `tanggal_konfirmasi` datetime NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `lokasi_gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_konfirmasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konfirmasi_transaksi`
--

LOCK TABLES `konfirmasi_transaksi` WRITE;
/*!40000 ALTER TABLE `konfirmasi_transaksi` DISABLE KEYS */;
INSERT INTO `konfirmasi_transaksi` VALUES ('1436497801','1436497751','2015-07-10 10:10:01','1436497801-1436497751-techcorner.jpg','../../gambar_konfirmasi/1436497801-1436497751-techcorner.jpg'),('1438009981','1438007166','2015-07-27 22:13:01','1438009981-1438007166-IMG_20150618_132421.jpg','../../gambar_konfirmasi/1438009981-1438007166-IMG_20150618_132421.jpg');
/*!40000 ALTER TABLE `konfirmasi_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_petugas`
--

DROP TABLE IF EXISTS `log_petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_petugas` (
  `id` varchar(20) NOT NULL,
  `kode_petugas` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_petugas`
--

LOCK TABLES `log_petugas` WRITE;
/*!40000 ALTER TABLE `log_petugas` DISABLE KEYS */;
INSERT INTO `log_petugas` VALUES ('1431000668','1426570372','LOGIN','2015-05-07 19:11:08'),('1432955305','1426570372','LOGIN','2015-05-30 10:08:25'),('1434070794','1426570372','LOGIN','2015-06-12 07:59:54'),('1434384884','1426570372','LOGIN','2015-06-15 23:14:44'),('1434384930','1426570372','LOGOUT','2015-06-15 23:15:30'),('1434388464','1426570372','LOGIN','2015-06-16 00:14:24'),('1434506073','1426570372','LOGIN','2015-06-17 08:54:33'),('1434888078','1426570372','LOGIN','2015-06-21 19:01:18'),('1434897665','1426570372','LOGOUT','2015-06-21 21:41:05'),('1435243316','1426570372','LOGIN','2015-06-25 21:41:56'),('1435338880','1426570372','LOGIN','2015-06-27 00:14:40'),('1435666003','1426570372','LOGIN','2015-06-30 19:06:43'),('1436417763','1426570372','LOGIN','2015-07-09 11:56:03'),('1436497207','1426570372','LOGIN','2015-07-10 10:00:07'),('1436509436','1426570372','LOGIN','2015-07-10 13:23:56'),('1436627334','1426570372','LOGIN','2015-07-11 22:08:54'),('1436627780','1426570372','LOGIN','2015-07-11 22:16:20'),('1436627899','1426570372','LOGIN','2015-07-11 22:18:19'),('1436692753','1426570372','LOGIN','2015-07-12 16:19:13'),('1436694806','1426570372','LOGIN','2015-07-12 16:53:26'),('1436863091','1426570372','LOGIN','2015-07-14 15:38:11'),('1436863113','1426570372','LOGIN','2015-07-14 15:38:33'),('1436863117','1426570372','LOGOUT','2015-07-14 15:38:37'),('1436863139','1426570372','LOGOUT','2015-07-14 15:38:59'),('1438007019','1426570372','LOGIN','2015-07-27 21:23:39'),('1438007560','1426570372','LOGIN','2015-07-27 21:32:40'),('1438012358','1426570372','LOGOUT','2015-07-27 22:52:38');
/*!40000 ALTER TABLE `log_petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `kode_member` varchar(20) NOT NULL,
  `nama_member` varchar(50) NOT NULL,
  `nama_tujuan_pengiriman` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `kode_kecamatan` varchar(50) NOT NULL,
  `kode_kecamatan_pengiriman` varchar(20) NOT NULL,
  `tanggal_bergabung` datetime NOT NULL,
  PRIMARY KEY (`kode_member`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES ('1435243448','Teguh','','PRIA','bagol','12345','088888','jl mawar','jl pisang no 5','1434896565','1434896565','2015-06-25 21:44:08'),('1436863194','Danang','','PRIA','danang','12345','08888','jl pisang','-','1434896565','-','2015-07-14 15:39:54'),('1438006914','wono','Catur','PRIA','wono','12345','08182882','Petuguran','Tanjungtirta','1434896565','1434896565','2015-07-27 21:21:54');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pabrikan_ponsel`
--

DROP TABLE IF EXISTS `pabrikan_ponsel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pabrikan_ponsel` (
  `kode_pabrikan` varchar(10) NOT NULL,
  `nama_pabrikan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`kode_pabrikan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pabrikan_ponsel`
--

LOCK TABLES `pabrikan_ponsel` WRITE;
/*!40000 ALTER TABLE `pabrikan_ponsel` DISABLE KEYS */;
INSERT INTO `pabrikan_ponsel` VALUES ('1426566554','ADVAN','xxx'),('1426566595','EVERCOSS','xxx'),('1426566615','NOKIA','xxx'),('1426566627','SAMSUNG','xxx');
/*!40000 ALTER TABLE `pabrikan_ponsel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panduan_belanja`
--

DROP TABLE IF EXISTS `panduan_belanja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panduan_belanja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panduan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panduan_belanja`
--

LOCK TABLES `panduan_belanja` WRITE;
/*!40000 ALTER TABLE `panduan_belanja` DISABLE KEYS */;
INSERT INTO `panduan_belanja` VALUES (1,'Pilih menu produk'),(2,'Klik tanda PLUS pada daftar belanja'),(3,'Masukan jumlah item yang akan anda beli, klik tambah.'),(5,'Setelah proses diatas, anda akan diarahkan ke keranjang belanja anda.'),(6,'Anda bisa memilih lebih dari satu produk. Apabila anda ingin menambah item belanja anda, ulangi proses sebelumnya'),(7,'Jika proses belanja anda sudah selesai, pilih selesaikan belanja.'),(8,'Kemudian sistem akan mengecek, apakah anda sudah login apa belum, jika belum anda akan diberikan perintah login atau registrasi(jika belum registrasi).'),(9,'Catat kode transaksi. Kode itu akan digunakan untuk konfirmasi transaksi, setelah anda melakukan pembayaran.');
/*!40000 ALTER TABLE `panduan_belanja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas`
--

DROP TABLE IF EXISTS `petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas` (
  `kode_petugas` varchar(20) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kode_petugas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas`
--

LOCK TABLES `petugas` WRITE;
/*!40000 ALTER TABLE `petugas` DISABLE KEYS */;
INSERT INTO `petugas` VALUES ('1426570372','WAHYU','PRIA','BUMIAYU','12345','087673773671','jln. Gatot Subroto no 5 Brebes.');
/*!40000 ALTER TABLE `petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produk` (
  `kode_produk` varchar(20) NOT NULL,
  `kode_pabrikan_produk` varchar(10) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(5) NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_jual` double NOT NULL,
  `spesifikasi` text NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `lokasi_gambar` varchar(255) NOT NULL,
  `berat_barang` double NOT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produk`
--

LOCK TABLES `produk` WRITE;
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` VALUES ('1426663588','1426566554','ADVAN A501',1,400000,450000,'Android : Jelly bean\r\nLayar : 5\"\r\nRam : 1 GB','1426663588-1426566554-advan 1.jpg','gambar_hp/1426566554/1426663588-1426566554-advan 1.jpg',1),('1426663628','1426566554','ADVAN A502',1,1500000,1800000,'Android : Kitkat','1426663628-1426566554-adavan 2.jpg','gambar_hp/1426566554/1426663628-1426566554-adavan 2.jpg',1),('1426727372','1426566627','SAMSUNG GALAXY V',3,1000000,1300000,'Android : Kitkat','1426727372-1426566627-samsung galaxy v.jpg','gambar_hp/1426566627/1426727372-1426566627-samsung galaxy v.jpg',1),('1426727966','1426566615','Nokia Lumia 810',3,2000000,2400000,'Windows Phone','1426727966-1426566615-Lumia-810-p2.jpg','gambar_hp/1426566615/1426727966-1426566615-Lumia-810-p2.jpg',1),('1426728069','1426566615','Nokia E6',3,1600000,2000000,'xxx','1426728069-1426566615-E6-p1.jpg','gambar_hp/1426566615/1426728069-1426566615-E6-p1.jpg',1),('1426728118','1426566595','Evercoss A7N 2',2,2000000,2500000,'xxx','1426728118-1426566595-Evercoss-A7N-2.jpg','gambar_hp/1426566595/1426728118-1426566595-Evercoss-A7N-2.jpg',1),('1436509486','1426566615','Nok',5,1000000,1400000,'xxx','1436509593-1426566615-11401223_841586885890491_2666940903438957926_n.jpg','gambar_hp/1426566615/1436509593-1426566615-11401223_841586885890491_2666940903438957926_n.jpg',2);
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propinsi`
--

DROP TABLE IF EXISTS `propinsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propinsi` (
  `kode_propinsi` varchar(20) NOT NULL,
  `nama_propinsi` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_propinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propinsi`
--

LOCK TABLES `propinsi` WRITE;
/*!40000 ALTER TABLE `propinsi` DISABLE KEYS */;
INSERT INTO `propinsi` VALUES ('1434894277','JAWA TENGAH'),('1434894673','JAWA TIMUR'),('1434894735','JAWA BARAT');
/*!40000 ALTER TABLE `propinsi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_pembeli_on_transaksi` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `diskon` double NOT NULL,
  `biaya_pengiriman` double NOT NULL,
  `total_akhir` double NOT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` VALUES ('1436497751','1435243448','2015-07-10','2015-07-10 10:09:11',0,30000,480751),('1436628994','1435243448','2015-07-11','2015-07-11 22:36:34',65000,30000,1265994),('1436629073','1435243448','2015-07-11','2015-07-11 22:37:53',100000,30000,1930073),('1436629107','1435243448','2015-07-11','2015-07-11 22:38:27',125000,30000,2405107),('1436692304','1435243448','2015-07-12','2015-07-12 16:11:44',90000,40000,1750304),('1436692438','1435243448','2015-07-12','2015-07-12 16:13:59',125000,40000,2415438),('1436863248','1436863194','2015-07-14','2015-07-14 15:40:48',0,40000,2440248),('1436863267','1435243448','2015-07-14','2015-07-14 15:41:07',90000,40000,1750267),('1438007166','1438006914','2015-07-27','2015-07-27 21:26:06',0,40000,2440166),('1438174388','1438006914','2015-07-29','2015-07-29 19:53:08',65000,40000,1275388),('1438174675','1438006914','2015-07-29','2015-07-29 19:57:55',0,40000,490675),('1438175194','1438006914','2015-07-29','2015-07-29 20:06:35',100000,40000,1940194),('1438176850','1438006914','2015-07-29','2015-07-29 20:34:11',125000,40000,2415850);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi_detail` (
  `kode_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_produk_transaksi` varchar(20) NOT NULL,
  `jumlah_beli` int(3) NOT NULL,
  `sub_total` double NOT NULL,
  PRIMARY KEY (`kode_transaksi_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_detail`
--

LOCK TABLES `transaksi_detail` WRITE;
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` VALUES (1,'1436497751','1426663588',1,450000),(2,'1436628994','1426727372',1,1300000),(3,'1436629073','1426728069',1,2000000),(4,'1436629107','1426728118',1,2500000),(5,'1436692304','1426663628',1,1800000),(6,'1436692438','1426728118',1,2500000),(7,'1436863248','1426727966',1,2400000),(8,'1436863267','1426663628',1,1800000),(9,'1438007166','1426727966',1,2400000),(10,'1438174388','1426727372',1,1300000),(11,'1438174675','1426663588',1,450000),(12,'1438175194','1426728069',1,2000000),(13,'1438176850','1426728118',1,2500000);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-25  9:59:33
