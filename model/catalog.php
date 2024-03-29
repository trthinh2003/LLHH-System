<?php
    function layAllKhoa() {
        $conn = connect();
        $sql = "SELECT * FROM KHOA";
        return $conn->query($sql);
    }
    function layAllMaPhong() {
        $conn = connect();
        $sql = "SELECT MAPHONGHOC FROM PHONGHOC";
        return $conn->query($sql);
    }
    function selectOptPhongHoc() {
        $result = layAllMaPhong();
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        return $row;
    }
?>