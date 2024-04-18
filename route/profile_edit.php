<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    $conn = connect();
    if (isset($_POST['editBtn']) && $_POST['editBtn']) {
        $giangvien_id = $_POST['teacher_id'];
        $taikhoan_id = $_POST['taikhoan_id'];
        $matkhau = $_POST['mậtkhẩu'];
        $trinhdochuyenmon = $_POST['trìnhđộchuyênmôn'];
        $hocham = $_POST['họchàm'];
        $ngachvienchuc = $_POST['ngạchviênchức'];
        $sodienthoai = $_POST['sốđiệnthoại'];
    }
    $conn->query("INSERT IGNORE INTO LYLICHKHOAHOC(TRINHDOCHUYENMON, HOCHAM, NGACHVIENCHUC) VALUES ('".$trinhdochuyenmon."', '".$hocham."', '".$ngachvienchuc."')");
    $idLyLich = layIDLyLich($trinhdochuyenmon, $hocham, $ngachvienchuc);
    $conn->query("UPDATE TAIKHOAN SET MATKHAU = '".md5($matkhau)."' WHERE TAIKHOAN_ID LIKE '".$taikhoan_id."'");
    $conn->query("UPDATE GIANGVIEN SET LYLICH_ID = '".$idLyLich."', SODIENTHOAI = '".$sodienthoai."' WHERE GIANGVIEN.GIANGVIEN_ID LIKE '".$giangvien_id."'");
    $_SESSION['successChangeProfile'] = "Thay đổi hồ sơ thành công!";
    header('Location: ../index.php?pg=teacher_profile');
    echo $giangvien_id . " - " . $taikhoan_id . " - " . $matkhau . " - " . $trinhdochuyenmon . " - " . $hocham . " - " . $ngachvienchuc ." - " . $sodienthoai  . " - " . $idLyLich;
    $conn->close();
?>