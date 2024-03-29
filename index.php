  <?php
    include_once "model/connectdb.php";
    include_once "model/catalog.php";

    if (isset($_GET['pg']) && ($_GET['pg'] != "")) {
      switch ($_GET['pg']) {
        case 'schedule_watching':
          include_once "view/schedule_watching.php";
          break;
        case 'login-form':
          include_once "view/login-form.php";
          break;
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
          include_once "view/footer.php";
          break;
        case 'schedule_watching_admin':
          include_once "admin/schedule_watching_admin.php";
          break;
        case 'teacher':
          include_once "teacher/teacher.php";
          break;
        case 'schedule_registration':
          include_once "teacher/schedule_registration.php";
          include_once "view/footer.php";
          break;
        case 'schedule_watching_teacher':
          include_once "teacher/schedule_watching_teacher.php";
        break;
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