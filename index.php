
<?php include("components/frontend/index/header.php") ?>
<?php include("includes/dbconfig.php") ?>
<?php include("components/frontend/index/menu.php") ?>
<?php include("components/frontend/users/toasts.php") ?>
<div class="wrapper">
  <!-- slide -->
   <div class="clearfix"></div>
   <div class="hom-slider">
      <div class="container">
         <div id="sequence">
            <div class="sequence-prev">
               <i class="fa fa-angle-left"></i>
            </div>
            <div class="sequence-next">
               <i class="fa fa-angle-right"></i>
            </div>
            <ul class="sequence-canvas">
               <li class="animate-in">
                  <div class="flat-caption caption1 formLeft delay300 text-center">
                     <span class="suphead">Mẫu thiết kế hiện đại 2023</span>
                  </div>
                  <div style="margin-top: 20px" class="flat-caption caption2 formLeft delay400 text-center">
                     <h1>Những mẫu áo mới nhất</h1>
                  </div>
                  <div class="flat-caption caption3 formLeft delay500 text-center">
                     <p></p>
                  </div>
                  <div class="flat-button caption4 formLeft delay600 text-center">
                     <a class="more" href="#">Xem thêms</a>
                  </div>
                  <div class="flat-image formBottom delay200" data-duration="5" data-bottom="true">
                     <img src="public/frontend/images/slider1.png" alt="">
                  </div>
               </li>
               <li>
                  <div class="flat-caption caption2 formLeft delay400">
                     <h1>Chất liệu sản phẩm đẹp đẽ</h1>
                  </div>
                  <div class="flat-caption caption3 formLeft delay500">
                     <p></p>
                  </div>
                  <div class="flat-button caption5 formLeft delay600">
                     <a class="more" href="#">Xem thêm</a>
                  </div>
                  <div class="flat-image formBottom delay200" data-bottom="true">
                     <img src="public/frontend/images/slider2.png" alt="">
                  </div>
               </li>
               <li>
                  <div class="flat-caption caption2 formLeft delay400 text-center">
                     <h1>Thời trang dẫn đầu xu thế</h1>
                  </div>
                  <div class="flat-caption caption3 formLeft delay500 text-center">
                     <p></p>
                  </div>
                  <div class="flat-button caption4 formLeft delay600 text-center">
                     <a class="more" href="#">Xem thêm</a>
                  </div>
                  <div class="flat-image formBottom delay200" data-bottom="true">
                     <img src="public/frontend/images/slider3.png" alt="">
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
   <!--hot product -->
   <div class="clearfix"></div>
   <div class="container_fullwidth">
      <div class="container">
         <?php 
            $ref_product = 'Products';
            $ref_category = "Categories";
            $listCategory = $database->getReference($ref_category)->getValue();

            if ($listCategory > 0) {
               foreach($listCategory as $keyCategory => $category){
                  $product = $database->getReference($ref_product)->getChild($keyCategory)->getValue();
                  ?>
                  <div class="row">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb" style="font-size: 20px; padding-top: 20px; padding-bottom: 20px">
                           <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                           <li class="breadcrumb-item active" aria-current="page"><a href="users/products.php?idCategory=<?php echo $keyCategory ?>"><?php echo $category['Category-name'] ?></a></li>
                        </ol>
                     </nav>
                     <div class="row">
                        <?php 
                        if ($product > 0) {
                           $i = 0;
                           foreach(array_slice($product,0,8) as $keyProduct => $row){
                           $intoMoney = $row['price'] - $row['price'] * $row['sale'] / 100;
                           ?> 
                              <div class="col-md-3 col-sm-6">
                                 <div class="products">
                                    <div class="offer">- <?php echo $row['sale'] ?>%</div>
                                    <div class="thumbnail">
                                       <a href="users/detail-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>">
                                          <img style="height:220px" src="<?php echo $row['imageUrl'] ?>">
                                       </a>
                                    </div>
                                    <div class="productname" style="height: 50px"> <?php echo $row['name'] ?> </div>
                                    <p class="text-decoration-line-through text-center"><del><?php echo number_format($row['price'], 0, ',', '.') ?></del><sup> đ</sup></p>
                                    <h4 class="price"><?php echo number_format($intoMoney , 0, ',', '.') ?> <sup>đ</sup></h4>
                                    <div class="button_group">
                                       <a href="users/detail-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" class="button add-cart" type="button">Mua ngay!</a>
                                       <button class="button compare" type="button">
                                          <i class="fa fa-exchange"></i>
                                       </button>
                                       <a href="users/code-handle/code-favoriteProducts.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" class="button wishlist" name="btn_favoriteProducts">
                                       <?php 
                                          $ref_favorite = 'Favorite';
                                          $count = 0;
                                          if (isset($_SESSION['id_user'])) {
                                             $fetchFavorite = $database->getReference($ref_favorite)->getChild($_SESSION['id_user'])->getChild($keyProduct)->getValue();
                                             if($fetchFavorite > 0){
                                                $count+=1;
                                             }
                                             if ($count == 1) {
                                                ?>
                                                <i class="fa fa-heart"></i>
                                                <?php
                                             } else {
                                                ?>
                                                <i class="fa fa-heart-o"></i>
                                                <?php
                                             }
                                          } else {
                                                ?>
                                                <i class="fa fa-heart-o"></i>
                                                <?php
                                             }
                                          ?>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           <?php
                              }
                           }
                           ?> 
                     </div>
                  </div>
                  <br><br>
               <?php
                  }
               }
            ?>
         </div>
      </div>
   </div>
   <!-- chat dialogflow -->
   <?php include("components/frontend/index/chat.php") ?>
</div>


<?php include("components/frontend/footer.php") ?>
<?php include("components/frontend/index/footer.php") ?>