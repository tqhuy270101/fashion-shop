<?php 
    session_start();
    if (!isset($_SESSION['id_user']) ) {
        header("location: ../users/login.php");
    }
    if ($_SESSION['phanQuyen'] != 'admin'){
        header("location: ../index.php");
    }
 ?>