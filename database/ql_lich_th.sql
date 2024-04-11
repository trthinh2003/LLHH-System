-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 09:59 AM
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
-- Database: `ql_lich_th`
--

-- --------------------------------------------------------

--
-- Table structure for table `cauhinhmay`
--

CREATE TABLE `cauhinhmay` (
  `MACAUHINH` char(15) NOT NULL,
  `CPU` varchar(50) DEFAULT NULL,
  `RAM` varchar(15) DEFAULT NULL,
  `SSD` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `cauhinhmay`
--

INSERT INTO `cauhinhmay` (`MACAUHINH`, `CPU`, `RAM`, `SSD`) VALUES
('CH01', 'Intel Core i3-9100', '8GB', '512GB'),
('CH02', 'Intel Core i5-11400', '16GB', '1TB'),
('CH03', 'Intel Core i7-12700', '32GB', '1TB');

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `GIANGVIEN_ID` int(11) NOT NULL,
  `HOTENGIANGVIEN` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SODIENTHOAI` varchar(15) NOT NULL,
  `GIOITINH` char(10) NOT NULL,
  `MAKHOA` varchar(15) NOT NULL,
  `LYLICH_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`GIANGVIEN_ID`, `HOTENGIANGVIEN`, `EMAIL`, `SODIENTHOAI`, `GIOITINH`, `MAKHOA`, `LYLICH_ID`) VALUES
(1, 'Vũ Đức Minh', 'vducminh@ctu.edu.vn', '0912567891', 'Nam', 'CNTT', 1),
(2, 'Trần Ngọc Khả Hân', 'khahan@ctu.edu.vn', '0973573577', 'Nữ', 'ATTT', 2),
(3, 'Lâm Trần Anh Khôi', 'anhkhoi96@ctu.edu.vn', '0917537565', 'Nam', 'HTTT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hocki`
--

CREATE TABLE `hocki` (
  `HOCKI` varchar(10) NOT NULL,
  `NAMHOC` varchar(20) NOT NULL,
  `NGAYBATDAU` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `hocki`
--

INSERT INTO `hocki` (`HOCKI`, `NAMHOC`, `NGAYBATDAU`) VALUES
('1', '2023-2024', NULL),
('2', '2023 - 2024', '2024-02-26');

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
('CT101', 'Lập trình căn bản A', 4, NULL),
('CT112', 'Mạng máy tính', 3, NULL),
('CT179', 'Quản trị hệ thống', 3, NULL),
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
('ATTT', 'An Toàn Thông Tin'),
('CNTT', 'Công Nghệ Thông Tin'),
('HTTT', 'Hệ Thống Thông Tin'),
('KHMT', 'Khoa Học Máy Tính'),
('KTPM', 'Kỹ Thuật Phần Mềm'),
('MMT', 'Mạng Máy Tính Và Truyền Thông Dữ Liệu');

-- --------------------------------------------------------

--
-- Table structure for table `lichthuchanh`
--

CREATE TABLE `lichthuchanh` (
  `MAPHONGHOC` char(15) NOT NULL,
  `MAHOCPHAN` char(15) NOT NULL,
  `HOCKI` varchar(10) NOT NULL,
  `NAMHOC` varchar(20) NOT NULL,
  `TENNHOM` int(11) NOT NULL,
  `NGAYHOC` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lophocphan`
--

CREATE TABLE `lophocphan` (
  `MAHOCPHAN` char(15) NOT NULL,
  `HOCKI` varchar(10) NOT NULL,
  `NAMHOC` varchar(20) NOT NULL,
  `TENNHOM` int(11) NOT NULL,
  `THU` int(11) DEFAULT NULL,
  `SISO` int(11) DEFAULT NULL,
  `BUOIHOC` varchar(15) DEFAULT NULL,
  `GIANGVIEN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`, `THU`, `SISO`, `BUOIHOC`, `GIANGVIEN_ID`) VALUES
('CT179', '2', '2023 - 2024', 1, 3, 40, 'Sáng', 3),
('CT180', '2', '2023 - 2024', 1, 2, 40, 'Sáng', 3),
('CT180', '2', '2023 - 2024', 2, 5, 40, 'Sáng', 3),
('CT180', '2', '2023 - 2024', 3, 2, 40, 'Chiều', 1),
('CT299', '2', '2023 - 2024', 1, 6, 40, 'Chiều', 3),
('CT299', '2', '2023 - 2024', 2, 2, 40, 'Sáng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lylichkhoahoc`
--

CREATE TABLE `lylichkhoahoc` (
  `LYLICH_ID` int(11) NOT NULL,
  `TRINHDOCHUYENMON` varchar(40) DEFAULT NULL,
  `HOCHAM` varchar(50) DEFAULT NULL,
  `NGACHVIENCHUC` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `lylichkhoahoc`
--

INSERT INTO `lylichkhoahoc` (`LYLICH_ID`, `TRINHDOCHUYENMON`, `HOCHAM`, `NGACHVIENCHUC`) VALUES
(1, 'Tiến sĩ', 'Phó giáo sư', 'Giảng viên cao cấp'),
(2, 'Tiến sĩ', NULL, 'Giảng viên');

-- --------------------------------------------------------

--
-- Table structure for table `phammem_phonghoc`
--

CREATE TABLE `phammem_phonghoc` (
  `MAPHONGHOC` char(15) NOT NULL,
  `PHANMEM_ID` int(11) NOT NULL
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

--
-- Dumping data for table `phanmem`
--

INSERT INTO `phanmem` (`PHANMEM_ID`, `TENPHANMEM`, `PHIENBAN`) VALUES
(1, 'StarUML', '6.1.0'),
(2, 'VS Code', '1.64'),
(3, 'PowerDesigner', '16.1'),
(4, 'DevC++', '4.0'),
(5, 'SQL Server', '2022'),
(6, 'OracleDB', '21c');

-- --------------------------------------------------------

--
-- Table structure for table `phonghoc`
--

CREATE TABLE `phonghoc` (
  `MAPHONGHOC` char(15) NOT NULL,
  `MACAUHINH` char(15) NOT NULL,
  `SUCCHUA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `phonghoc`
--

INSERT INTO `phonghoc` (`MAPHONGHOC`, `MACAUHINH`, `SUCCHUA`) VALUES
('P101', 'CH01', 40),
('P102', 'CH01', 40),
('P103', 'CH01', 40),
('P104', 'CH01', 40),
('P105', 'CH01', 40),
('P106', 'CH01', 40),
('P107', 'CH01', 40),
('P108', 'CH01', 40),
('P109', 'CH01', 40),
('P110', 'CH01', 40),
('P111', 'CH01', 40),
('P201', 'CH02', 40),
('P202', 'CH02', 40),
('P203', 'CH02', 40),
('P204', 'CH02', 50),
('P205', 'CH02', 50),
('P206', 'CH02', 50),
('P207', 'CH02', 50),
('P208', 'CH02', 50),
('P209', 'CH02', 50),
('P210', 'CH02', 50),
('P211', 'CH02', 50),
('P212', 'CH02', 50),
('P213', 'CH02', 50),
('P214', 'CH02', 50),
('P215', 'CH02', 50),
('P217', 'CH02', 50),
('P218', 'CH02', 50),
('P219', 'CH03', 40),
('P220', 'CH03', 40),
('P221', 'CH03', 50);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TAIKHOAN_ID` int(11) NOT NULL,
  `TENDANGNHAP` varchar(30) DEFAULT NULL,
  `MATKHAU` varchar(30) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL,
  `GIANGVIEN_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TAIKHOAN_ID`, `TENDANGNHAP`, `MATKHAU`, `ROLE`, `GIANGVIEN_ID`) VALUES
(1, 'admin', 'admin123', 1, 1),
(2, 'ducminh', 'ducminh123', 2, 1),
(3, 'anhkhoi', 'anhkhoi123', 2, 3),
(4, 'khahan', 'khahan123', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `yeucau`
--

CREATE TABLE `yeucau` (
  `YEUCAU_ID` int(11) NOT NULL,
  `MAHOCPHAN` char(15) DEFAULT NULL,
  `HOCKI` varchar(10) DEFAULT NULL,
  `NAMHOC` varchar(20) DEFAULT NULL,
  `TENNHOM` int(11) DEFAULT NULL,
  `PHANMEM_ID` int(11) DEFAULT NULL,
  `GIANGVIEN_ID` int(11) DEFAULT NULL,
  `TUANHOC` int(11) DEFAULT NULL,
  `NGAYYEUCAU` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `yeucau`
--

INSERT INTO `yeucau` (`YEUCAU_ID`, `MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`, `PHANMEM_ID`, `GIANGVIEN_ID`, `TUANHOC`, `NGAYYEUCAU`) VALUES
(1, 'CT180', '2', '2023 - 2024', 1, 1, 3, 2, '2024-04-08 20:40:26'),
(2, 'CT180', '2', '2023 - 2024', 1, 1, 3, 1, '2024-04-08 20:44:02'),
(3, 'CT180', '2', '2023 - 2024', 1, 1, 3, 3, '2024-04-08 20:45:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cauhinhmay`
--
ALTER TABLE `cauhinhmay`
  ADD PRIMARY KEY (`MACAUHINH`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`GIANGVIEN_ID`),
  ADD KEY `MAKHOA` (`MAKHOA`,`LYLICH_ID`),
  ADD KEY `LYLICH_ID` (`LYLICH_ID`);

--
-- Indexes for table `hocki`
--
ALTER TABLE `hocki`
  ADD PRIMARY KEY (`HOCKI`,`NAMHOC`);

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
  ADD PRIMARY KEY (`MAPHONGHOC`,`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`,`NGAYHOC`),
  ADD KEY `FK_LICHTH_LOPHP` (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`);

--
-- Indexes for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD PRIMARY KEY (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`),
  ADD KEY `FK_LOPHP_HKNH` (`HOCKI`,`NAMHOC`),
  ADD KEY `GIANGVIEN_ID` (`GIANGVIEN_ID`);

--
-- Indexes for table `lylichkhoahoc`
--
ALTER TABLE `lylichkhoahoc`
  ADD PRIMARY KEY (`LYLICH_ID`);

--
-- Indexes for table `phammem_phonghoc`
--
ALTER TABLE `phammem_phonghoc`
  ADD PRIMARY KEY (`MAPHONGHOC`,`PHANMEM_ID`),
  ADD KEY `MAPHONGHOC` (`MAPHONGHOC`,`PHANMEM_ID`),
  ADD KEY `PHANMEM_ID` (`PHANMEM_ID`);

--
-- Indexes for table `phanmem`
--
ALTER TABLE `phanmem`
  ADD PRIMARY KEY (`PHANMEM_ID`);

--
-- Indexes for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD PRIMARY KEY (`MAPHONGHOC`),
  ADD KEY `FK_CHMAY_PH` (`MACAUHINH`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TAIKHOAN_ID`),
  ADD KEY `GIANGVIEN_ID` (`GIANGVIEN_ID`);

--
-- Indexes for table `yeucau`
--
ALTER TABLE `yeucau`
  ADD PRIMARY KEY (`YEUCAU_ID`),
  ADD KEY `FK_YC_LHP` (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`),
  ADD KEY `PHANMEM_ID` (`PHANMEM_ID`),
  ADD KEY `GIANGVIEN_ID` (`GIANGVIEN_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `GIANGVIEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lylichkhoahoc`
--
ALTER TABLE `lylichkhoahoc`
  MODIFY `LYLICH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phanmem`
--
ALTER TABLE `phanmem`
  MODIFY `PHANMEM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `TAIKHOAN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `YEUCAU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `giangvien_ibfk_1` FOREIGN KEY (`MAKHOA`) REFERENCES `khoa` (`MAKHOA`),
  ADD CONSTRAINT `giangvien_ibfk_2` FOREIGN KEY (`LYLICH_ID`) REFERENCES `lylichkhoahoc` (`LYLICH_ID`);

--
-- Constraints for table `lichthuchanh`
--
ALTER TABLE `lichthuchanh`
  ADD CONSTRAINT `FK_LICHTH_LOPHP` FOREIGN KEY (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`) REFERENCES `lophocphan` (`MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`),
  ADD CONSTRAINT `FK_LICHTH_PHONGHOC` FOREIGN KEY (`MAPHONGHOC`) REFERENCES `phonghoc` (`MAPHONGHOC`);

--
-- Constraints for table `lophocphan`
--
ALTER TABLE `lophocphan`
  ADD CONSTRAINT `FK_LOPHP_HKNH` FOREIGN KEY (`HOCKI`,`NAMHOC`) REFERENCES `hocki` (`HOCKI`, `NAMHOC`),
  ADD CONSTRAINT `FK_LOPHP_HP` FOREIGN KEY (`MAHOCPHAN`) REFERENCES `hocphan` (`MAHOCPHAN`),
  ADD CONSTRAINT `lophocphan_ibfk_1` FOREIGN KEY (`GIANGVIEN_ID`) REFERENCES `giangvien` (`GIANGVIEN_ID`);

--
-- Constraints for table `phammem_phonghoc`
--
ALTER TABLE `phammem_phonghoc`
  ADD CONSTRAINT `phammem_phonghoc_ibfk_1` FOREIGN KEY (`PHANMEM_ID`) REFERENCES `phanmem` (`PHANMEM_ID`),
  ADD CONSTRAINT `phammem_phonghoc_ibfk_2` FOREIGN KEY (`MAPHONGHOC`) REFERENCES `phonghoc` (`MAPHONGHOC`);

--
-- Constraints for table `phonghoc`
--
ALTER TABLE `phonghoc`
  ADD CONSTRAINT `FK_CHMAY_PH` FOREIGN KEY (`MACAUHINH`) REFERENCES `cauhinhmay` (`MACAUHINH`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`GIANGVIEN_ID`) REFERENCES `giangvien` (`GIANGVIEN_ID`);

--
-- Constraints for table `yeucau`
--
ALTER TABLE `yeucau`
  ADD CONSTRAINT `FK_YC_LHP` FOREIGN KEY (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`) REFERENCES `lophocphan` (`MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`),
  ADD CONSTRAINT `yeucau_ibfk_1` FOREIGN KEY (`PHANMEM_ID`) REFERENCES `phanmem` (`PHANMEM_ID`),
  ADD CONSTRAINT `yeucau_ibfk_2` FOREIGN KEY (`GIANGVIEN_ID`) REFERENCES `giangvien` (`GIANGVIEN_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
