<?php
    ob_start();
    session_start();
    if (isset($_SESSION['AdminName']) && $_SESSION['AdminName'] != "") {
        $admin = $_SESSION['AdminName'];
    }
    else {
        header('Location: index.php');
    }
    if (isset($_SESSION['statusAddSW']) && $_SESSION['statusAddSW'] != "") {
        if ($_SESSION['statusAddSW'] == "Thêm phần mềm thành công!") {
            $successAddSW = '<div class="shadow-lg p-2 move-from-top js-div-dissappear" style="width: 17rem; display:none;">
                                <i class="fa-solid fa-check p-2 bg-success text-white rounded-circle pe-2 mx-2"></i>
                                Thêm phần mềm '.$_SESSION['softwareAdd'].' vào phòng '.$_SESSION['labNameAdd'].' thành công
                               </div>';
            unset($_SESSION['statusAddSW']);
            unset($_SESSION['softwareAdd']);
            unset($_SESSION['labNameAdd']);
        }
        else if ($_SESSION['statusAddSW'] == "Phần mềm đã có ở phòng học này") {
            $failedAddSW = '<div class="shadow-lg p-2 move-from-top js-div-dissappear" style="width: 19rem; display:none;">
                                <i class="fa-solid fa-x p-2 bg-danger text-white rounded-circle pe-2 mx-2"></i>'.$_SESSION['statusAddSW'].'
                            </div>';
            unset($_SESSION['statusAddSW']);
        }
        else if ($_SESSION['statusAddSW'] == "Thêm phòng học thành công!") {
            $successAddSW = '<div class="shadow-lg p-2 move-from-top js-div-dissappear" style="width: 17rem; display:none;">
                                <i class="fa-solid fa-check p-2 bg-success text-white rounded-circle pe-2 mx-2"></i>
                                '.$_SESSION['statusAddSW'].'
                               </div>';
            unset($_SESSION['statusAddSW']);
        }
    }
    $tr = "";
    $i = 1;
    $result_all = layTTPhongHocKemCauHinhMayVaPhanMem();
    if ($result_all == 0) $result_all = [];
    foreach ($result_all as $row) {
        $tr .= '<tr>
                    <td>'.$i.'</td>
                    <td class="maPH">'.$row['MAPHONGHOC'].'</td>
                    <td>'.$row['SUCCHUA'].'</td>
                    <td>CPU: '.$row['CPU'].' - RAM: '.$row['RAM'].' - SSD: '.$row['SSD'].'</td>
                    <td>'.$row['CACPHANMEM'].'</td>
                    <td class="editLab text-center">
                        <input class="btn btn-success edit-modal-js" type="button" name="editLabClass" value="Sửa"/>
                    </td>   
                    <td class="del text-center p-0">
                        <form method="post" action="route/delete_lab.php">
                        <input class="btn btn-primary" type="submit" name="delBtn" value="Xóa"/>
                        <input type="hidden" name="maphonghoc" value="'.$row['MAPHONGHOC'].'"/>
                        </form>
                    </td>                    
                </tr>';
        $i++;        
    }
    $cacCH = selectOptCauHinh();
    $optCH = "";
    foreach ($cacCH as $row) {
        $optCH .= '<option name="configName" value="CPU: '.$row['CPU'].' - RAM: '.$row['RAM'].' - SSD: '.$row['SSD'].'">
                        CPU: '.$row['CPU'].' - RAM: '.$row['RAM'].' - SSD: '.$row['SSD'].'
                    </option>';
    }

    $cacPM = selectOptPM();
    $optPM = "";
    foreach ($cacPM as $row) {
        $optPM .= '<option name="softwareName" value="'.$row['TENPHANMEM'].'">'.$row['TENPHANMEM'].'</option>';
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
    <title>Quản lý phòng học</title>
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

        .edit, .del {
            cursor: pointer;
        }

        /* Toast message khi thêm phần mềm thành công hay thất bại*/
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

        /* Modal Sửa phòng học và Thêm phòng học */
        .modalSuaPH,
        .modalThemPH {
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

        .modalSuaPH.open,
        .modalThemPH.open {
            display: flex;
        }

        .modal-container {
            background-color: #fff;
            width: 450px;
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
            margin-bottom: 12px;
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
                    <h2 class="manage text-center fw-bold mt-5">QUẢN LÝ PHÒNG HỌC</h2>
                    <div class="card border-0 mt-5">
                        <!-- Thêm phòng học -->
                        <div class="my-2 d-flex justify-content-between">
                            <div></div>
                            <button  class="add btn btn-primary mx-3 text-end" >
                                <i class="fa-solid fa-plus p-0"></i>
                                <input class="btn btn-primary p-0 add-lab-btn" name="addLabBtn" type="button" value="Thêm Phòng Học"/>
                            </button> 
                        </div>
                        <div class="card-body">
                            <table>
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Phòng học</th>
                                    <th>Sức chứa</th>
                                    <th class="text-center">Cấu hình máy</th>
                                    <th class="text-center">Các phần mềm hỗ trợ</th>
                                    <th colspan="2" class="text-center">Hành động</th>
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
            <!--Modal Sửa phòng học-->
            <form class="modalSuaPH js-modal" action="route/editLab.php" method="post">
                <div class="modal-container js-modal-container p-3">
                    <div class="modal-close js-modal-close">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="modal-header d-flex align-item-center justify-content-center fw-bold" style="font-size: 1.5rem">
                        Sửa thông tin phòng học
                    </div>
                    <div class="modal-body modalThem-body">
                        <div class="modal-body__labName modal-label"></div>
                        <!-- Bổ sung phần mềm -->
                        <label class="modal-label" for="software-chosen">
                            Bổ sung phần mềm
                        </label>
                        <select id="software-chosen" name="softwareName" class="modal-input">
                            <option value="Chọn phần mềm">Chọn phần mềm</option>
                            <?=$optPM;?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success me-3 my-2" name="editLabBtn" value="Thêm"/>
                    </div>
                </div>
            </form>
            <!--Modal Sửa phòng học-->
            <form class="modalThemPH js-modal-addLab" action="route/addlab.php" method="post">
                <div class="modal-container js-modal-container-addLab p-3">
                    <div class="modal-close js-modal-close-addLab">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="modal-header d-flex align-item-center justify-content-center fw-bold" style="font-size: 1.5rem">
                        Thêm phòng học
                    </div>
                    <div class="modal-body modalThem-body">
                        <!-- Tên phòng học muốn thêm -->
                        <label class="modal-label mb-0" for="name_lab">
                            Tên phòng học <span class="text-danger">(*)</span>
                        </label>
                        <input id="name_lab" type="text" name="nameLab" class="w-100 m-0 text-dark" required>
                        <!-- Sức chứa -->
                        <label class="modal-label mb-0 mt-2" for="capacity">
                            Sức chứa
                        </label>
                        <input id="capacity" type="text" name="capacityOfLab" class="w-100 m-0 text-dark" required>
                        <!-- Chọn cấu hình -->
                        <label class="modal-label mb-0 mt-2" for="config-chosen">
                            Thêm cấu hình <span class="text-danger">(*)</span>
                        </label>
                        <select id="config-chosen" name="configName" class="modal-input">
                            <option value="Chọn cấu hình">Chọn cấu hình</option>
                            <?=$optCH;?>
                        </select>
                        <!-- Thêm phần mềm -->
                        <label class="modal-label mb-0 mt-2" for="software-chosen">
                            Thêm phần mềm <span class="text-danger">(*)</span>
                        </label>
                        <select id="software-chosen" name="softwareName" class="modal-input">
                            <option value="Chọn phần mềm">Chọn phần mềm</option>
                            <?=$optPM;?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success me-3 my-2" name="addLabSubmit" value="Thêm"/>
                    </div>
                </div>
            </form>
            <?php if(isset($successAddSW)) echo $successAddSW;?>
            <?php if(isset($failedAddSW)) echo $failedAddSW;?>
            <script>
                const editBtns = document.querySelectorAll('.edit-modal-js')
                const modal = document.querySelector('.js-modal')
                const modalContainer = document.querySelector('.js-modal-container')
                const modalClose = document.querySelector('.js-modal-close')

                function showEditLab() {
                    modal.classList.add('open')
                }

                function hideEditLab() {
                    modal.classList.remove('open')
                }

                for (const editBtn of editBtns) {
                    editBtn.addEventListener('click', showEditLab);
                }
                modalClose.addEventListener('click', hideEditLab);
            </script>
            <script>
                const addLabBtns = document.querySelectorAll('.add-lab-btn')
                const modalThemPH = document.querySelector('.js-modal-addLab')
                const modalContainerThemPH = document.querySelector('.js-modal-container-addLab')
                const modalCloseThemPH = document.querySelector('.js-modal-close-addLab')

                function showAddLab() {
                    modalThemPH.classList.add('open')
                }

                function hideAddLab() {
                    modalThemPH.classList.remove('open')
                }

                for (const addLabBtn of addLabBtns) {
                    addLabBtn.addEventListener('click', showAddLab);
                }
                modalCloseThemPH.addEventListener('click', hideAddLab);
            </script>
            <script>
                var editButtons = document.querySelectorAll('.edit-modal-js');
                var modalBodyLabname = document.querySelector('.modalSuaPH .modal-body .modal-body__labName');
                var modalBody = document.querySelector('.modalSuaPH .modal-body');

                for (editButton of editButtons) {
                    editButton.addEventListener('click', function() {
                        // var yeucau_id = this.parentNode.parentNode.querySelector('input[type="hidden').value;
                        // var inputHidden = document.createElement('input');
                        // inputHidden.setAttribute("type", "hidden");
                        // inputHidden.setAttribute("name", "yeucau_id");
                        // inputHidden.setAttribute("value", yeucau_id);
                        // var modalApprove = this.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('.modalDuyet .modal-container .modalDuyet-body');
                        // // console.log(modalApprove);
                        // modalApprove.appendChild(inputHidden);
                        var spanPH = this.parentNode.parentNode.querySelector('.maPH').innerText;
                        modalBodyLabname.innerHTML = "Tên phòng học: " + spanPH;
                        var inputHidden = document.createElement('input');
                        inputHidden.setAttribute("type", "hidden");
                        inputHidden.setAttribute("name", "labName");
                        inputHidden.setAttribute("value", spanPH);
                        modalBody.appendChild(inputHidden);
                        // console.log(this.parentNode.parentNode.querySelector('.maPH'));
                    });
                }
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



        

