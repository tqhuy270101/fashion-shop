<?php session_start(); ?>
<?php include("../components/frontend/checkAccount.php") ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../components/frontend/users/menu.php") ?>
<?php include("../components/frontend/users/toasts.php") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="wrapper">
  <div class="clearfix"> </div>
  <div class="container_fullwidth">
    <div class="container shopping-cart">
      <div class="row">
        <div class="col-md-12">
          <h3 class="title">Shopping Cart</h3>
          <div class="clearfix"></div>
          <form method="POST">
            <table class="shop-table"  overflow-x=auto>
              <thead>
                <tr>
                  <th>No.1</th>
                  <th>Hình Ảnh</th>
                  <th>Chi tiết sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $idUser = $_SESSION['id_user'];
                  $ref_cart = "Carts";
                  $ref_product = "Products";
                  $data_cart = $database->getReference($ref_cart)->getChild($idUser)->getValue();
                  if ($data_cart > 0) {
                    $count = 0;
                    $totalPriceAllProduct = 0;
                    foreach($data_cart as $key_cart => $row){
                      $data_product = $database->getReference($ref_product)->getChild($row['idCategory'])->getChild($row['idProduct'])->getValue();
                      $intoPrice = $data_product['price'] * $row['totalQuantity'];
                      $intoPriceSale = $intoPrice - $intoPrice * $data_product['sale'] / 100;
                      $totalPriceAllProduct += $intoPriceSale;
                      ?>
                      <tr>
                        <td>
                          <?php echo ++$count ?>
                        <td>
                          <img src="<?php echo $data_product['imageUrl'] ?>" alt="<?php echo $data_product['imageUrl'] ?>">
                        </td>
                        <td>
                          <div class="shop-details">
                            <div class="productname"><?php echo $data_product['name'] ?>(<?php 
                            if ($row['totalQuantity'] == 1) {
                              echo "M";
                            } elseif($row['totalQuantity'] == 2) {
                              echo "L";
                            } elseif ($row['totalQuantity'] == 3) {
                              echo "XL";
                            } elseif ($row['totalQuantity'] == 4) {
                              echo "XXL";
                            }
                            ?>)</div> 
                          </div>
                        </td>
                        <td>
                          <a class="btn" href="code-handle/code-change-amountMinus.php?id=<?php echo $key_cart ?>">
                            <i class="fa-solid fa-minus"></i>
                          </a>
                          <input style="width:60px" type="number" name="totalquantity" value="<?php echo $row['totalQuantity'] ?>" readonly>
                          <a class="btn" href="code-handle/code-change-amountPlus.php?id=<?php echo $key_cart ?>">
                            <i class="fa-solid fa-plus"></i>
                          </a>
                        </td>
                        <td>
                          <h5>
                            <p>
                              <del><?php echo number_format($intoPrice, 0, ',', '.'); ?></del>
                              <sup>đ</sup>
                            </p>
                            <strong class="red"><?php echo number_format($intoPriceSale, 0, ',', '.'); ?><sup>đ</sup></strong>
                          </h5>
                        </td>
                        <td>
                          <a href="code-handle/code-delete-cart.php?id=<?php echo $key_cart ?>">
                            Xóa
                          </a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan = "6">
                        <h5>Không có sản phẩm nào</h5>
                      </td>
                    </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
            <div class="clearfix"> </div>
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="shippingbox">
                  <h5>Thông tin nhận hàng</h5>
                  <div>
                    <?php 
                      $idUser = $_SESSION['id_user'];
                      $ref_profile = "User_Info";
                      $data_profile = $database->getReference($ref_profile)->getChild($idUser)->getValue();
                      if ($data_profile > 0) {
                      ?>
                      <form action="code-handle/code-change-profile.php" method="POST">
                        <label>Họ và tên *</label>
                        <input type="text" name="username" value="<?php echo $data_profile['name'] ?>" require>
                        <label>Quân / Huyện /Số nhà / Đường (Địa chỉ cụ thể) *</label>
                        <input type="text" name="address" value="<?php echo $data_profile['address'] ?>" require>
                        <label> Phone * </label>
                        <input type="text" name="phone" value="<?php echo $data_profile['phone'] ?>" require>
                        <div class="clearfix"> </div>
                        <button name="changeProfile">Thay đổi thông tin nhận hàng</button>
                      </form>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <form action="code-handle/code-order.php" method="POST">
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <h5>Hình thức thanh toán</h5>
                      <label>Chọn hình thức thanh toán mà bạn muốn</label>
                      <div class="form-row" style="display: flex;flex-direction: row; align-items: center">
                        <div class="col" style="margin-right: 10px; margin-top: 15px">
                          <input type="radio" name="payment" value="1" id="payment1" checked>
                        </div>
                        <div class="col" style="font-size: 16px">
                          <label for="payment1">
                            <i class="fa-solid fa-building-columns"></i> Thanh toán bằng chuyển khoản
                          </label>
                        </div>
                      </div>
                      <div class="form-row" style="display: flex;flex-direction: row; align-items: center">
                        <div class="col" style="margin-right: 10px; margin-top: 8px">
                          <input type="radio" name="payment" value="2" id="payment2">
                        </div>
                        <div class="col" style="font-size: 16px">
                          <label for="payment2">
                            <i class="fa-solid fa-money-bill"></i> Thanh toán khi nhận hàng
                          </label>
                        </div>
                      </div>
                      <div class="clearfix"> </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6">
                    <div class="shippingbox">
                      <div class="grandtotal">
                        <h5>Tổng Tiền: </h5>
                        <span>
                          <?php 
                          if (isset($totalPriceAllProduct)) {
                            echo number_format($totalPriceAllProduct, 0, ',', '.');
                            echo '<sup>đ</sup>';
                          } else {
                            echo number_format(0, 0, ',', '.');
                            echo '<sup>đ</sup>';
                          }
                          ?>
                        </span>
                      </div>
                      <input type="submit" name="order" value="Đặt hàng" class="btn btn-primary">
                    </div>
                  </div>
                </form>
              </div>
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
