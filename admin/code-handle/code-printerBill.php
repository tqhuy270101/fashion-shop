<?php session_start();
    if (!isset($_SESSION['id_user']) ) {
        header("location: ../../users/login.php");
    }
    if ($_SESSION['phanQuyen'] != 'admin'){
        header("location: ../../index.php");
    }
?>
<?php include('../../includes/dbconfig.php') ?>
<link rel="shortcut icon" href="../../public/frontend/images/logo.png">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script>window.print()</script>

<body>
    <?php
        if (isset($_GET['idUser']) && $_GET['idUser'] != '' && isset($_GET['idOrder']) &&  $_GET['idOrder'] != '') {
            $idUser = $_GET['idUser'];
            $idOrder = $_GET['idOrder'];
            $ref_userInfo = "User_Info";
            $ref_order = "Orders";
            $info = $database->getReference($ref_userInfo)->getChild($idUser)->getValue();
            $order = $database->getReference($ref_order)->getChild($idUser)->getChild($idOrder)->getValue();
        }
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-5">
                <h5>FASHION SHOP</h5>
            </div>
            <div class="col-sm-7">
                <p class="text-end">Mã đơn hàng: <?php echo $idOrder ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-2 px-0">
                <div class="border border-secondary rounded py-0 px-3" style="height: 100%">
                    <p class="fw-bold">Người gửi:</p>
                    <p>FASHION SHOP</p>
                    <p>26 Nguyễn Tạo, Ngũ Hành Sơn, TP Đà Nẵng</p>
                    <p>SĐT: 0862957787</p>
                </div>
            </div>
            <div class="col-sm-6 ps-1 pe-0 mb-2">
                <div class="border border-secondary rounded py-0 px-3" style="height: 100%">
                    <p class="fw-bold">Người nhận:</p>
                    <p><?php echo $info['name'] ?></p>
                    <p><?php echo $info['address'] ?></p>
                    <p>SĐT: <?php echo $info['phone'] ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 mb-2 px-0">
                <div class="border border-secondary rounded py-0 px-3" style="height: 100%">
                    <p class="fw-bold">Nội dung hàng:</p>
                    <ol>
                        <?php
                            if ($order > 0) {
                                $totalPrice = 0;
                                foreach ($order as $keyOrder => $row) {
                                    $totalPrice += $row['totalPrice'];
                                    ?>
                                    <li><?php echo $row['name'] ?>. SL:<?php echo $row['totalQuantity'] ?></li>
                                    <?php
                                }
                            }
                        ?>
                    </ol>
                </div>
            </div>
            <div class="col-sm-4 ps-1 pe-0 mb-2">
                <div class="border border-secondary rounded py-0 px-3" style="height: 100%">
                    <p class="fw-bold">Ngày đặt hàng:</p>
                    <?php
                        $pieces = explode(" ", $row['created']);
                    ?>
                    <p class="fw-bolder mb-0 text-center"><?php echo $pieces[0] ?></p>
                    <p class="fw-bolder text-center"><?php echo $pieces[1] . " " .$pieces[2] ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-2 px-0">
                <div class="border border-secondary rounded py-0 px-3" style="height: 100%">
                    <p class="fw-bold">Phương thức thanh toán:</p>
                    <ol>
                        <?php
                            if ($row['paymentform'] == 1) {
                                if ($row['paymentstatus'] == 1) {
                                    echo 'Đã thanh toán';
                                }
                            } else {
                                echo 'Thanh toán bằng tiền mặt';
                            }
                        ?>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6 ps-1 pe-0 mb-2">
                <div class="border border-secondary rounded py-0 px-3 d-flex align-items-center" style="height: 100%">
                    <p class="fw-bold text-end mt-3">Tổng tiền: <?php echo number_format($totalPrice, 0, ',', '.') ?> VNĐ</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 px-0">
                <div class="border border-secondary rounded py-0 px-3">
                    <p class="fw-bold">Lưu ý: </p>
                    <ul>
                        <li>Hàng dễ vỡ, vui lòng nhẹ tay và không giẫm đạp</li>
                        <li>Kiểm tra hàng thật kỹ lúc nhận hàng</li>
                        <li>Mọi thắc mắc xin liên hệ với cửa hàng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>