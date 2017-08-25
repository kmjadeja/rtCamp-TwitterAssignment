jQuery(document).ready(function($){
	
	/*
		Set Slider Properties
		-----------------------------

		selector 		: To Select Tweet

		animation 		: To Set Animation Of Fade | Fade or Slide 
		slideshow 		: To Start Slide Show Automatically
		slideshowSpeed	: To Set The Speed Of Animation | in MiliSeconds like 1000 = 1sec 
		animationSpeed	: To Set The Speed Of Transition
		
		controlNav		: To Off The Navigation Control
		directionNav 	: To Off The Text / UL > LI Points 
		direction 		: Horizontal Slide And Vertical Slide | Default Is horizontal 
		
		pauseOnHover	: Pause The Slider When User Hover The Mouse On The Tweet
		keyboard		: To Change Tweets Using Keyboard's Arrow Key
		
		smoothHeight 	: To Change The Size Of Continer Automatically as Per Tweet Description


	*/
	// Slider For Followers
		$('.followers-slider').flexslider({
			selector: ".user-follow > li",
			animation: "slide",
			slideshow: true,
			animationSpeed: 200,
			slideshowSpeed: 3000,
			controlNav: false,
			directionNav: false,
			direction: "vertical",
			keyboard: false,
			smoothHeight: false,
			pauseOnHover: true,
			start: function(){
				$('.user-follow').children('li').css({
					'opacity': 1
				});
			}
		});

});