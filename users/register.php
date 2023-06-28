<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//f.hubspotusercontent40.net/hubfs/19948095/raw_assets/public/pova/images/favicon.svg">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/frontend/css/login.css">
</head>
<body>
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="card1 pb-5">
                <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="../public/frontend/images/bg/login.jpg" class="image"> </div>
            </div>
        </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h1>Register</h1>
                    </div>
                    <form action="code-handle/code-register.php" method="POST">
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Họ tên</h6>
                            </label>
                            <input class="mb-4" type="text" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Số điện thoại</h6>
                            </label>
                            <input class="mb-4" type="text" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Email</h6>
                            </label>
                            <input class="mb-4" type="text" name="email" placeholder="Nhập địa chỉ email" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Địa chỉ</h6>
                            </label>
                            <input class="mb-4" type="text" name="address" placeholder="Nhập địa chỉ nhà" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Mật khẩu</h6>
                            </label>
                            <input class="mb-4" type="password" name="password" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="row px-3"> 
                            <label class="mb-1">
                                <h6 class="mb-0 text-sm">Nhập lại mật khẩu</h6>
                            </label>
                            <input type="password" name="repassword" placeholder="Nhập lại mật khẩu" required>
                            <p style="color: red; font-size: 14px; font-style: italic">
                              <?php 
                                session_start();
                                if(isset($_SESSION['error']) && $_SESSION['error'] != '') {
                                  echo $_SESSION['error'];
                                  unset($_SESSION['error']);
                                }
                              ?>
                            </p>
                        </div>
                        <div class="row mb-3 px-3">
                            <button type="submit" name="btn_register" class="btn btn-blue text-center">Đăng ký</button>
                        </div>
                    </form>
                    <div class="row mb-4 px-3">
                        <small class="font-weight-bold">Bạn đã có tài khoản ? <a href="login.php" class="text-danger ">Đăng nhập</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</body>
</html>