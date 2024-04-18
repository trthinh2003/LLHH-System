<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    $conn = connect();
    if (isset($_POST['editLabBtn']) && $_POST['editLabBtn']) {
        $maPH = $_POST['labName'];
        $tenPM = $_POST['softwareName'];
    }
    $pm_id = layIDPMTuTenPM($tenPM);
    $conn->query("INSERT IGNORE INTO PHANMEM_PHONGHOC(MAPHONGHOC, PHANMEM_ID) VALUES('".$maPH."', '".$pm_id."')");
    if ($conn->affected_rows > 0) {
        $_SESSION['statusAddSW'] = "Thêm phần mềm thành công!";
        $_SESSION['softwareAdd'] = $tenPM;
        $_SESSION['labNameAdd'] = $maPH;
        header('Location: ../index.php?pg=lab_manage');
    }
    else {
        $_SESSION['statusAddSW'] = "Phần mềm đã có ở phòng học này";
        header('Location: ../index.php?pg=lab_manage');
    }
    $conn->close();
?>