<?php
    session_start();
    include('../../includes/dbconfig.php');
    if (!isset($_SESSION['id_user']) ) {
        header("location: ../users/login.php");
    } else if (isset($_GET['id']) && $_GET['id'] != '') {
        $ref_order = "Orders";
        $data = [
            'orderstatus' => 2,
        ];
        $order = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($_GET['id'])->getValue();
        foreach ($order as $keyOrder => $order) {
            $updateOrder = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($_GET['id'])->getChild($keyOrder)->update($data);
        }
        if ($updateOrder) {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã nhận được hàng')</script>";
            $_SESSION['review'] = 0;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>