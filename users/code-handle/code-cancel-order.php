<?php
    session_start();
    include('../../includes/dbconfig.php');
    if (!isset($_SESSION['id_user']) ) {
        header("location: ../users/login.php");
    } else if (isset($_GET['id']) && $_GET['id'] != '') {
        $ref_order = "Add";
        $cancelOrder = $database->getReference($ref_order)->getChild($_SESSION['id_user'])->getChild($_GET['id'])->remove();
        if ($cancelOrder) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>