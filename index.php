  <?php
    include_once "model/connectdb.php";
    include_once "model/catalog.php";

    if (isset($_GET['pg']) && ($_GET['pg'] != "")) {
      switch ($_GET['pg']) {
        //KHACH VANG LAI
        case 'schedule_watching':
          include_once "view/schedule_watching.php";
          break;
        case 'login-form':
          include_once "view/login-form.php";
          break;
          
        //CONTROLLER SANG TRANG ADMIN  
        case 'admin':
          include_once "admin/admin.php";
          break;
        case 'account_manage':
          include_once "admin/account_manage.php";
          include_once "view/footer.php";
        break;
        case 'lab_manage':
          include_once "admin/lab_manage.php";
          include_once "view/footer.php";
          break;
        case 'software_manage':
          include_once "admin/software_manage.php";
          include_once "view/footer.php";
          break;
        case 'requirements_manage':
          include_once "admin/requirements_manage.php";
          break;
        case 'lab_analysis':
          include_once "admin/lab_analysis.php";
          break;
        case 'schedule_watching_admin':
          include_once "admin/schedule_watching_admin.php";
          break;
        case 'admin_profile':
          include_once "admin/admin_profile.php";
          break;  

        //CONTROLLER SANG TRANG GIANG VIEN
        case 'teacher':
          include_once "teacher/teacher.php";
          break;
        case 'class_show':
          include_once "teacher/class_show.php";
          break;
        case 'lab_view':
          include_once "teacher/lab_view.php";
          break;
        case 'approveRequirements':
          include_once "teacher/approveRequirements.php";
          break;     
        case 'schedule_registration':
          include_once "teacher/schedule_registration.php";
          break;
        case 'schedule_watching_teacher':
          include_once "teacher/schedule_watching_teacher.php";
          break;
        case 'teacher_profile':
          include_once "teacher/teacher_profile.php";
          break;  
        
        //Neu khong thuoc 2 trang tren se quay ve trang index
        default:
          include_once "view/header.php";
          include_once "view/home.php";
          include_once "view/footer.php";
          break;
      }
    } else {
      include_once "view/header.php";
      include_once "view/home.php";
      include_once "view/footer.php";
    }
?>