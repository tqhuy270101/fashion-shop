<?php  include('../../components/backend/checkAccount.php') ?>
<?php include('../../includes/dbconfig.php') ?>
<?php
    if (isset($_POST['btn_addBlog'])) {
        $category = $_POST['category'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $content = $_POST['content'];

        // Lấy thời gian hiện tại
        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Bangkok');
        $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');

        $file = $_FILES['fileImage'];
        $size_allow = 10;

        // Đổi tên file
        $ref_blog = "news";
        $keyBlog = $database->getReference($ref_blog)->push();
        $filename = $file['name'];
        $filename = explode('.', $filename);
        $ext = end($filename);
        $newFileName = $keyBlog->getKey().'-'.md5(uniqid());
        $imageUrl = 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673027706/FashionShop-Dacn2/blogs/'.$newFileName.'.jpg';
        
        // Kiểm tra định dạng file
        $allow_ext = ['png', 'jpg', 'jpeg'];

        if (in_array($ext, $allow_ext)) {
            $size = $file['size']/1024/1024;
            if ($size <= $size_allow) {
                $upload = $cloudinary->uploadApi()->upload(
                    $file['tmp_name'],
                    ['public_id' => 'FashionShop-Dacn2/blogs/'.$newFileName]
                  );
                if ($upload) {
                    $data_blog = [
                        'category' => $category,
                        'title' => $title,
                        'author' => $author,
                        'image' => $imageUrl,
                        'content' => $content,
                        'read' => 0,
                        'created' => $now,
                        'updated' => $now,
                    ];
                    $addBlog = $keyBlog->set($data_blog);
                    if ($addBlog) {
                        $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Thêm blog thành công !')</script>";
                        header('Location: ../blogs.php');
                    } else {
                        $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Thêm blog thất bại !')</script>";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
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