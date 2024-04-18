<?php
    ob_start();
    session_start();
    include_once ('../model/connectdb.php');
    $conn = connect();
    if (isset($_POST['delBtn']) && $_POST['delBtn']) {
        $phanmem_id = $_POST["phanmem_id"];
        $tenphanmem = $_POST["tenphanmem"];
        $phienban = $_POST["phienban"];
    }
    $sql1 = "DELETE FROM PHANMEM_PHONGHOC WHERE PHANMEM_ID LIKE '".$phanmem_id."'";
    $sql2 = "DELETE FROM PHANMEM WHERE TENPHANMEM LIKE '".$tenphanmem."' AND PHIENBAN LIKE '".$phienban."'";
    if ($conn->query($sql1) == TRUE && $conn->query($sql2) == TRUE) {
        $_SESSION['statusAddSW'] = "Xóa phần mềm thành công!";
        header('Location: ../index.php?pg=software_manage');
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>