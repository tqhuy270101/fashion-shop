<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<body class="bg02">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-xl-12 col-lg-10 col-md-12 col-sm-12">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="tm-block-title d-inline-block">Thêm Sản Phẩm</h2>
                        </div>
                    </div>
                    <form method="POST" action="code-handle/code-addProduct.php" enctype="multipart/form-data">
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
                                                    ?>
                                                    <option value="<?php echo $keyCategory ?>"><?php echo $category['Category-name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Tên sản phẩm</label>
                                    <input id="name" name="product-name" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7"  required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Xuất xứ</label>
                                    <select class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" aria-label="Default select example" name="product-origin">
                                        <option value="Việt Nam"selected>Việt Nam</option>
                                        <option value="Trung Quốc">Trung Quốc</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4">Số lượng</label>
                                    <input id="name" name="product-amount" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" min="1"  required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Đơn giá</label>
                                    <input id="stock" name="product-price" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" min="1"required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Số lượng size</label>
                                    <input id="stock" name="product-size" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" min="0" value="3" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4 ">Sale</label>
                                    <input id="stock" name="product-sale" type="number" class="form-control validate col-xl-9 col-lg-8 col-md-7 col-sm-7" min="0" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-4">Giới thiệu</label>
                                    <div class="validate col-xl-12 col-lg-8 col-md-7 col-sm-7">
                                        <textarea name="product-intro" id="editor"></textarea>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="btn_addProduct" type="submit" class="btn btn-primary">Thêm sản phẩm</button> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mx-auto mb-4">
                                <div class="tm-product-img-dummy mx-auto rounded">
                                    <i class="fas fa-5x fa-cloud-upload-alt" onclick="document.getElementById('fileInput').click();"></i>
                                </div>
                                <div class="custom-file mt-3 mb-3 d-flex justify-content-center align-items-center">
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

