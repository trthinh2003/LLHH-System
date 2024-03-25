<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" href="./layout/assets/images/favicon.ico" type="image/x-icon" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./layout/assets/css/normalize.css" />
    <link rel="stylesheet" href="./layout/assets/css/login-form.css">
</head>
<body>
    <section>
        <div class="container-fluid mt-2 pt-4">
            <div class="row">
                <div class="form col-12 col-sm-8 col-md-6 m-auto">
                    <div class="logo-brand">
                        <img src="./layout/assets/images/logo.png" alt="Logo" class="shadow-light rounded-circle mx-auto mb-5 d-flex" width="120px">
                    </div>
                    <div class="card border-0 shadow mx-5">
                        <div class="card-body">
                            <h3 class="text-center text-primary fw-bold mb-4 p-2">Đăng Nhập</h3>
                            <form class="mx-3" action="" method="post">
                                <label class="fw-bold" for="loginInputUserName">Tên Đăng Nhập</label>
                                <input class="form-control my-2 py-2 border-secondary" type="text" name="username" id="loginInputUserName" />
                                <label class="fw-bold" for="loginInputPassword">Mật Khẩu</label>
                                <input class="form-control my-2 py-2 border-secondary" type="password" name="passwd" id="loginInputPassword" />
                                <div class="text-center mt-4">
                                    <input type="submit" value="Đăng nhập" class="btn btn-primary" />
                                    <a href="../index.php" class="nav-link mt-3 text-primary"><i class="fa-solid fa-rotate-left pe-2"></i>Về trang chủ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>