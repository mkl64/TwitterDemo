<?php
require_once "LayoutClass.php";
require_once "twitteroauth/src/Util/JsonDecoder.php";

use Abraham\TwitterOAuth\Util;

class TestClass
{
	// This is the string that LayoutTweets builds
	// Given this mock tweet, does LayoutClass generate the string I expect?
	// return the string to the tests.php file to also echo and visually verify the UI
	
	// What do we expect to receive from LayoutTweets?
	function TestLayoutGeneration($layoutObject)
	{
		// Compare $echoString to output of GenerateExpectedEchoString
		$mockEcho = function($htmlString)
		{
			// Instead of echoing as the LayoutClass generates the div, this function will concatenate the pieces into a session var
			$_SESSION['echoString'] .= $htmlString;
		};

		$mockTweet = $this->GenerateMockTweet();

		$layoutObject->LayoutTweets($mockTweet, $mockEcho);
     	$expectedString = $this->GenerateExpectedEchoString($layoutObject, $mockTweet);
		if (strcmp($_SESSION['echoString'], $expectedString) == 0)
		{
			echo "TestLayoutGeneration: PASSED, 0";
		}
		else
		{
			echo "TestLayoutGeneration: FAILED ";
			echo strcmp($_SESSION['echoString'], $expectedString);
		}
		echo $_SESSION['echoString'];
		echo $expectedString;
	}
	
	function GenerateMockTweet()
	{
		// Using test json, create an object from json
		$mockTweetJson = '{"statuses":[{"entities":{"media":[{"media_url":"https:\/\/pbs.twimg.com\/media\/Cm53Ga1VMAA-uY1.jpg"}]},"user":{"profile_image_url":"https:\/\/pbs.twimg.com\/profile_images\/749657697750913024\/ivnjIPtI.jpg","name":"Melinda Lim","screen_name":"C4tsOfBallard"},"text":"What a cutie!"}]}';
		$mockTweet = json_decode($mockTweetJson);
		return $mockTweet;
	}

	function GenerateExpectedEchoString($layoutObject, $data)
	{
		foreach($data->statuses as $mockTweet)
		{
			$avatarStr = $layoutObject->openingAvatarImgStr.$mockTweet->user->profile_image_url.$layoutObject->closingBrace;
			$nameStr = $layoutObject->openParagraph.$mockTweet->user->name.$layoutObject->closeParagraph;
			$handleStr = $layoutObject->openParagraphHandle.$mockTweet->user->screen_name.$layoutObject->closeParagraph;
			$textStr = $layoutObject->openParagraph.$mockTweet->text.$layoutObject->closeParagraph;
			$mediaObj = $mockTweet->entities->media[0];
			$twitPicStr = $layoutObject->openingTwitPicImgStr.$mediaObj->media_url.$layoutObject->closingBrace;
		
			// Concatenate the expected string
			$expected = $layoutObject->tweetDivStr.$avatarStr.$layoutObject->tweetLogoStr.$nameStr.$handleStr.$textStr.$twitPicStr.$layoutObject->endDivStr;
			return $expected;
		}
	}
}
?>