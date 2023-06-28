<?php 
  session_start(); 
  include('../../includes/dbconfig.php');
?>
<?php
    if (isset($_SESSION['id_user'])) {
        if (isset($_GET['idCategory']) && $_GET['idCategory'] != '' && isset($_GET['idProduct']) && $_GET['idProduct'] != '') {
            $idProduct = $_GET['idProduct'];
            $idCategory = $_GET['idCategory'];
            $ref_favorite = 'Favorite';
            $ref_product = 'Products';
            $ref_user = 'User_Info';
            $idUser = $_SESSION['id_user'];

            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Bangkok');
            $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');
            $day = $datetime->setTimezone($timezone)->format('d/m/Y');
            $time = $datetime->setTimezone($timezone)->format('G:i');

            // lấy dữ liệu
            $detailProduct = $database->getReference($ref_product)->getChild($idCategory)->getChild($idProduct)->getValue();
            $userInfo = $database->getReference($ref_user)->getChild($idUser)->getValue();
            $dataFavorite = [
                'image' => $detailProduct['imageUrl'],
                'name' => $detailProduct['name'],
                'rating' => $detailProduct['rating'],
                'price' => $detailProduct['price'],
                'restorant' => $detailProduct['restorant'],
                'amount' => $detailProduct['amount'],
                'sale' => $detailProduct['sale'],
                'origin' => $detailProduct['origin'],
                'dateTime' => $now,
                'idCategory' => $idCategory,
            ];

            // kiểm tra sản phẩm 
            $fetchFavorite = $database->getReference($ref_favorite)->getChild($idUser)->getChild($idProduct)->getValue();
            $count = 0;

            if($fetchFavorite > 0){
                $count = 1;
            } else {
                $count = 0;
            }

            if ($count == 0) {
                $addFavorite = $database->getReference($ref_favorite)->getChild($idUser)->getChild($idProduct)->set($dataFavorite);
                if ($addFavorite) {
                    $dataCsv = [
                        [$idUser, $userInfo['name'], $userInfo['email'], $idProduct, $detailProduct['origin'], $day, $time]
                    ];
        
                    $filename = '../../data/favorite.csv';
                    // open csv file for writing
                    $f = fopen($filename, 'a');
                    if ($f === false) {
                        die('Error opening the file ' . $filename);
                    }
                    // write each row at a time to a file
                    foreach ($dataCsv as $row) {
                        fputcsv($f, $row);
                    }
                    // close the file
                    fclose($f);

                    $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã thêm vào mục yêu thích !')</script>";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else if ($count == 1) {
                $unFavorite = $database->getReference($ref_favorite)->getChild($idUser)->getChild($idProduct)->remove();
                if ($unFavorite) {
                    $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã xóa khỏi mục yêu thích !')</script>";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Bạn cần đăng nhập !')</script>";
        header('Location: ../login.php');
    }
?>