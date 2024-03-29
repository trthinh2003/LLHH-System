<?php
    ob_start();
    session_start();
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName']) {
        $teacher = $_SESSION['TeacherName'];
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Xem lịch thực hành</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--FullCalendar-->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <script src="plugins/fullcalendar/main.js"></script>
    <script src="view/layout/assets/js/schedule_show.js"></script>    
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <style>
    .fc-timegrid-slots td[data-time^="07"],
    .fc-timegrid-slots td[data-time^="08"],
    .fc-timegrid-slots td[data-time^="09"],
    .fc-timegrid-slots td[data-time^="10"],
    .fc-timegrid-slots td[data-time^="11"],
    .fc-timegrid-slots td[data-time^="13"],
    .fc-timegrid-slots td[data-time^="14"],
    .fc-timegrid-slots td[data-time^="15"],
    .fc-timegrid-slots td[data-time^="16"],
    .fc-timegrid-slots td[data-time^="17"],
    .fc-timegrid-slots td[data-time^="18"] {
      border-top: none; 
    } 
    .fc-timegrid-slots td[data-time^="11"] {
      border-bottom: none;
    }

    .fc-timegrid-event-harness {
      margin-bottom: 5px; /* Khoảng cách giữa các sự kiện */
    }
    .fc-event {
      overflow: visible; /* Hiển thị nội dung vượt ra ngoài ranh giới của sự kiện */
      z-index: 1; /* Đảm bảo sự kiện hiển thị trên các sự kiện khác */
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }
    
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 50%;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
  </style>
  </head>

  <body>
    <div class="wrapper">
      <aside id="sidebar" class="js-sidebar">
        <!-- Nội dung thanh sidebar -->
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
            <div class="card-body">
                <div class="container p-5">
                    <div id="calendar"></div>  
                    <div id="eventModal" class="modal">
                      <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2 class="text-center">Sửa sự kiện</h2>
                        <p class="fw-bold">Tên sự kiện cũ</p><input type="text" id="eventTitle" placeholder="Nhập title mới">
                        <button id="saveEvent" class="btn btn-primary my-3">Lưu</button>
                      </div>
                    </div>          
                </div>
            </div>
        </main>
        <!-- Chế độ sáng tối của trình duyệt -->
        <a href="#" class="theme-toggle">
          <i class="fa-regular fa-moon" title="Chế độ tối"></i>
          <i class="fa-solid fa-sun" title="Chế độ sáng"></i>
        </a>