<?php 
  session_start(); 
  include('../../includes/dbconfig.php');
?>
<?php
if ($_SESSION['id_user']) {
    if ($_GET['id']) {
        $idProductCart = $_GET['id'];
        $idUser = $_SESSION['id_user'];
        $ref_cart = "User_Note";
        $delete_cart = $database->getReference($ref_cart)->getChild($idUser)->getChild($idProductCart)->remove();
        if ($delete_cart) {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã xóa sản phẩm')</script>";
        } else {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Xóa sản phẩm không thành công')</script>";
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../login.php');
}
	
 ?>