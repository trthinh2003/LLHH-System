<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    $conn = connect();
    if (isset($_POST['delBtn']) && $_POST['delBtn']) {
        $taikhoan_id = $_POST['taikhoan_id'];
    }
    $giangvien_id = layIDGVTuTaiKhoanID($taikhoan_id);

    $sql1 = "DELETE FROM TAIKHOAN WHERE TAIKHOAN_ID = '".$taikhoan_id."'";
    $sql2 = "DELETE FROM GIANGVIEN WHERE GIANGVIEN_ID = '".$giangvien_id."'";

    if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
        $_SESSION['deleteAccountSuccess'] = "Xóa tài khoản thành công!";
        header('Location: ../index.php?pg=account_manage');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>
