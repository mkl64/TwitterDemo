<!doctype html>
<?php 
ini_set("display_errors", true);
session_start();
require_once "twitteroauth/autoload.php";
require_once "php/LayoutClass.php";
use Abraham\TwitterOAuth\TwitterOAuth;

// TODO: hard coding these key/secret values isn't kosher
$consumer_key = CONSUMER_KEY;
$consumer_secret = CONSUMER_SECRET;
$twitter = new TwitterOAuth($consumer_key, $consumer_secret);
$_SESSION['bearerToken'] = $twitter->oauth2('oauth2/token', array('grant_type' => 'client_credentials'));
?>
<html>

	<head>
		<title>Cats Of Ballard</title>
		<script src="../js/jquery-3.0.0.min.js"></script>
		<script src="../js/twitterWidget.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
	</head>
	
	<body class="BodyContainer">
		<div class="ContentContainer">
					<a>Home</a>
					
				    <a href="html/Favorites.html">C4tsOfBallard Favorites</a>
					
					<a href="tests.php">Tests</a>
					
					<a class="twitter-follow-button"
						href="https://twitter.com/C4tsOfBallard"
						data-show-count="false">
						Follow @C4tsOfBallard</a>

			
			<div class="CatContent">
			<?php
			if (isset($_SESSION['bearerToken']))
			{
				$twitter = new TwitterOAuth($consumer_key, $consumer_secret, null, $_SESSION['bearerToken']->access_token);
				$data = $twitter->get("search/tweets", array('q' => '#catsofinstagram', 'include_entities' => 'true', 'count' => '100'));
				$feedHelper = new MyLayout();
				$layoutFunction = function($htmlString)
				{
					echo $htmlString;
				};
				$feedHelper->LayoutTweets($data, $layoutFunction);
			}
			?>
			</div>
		
		</div>
		
	</body>
	
</html>