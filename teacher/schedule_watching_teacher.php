<?php
    ob_start();
    session_start();
    if (isset($_SESSION['TeacherName']) && $_SESSION['TeacherName']) {
        $teacher = $_SESSION['TeacherName'];
    }
?>

<?php
  $result_all = selectOptPhongHoc();
  $optLab = "";
  foreach ($result_all as $row) {
    $optLab .= '<option name="labName" value="'.$row['MAPHONGHOC'].'">'.$row['MAPHONGHOC'].'</option>';
  }
  $event = "";
  $thongTinAllLichTH = layDuLieuBangLichTH_hienthi_lenFullCalendar();
  if ($thongTinAllLichTH == 0) $thongTinAllLichTH = [];
  foreach($thongTinAllLichTH as $row1) {
    if ($row1['BUOIHOC'] == "Sáng") {
      $timeStart = "07:00:00";
      $timeEnd = "11:50:00";
    }
    else {
      $timeStart = "13:30:00";
      $timeEnd = "17:00:00";
    }
    $event .= '{
                "title": "'.$row1['MAPHONGHOC'].' - '.$row1['MAHOCPHAN'].'0'.$row1['TENNHOM'].' - '.$row1['TENHOCPHAN'].' - GV. '.$row1['HOTENGIANGVIEN'].'",
                "start": "'.$row1['NGAYHOC'].'T'.$timeStart.'",
                "end": "'.$row1['NGAYHOC'].'T'.$timeEnd.'",
                "period": "'.$row1['BUOIHOC'].'",
                "lab": "'.$row1['MAPHONGHOC'].'",
                "teacherName": "'.$row1['HOTENGIANGVIEN'].'"
              },';
  }
  $event = rtrim($event, ',');
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
      .fc-timegrid-slots td {
        padding: 80px;
      }

      .fc-timegrid-event-harness {
        margin-bottom: 5px; /* Khoảng cách giữa các sự kiện */
      }

      .fc-event {
        overflow: visible; /* Hiển thị nội dung vượt ra ngoài ranh giới của sự kiện */
        z-index: 1; /* Đảm bảo sự kiện hiển thị trên các sự kiện khác */
      }

      .fc .fc-timegrid-axis-cushion {
        display: none;
      }

      /* Modal */
      .modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
      }
      
      .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        animation: modalFadeIn ease 0.5s;
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

      .overlay-select {
        position: absolute;
        margin-top: 95px;
        margin-left: 40px;
        z-index: 20;
        border-radius: 5px;
      }
      @media (max-width:936px) {
        .overlay-select {
          margin-top: 145px;
          margin-left: 60px;
          z-index: 20;
          border-radius: 5px;
        }
      }

      @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-100px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
      }

      /* CSS cho bảng modal */
      .modal-content table {
        width: 100%;
        max-width: 1200px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      .modal-content table tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
      }
      .modal-content table tr td {
        padding: 0.5rem 0.5rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: var(--bs-border-width);
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        text-align: left;
        border: 1px solid #e1e1e1;
        font-size: 1.2em;
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
                    <i class="fa-solid fa-chevron-down pe-2"></i></p>
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
            <div class="card-body">
              <div class="container p-4">
                <h1 class="text-center fw-bold" style="font-size: 2.25rem">Xem lịch thực hành</h1>
                <div class="fst-italic text-end">(Lịch thực hành bắt đầu từ ngày 26-02-2024, Học kì 2, Năm học 2023 - 2024)</div>
                <div class="mb-4 mt-2">
                  <label class="text-dark" for="search" style="font-size: 1.05rem;">Tìm kiếm theo: </label>
                  <input class="p-2 mx-1" type="text" id="searchTeacher" name="searchTeacher" placeholder="Họ tên giảng viên">
                  <select class="p-2 mx-1 px-2" name="labName" id="searchRoom">
                    <option>Chọn phòng</option>
                    <?=$optLab;?>
                  </select>
                  <button id="searchButton" class="btn btn-primary mx-1">Tìm kiếm</button>
                </div>
                <div class="row">
                  <select id="searchPeriod" class="col-1 overlay-select bg-white text-center text-dark p-0">
                    <option>Chọn buổi</option>
                    <option value="Sáng">Sáng</option>
                    <option value="Chiều">Chiều</option>
                  </select>
                </div>
                <div id="calendar"></div>
                <!-- Modal HTML -->
                <div id="eventModal" class="modal">
                  <div class="modal-content">
                    <span class="close text-end">&times;</span>
                    <h2 class="text-center fw-bold">Thông tin lịch thực hành</h2>
                    <table class="mt-2">
                      <tbody>
                        <tr>
                          <td class="fw-bold">Phòng học</td>
                          <td class="tenPH"></td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Lớp học phần</td>
                          <td class="lopHP"></td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Tên học phần</td>
                          <td class="tenHP"></td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Phụ trách giảng dạy</td>
                          <td class="hoTenGV"></td>
                        </tr> 
                        <tr>
                          <td class="fw-bold">Ngày học</td>
                          <td class="ngayHoc"></td>
                        </tr> 
                        <tr>
                          <td class="fw-bold">Buổi học</td>
                          <td class="buoiHoc"></td>
                        </tr> 
                        <tr>
                          <td class="fw-bold">Thời gian bắt đầu tiết học</td>
                          <td class="thoiGianBatDau"></td>
                        </tr>
                        <tr>
                          <td class="fw-bold">Thời gian kết thúc tiết học</td>
                          <td class="thoiGianKetThuc"></td>
                        </tr>
                      </tbody>
                    </table>
                    <button id="closeBtn" class="btn btn-danger my-3" style="width: 6rem; margin-left: auto;">Đóng</button>
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var morningDisplayed = false;
        var afternoonDisplayed = false;

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          initialDate: '2024-02-26', // Set ngày bắt đầu của học kì là ngày 26-02-2024
          slotDuration: '00:30:00', // Mỗi ô trên lịch tuần đại diện cho 30 phút
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
          },
          buttonText: {
            week: 'Tuần',
            day: 'Ngày'
          },
          slotMinTime: '07:00:00', // Thời gian bắt đầu hiển thị (7 giờ sáng)
          slotMaxTime: '18:00:00', // Thời gian kết thúc hiển thị (6 giờ chiều)
          slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
            hour12: false
          },
          firstDay: 1, // Thứ bắt đầu của tuần là thứ Hai (0 là Chủ Nhật, 1 là Thứ Hai, ...)
          slotDuration: '00:30:00', // Thời gian mỗi ô (30 phút)
          snapDuration: '00:30:00', // Kéo và thả cố định vào mỗi 30 phút
          // slotLabelContent: function(arg) {
          //   var hour = arg.date.getHours();
          //   var minute = arg.date.getMinutes();
          //   var timeString = '';
            
          //   if (hour >= 7 && hour < 12 && !morningDisplayed) {
          //     morningDisplayed = true;
          //     timeString = 'Sáng';
          //   } else if (hour >= 12 && hour < 18 && !afternoonDisplayed) {
          //     afternoonDisplayed = true;
          //     timeString = 'Chiều';
          //   }
            
          //   return timeString;
          // },
          slotLabelContent: function(arg) {
            var hour = arg.date.getHours();
            var minute = arg.date.getMinutes();
            var timeString = '';
            
            if (hour >= 7 && hour < 12 && !morningDisplayed) {
              morningDisplayed = true;
              timeString = '';
            } else if (hour >= 12 && hour < 18 && !afternoonDisplayed) {
              afternoonDisplayed = true;
              timeString = '';
            }
            
            return timeString;
          },
          locale: 'vi', // Sử dụng ngôn ngữ tiếng Việt
          events: [
            <?=$event;?>
          ],
          eventBackgroundColor: '#3788d8', // Màu nền của các sự kiện
          eventOverlap: true, // Không cho phép các sự kiện chồng lên nhau
          eventClick: function(info) {
            // Hiển thị modal khi click vào sự kiện
            var modal = document.getElementById("eventModal");
            modal.style.display = "block";
            var eventDetail = document.getElementById("event-detail");
            var cutEvent = info.event.title.split(" - ");
            var tenPH = document.querySelector('.tenPH');
            tenPH.innerHTML = cutEvent[0];
            var lopHP = document.querySelector('.lopHP');
            lopHP.innerHTML = cutEvent[1];
            var tenHP = document.querySelector('.tenHP');
            tenHP.innerHTML = cutEvent[2];
            var hoTenGV = document.querySelector('.hoTenGV');
            hoTenGV.innerHTML = cutEvent[3];
            var buoiHoc = info.event.extendedProps.period;
            var buoiHocElement = document.querySelector('.buoiHoc');
            buoiHocElement.innerHTML = buoiHoc;
            var thoiGianBatDau = info.event.start.toLocaleString().split(' ');
            var gioBatDau = thoiGianBatDau[0];
            var thoiGianKetThuc = info.event.end.toLocaleString().split(' ');
            var gioKetThuc = thoiGianKetThuc[0];
            var thoiGianBatDauElement = document.querySelector('.thoiGianBatDau');
            thoiGianBatDauElement.innerHTML = gioBatDau;
            var thoiGianKetThucElement = document.querySelector('.thoiGianKetThuc');
            thoiGianKetThucElement.innerHTML = gioKetThuc;
            var ngayHoc = document.querySelector('.ngayHoc');
            ngayHoc.innerHTML = thoiGianBatDau[1];
            // console.log(info.event.start.toLocaleString());
            // console.log(info.event.end.toLocaleString());

            // Xử lý khi click vào nút đóng modal
            var closeBtn = document.getElementsByClassName("close")[0];
            closeBtn.onclick = function() {
              modal.style.display = "none";
            };
            var closeBtn = document.getElementById("closeBtn");
            closeBtn.onclick = function() {
              modal.style.display = "none";
            };
          }
        });
        calendar.render();

        // Xử lý sự kiện tìm kiếm
        document.getElementById('searchPeriod').addEventListener('change', function() {
          var searchString = document.getElementById('searchPeriod').value;
          var eventSources = calendar.getEventSources();
          
          eventSources.forEach(function(eventSource) {
            eventSource.remove();
          });

          calendar.addEventSource({
            events: filteredEventsByPeriod(searchString)
          });
        });

        // Hàm lọc sự kiện theo buổi học
        function filteredEventsByPeriod(searchString) {
          var events = [
            <?=$event;?>
          ];

          return events.filter(function(event) {
            return event.period === searchString;
          });
        }
        
        document.getElementById('searchButton').addEventListener('click', function() {
          var teacherName = document.getElementById('searchTeacher').value.trim();
          var roomName = document.getElementById('searchRoom').value.trim();
          
          var searchString = '';
          if (teacherName !== '') {
            searchString = teacherName;
          } else if (roomName !== '') {
            searchString = roomName;
          }
          
          var eventSources = calendar.getEventSources();
          eventSources.forEach(function(eventSource) {
            eventSource.remove();
          });
          
          calendar.addEventSource({
            events: filteredEventsByNameOrRoom(searchString)
          });
        });

        // Hàm lọc sự kiện theo họ tên giảng viên hoặc phòng học
        function filteredEventsByNameOrRoom(searchString) {
          var events = [
            <?=$event;?>
          ];

          return events.filter(function(event) {
            // Lọc sự kiện theo họ tên giảng viên hoặc phòng học
            return (
              event.teacherName.toLowerCase().includes(searchString.toLowerCase()) ||
              event.lab.toLowerCase().includes(searchString.toLowerCase())
            );
          });
        }
      });
    </script>
    <script src="view/layout/assets/js/sidebar.js"></script>
    <script src="view/layout/assets/js/darklightmode.js"></script>
  </body>
</html>