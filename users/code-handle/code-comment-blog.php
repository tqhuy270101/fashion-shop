<?php 
  session_start(); 
  include('../../includes/dbconfig.php');
?>
<?php
if (!$_SESSION['id_user'] && !$_SESSION['email_user']) {
  header('Location: ../login.php');
} else if (isset($_POST['btn_comment'])) {
    if (isset($_GET['id'])) {
        $idBlog = $_GET['id'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email_user'];
        $idUser = $_SESSION['id_user'];
        $imageUser = $_SESSION['image_user'];
        $cmt = $_POST['comment'];

            //   get thời gian
            $datetime = new DateTime();
            $timezone = new DateTimeZone('Asia/Bangkok');
            $now = $datetime->setTimezone($timezone)->format('d/m/Y g:i A');


        $ref_cmtBlog = "Comment_Blog";
        
        $dataComment = [
            'comment' => $cmt,
            'created' => $now,
            'image' => $imageUser,
        ];

        $addComment = $database->getReference($ref_cmtBlog)->getChild($idBlog)->getChild($idUser)->push($dataComment);
        if ($addComment) {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Đã bình luôn !')</script>";
        } else {
            $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Bình luận không thành công !')</script>";
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>