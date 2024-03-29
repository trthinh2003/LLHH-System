-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 03:28 AM
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
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `GIANGVIEN_ID` int(11) NOT NULL,
  `HOTENGIANGVIEN` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SODIENTHOAI` varchar(15) NOT NULL,
  `GIOITINH` char(10) NOT NULL,
  `LYLICH_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`GIANGVIEN_ID`, `HOTENGIANGVIEN`, `EMAIL`, `SODIENTHOAI`, `GIOITINH`, `LYLICH_ID`) VALUES
(1, 'Vũ Đức Minh', 'vducminh@gmail.com', '0912567891', 'Nam', 1),
(2, 'Lâm Trần Anh Khôi', 'ltakhoi@gmail.com', '0873373736', 'Nam', 2);

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
('1', '2023 - 2024', NULL),
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
('KTPM', 'Ký Thuật Phần Mềm'),
('MMT', 'Mạng Máy Tính Và Truyền Thông Dữ Liệu');

-- --------------------------------------------------------

--
-- Table structure for table `lichthuchanh`
--

CREATE TABLE `lichthuchanh` (
  `MAPHONGHOC` char(15) NOT NULL,
  `BUOIHOC_ID` int(11) NOT NULL,
  `NGAYHOC` date NOT NULL,
  `LICHTHUCHANH_ID` int(11) NOT NULL,
  `MAHOCPHAN` char(15) NOT NULL,
  `HOCKI` varchar(10) NOT NULL,
  `NAMHOC` varchar(20) NOT NULL,
  `TENNHOM` int(11) NOT NULL
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
  `GIANGVIEN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `lophocphan`
--

INSERT INTO `lophocphan` (`MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`, `GIANGVIEN_ID`) VALUES
('CT299', '2', '2023 - 2024', 2, 1);

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
(1, 'Tiến sĩ', NULL, 'Giảng viên'),
(2, 'Tiến sĩ', 'Phó giáo sư', 'Giảng viên cao cấp');

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
(2, 'VS Code', '1.64');

-- --------------------------------------------------------

--
-- Table structure for table `phonghoc`
--

CREATE TABLE `phonghoc` (
  `MAPHONGHOC` char(15) NOT NULL,
  `SUCCHUA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `phonghoc`
--

INSERT INTO `phonghoc` (`MAPHONGHOC`, `SUCCHUA`) VALUES
('P101', NULL),
('P102', NULL),
('P103', NULL),
('P104', NULL),
('P105', NULL),
('P106', NULL),
('P107', NULL),
('P108', NULL),
('P109', NULL),
('P110', NULL),
('P111', NULL),
('P201', NULL),
('P202', NULL),
('P203', NULL),
('P204', NULL),
('P205', NULL),
('P206', NULL),
('P207', NULL),
('P208', NULL),
('P209', NULL),
('P210', NULL),
('P211', NULL),
('P212', NULL),
('P213', NULL),
('P214', NULL),
('P215', NULL),
('P217', NULL),
('P218', NULL),
('P219', NULL),
('P220', NULL),
('P221', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TAIKHOAN_ID` int(15) NOT NULL,
  `TENDANGNHAP` varchar(30) DEFAULT NULL,
  `MATKHAU` varchar(30) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL,
  `GIANGVIEN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TAIKHOAN_ID`, `TENDANGNHAP`, `MATKHAU`, `ROLE`, `GIANGVIEN_ID`) VALUES
(1, 'admin', 'admin123', 1, 1),
(2, 'ducminh', 'ducminh123', 2, 1),
(3, 'anhkhoi', 'anhkhoi123', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `yeucau`
--

CREATE TABLE `yeucau` (
  `YEUCAU_ID` int(11) NOT NULL,
  `MAHOCPHAN` char(15) NOT NULL,
  `HOCKI` varchar(10) NOT NULL,
  `NAMHOC` varchar(20) NOT NULL,
  `TENNHOM` int(11) NOT NULL,
  `PHANMEM_ID` int(11) NOT NULL,
  `GIANGVIEN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buoihoc`
--
ALTER TABLE `buoihoc`
  ADD PRIMARY KEY (`BUOIHOC_ID`);

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`GIANGVIEN_ID`),
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
  ADD PRIMARY KEY (`MAPHONGHOC`,`BUOIHOC_ID`,`NGAYHOC`,`LICHTHUCHANH_ID`),
  ADD KEY `FK_LICHTH_BUOIHOC` (`BUOIHOC_ID`),
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
  ADD KEY `FK_YC_LOPHP` (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`),
  ADD KEY `PHANMEM_ID` (`PHANMEM_ID`),
  ADD KEY `GIANGVIEN_ID` (`GIANGVIEN_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giangvien`
--
ALTER TABLE `giangvien`
  MODIFY `GIANGVIEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lylichkhoahoc`
--
ALTER TABLE `lylichkhoahoc`
  MODIFY `LYLICH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phanmem`
--
ALTER TABLE `phanmem`
  MODIFY `PHANMEM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `TAIKHOAN_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `YEUCAU_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD CONSTRAINT `giangvien_ibfk_1` FOREIGN KEY (`LYLICH_ID`) REFERENCES `lylichkhoahoc` (`LYLICH_ID`);

--
-- Constraints for table `lichthuchanh`
--
ALTER TABLE `lichthuchanh`
  ADD CONSTRAINT `FK_LICHTH_BUOIHOC` FOREIGN KEY (`BUOIHOC_ID`) REFERENCES `buoihoc` (`BUOIHOC_ID`),
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
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`GIANGVIEN_ID`) REFERENCES `giangvien` (`GIANGVIEN_ID`);

--
-- Constraints for table `yeucau`
--
ALTER TABLE `yeucau`
  ADD CONSTRAINT `FK_YC_LOPHP` FOREIGN KEY (`MAHOCPHAN`,`HOCKI`,`NAMHOC`,`TENNHOM`) REFERENCES `lophocphan` (`MAHOCPHAN`, `HOCKI`, `NAMHOC`, `TENNHOM`),
  ADD CONSTRAINT `yeucau_ibfk_1` FOREIGN KEY (`PHANMEM_ID`) REFERENCES `phanmem` (`PHANMEM_ID`),
  ADD CONSTRAINT `yeucau_ibfk_2` FOREIGN KEY (`GIANGVIEN_ID`) REFERENCES `giangvien` (`GIANGVIEN_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
