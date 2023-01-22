-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 04:23 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siak`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nim`, `nama`, `alamat`, `gender`, `phone`, `email`) VALUES
('D0001', 'Dr. ROY RUDOLF HUIZEN, S.T., M.T.', '', NULL, '', ''),
('D0002', 'FLORENTINA TATRIN KURNIATI, S.T., M.T.', '', NULL, '', ''),
('D0003', 'PANDE PUTU GEDE PUTRA PERTAMA, S.T., M.T', '', NULL, '', ''),
('D0004', 'I GEDE SUARDIKA, S.Kom., M.Kom', '', NULL, '', ''),
('D0005', 'PUTU WIDIADNYANA,S.Pd.,M.T	', '', NULL, '', ''),
('D0006', 'I GUSTI NGURAH ADY KUSUMA, S.Kom., M.Kom', '', 1, '', ''),
('D0007', 'I GEDE PUTRA MAS YUSADARA, S.Kom., M.Kom', '', NULL, '', ''),
('D0008', 'NI KADEK SUKERTI, S.Si., M.Cs.', 'Nusa penida', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `kode_jadwal` int(11) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `ruang` varchar(100) NOT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `waktu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`kode_jadwal`, `kode_kelas`, `kode_mk`, `ruang`, `hari`, `waktu`) VALUES
(33, 'BA211', 'MK001', 'LAB ONLINE 1', 'Senin', '08.00 - 11.20'),
(34, 'BA211', 'MK002', 'RUANG ONLINE 26', 'Rabu', '08.00 - 09.40'),
(35, 'BA211', 'MK003', 'RUANG ONLINE 27', 'Rabu', '09.40 - 11.20'),
(36, 'BA211', 'MK004', 'LAB Business Intellegence (Hybrid)', 'Kamis', '08.00 - 11.20'),
(37, 'BA211', 'MK005', 'RUANG ONLINE 26', 'Jumat', '08.00 - 09.40'),
(38, 'BA211', 'MK006', 'RUANG ONLINE 26', 'Jumat', '09.40 - 11.20'),
(39, 'BA211', 'MK007', 'RUANG ONLINE 20', 'Sabtu', '08.00 - 09.40'),
(40, 'BA211', 'MK008', 'RUANG ONLINE 20', 'Sabtu', '09.40 - 11.20'),
(41, 'CA213', 'MK001', 'LAB ONLINE 1', 'Senin', '18.00 - 21.20'),
(42, 'CA213', 'MK002', 'RUANG ONLINE 26	', 'Selasa', '18.00 - 19.40'),
(43, 'CA213', 'MK003', 'RUANG ONLINE 27', 'Selasa', '19.40 - 21.20'),
(44, 'CA213', 'MK004', 'LAB Business Intellegence (Hybrid)', 'Rabu', '18.00 - 21.20'),
(45, 'CA213', 'MK005', 'RUANG ONLINE 26', 'Kamis', '18.00 - 19.40'),
(46, 'CA213', 'MK006', 'RUANG ONLINE 26', 'Kamis', '19.40 - 21.20'),
(47, 'CA213', 'MK007', 'RUANG ONLINE 20', 'Sabtu', '18.00 - 19.40'),
(48, 'CA213', 'MK008', 'RUANG ONLINE 20', 'Sabtu', '19.40 - 21.20');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` varchar(10) NOT NULL,
  `kapasitas` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `kapasitas`) VALUES
('BA211', '40 Orang'),
('CA213', '40 Orang');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ayah` varchar(150) NOT NULL,
  `ibu` varchar(150) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `kode_kelas`, `tempat_lahir`, `tanggal_lahir`, `gender`, `phone`, `email`, `ayah`, `ibu`, `prodi`, `alamat`) VALUES
('180030527', 'FADJRY AL FATTAH', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('180030607', 'KARINA GITA KRISNANDA', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('180031189', 'JOSE CORNELLIUS', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('190030352', 'MICHAEL WILLIAM PRATAMA WENAS', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('190030866', 'BRIGITHA CRISTI CHARLOTA', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('210010021', 'PUTU ANGGA PUTRA RONDAN', 'BA211', 'denpasar', '2023-01-03', 1, '', '', '', '', '', ''),
('210010027', 'I MADE BUDIARTA MULIANA', 'BA211', 'tabanan', '2003-07-07', 1, '081111222333', 'komang@gmail.com', 'pak budi', 'bu budi', 'Manajemen Informatika', 'jalan menuju surga'),
('210010054', 'I GEDE ADI PUTRA', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210010062', 'I GEDE KRISNA ADI WIRANATA', 'BA211', 'Tabanan', '2002-12-04', 1, '', '', '', '', 'SK', ''),
('210010103', 'I MADE INDRA SURYA JAYADI', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('210010150', 'ALBERT FERNANDO', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210030089', 'I KOMANG NGURAH KUSUMA KRESNA PREBAWA', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210030163', 'DIMAS TRI ARYA', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210030414', 'NI NYOMAN YUSPITA DEWI', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210030541', 'HEDRA ALFAYET', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('210030546', 'I PUTU AGUS BAYU BIMANTARA', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210040031', 'I GEDE NARA SANDU GUNAWAN', 'BA211', '', '', NULL, '', '', '', '', '', ''),
('210040161', 'HAFIDZ BAHTIAR', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210050129', 'I PUTU AGUS WIRATAMA', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210050135', 'NI LUH EKA ERIA WATI', 'CA213', '', '', NULL, '', '', '', '', '', ''),
('210050175', 'SOPHIA SOLAFIDE SARAGIH', 'CA213', '', '', NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `nim` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`, `nim`) VALUES
('MK001', 'Sensor dan Transduser', 4, 'D0001'),
('MK002', 'Sistem Digital', 2, 'D0002'),
('MK003', 'Sistem Operasi', 2, 'D0003'),
('MK004', 'Back-end Web Development', 4, 'D0004'),
('MK005', 'Organisasi dan Arsitektur Komputer', 2, 'D0005'),
('MK006', 'Komunikasi Data', 2, 'D0006'),
('MK007', 'User Experience', 2, 'D0007'),
('MK008', 'Rekayasa Perangkat Lunak', 4, 'D0008');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `kode_nilai` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `uas` int(11) NOT NULL,
  `uts` int(11) NOT NULL,
  `tugas` int(11) NOT NULL,
  `kuis` int(11) NOT NULL,
  `rata_rata` int(11) NOT NULL,
  `nilai_akhir` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`kode_nilai`, `nim`, `kode_mk`, `uas`, `uts`, `tugas`, `kuis`, `rata_rata`, `nilai_akhir`) VALUES
(10, '210010103', 'MK001', 90, 70, 100, 80, 85, 'B'),
(11, '210010103', 'MK002', 90, 100, 100, 70, 90, 'A'),
(12, '210010103', 'MK003', 78, 89, 100, 88, 89, 'A'),
(13, '210010103', 'MK004', 90, 88, 90, 50, 80, 'C'),
(14, '210010021', 'MK001', 100, 80, 70, 100, 88, 'B'),
(15, '210010021', 'MK002', 90, 70, 88, 85, 83, 'B'),
(16, '210010021', 'MK003', 100, 100, 100, 100, 100, 'A'),
(18, '210010062', 'MK001', 98, 88, 80, 100, 92, 'A'),
(19, '210010062', 'MK002', 100, 77, 66, 98, 85, 'B'),
(20, '210010062', 'MK003', 68, 88, 100, 90, 87, 'B'),
(21, '210010062', 'MK004', 80, 100, 97, 88, 91, 'A'),
(22, '210030414', 'MK001', 80, 80, 90, 80, 83, 'B'),
(23, '210030414', 'MK002', 88, 90, 50, 80, 77, 'C'),
(24, '210030414', 'MK003', 100, 80, 90, 70, 85, 'B'),
(25, '210030414', 'MK004', 80, 78, 60, 98, 79, 'C'),
(26, '210050135', 'MK001', 90, 70, 55, 80, 74, 'C'),
(27, '210050135', 'MK002', 100, 50, 98, 80, 82, 'B'),
(28, '210050135', 'MK003', 100, 70, 89, 77, 84, 'B'),
(29, '210050135', 'MK004', 50, 70, 100, 100, 80, 'B'),
(30, '210010021', 'MK004', 100, 80, 50, 100, 83, 'B'),
(33, '180031189', 'MK001', 99, 88, 100, 90, 94, 'A'),
(34, '210010027', 'MK001', 100, 90, 88, 98, 94, 'A'),
(35, '210010027', 'MK002', 78, 88, 90, 88, 86, 'B'),
(36, '210010027', 'MK003', 90, 78, 77, 70, 79, 'C'),
(37, '210010027', 'MK003', 90, 99, 98, 100, 97, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `level` enum('Administrator','Mahasiswa','Dosen') CHARACTER SET utf8mb4 NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `nim` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `level`, `nama`, `nim`) VALUES
('180030527', '180030527', 'Mahasiswa', 'FADJRY AL FATTAH', '180030527'),
('180030607', '180030607', 'Mahasiswa', 'KARINA GITA KRISNANDA', '180030607'),
('180031189', '180031189', 'Mahasiswa', 'JOSE CORNELLIUS', '180031189'),
('190030352', '190030352', 'Mahasiswa', 'MICHAEL WILLIAM PRATAMA WENAS', '190030352'),
('190030866', '190030866', 'Mahasiswa', 'BRIGITHA CRISTI CHARLOTA', '190030866'),
('210010027', '210010027', 'Mahasiswa', 'I MADE BUDIARTA MULIANA', '210010027'),
('210010054', '210010054', 'Mahasiswa', 'I GEDE ADI PUTRA', '210010054'),
('210010150', '210010150', 'Mahasiswa', 'ALBERT FERNANDO', '210010150'),
('210030089', '210030089', 'Mahasiswa', 'I KOMANG NGURAH KUSUMA KRESNA PREBAWA', '210030089'),
('210030163', '210030163', 'Mahasiswa', 'DIMAS TRI ARYA', '210030163'),
('210030414', '210030414', 'Mahasiswa', 'NI NYOMAN YUSPITA DEWI', '210030414'),
('210030541', '210030541', 'Mahasiswa', 'HEDRA ALFAYET', '210030541'),
('210030546', '210030546', 'Mahasiswa', 'I PUTU AGUS BAYU BIMANTARA', '210030546'),
('210040031', '210040031', 'Mahasiswa', 'I GEDE NARA SANDU GUNAWAN', '210040031'),
('210040161', '210040161', 'Mahasiswa', 'HAFIDZ BAHTIAR', '210040161'),
('210050129', '210050129', 'Mahasiswa', 'I PUTU AGUS WIRATAMA', '210050129'),
('210050135', '210050135', 'Mahasiswa', 'NI LUH EKA ERIA WATI', '210050135'),
('210050175', '210050175', 'Mahasiswa', 'SOPHIA SOLAFIDE SARAGIH', '210050175'),
('admin', 'admin', 'Administrator', 'Komang Adi Wirya Dana', ''),
('ady', 'ady', 'Dosen', 'I GUSTI NGURAH ADY KUSUMA, S.Kom., M.Kom', 'D0006'),
('angga', 'angga', 'Mahasiswa', 'PUTU ANGGA PUTRA RONDAN', '210010021'),
('demas', 'demas', 'Dosen', 'I GEDE PUTRA MAS YUSADARA, S.Kom., M.Kom', 'D0007'),
('flo', 'flo', 'Dosen', 'FLORENTINA TATRIN KURNIATI, S.T., M.T.', 'D0002'),
('indra', 'indra', 'Mahasiswa', 'I MADE INDRA SURYA JAYADI', '210010103'),
('krisna', 'krisna', 'Mahasiswa', 'I GEDE KRISNA ADI WIRANATA', '210010062'),
('pande', 'pande', 'Dosen', 'PANDE PUTU GEDE PUTRA PERTAMA, S.T., M.T', 'D0003'),
('roy', 'roy', 'Dosen', 'Dr. ROY RUDOLF HUIZEN, S.T., M.T.', 'D0001'),
('samuh', 'samuh', 'Dosen', 'NI KADEK SUKERTI, S.Si., M.Cs.', 'D0008'),
('sdk', 'sdk', 'Dosen', 'I GEDE SUARDIKA, S.Kom., M.Kom', 'D0004'),
('wiyad', 'wiyad', 'Dosen', 'PUTU WIDIADNYANA,S.Pd.,M.T	', 'D0005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`kode_jadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`kode_nilai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `kode_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `kode_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
