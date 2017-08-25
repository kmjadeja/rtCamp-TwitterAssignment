<?php session_start();
	
	// Include The Lib File 
		require_once("lib/oAuthTwitter/autoload.php");
		require_once("includes/tKeys.inc.php");
		require_once("classes/dbo.class.php");
	
	// Use The Namespace Created By Lib
		use Abraham\TwitterOAuth\TwitterOAuth;
	
	// Check AccessToken Is There Or NOT
		if (!isset($_SESSION['access_token'])) {
			header("location: logout.php");
			exit();
		}

		
		// Check Request Is Valid Or NOT
			if(empty($_POST["tUser"]))
				exit();


		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		// Get User's Basic Information
			$user = $connection->get("account/verify_credentials");

			// Get User Name 			| @kmjadeja_kmj
				$userScreenName = $user->screen_name;
			// Get User Account Name 	| Krunalsinh Jadeja
				$UserName = $user->name;
		
		// Get The Recent Tweets Of LoggedIn User
			$tweets = $connection->get('statuses/user_timeline', ['count' => 10, 'screen_name' => $_POST["tUser"],'exclude_replies' => true]);
			
			/*if($tweets->error)
			{
				$tweets->text = "Account Is Protected....";
			}*/
			echo json_encode($tweets);
			exit();

 ?>
