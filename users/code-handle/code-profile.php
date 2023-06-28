<?php 
  session_start(); 
  include('../../includes/dbconfig.php');
?>
<?php
if (!$_SESSION['id_user'] && !$_SESSION['email_user']) {
  header('Location: ../login.php');
} else if (isset($_POST['btn_updateAvatar'])) {
    $file = $_FILES['filename'];
    
    if (!$file) {
      $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Chưa chọn file ảnh !')</script>";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $size_allow = 10; /* cho phép upload 10mb */

    // Đổi tên file
    $filename = $file['name'];
    $filename = explode('.', $filename);
    $ext = end($filename);
    $newFileName = $_SESSION['id_user'].'-'.md5(uniqid());
    
    // Kiểm tra định dạng file
    $allow_ext = ['png', 'jpg', 'jpeg', 'webp'];
    
    if (in_array($ext, $allow_ext)) {
      $size = $file['size']/1024/1024;
      if ($size <= $size_allow) {
        $upload = $cloudinary->uploadApi()->upload(
          $file['tmp_name'],
          ['public_id' => 'FashionShop-Dacn2/logos/'.$newFileName]
        );
        $imageUrl = 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673027706/FashionShop-Dacn2/logos/'.$newFileName.'.jpg';
        if ($upload) {
          $ref_Info = "User_Info";
          $dataAvatar = [
            'image' => $imageUrl,
          ];
          $dataInfo = $database->getReference($ref_Info)->getChild($_SESSION['id_user'])->update($dataAvatar);
          $_SESSION['status'] = "<script type='text/javascript'>toastr.success('Cập nhật thành công !')</script>";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
      } else {
        $_SESSION['status'] = "<script type='text/javascript'>toastr.error('Dụng lượng tối đa chỉ được 10MB !')</script>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    } else {
      $_SESSION['status'] = "<script type='text/javascript'>toastr.error('File không đúng định dạng !')</script>";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}