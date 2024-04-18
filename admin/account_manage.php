<?php
    ob_start();
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        $admin = $_SESSION['AdminName'];
    }
    else {
        header('Location: index.php');
    }
    if (isset($_SESSION['successAddAccount']) && $_SESSION['successAddAccount'] != "") {
        if ($_SESSION['successAddAccount'] == "Thêm tài khoản thành công!") {
            $successAddAccount = '<div class="shadow-lg p-2 move-from-top js-div-dissappear" style="width: 17rem; display:none;">
                                <i class="fa-solid fa-check p-2 bg-success text-white rounded-circle pe-2 mx-2"></i>'.$_SESSION['successAddAccount'].'
                               </div>';
            unset($_SESSION['successAddAccount']);
        }
    }
    if (isset($_SESSION['deleteAccountSuccess']) && $_SESSION['deleteAccountSuccess'] != "") {
        if ($_SESSION['deleteAccountSuccess'] == "Xóa tài khoản thành công!") {
            $deleteAccountSuccess = '<div class="shadow-lg p-2 move-from-top js-div-dissappear" style="width: 17rem; display:none;">
                                <i class="fa-solid fa-check p-2 bg-success text-white rounded-circle pe-2 mx-2"></i>'.$_SESSION['deleteAccountSuccess'].'
                               </div>';
            unset($_SESSION['deleteAccountSuccess']);
        }
    }
    $tr = "";
    $i = 1;
    $result_all = layTTTaiKhoan();
    if ($result_all == 0) $result_all = [];
    foreach ($result_all as $row) {
        if ($row['ROLE'] == 1) {
            $loaitaikhoan = "Admin";
            $email = "kcntt@ctu.edu.vn";
            $tdXoa = "";
        }
        else {
            $loaitaikhoan = "Giảng viên";
            $email = layEmailGV($row['TAIKHOAN_ID']);
            $tdXoa = '<td class="del text-center p-0">
                        <form method="post" action="route/delete_account.php">
                            <input class="btn btn-success" type="submit" name="delBtn" value="Xóa"/>
                            <input type="hidden" name="taikhoan_id" value="'.$row['TAIKHOAN_ID'].'"/>
                        </form>
                      </td>';
        }
        $tr .= '<tr>
                    <td>'.$i.'</td>
                    <td>TK'.$row['TAIKHOAN_ID'].'</td>
                    <td>'.$row['TENDANGNHAP'].'</td>
                    <td>*********</td>
                    <td>'.$email.'</td>
                    <td>'.$loaitaikhoan.'</td>
                    '.$tdXoa.'                 
                </tr>';
        $i++;        
    }
    $cacKhoa = selectOptKhoa();
    $optKhoa = "";
    foreach ($cacKhoa as $row) {
        $optKhoa .= '<option name="departmentName" value="'.$row['TENKHOA'].'">'.$row['TENKHOA'].'</option>';
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
    <title>Quản lý tài khoản</title>
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

        .del {
            cursor: pointer;
        }

        /* Toast message khi thêm tài khoản thành công */
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

        /* Modal Thêm tài khoản */
        .modalThemTK {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            align-items: center;
            justify-content: center;
            display: none;
            z-index: 100;
        }

        .modalThemTK.open {
            display: flex;
        }

        .modal-container {
            background-color: #fff;
            width: 500px;
            border-radius: 10px;
            max-width: calc(100% - 32px);
            min-height: 200px;
            position: relative;
            animation: modalFadeIn ease 0.5s;
        }

        .modal-close {
            position: absolute;
            right: 0;
            top: 0;
            padding: 14px;
            font-size: 1.15rem;
            cursor: pointer;
            opacity: 0.8;
        }

        .modal-close:hover {
            opacity: 1;
        }

        .modal-header i {
            margin-right: 16px;
        }

        .modal-body {
            padding: 16px;
        }

        .modal-label {
            display: block;
            font-size: 15px;
            margin-bottom: 3px;
        }

        .modal-input {
            border: 1px solid #ccc;
            width: 100%;
            padding: 10px;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .modal-footer {
            text-align: right;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-140px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
                    <h2 class="manage text-center fw-bold mt-5">QUẢN LÝ TÀI KHOẢN</h2>
                    <div class="card border-0 mt-5">
                        <!-- Thêm tài khoản -->
                        <div class="my-2 d-flex justify-content-between">
                            <div></div>
                            <button  class="add btn btn-primary mx-3 text-end" >
                                <i class="fa-solid fa-plus p-0"></i>
                                <input class="btn btn-primary p-0 addAccount-modal-js" name="addAccountBtn" type="button" value="Thêm Tài Khoản"/>
                            </button> 
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID Tài khoản</th>
                                    <th class="text-center">Tên đăng nhập</th>
                                    <th class="text-center">Mật khẩu</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Loại tài khoản</th>
                                    <th class="text-center">Chọn</th>
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
            <!--Modal Thêm tài khoản-->
            <form class="modalThemTK js-modal" action="route/addaccount.php" method="post">
                <div class="modal-container js-modal-container p-3">
                    <div class="modal-close js-modal-close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="modal-header d-flex align-item-center justify-content-center fw-bold" style="font-size: 1.5rem">
                        Thêm Tài Khoản
                    </div>
                    <div class="modal-body modalThem-body">
                        <!-- Tên đăng nhập -->
                        <label class="modal-label" for="account-username">
                            Tên đăng nhập <span class="text-danger">(*)</span>
                        </label>
                        <input id="account-username" name="usernameAccount" type="text" class="w-100 m-0 mb-3 text-dark" required>
                        <!-- Mật khẩu -->
                        <label class="modal-label" for="account-password">
                            Mật khẩu <span class="text-danger">(*)</span>
                        </label>
                        <input id="account-password" name="passwordAccount" type="password" class="w-100 m-0 mb-3 text-dark" required>
                        <!-- Xác nhận lại mật khẩu -->
                        <label class="modal-label" for="confirm-password">
                            Xác nhận lại mật khẩu <span class="text-danger">(*)</span>
                        </label>
                        <input id="confirm-password" name="confirmAccount" type="password" class="w-100 m-0 mb-3 text-dark" required>
                        <div class="row">
                            <div class="col-9">
                                <!-- Họ tên giảng viên -->
                                <label class="modal-label" for="teacher-Name">
                                    Họ và tên giảng viên <span class="text-danger">(*)</span>
                                </label>
                                <input id="teacher-Name" name="teacherName" type="text" class="w-100 m-0 mb-3 text-dark" required>
                            </div>
                            <div class="col-3">
                                <!-- Giới tính -->
                                <label class="modal-label" for="sex-opt">
                                    Giới tính
                                </label>
                                <select id="sex-opt" name="sex_opt" class="modal-input">
                                    <option name="sex_opt" value="Nam">Nam</option>
                                    <option name="sex_opt" value="Nữ">Nữ</option>
                                </select>                            
                            </div>
                        </div>
                        <!-- Khoa giảng dạy -->
                        <label class="modal-label" for="department-teaching">
                            Khoa giảng dạy
                        </label>
                        <select id="department-chosen" name="departmentName" class="modal-input">
                            <option value="Chọn khoa">Chọn khoa</option>
                            <?=$optKhoa;?>
                        </select>
                        <div class="row">
                            <div class="col-7">
                                <!-- Email -->
                                <label class="modal-label" for="email-teacher">
                                    Email <span class="text-danger">(*)</span>
                                </label>
                                <input id="email-teacher" name="emailTeacher" type="email" class="w-100 m-0 mb-3 text-dark" required>
                            </div>
                            <div class="col-5">
                                <!-- Số điện thoại -->
                                <label class="modal-label" for="phoneNumber-teacher">
                                    Số điện thoại <span class="text-danger">(*)</span>
                                </label>
                                <input id="phoneNumber-teacher" name="phoneNumberTeacher" type="text" class="w-100 m-0 mb-3 text-dark" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success me-3 my-2" name="addAccountSubmit" value="Thêm"/>
                    </div>
                </div>
            </form>
            <?php if(isset($successAddAccount)) echo $successAddAccount;?>
            <?php if(isset($deleteAccountSuccess)) echo $deleteAccountSuccess;?>
            <script>
                const buyBtns = document.querySelectorAll('.addAccount-modal-js')
                const modal = document.querySelector('.js-modal')
                const modalContainer = document.querySelector('.js-modal-container')
                const modalClose = document.querySelector('.js-modal-close')

                function showBuyProduct() {
                    modal.classList.add('open')
                }

                function hideBuyProduct() {
                    modal.classList.remove('open')
                }

                for (const buyBtn of buyBtns) {
                    buyBtn.addEventListener('click', showBuyProduct);
                }

                modalClose.addEventListener('click', hideBuyProduct);
            </script>
            <script>
                var toastMes = document.querySelector('.js-div-dissappear');
                toastMes.style.display = "block";
                setTimeout(function(){
                    toastMes.style.display = "none";
                }, 3000);
                console.log(toastMes);
            </script>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon" title="Chế độ tối"></i>
                <i class="fa-solid fa-sun" title="Chế độ sáng"></i>
            </a>