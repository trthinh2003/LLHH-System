<?php
  $result_all = selectOptPhongHoc();
  $optLab = "";
  foreach ($result_all as $row) {
    $optLab .= '<option name="labName" value="'.$row['MAPHONGHOC'].'">'.$row['MAPHONGHOC'].'</option>';
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
        z-index: 50;
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
    </style>
  </head>

  <body>
    <div class="wrapper">
      <!-- Nội dung thanh sidebar -->
      <aside id="sidebar" class="js-sidebar">
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

        <!-- Phan noi dung -->
        <main class="content px-3 py-2">
            <div class="card-body">
              <div class="container p-5">
                <div class="mb-4">
                  <label class="text-dark" for="search" style="font-size: 1.05rem;">Tìm kiếm theo: </label>
                  <input class="p-2 mx-1" type="text" id="search" name="search" placeholder="Tên giảng viên">
                  <select class="p-2 mx-1 px-2" name="labName" id="">
                    <option>Chọn phòng</option>
                    <?=$optLab;?>
                  </select>
                  <button id="searchButton" class="btn btn-primary mx-1">Tìm kiếm</button>
                </div>
                <div class="row">
                  <select id="searchIdOption" class="col-1 overlay-select bg-white text-center text-dark p-0">
                    <option>Chọn buổi</option>
                    <option value="Sáng">Sáng</option>
                    <option value="Chiều">Chiều</option>
                  </select>
                </div>
                <div id="calendar"></div>
                <!-- Modal HTML -->
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
            {
              title: 'P101 - CT29903 - Phát triển hệ thống Web - GV. Nguyễn Thanh Hiền',
              start: '2024-03-28T07:00:00',
              end: '2024-03-28T11:50:00',
              period: "Sáng"
            },
            {
              title: 'P102 - CT17904 - Quản trị hệ thống - GV. Lê Huỳnh Quốc Bảo',
              start: '2024-03-28T07:00:00',
              end: '2024-03-28T11:50:00',
              period: "Sáng"          
            },
            {
              title: 'P103 - CT11203 - Mạng máy tính - GV. Ngô Bá Hùng',
              start: '2024-03-28T13:30:00',
              end: '2024-03-28T17:00:00',
              period: "Sáng"          
            },
            // Thêm các sự kiện khác nếu cần
          ],
          eventBackgroundColor: '#3788d8', // Màu nền của các sự kiện
          eventOverlap: true, // Không cho phép các sự kiện chồng lên nhau
          eventClick: function(info) {
          // Hiển thị modal khi click vào sự kiện
            var modal = document.getElementById("eventModal");
            modal.style.display = "block";
            
            // Đưa title của sự kiện vào trường input trong modal
            document.getElementById("eventTitle").value = info.event.title;
            
            // Xử lý khi click vào nút đóng modal
            var closeBtn = document.getElementsByClassName("close")[0];
            closeBtn.onclick = function() {
              modal.style.display = "none";
            };
            
            // Xử lý khi click vào nút lưu
            var saveBtn = document.getElementById("saveEvent");
            saveBtn.onclick = function() {
              var newTitle = document.getElementById("eventTitle").value;
              info.event.setProp('title', newTitle); // Cập nhật title của sự kiện
              modal.style.display = "none"; // Đóng modal
            };
          }
        });
        calendar.render();

        // Xử lý sự kiện tìm kiếm
        document.getElementById('searchIdOption').addEventListener('change', function() {
          var searchString = document.getElementById('searchIdOption').value;
          var eventSources = calendar.getEventSources();
          
          eventSources.forEach(function(eventSource) {
            eventSource.remove();
          });

          calendar.addEventSource({
            events: filteredEvents(searchString)
          });
        });

        // Hàm lọc sự kiện theo tiêu đề
        function filteredEvents(searchString) {
          var events = [
            {
              title: 'P101 - CT29903 - Phát triển hệ thống Web - GV. Nguyễn Thanh Hiền',
              start: '2024-03-28T07:00:00',
              end: '2024-03-28T11:50:00',
              period: "Sáng"
            },
            {
              title: 'P102 - CT17904 - Quản trị hệ thống - GV. Lê Huỳnh Quốc Bảo',
              start: '2024-03-28T07:00:00',
              end: '2024-03-28T11:50:00',
              period: "Sáng"
            },
            {
              title: 'P103 - CT11203 - Mạng máy tính - GV. Ngô Bá Hùng',
              start: '2024-03-28T13:30:00',
              end: '2024-03-28T17:00:00',
              period: "Chiều"
            }
            // Thêm các sự kiện khác nếu cần
          ];

          return events.filter(function(event) {
            return event.period === searchString;
          });
        }
      });
    </script>
    <script>
      // function kiemTraTonTai(selector) {
      //   var element = document.querySelector(selector);
      //   if (element) {
      //       return true;
      //   } else {
      //       return false;
      //   }
      // }
      // var overlaySelect = document.querySelector('#searchIdOption');
      // if (kiemTraTonTai('.collapsed') != 1) {
      //   overlaySelect.style.top = '210px';
      //   overlaySelect.style.left = '190px';
      // }
      // else {
      //   overlaySelect.style.top = '205px';
      //   overlaySelect.style.left = '380px';
      // }
    </script>
    <script src="view/layout/assets/js/sidebar.js"></script>
    <script src="view/layout/assets/js/darklightmode.js"></script>
  </body>
</html>