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
                            <h2 class="tm-block-title d-inline-block">Thêm bài viết</h2>
                        </div>
                    </div>
                    <div class="row mt-4 tm-edit-product-row">
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <form action="code-handle/code-addBlog.php" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <label for="category" class="col-xl-2 col-lg-4 col-md-4 col-sm-5 col-form-label">Danh mục</label>
                                    <select class="custom-select col-xl-10 col-lg-8 col-md-8 col-sm-7" id="iddanhmuc" name="category">
                                        <?php
                                            $ref_category = "Categories";
                                            $listCategory = $database->getReference($ref_category)->getValue();
                                            if ($listCategory > 0) {
                                                foreach ($listCategory as $keyCategory => $category) {
                                                    ?>
                                                    <option value="<?php echo $category['Category-name'] ?>"><?php echo $category['Category-name'] ?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-2">Tiêu đề</label>
                                    <input id="name" name="title" type="text" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10"  required="">
                                </div>

                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-2">Tác giả</label>
                                    <input id="name" name="author" type="text" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10"  required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-2">Ảnh</label>
                                    <input id="anh" name="fileImage" type="file" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10"  required="">
                                </div>
                                <div class="input-group mb-3">
                                    <label for="stock" class="col-xl-2">Nội dung</label>
                                    <div class="validate col-xl-10 col-lg-10 col-md-10 col-sm-10">
                                        <textarea name="content" id="editor"></textarea>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="btn_addBlog" class="btn btn-primary">Thêm bài viết</button>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>

<?php include("../components/backend/footer.php") ?>