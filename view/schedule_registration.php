    <title>Đăng ký lịch thực hành</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--FullCalendar-->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <script src="plugins/fullcalendar/main.js"></script>
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

        <!-- Phan noi dung -->
        <main class="content px-3">
          <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-md-8 m-2">
                  <form class="row p-3" action="" novalidate>
                    <div class="m-1">
                      <h1 class="text-center fw-bold">ĐĂNG KÝ LỊCH THỰC HÀNH</h1>
                    </div>
                    <!-- Họ tên giảng viên -->
                    <div class="col-md-12 m-2">
                      <div class="row">
                        <!-- First Name -->
                        <div class="col">
                          <label for="full-name" class="form-label fw-bold">Họ tên giảng viên <span class="text-danger">*</span></label>
                          <input type="text" class="form-control border-dark" placeholder="Họ tên giảng viên" id="full-name" required />
                          <div class="valid-feedback">Full name validated</div>
                          <div class="invalid-feedback">Xin hãy điền họ tên của bạn</div>
                        </div>
                      </div>
                    </div>
                    <!-- Email -->
                    <div class="col-md-12 m-2">
                      <label for="email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control border-dark" placeholder="Email" id="email" required />
                      <div class="valid-feedback">Email validated</div>
                      <div class="invalid-feedback">Xin hãy điền email của bạn</div>
                    </div>
                    <!-- Lớp học phần đăng ký, Buổi học, Ngày học -->
                    <div class="col-md-12 m-2">
                      <div class="row">
                        <div class="col-sm-6 col-md-6 col-xl-4">
                          <label for="class-register" class="form-label fw-bold">Lớp học phần đăng ký <span class="text-danger">*</span></label>
                          <input type="text" name="" class="form-control border-dark" placeholder="VD: CT29903" id="class-register" required />
                          <div class="valid-feedback">Class register validated</div>
                          <div class="invalid-feedback">Xin hãy điền tên lớp học phần</div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xl-4">
                          <label for="lesson-time-choice" class="form-label fw-bold">Buổi học <span class="text-danger">*</span></label>
                          <select name="lesson-time" id="" class="form-select border-dark" required>
                            <option value=""></option>
                            <option name="lesson-time" value="1">Sáng</option>
                            <option name="lesson-time" value="2">Chiều</option>
                            <option name="lesson-time" value="3">Tối</option>
                          </select>
                          <div class="valid-feedback">Lesson time validated</div>
                          <div class="invalid-feedback">Xin hãy chọn buổi học của bạn</div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xl-4">
                          <label for="practice-date" class="form-label fw-bold">Ngày thực hành <span class="text-danger">*</span></label>
                          <input type="date" class="form-control border-dark" placeholder="VD: CT29903" id="practice-date" required />
                          <div class="valid-feedback">Practice date validated</div>
                          <div class="invalid-feedback">Xin hãy điền ngày thực hành</div>
                        </div>
                      </div>
                    </div>
                    <!-- select -->
                    <div class="col-md-12 m-2">
                      <div class="row">
                        <div class="col">
                          <label for="semester-choice" class="form-label fw-bold">Học kì <span class="text-danger">*</span></label>
                          <select name="semester" id="" class="form-select border-dark" required>
                            <option value=""></option>
                            <option name="semester" value="1">1</option>
                            <option name="semester" value="2">2</option>
                          </select>
                          <div class="valid-feedback">Semester validated</div>
                          <div class="invalid-feedback">Xin hãy chọn học kì</div>
                        </div>
                        <div class="col">
                          <label for="school-year-choice" class="form-label fw-bold">Năm học <span class="text-danger">*</span></label>
                          <select name="school-year" id="" class="form-select border-dark" required>
                            <option value=""></option>
                            <option name="school-year" value="1">2023 - 2024</option>
                            <option name="school-year" value="2">2024 - 2025</option>
                            <option name="school-year" value="3">2025 - 2026</option>
                          </select>
                          <div class="valid-feedback">School year validated</div>
                          <div class="invalid-feedback">Xin hãy chọn năm học</div>
                        </div>
                      </div>
                    </div>
                    <!-- Yêu cầu phần mềm -->
                    <div class="col-md-12 m-2">
                      <div class="row">
                        <!-- First Name -->
                        <div class="col">
                          <label for="software-require" class="form-label fw-bold">Yêu cầu phần mềm từ phía giảng viên</label>
                          <input type="text" class="form-control border-dark" placeholder="VD: StarUML, VS Code,..." id="software-require" required />
                          <div class="valid-feedback">Software require validated</div>
                          <div class="invalid-feedback">Điền tên phần mềm yêu cầu</div>
                        </div>
                      </div>
                    </div>      
                    <!-- submit -->
                    <div class="col-md-12 m-2 d-flex">
                      <input type="submit" id="submitBtn" name="submitRegister" class="btn btn-primary mt-3 mx-auto border-black" value="Xác nhận đăng ký">
                    </div>
                  </form>
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
