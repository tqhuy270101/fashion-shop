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
                            <h2 class="tm-block-title d-inline-block">Sửa bài viết</h2>
                        </div>
                    </div>
                    <form action="code-handle/code-updateBlog.php?id=<?php echo $_GET['id'] ?>" method="POST" class="tm-edit-product-form"  enctype="multipart/form-data">
                        <div class="row mt-4 tm-edit-product-row">
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="input-group mb-3">
                                    <?php 
                                        if (isset($_GET['id'])) {
                                            $ref_blog = "news";
                                            $blog = $database->getReference($ref_blog)->getChild($_GET['id'])->getValue();
                                            if ($blog > 0) {
                                                $category = $blog['category'];
                                                $title = $blog['title'];
                                                $content = $blog['content'];
                                                $author = $blog['author'];
                                                $image = $blog['image'];
                                            }
                                        }
                                    ?>
                                    <div class="input-group mb-3">
                                        <label for="description" class="col-xl-2">Tác giả</label>
                                        <input value="<?php echo $author ?>" id="name" type="text" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10"  required="" readonly>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="description" class="col-xl-2">Danh mục</label>
                                        <select class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10" name="category">
                                            <?php
                                            $ref_category = "Categories";
                                            $list_category = $database->getReference($ref_category)->getValue();
                                            if ($list_category > 0) {
                                                foreach($list_category as $keyCategory => $dataCategory){
                                                    if ($dataCategory['Category-name'] == $category) {
                                                        ?>
                                                        <option value="<?php echo $dataCategory['Category-name'] ?>" selected><?php echo $dataCategory['Category-name'] ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $dataCategory['Category-name'] ?>"><?php echo $dataCategory['Category-name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="description" class="col-xl-2">Tiêu đề</label>
                                        <input  id="name" name="title" type="text" value="<?php echo $title ?>" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10"  required="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="stock" class="col-xl-2">Nội dung</label>
                                        <textarea id="editor" name="content" class="form-control validate col-xl-10 col-lg-10 col-md-10 col-sm-10" required=""><?php echo $content ?></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                            <button  name="btn_updateBlog" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 mx-auto mb-4">
                                <div class="tm-product-img-dummy mx-auto rounded">
                                    <img class="fas fa-5x fa-cloud-upload-alt rounded" src="<?php echo $image ?>" onclick="document.getElementById('fileInput').click();" style="width: 250px; height: 280px; border: 1px solid #9f9f9f">
                                </div>
                                <div class="custom-file mt-3 mb-3 d-flex justify-content-center align-items-center">
                                    <input class="d-block" name="fileImage" id="fileInput" type="file" /> 
                                </div>
                            </div>
                        </div>
                    </form>
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