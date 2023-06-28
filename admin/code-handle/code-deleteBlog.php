<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_GET['id'])) {
        $ref_blog = "news";
        $updateData = $database->getReference($ref_blog)->getChild($_GET['id'])->remove(); 
        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã xóa tin tức !')</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>