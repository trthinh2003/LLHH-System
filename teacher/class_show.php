<?php
    ob_start();
    session_start();
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName'] != "") {
        $teacher = $_SESSION['TeacherName'];
    }
    else {
        header('Location: index.php');
    }
    if (isset($_SESSION['TeacherID']) && $_SESSION['TeacherID'] != "") {
        $teacherID = $_SESSION['TeacherID'];
    }
    $tr = "";
    $i = 1;
    $result_all = layTTLopHocPhan($teacherID, $teacher);
    foreach ($result_all as $row) {
        $tr .= '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['MAHOCPHAN'].'</td>
                    <td>'.$row['TENHOCPHAN'].'</td>
                    <td>0'.$row['TENNHOM'].'</td>
                    <td>'.$row['THU'].'</td>
                    <td>'.$row['SISO'].'</td>
                    <td>'.$row['BUOIHOC'].'</td>
                    <td>'.$row['HOTENGIANGVIEN'].'</td>
                    <td>'.$row['HOCKI'].'</td>
                    <td>'.$row['NAMHOC'].'</td>
                    <td class="detailClassShow text-center">
                        <input class="btn btn-primary detail-modal-js" type="submit" name="detailClass" value="Xem chi tiết" data-bs-toggle="modal" data-bs-target="#exampleModal"/>
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
    <title>Xem các lớp học phần</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <style>
        .main {
            overflow: scroll;
        }

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

        .detailClassShow {
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
                        <li class="nav-item dropdown">
                            <a href="" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <p class="login-sign text-black mt-2">
                                    <img class="rounded-circle mx-1" src="view/layout/assets/images/teacher_avatar.jpg" alt="Logo" width="40px"/>
                                    Xin chào, GV. <?=$teacher;?> 
                                    <i class="fa-solid fa-chevron-down pe-2"></i>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="top: 55px;">
                                <a href="index.php?pg=teacher_profile" class="dropdown-item">Hồ sơ cá nhân</a>
                                <a href="#" class="dropdown-item">Cài đặt</a>
                                <a href="route/logout.php" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Phan noi dung -->
            <main class="content px-3 py-2">
                <div class="container-fluid col">
                    <h2 class="manage text-center fw-bold">THÔNG TIN CÁC LỚP HỌC PHẦN</h2>
                    <div class="card border-0 mt-5">
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã học phần</th>
                                    <th>Tên học phần</th>
                                    <th>Ký hiệu nhóm</th>
                                    <th>Thứ</th>
                                    <th>Sỉ số</th>
                                    <th>Buổi học</th>
                                    <th>Phụ trách giảng dạy</th>
                                    <th>Học kì</th>
                                    <th>Năm học</th>
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
        <!--Modal Xem chi tiết-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel">THÔNG TIN CHI TIẾT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody class="detail-info">
                                <!-- Các thông tin chi tiết sẽ được thêm vào đây bằng JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal -->
    <script>
        // Bắt sự kiện click vào nút "Xem chi tiết"
        var detailButtons = document.querySelectorAll('.detail-modal-js');
        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Lấy các thông tin từ thẻ td và th thẻ của hàng được click
                var row = button.closest('tr');
                var ths = document.querySelectorAll('th:not(:last-child)');
                var tds = row.querySelectorAll('td:not(:last-child)');
                var detailInfo = document.querySelector('.detail-info');
                detailInfo.innerHTML = ''; // Xóa nội dung cũ trước khi thêm mới
                // Thêm thông tin từ các th và td vào modal
                for (var i = 0; i < ths.length; i++) {
                    var detailItem = document.createElement('tr');
                    detailItem.innerHTML = '<td class="fw-bold">' + ths[i].textContent + '</td><td>' + tds[i].textContent + '</td>';
                    detailInfo.appendChild(detailItem);
                }
            });
        });
    </script>
    <script src="view/layout/assets/js/sidebar.js"></script>
    <script src="view/layout/assets/js/darklightmode.js"></script>
  </body>
</html>



        

