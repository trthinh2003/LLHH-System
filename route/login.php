<?php
    ob_start();
    session_start();
    include_once "../model/connectdb.php";
    $conn = connect();
    if (isset($_POST['btnlogin']) && $_POST['btnlogin']) {
        $user = $_POST['username'];
        $pass = $_POST['passwd'];
    }
    $sql = "SELECT GIANGVIEN.GIANGVIEN_ID, GIANGVIEN.HOTENGIANGVIEN, TAIKHOAN.ROLE
            FROM TAIKHOAN, GIANGVIEN  
            WHERE TAIKHOAN.GIANGVIEN_ID = GIANGVIEN.GIANGVIEN_ID
            AND TAIKHOAN.TENDANGNHAP LIKE '".$user."' AND TAIKHOAN.MATKHAU LIKE '".$pass."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['ROLE'] == 1) {
            $_SESSION['AdminName'] = "Admin";
            header('Location: ../index.php?pg=admin');
        }
        else if ($row['ROLE'] == 2) {
            $_SESSION['TeacherID'] = $row['GIANGVIEN_ID'];
            $_SESSION['TeacherName'] = $row['HOTENGIANGVIEN'];
            header('Location: ../index.php?pg=teacher');
        }
    }
    else {
        $_SESSION['notExistAccount'] = "Tài khoản không tồn tại, vui lòng đăng nhập lại!";
        header('Location: ../index.php?pg=login-form');
    }
    $conn->close();
?>