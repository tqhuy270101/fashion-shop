<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_POST['updateInfo'])) {
        $name = $_POST['username'];
        $phanQuyen = $_POST['phanQuyen'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        
        $data_info = [
            'name' => $name,
            'phanQuyen' => $phanQuyen,
            'address' => $address,
            'phone' => $phone
        ];
        $ref_Info = "User_Info";
        $updateData = $database->getReference($ref_Info)->getChild($_GET['id'])->update($data_info);
        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật thành công !')</script>";
    
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>