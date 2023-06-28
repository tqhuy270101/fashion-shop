<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<body id="reportsPage">
    <div class="mt-4" id="home">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 px-4 py-4 border border-secondary rounded">
                    <h5>Đơn đặt hàng</h5>
                        <?php 
                            $ref_order = "Orders";
                            $listUser = $database->getReference($ref_order)->getValue();
                            $countOrderNew = 0;
                            $countOrderDelivering = 0;
                            $countOrderDelivered = 0;
                            if ($listUser > 0) {
                                foreach($listUser as $keyUser => $user){
                                    $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getValue();
                                    if ($listOrder > 0) {
                                        foreach($listOrder as $keyOrder => $order){
                                            $listStatus = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                            if ($listStatus > 0) {
                                                foreach($listStatus as $keyStatus => $status){
                                                    if ($status['orderstatus'] == 0) {
                                                        $countOrderNew++;
                                                        break;
                                                    }
                                                    if ($status['orderstatus'] == 1) {
                                                        $countOrderDelivering++;
                                                        break;
                                                    }
                                                    if ($status['orderstatus'] == 2) {
                                                        $countOrderDelivered++;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        ?>
                    <ul class="nav nav-pills mb-3 mt-5" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            
                            <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Đơn mới <span class="badge badge-light"> <?php echo $countOrderNew ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Đang giao <span class="badge badge-light"> <?php echo $countOrderDelivering ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Giao thành công <span class="badge badge-light"> <?php echo $countOrderDelivered ?></span></button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th>Thanh toán</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ref_order  = "Orders";
                                        $ref_info  = "User_Info";
                                        $listUser = $database->getReference($ref_order)->getValue();
                                        $countStt = 0;
                                        if ($listUser > 0) {
                                            foreach($listUser as $keyUser => $user){
                                                $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getValue();
                                                $info = $database->getReference($ref_info)->getChild($keyUser)->getValue();
                                                if ($info > 0) {
                                                    $info_name = $info['name'];
                                                    $info_email = $info['email'];
                                                    $info_phone = $info['phone'];
                                                    $info_address = $info['address'];
                                                }
                                                if ($listOrder > 0) {
                                                    foreach($listOrder as $keyOrder => $order){
                                                        $status = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                        if ($status > 0) {
                                                            foreach($status as $keyStatus => $status){
                                                                $orderStatus = $status['orderstatus'];
                                                                $paymentForm = $status['paymentform'];
                                                                $paymentStatus = $status['paymentstatus'];
                                                                $created = $status['created'];
                                                                $name = $status['name'];
                                                                $link = $status['link'];
                                                                $price = $status['price'];
                                                                $totalPrice = $status['totalPrice'];
                                                                $totalQuantity = $status['totalQuantity'];
                                                            }
                                                        }
                                                        if ($orderStatus == 0) {
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo ++$countStt; ?></th>
                                                                <td><?php echo $keyOrder ?></td>
                                                                <td>
                                                                    <?php echo $created ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if ($paymentForm == 1) {
                                                                            echo "Chuyển khoản";
                                                                        } else if ($paymentForm == 2) {
                                                                            echo "Thanh toán khi nhận hàng";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a class="text-decoration-none text-danger" data-toggle="collapse" href="#collapseExample<?php echo $keyOrder ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $keyOrder ?>">
                                                                        Chi tiết
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="collapse" id="collapseExample<?php echo $keyOrder ?>">
                                                                        <!-- thông tin giao hàng -->
                                                                        <div class="row mb-2">
                                                                            <div class="col-md-12 px-1">
                                                                                <div class="px-2 py-2 border border-secondary rounded">
                                                                                <p><b>Thông tin: </b></p>
                                                                                <p>Họ tên: <?php echo $info_name ?></p>
                                                                                <p>Số điện thoại: <?php echo $info_phone ?></p>
                                                                                <p>Địa chỉ: <?php echo $info_address ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-between">
                                                                            <div class="col-md-6 px-1 mb-2">
                                                                                <div class="px-2 py-2 border border-secondary rounded">
                                                                                    <p><b>Phí vận chuyển</b></p>
                                                                                    <p>0 đ</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 px-1 mb-2">
                                                                                <div class="px-2 py-2 border border-secondary rounded">
                                                                                    <div class="col-md-10">
                                                                                        <p><b>Phương thức thanh toán</b></p>
                                                                                    </div>
                                                                                    <p>
                                                                                        <?php
                                                                                            if ($paymentForm == 1) {
                                                                                                if ($paymentStatus == 0) {
                                                                                                    ?>
                                                                                                    <i class="fa-solid fa-circle-xmark" style="color:red;"> </i>
                                                                                                    <?php
                                                                                                    echo "Chuyển khoản";
                                                                                                    ?>
                                                                                                    <?php
                                                                                                } else if ($paymentStatus == 1){
                                                                                                    ?>
                                                                                                    <i class="fa-solid fa-circle-check" style="color: green;"> </i>
                                                                                                    <?php
                                                                                                    echo "Chuyển khoản (Đã thanh toán)";
                                                                                                }
                                                                                            } else if ($paymentForm == 2) {
                                                                                                echo "Thanh toán khi nhận hàng";
                                                                                            }
                                                                                        ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="card card-body">
                                                                            <table class="table rounded table-responsive-md">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th scope="col" colspan="2">Tên sản phẩm</th>
                                                                                    <th scope="col">Số lượng</th>
                                                                                    <th scope="col">Số tiền</th>
                                                                                    <th scope="col">Trạng thái</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                                if ($listOrder > 0) {
                                                                                    $totalPrice = 0;
                                                                                    foreach($listOrder as $keyOrderProduct => $order){
                                                                                        $totalPrice += $order['totalPrice'];
                                                                                        $paymentForm = $order['paymentform'];
                                                                                        $paymentStatus = $order['paymentstatus'];
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td scope="row">
                                                                                            <img src="<?php echo $order['link'] ?>" alt="<?php echo $order['name'] ?>" style="width: 100px">
                                                                                        </td>
                                                                                        <td><?php echo $order['name'] ?></td>
                                                                                        <td><?php echo $order['totalQuantity'] ?></td>
                                                                                        <td><?php echo number_format($order['totalPrice'], 0, ',', '.') ?> VNĐ</td>
                                                                                        <td>
                                                                                            <?php
                                                                                            if ($order['orderstatus'] == 0) {
                                                                                                echo 'Chờ xử lý';
                                                                                            } else if ($order['orderstatus'] == 1) {
                                                                                                echo 'Đang giao hàng';
                                                                                            } else {
                                                                                                echo 'Giao hành thành công';
                                                                                            }
                                                                                            ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <?php 
                                                                                        if ($paymentForm == 1) {
                                                                                            if ($paymentStatus == 0) {
                                                                                                ?>
                                                                                                <td>
                                                                                                    <form action="code-handle/code-checkOrder.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>" method="POST">
                                                                                                        <button class="btn btn-outline-primary" name="btn_checkPayment">Đã thanh toán</button>
                                                                                                    </form>
                                                                                                </td>
                                                                                                <?php
                                                                                            } else if ($paymentStatus == 1) {
                                                                                                ?>
                                                                                                <td>
                                                                                                    <form action="code-handle/code-checkOrder.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>" method="POST">
                                                                                                        <button class="btn btn-outline-primary" name="btn_checkOrderStatus" onclick="window.open('code-handle/code-printerBill.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>')">Nhận đơn</button>
                                                                                                    </form>
                                                                                                    </td>
                                                                                                <?php
                                                                                            }
                                                                                        } else if($paymentForm == 2) {
                                                                                            ?>
                                                                                            <td>
                                                                                                <form action="code-handle/code-checkOrder.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>" method="POST">
                                                                                                    <button class="btn btn-outline-primary" name="btn_checkOrderStatus" onclick="window.open('code-handle/code-printerBill.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>')">Nhận đơn</button>
                                                                                                </form>
                                                                                                </td>
                                                                                            <?php
                                                                                        }
                                                                                        
                                                                                        ?>
                                                                                        
                                                                                        <td colspan="4">
                                                                                            <p class="text-right"><b>Tổng tiền</b>: <?php echo number_format($totalPrice, 0, ',', '.') ?> VNĐ</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th>Thanh toán</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ref_order  = "Orders";
                                        $ref_info  = "User_Info";
                                        $listUser = $database->getReference($ref_order)->getValue();
                                        $countStt = 0;
                                        if ($listUser > 1) {
                                            foreach($listUser as $keyUser => $user){
                                                $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getValue();
                                                $info = $database->getReference($ref_info)->getChild($keyUser)->getValue();
                                                if ($info > 0) {
                                                    $info_name = $info['name'];
                                                    $info_email = $info['email'];
                                                    $info_phone = $info['phone'];
                                                    $info_address = $info['address'];
                                                }
                                                if ($listOrder > 0) {
                                                    foreach($listOrder as $keyOrder => $order){
                                                        $status = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                        if ($status > 0) {
                                                            foreach($status as $keyStatus => $status){
                                                                $orderStatus = $status['orderstatus'];
                                                            }
                                                        }
                                                        if ($orderStatus == 1) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo ++$countStt; ?></th>
                                                            <td><?php echo $keyOrder ?></td>
                                                            <td>
                                                                <?php
                                                                    $listInfoProduct = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                    if ($listInfoProduct > 0) {
                                                                        foreach($listInfoProduct as $keyProduct => $product){
                                                                            echo $product['created'];
                                                                            break;
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $listInfoProduct = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                    if ($listInfoProduct > 0) {
                                                                        foreach($listInfoProduct as $keyProduct => $product){
                                                                            $paymentForm = $product['paymentform'];
                                                                            $paymentStatus = $product['paymentstatus'];
                                                                            if ($paymentForm == 1) {
                                                                                echo "Chuyển khoản";
                                                                            } else if ($paymentForm == 2) {
                                                                                echo "Thanh toán khi nhận hàng";
                                                                            }
                                                                            break;
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a class="text-decoration-none text-danger" data-toggle="collapse" href="#collapseExample<?php echo $keyOrder ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $keyOrder ?>">
                                                                    Chi tiết
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <div class="collapse" id="collapseExample<?php echo $keyOrder ?>">
                                                                    <!-- thông tin giao hàng -->
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-12 px-1">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                            <p><b>Thông tin: </b></p>
                                                                            <p>Họ tên: <?php echo $info_name ?></p>
                                                                            <p>Số điện thoại: <?php echo $info_phone ?></p>
                                                                            <p>Địa chỉ: <?php echo $info_address ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-6 px-1 mb-2">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                                <p><b>Phí vận chuyển</b></p>
                                                                                <p>0 đ</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 px-1 mb-2">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                                <div class="col-md-10">
                                                                                    <p><b>Phương thức thanh toán</b></p>
                                                                                </div>
                                                                                <p>
                                                                                    <?php
                                                                                        if ($paymentForm == 1) {
                                                                                            if ($paymentStatus == 0) {
                                                                                                ?>
                                                                                                <i class="fa-solid fa-circle-xmark" style="color:red;"> </i>
                                                                                                <?php
                                                                                                echo "Chuyển khoản";
                                                                                                ?>
                                                                                                <?php
                                                                                            } else if ($paymentStatus == 1){
                                                                                                ?>
                                                                                                <i class="fa-solid fa-circle-check" style="color: green;"> </i>
                                                                                                <?php
                                                                                                echo "Chuyển khoản (Đã thanh toán)";
                                                                                            }
                                                                                        } else if ($paymentForm == 2) {
                                                                                            echo "Thanh toán khi nhận hàng";
                                                                                        }
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card card-body">
                                                                        <table class="table rounded table-responsive-md">
                                                                            <thead>
                                                                                <tr>
                                                                                <th scope="col" colspan="2">Tên sản phẩm</th>
                                                                                <th scope="col">Số lượng</th>
                                                                                <th scope="col">Số tiền</th>
                                                                                <th scope="col">Trạng thái</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                            $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                            if ($listOrder > 0) {
                                                                                $totalPrice = 0;
                                                                                foreach($listOrder as $keyOrderProduct => $order){
                                                                                    $totalPrice += $order['totalPrice'];
                                                                                    $paymentForm = $order['paymentform'];
                                                                                    $paymentStatus = $order['paymentstatus'];
                                                                                ?>
                                                                                <tr>
                                                                                    <td scope="row">
                                                                                        <img src="<?php echo $order['link'] ?>" alt="<?php echo $order['name'] ?>" style="width: 100px">
                                                                                    </td>
                                                                                    <td><?php echo $order['name'] ?></td>
                                                                                    <td><?php echo $order['totalQuantity'] ?></td>
                                                                                    <td><?php echo number_format($order['totalPrice'], 0, ',', '.') ?> VNĐ</td>
                                                                                    <td>
                                                                                        <?php
                                                                                            if ($order['orderstatus'] == 0) {
                                                                                                echo 'Chờ xử lý';
                                                                                            } else if ($order['orderstatus'] == 1) {
                                                                                                echo 'Đang giao hàng';
                                                                                            } else {
                                                                                                echo 'Giao hành thành công';
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <a href="code-handle/code-printerBill.php?idUser=<?php echo $keyUser ?>&idOrder=<?php echo $keyOrder ?>" class="btn btn-outline-primary" target="_blank">In lại hóa đơn</a>
                                                                                    </td>
                                                                                    <td colspan="4">
                                                                                        <p class="text-right"><b>Tổng tiền</b>: <?php echo number_format($totalPrice, 0, ',', '.') ?> VNĐ</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Giao thành công -->
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th>Thanh toán</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ref_order  = "Orders";
                                        $ref_info  = "User_Info";
                                        $listUser = $database->getReference($ref_order)->getValue();
                                        $countStt = 0;
                                        if ($listUser > 1) {
                                            foreach($listUser as $keyUser => $user){
                                                $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getValue();
                                                $info = $database->getReference($ref_info)->getChild($keyUser)->getValue();
                                                if ($info > 0) {
                                                    $info_name = $info['name'];
                                                    $info_email = $info['email'];
                                                    $info_phone = $info['phone'];
                                                    $info_address = $info['address'];
                                                }
                                                if ($listOrder > 0) {
                                                    foreach($listOrder as $keyOrder => $order){
                                                        $status = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                        if ($status > 0) {
                                                            foreach($status as $keyStatus => $status){
                                                                $orderStatus = $status['orderstatus'];
                                                            }
                                                        }
                                                        if ($orderStatus == 2) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo ++$countStt; ?></th>
                                                            <td><?php echo $keyOrder ?></td>
                                                            <td>
                                                                <?php
                                                                    $listInfoProduct = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                    if ($listInfoProduct > 0) {
                                                                        foreach($listInfoProduct as $keyProduct => $product){
                                                                            echo $product['created'];
                                                                            break;
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $listInfoProduct = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                    if ($listInfoProduct > 0) {
                                                                        foreach($listInfoProduct as $keyProduct => $product){
                                                                            $paymentForm = $product['paymentform'];
                                                                            $paymentStatus = $product['paymentstatus'];
                                                                            if ($paymentForm == 1) {
                                                                                echo "Chuyển khoản";
                                                                            } else if ($paymentForm == 2) {
                                                                                echo "Thanh toán khi nhận hàng";
                                                                            }
                                                                            break;
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a class="text-decoration-none text-danger" data-toggle="collapse" href="#collapseExample<?php echo $keyOrder ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $keyOrder ?>">
                                                                    Chi tiết
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <div class="collapse" id="collapseExample<?php echo $keyOrder ?>">
                                                                    <!-- thông tin giao hàng -->
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-12 px-1">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                            <p><b>Thông tin: </b></p>
                                                                            <p>Họ tên: <?php echo $info_name ?></p>
                                                                            <p>Số điện thoại: <?php echo $info_phone ?></p>
                                                                            <p>Địa chỉ: <?php echo $info_address ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-between">
                                                                        <div class="col-md-6 px-1 mb-2">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                                <p><b>Trạng thái giao hàng</b></p>
                                                                                <p>Giao hàng thành công</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 px-1 mb-2">
                                                                            <div class="px-2 py-2 border border-secondary rounded">
                                                                                <div class="col-md-10">
                                                                                    <p><b>Phương thức thanh toán</b></p>
                                                                                </div>
                                                                                <p>
                                                                                    <?php
                                                                                        if ($paymentForm == 1) {
                                                                                            if ($paymentStatus == 0) {
                                                                                                ?>
                                                                                                <i class="fa-solid fa-circle-xmark" style="color:red;"> </i>
                                                                                                <?php
                                                                                                echo "Chuyển khoản";
                                                                                                ?>
                                                                                                <?php
                                                                                            } else if ($paymentStatus == 1){
                                                                                                ?>
                                                                                                <i class="fa-solid fa-circle-check" style="color: green;"> </i>
                                                                                                <?php
                                                                                                echo "Chuyển khoản (Đã thanh toán)";
                                                                                            }
                                                                                        } else if ($paymentForm == 2) {
                                                                                            echo "Thanh toán khi nhận hàng";
                                                                                        }
                                                                                    ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card card-body">
                                                                        <table class="table rounded table-responsive-md">
                                                                            <thead>
                                                                                <tr>
                                                                                <th scope="col" colspan="2">Tên sản phẩm</th>
                                                                                <th scope="col">Số lượng</th>
                                                                                <th scope="col">Số tiền</th>
                                                                                <th scope="col">Trạng thái</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                            $listOrder = $database->getReference($ref_order)->getChild($keyUser)->getChild($keyOrder)->getValue();
                                                                            if ($listOrder > 0) {
                                                                                $totalPrice = 0;
                                                                                foreach($listOrder as $keyOrderProduct => $order){
                                                                                    $totalPrice += $order['totalPrice'];
                                                                                    $paymentForm = $order['paymentform'];
                                                                                    $paymentStatus = $order['paymentstatus'];
                                                                                ?>
                                                                                <tr>
                                                                                    <td scope="row">
                                                                                        <img src="<?php echo $order['link'] ?>" alt="<?php echo $order['name'] ?>" style="width: 100px">
                                                                                    </td>
                                                                                    <td><?php echo $order['name'] ?></td>
                                                                                    <td><?php echo $order['totalQuantity'] ?></td>
                                                                                    <td><?php echo number_format($order['totalPrice'], 0, ',', '.') ?> VNĐ</td>
                                                                                    <td>
                                                                                        <?php
                                                                                            if ($order['orderstatus'] == 0) {
                                                                                                echo 'Chờ xử lý';
                                                                                            } else if ($order['orderstatus'] == 1) {
                                                                                                echo 'Đang giao hàng';
                                                                                            } else {
                                                                                                echo 'Giao hành thành công';
                                                                                            }
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                                <tr>
                                                                                    <td colspan="5">
                                                                                        <p class="text-right"><b>Tổng tiền</b>: <?php echo number_format($totalPrice, 0, ',', '.') ?> VNĐ</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 py-0 pl-2 pr-0">
                    <div class="border border-secondary rounded px-4 py-4" style="height: 100%">
                        <div class="row mb-3">
                            <h5>Hoạt động gần đây</h5>
                        </div>
                        <?php
                            $ref_info = "User_Info";
                            $listWork = $database->getReference($ref_info)->getValue();

                            $datetime = new DateTime();
                            $timezone = new DateTimeZone('Asia/Bangkok');
                            $now = $datetime->setTimezone($timezone)->format('d-m-Y G:i:s');

                            if ($listWork > 0) {
                                foreach ($listWork as $keyUser => $work) {
                                    $updated = $work['updated'];
                                    $diff = abs(strtotime($now) - strtotime($updated));
                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                                    $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                    $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);
                                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                                    if ($years < 1 && $months < 1) {
                                        if ($days > 0) {
                                            $showTime = $days." ngày, ".$hours." giờ, ".$minutes." phút trước";
                                        } else if ($hours > 0){
                                            $showTime = $hours." giờ, ".$minutes." phút trước";
                                        } else if ($minutes > 0) {
                                            $showTime = $minutes." phút trước";
                                        } else {
                                            $showTime = "Đang hoạt động";
                                        }
                                    }
                                    ?>
                                    <div class="row mb-2 rounded-pill shadow-sm" style="background-color: #d7f1cd42;">
                                        <div class="col-md-3 px-0 py-0">
                                            <img src="<?php echo $work['image'] ?>" class="img-thumbnail rounded-circle" alt="..." style="height: 70px; width: 70px">
                                        </div>
                                        <div class="col-md-9 align-self-center">
                                            <p class="mb-1"><?php echo $work['email'] ?></p>
                                            <p class="mb-1" style="font-size: 14px">10 phút trước</p>
                                            <!-- <p class="mb-1" style="font-size: 14px"><?php echo $showTime ?></p> -->
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php include("../components/backend/footerBody.php") ?>
        </div>
    </div>
</body>
<?php include("../components/backend/footer.php") ?>