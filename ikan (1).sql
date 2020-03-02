-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 04:54 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_detail_pemesanan`
--

CREATE TABLE `data_detail_pemesanan` (
  `id_dp` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jml_produk` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_detail_pemesanan`
--

INSERT INTO `data_detail_pemesanan` (`id_dp`, `harga`, `jml_produk`, `sub_total`, `id_pemesanan`, `id_produk`) VALUES
(59, 8600, 32, 275200, 42, 16),
(64, 8800, 1, 8800, 48, 6),
(65, 8600, 9, 77400, 49, 16),
(68, 23000, 1, 23000, 52, 18),
(69, 29000, 1, 29000, 53, 19),
(70, 8800, 4, 35200, 54, 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_jam_pengiriman`
--

CREATE TABLE `data_jam_pengiriman` (
  `id_jampengiriman` int(11) NOT NULL,
  `jam_pengiriman` time NOT NULL,
  `id_usaha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kelompok_tani`
--

CREATE TABLE `data_kelompok_tani` (
  `id_kelompoktani` int(11) NOT NULL,
  `nama_kelompoktani` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kelompok_tani`
--

INSERT INTO `data_kelompok_tani` (`id_kelompoktani`, `nama_kelompoktani`) VALUES
(1, 'Mina Jaya'),
(2, 'Mina Maju'),
(3, 'Dadi Mulyo'),
(4, 'Ngudi Makmur'),
(5, 'Nggrowong');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelompok_tani_usaha`
--

CREATE TABLE `data_kelompok_tani_usaha` (
  `id_keltaniusaha` int(11) NOT NULL,
  `id_kelompoktani` int(11) NOT NULL,
  `id_usaha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kelompok_tani_usaha`
--

INSERT INTO `data_kelompok_tani_usaha` (`id_keltaniusaha`, `id_kelompoktani`, `id_usaha`) VALUES
(4, 3, 2),
(5, 4, 2),
(9, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_kendaraan`
--

CREATE TABLE `data_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(10) NOT NULL,
  `plat_kendaraan` varchar(10) NOT NULL,
  `kapasitas_kendaraan` int(11) NOT NULL,
  `id_usaha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kendaraan`
--

INSERT INTO `data_kendaraan` (`id_kendaraan`, `jenis_kendaraan`, `plat_kendaraan`, `kapasitas_kendaraan`, `id_usaha`) VALUES
(1, 'Mobil', '12345', 100, 1),
(6, '2', '2', 2, 1),
(8, '4', '4', 4, 2),
(12, 'Motor', 'AADC', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_kurir`
--

CREATE TABLE `data_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(30) NOT NULL,
  `foto_kurir` text NOT NULL,
  `jk_kurir` enum('Laki-laki','Perempuan') NOT NULL,
  `telp_kurir` varchar(13) NOT NULL,
  `id_usaha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kurir`
--

INSERT INTO `data_kurir` (`id_kurir`, `nama_kurir`, `foto_kurir`, `jk_kurir`, `telp_kurir`, `id_usaha`) VALUES
(29, 'Aku', '', 'Laki-laki', '085209090909', 1),
(30, 'Anu', '', 'Perempuan', '085238383838', 2);

-- --------------------------------------------------------

--
-- Table structure for table `data_master_bank`
--

CREATE TABLE `data_master_bank` (
  `kode_bank` int(11) NOT NULL,
  `nama_bank` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_master_bank`
--

INSERT INTO `data_master_bank` (`kode_bank`, `nama_bank`) VALUES
(1, 'Bank Republik Indonesia (BRI)'),
(2, 'Bank Central Asia (BCA)'),
(3, 'Bank Mandiri'),
(4, 'Bank Negara Indonesia (BNI)'),
(5, 'Bank Pembangunan Daerah (BPD) ');

-- --------------------------------------------------------

--
-- Table structure for table `data_pembayaran`
--

CREATE TABLE `data_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `metode_pembayaran` enum('Full Cash','Full Transfer','Transfer Cash') NOT NULL,
  `expiredDate` datetime NOT NULL,
  `waktu_pembayaran` datetime DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `no_rekening_pb` int(11) DEFAULT NULL,
  `nama_rekening_pb` varchar(50) DEFAULT NULL,
  `struk_pembayaran` varchar(100) DEFAULT NULL,
  `status_pembayaran` enum('DP','Lunas') DEFAULT NULL,
  `id_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pembayaran`
--

INSERT INTO `data_pembayaran` (`id_pembayaran`, `metode_pembayaran`, `expiredDate`, `waktu_pembayaran`, `id_bank`, `no_rekening_pb`, `nama_rekening_pb`, `struk_pembayaran`, `status_pembayaran`, `id_pemesanan`) VALUES
(32, 'Full Transfer', '2020-02-22 19:24:46', '2020-02-28 01:58:30', 2, 123123123, 'Danang Arif Rahmanda', '28022020015830WhatsApp Image 2020-02-25 at 12.26.54.jpeg', 'Lunas', 42),
(37, 'Full Cash', '2020-02-28 23:57:55', NULL, NULL, NULL, NULL, NULL, NULL, 48),
(38, 'Full Transfer', '2020-02-29 00:28:47', NULL, NULL, NULL, NULL, NULL, NULL, 49),
(41, 'Full Transfer', '2020-02-29 00:35:34', NULL, NULL, NULL, NULL, NULL, NULL, 52),
(42, 'Full Transfer', '2020-02-29 00:36:41', NULL, NULL, NULL, NULL, NULL, NULL, 53),
(43, 'Transfer Cash', '2020-02-29 00:37:49', NULL, NULL, NULL, NULL, NULL, NULL, 54);

-- --------------------------------------------------------

--
-- Table structure for table `data_pembeli`
--

CREATE TABLE `data_pembeli` (
  `id_pb` int(11) NOT NULL,
  `nama_pb` varchar(30) NOT NULL,
  `foto_pb` text NOT NULL,
  `jk_pb` enum('Laki-laki','Perempuan') NOT NULL,
  `tgllahir_pb` date NOT NULL,
  `telp_pb` varchar(13) NOT NULL,
  `alamat_pb` text NOT NULL,
  `kab_pb` varchar(20) NOT NULL,
  `kec_pb` varchar(20) NOT NULL,
  `kel_pb` varchar(20) NOT NULL,
  `longitude_pb` double NOT NULL,
  `latitude_pb` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pembeli`
--

INSERT INTO `data_pembeli` (`id_pb`, `nama_pb`, `foto_pb`, `jk_pb`, `tgllahir_pb`, `telp_pb`, `alamat_pb`, `kab_pb`, `kec_pb`, `kel_pb`, `longitude_pb`, `latitude_pb`) VALUES
(1, 'Danang', '', 'Laki-laki', '2019-04-17', 'HAHAHA', 'HAHAHA', 'HA', 'HA', 'HA', 0, 0),
(8, 'Lo', '18072019174612Screenshot_2019-07-18-22-25-29-594_com.iseld.png', 'Perempuan', '2019-07-27', '08526164', 'Lo', 'Lo', 'Lo', 'Lo', 0, 0),
(13, 'sad', '18072019175817IMG_20181119_110549_780.jpg', 'Perempuan', '2019-07-17', '12345678910', 'swx', 'sad', 'sad', 'sad', 0, 0),
(14, 'ndolllll', '', '', '0000-00-00', '0812340759128', 'Jl. rw Bahagia Raya 14', 'Jakarta Barat', 'Grogol', 'Petamburan', 110.14025939999999, -7.150975),
(15, '', '', '', '0000-00-00', '', '', '', '', '', -7.765993040246785, 110.35743000274658),
(16, '', '', '', '0000-00-00', '', '', '', '', '', -7.765993040246785, 110.35743000274658),
(17, '', '', '', '0000-00-00', '', '', '', '', '', -7.765993040246785, 110.35743000274658),
(18, '', '', '', '0000-00-00', '', '', '', '', '', -7.765993040246785, 110.35743000274658),
(19, 'Suto Wijoyo Kusumo', '09092019221746foto.jpg', 'Laki-laki', '1995-05-09', '0813079128', 'JL. Madrim 15', 'Sleman', ' Kalasan', 'Purwomartani', -7.765993040246785, 110.35743000274658);

-- --------------------------------------------------------

--
-- Table structure for table `data_pemesanan`
--

CREATE TABLE `data_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `waktu_pemesanan` datetime NOT NULL,
  `tipe_pengiriman` enum('Biasa','Cepat','Ambil di Toko') NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `biaya_kirim` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_pemesanan` enum('Baru','Terbayar','Terkirim') NOT NULL,
  `id_pb` int(11) NOT NULL,
  `id_usaha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pemesanan`
--

INSERT INTO `data_pemesanan` (`id_pemesanan`, `waktu_pemesanan`, `tipe_pengiriman`, `tgl_pengiriman`, `biaya_kirim`, `total_harga`, `status_pemesanan`, `id_pb`, `id_usaha`) VALUES
(41, '2020-02-22 15:19:02', 'Biasa', '2020-02-24', 870800, 908800, 'Baru', 14, 1),
(42, '2020-02-22 18:24:46', 'Biasa', '2020-02-28', 870800, 1146000, 'Terbayar', 14, 1),
(43, '2020-02-28 16:30:10', 'Biasa', '2020-03-02', 870800, 1602300, 'Baru', 14, 1),
(44, '2020-02-28 16:33:43', 'Biasa', '2020-03-03', 870800, 1310800, 'Baru', 14, 1),
(45, '2020-02-28 16:39:20', 'Biasa', '0000-00-00', 870800, 1558800, 'Baru', 14, 1),
(46, '2020-02-28 22:42:46', 'Biasa', '2020-03-02', 870800, 1060800, 'Baru', 14, 1),
(47, '0000-00-00 00:00:00', 'Ambil di Toko', '2020-02-29', 1000, 1000, 'Baru', 14, 1),
(48, '2020-02-28 22:57:55', 'Ambil di Toko', '2020-03-03', 870800, 879600, 'Baru', 14, 1),
(49, '2020-02-28 23:28:47', 'Ambil di Toko', '2020-03-02', 870800, 948200, 'Baru', 14, 1),
(50, '2020-02-28 23:31:24', 'Cepat', '2020-03-02', 870800, 900800, 'Baru', 14, 1),
(51, '2020-02-28 23:33:14', 'Cepat', '2020-02-29', 870800, 948200, 'Baru', 14, 1),
(52, '2020-02-28 23:35:34', 'Cepat', '2020-02-29', 870800, 893800, 'Baru', 14, 1),
(53, '2020-02-28 23:36:41', 'Cepat', '2020-02-29', 870800, 899800, 'Baru', 14, 1),
(54, '2020-02-28 23:37:49', 'Cepat', '2020-03-02', 870800, 906000, 'Baru', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pengguna`
--

CREATE TABLE `data_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `level_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pengguna`
--

INSERT INTO `data_pengguna` (`id_pengguna`, `username`, `password`, `id_akun`, `level_user`) VALUES
(1, 'isel', 'isel', 1, 'admin'),
(13, '', '', 10, 'pembeli'),
(18, '', '', 15, 'pembeli'),
(19, '', '', 16, 'pembeli'),
(32, 'lalusu', 'lalusu', 20, 'penjual'),
(33, 'ndol', 'aaaa', 14, 'pembeli'),
(40, 'dan', 'dan', 23, 'penjual'),
(41, 'advan', 'advan', 26, 'penjual'),
(42, 'suto', 'suto', 19, 'pembeli'),
(43, 'aaaaa', 'oooo', 27, 'penjual'),
(46, '', '', 28, 'penjual');

-- --------------------------------------------------------

--
-- Table structure for table `data_pengiriman`
--

CREATE TABLE `data_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `waktu_pengiriman` datetime NOT NULL,
  `urutan_pengiriman` int(11) NOT NULL,
  `status_pengiriman` enum('proses','selesai') NOT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_jam_pengiriman` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_penjual`
--

CREATE TABLE `data_penjual` (
  `id_pj` int(11) NOT NULL,
  `nama_pj` varchar(30) NOT NULL,
  `foto_pj` varchar(300) NOT NULL,
  `noktp_pj` varchar(16) NOT NULL,
  `fotoktp_pj` varchar(300) NOT NULL,
  `jk_pj` enum('Perempuan','Laki-laki') NOT NULL,
  `tgllahir_pj` date NOT NULL,
  `alamat_pj` text NOT NULL,
  `telp_pj` varchar(13) NOT NULL,
  `jenis_petani` enum('Tawar','Laut') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_penjual`
--

INSERT INTO `data_penjual` (`id_pj`, `nama_pj`, `foto_pj`, `noktp_pj`, `fotoktp_pj`, `jk_pj`, `tgllahir_pj`, `alamat_pj`, `telp_pj`, `jenis_petani`) VALUES
(19, 'Danang Arif Rahmanda', '09092019215142foto.jpg', '1234123412341212', 'ktpdanang.jpg', '', '1995-05-03', 'Madrim 15 T', '081230750129', ''),
(23, 'Dano', '28112019182441PhotoGrid_1567592418142.jpg', '000000000000000', '28112019182441chat_20190806_042139_.jpg', 'Perempuan', '1996-07-07', 'Terban okokok', '085261641500', 'Tawar'),
(26, 'Advan', 'advan.jpg', '3404070905950007', 'ktpadvan.jpg', 'Laki-laki', '2022-02-02', 'Jl. Urip Sumoharjo No.33', '081230759128', 'Tawar');

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id_produk` int(11) NOT NULL,
  `id_usaha` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `kategori` enum('tawar','laut') NOT NULL,
  `foto_produk` text NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `min_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id_produk`, `id_usaha`, `nama_produk`, `kategori`, `foto_produk`, `berat_produk`, `min_pemesanan`) VALUES
(18, 1, 'Nila 1', 'tawar', '05092019122331Nila.jpg', 1, 1),
(21, 1, 'Gurame 1', 'tawar', '05092019122001Gurame.jpg', 1, 1),
(27, 1, 'Lele 1', 'tawar', '05092019124128Lele.jpg', 1, 1),
(34, 1, 'Patin 1', 'tawar', '05092019124319Patin.jpg', 1, 1),
(35, 2, 'Nila 2', 'tawar', '', 1, 1),
(36, 5, 'Lele 5', 'tawar', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_rekening`
--

CREATE TABLE `data_rekening` (
  `id_rekening` int(11) NOT NULL,
  `kode_bank` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `no_rekening` varchar(16) NOT NULL,
  `nama_rekening` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_rekening`
--

INSERT INTO `data_rekening` (`id_rekening`, `kode_bank`, `id_akun`, `no_rekening`, `nama_rekening`) VALUES
(1, 1, 1, '12345678', 'Riselda'),
(6, 2, 20, '', ''),
(7, 2, 20, '098765432', 'Annisa'),
(8, 2, 1, '0123120234', 'Riselda Rahma');

-- --------------------------------------------------------

--
-- Table structure for table `data_track_kurir`
--

CREATE TABLE `data_track_kurir` (
  `id_track` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_usaha`
--

CREATE TABLE `data_usaha` (
  `id_usaha` int(11) NOT NULL,
  `nama_usaha` varchar(30) NOT NULL,
  `foto_usaha` text NOT NULL,
  `alamat_usaha` text NOT NULL,
  `jamBuka` time NOT NULL,
  `jamTutup` time NOT NULL,
  `jml_kapal` int(11) NOT NULL,
  `kapasitas_kapal` int(11) NOT NULL,
  `jml_kolam` int(11) NOT NULL,
  `kab` varchar(20) NOT NULL,
  `kec` varchar(20) NOT NULL,
  `kel` varchar(20) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `id_pj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_usaha`
--

INSERT INTO `data_usaha` (`id_usaha`, `nama_usaha`, `foto_usaha`, `alamat_usaha`, `jamBuka`, `jamTutup`, `jml_kapal`, `kapasitas_kapal`, `jml_kolam`, `kab`, `kec`, `kel`, `longitude`, `latitude`, `id_pj`) VALUES
(1, 'aye aye', '24072019183108me.jpg', 'Hatimu', '08:00:00', '17:00:00', 0, 0, 1, 'Yogyakarta', 'Gondokusuman', 'Terban', 110.3457892, -7.804006, 23),
(2, 'jendul', 'rumah.jpg', 'jalanin dulu aja', '08:00:00', '17:00:00', 2, 2, 0, 'A', 'B', 'C', 110.556979, -7.820309, 19),
(5, 'Advan Phone', '09092019215203IMG-20160731-WA0011.jpg', 'JL. Solo No 33', '08:00:00', '17:00:00', 0, 0, 0, 'Yogyakarta', 'Sleman', 'Ngaa', 110.3370774, -7.8082809, 26);

-- --------------------------------------------------------

--
-- Table structure for table `data_variasi`
--

CREATE TABLE `data_variasi` (
  `id_variasi` int(11) NOT NULL,
  `nama_variasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_variasi`
--

INSERT INTO `data_variasi` (`id_variasi`, `nama_variasi`) VALUES
(1, 'Mentah utuh'),
(2, 'Mentah potong'),
(3, 'Hidup');

-- --------------------------------------------------------

--
-- Table structure for table `data_variasi_produk`
--

CREATE TABLE `data_variasi_produk` (
  `id_variasiproduk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_variasi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_variasi_produk`
--

INSERT INTO `data_variasi_produk` (`id_variasiproduk`, `id_produk`, `id_variasi`, `harga`, `stok`) VALUES
(5, 18, 1, 9500, 100),
(6, 18, 2, 8800, 100),
(8, 34, 3, 30000, 100),
(12, 27, 1, 8000, 100),
(16, 27, 2, 8600, 100),
(17, 21, 2, 25000, 100),
(18, 21, 1, 23000, 100),
(19, 34, 1, 29000, 100),
(20, 35, 2, 8800, 100),
(21, 36, 1, 8600, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_detail_pemesanan`
--
ALTER TABLE `data_detail_pemesanan`
  ADD PRIMARY KEY (`id_dp`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `data_jam_pengiriman`
--
ALTER TABLE `data_jam_pengiriman`
  ADD PRIMARY KEY (`id_jampengiriman`),
  ADD KEY `id_toko` (`id_usaha`);

--
-- Indexes for table `data_kelompok_tani`
--
ALTER TABLE `data_kelompok_tani`
  ADD PRIMARY KEY (`id_kelompoktani`);

--
-- Indexes for table `data_kelompok_tani_usaha`
--
ALTER TABLE `data_kelompok_tani_usaha`
  ADD PRIMARY KEY (`id_keltaniusaha`),
  ADD KEY `id_kelompoktani` (`id_kelompoktani`),
  ADD KEY `id_toko` (`id_usaha`);

--
-- Indexes for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `id_toko` (`id_usaha`);

--
-- Indexes for table `data_kurir`
--
ALTER TABLE `data_kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD KEY `id_toko` (`id_usaha`);

--
-- Indexes for table `data_master_bank`
--
ALTER TABLE `data_master_bank`
  ADD PRIMARY KEY (`kode_bank`);

--
-- Indexes for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `data_pembeli`
--
ALTER TABLE `data_pembeli`
  ADD PRIMARY KEY (`id_pb`);

--
-- Indexes for table `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_toko` (`id_usaha`),
  ADD KEY `id_pb` (`id_pb`);

--
-- Indexes for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `id_akun` (`id_akun`);

--
-- Indexes for table `data_pengiriman`
--
ALTER TABLE `data_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_jam_pengiriman` (`id_jam_pengiriman`),
  ADD KEY `id_kurir` (`id_kurir`),
  ADD KEY `id_kendaraan` (`id_kendaraan`);

--
-- Indexes for table `data_penjual`
--
ALTER TABLE `data_penjual`
  ADD PRIMARY KEY (`id_pj`);

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_toko` (`id_usaha`);

--
-- Indexes for table `data_rekening`
--
ALTER TABLE `data_rekening`
  ADD PRIMARY KEY (`id_rekening`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `kode_bank` (`kode_bank`);

--
-- Indexes for table `data_track_kurir`
--
ALTER TABLE `data_track_kurir`
  ADD PRIMARY KEY (`id_track`),
  ADD KEY `id_kurir` (`id_kurir`);

--
-- Indexes for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD PRIMARY KEY (`id_usaha`),
  ADD KEY `id_pj` (`id_pj`);

--
-- Indexes for table `data_variasi`
--
ALTER TABLE `data_variasi`
  ADD PRIMARY KEY (`id_variasi`);

--
-- Indexes for table `data_variasi_produk`
--
ALTER TABLE `data_variasi_produk`
  ADD PRIMARY KEY (`id_variasiproduk`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_variasi` (`id_variasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_detail_pemesanan`
--
ALTER TABLE `data_detail_pemesanan`
  MODIFY `id_dp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `data_jam_pengiriman`
--
ALTER TABLE `data_jam_pengiriman`
  MODIFY `id_jampengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_kelompok_tani`
--
ALTER TABLE `data_kelompok_tani`
  MODIFY `id_kelompoktani` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_kelompok_tani_usaha`
--
ALTER TABLE `data_kelompok_tani_usaha`
  MODIFY `id_keltaniusaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_kurir`
--
ALTER TABLE `data_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `data_master_bank`
--
ALTER TABLE `data_master_bank`
  MODIFY `kode_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `data_pembeli`
--
ALTER TABLE `data_pembeli`
  MODIFY `id_pb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `data_pengiriman`
--
ALTER TABLE `data_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_penjual`
--
ALTER TABLE `data_penjual`
  MODIFY `id_pj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `data_rekening`
--
ALTER TABLE `data_rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_track_kurir`
--
ALTER TABLE `data_track_kurir`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_usaha`
--
ALTER TABLE `data_usaha`
  MODIFY `id_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_variasi`
--
ALTER TABLE `data_variasi`
  MODIFY `id_variasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_variasi_produk`
--
ALTER TABLE `data_variasi_produk`
  MODIFY `id_variasiproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_detail_pemesanan`
--
ALTER TABLE `data_detail_pemesanan`
  ADD CONSTRAINT `data_detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `data_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_detail_pemesanan_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `data_variasi_produk` (`id_variasiproduk`),
  ADD CONSTRAINT `data_detail_pemesanan_ibfk_4` FOREIGN KEY (`id_produk`) REFERENCES `data_variasi_produk` (`id_variasiproduk`);

--
-- Constraints for table `data_jam_pengiriman`
--
ALTER TABLE `data_jam_pengiriman`
  ADD CONSTRAINT `data_jam_pengiriman_ibfk_1` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kelompok_tani_usaha`
--
ALTER TABLE `data_kelompok_tani_usaha`
  ADD CONSTRAINT `data_kelompok_tani_usaha_ibfk_1` FOREIGN KEY (`id_kelompoktani`) REFERENCES `data_kelompok_tani` (`id_kelompoktani`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_kelompok_tani_usaha_ibfk_2` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kendaraan`
--
ALTER TABLE `data_kendaraan`
  ADD CONSTRAINT `data_kendaraan_ibfk_1` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_kurir`
--
ALTER TABLE `data_kurir`
  ADD CONSTRAINT `data_kurir_ibfk_1` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pembayaran`
--
ALTER TABLE `data_pembayaran`
  ADD CONSTRAINT `data_pembayaran_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `data_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pemesanan`
--
ALTER TABLE `data_pemesanan`
  ADD CONSTRAINT `data_pemesanan_ibfk_1` FOREIGN KEY (`id_pb`) REFERENCES `data_pembeli` (`id_pb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pemesanan_ibfk_2` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_pengiriman`
--
ALTER TABLE `data_pengiriman`
  ADD CONSTRAINT `data_pengiriman_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `data_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pengiriman_ibfk_2` FOREIGN KEY (`id_jam_pengiriman`) REFERENCES `data_jam_pengiriman` (`id_jampengiriman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pengiriman_ibfk_3` FOREIGN KEY (`id_kurir`) REFERENCES `data_kurir` (`id_kurir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_pengiriman_ibfk_4` FOREIGN KEY (`id_kendaraan`) REFERENCES `data_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD CONSTRAINT `data_produk_ibfk_2` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_rekening`
--
ALTER TABLE `data_rekening`
  ADD CONSTRAINT `data_rekening_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `data_pengguna` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_rekening_ibfk_3` FOREIGN KEY (`kode_bank`) REFERENCES `data_master_bank` (`kode_bank`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_track_kurir`
--
ALTER TABLE `data_track_kurir`
  ADD CONSTRAINT `data_track_kurir_ibfk_1` FOREIGN KEY (`id_kurir`) REFERENCES `data_kurir` (`id_kurir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD CONSTRAINT `data_usaha_ibfk_1` FOREIGN KEY (`id_pj`) REFERENCES `data_penjual` (`id_pj`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_variasi_produk`
--
ALTER TABLE `data_variasi_produk`
  ADD CONSTRAINT `data_variasi_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `data_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_variasi_produk_ibfk_2` FOREIGN KEY (`id_variasi`) REFERENCES `data_variasi` (`id_variasi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
