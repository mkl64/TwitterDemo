<!doctype html>
<?php
require_once "php/TestClass.php";
require_once "php/LayoutClass.php";
?>
<html>
	<head>
		<title>Cats Of Ballard</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
	</head>
	<body class="BodyContainer">

		<div class="ContentContainer">
				<a href="index.php">Home</a>
				
				<a href="html/Favorites.html">C4tsOfBallard Favorites</a>
				
				<a>Tests</a>
				
				<a class="twitter-follow-button"
				href="https://twitter.com/C4tsOfBallard"
				data-show-count="false">
				Follow @C4tsOfBallard</a>
			
			<div id="TestContainer">
			<p>Message about test approach</p>
			<?php
				$testClass = new TestClass();
				$layoutObject = new MyLayout();
				
				$testClass->TestLayoutGeneration($layoutObject);
				
				//$testString = $testClass->GenerateExpectedEchoString($layoutObject,$mockTweet);
				//echo $testString;
			?>
		</div>
		
		</div>
		
		
		
	</body>
</html>