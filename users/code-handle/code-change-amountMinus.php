<?php
session_start(); 
include('../../includes/dbconfig.php');

if (isset($_GET['id']) && $_GET['id'] != '') {
  $id_cart = $_GET['id'];
  $idUser = $_SESSION['id_user'];
  $ref_cart = "Carts";

  $check_cart = $database->getReference($ref_cart)->getChild($idUser)->getChild($id_cart)->getValue();
  // tổng tiền sau khi sale

  $data_updates = [
    'totalQuantity' => $check_cart['totalQuantity'] - 1,
  ];

  if ($check_cart['totalQuantity'] == 1) {
    $postdata = $database->getReference($ref_cart)->getChild($idUser)->getChild($id_cart)->remove();
  } else {
    $postdata = $database->getReference($ref_cart)->getChild($idUser)->getChild($id_cart)->update($data_updates);
  }
  if ($postdata) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}
?>