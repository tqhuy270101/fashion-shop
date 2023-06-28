<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php
    $getIdCategory = $_GET['idCategory'];
    $idProduct = $_GET['idProduct'];
    $datetime = new DateTime();
    $timezone = new DateTimeZone('Asia/Bangkok');
    $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');
    if (isset($_POST['btn_updateProduct'])) {
        $categoryId = $_POST['category-id'];
        $productName = $_POST['product-name'];
        $productAmount = $_POST['product-amount'];
        $productPrice = $_POST['product-price'];
        $productSale = $_POST['product-sale'];
        $productIntro = $_POST['product-intro'];
        $productSize = $_POST['product-size'];

        $specialCharacters = array(" ", ".", "\t", "\n", ",", "/", "#");
        $newNameProduct = str_replace($specialCharacters, "", $productName).'-'.md5(uniqid());

        $file = $_FILES['filename'];
        $size_allow = 10; /* cho phép upload 10mb */

        // Đổi tên file
        $filename = $file['name'];
        $filename = explode('.', $filename);
        $ext = end($filename);
        
        // Kiểm tra định dạng file
        $allow_ext = ['png', 'jpg', 'jpeg', 'webp'];
        $imageUrl = 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673027706/FashionShop-Dacn2/products/'.$newNameProduct.'.jpg';


        $ref_Product = "Products";
        if ($file['name']) {
            $data_product = [
                'imageUrl' => $imageUrl,
                'name' => $productName,
                'amount' => (string)$productAmount,
                'price' => $productPrice,
                'rating' => '4',
                'restorant' => $productIntro,
                'dateTime' => $now,
                'sale' => $productSale,
                'size' => $productSize,
            ];
        } else {
            $data_product = [
                'name' => $productName,
                'amount' => (string)$productAmount,
                'price' => $productPrice,
                'rating' => '4',
                'restorant' => $productIntro,
                'dateTime' => $now,
                'sale' => $productSale,
                'size' => $productSize,
            ];
        }

        if ($getIdCategory == $categoryId) {
            $updateData = $database->getReference($ref_Product)->getChild($getIdCategory)->getChild($idProduct)->update($data_product);
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật sản phẩm thành công !')</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            if ($file['name']) {
                $updateData = $database->getReference($ref_Product)->getChild($getIdCategory)->getChild($idProduct)->remove();
                $updateData = $database->getReference($ref_Product)->getChild($categoryId)->push($data_product);
                $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật sản phẩm thành công !')</script>";
                header('Location: ../update-product.php?idCategory='.$categoryId.'&idProduct='.$updateData->getKey());
            } else {
                $data_product = [
                    'imageUrl' => $imageUrl,
                    'name' => $productName,
                    'amount' => (string)$productAmount,
                    'price' => $productPrice,
                    'rating' => '4',
                    'restorant' => $productIntro,
                    'dateTime' => $now,
                    'sale' => $productSale,
                    'size' => $productSize,
                ];
                $database->getReference($ref_Product)->getChild($getIdCategory)->getChild($idProduct)->remove();
                $updateData = $database->getReference($ref_Product)->getChild($categoryId)->push($data_product);
                $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật sản phẩm thành công !')</script>";
                header('Location: ../update-product.php?idCategory='.$categoryId.'&idProduct='.$updateData->getKey());
            }
        }

        if (in_array($ext, $allow_ext)) {
            $size = $file['size']/1024/1024;
            if ($size <= $size_allow) {
                $cloudinary->uploadApi()->upload(
                    $file['tmp_name'],
                    ['public_id' => 'FashionShop-Dacn2/products/'.$newNameProduct]
                );
            } else {
                header('Location: ../update-product.php?idCategory='.$categoryId.'&idProduct='.$updateData->getKey());
            }
        } else {
            header('Location: ../update-product.php?idCategory='.$categoryId.'&idProduct='.$updateData->getKey());
        }
    }
?>