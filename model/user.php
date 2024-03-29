<?php
    function layTenGiangVien($GiangVien_ID) {
        $sql = "SELECT DISTINCT HOTENGIANGVIEN FROM GIANGVIEN WHERE GIANGVIEN_ID LIKE '".$GiangVien_ID."'";
    }
?>