<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/frontend/images/logo.png">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/frontend/css/login.css">
</head>
<body>
    <?php 
        session_start();
        include("../components/frontend/users/toasts.php") 
    ?>
    <div class="container-fluid">
        <div class="row align-items-center" style="margin-top: 70px">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="../public/frontend/images/bg/login.jpg" class="image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <form action="code-handle/code-login.php" method="post">
                        <div class="row mb-4 px-3">
                            <h1>Đăng nhập</h1>
                        </div>
                        <div class="row mb-4 px-3">
                            <h6 class="mb-0 mr-4 mt-2">Đăng nhập với</h6>
                            <div class="facebook text-center mr-3">
                                <div class="fa fa-facebook"></div>
                            </div>
                            <div class="google text-center mr-3">
                                <div class="fa fa-google"></div>
                            </div>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="line"></div> 
                            <small class="or text-center">Hoặc</small>
                            <div class="line"></div>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email</h6>
                            </label>
                            <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Mật khẩu</h6>
                            </label>
                            <input type="password" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="row px-3 mb-4">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input id="chk1" type="checkbox" name="chk" class="custom-control-input">
                                <label for="chk1" class="custom-control-label text-sm">Nhớ mật khẩu</label>
                            </div>
                            <a href="#" class="ml-auto mb-0 text-sm">Quên mật khẩu?</a>
                        </div>
                        <div class="row mb-3 px-3">
                            <button name="btn_login" type="submit" class="btn btn-blue text-center">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Bạn chưa có tài khoản ? <a href="register.php" class="text-danger ">Đăng ký</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</body>
</html>