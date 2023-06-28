<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_GET['id'])) {
        $ref_category = "Categories";
        $updateData = $database->getReference($ref_category)->getChild($_GET['id'])->remove(); 
        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã xóa danh mục !')</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>