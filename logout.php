<?php session_start();

	// Destroy All The Sessions
		session_destroy();

	// ReDirect To Twitter Logout Page
		$logout_url = "https://twitter.com/logout";
		header("location: $logout_url");
		exit();
 ?>
