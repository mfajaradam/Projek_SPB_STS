-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2024 at 05:36 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_peminjaman_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_brg` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_brg`, `kategori`, `merk`, `jumlah`) VALUES
(9, 'CR7', 'bola', 'alat olahraga', 'Speed', 10),
(10, 'HJJ889', 'kursi', 'alat belajar', 'pebercastel', 10),
(11, 'DFG2339', 'VGA', 'elektronik', 'MI', 10),
(12, 'UIAK889', 'charger', 'elektronik', 'MI', 10),
(16, 'POAK7781', 'Laptop', 'Elektronik', 'MacbookAir', 10),
(27, 'KJKA9902', 'hp', 'Elektronik', 'MI', 10),
(28, 'HJA8892', 'keyboard', 'Elektronik', 'logitech', 10),
(29, 'UIA2893', 'mic', 'Elektronik', 'altec', 10),
(30, 'KKL09934', 'bola voli', 'Alat olahraga', 'Mikasa', 10),
(31, 'AKLL99028', 'Bola basket', 'Alat olahraga', 'Monce', 5),
(32, 'JAD989', 'Raket', 'Alat olahraga', 'Yonex', 10);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` varchar(20) DEFAULT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_login` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tgl_pinjam`, `tgl_kembali`, `no_identitas`, `kode_barang`, `jumlah`, `keperluan`, `status`, `id_login`) VALUES
(53, '2024-03-11 00:00:00', '', '11182778839', 'AKLL99028', 5, 'untuk kegiatan olahraga', 'Belum', 1);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `ambil_barang` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE barang SET jumlah = jumlah - NEW.jumlah WHERE
    kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stock` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
UPDATE barang SET jumlah = jumlah + OLD.jumlah WHERE
kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `no_identitas`, `nama`, `status`, `username`, `password`, `role`) VALUES
(1, '11111999999', 'fajar', 'petugas', 'mfajaradam', '3b712de48137572f3849aabd5666a4e3', 'admin'),
(2, '10191817', 'adit', 'murid', 'adit', 'f78e7640867c254a05e095e9f8873a8d', 'member'),
(5, '11182778839', 'Rehan N', 'murid', 'rehan', 'b1cf98ac9c77517b71b00f3ff9ea9aa4', 'member'),
(6, '2662777132', 'Rizky F', 'murid', 'rizky', '49d8712dd6ac9c3745d53cd4be48284c', 'member'),
(7, '22289918829', 'bayu', 'murid', 'uyab', 'cae4bccf8054a66f927382ea39e3bdfc', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
