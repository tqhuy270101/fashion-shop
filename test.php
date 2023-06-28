<!DOCTYPE html>
<html>
<head>
	<title>Login with Google using Firebase and PHP</title>
	<!-- Firebase JavaScript library -->
	<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-auth.js"></script>

	<!-- Your web app's Firebase configuration -->
	<script>
		var firebaseConfig = {
			apiKey: "AIzaSyAsIY--2szImGTDe_95tLnAMz6EaTvLUSY",
			authDomain: "classfirebase-f5dfa.firebaseapp.com",
			projectId: "classfirebase-f5dfa",
			storageBucket: "classfirebase-f5dfa.appspot.com",
			messagingSenderId: "338909855461",
			appId: "1:338909855461:web:ad0dda42e1fde9eff49e0c"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
	</script>
</head>
<body>
	<button id="google-login-button" onclick="signInWithGoogle()">Login with Google</button>

	<!-- This script will handle the login process -->
	<script>
		function signInWithGoogle() {
			// Create an instance of the Google provider object
			var provider = new firebase.auth.GoogleAuthProvider();

			// Authenticate with Firebase using the Google provider object
			firebase.auth().signInWithPopup(provider)
				.then(function(result) {
					// Handle successful authentication
					console.log(result);
				})
				.catch(function(error) {
					// Handle authentication error
					console.log(error);
          console.log('hello');
				});
		}
	</script>
</body>
</html>

<?php
require_once "C:/xampp/htdocs/fashionshop-dacn2\includes/vendor/autoload.php"; // Include the Firebase PHP SDK

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Fetch the service account key JSON file contents
$firebase = (new Factory)
->withServiceAccount('C:/xampp/htdocs/fashionshop-dacn2/includes/account_music.json')
->withDatabaseUri('https://classfirebase-f5dfa-default-rtdb.firebaseio.com');
// Get the authentication component
$auth = $firebase->createAuth();

// Authenticate the user using the Firebase ID token obtained from the client side
$idToken = $_POST['idToken'];
$verifiedIdToken = $auth->verifyIdToken($idToken);
$uid = $verifiedIdToken->getClaim('sub');

// Retrieve the user's information from Firebase
$user = $auth->getUser($uid);

// Use the retrieved information to create a session for the user
session_start();
$_SESSION['user'] = [
	'uid' => $user->uid,
	'email' => $user->email,
	'displayName' => $user->displayName,
	'photoUrl' => $user->photoUrl
];

// Redirect the user to the home page
header('Location: /');
exit;
?>