<?php
    function getQTHT() {
        $sql = "SELECT * FROM QUANTRIHETHONG";
        return get_all($sql);
    }
    function layAllKhoa() {
        $sql = "SELECT * FROM KHOA";
        return get_all($sql);
    }
?>