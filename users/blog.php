<?php session_start(); ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/blog/header.php") ?>
<?php include("../components/frontend/users/menu.php") ?>

<style>
    p{
        font-size: 16px;
    }
</style>
<div class="container-fluid">
    <div class="row title-pages-aboutus">
        <div class="jumbotron d-flex align-items-center">
            <div class="container">
                <h1 class="display-4">Blog</h1>
            </div>
        </div>
    </div>
    <!-- blog list -->
    <div class="row blog-list">
        <?php
            $ref_blog = "news";
            $listBlog = $database->getReference($ref_blog)->getValue();
            if ($listBlog > 0) {
            foreach ($listBlog as $keyBlog => $blog) {
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <a href="detail-blog.php?id=<?php echo $keyBlog ?>">
                            <img class="card-img-top" src="<?php echo $blog['image'] ?>" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="#" class="field"><?php echo $blog['category'] ?></a>
                            <a href="detail-blog.php?id=<?php echo $keyBlog ?>" class="card-title-link">
                                <h5 class="card-title"><?php echo $blog['title'] ?></h5>
                            </a>
                            <!-- <p class="card-text"style="height: 50px"><?php echo substr($blog['content'], 0, 200) ?>...</p> -->
                            <hr>
                            <div class="row justify-content-between">
                                <div class="col-md-2">
                                    <img class="align-self-center mr-3 border border-secondary rounded-circle image" src="<?php echo $blog['image'] ?>" alt="logo">
                                </div>
                                <div class="col-md-8">
                                    <div class="media-body">
                                        <a href="#" class="mb-0 name-tg"><?php echo $blog['author'] ?></a><br>
                                        <a href="#" class="mb-0 name-tg"><?php echo $blog['created'] ?></a>
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

<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/blog/footer.php") ?>
