<?php
require_once "LayoutClass.php";
require_once "ResponseObject.php";
require_once "MockTweet.php";

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
			echo $htmlString;
			//$_SESSION['echoString'] .= $htmlString;
		};

		$responseObject = new ResponseObject();
		$mockTweet = new MockTweet();
		$mockTweet->SetMockTweetData();
		$responseObject->AddMockTweet($mockTweet);
		echo $mockTweet->user->name;
		echo $mockTweet->text;
		$layoutObject->LayoutTweets($responseObject, $mockEcho);
		$expectedString = $this->GenerateExpectedEchoString($layoutObject, $mockTweet);
		if (strcmp($_SESSION['echoString'], $expectedString) == 0)
		{
			echo "TestLayoutGeneration: PASSED";
		}
		else
		{
			echo $_SESSION['echoString'];
			echo "TestLayoutGeneration: FAILED";
		}
	}

	function GenerateExpectedEchoString($layoutObject, $mockTweet)
	{
		$avatarStr = $layoutObject->openingAvatarImgStr.$mockTweet->user->profile_img_url.$layoutObject->closingBrace;
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
?>