-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2021 at 08:28 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `npm` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `jurusan` text NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`npm`, `nama`, `gambar`, `jurusan`, `alamat`, `telepon`) VALUES
('040221.001', 'Fahmi Alucard', '601bfe7f3dd27.jpg', 'Matematika', 'kp lewisadeng kec lewisadeng kab bogor ', '085712654834'),
('131120.001', 'Helmi Tazkia ', '5fd85c18c58a2.jpg', 'Sistem Informasi', 'kp lewisadeng Desa Lewisadeng Kec Lewisadeng Kab Bogor', '084567616114'),
('141220.001', 'Amelia Safiri', '5fd85ca4b39f4.jpg', 'Teknik Elektronik', 'KP Sawah Baru Desa Lewisadeng Kab Bogor', '08123547343'),
('141220.003', 'Farhhan Adima Lutfi', '5fd85e6a9e7a2.jpg', 'Manajemen', 'kp Gabret Desa cemplang kec cibungbulang kab bogor', '085712512343'),
('141220.004', 'Analisa apriliani', '5fd7134451f04.jpg', 'Sistem informasi', 'kp cianten desa sarenten kec lewisadeng kab bogor', '08456761611'),
('141220.005', 'Asep kamaludin', '5fd85e7939d24.jpg', 'Matematika', 'KP Sawah Baru Desa Lewisadeng Kab Bogor', '085623232224'),
('151220.001', 'Hani Maharani', '5fd85c3816fab.jpg', 'Teknik Informatika', 'kp lewisadeng Desa Lewisadeng Kec Lewisadeng Kab Bogor', '08456761611'),
('191220.001', 'Samsum arifin', '5fddc9be3b7a3.jpg', 'Teknik Informatika', 'kp lewisadeng Desa Lewisadeng Kec Lewisadeng Kab Bogor', '08456761611');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_user`
--

CREATE TABLE `tabel_user` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` decimal(1,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_user`
--

INSERT INTO `tabel_user` (`id`, `username`, `password`, `status`) VALUES
(16, 'Ahmad', '$2y$10$JAkt1ESI97txEaBlLql2AebIiOZdPFEQnTEuiScHYJj15kclMzf.G', '1'),
(17, 'Annisa ', '$2y$10$K9zPoeR5iIdpWstNOe08KegRKHDB75GesL0TE/xWZs.9/wKyRhh7W', '1'),
(18, 'Arsyad ', '$2y$10$UAnrig011ztK./iiR9VMm.KWHG7SyLcdxGVWNFztOzGyg1qAiXaZK', '1'),
(19, 'milah', '$2y$10$8YILpi10gM42QH4UKqvqe.TC1hK8S.D/e42GvwKY.LxTY0zREvu6q', '0'),
(20, 'helmi', '$2y$10$jF7Z6w68tsHzAAdXeVhTa.rRrcHTmYS3BS4wmwPGBK3q5bnQsOQ8O', '1'),
(21, 'fahri rivaldi', '$2y$10$73jJzeChshaqPZCwafIpdOOKDLY1gv.CrEEpE8mlloRTvrsIyzZPC', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `tabel_user`
--
ALTER TABLE `tabel_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_user`
--
ALTER TABLE `tabel_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
