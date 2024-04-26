<?php
    ob_start();
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        $admin = $_SESSION['AdminName'];
    }
    else {
        header('Location: index.php');
    }
    $_SESSION['soluongYC'] = demSoLuongYC();
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
    <title>Quản lý tình trạng sử dụng phòng máy</title>
    <link rel="shortcut icon" href="view/layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link rel="stylesheet" href="view/layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="view/layout/assets/css/style.css" />
    <style>
        .col-md-4 div {
            height: 15px;
            width: 0px;
            background-color: rgb(5, 126, 78);
            margin: 20px 20px;
            transition: all ease-in-out 1s;
            display: inline-block;
            border-radius: 5px;
        }

        .col-md-4 {
            display: flex;
            align-items: center;
        }

        span {
            display: inline-block;
            padding: 3px;
            /* visibility: hidden; */
            border-radius: 7px;
        }

        span:hover {
            background-color: rgb(226, 217, 211);

        }

        .u {
            padding: 0px 0px;
            background-repeat: no-repeat;
            background-size: cover;
            height: 120px;
            border-radius: 5px;
            background-image: url("https://themewagon.github.io/purple-react/static/media/circle.953c9ca0.svg");
        }

        .o {
            padding: 0px 0px;
            border-radius: 5px;
        }

        .k {
            height: 120px;
        }
        .bold-shadow {
		  text-shadow: 0 0 3px rgba(0,0,0,1);
		}
		@keyframes chop {
		  0% {
			transform: scaleY(1);
		  }
		  50% {
			transform: scaleY(0.8);
		  }
		  100% {
			transform: scaleY(1);
		  }
		}

		.chop-text {
		  display: inline-block;
		  animation: chop 1s infinite ease-in-out;
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
                            <li class="sidebar-item">
                                <a href="index.php?pg=lab_analysis" class="sidebar-link">Quản lý tình trạng sử dụng phòng máy</a>
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
            <main style="background-color: #fff;">
                <div class="container  mb-4" style="background-color: aliceblue;border-radius: 5px;">
                <div class="row" style="margin-bottom: 10px; align-items: center;background-color: aqua;" >
                        <p class="chop-text text-center" style="font-size: 30px; margin-top: 20px; color: #005500;">THỐNG KÊ TÌNH TRẠNG SỬ DỤNG PHÒNG </p>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-8  o" id="baby">

                        </div>
                        <div class="row col-lg-4">
                            <div class="row">
                                <div class="col bg-info u">
                                    <h4 style="margin-left: 8px; margin-top: 12px;" class="font-weight-normal mb-3 text-white k" id="bbbb">Tổng số ca học trong học kì</h4>
                                </div>
                            </div>
                            <div class="row" id='cute'>

                            </div>
                        </div>


                    </div>
                </div>
                <div class="container" id="h">
                
                    <div class="row justify-content-between " id="con" style="background-color: aliceblue; border-radius: 5px;">
                    <div class="row" style="margin-bottom: 10px; align-items: center; " >
                        <p class="chop-text text-center" style="font-size: 30px;background-color: aliceblue; margin-top: 20px; color: #005500;">CHI TIẾT SỬ DỤNG PHÒNG </p>
                    </div>
                    </div>
                </div>
                <!-- <div  class="container">
                    <div class="row justify-content-between"  id="con">

                    </div>
                </div> -->
                <div class="modal" id="myModal">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body" id="someone" style="height: 550px; ">

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                // let a = [100, 90, 60, 100, 90, 60, 44, 44];
                function ggg(){
                    fetch('route/insert2.php?a=555', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        
                    })
                    .then(response => response.json())
                    .then(data => {
                        localStorage.setItem('ttt', JSON.stringify(data));
                    })
                }
                ggg();
                function loadData() {
                    fetch('route/insert2.php?a=3')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            let htm = document.getElementById('con');
                            let i = 0;
                            data.forEach(v => {
                                let t = Math.floor(parseFloat(v.tong) / 24 * 100);

                                let y = document.createElement("DIV");
                                let n = document.createElement("DIV");
                                n.classList.add("col-md-4")
                                let o = document.createElement("SPAN");
                                o.setAttribute("data-bs-toggle", "modal");
                                //data-bs-target="#myModal"
                                o.setAttribute("data-bs-target", "#myModal");
                                o.addEventListener("click", ve);
                                // o.classList.add("float-right")
                                y.id = `${i}`
                                let pt = document.createElement("SPAN")
                                pt.innerText = v.MAPHONGHOC;
                                pt.style.color="hope"
                                pt.classList.add("bold-shadow");
                                pt.classList.add("chop-text");
                                console.log(pt)
                                n.appendChild(pt)
                                n.appendChild(y)
                                n.appendChild(o)
                                htm.appendChild(n)
                                setTimeout(() => k(y, t, o), 0);
                                i++;
                            })
                        })
                }

                function k(elemen, wi, o) {
                    for (let i = 0; i < wi; i++) {
                        elemen.style.width = `${i}px`
                        if (i > 80) {
                            elemen.style.backgroundColor = "red"
                        } else if (i > 50) {
                            elemen.style.backgroundColor = "rgb(241, 209, 6)"
                        }
                    }
                    elemen.style.width = `${wi}px`
                    setTimeout(function() {
                        o.innerText = wi + "% >"
                        o.style.visibility = "visible"

                    }, 1000)
                }

                loadData()

                function ve(event) {
                    document.getElementById('someone').innerHTML = `<div style="width:100%; height: 100%;margin:0px;padding:0px">
                        <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
                    </div>`;
                    var cc = event.target.parentNode;
                    var g = cc.getElementsByTagName('SPAN');
                    console.log(g[0].textContent);
                    fetch(`route/insert2.php?a=14&b=${g[0].textContent}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json(); // Sử dụng response.json() để chuyển đổi dữ liệu JSON sang đối tượng JavaScript
                        })
                        .then(data => {
                            console.log(data);
                            // Lấy dữ liệu từ đối tượng và chuyển thành mảng dữ liệu tháng
                            var monthsData = data.map(item => item.thang);
                            var countData = data.map(item => item.tong);

                            // Lọc các tháng không có trong dữ liệu và số lượng tương ứng
                            var filteredData = [];
                            for (var i = 1; i <= 12; i++) {
                                var index = monthsData.indexOf(i.toString()); // Tìm index của tháng trong mảng dữ liệu tháng
                                if (index !== -1) {
                                    filteredData.push(countData[index]); // Nếu tháng tồn tại trong dữ liệu, thêm số liệu vào mảng lọc
                                } else {
                                    filteredData.push(null); // Nếu tháng không tồn tại trong dữ liệu, thêm null vào mảng lọc
                                }
                            }

                            // Tìm giá trị lớn nhất trong mảng dữ liệu
                            var max_value = Math.max(...filteredData);

                            // Vẽ biểu đồ đường
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                                    datasets: [{
                                        label: 'Giá trị',
                                        data: filteredData,
                                        fill: false,
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        tension: 0,
                                        borderWidth: 2,
                                        pointRadius: 5,
                                        pointHoverRadius: 7,
                                        pointHoverBorderWidth: 2,
                                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                        pointBorderColor: 'rgba(75, 192, 192, 1)',
                                        pointBorderWidth: 2
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            suggestedMax: max_value + 10
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    return 'Số ca: ' + context.parsed.y;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        })
                        .catch(error => {
                            console.error('There has been a problem with your fetch operation:', error);
                        });

                    var cute = event.target.parentNode;
                    console.log(cute);
                }

                function ve2() {
                    fetch(`route/insert2.php?a=12`)
                        .then(response => {
                            return response.json();
                        })
                        .then(data => {
                            // Xác định dữ liệu từ đối tượng data
                            var monthsData = data.map(item => item.thang);
                            var countData = data.map(item => item.tong);

                            // Lọc dữ liệu để chỉ chứa các tháng có dữ liệu
                            var filteredData = [];
                            for (var i = 1; i <= 12; i++) {
                                var index = monthsData.indexOf(i.toString());
                                if (index !== -1) {
                                    filteredData.push(countData[index]);
                                } else {
                                    filteredData.push(null);
                                }
                            }

                            // Tìm giá trị lớn nhất trong mảng dữ liệu
                            var max_value = Math.max(...filteredData);

                            // Thiết lập màu sắc cho các điểm trong biểu đồ
                            var backgroundColors = ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'];

                            // Tạo canvas để vẽ biểu đồ
                            var canvas = document.createElement('canvas');
                            canvas.id = 'myChart2';

                            // Thêm canvas vào div có id là "baby"
                            var babyDiv = document.getElementById('baby');
                            babyDiv.innerHTML = ''; // Xóa bất kỳ nội dung nào có sẵn trong div
                            babyDiv.appendChild(canvas);
                            var obj = JSON.parse(localStorage.getItem('ttt'));
                            // Vẽ biểu đồ đường
                            var ctx = canvas.getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                                    datasets: [{
                                        label: 'Biểu đồ thống kê số lượng ca học học kỳ '+obj.HOCKI+' - '+ obj.NAMHOC,
                                        data: filteredData,
                                        fill: false,
                                        borderColor: backgroundColors[0],
                                        tension: 0,
                                        borderWidth: 2,
                                        pointRadius: 5,
                                        pointHoverRadius: 7,
                                        pointHoverBorderWidth: 2,
                                        pointBackgroundColor: backgroundColors[0],
                                        pointBorderColor: backgroundColors[0],
                                        pointBorderWidth: 2
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            suggestedMax: max_value + 10
                                        }
                                    },
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    return 'Số ca: ' + context.parsed.y;
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        })
                        .catch(error => {
                            console.error('There has been a problem with your fetch operation:', error);
                        });
                }


                ve2();

                function cc() {
                    // URL để nhận dữ liệu
                    const url = 'route/insert2.php?a=33';

                    // Fetch dữ liệu từ URL
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            // Tính tổng số lượng của tất cả các khoa
                            total = 0;
                            for (i = 0; i < data.length; i++) {
                                console.log(data[i].soluong);
                                total = parseInt(data[i].soluong) + total;
                            }
                            console.log(total);
                            // Tạo mảng chứa các nhãn (khoa) và phần trăm tương ứng
                            const labels = [];
                            const percentages = [];
                            data.forEach(item => {
                                labels.push(item.khoa);
                                // Tính phần trăm của mỗi khoa
                                const percentage = (item.soluong / total) * 100;
                                console.log(percentage)
                                percentages.push(percentage);
                            });

                            // Tìm đến div có id là 'cute'
                            var cuteDiv = document.getElementById('cute');

                            // Tạo một thẻ canvas để vẽ biểu đồ
                            var canvas = document.createElement('canvas');
                            canvas.setAttribute('id', 'pieChart');

                            // Thêm thẻ canvas vào div 'cute'
                            cuteDiv.appendChild(canvas);

                            // Vẽ biểu đồ tròn
                            var ctx = canvas.getContext('2d');
                            var pieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        data: percentages,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.5)',
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 206, 86, 0.5)',
                                            'rgba(75, 192, 192, 0.5)',
                                            'rgba(153, 102, 255, 0.5)',
                                            'rgba(255, 159, 64, 0.5)'
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    title: {
                                        display: true,
                                        text: 'Biểu đồ phân phối % số lượng theo khoa'
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(tooltipItem, data) {
                                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                                var currentValue = dataset.data[tooltipItem.index];
                                                return Math.round(currentValue) + "%";
                                            }
                                        }
                                    }
                                }
                            });
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                }

                // Gọi hàm cc để bắt đầu quá trình vẽ biểu đồ
                cc();
                function gg(){
                    fetch('route/insert2.php?a=55', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.tong)
                        document.getElementById('bbbb').innerHTML =document.getElementById('bbbb').textContent+` <br/>`+data.tong ;
                    })
                }

                gg();
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
    </div>

    <script src="view/layout/assets/js/sidebar.js"></script>
    <script src="view/layout/assets/js/darklightmode.js"></script>
    </body>
</html>