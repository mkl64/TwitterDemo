<?php
require "MockMedia.php";
class MockEntities
{
	public $media;
	
	function SetMockMediaArray()
	{
		$mediaEntry = new MockMedia();
		$mediaEntry->SetMockMediaEntryData();
		$media[] = $mediaEntry;
	}
}?>