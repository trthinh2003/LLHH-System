<?php
    ob_start();
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        $admin = $_SESSION['AdminName'];
    }
    else {
        header('Location: index.php');
    }
    if (isset($_SESSION['soluongYC']) && $_SESSION['soluongYC'] != 0) $divYC = '<div class="shadow-lg text-center fw-bold me-5 mt-1" style="width: 1.15rem; font-size: 0.5rem;">
                                                                                    <div class="p-1 bg-danger text-white rounded-circle">'.$_SESSION['soluongYC'].'</div></div>';
    else {
        $divYC = '<span style="display: none"></span>';
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

        /* Toast message*/
        .move-from-top {
            position: fixed;
            top: 0;
            right: calc(50% - 150px);
            z-index: 99999;
            animation: moveFromTop 0.5s forwards;
        }

        @keyframes moveFromTop {
            from {
                transform: translateY(0%);
                opacity: 0;
            }
            to {
                transform: translateX(0%);
                opacity: 1;
            }
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
                            <li class="sidebar-item d-flex align-items-center justify-content-between">
                                <a href="index.php?pg=requirements_manage" class="sidebar-link">Quản lý yêu cầu</a>
                                <?=$divYC;?>
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
                        <li class="nav-item dropdown">
                            <a href="" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                            <p class="login-sign text-black mt-2">
                            <img class="rounded-circle mx-1" src="view/layout/assets/images/admin_avatar.jpg" alt="Logo" width="40px"/>
                                Xin chào, <?=$admin;?> 
                                <i class="fa-solid fa-chevron-down pe-2"></i></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="top: 55px;">
                            <a href="index.php?pg=admin_profile" class="dropdown-item">Hồ sơ cá nhân</a>
                                <a href="route/logout.php" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Phan noi dung -->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="profile-container">
                    <div class="profile-left">
                        <div class="profile-image">
                            <img id="profileImage" src="view/layout/assets/images/avatar.jpg" alt="Hình ảnh admin">
                            <input type="file" id="imageInput" accept="image/*" style="display: none;">
                        </div>
                        <div class="profile-job">
                            <p><strong>Admin</strong></p>
                        </div>
                    </div>
                        <div class="profile-right">
                            <div>
                                <h1>Hồ sơ cá nhân</h1>
                                <div class="profile-info">
                                    <p><strong>Email:</strong> kcntt@ctu.edu.vn</p>
                                    <p><strong>Tên đăng nhập:</strong> admin</p>
                                    <p><strong>Mật khẩu:</strong> *******</p>
                                    <p><strong>Website:</strong> <a href="https://www.ctu.edu.vn/" target="_blank">Đại học Cần Thơ</a></p>
                                    <p><strong>Công tác tại:</strong> <a href="https://cit.ctu.edu.vn/" target="_blank">Trường Công Nghệ Thông Tin và Truyền Thông</a></p>
                                </div>
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
