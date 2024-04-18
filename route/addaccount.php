<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    $conn = connect();
    if (isset($_POST['addAccountSubmit']) && $_POST['addAccountSubmit']) {
        $usernameAccount = $_POST['usernameAccount'];
        $passwordAccount = $_POST['passwordAccount'];
        $teacherName = $_POST['teacherName'];
        $sex_opt = $_POST['sex_opt'];
        $departmentName = $_POST['departmentName'];
        $emailTeacher = $_POST['emailTeacher'];
        $phoneNumber_teacher = $_POST['phoneNumberTeacher'];
    }
    $makhoa = layMaKhoaTuTenKhoa($departmentName);
    // echo $usernameAccount . " - " . $passwordAccount . " - " . $teacherName . " - " . $sex_opt . " - " . $makhoa . " - " . $emailTeacher . " - " . $phoneNumber_teacher;
    $conn->query("INSERT INTO GIANGVIEN(HOTENGIANGVIEN, EMAIL, SODIENTHOAI, GIOITINH, MAKHOA) 
                  VALUES('".$teacherName."', '".$emailTeacher."', '".$phoneNumber_teacher."', '".$sex_opt."', '".$makhoa."')");
    $id_gv = layIDGVTuTTProfile($teacherName, $emailTeacher, $phoneNumber_teacher, $sex_opt, $makhoa);
    $conn->query("INSERT INTO TAIKHOAN(TENDANGNHAP, MATKHAU, ROLE, GIANGVIEN_ID) 
                  VALUES('".$usernameAccount."', '".md5($passwordAccount)."', 2, '".$id_gv."')");
    $_SESSION['successAddAccount'] = "Thêm tài khoản thành công!";
    header('Location: ../index.php?pg=account_manage');
    $conn->close();
?>