-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hukumsiap`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `nosuratkeluar` varchar(100) NOT NULL,
  `tglsuratkeluar` date NOT NULL,
  `tglsekarangkeluar` date NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `perihalkeluar` varchar(1000) NOT NULL,
  `orangkeluar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `nosuratkeluar`, `tglsuratkeluar`, `tglsekarangkeluar`, `tujuan`, `perihalkeluar`, `orangkeluar`) VALUES
(2, '032/376/BPKAD/2024', '2024-08-25', '2024-08-26', 'PENDOPO', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. FUSCE ANTE.', 'TIKA');

-- --------------------------------------------------------

--
-- Table structure for table `keputusan`
--

CREATE TABLE `keputusan` (
  `idkep` int(11) NOT NULL,
  `judulkep` varchar(1000) NOT NULL,
  `nomorkep` int(10) NOT NULL,
  `kodenaskahkep` varchar(11) NOT NULL,
  `opd` varchar(20) NOT NULL,
  `tglpenetapankep` varchar(11) NOT NULL,
  `filekep` varchar(1000) NOT NULL,
  `filebarukep` varchar(1000) NOT NULL,
  `statuskep` varchar(20) NOT NULL,
  `diinputolehkep` varchar(20) NOT NULL,
  `ketkep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keputusan`
--

INSERT INTO `keputusan` (`idkep`, `judulkep`, `nomorkep`, `kodenaskahkep`, `opd`, `tglpenetapankep`, `filekep`, `filebarukep`, `statuskep`, `diinputolehkep`, `ketkep`) VALUES
(3, 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA.', 3, '141.1', 'DPMD', '2024-08-14', 'Upload Berita - JDIH.pdf', 'struktur-organisasi (1)_1589650424.pdf', 'DIGANTI', 'ANDREA', 'DIGANTI OLEH'),
(4, 'LOREM IPSU DOLORE MAGNA ALIQUA.', 1, '141.1', 'DPMD', '2024-08-17', 'PEMBINAAN DAN PENGAWASAN PENCEGAHAN TINDAK PIDANA KORUPSI DI DESA.pdf', 'SURAT UNDANGAN RAPAT 2 AGUSTUS 2024.pdf', 'BERLAKU', 'MASTUR', 'LOREM');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `peran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `email`, `password`, `peran`) VALUES
(1, 'Andrea', 'lab@siaphukum.com', 'siApHuKuM@Andr3a#', 'Admin'),
(2, 'Mastur', 'mastur@siaphukum.com', 'MasT!uR#siApHuKuM', 'User'),
(5, 'Farhan', 'lalu.farhan@siaphukum.com', 'Farh@n!siApHuKuM9', 'User'),
(6, 'Ihat', 'ihat@siaphukum.com', 'Ih@t5iApHuKuM!X', 'User'),
(7, 'Evinka', 'kadek.evinka@siaphukum.com', 'Ev!nk@siApHuKuM#3', 'User'),
(8, 'Novie', 'novie.suzanna@siaphukum.com', 'Nov!e$iApHuKum@', 'User'),
(9, 'Surya', 'eka.suryaputra@siaphukum.com', '$urya@siAphUKuM6', 'User'),
(10, 'Tia', 'tia.martiani@siaphukum.com', 'T!a$iAphuKum@9X', 'User'),
(11, 'Ajeng', 'rahajeng.dwi@siaphukum.com', '@jeng#siApHuKum@4', 'User'),
(12, 'Widia', 'widiatul.arafah@siaphukum.com', 'Wid!a@siAphuKum#5', 'User'),
(13, 'Fava', 'fava.fauziah@siaphukum.com', 'Fava#siAphuKum@4', 'Admin'),
(14, 'Nurlaila', 'nurlaila@siaphukum.com', '@Nurlaila.siAphUk8M', 'User'),
(15, 'Syuhada', 'syuhada@siaphukum.com', 'Syu#had@siApHuKum!', 'User'),
(16, 'Mumu', 'mumu.muhdi@siaphukum.com', 'MuMu#siApHuKuM@7$', 'User'),
(17, 'Rahma', 'rahmawati@siaphukum.com', 'R@hmA!siAphuKum*5', 'User'),
(18, 'Ghitha', 'ghitha.febriyanti@siaphukum.com', 'Ghi7th@siApHuKuM!', 'User'),
(19, 'Irvan', 'irvan@siaphukum.com', '!rF@n9siAphUKuM', 'User'),
(20, 'Ika', 'ika@siaphukum.com', 'Ik@2siApHuKuM!4z', 'User'),
(21, 'Tika', 'kartika@siaphukum.com', 'T!ka$iApHuKum@3X', 'Admin'),
(22, 'Fajrin', 'meilan.fajrin@siaphukum.com', 'F@jr!n$iAphuKuM', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `nosuratmasuk` varchar(100) NOT NULL,
  `tglsuratmasuk` date NOT NULL,
  `tglsekarang` date NOT NULL,
  `asal` varchar(100) NOT NULL,
  `perihalmasuk` varchar(1000) NOT NULL,
  `orangmasuk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `nosuratmasuk`, `tglsuratmasuk`, `tglsekarang`, `asal`, `perihalmasuk`, `orangmasuk`) VALUES
(6, '032/201/BPKAD/2024', '2024-08-24', '2024-08-26', 'KJACS', 'JCNOSJ CPJPAA SMLCKAS MCMS CAJKNASO', 'JCNAO'),
(7, '032/200/BPKAD/2024', '2024-08-23', '2024-08-26', 'QJQKNDXI', 'QXK XQJKXNO XWKJDNXW XJWNDXOWNA XJWNOECNXWEL CXWJNXW', 'JSBXI');

-- --------------------------------------------------------

--
-- Table structure for table `perbup`
--

CREATE TABLE `perbup` (
  `idperbup` int(11) NOT NULL,
  `judulperbup` varchar(1000) NOT NULL,
  `nomorperbup` varchar(50) NOT NULL,
  `tglevaluasiperbup` date NOT NULL,
  `tglpenetapanperbup` date NOT NULL,
  `tglpengundanganperbup` date NOT NULL,
  `statusperbup` varchar(20) NOT NULL,
  `nobd` int(11) NOT NULL,
  `nobdt` int(11) NOT NULL,
  `ketperbup` varchar(100) NOT NULL,
  `fileperbup` varchar(1000) NOT NULL,
  `filebaruperbup` varchar(1000) NOT NULL,
  `diinputolehperbup` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perbup`
--

INSERT INTO `perbup` (`idperbup`, `judulperbup`, `nomorperbup`, `tglevaluasiperbup`, `tglpenetapanperbup`, `tglpengundanganperbup`, `statusperbup`, `nobd`, `nobdt`, `ketperbup`, `fileperbup`, `filebaruperbup`, `diinputolehperbup`) VALUES
(5, 'LOREM IPSUM LAMCORPER A ARCU.', 'NOMOR 10 TAHUN 2024', '2024-08-17', '2024-08-17', '2024-08-17', 'BERLAKU', 10, 10, 'LOREM', 'Upload Berita - JDIH.pdf', 'PEMBINAAN DAN PENGAWASAN PENCEGAHAN TINDAK PIDANA KORUPSI DI DESA.pdf', 'MASTUR');

-- --------------------------------------------------------

--
-- Table structure for table `perda`
--

CREATE TABLE `perda` (
  `idperda` int(11) NOT NULL,
  `judulperda` varchar(1000) NOT NULL,
  `nomorperda` varchar(100) NOT NULL,
  `tglevaluasiperda` date NOT NULL,
  `tglpenetapanperda` date NOT NULL,
  `tglpengundanganperda` date NOT NULL,
  `nold` int(11) NOT NULL,
  `noldt` int(11) NOT NULL,
  `seriperda` varchar(10) NOT NULL,
  `statusperda` varchar(20) NOT NULL,
  `ketperda` varchar(1000) NOT NULL,
  `fileperda` varchar(1000) NOT NULL,
  `filebaruperda` varchar(1000) NOT NULL,
  `diinputolehperda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perda`
--

INSERT INTO `perda` (`idperda`, `judulperda`, `nomorperda`, `tglevaluasiperda`, `tglpenetapanperda`, `tglpengundanganperda`, `nold`, `noldt`, `seriperda`, `statusperda`, `ketperda`, `fileperda`, `filebaruperda`, `diinputolehperda`) VALUES
(4, 'LOREM IPSUM DOLOR SIT AMET', 'NOMOR 1 TAHUN 2024', '2024-09-02', '2024-09-02', '2024-08-17', 1, 1, 'A', 'BERLAKU', 'LOREM XIX', 'struktur-organisasi (1)_1589650424.pdf', 'SURAT UNDANGAN RAPAT 2 AGUSTUS 2024.pdf', 'MASTUR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`idkep`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `perbup`
--
ALTER TABLE `perbup`
  ADD PRIMARY KEY (`idperbup`);

--
-- Indexes for table `perda`
--
ALTER TABLE `perda`
  ADD PRIMARY KEY (`idperda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keputusan`
--
ALTER TABLE `keputusan`
  MODIFY `idkep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perbup`
--
ALTER TABLE `perbup`
  MODIFY `idperbup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perda`
--
ALTER TABLE `perda`
  MODIFY `idperda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
