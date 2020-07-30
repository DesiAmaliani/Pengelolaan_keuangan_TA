-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 02:44 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `alamat`, `no_hp`, `foto`, `email`) VALUES
(7, 'Desi Amaliani', 'Desi.amaliani@gmail.com', '12345', 'indramayu', '089782763', 'bg_2.png', 'desi.amaliani@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `alat_dibts`
--

CREATE TABLE `alat_dibts` (
  `id_alat` int(11) NOT NULL,
  `id_bts` int(11) NOT NULL,
  `nama_alat` varchar(50) NOT NULL,
  `ip_alat` varchar(20) NOT NULL,
  `ssid` varchar(20) NOT NULL,
  `frequensi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `jatuh_tempo` varchar(2) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status_client` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nama_lengkap`, `username`, `password`, `no_hp`, `alamat`, `tgl_bergabung`, `latitude`, `longitude`, `jatuh_tempo`, `id_paket`, `foto`, `status_client`) VALUES
(3, 'Qurrota Aini', 'qurrota_aini', '12345', '0897827634', 'Pabean Udik', '2020-07-17', '-6.3084540', '108.3378210', '9', 4, 'default.jpg', 1),
(4, 'Mila Haryani', 'mila_haryani', '12345', '0897827635', 'pabean udik', '2020-07-25', '-6.3084540', '108.3378210', '11', 4, 'default.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_bts`
--

CREATE TABLE `data_bts` (
  `id_bts` int(11) NOT NULL,
  `nama_bts` varchar(50) NOT NULL,
  `alamat_bts` text NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `info_ip_client`
--

CREATE TABLE `info_ip_client` (
  `id_infoip` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `user_pppoe` varchar(50) NOT NULL,
  `pass_ppoe` varchar(50) NOT NULL,
  `ip_radio` varchar(20) NOT NULL,
  `nama_radio` varchar(50) NOT NULL,
  `ip_router` varchar(20) NOT NULL,
  `user_paas_router` varchar(50) NOT NULL,
  `merk_router` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info_ip_client`
--

INSERT INTO `info_ip_client` (`id_infoip`, `id_client`, `user_pppoe`, `pass_ppoe`, `ip_radio`, `nama_radio`, `ip_router`, `user_paas_router`, `merk_router`) VALUES
(1, 3, 'asa', 'asas', '12134', 'asa', '12', 'asas', 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_paket`
--

CREATE TABLE `jenis_paket` (
  `id_jp` int(11) NOT NULL,
  `nama_jp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_paket`
--

INSERT INTO `jenis_paket` (`id_jp`, `nama_jp`) VALUES
(1, 'Paket Standard'),
(2, 'Paket Premium'),
(3, 'Paket Gold');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `nama_lengkap`, `username`, `password`, `no_hp`, `alamat`, `foto`) VALUES
(1, 'rina nopiyana', 'rina_nopiyana', '12345', '089782763', 'karangmalang, indramayu', '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `id_jp` int(11) NOT NULL,
  `bandwith` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `kap_peng` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_jp`, `bandwith`, `harga`, `kap_peng`) VALUES
(1, 1, '1 Mbps', 100000, 'Max 2 Devices'),
(2, 1, '2 Mbps', 150000, 'Max 4 Devices'),
(3, 1, '3 Mbps', 200000, 'Max 6 Devices'),
(4, 1, '5 Mbps', 250000, 'Max 10 Devices'),
(5, 1, '10 Mbps', 350000, 'Max 15 Devices'),
(6, 2, '15 Mbps', 450000, 'Max 20 Devices'),
(7, 2, '20 Mbps', 550000, 'Max 25 Devices'),
(8, 2, '25 Mbps', 650000, 'Max 30 Devices'),
(9, 2, '30 Mbps', 700000, 'Max 35 Devices'),
(10, 3, '40 Mbps', 750000, 'Max 40 Devices'),
(11, 3, '50 Mbps', 800000, 'Max 50 Devices');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pem` int(11) NOT NULL,
  `tgl_pem` date NOT NULL,
  `id_client` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bukti_pem` varchar(255) DEFAULT NULL,
  `id_paket` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `jatuh_temp` date NOT NULL,
  `status` int(2) NOT NULL,
  `status_notif` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pem`, `tgl_pem`, `id_client`, `total_bayar`, `bukti_pem`, `id_paket`, `bulan`, `jatuh_temp`, `status`, `status_notif`) VALUES
(1, '2020-07-25', 3, 250000, 'image-272.jpg', 4, 'Jul/2020', '2020-08-09', 2, 0),
(2, '2020-07-25', 4, 250000, 'image-271.jpg', 4, 'Jul/2020', '2020-08-11', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_peng` int(11) NOT NULL,
  `tgl_peng` date NOT NULL,
  `bukti_peng` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `ket` text NOT NULL,
  `total_peng` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_peng`, `tgl_peng`, `bukti_peng`, `ket`, `total_peng`) VALUES
(4, '2020-07-25', 'image-27.jpg', 'Beli Access Point', 250000),
(5, '2020-07-28', 'image-27.jpg', 'Kabel', 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alat_dibts`
--
ALTER TABLE `alat_dibts`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_bts` (`id_bts`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `data_bts`
--
ALTER TABLE `data_bts`
  ADD PRIMARY KEY (`id_bts`);

--
-- Indexes for table `info_ip_client`
--
ALTER TABLE `info_ip_client`
  ADD PRIMARY KEY (`id_infoip`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `jenis_paket`
--
ALTER TABLE `jenis_paket`
  ADD PRIMARY KEY (`id_jp`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_jp` (`id_jp`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pem`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_peng`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `alat_dibts`
--
ALTER TABLE `alat_dibts`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `data_bts`
--
ALTER TABLE `data_bts`
  MODIFY `id_bts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_ip_client`
--
ALTER TABLE `info_ip_client`
  MODIFY `id_infoip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_paket`
--
ALTER TABLE `jenis_paket`
  MODIFY `id_jp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_peng` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat_dibts`
--
ALTER TABLE `alat_dibts`
  ADD CONSTRAINT `alat_dibts_ibfk_1` FOREIGN KEY (`id_bts`) REFERENCES `data_bts` (`id_bts`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
