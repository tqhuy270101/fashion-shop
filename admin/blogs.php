<?php include("../components/backend/checkAccount.php") ?>
<?php include("../components/backend/header.php") ?>
<?php include("../components/backend/menu.php") ?>
<?php include('../includes/dbconfig.php') ?>
<?php include("../components/backend/toasts.php") ?>

<body id="reportsPage" class="bg02">
    <div class="" id="home">
        <div class="container">
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-12 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Blog</h2>

                            </div>
                            <div class="col-md-4 col-sm-12 text-right">
                                <a href="add-blog.php" class="btn btn-small btn-primary">Thêm Blog</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <thead>
                                    <tr class="tm-bg-gray">
                                        <th scope="col">&nbsp;</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col" class="text-center">Tiêu đề</th>
                                        <th scope="col">Tác giả</th>
                                        <th scope="col">Ngày viết</th>
                                        <th scope="col">&nbsp;</th>
                                        <th scope="col">&nbsp;</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="POST">
                                        <?php 
                                            $ref_new = "news";
                                            $listNews = $database->getReference($ref_new)->getValue();
                                            if ($listNews > 0) {
                                                foreach($listNews as $keyNew => $new){
                                                    ?>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td><?php echo $new['category'] ?></td>
                                                        <td><?php echo $new['title'] ?></td>
                                                        <td><?php echo $new['author'] ?></td>
                                                        <td><?php echo $new['created'] ?></td>
                                                        <td>
                                                            <a href="update-blog.php?id=<?php echo $keyNew ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>    
                                                        <td>
                                                            <a href="code-handle/code-deleteBlog.php?id=<?php echo $keyNew ?>">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("../components/backend/footerBody.php") ?>
        </div>
    </div>
</body>

<?php include("../components/backend/footer.php") ?>

