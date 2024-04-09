<?php
    include_once "../model/connectdb.php";
    $conn = connect();
    if (isset($_POST['delBtn']) && $_POST['delBtn']) {
        $maphonghoc = $_POST['maphonghoc'];
    }

    $sql = "DELETE FROM PHONGHOC WHERE MAPHONGHOC='".$maphonghoc."'";

    if ($conn->query($sql) == TRUE) {
        header('Location: ../index.php?pg=lab_manage');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>
