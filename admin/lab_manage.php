<?php
    ob_start();
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        $admin = $_SESSION['AdminName'];
    }
    else {
        header('Location: index.php');
    }
    $tr = "";
    $i = 1;
    $result_all = layTTPhongHocKemCauHinhMay();
    foreach ($result_all as $row) {
        $tr .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['MAPHONGHOC'].'</td>
                    <td>'.$row['SUCCHUA'].'</td>
                    <td>CPU: '.$row['CPU'].' - RAM: '.$row['RAM'].' - SSD: '.$row['SSD'].'</td>
                    <td class="edit text-center p-0">
                        <form method="post" action="sua.php">
                        <input class="btn btn-success" type="submit" name="editBtn" value="Sửa"/>
                        <input type="hidden" name="maphonghoc" value="'.$row['MAPHONGHOC'].'"/>
                        </form>
                    </td>      
                    <td class="del text-center p-0">
                        <form method="post" action="route/delete_lab.php">
                        <input class="btn btn-primary" type="submit" name="delBtn" value="Xóa"/>
                        <input type="hidden" name="maphonghoc" value="'.$row['MAPHONGHOC'].'"/>
                        </form>
                    </td>                    
                </tr>';
        $i++;        
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý phòng học</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <style>
        main.content {
            display: flex;
            justify-content: flex-start; /* phía trên */
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .table {
            width: 100%;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: rgb(240, 240, 240);
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .table_header p {
            color: #0298cf;
            font-weight: bold;
            font-size: 1.5em; 
        }

        button:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        .add_new {
            padding: 10px 20px;
            color: white;
            background-color: #0298cf;
            font-size: 1.2em; 
            transition: background-color 0.3s ease;
        }

        .add_new:hover {
            background-color: #007bff;
        }

        input {
            padding: 10px 10px;
            margin: 0 10px;
            outline: none;
            border: 1px solid #0298cf;
            border-radius: 6px;
            color: #0298cf;
            font-size: 1.2em; /* Kích thước font lớn hơn */
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
        }

        td img {
            width: 36px;
            height: 36px;
            margin-right: .5rem;
            border-radius: 50%;
            vertical-align: middle;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 15px; /* Kích thước padding lớn hơn */
            text-align: left;
            border: 1px solid #e1e1e1;
            font-size: 1.2em; /* Kích thước font lớn hơn */
        }

        table th {
            background-color: #f5f5f5;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        .table_body {
            width: 100%;
            max-height: calc(89vh - 160px);
            /* margin-top: 20px; */
            border-radius: .6rem;
            overflow: auto;
        }

        .edit, .del {
            cursor: pointer;
        }
    </style>
  </head>

  <body>
    <div class="wrapper">
        <!-- Nội dung thanh sidebar -->
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="index.php?pg=admin" id=""><img class="rounded-circle mx-1" src="view/layout/assets/images/logo.png" alt="Logo" width="40px"/>LLTT System</a>
                </div>
                <ul class="sidebar-nav mx-0">
                    <li class="sidebar-header">Menu Chính</li>
                    <!-- Cac chuc nang cua Quan tri he thong -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-screwdriver-wrench pe-2"></i>Quản trị hệ thống
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="index.php?pg=account_manage" class="sidebar-link">Quản lý tài khoản</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=lab_manage" class="sidebar-link">Quản lý phòng học</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=software_manage" class="sidebar-link">Quản lý phần mềm</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=requirements_manage" class="sidebar-link">Quản lý yêu cầu</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Chuc nang xem lich TH, chuc nang nay ca QTHT, Giang vien va Sinh vien deu co the xem duoc -->
                    <li class="sidebar-item">
                        <a href="index.php?pg=schedule_watching_admin" class="sidebar-link">
                            <i class="fa-solid fa-calendar-days pe-2"></i>
                            Xem lịch thực hành
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom border-black">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                    <!-- <li class="nav-item dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                        <img src="assets/images/avatar.jpg" class="avatar img-fluid rounded" alt="">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">Hồ sơ cá nhân</a>
                                        <a href="#" class="dropdown-item">Cài đặt</a>
                                        <a href="./login-form.html" class="dropdown-item">Đăng xuất</a>
                                    </div>
                                </li> -->
                                <li class="nav-item dropdown">
                                    <a href="" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                        <p class="login-sign text-black mt-2">
                                            <img class="rounded-circle mx-1" src="view/layout/assets/images/admin_avatar.jpg" alt="Logo" width="40px"/>
                                            Xin chào, <?=$admin;?> 
                                            <i class="fa-solid fa-chevron-down pe-2"></i></p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="top: 55px;">
                                        <a href="#" class="dropdown-item">Hồ sơ cá nhân</a>
                                        <a href="#" class="dropdown-item">Cài đặt</a>
                                        <a href="route/logout.php" class="dropdown-item">Đăng xuất</a>
                                    </div>
                                </li>
                        <!-- <li class="login-sign">
                            <a href="view/login-form.php" class="text-primary"><i class="fa-solid fa-right-to-bracket pe-2"></i>Đăng nhập</a>
                        </li> -->
                    </ul>
                </div>
            </nav>
            <!-- Phan noi dung -->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <h2 class="manage text-center fw-bold mt-5">QUẢN LÝ PHÒNG HỌC</h2>
                    <div class="card border-0 mt-5">
                        <!-- Thêm phòng học -->
                        <div class="my-2 d-flex justify-content-between">
                            <div></div>
                            <form action="addLab.php" method="post">
                                <button  class="add btn btn-primary mx-3 text-end" >
                                    <i class="fa-solid fa-plus p-0"></i>
                                    <input class="btn btn-primary p-0" name="addLabBtn" type="submit" value="Thêm Phòng Học"/>
                                </button> 
                            </form>
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Phòng học</th>
                                    <th>Sức chứa</th>
                                    <th class="text-center">Cấu hình máy</th>
                                    <th colspan="2" class="text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?=$tr;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>      
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon" title="Chế độ tối"></i>
                <i class="fa-solid fa-sun" title="Chế độ sáng"></i>
            </a>



        

