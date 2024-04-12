<?php
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    include_once('../model/getDateByWeekAndDate.php');
    $result_all = layTTCacYeuCauDeInsertVaoLichFull();
    // $soluongLHP = demSoLuongLHPTrongBangYCDeToMau();
    // $cacLopHPToMau = layLopHocPhanTrongBangYeuCauDeToMau();
    // $arr = array(
        // array(1, 0, 0, 0, 0, 0, 0, 0),
        // array(0, 1, 0, 0, 0, 0, 0, 0),
        // array(0, 0, 1, 0, 0, 0, 0, 0),
        // array(0, 0, 0, 1, 0, 0, 0, 0),
        // array(0, 0, 0, 0, 1, 0, 0, 0),
        // array(0, 0, 0, 0, 0, 1, 0, 0),
        // array(0, 0, 0, 0, 0, 0, 1, 0),
        // array(0, 0, 0, 0, 0, 0, 0, 1)
    // );
    $conn = connect();
    $conn->query("CREATE TABLE TEMP (
                    MAHOCPHAN CHAR(15),
                    TENNHOM INT(11),
                    NGAYHOC DATE,
                    BUOIHOC VARCHAR(15)
                 );");
    foreach ($result_all as $row) {
        $ngayhoc = getDateByWeekAndDay($row['NGAYBATDAU'], $row['TUANHOC'], $row['THU']);
        // echo (''.$row['MAHOCPHAN'].'-'.$row['TENNHOM'].' | '.$ngayhoc.' | '.$row['BUOIHOC'].'' . '<br>');
        $sql = "INSERT INTO TEMP VALUES('".$row['MAHOCPHAN']."', '".$row['TENNHOM']."', '".$ngayhoc."', '".$row['BUOIHOC']."')";
        $conn->query($sql);
    }
        // ("CT101-1"=>1, 0, 0, 0, 0, 0, 0, 0),
        // (0, 1, 0, 0, 0, 0, 0, 0),
        // (0, 0, 1, 0, 0, 0, 0, 0),
        // (0, 0, 0, 1, 0, 0, 0, 0),
        // (0, 0, 0, 0, 1, 0, 0, 0),
        // (0, 0, 0, 0, 0, 1, 0, 0),
        // (0, 0, 0, 0, 0, 0, 1, 0),
        // (0, 0, 0, 0, 0, 0, 0, 1)

    // for ($i = 0; $i < $soluongLHP; $i++) {
    //     $inner_array = array();
    //     for ($j = 0; $j < $soluongLHP; $j++) {
    //         $inner_array[] = 0;
    //     }
    //     $arr[] = $inner_array;
    // }
    // for ($i = 0; $i < $soluongLHP; $i++) {
    //     for ($j = 0; $j < $soluongLHP; $j++) {
    //         if ($i == $j)
    //         $arr[$i][$j] = 1;
    //     }
    // }
    // for ($i = 0; $i < $soluongLHP; $i++) {
    //     for ($j = 0; $j < $soluongLHP; $j++) {
    //         echo $arr[$i][$j] . ' ';
    //     }
    //     echo '<br>';
    // }
    header('Location: tempTableDeal.php');
    $conn->close();
?>