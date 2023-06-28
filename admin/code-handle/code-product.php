<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php 
    if (isset($_POST['btn_addCategory'])) {
        $name = $_POST['category-name'];
        $data_category = [
            'Category-name' => $name,
        ];
        $ref_Info = "Categories";
        $updateData = $database->getReference($ref_Info)->push($data_category);
        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Thêm danh mục thành công !')</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    if (isset($_POST['editCategory'])) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $categoryName = $_POST['category-name'];
            $dataCategory = [
                'Category-name' => $categoryName
            ];
            $ref_category = "Categories";
            $updateCategory = $database->getReference($ref_category)->getChild($_GET['id'])->update($dataCategory);
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật danh mục thành công !')</script>";
            header('Location: ../product.php');
        }
    }
?>