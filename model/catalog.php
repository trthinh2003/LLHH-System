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

    //Hàm trả về tất cả các khoa
    function selectOptKhoa() {
        $conn = connect();
        $sql = "SELECT TENKHOA FROM KHOA";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Hàm trả về tất cả các phần mềm
    function selectOptPM() {
        $conn = connect();
        $sql = "SELECT TENPHANMEM FROM PHANMEM";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //Hàm lấy mã khoa từ tên khoa
    function layMaKhoaTuTenKhoa($tenkhoa) {
        $conn = connect();
        $sql = "SELECT MAKHOA FROM KHOA WHERE TENKHOA LIKE '".$tenkhoa."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_row();
            $kq = $row[0];
        }
        else {
            $kq = 0;
        }
        $conn->close();
        return $kq;
    }

    //Hàm trả về tất cả thông tin của giảng viên theo tên giảng viên
    function layTTProfileGV($teacherName) {
        $conn = connect();
        $sql = "SELECT DISTINCT GIANGVIEN.GIANGVIEN_ID, GIANGVIEN.HOTENGIANGVIEN, KHOA.TENKHOA, GIANGVIEN.EMAIL,
                                GIANGVIEN.SODIENTHOAI, TAIKHOAN.TENDANGNHAP, TAIKHOAN.TAIKHOAN_ID
                FROM GIANGVIEN, KHOA, TAIKHOAN
                WHERE GIANGVIEN.MAKHOA = KHOA.MAKHOA
                AND TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
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

    //Hàm trả về lý lịch khoa học của giảng viên thông qua ID Giảng viên
    function layLyLichKhoaHoc($teacher_id) {
        $conn = connect();
        $sql = "SELECT DISTINCT LYLICHKHOAHOC.TRINHDOCHUYENMON, LYLICHKHOAHOC.HOCHAM, LYLICHKHOAHOC.NGACHVIENCHUC
                FROM GIANGVIEN, LYLICHKHOAHOC
                WHERE GIANGVIEN.LYLICH_ID = LYLICHKHOAHOC.LYLICH_ID
                AND GIANGVIEN.GIANGVIEN_ID LIKE '".$teacher_id."'";
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

    //Hàm trả về thông tin tài khoản
    function layTTTaiKhoan() {
        $conn = connect();
        $sql = "SELECT DISTINCT TAIKHOAN.TAIKHOAN_ID, TAIKHOAN.TENDANGNHAP, TAIKHOAN.ROLE
                FROM TAIKHOAN";
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

    //Hàm trả về thông tin các phần mềm
    function layTTPhanMem() {
        $conn = connect();
        $sql = "SELECT DISTINCT PHANMEM_ID, TENPHANMEM, PHIENBAN
                FROM PHANMEM";
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

    function layIDPMTuTenPM($tenphanmem) {
        $conn = connect();
        $sql = "SELECT PHANMEM_ID
                FROM PHANMEM
                WHERE TENPHANMEM LIKE '".$tenphanmem."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Lấy ID Lý lịch
    function layIDLyLich($trinhdochuyenmon, $hocham, $ngachvienchuc) {
        $conn = connect();
        $sql = "SELECT DISTINCT LYLICH_ID
                FROM LYLICHKHOAHOC
                WHERE TRINHDOCHUYENMON LIKE '".$trinhdochuyenmon."'
                AND HOCHAM LIKE '".$hocham."'
                AND NGACHVIENCHUC LIKE '".$ngachvienchuc."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_row();
            $kq = $row[0];
        }
        else {
            $kq = 0;
        }
        $conn->close();
        return $kq;
    }

    //Hàm lấy Email GV từ ID_TAIKHOAN
    function layEmailGV($taikhoan_id) {
        $conn = connect();
        $sql = "SELECT GIANGVIEN.EMAIL
                FROM TAIKHOAN, GIANGVIEN
                WHERE TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND TAIKHOAN.TAIKHOAN_ID = '".$taikhoan_id."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Hàm lấy tên giảng viên từ Username và Password
    function layTenGVTuUserNameAndPasswd($username, $password) {
        $conn = connect();
        $sql = "SELECT GIANGVIEN.HOTENGIANGVIEN 
                FROM TAIKHOAN, GIANGVIEN
                WHERE TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND TAIKHOAN.TENDANGNHAP LIKE '".$username."'
                AND TAIKHOAN.MATKHAU LIKE '".md5($password)."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Hàm lấy ID giảng viên từ Username và Password
    function layIDGVTuUserNameAndPasswd($username, $password) {
        $conn = connect();
        $sql = "SELECT GIANGVIEN.GIANGVIEN_ID
                FROM TAIKHOAN, GIANGVIEN
                WHERE TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND TAIKHOAN.TENDANGNHAP LIKE '".$username."'
                AND TAIKHOAN.MATKHAU LIKE '".md5($password)."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Hàm lấy ID giảng viên từ Tài khoản ID
    function layIDGVTuTaiKhoanID($taikhoan_id) {
        $conn = connect();
        $sql = "SELECT GIANGVIEN.GIANGVIEN_ID
                FROM TAIKHOAN, GIANGVIEN
                WHERE TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND TAIKHOAN.TAIKHOAN_ID LIKE '".$taikhoan_id."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Hàm lấy ID Giảng viên từ thông tin profile
    function layIDGVTuTTProfile($hotengiangvien, $email, $sodienthoai, $gioitinh, $makhoa) {
        $conn = connect();
        $sql = "SELECT GIANGVIEN_ID
                FROM GIANGVIEN
                WHERE HOTENGIANGVIEN LIKE '".$hotengiangvien."'
                AND EMAIL LIKE '".$email."'
                AND SODIENTHOAI LIKE '".$sodienthoai."'
                AND GIOITINH LIKE '".$gioitinh."'
                AND MAKHOA LIKE '".$makhoa."'";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }

    //Đếm số lượng yêu cầu
    function demSoLuongYC() {
        $conn = connect();
        $sql = "SELECT COUNT(*) FROM YEUCAU";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return intval($row[0]);
    }

    //Đếm số lượng phòng học
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
                       GIANGVIEN.HOTENGIANGVIEN, PHANMEM.TENPHANMEM, YEUCAU.NGAYYEUCAU, YEUCAU.TRANGTHAI
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI
                AND (YEUCAU.TRANGTHAI LIKE 'Chờ duyệt'
                OR YEUCAU.TRANGTHAI LIKE 'Chưa duyệt')
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
        $sql = "SELECT DISTINCT LICHTHUCHANH.MAPHONGHOC, LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM,
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

    function demSoLuongLHPTrongBangYCDeToMau() {
        $conn = connect();
        $sql = "SELECT COUNT(*) FROM (SELECT DISTINCT LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI, HOCPHAN
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND LOPHOCPHAN.MAHOCPHAN = HOCPHAN.MAHOCPHAN
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.HOCKI = HOCKI.HOCKI) cac_lhp_bang_yc";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return intval($row[0]);
    }

    function layLopHocPhanTrongBangYeuCauDeToMau() {
        $conn = connect();
        $sql = "SELECT DISTINCT LOPHOCPHAN.MAHOCPHAN, LOPHOCPHAN.TENNHOM
                FROM YEUCAU, LOPHOCPHAN, GIANGVIEN, PHANMEM, HOCKI, HOCPHAN
                WHERE YEUCAU.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
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
        else {
            $row = 0;
        }
        $conn->close();
        return $row;
    }

    //9 hàm xử lý bảng Temp
    function layLHPVaBuoiTuongUngTrongTemp() {
        $conn = connect();
        $sql = "SELECT GROUP_CONCAT(DISTINCT CONCAT(MAHOCPHAN,'-',TENNHOM)) AS LOPHOCPHAN, CONCAT(BUOIHOC, ',' ,NGAYHOC) AS BUOI 
                FROM TEMP GROUP BY BUOI";
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
    function laySiSoTuLHP($mahocphan, $tennhom) {
        $conn = connect();
        $sql = "SELECT SISO
                FROM LOPHOCPHAN
                WHERE MAHOCPHAN LIKE '".$mahocphan."'
                AND TENNHOM LIKE '".$tennhom."'";
        $result =  $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return intval($row[0]);
    }
    function layNamHocTuLHP($mahocphan, $tennhom) {
        $conn = connect();
        $sql = "SELECT NAMHOC
                FROM LOPHOCPHAN
                WHERE MAHOCPHAN LIKE '".$mahocphan."'
                AND TENNHOM LIKE '".$tennhom."'";
        $result =  $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }
    function layHocKiTuLHP($mahocphan, $tennhom) {
        $conn = connect();
        $sql = "SELECT HOCKI
                FROM LOPHOCPHAN
                WHERE MAHOCPHAN LIKE '".$mahocphan."'
                AND TENNHOM LIKE '".$tennhom."'";
        $result =  $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }
    function layNgayBatDauCuaHK_NH($hocki, $namhoc) {
        $conn = connect();
        $sql = "SELECT NGAYBATDAU
                FROM HOCKI
                WHERE HOCKI LIKE '".$hocki."'
                AND NAMHOC LIKE '".$namhoc."'";
        $result =  $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }
    function layCacPhongHocCoSucChuaKhongLonHonSiSo($siso) {
        $conn = connect();
        $sql = "SELECT MAPHONGHOC
                FROM PHONGHOC
                WHERE SUCCHUA <= '.$siso.'";
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
    function layMaYCVaMaPMTuLHP($mahocphan, $tennhom, $hocki, $namhoc) {
        $conn = connect();
        $sql = "SELECT YEUCAU.YEUCAU_ID, PHANMEM.PHANMEM_ID
                FROM YEUCAU, LOPHOCPHAN, PHANMEM
                WHERE YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN
                AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM
                AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI
                AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC
                AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID
                AND LOPHOCPHAN.MAHOCPHAN LIKE '.$mahocphan.'
                AND LOPHOCPHAN.TENNHOM LIKE '.$tennhom.'
                AND LOPHOCPHAN.HOCKI LIKE '.$hocki.'
                AND LOPHOCPHAN.NAMHOC LIKE '.$namhoc.'";
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
    function layRaCacPhongHocThoaManPhanMemVaSiSo($mahocphan, $tennhom, $hocki, $namhoc, $siso) {
        $conn = connect();
        $sql = "SELECT bang3.MAPHONGHOC
                FROM (SELECT DISTINCT bang1.MAPHONGHOC 
                      FROM (SELECT PHANMEM_PHONGHOC.MAPHONGHOC, PHANMEM_PHONGHOC.PHANMEM_ID 
                            FROM PHANMEM, PHANMEM_PHONGHOC WHERE PHANMEM.PHANMEM_ID = PHANMEM_PHONGHOC.PHANMEM_ID) bang1 
                      INNER JOIN (SELECT YEUCAU.YEUCAU_ID, PHANMEM.PHANMEM_ID 
                                  FROM YEUCAU, LOPHOCPHAN, PHANMEM WHERE YEUCAU.MAHOCPHAN = LOPHOCPHAN.MAHOCPHAN 
                                  AND YEUCAU.TENNHOM = LOPHOCPHAN.TENNHOM 
                                  AND YEUCAU.HOCKI = LOPHOCPHAN.HOCKI 
                                  AND YEUCAU.NAMHOC = LOPHOCPHAN.NAMHOC 
                                  AND YEUCAU.PHANMEM_ID = PHANMEM.PHANMEM_ID 
                                  AND LOPHOCPHAN.MAHOCPHAN LIKE '".$mahocphan."' 
                                  AND LOPHOCPHAN.TENNHOM LIKE '".$tennhom."' 
                                  AND LOPHOCPHAN.HOCKI LIKE '".$hocki."' 
                                  AND LOPHOCPHAN.NAMHOC LIKE '".$namhoc."') bang2 
                      ON bang1.PHANMEM_ID = bang2.PHANMEM_ID) bang3
                INNER JOIN (SELECT MAPHONGHOC
                            FROM PHONGHOC
                            WHERE SUCCHUA <= '".$siso."') bang4
                ON bang3.MAPHONGHOC = bang4.MAPHONGHOC;";
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
    function layIDYeuCauTuLHPKemTuanVaHK_NHTuongUng($mahocphan, $tennhom, $hocki, $namhoc, $tuanhoc) {
        $conn = connect();
        $sql = "SELECT YEUCAU_ID
                FROM YEUCAU
                WHERE MAHOCPHAN LIKE '".$mahocphan."'
                AND TENNHOM LIKE '".$tennhom."'
                AND HOCKI LIKE '".$hocki."'
                AND NAMHOC LIKE '".$namhoc."'
                AND TUANHOC LIKE '".$tuanhoc."'";
        $result =  $conn->query($sql);
        $row = $result->fetch_row();
        $conn->close();
        return $row[0];
    }
?>