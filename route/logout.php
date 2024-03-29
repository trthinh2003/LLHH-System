<?php
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        unset($_SESSION['AdminName']);
    }
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName'] != "") {
        unset($_SESSION['TeacherName']);
    }
    header('Location: ../index.php');
?>