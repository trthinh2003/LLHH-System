<?php
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        unset($_SESSION['AdminName']);
    }
    if (isset($_SESSION['soluongYC']) && $_SESSION['soluongYC'] != "") {
        unset($_SESSION['soluongYC']);
    }
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName'] != "") {
        unset($_SESSION['TeacherName']);
    }
    if (isset($_SESSION['TeacherID']) && $_SESSION['TeacherID'] != "") {
        unset($_SESSION['TeacherID']);
    }
    header('Location: ../index.php');
?>