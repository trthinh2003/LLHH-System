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
      slotLabelContent: function(arg) {
        var hour = arg.date.getHours();
        var minute = arg.date.getMinutes();
        var timeString = '';
        
        if (hour >= 7 && hour < 12 && !morningDisplayed) {
          morningDisplayed = true;
          timeString = 'Sáng';
        } else if (hour >= 12 && hour < 18 && !afternoonDisplayed) {
          afternoonDisplayed = true;
          timeString = 'Chiều';
        }
        
        return timeString;
      },
      locale: 'vi', // Sử dụng ngôn ngữ tiếng Việt
      events: [
        {
          title: 'P101 - CT29903 - Phát triển hệ thống Web - GV.Nguyễn Thanh Hiền',
          start: '2024-03-21T07:00:00',
          end: '2024-03-21T12:00:00',
          rendering: 'background'

        },
        {
          title: 'P102 - CT17904 - Quản trị hệ thống - GV.Nguyễn Hoàng Quốc Bảo',
          start: '2024-03-21T07:00:00',
          end: '2024-03-21T12:00:00',
          rendering: 'background'
          
        },
        {
          title: 'P101 - CT20503 - Hệ Quản Trị CSDL - GV.Nguyễn Thái Nghe',
          start: '2024-03-22T07:00:00',
          end: '2024-03-22T12:00:00'
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
    document.getElementById('searchButton').addEventListener('click', function() {
      var searchString = document.getElementById('search').value;
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
          title: 'P101 - CT29903 - Phát triển hệ thống Web - GV.Nguyễn Thanh Hiền',
          start: '2024-03-21T09:00:00',
          end: '2024-03-21T11:00:00'
        },
        {
          title: 'P102 - CT17904 - Quản trị hệ thống - GV.Nguyễn Hoàng Quốc Bảo',
          start: '2024-03-21T09:00:00',
          end: '2024-03-21T11:00:00'
        },
        // Thêm các sự kiện khác nếu cần
      ];

      return events.filter(function(event) {
        return event.title.includes(searchString);
      });
    }
  });