<?php
    include_once "../model/connectdb.php";
    $conn = connect();
    if (isset($_POST['delBtn']) && $_POST['delBtn']) {
        $maphonghoc = $_POST['maphonghoc'];
    }

    $sql1 = "DELETE FROM PHANMEM_PHONGHOC WHERE MAPHONGHOC='".$maphonghoc."'";
    $sql2 = "DELETE FROM PHONGHOC WHERE MAPHONGHOC='".$maphonghoc."'";

    if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
        header('Location: ../index.php?pg=lab_manage');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>
