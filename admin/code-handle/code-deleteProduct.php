<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_GET['idCategory']) && isset($_GET['idProduct'])) {
        $ref_category = "Products";
        $getImage = $database->getReference($ref_category)->getChild($_GET['idCategory'])->getChild($_GET['idProduct'])->getValue();
        $updateData = $database->getReference($ref_category)->getChild($_GET['idCategory'])->getChild($_GET['idProduct'])->remove();
        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã xóa sản phẩm !')</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>