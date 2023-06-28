<?php 
  session_start(); 
  include('../../includes/dbconfig.php');
?>
<?php
if (!$_SESSION['id_user'] && !$_SESSION['email_user']) {
  header('Location: ../login.php');
} else if (isset($_POST['add_cart'])) {
  // Thêm giỏ hàng
  $idCategory = $_GET['idCategory'];
  $idProduct = $_GET['idProduct'];
  $idUser = $_SESSION['id_user'];
  $amount_product = $_POST['totalQuantity'];
  $size = $_POST['size'];
  
  $data = [
      'idCategory' => $idCategory,
      'idProduct' => $idProduct,
      'totalQuantity' => $amount_product,
      'size' => $size,
  ];

  // check cart
  $ref_cart = "Carts";
  $check_cart = $database->getReference($ref_cart)->getChild($idUser)->getValue();
  if ($check_cart > 0) {
    foreach ($check_cart as $key => $cart) {
      if ($cart['idProduct'] == $idProduct) {
        if ($cart['size'] == $size) {
          $data_update = [
            'totalQuantity' => $cart['totalQuantity'] + $amount_product,
          ];
          $postdata = $database->getReference($ref_cart)->getChild($idUser)->getChild($key)->update($data_update);
          break;
        } else {
          $postdata = $database->getReference($ref_cart)->getChild($idUser)->push($data);
        }
      } else {
        $postdata = $database->getReference($ref_cart)->getChild($idUser)->push($data);
        break;
      }
    }
  } else {
    $postdata = $database->getReference($ref_cart)->getChild($idUser)->push($data);
  }
  if ($postdata) {
    $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Thêm giỏ hàng thành công !')</script>";
  }
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}



?>