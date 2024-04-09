<?php
    function layAllKhoa() {
        $conn = connect();
        $sql = "SELECT * FROM KHOA";
        $result =  $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    //Hàm trả về tất cả phòng học
    function selectOptPhongHoc() {
        $conn = connect();
        $sql = "SELECT MAPHONGHOC FROM PHONGHOC";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
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
        $conn->close();
        return $row;
    }

    //Lấy full phòng học và cấu hình máy tương ứng
    function layTTPhongHocKemCauHinhMay() {
        $conn = connect();
        $sql = "SELECT DISTINCT PHONGHOC.MAPHONGHOC, PHONGHOC.SUCCHUA, CAUHINHMAY.CPU, CAUHINHMAY.RAM, CAUHINHMAY.SSD
                FROM PHONGHOC, CAUHINHMAY
                WHERE PHONGHOC.MACAUHINH = CAUHINHMAY.MACAUHINH
                ORDER BY PHONGHOC.MAPHONGHOC";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
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
        $conn->close();
        return $row;
    }

    function layTTCacYeuCauDeInsertVaoLich($teacher_id, $teacherName) {
        $conn = connect();
        $sql = "SELECT YEUCAU.YEUCAU_ID, LOPHOCPHAN.MAHOCPHAN, 
                       HOCPHAN.TENHOCPHAN, LOPHOCPHAN.TENNHOM,
                       LOPHOCPHAN.THU, YEUCAU.TUANHOC, 
                       LOPHOCPHAN.BUOIHOC, HOCKI.NGAYBATDAU
                 FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI, HOCPHAN
                 WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                 AND GIANGVIEN.GIANGVIEN_ID = '".$teacher_id."'
                 AND GIANGVIEN.HOTENGIANGVIEN LIKE '".$teacherName."'
                 AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                 AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                 AND LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN
                 AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                 AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                 AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                 AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        $conn->close();
        return $row;
    }

    function layTTCacYeuCau() {
        $conn = connect();
        $sql = "SELECT YEUCAU.YEUCAU_ID, LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM,
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
        $conn->close();
        return $row;
    }
?>