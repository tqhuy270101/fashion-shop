<?php
session_start();
include('../../includes/dbconfig.php');

if (!$_SESSION['id_user'] && !$_SESSION['email_user']) {
    header('Location: ../login.php');
} else if (isset($_POST['order'])) {
    $form = $_POST['payment'];
    $idUser = $_SESSION['id_user'];
    $datetime = new DateTime();
    $timezone = new DateTimeZone('Asia/Bangkok');
    $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');
    // Lấy thông tin người đặt hàng
    $ref_profile = "User_Info";
    $dataProfile = $database->getReference($ref_profile)->getChild($idUser)->getValue();
    
    // Lấy thông tin giỏ hàng
    $ref_cart = "Carts";
    $ref_Product = "Products";
    $ref_order = "Orders";
    $dataCart = $database->getReference($ref_cart)->getChild($idUser)->getValue();
    if ($dataCart > 0 && $dataProfile > 0) {
        $newKey = $database->getReference($ref_order)->getChild($idUser)->push();
        foreach($dataCart as $keyCart => $row){
            $idCategory = $row['idCategory'];
            $idProduct = $row['idProduct'];
            $size = $row['size'];
            $totalQuantity = $row['totalQuantity'];
            $dataProduct = $database->getReference($ref_Product)->getChild($idCategory)->getChild($idProduct)->getValue();

            $intoMoney = $dataProduct['price'] * $row['totalQuantity'];
            $totalPriceSale = $intoMoney - $intoMoney * $dataProduct['sale'] / 100;

            $name = $dataProduct['name'];
            $price = $dataProduct['price'];
            $image = $dataProduct['imageUrl'];
            $sale = $dataProduct['sale'];
            $origin = $dataProduct['origin'];
            $totalQuantity = $row['totalQuantity'];
            $amount = $dataProduct['amount'];
            $data = [
                'name' => $name,
                'price' => $price,
                'totalQuantity' => (string)$totalQuantity,
                'totalPrice' => $totalPriceSale,
                'orderstatus' => 0,
                'sale' => $sale,
                // thời gian
                'created' => $now,
                'paymentform' => $form,
                'paymentstatus' => 0,
                'link' => $image,
                'origin' => $origin,
            ];

            if ($amount >= $totalQuantity) {
                $dataAmount = [
                    'amount' => (string)($amount - $totalQuantity),
                ];
                $database->getReference($ref_Product)->getChild($idCategory)->getChild($idProduct)->update($dataAmount);
                $postOrder = $newKey->push($data);
                $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đặt hàng thành công')</script>";
            } else {
                if ($amount == 0) {
                    $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Sản phẩm này đã hết hàng')</script>";
                } else {
                    $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Sản phẩm này chỉ còn ".$amount."')</script>";
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        if ($postOrder) {
            $delete_cart = $database->getReference($ref_cart)->getChild($idUser)->remove();
            if ($form == 1) {
                header('Location: ../info-payment.php');
            } else if ($form == 2){
                header('Location: ../../index.php');
            }
        }
    }
}