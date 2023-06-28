<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_POST['btn_checkPayment'])) {
        if (isset($_GET['idUser']) && $_GET['idUser'] != '' && isset($_GET['idOrder']) &&  $_GET['idOrder'] != '') {
            $idUser = $_GET['idUser'];
            $idOrder = $_GET['idOrder'];
            $ref_order = "Orders";
            $detailOrder = $database->getReference($ref_order)->getChild($idUser)->getChild($idOrder)->getValue();
            $data = [
                'paymentstatus' => 1,
            ];
            if ($detailOrder > 1) {
                foreach($detailOrder as $keyDetailOrder => $order){
                    $database->getReference($ref_order)->getChild($idUser)->getChild($idOrder)->getChild($keyDetailOrder)->update($data);
                    $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã thanh toán !')</script>";
                }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    if (isset($_POST['btn_checkOrderStatus'])) {
        if (isset($_GET['idUser']) && $_GET['idUser'] != '' && isset($_GET['idOrder']) &&  $_GET['idOrder'] != '') {
            $idUser = $_GET['idUser'];
            $idOrder = $_GET['idOrder'];
            $ref_order = "Orders";
            $detailOrder = $database->getReference($ref_order)->getChild($idUser)->getChild($idOrder)->getValue();
            $data = [
                'orderstatus' => 1,
            ];
            if ($detailOrder > 1) {
                foreach($detailOrder as $keyDetailOrder => $order){
                    $database->getReference($ref_order)->getChild($idUser)->getChild($idOrder)->getChild($keyDetailOrder)->update($data);
                    $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã nhận đơn !')</script>";
                }
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>