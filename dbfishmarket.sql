-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 08:34 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfishmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `IdBarang` varchar(5) NOT NULL,
  `NamaBarang` varchar(30) NOT NULL,
  `Harga` int(10) NOT NULL,
  `Stok` int(5) NOT NULL,
  `Keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IdBarang`, `NamaBarang`, `Harga`, `Stok`, `Keterangan`) VALUES
('NRD01', 'Pelet NRD 2/3', 25000, 60, 'Pelet NRD ukuran 2-3 isi 500 gram'),
('PK001', 'Plakat Blue Rim', 15000, 75, 'Plakat Blue Rim male dan female usia 4 bulan'),
('PK002', 'Plakat Nemo Galaxy', 10000, 30, 'Plakat Nemo Galaxy male dan female usia 3 bulan');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `IdPembeli` varchar(5) NOT NULL,
  `NamaPembeli` varchar(50) NOT NULL,
  `NoTelp` varchar(15) NOT NULL,
  `AlamatPembeli` varchar(200) NOT NULL,
  `NoRek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`IdPembeli`, `NamaPembeli`, `NoTelp`, `AlamatPembeli`, `NoRek`) VALUES
('AN001', 'Anne', '089827452631', 'Jalan D1', '412'),
('BR001', 'Barry', '081927364878', 'Jalan B1', '555'),
('CA002', 'Curey', '089877656765', 'Jalan C2', '789'),
('DA001', 'Dancy', '098972728383', 'Jalan D1', '912'),
('EA001', 'Earl', '081908980058888', 'Jalan 1E', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `IdTransaksi` varchar(9) NOT NULL,
  `IdPembeli` varchar(5) NOT NULL,
  `IdBarang` varchar(5) NOT NULL,
  `Tanggal` date NOT NULL,
  `JumlahBarang` int(3) NOT NULL,
  `TotalBayar` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`IdTransaksi`, `IdPembeli`, `IdBarang`, `Tanggal`, `JumlahBarang`, `TotalBayar`) VALUES
('040621001', 'AN001', 'PK001', '2021-04-06', 8, NULL),
('050621001', 'CA002', 'PK002', '2021-06-05', 8, NULL),
('060621001', 'BR001', 'PK001', '2021-06-06', 4, NULL),
('080621001', 'DA001', 'NRD01', '2021-06-08', 3, NULL),
('100621001', 'BR001', 'PK002', '2021-06-10', 6, NULL),
('140621001', 'AN001', 'NRD01', '2021-06-14', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `IdUser` varchar(5) NOT NULL,
  `NamaUser` varchar(50) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IdUser`, `NamaUser`, `Password`) VALUES
('1412', 'Daiva', '14121412'),
('guest', 'Guest', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IdBarang`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`IdPembeli`),
  ADD KEY `NoRek` (`NoRek`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`IdTransaksi`),
  ADD KEY `IdBarang` (`IdBarang`),
  ADD KEY `IdPembeli` (`IdPembeli`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdUser`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`IdBarang`) REFERENCES `barang` (`IdBarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`IdPembeli`) REFERENCES `pembeli` (`IdPembeli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
