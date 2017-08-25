<?php session_start();

	// Include The Lib File 
		require_once("lib/oAuthTwitter/autoload.php");
		require_once("includes/tKeys.inc.php");
		require_once("classes/dbo.class.php");
	
	// Use The Namespace Created By Lib
		use Abraham\TwitterOAuth\TwitterOAuth;


	// GET Token From DataBase To Verify.
		$sel_data = "select * from TwitterTokens order by tt_id DESC";
		$sel_data = "select * from TwitterTokens where tt_OauthToken = '".$_GET["oauth_token"]."'";
		$res_data = $db->get($sel_data);
		$row = mysqli_fetch_assoc($res_data);
	

	// Create New Object & New Connection
		$connection = new TwitterOAuth($consumerKey, $consumerSecret, $row["tt_OauthToken"], $row["tt_TokenSecret"]);

	// Request To Access The Token
		$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_GET['oauth_verifier']));

	// Save Access Token For Future Use.
		$_SESSION['access_token'] = $access_token;
	
	// Verify The Request CODE
		if ($connection->http_code == 0) {
			
			$_SESSION['status'] = 'verified';
			header('location: tweets.php');
			exit();
		}
		else {
			header("location: index.php");
			exit();	
		}

?>