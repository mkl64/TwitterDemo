<?php
require "MockTweet.php";
class ResponseObject
{
	public $statuses;
	
	public function AddMockTweet($mockTweet)
	{
		$statuses = array($mockTweet);
	}
}?>