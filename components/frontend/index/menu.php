<div class="wrapper">
   <div class="header" id="header">
      <div class="container">
         <div class="row">
            <div class="col-md-2 col-sm-2">
               <div class="logo"><a href="http://localhost/musical-dacn1/"><img src="public/frontend/images/logo.png" alt="FlatShop"></a></div>
            </div>
            <div class="col-md-10 col-sm-10">
               <div class="header_top">
                  <div class="row">
                     <div class="col-md-9"></div>
                     <div class="col-md-3">
                        <ul class="usermenu">
                           <?php
                           session_start();                              
                           if(empty($_SESSION['email_user'])){
                              echo '
                              <li><a href="users/login.php" class="log">Đăng nhập</a></li>
                              <li><a href="users/register.php" class="reg">Đăng ký</a></li>';
                           }
                           else {
                        ?>
                              <div class="btn-group">
                              <button type="button"  class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                 <?php echo $_SESSION['email_user']; ?><img style="margin-left:20px" src="public/frontend/images/dropdown.png">
                              </button>
                              <ul class="dropdown-menu">
                                 <li><p style="font-size:20px" class="dropdown-item">&nbsp;&nbsp;<?php echo $_SESSION['username'] ?></p></li><br><br>
                                 <?php 
                                    if ($_SESSION['phanQuyen'] == 'admin') {
                                       echo '<li><a class="dropdown-item" href="admin/dashboard.php">Trang quản trị</a></li>';
                                    }
                                 ?>
                                 <li><a class="dropdown-item" href="users/profile.php">Hồ sơ của tôi</a></li>
                                 <li><a class="dropdown-item" href="users/lichsu-thanhtoan.php">Đơn hàng của bạn</a></li>
                                 <li><a class="dropdown-item" href="users/logout.php">Đăng xuất</a></li>
                              </ul>
                              </div>
                              <?php
                           }
                           ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
            <div class="header_bottom">
               <ul class="option">
                  <li id="search" class="search">
                     <form action="users/search.php" method="GET">
                        <button class="search-submit"></button>
                        <input class="search-input" placeholder="Enter để tìm kiếm.." type="text"  name="search">
                     </form>
                  </li>

                  <?php 
                     if (isset($_SESSION['email_user'])){
                        $idUser = $_SESSION['id_user'];
                        $ref_cart = "Carts/".$idUser;
                        $count_cart = $database->getReference($ref_cart)->getSnapshot()->numChildren();
                      ?>
                        <li class="option-cart">
                        <a href="users/cart.php" class="cart-icon">cart <span class="cart_no"><?php echo $count_cart ?></span></a>
                     <?php
                     }
                  ?>
                     <ul class="option-cart-item" style="width: 310px">
                     <?php 
                     if ($_SESSION['email_user']) {
                        $idUser = $_SESSION['id_user'];
                        $ref_cart = "Carts/".$idUser;
                        $ref_product = "Products";
                        $data_cart = $database->getReference($ref_cart)->getValue();
                        if ($data_cart > 0) {
                           $totol_money = 0;
                           foreach($data_cart as $key_cart => $cart){
                              $data_cart1 = $database->getReference($ref_product)->getChild($cart['idCategory'])->getChild($cart['idProduct'])->getValue();
                              $totol_price = $data_cart1['price'] * $cart['totalQuantity'];
                              $totol_money += $totol_price; 
                              ?>
                              <div class="cart-item">
                                 <div class="image"><img src="<?php echo $data_cart1['imageUrl'] ?>" alt=""></div>
                                 <div class="item-description">
                                    <a href="#" class="name"><?php echo $data_cart1['name'] ?></a>
                                    <p>
                                       Số lượng: 
                                       <span class="light-red"><?php echo $cart['totalQuantity'] ?></span>
                                       <br>
                                       Giá
                                       <span class="light-red"><?php echo number_format($data_cart1['price'], 0, ',', '.'); ?><sup> đ</sup></span>
                                    </p>
                                 </div>
                                 <div class="right">
                                    <p  class="price"><?php echo number_format($totol_price, 0, ',', '.'); ?><sup> đ</sup></p>
                                    <a href="users/code-handle/code-delete-cart.php?id=<?php echo $key_cart ?>" class="remove"><img src="public/frontend/images/remove.png" alt="remove"></a>
                                 </div>
                              </div>
                              <div>_____________________________o</div>
                              <?php
                           }
                        } else {
                           ?>
                           <h5 align="center" style="margin-top: 10px">Không có sản phẩm nào</h5>
                           <?php
                        }
                     }
                     ?>
                     
                     <div style="margin-top: 10px">
                        <h5 class="text-monospace" style="margin-left: 5px"> 

                           <?php 
                           if (isset($totol_money)) {
                              echo "Tổng tiền:";
                              echo number_format($totol_money, 0, ',', '.');                         
                           ?>
                           <sup> đ</sup>
                           <?php 
                           }
                           ?>
                        </h5>
                     </div>
                     </ul>
                  </li>
                     </ul>
                  </li>
               </ul>
               <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
               <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                     <li>
                        <a href="http://localhost/musical-dacn1/">Trang chủ</a>
                     </li>
                     <?php 
                        $ref_table = 'Categories';
                        $fetchdata = $database->getReference($ref_table)->getValue();

                        if ($fetchdata > 0) {
                            $i = 0;
                            foreach($fetchdata as $key => $row){
                     ?>
                        <li><a href="users/products.php?idCategory=<?php echo $key ?>"><?php echo $row['Category-name']?></a></li>
                     <?php
                        }
                     }
                     ?>
                     <li><a href="users/contact.php">LIÊN HỆ</a></li>
                     <li><a href="users/blog.php">TIN TỨC</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

