<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
    include_once "model/connectdb.php";
    include_once "model/catalog.php";

    if (isset($_GET['pg']) && ($_GET['pg'] != "")) {
      switch ($_GET['pg']) {
        case 'schedule_registration':
          include_once "view/schedule_registration.php";
          break;
        case 'lab_manage':
          include_once "view/lab_manage.php";
          break;
        case 'schedule_watching':
          include_once "view/schedule_watching.php";
          break;
        default:
          include_once "view/header.php";
          include_once "view/home.php";
          break;
      }
    } else {
      //require home
      include_once "view/header.php";
      include_once "view/home.php";
    }

    //require footer
    include_once "view/footer.php";
  ?>
  <script src="view/layout/assets/js/sidebar.js"></script>
  <script src="view/layout/assets/js/darklightmode.js"></script>
  </body>
</html>