<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<body id="reportsPage" class="bg02">
    <div class="" id="home">
        <div class="container">
            <!-- row -->
            <div class="row d-flex mt-4">
                <div class="col-md-2 col-sm-12">
                    <h2 class="tm-block-title d-inline-block">Sản phẩm</h2>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?php
                    $ref_Category = "Categories";
                    $listCategory  = $database->getReference($ref_Category)->getValue();
                    foreach($listCategory as $keyCategory => $category){
                        ?>
                        <a href="product.php?id=<?php echo $keyCategory ?>" class="btn btn-outline-secondary rounded">
                            <?php
                            echo $category['Category-name'];
                            ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="add-product.php" class="btn btn-small btn-primary">Thêm sản phẩm</a>
                </div>
            </div>
            <div class="row">
                <?php
                    $ref_product = "Products";
                    if (isset($_GET['id']) && $_GET['id'] != '') {
                        $keyCategory = $_GET['id'];
                        $number_of_result  = $database->getReference($ref_product)->getChild($_GET['id'])->getValue();
                        // phân trang
                        $results_per_page = 4;
                        $number_of_page = ceil(count($number_of_result) / $results_per_page);
                        if (!isset ($_GET['page']) ) {
                            $page = 1;
                        } else {    
                            $page = $_GET['page'];
                        }
                        $page_first_result = ($page-1) * $results_per_page;
                        $listProduct = $database->getReference($ref_product)->getChild($_GET['id'])->getValue();
                        $pagination = array_slice($listProduct, $page_first_result, $results_per_page);
                        ?>
                        <?php
                        if ($listProduct > 0) {
                            foreach ($pagination as $keyProduct => $product) {
                                ?>
                                <div class="col-md-3 mt-2">
                                    <div class="card" style="width: 17rem;">
                                        <img style="width: 100%; height: 280px" src="<?php echo $product['imageUrl'] ?>" class="card-img-top" alt="<?php echo $product['name'] ?>">
                                        <div class="card-body">
                                            <p style="height: 70px; font-size: 18px; font-weight: bold" class="card-title"><?php echo $product['name'] ?></p>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <del class="card-text"><?php echo number_format($product['price'], 0, ',', '.') ?> </del><sup>đ</sup>
                                                    <p class="card-text font-weight-bold" style="font-size: 18px"><?php echo number_format($product['price']- $product['price'] * $product['sale'] / 100, 0, ',', '.') ?> <sup>đ</sup></p>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="card-text">Kho: <?php echo $product['amount'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-around">
                                                <div class="col mt-3" align="center">
                                                    <a style="border-radius: 10px; padding: 10px 18px" href="update-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" class="btn btn-primary">
                                                        <i style="color: #3f9553" class="fa fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="col mt-3" align="center">
                                                    <a class="btn btn-primary" style="border-radius: 10px; padding: 10px 18px" href="code-handle/code-deleteProduct.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                        <i style="color: #f53c4e" class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    } else {
                        $ref_Category = "Categories";
                        if ($listCategory > 0) {
                            foreach($listCategory as $keyCategory => $category){
                                $number_of_result = $database->getReference($ref_product)->getChild($keyCategory)->getValue();
                                // phân trang
                                $results_per_page = 3;
                                $number_of_page = ceil(count($number_of_result) / $results_per_page);
                                if (!isset ($_GET['page']) ) {
                                    $page = 1;
                                } else {    
                                    $page = $_GET['page'];
                                }
                                $page_first_result = ($page-1) * $results_per_page;
                                $listProduct = $database->getReference($ref_product)->getChild($keyCategory)->getValue();
                                if ($listProduct > 0) {
                                    foreach (array_slice($listProduct, $page_first_result, $results_per_page) as $keyProduct => $product) {
                                        ?>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
                                            <div class="card" style="width: 17rem;">
                                                <img style="width: 100%; height: 280px" src="<?php echo $product['imageUrl'] ?>" class="card-img-top" alt="<?php echo $product['name'] ?>">
                                                <div class="card-body">
                                                    <p style="height: 70px; font-size: 18px; font-weight: bold" class="card-title"><?php echo $product['name'] ?></p>
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                        <del class="card-text"><?php echo number_format($product['price'], 0, ',', '.') ?> </del><sup>đ</sup>
                                                    <p class="card-text font-weight-bold" style="font-size: 18px"><?php echo number_format($product['price']- $product['price'] * $product['sale'] / 100, 0, ',', '.') ?> <sup>đ</sup></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <p class="card-text">Kho: <?php echo $product['amount'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-around">
                                                        <div class="col mt-3" align="center">
                                                            <a style="border-radius: 10px; padding: 10px 18px" href="update-product.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" class="btn btn-primary">
                                                                <i style="color: #3f9553" class="fa fa-pen"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col mt-3" align="center">
                                                            <a class="btn btn-primary" style="border-radius: 10px; padding: 10px 18px" href="code-handle/code-deleteProduct.php?idCategory=<?php echo $keyCategory ?>&idProduct=<?php echo $keyProduct ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                                <i style="color: #f53c4e" class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div> 
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
            <div class="row justify-content-center mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        if (isset($_GET['id'])) {
                            for($page = 1; $page<= $number_of_page; $page++) {
                                echo '<li class="page-item"><a class="page-link" href="product.php?id='.$keyCategory.'&&page=' . $page . '">' . $page . '</a></li>';
                            }
                        } else {
                            for($page = 1; $page<= $number_of_page; $page++) {
                                echo '<li class="page-item"><a class="page-link" href="product.php?page=' . $page . '">' . $page . '</a></li>';
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
            <?php include("../components/backend/footerBody.php") ?>
        </div>
    </div>
</body>
<?php include("../components/backend/footer.php") ?>

