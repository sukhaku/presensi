-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2014 at 11:42 
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` int(4) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(5) NOT NULL,
  `datang` time NOT NULL,
  `pulang` time NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(10) NOT NULL,
  `keterangan` enum('01','02','03','04') NOT NULL,
  `alasan` varchar(300) NOT NULL,
  PRIMARY KEY (`id_absensi`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_pegawai_2` (`id_pegawai`),
  KEY `id_pegawai_3` (`id_pegawai`),
  KEY `keterangan` (`keterangan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_pegawai`, `datang`, `pulang`, `tanggal`, `bulan`, `tahun`, `keterangan`, `alasan`) VALUES
(70, 27, '07:50:09', '21:18:47', '2014-01-20', 1, 2014, '01', 'ketidau'),
(72, 30, '08:00:02', '15:07:37', '2014-01-20', 1, 2014, '04', '-'),
(74, 26, '08:00:00', '17:00:53', '2014-01-21', 1, 2014, '01', ''),
(75, 27, '09:04:49', '17:00:57', '2014-01-21', 1, 2014, '02', 'Macet'),
(79, 29, '08:00:00', '17:00:00', '2014-01-21', 1, 2014, '04', '-'),
(80, 29, '08:00:00', '17:00:00', '2014-01-20', 1, 2014, '01', '\r\n      		'),
(81, 26, '08:00:01', '17:00:00', '2014-01-20', 1, 2014, '04', 'Ada acara penting'),
(84, 26, '08:00:01', '00:00:00', '2014-01-23', 1, 2014, '01', 'ada acara kampus'),
(88, 45, '14:18:53', '00:00:00', '2014-01-23', 1, 2014, '04', 'jshdj'),
(94, 26, '09:39:47', '00:00:00', '2014-01-24', 1, 2014, '04', 'Telat bangun'),
(96, 27, '10:10:15', '00:00:00', '2014-01-24', 1, 2014, '02', 'Kesiangan'),
(97, 28, '08:00:00', '17:00:00', '2014-01-20', 1, 2014, '01', '\r\n      		'),
(99, 28, '08:08:00', '17:00:00', '2014-01-21', 1, 2014, '04', '      		hghgh'),
(100, 28, '08:00:00', '17:00:00', '2014-01-23', 1, 2014, '03', 'magh\r\n      		'),
(101, 37, '13:33:46', '00:00:00', '2014-01-24', 1, 2014, '04', 'lupa'),
(102, 44, '13:33:54', '00:00:00', '2014-01-24', 1, 2014, '04', 'lupa'),
(103, 28, '08:00:00', '17:00:00', '2014-01-24', 1, 2014, '03', 'mual\r\n      		'),
(104, 29, '08:00:00', '17:00:00', '2014-01-24', 1, 2014, '02', '\r\n      		'),
(105, 45, '14:49:41', '00:00:00', '2014-01-24', 1, 2014, '04', 'malu'),
(106, 26, '08:39:22', '17:31:45', '2014-01-25', 1, 2014, '04', '\r\n'),
(107, 26, '03:16:35', '00:00:00', '2014-02-10', 2, 2014, '01', '-'),
(108, 26, '08:00:00', '00:00:00', '2014-02-11', 2, 2014, '01', 'sakit');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(2) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'rizal', '402a186ee2ae1ee010ae64866f1fd946', 0);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` int(2) NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(10, 'Infokes'),
(11, 'Enterprise');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE IF NOT EXISTS `keterangan` (
  `id_keterangan` char(2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_keterangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_keterangan`, `keterangan`) VALUES
('01', 'Hadir'),
('02', 'Izin'),
('03', 'Sakit'),
('04', 'Terlambat');

-- --------------------------------------------------------

--
-- Table structure for table `keterlambatan`
--

CREATE TABLE IF NOT EXISTS `keterlambatan` (
  `id_terlambat` int(11) NOT NULL AUTO_INCREMENT,
  `id_absensi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu_terlambat` int(11) NOT NULL,
  PRIMARY KEY (`id_terlambat`),
  KEY `id_absensi` (`id_absensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `id_divisi` int(2) NOT NULL,
  `id_status_pegawai` int(2) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_hp` int(20) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id_pegawai`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_divisi` (`id_divisi`),
  KEY `id_status_pegawai` (`id_status_pegawai`),
  KEY `id_pegawai_2` (`id_pegawai`),
  KEY `id_divisi_2` (`id_divisi`),
  KEY `id_status_pegawai_2` (`id_status_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `id_divisi`, `id_status_pegawai`, `nama`, `password`, `jk`, `alamat`, `no_hp`, `status`) VALUES
(26, 'sukhaku', 10, 9, 'Muhammad Rizal Efendi', '150fb021c56c33f82eef99253eb36ee1', 'L', '	  			  			  			  			  			  			  			  			  			  			  			 Klaten\r\n	  			  			  			  			  			  			  			  			  			  			  			  			  			  		', 2147483647, 1),
(27, 'fika', 10, 9, 'Riza Rafika', '14e1b600b1fd579f47433b88e8d85291', 'P', '	  			  			  			  			  			  		Cilacap	  			  			  			  			  			  			  			  		', 89898, 1),
(28, 'adit', 11, 9, 'Aditya Alif Wicaksono', '486b6c6b267bc61677367eb6b6458764', 'L', '	  			  			  			  			  			  			  			  			  		Madiun\r\n	  			  			  			  			  			  			  			  			  			  		', 98, 1),
(29, 'arsi', 11, 9, 'Arsi Jayanti', '644e8074e7b4c5a04d29ec83495fe8ed', 'P', '	  			  			  			  			  			  			  			  		Bekasi\r\n	  			  			  			  			  			  			  			  			  		', 878, 1),
(30, 'cecep', 10, 9, 'Cecep', '0bd1772b1f26b34d46a3fcaac56fbf6c', 'L', '	  			  		Bandung	  			  		', 0, 1),
(33, 'ari', 10, 10, 'Ari', 'fc292bd7df071858c2d0f955545673c1', 'L', 'Klaten		', 909, 1),
(36, 'jono', 10, 10, 'Jono', '42867493d4d4874f331d288df0044baa', 'L', 'Bandung  		\r\n	  			  		', 989, 1),
(37, 'agung', 10, 10, 'agung', 'e59cd3ce33a68f536c19fedb82a7936f', 'L', 'Bandung', 90, 1),
(38, 'ayie', 11, 10, 'Ayie', '35c7bc4d7e797950e0b7e0335bcf11c4', 'P', 'Bandung\r\n	  		', 909, 1),
(39, 'fahri', 11, 11, 'fahri', '0d3133e7ed48278b30af611b4a8cd833', 'L', 'Bandung\r\n	  		', 90, 1),
(40, 'ndang', 11, 10, 'ndang', 'a7e50b4ac8a488f04d569f02797e107d', 'L', '\r\n	  		', 0, 1),
(41, 'sisca', 11, 10, 'sisca', '31982d2c3a0827e353d0e6e7f6a32891', 'P', 'Bandung		', 9, 1),
(42, 'viktor', 11, 10, 'viktor', '4e3c1f58d4ace2057d5e18f4a5a478fb', 'L', 'B\r\n	  		', 0, 1),
(43, 'zilky', 11, 10, 'zilky', 'fc3a8552eba8be58f0dc81cbf5c1a2af', 'L', 'Bandung\r\n	  		', 0, 1),
(44, 'alfin', 10, 11, 'alfin', '6ff92dee2a93081f0192781f156fa0e9', 'L', 'Bandung\r\n	  		', 0, 1),
(45, 'ari', 10, 11, 'ari', 'fc292bd7df071858c2d0f955545673c1', 'L', '  		', 0, 1),
(48, 'kjk', 10, 9, 'ask', '34689cac9b0bce31a9fdea4b28e0bd3f', '', '	  		\r\n	  			  		', 3456, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_pengaturan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `jam_masuk`, `jam_pulang`, `status`) VALUES
(6, '08:00:00', '17:00:00', 0),
(11, '08:00:00', '12:00:00', 0),
(12, '09:00:00', '10:00:00', 0),
(13, '12:00:00', '13:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status_absensi`
--

CREATE TABLE IF NOT EXISTS `status_absensi` (
  `id_status_absensi` int(10) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(10) NOT NULL,
  PRIMARY KEY (`id_status_absensi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `status_absensi`
--

INSERT INTO `status_absensi` (`id_status_absensi`, `keterangan`, `tanggal`, `bulan`, `tahun`) VALUES
(47, 'aktif', '2014-01-20', 1, 2014),
(48, 'aktif', '2014-01-21', 1, 2014),
(51, 'aktif', '2014-01-23', 1, 2014),
(52, 'aktif', '2014-01-24', 1, 2014),
(53, 'aktif', '2014-01-25', 1, 2014),
(54, 'aktif', '2014-02-01', 2, 2014),
(55, 'aktif', '2014-02-09', 2, 2014),
(56, 'aktif', '2014-02-10', 2, 2014),
(57, 'aktif', '2014-02-11', 2, 2014);

-- --------------------------------------------------------

--
-- Table structure for table `status_pegawai`
--

CREATE TABLE IF NOT EXISTS `status_pegawai` (
  `id_status_pegawai` int(2) NOT NULL AUTO_INCREMENT,
  `status_pegawai` varchar(20) NOT NULL,
  PRIMARY KEY (`id_status_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `status_pegawai`
--

INSERT INTO `status_pegawai` (`id_status_pegawai`, `status_pegawai`) VALUES
(9, 'Magang'),
(10, 'Tetap'),
(11, 'Baru');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keterlambatan`
--
ALTER TABLE `keterlambatan`
  ADD CONSTRAINT `keterlambatan_ibfk_1` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_status_pegawai`) REFERENCES `status_pegawai` (`id_status_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
