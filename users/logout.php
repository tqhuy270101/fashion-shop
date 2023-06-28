<?php
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['email_user']);
unset($_SESSION['phanQuyen']);
unset($_SESSION['username']);
header('Location: login.php');
exit();
?>