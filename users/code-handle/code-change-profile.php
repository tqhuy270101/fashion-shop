<?php
session_start();
include('../../includes/dbconfig.php');

if (empty($_SESSION['id_user'])) {
    header('Location: ../login.php');
} elseif ($_POST['changeProfile']) {
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $idUser = $_SESSION['id_user'];

    $data_updates = [
        'name' => $username,
        'address' => $address,
        'phone' => $phone
    ];
    $ref_profile = "User_Info";
    $postdata = $database->getReference($ref_profile)->getChild($_SESSION['id_user'])->update($data_updates);

    if ($postdata) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>