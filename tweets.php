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

		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		// Get User's Basic Information
			$user = $connection->get("account/verify_credentials");

			// Get User ScreenName 			| @kmjadeja_kmj
			// Get User Account Name 		| Krunalsinh Jadeja
			
		// Get The Recent Tweets Of LoggedIn User
			$tweets = $connection->get('statuses/user_timeline', ['count' => 10, 'exclude_replies' => true]);

		// Set The ScreenName In Session For Future Use
			$_SESSION["dUserScreen"] = $user->screen_name;
		
		$i=0;
		foreach ($tweets as $myTweets) {
			// Set Data For Download Feature
				$_SESSION["downloadData"][$i]["name"] = $myTweets->user->name;
				$_SESSION["downloadData"][$i]["screen_name"] = $myTweets->user->screen_name;
				$_SESSION["downloadData"][$i]["text"] = $myTweets->text;
				$_SESSION["downloadData"][$i]["time"] = $myTweets->created_at;
				$i++;
		}
		$data;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>rtCamp Twitter Assignment | Tweets</title>

	<!-- Include StyleSheets -->
		<?php require_once("includes/stylesheets.inc.php"); ?>

	<script type="text/javascript">
		$(document).ready(function() {
			
			load_tweets();
			$(".tFollowers").click(load_tweets);

			function load_tweets(screen_name = '') {
				$.ajax({
					url: "generateTweets.php",
					data: {
						"tUser" :  screen_name == '' ? '<?php echo $user->screen_name;?>' : $(this).val()
					},
					type: "POST",
					dataType: "JSON",
					error: function() {

						alert("Some Problem To Retrive Tweets...");
						// Hide Loader
					},
					success: function (response) {					
						try {
								$('.tweet-slider').removeData("flexslider");
								if(response.error)
								{
									$("#tweetsDisplay").empty();
									$("#tweetsDisplay").append('<li class ="display_none my_padding"> <div class="media-body item" > <h4 class="media-heading" ><i class="fa fa-lock"></i> &nbsp;&nbsp;Accounnt Is Protected !!! Sorry....</h4> </div> </li>');
								}
								else {
									var i;
									$("#tweetsDisplay").empty();
									for(i=0;i<response.length;i++){
											
										$("#tweetsDisplay").append('<li class ="display_none my_padding"> <div class="tweet-right"> <div> <img src="'+response[i].user.profile_image_url+'"> </div> </div>  <div class="media-body item"> <h4 class="media-heading">'+response[i].user.name+' &nbsp; | <small>@'+response[i].user.screen_name+'</small></h4> <span class="clearfix"></span> <p class="text-justify my_padding letterSpacing" >'+response[i].text+'</p> </div> </li><span class="clearfix"></span>');
								}
								$('.tweet-slider').flexslider({
									selector: "#tweetsDisplay > li",
									animation: "fade",
									slideshow: true,
									slideshowSpeed: 5000,
									controlNav: false,
									directionNav: false,
									keyboard: false,
									smoothHeight: false,
									pauseOnHover: true,
									start: function(){
										$('.user-tweets').children('li').css({
											'opacity': 1
										});
									}
								});
							}							
						} catch (err) {
							alert("Oops! something is wrong. try later!"+err);
							console.log("load_tweets onSuccess: " + err);
						}
					}
				});
			}
		});
	</script>
</head>
<body>
<!-- Wrapper Start -->
	<div class="container cus_container">
		<div class="rows">
			
			<?php require_once("includes/header.inc.php"); ?>

			<!-- BreadCrum Start -->
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="tweets.php"><?php echo "@ ".$user->screen_name ?></a></li>
					<li  class="active">Tweets</li>
				</ol>
			<!-- BreadCrum End -->

			<?php require_once("includes/sidebar.inc.php"); ?>

			<!-- Main Continer Start -->
				<div class="col-md-9">

					<!-- Tweets Header Start -->
						<div class="rows well  text-center">	
							<div class="col-sm-9">
								<h3>
									Recent Tweets <i class="text-info fa fa-twitter"></i>
								</h3>
							</div>
							<div class="col-sm-3">
								<a class="btn btn-info btn-sm full-width btn-block" href="logout.php">Logout &nbsp; <i class="fa fa-unlock"></i> </a>
							</div>
							<span class="clearfix"></span>
						</div>
					<!-- Tweets Header End -->

					<!-- Tweets Continer Start -->
						<div class="well tweet-slider setHeight">
							<ul class="user-tweets tweet-list" id="tweetsDisplay">
								
								<!-- Tweets Are Displayed Here -->
								
							</ul>
						</div>
					<!-- Tweets Continer End -->
					<a href="download.php" class="btn btn-info col-xs-12" role="button" ><i class="fa fa-download"></i> Download Tweets</a>
				</div>
			<!-- Main Continer End -->
		</div>
	</div>
<!-- Wrapper End -->

	<?php require_once("includes/javascripts.inc.php"); ?>
</body>
</html>