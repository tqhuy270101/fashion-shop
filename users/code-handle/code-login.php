<?php
    session_start();
    include('../../includes/dbconfig.php');

    if(isset($_POST['btn_login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Bangkok');
        $now = $datetime->setTimezone($timezone)->format('d-m-Y G:i:s');

        try{
            $user = $auth->getUserByEmail("$email");
            try{
                $signInResult = $auth->signInWithEmailAndPassword($email, $password);
                if($signInResult != ''){
                    $_SESSION['id_user'] = $user->uid;
                    $_SESSION['email_user'] = $user->email;
                    $ref_Info = "User_Info";
                    $userInfo = $database->getReference($ref_Info)->getChild($user->uid)->getValue();
                    $_SESSION['phanQuyen'] = $userInfo['phanQuyen'];
                    $_SESSION['username'] = $userInfo['name'];
                    $data = [
                        'updated' => $now,
                    ];
                    $userInfo = $database->getReference($ref_Info)->getChild($user->uid)->update($data);
                    header('Location: ../../index.php');
                    exit();
                } else {
                    header('Location: ../login.php');
                }
            }
            catch(Exception $e){
                    header('Location: ../login.php');
                    exit();
            }
        }catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e){
            $_SESSION['status'] = "Invalid Email Password";
            header('Location: ../login.php');
            exit();
        }
    }
    else{
        $_SESSION['status'] = "Not Allowed";
        header('Location: ../login.php');
        exit();
    }
?>