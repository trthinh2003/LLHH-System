<?php
    ob_start();
    session_start();
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    include_once('../model/getDateByWeekAndDate.php');
    $conn = connect();

    if (isset($_POST['approveLabBtn']) && $_POST['approveLabBtn']) {
        $idx = $_POST['labApprove'];
        $maphonghoc = $_POST['maphonghoc' . $idx];
        $yeucau_id = $_POST['yeucau_id'];
    }
    $result_all = layTTYeuCauDeInsertVaoLich($yeucau_id);
    foreach ($result_all as $row) {
        $ngayhoc = getDateByWeekAndDay($row['NGAYBATDAU'], $row['TUANHOC'], $row['THU']);
        $sql = "INSERT INTO LICHTHUCHANH(MAPHONGHOC, MAHOCPHAN, HOCKI, NAMHOC, TENNHOM, NGAYHOC)
                VALUES('".$maphonghoc."', '".$row['MAHOCPHAN']."', '".$row['HOCKI']."',
                       '".$row['NAMHOC']."', '".$row['TENNHOM']."', '".$ngayhoc."')";
        
    }
    $xoaYC = "DELETE FROM YEUCAU WHERE YEUCAU_ID LIKE '".$yeucau_id."'";
    if ($conn->query($sql) == TRUE && $conn->query($xoaYC) == TRUE) {
        $_SESSION['successApprove'] = "Duyệt thành công!";
        header('Location: ../index.php?pg=requirements_manage');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>