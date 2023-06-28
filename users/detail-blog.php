<?php 
    session_start();
    include('../includes/dbconfig.php'); 
?>
<?php include("../components/frontend/users/toasts.php") ?>

<?php
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $ref_blog = "news";
        $dataBlog = $database->getReference($ref_blog)->getChild($_GET['id'])->getValue();
        $dataRead = [
            'read' => $dataBlog['read'] + 1,
        ];
        $dataUpdate = $database->getReference($ref_blog)->getChild($_GET['id'])->update($dataRead);
        if ($dataBlog > 0) {
            $title = $dataBlog['title'];
            $author = $dataBlog['author'];
            $created = $dataBlog['created'];
            $read = $dataBlog['read'];
            $content = $dataBlog['content'];
        }
    } else {
        header('Location: blog.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:description" content="">
    <meta property="og:title" content="About-Us">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="About-Us">
    <title><?php echo $title ?></title>

    <link rel="shortcut icon" href="../public/frontend/images/logo.png">
    <link rel="stylesheet" href="../public/frontend/css/frontend/css/style.css">
    <link rel="stylesheet" href="../public/frontend/css/frontend/css/about-us.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/frontend/css/frontend/fontawesome/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row navbar-container-top">
            <div class="col navbar-link">
                <a class="about-contact-navbar" href="../index.php" ><span>Trang chủ</span></a>
                <a class="about-contact-navbar" href="blog.php"><span>Bài viết</span></a>
            </div>
            <div class="col d-flex justify-content-end big-navbar-icon">
                <a class="icon-navbar" target="_blank" href="http://facebook.com"><i class="fab fa-facebook fa-lg"></i></a>
                <a class="icon-navbar" target="_blank" href="http://instagram.com/"><i class="fab fa-instagram-square fa-lg"></i></a>
                <a class="icon-navbar" target="_blank" href="http://youtube.com/"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
        </div>
        <!--  -->
        <div class="row title-pages-details">
            <div class="jumbotron d-flex align-items-end">
                <div class="container">
                    <h4 class="display-4"><?php echo $title ?></h4>
                        <p><a href="#"><?php echo $author ?></a> <span class="datetime"><?php echo $created ?></span> <span><?php echo $read ?> Người đọc</span></p>
                </div>
            </div>
        </div>
        <!-- ---------content-------------- -->
        <div class="container content-blog">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <?php echo $content ?>
                </div>
            </div>
        </div>

        <!-- introduce -->
        <div class="row intro-yourself">
            <div class="col d-flex justify-content-center">
                <div class="row ground">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img class="rounded-circle" src="../public/images/huy1.png" alt="avatar">
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <h5><?php echo $author ?></h5>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <p>Over. Called from appear also image man thing There whales. Firmament saying whose fifth. She'd from.</p>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fas fa-at"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row details-comments">
            <div class="col-md-12 d-flex justify-content-center">
                <?php 
                    $ref_commentBlog = "Comment_Blog";
                    $ref_infoUser = "User_Info";
                    $countBlog = 0;
                    $listCommentBlog = $database->getReference($ref_commentBlog)->getChild($_GET['id'])->getValue();
                    if ($listCommentBlog > 0) {
                        foreach ($listCommentBlog as $keyUser => $user) {
                            $userInfo = $database->getReference($ref_infoUser)->getChild($keyUser)->getValue();
                            $detailComment = $database->getReference($ref_commentBlog)->getChild($_GET['id'])->getChild($keyUser)->getValue();
                            if ($detailComment > 0) {
                                foreach ($detailComment as $keyComment => $comment) {
                                    $countBlog++;
                                }
                            }
                        }
                    }
                ?>
                <button class="btn-comment"  type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Show Comments (<?php echo $countBlog ?>)
                </button>
            </div>
            <div class="col-md-12 mt-5">
                <div class="collapse" id="collapseExample">
                <?php 
                    if ($listCommentBlog > 0) {
                        foreach ($listCommentBlog as $keyUser => $user) {
                            $userInfo = $database->getReference($ref_infoUser)->getChild($keyUser)->getValue();
                            $detailComment = $database->getReference($ref_commentBlog)->getChild($_GET['id'])->getChild($keyUser)->getValue();
                            if ($detailComment > 0) {
                                foreach ($detailComment as $keyComment => $comment) {
                                    ?>
                                    
                                    <div class="media container">
                                        <img class="mr-3 rounded-circle image-comment" src="<?php echo $userInfo['image'] ?>">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $userInfo['name'] ?></h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php echo $comment['comment'] ?> | <?php echo $comment['created'] ?>
                                                </div>
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
            </div>
        </div>

        <!-- comment -->
      
        <div class="row justify-content-center form-message details-blog">
            
            <form action="code-handle/code-comment-blog.php?id=<?php echo $_GET['id'] ?>" method="POST" class="col" >
                <div class="form-group">
                    <h3 class="comments">Comment</h3>
                    <br>
                </div>
                <div class="form-group">
                    <label>Comment <span style="color:red">*</span></label>
                    <textarea class="form-control" rows="3" colums="50" required name="comment"></textarea>
                </div>
                <div class="form-group">
                    <button name="btn_comment" type="submit" class="btn-get-started">Send Message</button>
                </div>
            </form>
        </div>

        <!--  -->
        <div class="row blog-list">
            <div class="col-md-12">
                <h2>Bài viết mới</h2>
            </div>
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
                                <h5 class="card-title" style="height: 70px"><?php echo $blog['title'] ?></h5>
                            </a>
                            <div class="card-text" style="height: 110px"><?php echo substr($blog['content'], 0, 200) ?>...</div>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>