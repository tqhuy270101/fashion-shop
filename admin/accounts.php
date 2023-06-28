<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<body class="bg03">
    <div class="container">
        <div class="row tm-content-row tm-mt-big">
            <div class="tm-col tm-col-big">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Accounts</h2>
                        </div>
                    </div>
                    
                    <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
                        <?php 
                            $ref_Info = "User_Info";
                            $listInfo = $database->getReference($ref_Info)->getValue();
                            if ($listInfo > 0) {
                                foreach($listInfo as $keyUser => $row){
                                ?>
                                <li class="tm-list-group-item">
                                    <a href="accounts.php?id=<?php echo $keyUser ?>"><?php echo $row['email'] ?></a>
                                </li>
                                <?php
                                }
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            <div class="tm-col tm-col-big">
                <div class="bg-white tm-block">
                    <?php 
                    if (isset($_GET['id']) && $_GET['id'] != '') {
                        $ref_Info = "User_Info";
                        $listInfo = $database->getReference($ref_Info)->getChild($_GET['id'])->getValue();
                        if ($listInfo > 0) {
                            $name = $listInfo['name'];
                            $email = $listInfo['email'];
                            $phone = $listInfo['phone'];
                            $address = $listInfo['address'];
                            $phanQuyen = $listInfo['phanQuyen'];
                        }
                        ?>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title">Edit Account</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="code-handle/code-account.php?id=<?php echo $_GET['id'] ?>" method="POST">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input value="<?php echo $name ?>" name="username" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input readonly value="<?php echo $email ?>" type="email" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input readonly value="'.$row['password'].'" type="password" class="form-control" >
                                        </div>
                                        <div class="col-2" style="margin-top:9px">
                                            <a  href="doimatkhau.php"><i style="font-size:30px" class="fas fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="phone">Phân Quyền:</label>
                                        </div>
                                        <?php 
                                            if ($phanQuyen == 'admin') {
                                            ?>
                                                <div class="col-3">
                                                    <input type="radio" name="phanQuyen" value="user"required > User
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" name="phanQuyen" value="admin" required checked> Admin
                                                </div>
                                            <?php
                                            } else {
                                                ?>
                                                <div class="col-3">
                                                    <input type="radio" name="phanQuyen" value="user" checked required > User
                                                </div>
                                                <div class="col-4">
                                                    <input type="radio" name="phanQuyen" value="admin" required> Admin
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input value="<?php echo $phone ?>" name="phone" type="tel" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Địa chỉ</label>
                                    <input value="<?php echo $address ?>" name="address" type="tel" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <button name="updateInfo" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="tm-col tm-col-small">
            </div>
        </div>
        <?php include("../components/backend/footerBody.php") ?>
    </div>
</body>
<?php include("../components/backend/footer.php") ?>


