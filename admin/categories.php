<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php'); ?>
<?php include("../components/backend/toasts.php") ?>

<body class="bg02">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-12 tm-md-12 tm-sm-12 tm-col mt-5">
                <h2 class="tm-block-title d-inline-block">Danh mục sản phẩm</h2>
                <table class="table table-hover table-striped">
                    <tbody>
                        <?php
                            $ref_Category = "Categories";
                            $listCategory = $database->getReference($ref_Category)->getValue();
                            if ($listCategory > 0) {
                                foreach($listCategory as $keyCategory => $category){
                                    ?>
                                    <tr>
                                        <td>
                                            <a style="color: black; font-weight: bold" href="product.php?id=<?php echo $keyCategory ?>"><?php echo $category['Category-name'] ?></a>
                                        </td>
                                        <td><a href="update-category.php?id=<?php echo $keyCategory ?>"><i style="color: #3f9553" class="fas fa-edit"></a></td>
                                        <td class="tm-trash-icon-cell">
                                            <a href="code-handle/code-deleteCategory.php?id=<?php echo $keyCategory ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                <i style="color: #f53c4e" class="fas fa-trash-alt tm-trash-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-5 col-lg-12 tm-md-12 tm-sm-12 tm-col mt-5">
                <h2 class="tm-block-title d-inline-block">Thêm danh mục</h2>
                <form action="code-handle/code-product.php" method="POST">
                    <input name="category-name" type="text" class="form-control validate " required="" placeholder="Nhập tên danh mục muốn thêm">
                    <button name="btn_addCategory" class="btn btn-primary">Thêm danh mục</button>
                </form>
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