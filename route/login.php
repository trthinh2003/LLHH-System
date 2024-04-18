<?php
    ob_start();
    session_start();
    include_once "../model/connectdb.php";
    include_once "../model/catalog.php";
    $conn = connect();
    if (isset($_POST['btnlogin']) && $_POST['btnlogin']) {
        $user = $_POST["username"];
        $pass = $_POST["passwd"];
    }
    $sql = "SELECT ROLE
            FROM TAIKHOAN
            WHERE TAIKHOAN.TENDANGNHAP LIKE '".$user."' AND TAIKHOAN.MATKHAU LIKE '".md5($pass)."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['ROLE'] == 1) {
            $_SESSION['AdminName'] = "Admin";
            header('Location: ../index.php?pg=admin');
        }
        else if ($row['ROLE'] == 2) {
            $_SESSION['TeacherID'] = layIDGVTuUserNameAndPasswd($user, $pass);
            $_SESSION['TeacherName'] = layTenGVTuUserNameAndPasswd($user, $pass);
            header('Location: ../index.php?pg=teacher');
        }
    }
    else {
        $_SESSION['notExistAccount'] = "Tài khoản không tồn tại, vui lòng đăng nhập lại!";
        header('Location: ../index.php?pg=login-form');
    }
    $conn->close();
?>