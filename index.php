<?php session_start();
	
	// Include The Lib File 
		require_once("lib/oAuthTwitter/autoload.php");
		require_once("includes/tKeys.inc.php");
		require_once("classes/dbo.class.php");
	
	// Use The Namespace Created By Lib
		use Abraham\TwitterOAuth\TwitterOAuth;


	// Check If Token Is Already Generated OR Not
		if (isset($_SESSION['access_token'])) {
			header("location: tweets.php");
			exit();
		}

	// Generate New Token For Current Session
		$connection = new TwitterOAuth($consumerKey, $consumerSecret);
		
		// Request To Generate New Token
			$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $OauthCallBack));

		// Generate URL With The Help Of OAuth Token
			$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
	
		// Store The OAuth Token & TokenSecret Into The DataBase
			$insert = "insert into TwitterTokens(tt_OauthToken,tt_TokenSecret) values ('".$request_token['oauth_token']."','".$request_token['oauth_token_secret']."')";
			$db->dml($insert);

?>
<!DOCTYPE html>
<html>
<head>
	<title>rtCamp Twitter Assignment | Home</title>


	<!-- Include StyleSheets -->
		<?php require_once("includes/stylesheets.inc.php"); ?>
		
</head>
<body>
<!-- Wrapper Start -->
	<div class="container cus_container">

		<div class="rows">
			
			<?php require_once("includes/header.inc.php"); ?>

			<!-- BreadCrum Start -->
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li class="active">Login</li>
				</ol>
			<!-- BreadCrum End -->

			<?php require_once("includes/sidebar.inc.php"); ?>

			<!-- Login Start -->
				<div class="col-md-8">
					<h3 class="jumbotron bg_color text-center">Login To <i class="text-info fa fa-twitter"></i></h3>
					<div class="rows">
						<form class="well">
							<a class="btn btn-info btn-sm col-lg-12 col-xs-12" href="<?php echo $url; ?>" role="button">Click Here To Login <i class="fa fa-lock"></i></a>
							<span class="clearfix"></span>
							<hr>

							<a class="btn btn-sm btn-success col-lg-12 col-xs-12" href="#" role="button">Download This Project | GitHub <i class="fa fa-github"></i></a>
							<span class="clearfix"></span>
							
						</form>
					</div>
				</div>
			<!-- Login End -->
		
		</div>
	</div>
<!-- Wrapper End -->

	<?php require_once("includes/javascripts.inc.php"); ?>
</body>
</html>