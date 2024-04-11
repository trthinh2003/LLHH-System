<?php
    include_once('../model/connectdb.php');
    include_once('../model/catalog.php');
    include_once('../model/getDateByWeekAndDate.php');
    $result_all = layTTCacYeuCauDeInsertVaoLichFull();
    foreach ($result_all as $row) {
        $ngayhoc = getDateByWeekAndDay($row['NGAYBATDAU'], $row['TUANHOC'], $row['THU']);
        echo var_dump($ngayhoc . '<br>');
    }
?>