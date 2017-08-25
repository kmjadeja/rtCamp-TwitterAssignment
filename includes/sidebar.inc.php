<?php session_start();

	// Include The Lib File 
		require_once("lib/oAuthTwitter/autoload.php");
		require_once("includes/tKeys.inc.php");
		require_once("classes/dbo.class.php");
	
	// Use The Namespace Created By Lib
		use Abraham\TwitterOAuth\TwitterOAuth;
	
	// Check AccessToken Is There Or NOT
		if (!isset($_SESSION['access_token'])) {

 ?>
<!-- SideBar Start -->
				<div class="col-md-4">
					<h3 class="well well-lg bg_welcome text-muted text-center"><i class = "fa fa-code"></i> Welcome&nbsp;&nbsp;<hr></h3>

					<p class="text-muted text-justify">
						&rarr; rtCamp Twitter Assignment
					</p>
						<hr>
					<p class="text-muted text-justify">
						&rarr; <a href="" class="text-muted">Available On GitHub <i class="fa fa-github"></i></a>
					</p>
						<hr>
					<p class="text-muted text-justify">
						&rarr; Develop By : Krunalsinh M. Jadeja
					</p> 
						<hr>
					<p class="text-muted text-justify">
						&rarr; &nbsp;<i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;kmjadeja@hotmail.com
					</p> 
						<hr>
				</div>
			<!-- SideBar End -->
<?php 
		}
	else {
			$access_token = $_SESSION['access_token'];
			$connection = new TwitterOAuth($consumerKey, $consumerSecret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

			//Get User's Follower's List
				$followers = $connection->get('followers/list')->users;

 ?>
<!-- SideBar Start -->
				<div class="col-md-3 follower-slider">
					<h3 class="well well-lg bg_welcome">Followers <i class = "fa fa-check-square-o"></i></h3>
					<p class="text-muted text-justify">
						<div class="well followers-slider">
							<ul class="user-follow tweet-list">
								
								<!-- Followers Start -->
									<?php 
										// Display All Followers
											$count=0;
											$displayFollowers = 3;
											foreach($followers as $follow_side) {
												if($count == 0)
												{
													echo "<li class='display_none'>";
													echo "<button class='btn btn-link tFollowers' value='".$follow_side->screen_name."'>@&nbsp;".$follow_side->screen_name."</button>";
													echo "<hr class='no-margin'>";
													$count++;
												}
												else if ($count == $displayFollowers)
												{
													echo "<button class='btn btn-link tFollowers' value='".$follow_side->screen_name."'>@&nbsp;".$follow_side->screen_name."</button>";
													echo "<hr class='no-margin'>";
									 				echo "</li>";
													$count = 0;
												}
												else
									 			{
													echo "<button class='btn btn-link tFollowers' value='".$follow_side->screen_name."'>@&nbsp;".$follow_side->screen_name."</button>";
													echo "<hr class='no-margin'>";
													$count++;

									 			}
										 	}
									 ?>
								<!-- Followers End -->
							</ul>
						</div>
					</p>
				</div>
			<!-- SideBar End -->
<?php 	} ?>