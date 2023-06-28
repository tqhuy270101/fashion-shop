<?php 
function vn_to_str ($str){
 
	$unicode = array(
	 
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		
		'd'=>'đ',
		
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		
		'i'=>'í|ì|ỉ|ĩ|ị',
		
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		
		'D'=>'Đ',
		
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		
	);
	 
	foreach($unicode as $nonUnicode=>$uni){
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	$str = str_replace(' ','_',$str);
	return $str;
	 
	}
?>

<?php session_start(); ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/menu.php") ?>
<div class="wrapper">
	<div class="clearfix"></div>
	<div class="container_fullwidth" style="padding: 20px">
		<div class="row">
			<div class="col-md-3">
				<div class="category leftbar">
					<h3 class="title">DANH MỤC</h3>
					<ul>
						<?php 
							$ref_category = 'Categories';
							$fetchdata = $database->getReference($ref_category)->getValue();
							if ($fetchdata > 0) {
								$i = 0;
								foreach($fetchdata as $key => $row){
								?>
									<li>
										<a href="products.php?idCategory=<?php echo $key ?>"><?php echo $row['Category-name']?></a>
									</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
        	<?php 
			if (isset($_GET['search'])) {
				$search = $_GET['search'];
				$ref_product = 'Products';
				$fetchdata = $database->getReference($ref_category)->getValue();
				foreach($fetchdata as $keyCategory => $row){
					$data = $database->getReference($ref_product)->getChild($keyCategory)->getValue();
					if ($data > 0) {
						foreach($data as $keyProducts => $row){
							$price_format = number_format($row['price'], 0, ',', '.');
							$nameProduct = $row['name'];
							$key_search = vn_to_str(strtolower($search));
							$data_name = vn_to_str(mb_strtolower($nameProduct, 'UTF-8'));
							$com = str_contains($data_name, $key_search);
							if ($com != ''){
								?>
								<div class="col-md-4 col-sm-6">
									<div class="products">
										<div class="offer"> New </div>
										<div class="thumbnail">
											<a href="detail-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProducts ?>">
												<img style="width:150px;height:220px" src="<?php echo $row['imageUrl'] ?>" alt="Product Name">
											</a>	
										</div>
										<div class="productname"><?php echo $row['name'] ?></div>
										<h4 class="price"><?php echo $price_format ?>  vnđ</h4>
										<div class="button_group"> <a href="detail-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProducts ?>" class="button add-cart" type="button">Mua ngay!</a>
											<button class="button compare" type="button">
												<i class="fa fa-exchange"></i>
											</button>
											<button class="button wishlist" type="button">
												<i class="fa fa-heart-o"></i>
											</button>
										</div>
									</div>
								</div>
							<?php
							}
						}
					}
				}	
			} else {
				$_SESSION['product-noti'] = 'Không tìm thấy sản phẩm nào';
			}
			?>
			<h5 align="center">
			<?php
				if (isset($_SESSION['product-noti']) && $_SESSION['product-noti'] != "") {
				echo $_SESSION['product-noti'];
				unset($_SESSION['product-noti']);
				}  
			?>
			</h5>
		</div>
    </div>
  </div>
</div>
<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/users/footer.php") ?>