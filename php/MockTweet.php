<?php
require "MockUser.php";
require "MockEntities.php";
class MockTweet
{
	public $user;
	public $entities;
	public $text;
	
	function SetMockTweetData()
	{
		$user = new MockUser();
		$user->SetMockUserData();
		echo $user->name;
		echo $user->screen_name;
		$entities = new MockEntities();
		$entities->SetMockMediaArray();
		$text = "What a cutie!";
	}
}
?>