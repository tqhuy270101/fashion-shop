<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<body class="bg02">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Sửa danh mục</h2>
                        </div>
                    </div> 
                    <div class="row mt-4 tm-edit-product-row">
                        <div class="col-xl-7 col-lg-7 col-md-12">
                            <form action="code-handle/code-product.php?id=<?php echo $_GET['id'] ?>" method="POST" class="tm-edit-product-form">
                                <?php
                                    if (isset($_GET['id'])) {
                                        $ref_category = "Categories";
                                        $listCategory = $database->getReference($ref_category)->getChild($_GET['id'])->getValue();
                                    }
                                ?>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Danh mục</label>
                                    <input id="name" name="category-name" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" value="<?php echo $listCategory['Category-name'] ?>"  required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <input class="btn btn-danger" type="submit" name="editCategory" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("../components/backend/footerBody.php") ?>
    </div>   
</body>
<?php include("../components/backend/footer.php") ?>

