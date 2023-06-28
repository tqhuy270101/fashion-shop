<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sono:wght@600&display=swap" rel="stylesheet">
<?php session_start(); ?>
<?php include("../components/frontend/checkAccount.php") ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../components/frontend/users/menu.php") ?>
<?php include("../components/frontend/users/toasts.php") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="wrapper">
    <div class="clearfix"> </div>
    <div class="container_fullwidth" style="background-image: url('../public/images/bg/bg-payment.jpg')">
        <div class="container shopping-cart">
            <div class="row" style="margin: 20px">
                <?php
                    $ref_order = "Orders";
                    $ref_profile = "User_Info";
                    $idUser = $_SESSION['id_user'];

                    $data_order = $database->getReference($ref_order)->getChild($idUser)->getValue();
                    $data_profile = $database->getReference($ref_profile)->getChild($idUser)->getValue();
                    $count = 0;
                    if ($data_order > 0) {
                        foreach($data_order as $key_add => $row){
                            $ref_order1 = $database->getReference($ref_order)->getChild($idUser)->getChild($key_add)->getValue();
                            if ($ref_order1 > 0) {
                                foreach($ref_order1 as $row1){
                                    if ($row1['paymentstatus'] == 0 && $row1['paymentform'] == 1) {
                                        $count += $row1['totalPrice'];
                                    }
                                }
                            }
                        }
                    }
                ?>
                <div style="display: flex; flex-direction: row; background-color: #f8e4ff; padding: 20px; border-radius: 15px;">
                    <h3 class="title" style="font-family: 'Sono', sans-serif;">Thông tin chuyển khoản</h3>
                    <a class="btn btn-success" href="../index.php" style="margin-top:10px">Chuyển khoản thành công</a>
                </div><br>
                <div class="col-md-12"  style="background-color: #fff; border-radius: 15px; padding: 20px;">
                    <div class="card-qr" style="margin: 20px;" align="center">
                        <img src="../public/frontend/images/qr-code.jpg" alt="qr-code" style="width: 400px; height: 400px; display: block; margin-left: auto; margin-right: auto;">
                        <h5 class="form-control" style="font-weight: bold; background-color: #d1ecf1; color: #0c5460; width: 90%" align="center">Số tiền: <?php echo number_format($count, 0, ',', '.');; ?> VNĐ</h5><br>
                        <h5 class="form-control" style="font-weight: bold; background-color: #d1ecf1; color: #0c5460; width: 90%" align="center">Nội dung chuyển khoản: <?php echo $data_profile['phone'] ?></h5>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/users/footer.php") ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
