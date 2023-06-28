<?php
    session_start();
    include('../../includes/dbconfig.php');
    if (isset($_POST['btn_register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $datetime = new DateTime();
        $timezone = new DateTimeZone('Asia/Bangkok');
        $now = $datetime->setTimezone($timezone)->format('d-m-Y G:i:s');

        

        if ($password == $repassword) {
            $userProperties = [
                'email' => $email,
                'emailVerified' => true,
                'phoneNumber' => '+84'.$phone,
                'password' => $password,
                'displayName' => $name,
            ];
    
            $createUser = $auth->createUser($userProperties);

            if(isset($createUser)){

                $user = $auth->getUserByEmail("$email");
                $i = $auth->getUserByEmail("$email");

                $data_profile = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'image' => 'https://res.cloudinary.com/djbrvklfq/image/upload/v1673449529/musical-dacn1/logo/avthoso_ylynpd.jpg',
                    'phanQuyen' => 'user',
                    'status' => 'online',
                    'updated' => $now,
                    'key' => $user->uid,
                ];
        
                $ref_profile = "User_Info/".$user->uid.'/';
                $postdata = $database->getReference($ref_profile)->set($data_profile);
                try{
                    $signInResult = $auth->signInWithEmailAndPassword($email, $password);
                    if($signInResult != ''){
                        $_SESSION['id_user'] = $user->uid;
                        $_SESSION['email_user'] = $user->email;
                        $_SESSION['phanQuyen'] = "user";
                        $_SESSION['username'] = $name;
                    
                        header('Location: ../../index.php');
                        exit();
                    }
                } catch (Exception $e){

                }
            } else {
                header('Location: ../register.php');
                exit();
            }
        } else {
            $_SESSION['error'] = " *Mật khẩu không trùng nhau";
            header('Location: ../register.php');
            exit();
        }
    }
?>