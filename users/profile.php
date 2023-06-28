<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../public/frontend/images/logo.png">
    <link rel="stylesheet" type="text/css" href="../public/frontend/css/stylehoso.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<title>Hồ Sơ</title>
	<style>
		.title-tab {
			font-family: 'Quicksand', sans-serif;
		}
		.image-favorite {
			width: 100px;
		}
		.fa-solid.fa-star {
			color: #ff6c00;
		}
		.fa-regular.fa-star{
			color: #ff6c00;
		}
		.link-product {
			color: black;
		}
		.name-product {
			font-size: 18px;
			font-weight: bold;
			font-family: 'Quicksand', sans-serif;
		}
		.link-product:hover .name-product{
			color: black;
			font-size: 19px;
			transition: 0.3s;
		}
		.link-image-product:hover .image-favorite {
			width: 105px;
			transition: 0.3s;
		}
	</style>
</head>

<body>
	<?php 
		session_start();
		include('../includes/dbconfig.php');
		include("../components/frontend/checkAccount.php");
		
		if ($_SESSION['id_user']) {
			$ref_profile = "User_Info/";
			$profile = $database->getReference($ref_profile)->getChild($_SESSION['id_user'])->getValue();
			if ($profile) {
				$name = $profile['name'];
				$email = $profile['email'];
				$phone = $profile['phone'];
				$address = $profile['address'];
				$image = $profile['image'];
			}
		} else {
			header("Location: login.php");
		}
	?>
	<?php include("../components/frontend/users/toasts.php") ?>
	
	<div class="container emp-profile">
		<div class="row">
			<div class="col-md-3 a">
				<div class="profile-img">
					<img style="witdh:160px; height:200px" src="<?php echo $image ?>" alt="Ảnh hồ sơ" />
					<form action="code-handle/code-profile.php" method="POST" enctype="multipart/form-data">
						<div class="file btn btn-primary" style="border-radius: 0">
							Thay đổi ảnh
							<input type="file" name="filename">
						</div>
						<button class="btn btn-primary btn_update" name="btn_updateAvatar" style="color: #fff">Cập nhật </button>
					</form>
				</div>
			</div>
			<div class="col-md-9">
				<div class="profile-head">
					<div class="row">
						<div class="col-md-10">
							<h5><?php echo $name ?></h5>
							<h6>THÔNG TIN CỦA BẠN</h6>
							<p class="proile-rating">ĐIỂM TÍCH LŨY : <span>8/10</span></p>
						</div>
						<div class="col-md-2">
							<a class="btn btn-primary" name="btnAddMore" href="../index.php" style="color: #fff">Quay lại</a>
						</div>
					</div>
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Thông tin</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="favorite-tab" data-toggle="tab" data-target="#favorite" type="button" role="tab" aria-controls="favorite" aria-selected="false">Yêu thích</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="order-tab" data-toggle="tab" data-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">Đơn hàng</button>
						</li>
						
					</ul>
				</div>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<div class="row">
							<div class="col-md-12">
								<h5 class="title-tab">Thông tin cá nhân</h5><br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Name</label>
							</div>
							<div class="col-md-6">
								<p><?php echo $name ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Email</label>
							</div>
							<div class="col-md-6">
								<p><?php echo $email ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Phone</label>
							</div>
							<div class="col-md-6">
								<p><?php echo $phone ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label>Địa chỉ</label>
							</div>
							<div class="col-md-6">
								<p><?php echo $address ?></p>
							</div>
						</div>
					</div>

					<!-- favorite product -->
					<div class="tab-pane fade" id="favorite" role="tabpanel" aria-labelledby="favorite-tab">
						<div class="row">
							<div class="col-md-12">
								<h5 class="title-tab">Sản phẩm yêu thích</h5><br>
							</div>
						</div>
						
						<?php
							$ref_favorite = 'Favorite';
							$ref_product = 'Products';
							$fetchFavorite = $database->getReference($ref_favorite)->getChild($_SESSION['id_user'])->getValue();
							if($fetchFavorite > 0){
								foreach ($fetchFavorite as $keyFavorite => $favorite) {
									$fetchProduct = $database->getReference($ref_product)->getChild($favorite['idCategory'])->getValue();
									if ($fetchProduct > 0) {
										foreach ($fetchProduct as $keyProduct => $product) {
											if ($favorite['name'] == $product['name']) {
												?>
												<div class="row border border-secondary rounded" style="margin: 20px; padding: 10px">
													<div class="col-md-2">
														<a class="link-image-product" href="detail-product.php?idCategory=<?php echo $favorite['idCategory'] ?>&idProduct=<?php echo $keyProduct ?>">
															<img class="image-favorite" src="<?php echo $product['imageUrl'] ?>" alt="<?php echo $product['imageUrl'] ?>">
														</a>
													</div>
													<div class="col-md-7" style="padding: 10px">
														<a class="link-product text-decoration-none" href="detail-product.php?idCategory=<?php echo $favorite['idCategory'] ?>&idProduct=<?php echo $keyProduct ?>">
															<p class="name-product"><?php echo $product['name'] ?></p>
														</a>
														<p>Giảm giá: <?php echo $product['sale'] ?> %</p>
														<p>
															<i class="fa-solid fa-star"></i>
															<i class="fa-solid fa-star"></i>
															<i class="fa-solid fa-star"></i>
															<i class="fa-solid fa-star"></i>
															<i class="fa-regular fa-star"></i>
															<span>( 1 đánh giá )</span>
														</p>
													</div>
													<div class="col-md-3 d-flex justify-content-end">
														<div class="d-flex align-items-end flex-column bd-highlight mb-3">
															<div class="p-2 bd-highlight name-product"><?php echo number_format($product['price']-$product['price']*$product['sale']/100, 0, ',', '.') ?> <sup>đ</sup></div>
															<div class="p-2 bd-highlight">
																<span>
																	<del>
																		<?php echo number_format($product['price'], 0, ',', '.') ?>
																	</del>
																	<sup>đ</sup>
																</span>
															</div>
															<div class="mt-auto p-2 bd-highlight"><a href="">Xóa</a></div>
														</div>
													</div>
												</div>
												<?php
											}
										}
									}
								}
							}
						?>
					</div>

					<div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
						<div class="row">
							<div class="col-md-12">
								<h5 class="title-tab">Đơn hàng của bạn</h5><br>
							</div>
						</div>
						<?php
							$ref_order = "Orders";
							$listOrderKey = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getValue();
							if ($listOrderKey > 0) {
								foreach($listOrderKey as $keyOrder => $key){
								?>
								<div class="container border border-secondary rounded px-4 py-2 mb-2">
									<div class="row justify-content-between mt-2">
										<div class="col-lg-9">
											<p><b>Mã đơn hàng:</b> <?php echo $keyOrder ?></p>
											<?php 
												$listOrder = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($keyOrder)->getValue();
												if ($listOrder > 0) {
													foreach($listOrder as $keyOrderProduct => $order){
													?>
														<p><b>Thời gian đặt hàng:</b> <?php echo $order['created'] ?></p>
													<?php
													break;
													}
												}
											?>
											
										</div>
										<div class="col-lg-3">
											<?php 
												$listOrder = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($keyOrder)->getValue();
												if ($listOrder > 0) {
													foreach($listOrder as $keyOrderProduct => $order){
														if ($order['orderstatus'] == 0) {
															?>
															<p>
																<a class=" btn btn-outline-danger text-decoration-none" href="code-handle/code-cancel-order.php?id=<?php echo $keyOrder ?>">Hủy đơn</a>
															</p>
															<?php
															break;
														} else if ($order['orderstatus'] == 1) {
															?>
															<p>
																<a class=" btn btn-outline-danger text-decoration-none" href="code-handle/code-received-order.php?id=<?php echo $keyOrder ?>">Đã nhận hàng</a>
															</p>
															<?php
															break;
														} else if ($order['orderstatus'] == 2) {
															?>
															<p>
																<a href="" class="btn btn-outline-danger text-decoration-none" href="">Đánh giá</a>
															</p>
															<?php
															break;
														}
													}
												}
											?>
										</div>
									</div>
									<div class="row">
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
											$listOrder = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($keyOrder)->getValue();
											if ($listOrder > 0) {
												$totalPrice = 0;
												foreach($listOrder as $keyOrderProduct => $order){
													$totalPrice += $order['totalPrice'];
													$paymentForm = $order['paymentform'];
													$paymentStatus = $order['paymentstatus'];
												?>
												<tr>
													<td scope="row">
														<img src="<?php echo $order['link'] ?>" alt="" style="width: 100px">
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
															} else if ($order['orderstatus'] == 2){
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
									<div class="row">
										<div class="col-md-12">
											<div class="row mb-2">
												<div class="col-md-12">
													<a class="text-decoration-none text-danger" data-toggle="collapse" href="#collapseExample<?php echo $keyOrder ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $keyOrder ?>">
														Chi tiết
													</a>
												</div>
											</div>
											<div class="collapse" id="collapseExample<?php echo $keyOrder ?>">
												<div>
													<div class="row mb-2">
														<div class="col-md-12 px-1">
															<div class="px-2 py-2 border border-secondary rounded">
															<p><b>Địa chỉ: </b></p>
															<p><?php echo $address ?></p>
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
																				<a href="info-payment.php">Thanh toán ngay</a>
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
												</div>
											</div>
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
	</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>