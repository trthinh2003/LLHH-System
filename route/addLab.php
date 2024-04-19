<?php
    ob_start();
    session_start();
    include_once ('../model/connectdb.php');
    include_once ('../model/catalog.php');
    $conn = connect();
    if (isset($_POST['addLabSubmit']) && $_POST['addLabSubmit']) {
        $tenPH = $_POST["nameLab"];
        $sucChua = $_POST["capacityOfLab"];
        $tenCH = $_POST["configName"];
        $tenPM = $_POST["softwareName"];
    }
    $id_PM = layIDPMTuTenPM($tenPM);
    $tachCH = explode(" - ", $tenCH);
    $cpu = explode(": ",$tachCH[0])[1];
    $ram = explode(": ",$tachCH[1])[1];
    $ssd = explode(": ",$tachCH[2])[1];
    $maCH = layMaCauHinh($cpu, $ram, $ssd);
    $sql1 = "INSERT IGNORE INTO PHONGHOC(MAPHONGHOC, SUCCHUA, MACAUHINH) VALUES('".$tenPH."', '".$sucChua."', '".$maCH."')";
    $sql2 = "INSERT IGNORE INTO PHANMEM_PHONGHOC(MAPHONGHOC, PHANMEM_ID) VALUES('".$tenPH."', '".$id_PM."')";

    if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
        $_SESSION['statusAddSW'] = "Thêm phòng học thành công!";
        header('Location: ../index.php?pg=lab_manage');
    }
    // echo $tenPH . " - " . $cpu . " - " . $ram . " - " . $ssd . " - " .$sucChua . " - " . $tenPM;
    $conn->close();
?>