    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
  </head>

  <body>
    <div class="wrapper">
      <aside id="sidebar" class="js-sidebar">
        <!-- Nội dung thanh sidebar -->
        <div class="h-100">
          <div class="sidebar-logo">
            <a href="index.php" id=""><img class="rounded-circle mx-1" src="view/layout/assets/images/logo.png" alt="Logo" width="40px"/>LLTT System</a>
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
              </ul>
            </li>
            <!-- Chuc nang chung, Giang vien se la nguoi co chuc nang nay -->
            <li class="sidebar-item">
              <a href="#" class="sidebar-link collapsed" data-bs-target="#options" data-bs-toggle="collapse" aria-expanded="false">
                <i class="fa-solid fa-list pe-2"></i>Chức năng chính
              </a>
              <ul id="options" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                  <a href="#" class="sidebar-link">Quản lý lịch thực hành</a>
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
              <a href="index.php?pg=schedule_watching" class="sidebar-link">
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
              <!-- <li class="nav-item dropdown">
                            <a href="" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <p class="login-sign text-black mt-2">Xin chào, Admin <i class="fa-solid fa-chevron-down pe-2"></i></p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Hồ sơ cá nhân</a>
                                <a href="#" class="dropdown-item">Cài đặt</a>
                                <a href="./login-form.html" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </li> -->
              <li class="login-sign">
                <a href="view/login-form.php" class="text-primary"><i class="fa-solid fa-right-to-bracket pe-2"></i>Đăng nhập</a>
              </li>
            </ul>
          </div>
        </nav>