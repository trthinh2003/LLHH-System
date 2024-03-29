<?php
    function layAllKhoa() {
        $conn = connect();
        $sql = "SELECT * FROM KHOA";
        $result =  $conn->query($sql);
        $conn->close();
        return $result;
    }
    function selectOptPhongHoc() {
        $conn = connect();
        $sql = "SELECT MAPHONGHOC FROM PHONGHOC";
        $result =  $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
        }
        $conn->close();
        return $row;
    }
?>