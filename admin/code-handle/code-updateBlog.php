<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php
    $ref_blog = "news";
    $getIdBlog = $_GET['id'];
    $datetime = new DateTime();
    $timezone = new DateTimeZone('Asia/Bangkok');
    $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');
    if (isset($_POST['btn_updateBlog'])) {
        $category = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $file = $_FILES['fileImage'];
        $size_allow = 10; /* cho phép upload 10mb */

        // Đổi tên file
        $filename = $file['name'];
        $filename = explode('.', $filename);
        $ext = end($filename);
        $newFileName = $getIdBlog.'-'.md5(uniqid());
        $imageUrl = 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673027706/FashionShop-Dacn2/blogs/'.$newFileName.'.jpg';
        
        // Kiểm tra định dạng file
        $allow_ext = ['png', 'jpg', 'jpeg', 'webp'];

        $data_blog = [
            'category' => $category,
            'title' => $title,
            'updated' => $now,
            'content' => $content,
        ];
        $updateData = $database->getReference($ref_blog)->getChild($getIdBlog)->update($data_blog);
        if ($updateData) {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật tin tức thành công !')</script>";
        } else {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Cập nhật tin tức thất bại !')</script>";
        }

        if (in_array($ext, $allow_ext)) {
            $size = $file['size']/1024/1024;
            if ($size <= $size_allow) {
                $upload = $cloudinary->uploadApi()->upload(
                    $file['tmp_name'],
                    ['public_id' => 'FashionShop-Dacn2/blogs/'.$newFileName]
                );
                if ($upload) {
                    $data_blog = [
                        'image' => $imageUrl,
                    ];
                    $updateData = $database->getReference($ref_blog)->getChild($getIdBlog)->update($data_blog);
                }
                $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật ảnh thành công !')</script>";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>