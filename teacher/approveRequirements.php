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

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kiểm tra các yêu cầu</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
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
                                <a href="index.php?pg=approveRequirements" class="sidebar-link">Kiểm tra các yêu cầu</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="index.php?pg=schedule_registration" class="sidebar-link">Đăng ký yêu cầu thực hành</a>
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
                                <a href="route/logout.php" class="dropdown-item">Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Phan noi dung -->
            <main class="content px-3 py-2">

            <div class="container-fluid" id="divchinh">
                <h1 class="row justify-content-center align-items-center fw-bold my-2">Kiểm Tra Yêu Cầu Thực Hành</h1>
                <h5 class="row justify-content-center align-items-center my-4" id="l"></h5>
                <div class="row justify-content-center align-items-left" style="color: darkturquoise;">Yêu cầu chờ duyệt</div>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <table class="table table-hover align-items-center justify-content-center" id="bang">
                            <thead>
                                <tr>
                                    <th class="text-center">Lớp học phần</th>
                                    <th class="text-center">Tuần yêu cầu</th>
                                    <th class="text-center">Trạng thái</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                    <div class="col-10">
                        <br>
                        <div class="row justify-content-center align-items-left" style="color: darkturquoise;">Yêu cầu duyệt không thành công</div>
                        <table class="table table-hover align-items-center justify-content-center" id="bang1">
                            <thead>
                                <tr>
                                    <th class="text-center">Lớp học phần</th>
                                    <th class="text-center">Tuần yêu cầu</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Hủy yêu cầu</th>
                                </tr>
                            </thead>


                        </table>
                    </div>
                    <div class="row justify-content-center">
                        

                    </div>
                </div>
            </div>
            <script>
                console.log(chuaduyet)
                var jsVar;
                var chuaduyet;
                var p = document.getElementById('bang1');
                p.addEventListener("click", xoa);

                function xoa(event) {
                if (event.target.tagName == 'I') {
                    var k=confirm('Bạn có chắc xóa yêu cầu không không');
                if(k==true){
                    var c = event.target.parentNode.parentNode.parentNode;
                    
                        var ngay = chuaduyet[c.rowIndex - 1].TUANHOC_LIST.split(',').map(function(item) {
                            return item.trim();
                        });
                        for(u=0;u<ngay.length;u++){
                            var dt={
                                mhp: chuaduyet[c.rowIndex-1].MAHOCPHAN,
                                nhom: chuaduyet[c.rowIndex-1].TENNHOM,
                                hocki: chuaduyet[c.rowIndex-1].HOCKI,
                                namhoc: chuaduyet[c.rowIndex-1].NAMHOC,
                                tuan: ngay[u]
                            }
                            fetch('route/insert1.php?a=7', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(dt)
                    })
                    .then(response => response.json())
                    .then(data => {
                        null;
                    })
                    .catch(error => {
                        null;
                    });
                        
                        }
                        c.parentNode.removeChild(c);
                    chuaduyet.splice(c.rowIndex - 1, 1);
                }                           
                }
                }

                function nek() {
                    console.log("test");
                    fetch('route/insert1.php?a=5')
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            localStorage.setItem('ten', JSON.stringify(data));
                        })
                        .catch(error => console.error('Error:', error));
                }
                nek();
                jsVar = JSON.parse(localStorage.getItem('ten'));
                localStorage.removeItem('ten');
                console.log("test");
                fetch('route/insert1.php?a=4&tt=Chờ duyệt', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(jsVar)
                    })
                    .then(response => response.json())
                    .then(data => {
                        var bien = data;
                        document.getElementById('l').innerHTML = 'Hoc kỳ: ' + data[0].HOCKI + ' - Năm học: ' + data[0].NAMHOC;
                        for (u = 0; u < bien.length; u++) {

                            var hang1 = document.createElement('TD');
                            hang1.innerHTML = bien[u].MAHOCPHAN + '-' + bien[u].TENNHOM;
                            hang1.classList.add("text-center");
                            var hang2 = document.createElement('TD');
                            hang2.innerHTML = bien[u].TUANHOC_LIST;
                            hang2.classList.add("text-center");
                            var hang3 = document.createElement('TD');
                            hang3.innerHTML = bien[u].TRANGTHAI;
                            hang3.classList.add("text-center");
                            var b = document.createElement('TR');
                            b.appendChild(hang1);
                            b.appendChild(hang2)
                            b.appendChild(hang3)
                            document.getElementById('bang').appendChild(b);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                fetch('route/insert1.php?a=4&tt=Chưa duyệt', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(jsVar)
                    })
                    .then(response => response.json())
                    .then(data => {
                        localStorage.setItem('ten2', JSON.stringify(data));
                        chuaduyet = JSON.parse(localStorage.getItem('ten2'));
                        localStorage.removeItem('ten2');
                        var bien = data;
                        console.log(data);
                        document.getElementById('l').innerHTML = 'Hoc kỳ: ' + data[0].HOCKI + ' - Năm học: ' + data[0].NAMHOC;
                        for (u = 0; u < bien.length; u++) {

                            var hang1 = document.createElement('TD');
                            hang1.innerHTML = bien[u].MAHOCPHAN + '-' + bien[u].TENNHOM;
                            hang1.classList.add("text-center");
                            var hang2 = document.createElement('TD');
                            hang2.innerHTML = bien[u].TUANHOC_LIST;
                            hang2.style.color = 'red';
                            hang2.classList.add("text-center");
                            var hang3 = document.createElement('TD');
                            hang3.innerHTML = bien[u].TRANGTHAI;
                            hang3.classList.add("text-center");
                            var hang4 = document.createElement('TD');
                            hang4.innerHTML = `<span><i class="fa fa-trash" aria-hidden="true"></i></span>`;
                            hang4.classList.add('text-center');
                            var b = document.createElement('TR');
                            b.appendChild(hang1);
                            b.appendChild(hang2)
                            b.appendChild(hang3)

                            b.appendChild(hang4)
                            document.getElementById('bang1').appendChild(b);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            </script>
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



        

