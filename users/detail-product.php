<?php session_start(); ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../components/frontend/users/menu.php") ?>
<?php include("../components/frontend/users/toasts.php") ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
	@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap');
	p,li {
		font-size: 16px;
		font-family: 'Raleway', sans-serif;
		padding: 5px 0 5px 0;
	}
</style>

<?php 
	if (isset($_GET['idProduct']) && isset($_GET['idCategory']) && $_GET['idProduct'] != '' && $_GET['idCategory'] != '') {
		$idProduct = $_GET['idProduct'];
		$idCategory = $_GET['idCategory'];
	
		$ref_table = 'Products';
		$fetchdata = $database->getReference($ref_table)->getChild($idCategory)->getChild($idProduct)->getValue();

		if ($fetchdata > 0) {
			$i = 0;
			$image = $fetchdata['imageUrl'];
			$name = $fetchdata['name'];
			$price = $fetchdata['price'];
			$sale = $fetchdata['sale'];
			$intro = $fetchdata['restorant'];
			$amount = $fetchdata['amount'];
			$size = $fetchdata['size'];
			$origin = $fetchdata['origin'];
			$intoMoney = $price - $price * $sale / 100;
			$price_format = number_format($intoMoney, 0, ',', '.');	
		}
	} else {
		header('Location: products.php');
	}
?>

<div class="wrapper">
	<div class="clearfix"> </div>
	<div class="container_fullwidth">
		<div class="container">
			<div class="row">
				<div class="col-md-12 border border-secondary rounded">
					<h3>Thông tin sản phẩm</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="products-details">
						<!-- list -->
						<div class="preview_image">
							<div class="preview-small">
								<img style="width:300px;height:370px" id="zoom_03" src="<?php echo $image ?>" data-zoom-image="<?php echo $image ?>" alt="<?php echo $image ?>">
							</div>
						</div>
						<div class="products-description">
							<h2 class="name"><?php echo $name ?></h2>
							<p><img alt="" src="../public/frontend/images/star.png"></p>
							<p> Kho: <?php echo $amount ?></p>
							<p> Xuất xứ: <?php echo $origin ?></p>
							<div class="row">
								<div class="col-md-2">
									<p style="font-size: 14px">Phí vận chuyển:</p>
								</div>
								<div class="col-md-5">
									<p style="font-size: 14px">-Trong tỉnh :<span style="color:green"> 10.000đ - 30.000đ</span></p>
									<p style="font-size: 14px">-Ngoại tỉnh :<span style="color:green"> 20.000đ - 50.000đ</span></p>
								</div>
							</div>
							<hr class="border">
							<div class="price"> Giá :
								<span class="new_price">
									<?php echo $price_format ?>
									<sup>đ</sup>
								</span>
								<span>
									<del>
										<?php echo number_format($price, 0, ',', '.') ?>
									</del>
									<sup>đ</sup>
								</span>
								<span class="alert alert-danger px-1 py-1" style="font-weight:bold">- <?php echo $sale ?>%</span>
							</div>
							<form action="code-handle/code-cart.php?idCategory=<?php echo $idCategory ?>&idProduct=<?php echo $idProduct ?>" method="POST">
								<hr class="border">
								<div class="wided">
									<div class="qty"> Số lượng: &nbsp;&nbsp;
										<input style="width: 100px" type="number" value="1" min="1" name="totalQuantity">
									</div>
									<!-- Check số lượng size -->
									<?php 
									if($size == 2) {
										?>
										<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="size" style="font-weight: bold">
											<option value="1" selected>Size M</option>
											<option value="2">Size L</option>
										</select>
										<?php
									} elseif($size == 3) {
										?>
										<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="size" style="font-weight: bold">
											<option value="1" selected>Size M</option>
											<option value="2">Size L</option>
											<option value="3">Size XL</option>
										</select>
										<?php
									} elseif($size == 4) {
										?>
										<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="size" style="font-weight: bold">
											<option value="1" selected>Size M</option>
											<option value="2">Size L</option>
											<option value="3">Size XL</option>
											<option value="3">Size XXL</option>
										</select>
										<?php
									}
									?>
									<div class="button_group">
										<button class="button" name="add_cart"> Thêm giỏ hàng</button>
										<button class="button favorite"> <i class="fa fa-heart-o"></i> </button>
										<button class="button favorite"> <i class="fa fa-envelope-o"></i> </button>
									</div>
								</div>
							</form>
							<div class="clearfix"></div>
							<hr class="border">
							<img src="../public/frontend/images/share.png" alt="" class="pull-right">
						</div>
					</div>
					<div class="clearfix"> </div>
					<div class="tab-box">
						<div id="tabnav">
							<ul>
								<li>
									<a href="#Descraption">Mô tả</a>
								</li>
								<li>
									<a href="#Reviews">Đánh giá</a>
								</li>
							</ul>
						</div>
					<!-- Bình luận -->
					<div class="tab-content-wrap">
						<div class="tab-content" id="Descraption">
							<?php echo $intro ?>
						</div>
						<div class="tab-content" id="Reviews">
							<div class="row" style="padding: 20px 0 30px 0">
								<div class="col-sm-6 col-md-6">
									<h4>Đánh giá sản phẩm</h4>
									<p>Chưa có đánh giá nào</p>
								</div>
							</div>
							<div class="row details-comments" style="padding: 0;">
            					<div class="col-md-12">
								<?php 
									$ref_commentBlog = "Comment_Product";
									$ref_infoUser = "User_Info";
									$countBlog = 0;
									$listCommentBlog = $database->getReference($ref_commentBlog)->getChild($_GET['idProduct'])->getValue();
									if ($listCommentBlog > 0) {
										foreach ($listCommentBlog as $keyUser => $user) {
											$userInfo = $database->getReference($ref_infoUser)->getChild($keyUser)->getValue();
											$detailComment = $database->getReference($ref_commentBlog)->getChild($_GET['idProduct'])->getChild($keyUser)->getValue();
											if ($detailComment > 0) {
												foreach ($detailComment as $keyComment => $comment) {
													?>
													<div class="media" style=" display: flex; flex-direction: row; border: 1px solid #E1E1E1; padding: 10px; border-radius: 10px;">
														<img class="image-comment" src="<?php echo $userInfo['image'] ?>" style="margin-right: 10px; width: 80px; height: 100%">
														<div class="media-body" style="padding: 0">
															<h5 class="mt-0"><?php echo $userInfo['email'] ?></h5>
															<div style="margin: 5px 0 5px 0">
																<?php
																	for ($i=1; $i <= $comment['star']; $i++) { 
																		echo '<i class="fa-solid fa-star"></i>';
																	}
																	for ($j=1; $j <= 5-$comment['star']; $j++) { 
																		echo '<i class="fa-regular fa-star"></i>';
																	}
																?>
																<!-- <i class="fa-solid fa-star-half-stroke"></i> -->
															</div>
															<?php echo $comment['created'] ?>
															<div class="row">
																<div class="col-md-12">
																	<p style="margin-top: 20px"><?php echo $comment['comment'] ?></p>
																</div>
															</div>
														</div>
													</div>
													<?php
												}
											}
										}
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="alert" role="alert" style="color: white">
					&nbsp;
				</div>
				<?php
					if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != '') {
						$curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_URL => 'http://127.0.0.1:5000/api/recommend_product',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						CURLOPT_POSTFIELDS =>'{
							"_id":"'.$_SESSION['id_user'].'"
						}',
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json'
						),
						));
						
						$response = curl_exec($curl);
						
						curl_close($curl);
						$response = json_decode($response, true);
						$ref_product = "Products";
						?>
						<h3 style="margin: 0 0 30px 20px">Sản phẩm đề xuất</h3>
						<?php

						foreach ($response as $value) {
							$idCategory = "0".$value['Category'];
							$listProduct = $database->getReference($ref_product)->getChild($idCategory)->getChild($value['ID'])->getValue();
							?>
							<div class="col-md-3 col-sm-6">
								<div class="products">
									<div class="offer">- <?php echo $listProduct['sale'] ?>%</div>
									<div class="thumbnail">
										<a href="detail-product.php?idCategory=<?php echo $idCategory ?>&idProduct=<?php echo $value['ID'] ?>">
										<img style="height:220px" src="<?php echo $listProduct['imageUrl'] ?>">
										</a>
									</div>
									<div class="productname" style="height: 50px"> <?php echo $listProduct['name'] ?> </div>
									<p class="text-decoration-line-through text-center"><del><?php echo number_format($listProduct['price'], 0, ',', '.') ?></del><sup> đ</sup></p>
									<h4 class="price"><?php echo number_format($intoMoney , 0, ',', '.') ?> <sup>đ</sup></h4>
									<div class="button_group">
										<a href="detail-product.php?idCategory=<?php echo $idCategory ?>&idProduct=<?php echo $value['ID'] ?>" class="button add-cart" type="button">Mua ngay!</a>
										<button class="button compare" type="button">
										<i class="fa fa-exchange"></i>
										</button>
									</div>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/users/footer.php") ?>