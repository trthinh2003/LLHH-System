<?php
    ob_start();
    session_start();
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName'] != "") {
        $teacher = $_SESSION['TeacherName'];
    }
    else {
        header('Location: index.php');
    }
    $result_all = layTTProfileGV($teacher);
    foreach ($result_all as $row) {
        $khoa = $row['TENKHOA'];
        $email = $row['EMAIL'];
        $trinhdochuyenmon = $row['TRINHDOCHUYENMON'];
        $hocham = $row['HOCHAM'];
        $ngachvienchuc = $row['NGACHVIENCHUC'];
        $sodienthoai = $row['SODIENTHOAI'];
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hồ sơ cá nhân</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <style>
        .profile-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-left {
            flex-basis: 30%;
            text-align: center;
        }

        .profile-right {
            flex-basis: 65%;
        }

        .profile-image img {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-job {
            margin-top: 20px;
        }

        .profile-job p {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .profile-info h1 {
            font-size: 28px;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .profile-info p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .profile-info a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .profile-info a:hover {
            color: #0056b3;
        }

        #editButton, #updateButton {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        #editButton:hover, #updateButton:hover {
            background-color: #0056b3;
        }

        #updateButton{
            display: none;
        }
    </style>
  </head>

    <body>
    <div class="wrapper">
        <!-- Nội dung thanh sidebar -->
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="index.php?pg=teacher" id=""><img class="rounded-circle mx-1" src="view/layout/assets/images/logo.png" alt="Logo" width="40px"/>LLTT System</a>
                </div>
                <ul class="sidebar-nav mx-0">
                    <li class="sidebar-header">Menu Chính</li>
                    <!-- Chuc nang chung, Giang vien se la nguoi co chuc nang nay -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#options" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>Chức năng chính
                        </a>
                        <ul id="options" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="index.php?pg=class_show" class="sidebar-link">Xem các lớp học phần</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=lab_view" class="sidebar-link">Xem thông tin phòng máy</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=schedule_registration" class="sidebar-link">Đăng ký lịch thực hành</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Thống kê số tiết dạy</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Chuc nang xem lich TH, chuc nang nay ca QTHT, Giang vien va Sinh vien deu co the xem duoc -->
                    <li class="sidebar-item">
                        <a href="index.php?pg=schedule_watching_teacher" class="sidebar-link">
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
                                            <img class="rounded-circle mx-1" src="view/layout/assets/images/teacher_avatar.jpg" alt="Logo" width="40px"/>
                                            Xin chào, GV. <?=$teacher;?> 
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
                    <div class="profile-container">
                        <div class="profile-left">
                            <div class="profile-image">
                                <img id="profileImage" src="view/layout/assets/images/teacher_avatar.jpg" alt="Hình ảnh giảng viên">
                                <input type="file" id="imageInput" accept="image/*" style="display: none;"">
                            </div>
                            <div class="profile-job">
                                <p><strong>GV. <?=$teacher?></strong></p>
                            </div>
                        </div>
                        <div class="profile-right">
                            <form action=""></form>
                            <div class="profile-info">
                                <h1>Hồ sơ cá nhân</h1>
                                <p><strong>Khoa:</strong> <?=$khoa;?></p>
                                <p><strong>Email:</strong> <?=$email;?></p>
                                <p><strong>Trình Độ Chuyên Môn:</strong> <?=$trinhdochuyenmon;?></p>
                                <p><strong>Học Hàm:</strong> <?=$hocham;?></p>
                                <p><strong>Ngạch Viên Chức:</strong> <?=$ngachvienchuc;?></p>
                                <p><strong>Số Điện Thoại:</strong> <?=$sodienthoai;?></p>
                                <p><strong>Website:</strong> <a href="https://www.ctu.edu.vn/" target="_blank">Đại học Cần Thơ</a></p>
                                <p><strong>Khoa nghiên cứu:</strong> <a href="https://cit.ctu.edu.vn/" target="_blank">Trường công nghệ thông tin và truyền thông</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
            <i class="fa-regular fa-moon" title="Chế độ tối"></i>
            <i class="fa-solid fa-sun" title="Chế độ sáng"></i>
            </a>
            <!-- footer -->
            <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                <div class="col-6 text-start">
                    <p class="mb-0">
                    <a href="#" class="text-muted">
                        <strong>LLTT System</strong>
                    </a>
                    </p>
                </div>
                <div class="col-6 text-end">
                    <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="text-muted">Liên hệ</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-muted">Về chúng tôi</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </footer>
        </div>
    </div>
    <script src="view/layout/assets/js/sidebar.js"></script>
    <script src="view/layout/assets/js/darklightmode.js"></script>
  </body>
</html>
