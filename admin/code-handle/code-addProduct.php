<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>

<?php
    $datetime = new DateTime();
    $timezone = new DateTimeZone('Asia/Bangkok');
    $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');
    if (isset($_POST['btn_addProduct'])) {
        $categoryId = $_POST['category-id'];
        $productName = $_POST['product-name'];
        $productAmount = $_POST['product-amount'];
        $productPrice = $_POST['product-price'];
        $productSale = $_POST['product-sale'];
        $productIntro = $_POST['product-intro'];
        $productSize = $_POST['product-size'];
        $productOrigin = $_POST['product-origin'];

        $file = $_FILES['filename'];
        $size_allow = 10; /* cho phép upload 10mb */

        $specialCharacters = array(" ", ".", "\t", "\n", ",", "/", "#");
        $newNameProduct = str_replace($specialCharacters, "", $productName).'-'.md5(uniqid());

        // Đổi tên file
        $filename = $file['name'];
        $filename = explode('.', $filename);
        $ext = end($filename);        
        // Kiểm tra định dạng file
        $allow_ext = ['png', 'jpg', 'jpeg', 'webp'];

        if (in_array($ext, $allow_ext)) {
            $size = $file['size']/1024/1024;
            if ($size <= $size_allow) {
              $upload = $cloudinary->uploadApi()->upload(
                $file['tmp_name'],
                [ 'folder' => 'FashionShop-Dacn2/products/', 
                  'public_id' => $newNameProduct],
              );
              // echo '<pre>';
              // echo print_r($file);
              // echo '</pre>';

              if ($upload) {
                $ref_Product = "Products";
                $imageUrl = 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673027706/FashionShop-Dacn2/products/'.$newNameProduct.'.jpg';
                $data_product = [
                    'imageUrl' => $imageUrl,
                    'name' => $productName,
                    'amount' => (string)$productAmount,
                    'price' => $productPrice,
                    'rating' => '4',
                    'restorant' => $productIntro,
                    'size' => $productSize,
                    'dateTime' => $now,
                    'sale' => $productSale,
                    'orgin' => $productOrigin,
                ];
                $updateData = $database->getReference($ref_Product)->getChild($categoryId)->push($data_product);
                $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Thêm sản phẩm thành công !')</script>";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
              }
            } else {
              $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Dung lượng ảnh không được quá 10MB !')</script>";
              header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.error('File ảnh không đúng định dạng !')</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>