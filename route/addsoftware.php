<?php
    ob_start();
    session_start();
    include_once ('../model/connectdb.php');
    $conn = connect();
    if (isset($_POST['addSoftwareBtn']) && $_POST['addSoftwareBtn']) {
        $nameSW = $_POST["nameSoftWare"];
        $versionSW = $_POST["versionSoftWare"];
    }
    $sql = "INSERT IGNORE INTO PHANMEM(TENPHANMEM, PHIENBAN) VALUES('".$nameSW."', '".$versionSW."')";
    $result = $conn->query($sql);
    if ($conn->affected_rows > 0) {
        $_SESSION['statusAddSW'] = "Thêm phần mềm thành công!";
        header('Location: ../index.php?pg=software_manage');
    }
    else {
        $_SESSION['statusAddSW'] = "Phần mềm đã có trên hệ thống";
        header('Location: ../index.php?pg=software_manage');
    }
    $conn->close();
?>