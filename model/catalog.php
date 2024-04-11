<?php
    //Hàm trả về tất cả phòng học
    function selectOptPhongHoc() {
        $conn = connect();
        $sql = "SELECT MAPHONGHOC FROM PHONGHOC";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Hàm trả về tất cả thông tin của giảng viên theo tên giảng viên
    function layTTProfileGV($teacherName) {
        $conn = connect();
        $sql = "SELECT DISTINCT GIANGVIEN.HOTENGIANGVIEN, KHOA.TENKHOA, GIANGVIEN.EMAIL,
                                LYLICHKHOAHOC.TRINHDOCHUYENMON, LYLICHKHOAHOC.HOCHAM, 
                                LYLICHKHOAHOC.NGACHVIENCHUC, GIANGVIEN.SODIENTHOAI
                FROM GIANGVIEN, LYLICHKHOAHOC, KHOA
                WHERE GIANGVIEN.LYLICH_ID = LYLICHKHOAHOC.LYLICH_ID
                AND GIANGVIEN.MAKHOA = KHOA.MAKHOA
                AND GIANGVIEN.HOTENGIANGVIEN LIKE '".$teacherName."'";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    function demSoLuongPH() {
        $conn = connect();
        $sql = "SELECT COUNT(*) FROM PHONGHOC";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return intval($row[0]);
    }

    //Lấy full phòng học cùng cấu hình máy và phần mềm tương ứng
    function layTTPhongHocKemCauHinhMayVaPhanMem() {
        $conn = connect();
        $sql = "SELECT bang1.MAPHONGHOC, bang2.SUCCHUA, bang2.CPU, bang2.RAM, bang2.SSD, bang1.CACPHANMEM
                FROM (SELECT PHANMEM_PHONGHOC.MAPHONGHOC, GROUP_CONCAT(PHANMEM.TENPHANMEM SEPARATOR ', ') AS CACPHANMEM
                        FROM PHANMEM_PHONGHOC, PHANMEM
                        WHERE PHANMEM_PHONGHOC.PHANMEM_ID = PHANMEM.PHANMEM_ID
                        GROUP BY PHANMEM_PHONGHOC.MAPHONGHOC) bang1
                INNER JOIN (SELECT DISTINCT PHONGHOC.MAPHONGHOC, PHONGHOC.SUCCHUA, CAUHINHMAY.CPU, CAUHINHMAY.RAM, CAUHINHMAY.SSD
                        FROM PHONGHOC, CAUHINHMAY
                        WHERE PHONGHOC.MACAUHINH = CAUHINHMAY.MACAUHINH
                        ORDER BY PHONGHOC.MAPHONGHOC) bang2
                ON bang1.MAPHONGHOC = bang2.MAPHONGHOC";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Lấy thông tin lớp học phần theo tên giảng viên và ID
    function layTTLopHocPhan($teacher_id, $teacherName) {
        $conn = connect();
        $sql = "SELECT HOCPHAN.MAHOCPHAN, HOCPHAN.TENHOCPHAN, LOPHOCPHAN.TENNHOM,
                       LOPHOCPHAN.THU, LOPHOCPHAN.SISO, LOPHOCPHAN.BUOIHOC, GIANGVIEN.HOTENGIANGVIEN,
                       LOPHOCPHAN.HOCKI, LOPHOCPHAN.NAMHOC
                FROM LOPHOCPHAN, HOCPHAN, GIANGVIEN
                WHERE LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN
                AND LOPHOCPHAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND GIANGVIEN.GIANGVIEN_ID = '".$teacher_id."'
                AND GIANGVIEN.HOTENGIANGVIEN LIKE '".$teacherName."'
                ORDER BY HOCPHAN.MAHOCPHAN";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Hàm lấy thông tin các yêu cầu của tất cả giảng viên
    function layTTCacYeuCauDeInsertVaoLichFull() {
        $conn = connect();
        $sql = "SELECT DISTINCT YEUCAU.YEUCAU_ID,LOPHOCPHAN.MAHOCPHAN, 
                                HOCPHAN.TENHOCPHAN, LOPHOCPHAN.TENNHOM, GIANGVIEN.GIANGVIEN_ID,
                                LOPHOCPHAN.THU, YEUCAU.TUANHOC, 
                                LOPHOCPHAN.BUOIHOC, HOCKI.NGAYBATDAU
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI, HOCPHAN
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI
                ORDER BY YEUCAU.NGAYYEUCAU";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        $conn->close();
        return $row;
    }

    //Hàm lấy thông tin các yêu cầu của tất cả giảng viên theo ID yêu cầu 
    function layTTYeuCauDeInsertVaoLich($yeucau_id) {
        $conn = connect();
        $sql = "SELECT DISTINCT LOPHOCPHAN.MAHOCPHAN, 
                        HOCPHAN.TENHOCPHAN, LOPHOCPHAN.TENNHOM,
                        LOPHOCPHAN.HOCKI, LOPHOCPHAN.NAMHOC, GIANGVIEN.GIANGVIEN_ID,
                        LOPHOCPHAN.THU, YEUCAU.TUANHOC, 
                        LOPHOCPHAN.BUOIHOC, HOCKI.NGAYBATDAU
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI, HOCPHAN
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI
                AND YEUCAU.YEUCAU_ID = '".$yeucau_id."'
                ORDER BY YEUCAU.NGAYYEUCAU";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Hàm lấy tấy cả các yêu cầu
    function layTTCacYeuCau() {
        $conn = connect();
        $sql = "SELECT DISTINCT YEUCAU.YEUCAU_ID, LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM,
                       LOPHOCPHAN.HOCKI, LOPHOCPHAN.NAMHOC, YEUCAU.TUANHOC, 
                       GIANGVIEN.HOTENGIANGVIEN, PHANMEM.TENPHANMEM, YEUCAU.NGAYYEUCAU
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI
                ORDER BY NGAYYEUCAU";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    function layDuLieuBangLichTH_hienthi_lenFullCalendar() {
        $conn = connect();
        $sql = "SELECT LICHTHUCHANH.MAPHONGHOC, LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM,
		               HOCPHAN.TENHOCPHAN, GIANGVIEN.HOTENGIANGVIEN, LOPHOCPHAN.BUOIHOC, LICHTHUCHANH.NGAYHOC
                FROM LICHTHUCHANH, LOPHOCPHAN, HOCPHAN, GIANGVIEN
                WHERE LICHTHUCHANH.TENNHOM = LOPHOCPHAN.TENNHOM
                AND LICHTHUCHANH.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND LICHTHUCHANH.HOCKI = LOPHOCPHAN.HOCKI
                AND LICHTHUCHANH.NAMHOC = LOPHOCPHAN.NAMHOC
                AND LOPHOCPHAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    function demSoLuongLichTH() {
        $conn = connect();
        $sql = "SELECT COUNT(*) FROM LICHTHUCHANH";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return intval($row[0]);
    }
?>