<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LLTT System</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/normalscheduleshow.css">
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
              <li class="login-sign">
                <a href="index.php?pg=login-form" class="text-primary"><i class="fa-solid fa-right-to-bracket pe-2"></i>Đăng nhập</a>
              </li>
            </ul>
          </div>
        </nav>