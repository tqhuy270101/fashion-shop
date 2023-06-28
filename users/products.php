<?php session_start(); ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/menu.php") ?>
<div class="wrapper">
	<div class="container_fullwidth">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="others leftbar">
						<form method="POST" class="pricing">
							<div class="limiter"> Show : &nbsp;&nbsp;
								<input type="text" name="sosp" placeholder="..." value="1" style="width: 60px">
								<input style="margin-left: 20px" type="submit" value="Go"> </div>
						</form>
					</div>
					<div class="category leftbar">
						<h3 class="title">DANH MỤC</h3>
						<ul>
						<?php 
							$ref_table = 'Categories';
							$fetchdata = $database->getReference($ref_table)->getValue();

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
					<div class="clearfix"></div>
					<div class="products-grid">
						<div class="toolbar">
							<div class="sorter">
								<form action="timkiem.php" method="GET" class="pricing">
									<div class="sort-by"> Danh mục:
										<select name="timkiem">
										<?php 
											$ref_table = 'Categories';
											$fetchdata = $database->getReference($ref_table)->getValue();

											if ($fetchdata > 0) {
												$i = 0;
												foreach($fetchdata as $key => $row){
										?>
											<option value="<?php echo $key ?>"><?php echo $row['Category-name'] ?></option>
										<?php
											}
										}
										?>
										</select>
									</div>
									<div class="sort-by"> Giá :
										<select name="min">
											<option value="0" selected> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- - - </option>
											<option value="1000"> 1.000.000 VND </option>
											<option value="3000"> 3.000.000 VND </option>
											<option value="5000"> 5.000.000 VND </option>
											<option value="8000"> 8.000.000 VND </option>
											<option value="10000"> 10.000.000 VND </option>
											<option value="12000"> 20.000.000 VND </option>
											<option value="100000"> 30.000.000 VND </option>
										</select> &nbsp; - >
										<select name="max">
											<option value="0" selected> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- - - </option>
											<option value="10000"> 10.000.000 VND </option>
											<option value="15000"> 15.000.000 VND </option>
											<option value="20000"> 20.000.000 VND </option>
											<option value="30000"> 30.000.000 VND </option>
											<option value="50000"> 50.000.000 VND </option>
											<option value="80000"> 80.000.000 VND </option>
											<option value="100000"> 100.000.000 VND </option>
										</select>
										<input style="margin-left: 20px" type="submit" value="Go"> </div>
								</form>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="row">
							<?php 
							if(isset($_GET['idCategory'])){
								$idCategory = $_GET['idCategory'];
								$ref_table = 'Products';
								$number_of_result  = $database->getReference($ref_table)->getChild($idCategory)->getValue();
								// phân trang
								$results_per_page = 9;
								$number_of_page = ceil(count($number_of_result) / $results_per_page);
								if (!isset ($_GET['page']) ) {
									$page = 1;
								} else {    
									$page = $_GET['page'];
								}
								$page_first_result = ($page-1) * $results_per_page;
								$fetchdata = $database->getReference($ref_table)->getChild($idCategory)->getValue();
								$pagination = array_slice($fetchdata, $page_first_result, $results_per_page);
								if ($fetchdata > 0) {
									$i = 0;
									foreach($pagination as $keyProduct => $row){
										$intoMoney = $row['price'] - $row['price'] * $row['sale'] / 100;
										$price_format = number_format($intoMoney, 0, ',', '.');
									?>
										<div class="col-md-4 col-sm-6">
											<div class="products">
												<div class="offer">- <?php echo $row['sale'] ?>%</div>
												<div class="thumbnail">
													<a href="detail-product.php?idCategory=<?php echo $idCategory ?>&idProduct=<?php echo $keyProduct ?>">
														<img style="width:150px;height:220px" src="<?php echo $row['imageUrl'] ?>" alt="Product Name">
													</a>	
												</div>
												<div class="productname" style="height: 50px"><?php echo $row['name'] ?></div>
												<p class="text-decoration-line-through text-center"><del><?php echo number_format($row['price'], 0, ',', '.') ?>  VNĐ</del></p>
												<h4 class="price"><?php echo $price_format ?>  vnđ</h4>
												<div class="button_group"> <a href="detail-product.php?idCategory=<?php echo $idCategory ?>&idProduct=<?php echo $keyProduct ?>" class="button add-cart" type="button">Mua ngay!</a>
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
							} else {
								$ref_table = 'Products';
								$categories = $database->getReference($ref_table)->getValue();
								foreach($categories as $keyCategory => $row){
									$ref_table = 'Products';
									$number_of_result = $database->getReference($ref_table)->getChild($keyCategory)->getValue();
									// phân trang
									$results_per_page = 3;
									$number_of_page = ceil(count($number_of_result) / $results_per_page);
									if (!isset ($_GET['page']) ) {
										$page = 1;
									} else {    
										$page = $_GET['page'];
									}
									$page_first_result = ($page-1) * $results_per_page;
									$pagination = array_slice($number_of_result, $page_first_result, $results_per_page);
									if ($number_of_result > 0) {
										foreach($pagination as $keyProducts => $row){
											$intoMoney = $row['price'] - $row['price'] * $row['sale'] / 100;
											$price_format = number_format($intoMoney, 0, ',', '.');
											?>
											<div class="col-md-4 col-sm-6">
												<div class="products">
													<div class="offer">- <?php echo $row['sale'] ?>%</div>
													<div class="thumbnail">
														<a href="detail-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProducts ?>">
															<img style="width:150px;height:220px" src="<?php echo $row['imageUrl'] ?>" alt="Product Name">
														</a>	
													</div>
													<div class="productname" style="height: 50px"><?php echo $row['name'] ?></div>
													<p class="text-decoration-line-through text-center"><del><?php echo number_format($row['price'], 0, ',', '.') ?>  VNĐ</del></p>
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
							?>
						</div>
						<div class="row justify-content-center mt-3">
							<nav aria-label="Page navigation example">
								<ul class="pagination justify-content-center">
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
										</a>
									</li>
									<?php
									if (isset($_GET['idCategory'])) {
										for($page = 1; $page<= $number_of_page; $page++) {
											echo '<li class="page-item"><a class="page-link" href="products.php?idCategory='.$idCategory.'&&page=' . $page . '">' . $page . '</a></li>';
										}
									} else {
										for($page = 1; $page<= $number_of_page; $page++) {
											echo '<li class="page-item"><a class="page-link" href="products.php?page=' . $page . '">' . $page . '</a></li>';
										}
									}
									
									?>
									<li class="page-item">
										<a class="page-link" href="#" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/users/footer.php") ?>