<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;
    use Kreait\Firebase\Contract\Storage;
    use Google\Cloud\Core\Timestamp;
    use Kreait\Firebase\Contract\Firestore;
    use Cloudinary\Cloudinary;
    use Cloudinary\Transformation\Resize;
    use Cloudinary\Api\Upload\UploadApi;
    use Cloudinary\Configuration\Configuration;


    $factory = (new Factory)
    ->withServiceAccount('C:/xampp/htdocs/fashionshop-dacn2/includes/account_music.json')
    ->withDatabaseUri('https://classfirebase-f5dfa-default-rtdb.firebaseio.com')
    ->withDefaultStorageBucket('https://classfirebase-f5dfa.appspot.com');

    $cloudinary = new Cloudinary(
        [
            'cloud' => [
                'cloud_name' => 'djbrvklfq',
                'api_key'    => '527363611421196',
                'api_secret' => 'QNhbw60rPK1JbAF6YEWzxITqJ_s',
            ],
        ]
    );


    $database = $factory->createDatabase();
    $auth = $factory-> createAuth();
    $storage = $factory->createStorage();
    // $firestore = $factory->createFirestore();
    // $storage = $factory->getBucket();
?>
<script>
    var admin = require("firebase-admin");

    var serviceAccount = require("C:/xampp/htdocs/fashionshop-dacn2/includes/account_music.json");

    admin.initializeApp({
    credential: admin.credential.cert(serviceAccount),
    databaseURL: "https://classfirebase-f5dfa-default-rtdb.firebaseio.com"
    });

    var firebase = admin.database();



</script>