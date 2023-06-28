<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php'); ?>
<?php include("../components/backend/toasts.php") ?>

<body class="bg02">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-xl-12 col-lg-10 col-md-12 col-sm-12">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Cập nhật Sản Phẩm</h2>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['idCategory']) && isset($_GET['idProduct']) && $_GET['idCategory'] != '' && $_GET['idProduct'] != '') {
                        $ref_product = "Products";
                        $dataProduct = $database->getReference($ref_product)->getChild($_GET['idCategory'])->getChild($_GET['idProduct'])->getValue();
                    }
                    ?>
                    <form method="POST" action="code-handle/code-updateProduct.php?idCategory=<?php echo $_GET['idCategory'] ?>&idProduct=<?php echo $_GET['idProduct'] ?>" enctype="multipart/form-data">
                        <div class="row mt-4 tm-edit-product-row">
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="input-group mb-3">
                                    <label for="category" class="col-xl-4 col-lg-4 col-md-4 col-sm-7 col-form-label">Danh mục</label>
                                    <select class="custom-select col-xl-9 col-lg-8 col-md-8 col-sm-7" id="iddanhmuc" name="category-id">
                                        <?php
                                            $ref_category = "Categories";
                                            $list_category = $database->getReference($ref_category)->getValue();
                                            if ($list_category > 0) {
                                                foreach($list_category as $keyCategory => $category){
                                                    if ($keyCategory == $_GET['idCategory']) {
                                                        ?>
                                                        <option value="<?php echo $keyCategory ?>" selected><?php echo $category['Category-name'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $keyCategory ?>"><?php echo $category['Category-name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Tên sản phẩm</label>
                                    <input id="name" name="product-name" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" value="<?php echo $dataProduct['name'] ?>" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Xuất xứ</label>
                                    <select class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" aria-label="Default select example" name="product-origin">
                                        <option value="Việt Nam"selected>Việt Nam</option>
                                        <option value="Trung Quốc">Trung Quốc</option>
                                        <option value="USA">USA</option>
                                        <?php 
                                        if ($dataProduct['origin'] == "Viêt Nam") {
                                            ?>
                                            <option value="Việt Nam" selected>Việt Nam</option>
                                            <option value="Trung Quốc">Trung Quốc</option>
                                            <option value="USA">USA</option>
                                            <?php
                                        } elseif ($dataProduct['origin'] == "Trung Quốc") {
                                            ?>
                                            <option value="Việt Nam">Việt Nam</option>
                                            <option value="Trung Quốc" selected>Trung Quốc</option>
                                            <option value="USA">USA</option>
                                            <?php
                                        } elseif ($dataProduct['origin'] == "USA") {
                                            ?>
                                            <option value="Việt Nam">Việt Nam</option>
                                            <option value="Trung Quốc">Trung Quốc</option>
                                            <option value="USA" selected>USA</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Số lượng</label>
                                    <input id="name" name="product-amount" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" min="1" value="<?php echo $dataProduct['amount'] ?>" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Đơn giá</label>
                                    <input id="stock" name="product-price" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" value="<?php echo $dataProduct['price'] ?>" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Số lượng size</label>
                                    <input id="stock" name="product-size" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" min="0" max="4" value="<?php echo $dataProduct['size'] ?>" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Sale</label>
                                    <input id="stock" name="product-sale" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" min="1" value="<?php echo $dataProduct['sale'] ?>" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4">Giới thiệu</label>
                                    <div class="validate col-xl-12 col-lg-8 col-md-7 col-sm-7">
                                        <textarea name="product-intro" id="editor"><?php echo $dataProduct['restorant'] ?></textarea>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="btn_updateProduct" type="submit" class="btn btn-primary">Cập nhật sản phẩm</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mx-auto mb-4">
                                <div class="tm-product-img-dummy mx-auto">
                                    <img class="fas fa-5x fa-cloud-upload-alt rounded" src="<?php echo $dataProduct['imageUrl'] ?>" onclick="document.getElementById('fileInput').click();" style="width: 250px; height: 280px; border: 1px solid #9f9f9f">
                                </div>
                                <div class="custom-file mt-4 mb-3 d-flex justify-content-center align-items-center">
                                    <input class="d-block" name="filename" id="fileInput" type="file" /> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include("../components/backend/footerBody.php") ?>
    </div>
</body>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php include("../components/backend/footer.php") ?>

