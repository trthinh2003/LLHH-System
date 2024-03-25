-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 06:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_lich_thuc_hanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `buoihoc`
--

CREATE TABLE `buoihoc` (
  `BUOIHOC_ID` int(11) NOT NULL,
  `TENBUOIHOC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `buoihoc`
--

INSERT INTO `buoihoc` (`BUOIHOC_ID`, `TENBUOIHOC`) VALUES
(1, 'Sáng'),
(2, 'Chiều');

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_yeucau`
--

CREATE TABLE `chitiet_yeucau` (
  `PHANMEM_ID` int(11) NOT NULL,
  `MAHOCPHAN` char(15) NOT NULL,
  `HK_NH` varchar(30) NOT NULL,
  `TENNHOM` int(11) NOT NULL,
  `MAGIANGVIEN` char(15) NOT NULL,
  `MAQTHT` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `MAGIANGVIEN` char(15) NOT NULL,
  `MAKHOA` varchar(15) NOT NULL,
  `HOTENGIANGVIEN` varchar(50) NOT NULL,
  `HOCVI` varchar(30) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SODIENTHOAI` varchar(15) NOT NULL,
  `TENDANGNHAP` varchar(30) DEFAULT NULL,
  `MATKHAU` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`MAGIANGVIEN`, `MAKHOA`, `HOTENGIANGVIEN`, `HOCVI`, `EMAIL`, `SODIENTHOAI`, `TENDANGNHAP`, `MATKHAU`) VALUES
('GV01', 'CNTT', 'Vũ Đức Minh', 'Thạc sĩ', 'vducminh@gmail.com', '0912567891', 'ducminh', 'ducminh123');

-- --------------------------------------------------------

--
-- Table structure for table `hocki_namhoc`
--

CREATE TABLE `hocki_namhoc` (
  `HK_NH` varchar(30) NOT NULL,
  `TENHK_NH` varchar(30) DEFAULT NULL,
  `NGAYBATDAU` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `MAHOCPHAN` char(15) NOT NULL,
  `TENHOCPHAN` varchar(40) NOT NULL,
  `SOTINCHI` int(11) DEFAULT NULL,
  `SOGIOTH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`MAHOCPHAN`, `TENHOCPHAN`, `SOTINCHI`, `SOGIOTH`) VALUES
('CT180', 'Cơ sở dữ liệu', 3, NULL),
('CT299', 'Phát triển hệ thống Web', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MAKHOA` varchar(15) NOT NULL,
  `TENKHOA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`MAKHOA`, `TENKHOA`) VALUES
('CNTT', 'Công nghệ thông tin'),
('HTTT', 'Hệ thống thông tin'),
('KHMT', 'Khoa học máy tính'),
('KTPM', 'Kỹ thuật phần mềm'),
('MMT', 'Mạng máy tính và TT dữ liệu');

-- --------------------------------------------------------

--
-- Table structure for table `lichthuchanh`
--

CREATE TABLE `lichthuchanh` (
  `MAPHONGHOC` char(15) NOT NULL,
  `BUOIHOC_ID` int(11) NOT NULL,
  `NGAYHOC` date NOT NULL,
  `MAHOCPHAN` char(15) NOT NULL,
  `HK_NH` varchar(30) NOT NULL,
  `TENNHOM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `MAHOCPHAN` char(15) NOT NULL,
  `HK_NH` varchar(30) NOT NULL,
  `TENNHOM` int(11) NOT NULL,
  `MAGIANGVIEN` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phanmem`
--

CREATE TABLE `phanmem` (
  `PHANMEM_ID` int(11) NOT NULL,
  `TENPHANMEM` varchar(30) DEFAULT NULL,
  `PHIENBAN` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phonghoc`
--

CREATE TABLE `phonghoc` (
  `MAPHONGHOC` char(15) NOT NULL,
  `SUCCHUA` int(11) NOT NULL,
  `LAUHOC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quantrihethong`
--

CREATE TABLE `quantrihethong` (
  `MAQTHT` char(15) NOT NULL,
  `TENQTHT` varchar(30) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SODIENTHOAI` varchar(15) NOT NULL,
  `TENDANGNHAP` varchar(30) DEFAULT NULL,
  `MATKHAU` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `quantrihethong`
--

INSERT INTO `quantrihethong` (`MAQTHT`, `TENQTHT`, `EMAIL`, `SODIENTHOAI`, `TENDANGNHAP`, `MATKHAU`) VALUES
('QT1', 'admin', 'admin@gmail.com', '0129765554', 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buoihoc`
--
ALTER TABLE `buoihoc`
  ADD PRIMARY KEY (`BUOIHOC_ID`);

--
-- Indexes for table `chitiet_yeucau`
--
ALTER TABLE `chitiet_yeucau`
  ADD PRIMARY KEY (`MAHOCPHAN`,`HK_NH`,`PHANMEM_ID`,`TENNHOM`,`MAGIANGVIEN`),
  ADD KEY `FK_CTYC_GV` (`MAGIANGVIEN`),
  ADD KEY `FK_CTYC_LOPHP` (`MAHOCPHAN`,`HK_NH`,`TENNHOM`),
  ADD KEY `FK_CTYC_PM` (`PHANMEM_ID`),
  ADD KEY `FK_CTYC_QTHT` (`MAQTHT`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`MAGIANGVIEN`),
  ADD KEY `FK_GV_KHOA` (`MAKHOA`);

--
-- Indexes for table `hocki_namhoc`
--
ALTER TABLE `hocki_namhoc`
  ADD PRIMARY KEY (`HK_NH`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`MAHOCPHAN`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MAKHOA`);

--
-- Indexes for table `lichthuchanh`
--
ALTER TABLE `lichthuchanh`
  ADD PRIMARY KEY (`MAPHONGHOC`,`BUOIHOC_ID`,`NGAYHOC`),
  ADD KEY `FK_LICHTH_BUOIHOC` (`BUOIHOC_ID`),
  ADD KEY `FK_LICHTH_LOPHP` (`MAHOCPHAN`,`HK_NH`,`TENNHOM`);

--
-- Indexes for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`MAHOCPHAN`,`HK_NH`,`TENNHOM`),
  ADD KEY `FK_GIANGDAY` (`MAGIANGVIEN`),
  ADD KEY `FK_LOPHP_HKNH` (`HK_NH`);

--
-- Indexes for table `phanmem`
--
ALTER TABLE `phanmem`
  ADD PRIMARY KEY (`PHANMEM_ID`);

--
-- Indexes for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD PRIMARY KEY (`MAPHONGHOC`);

--
-- Indexes for table `quantrihethong`
--
ALTER TABLE `quantrihethong`
  ADD PRIMARY KEY (`MAQTHT`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiet_yeucau`
--
ALTER TABLE `chitiet_yeucau`
  ADD CONSTRAINT `FK_CTYC_GV` FOREIGN KEY (`MAGIANGVIEN`) REFERENCES `giangvien` (`MAGIANGVIEN`),
  ADD CONSTRAINT `FK_CTYC_LOPHP` FOREIGN KEY (`MAHOCPHAN`,`HK_NH`,`TENNHOM`) REFERENCES `lophocphan` (`MAHOCPHAN`, `HK_NH`, `TENNHOM`),
  ADD CONSTRAINT `FK_CTYC_PM` FOREIGN KEY (`PHANMEM_ID`) REFERENCES `phanmem` (`PHANMEM_ID`),
  ADD CONSTRAINT `FK_CTYC_QTHT` FOREIGN KEY (`MAQTHT`) REFERENCES `quantrihethong` (`MAQTHT`);

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `FK_GV_KHOA` FOREIGN KEY (`MAKHOA`) REFERENCES `khoa` (`MAKHOA`);

--
-- Constraints for table `lichthuchanh`
--
ALTER TABLE `lichthuchanh`
  ADD CONSTRAINT `FK_LICHTH_BUOIHOC` FOREIGN KEY (`BUOIHOC_ID`) REFERENCES `buoihoc` (`BUOIHOC_ID`),
  ADD CONSTRAINT `FK_LICHTH_LOPHP` FOREIGN KEY (`MAHOCPHAN`,`HK_NH`,`TENNHOM`) REFERENCES `lophocphan` (`MAHOCPHAN`, `HK_NH`, `TENNHOM`),
  ADD CONSTRAINT `FK_LICHTH_PHONGHOC` FOREIGN KEY (`MAPHONGHOC`) REFERENCES `phonghoc` (`MAPHONGHOC`);

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `FK_GIANGDAY` FOREIGN KEY (`MAGIANGVIEN`) REFERENCES `giangvien` (`MAGIANGVIEN`),
  ADD CONSTRAINT `FK_LOPHP_HKNH` FOREIGN KEY (`HK_NH`) REFERENCES `hocki_namhoc` (`HK_NH`),
  ADD CONSTRAINT `FK_LOPHP_HP` FOREIGN KEY (`MAHOCPHAN`) REFERENCES `hocphan` (`MAHOCPHAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
