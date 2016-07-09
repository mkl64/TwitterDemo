<?php
class MyLayout
		{
			// The hardcoded strings we are echoing; making these public so they are accessible to tests.. for now
			public $tweetDivStr = "<div class='Tweet'>";
			public $openingAvatarImgStr = "<img class='TweetUserAvatar' src='";
			public $tweetLogoStr = "<img class='TwitterLogo' src='./assets/logos/TwitterLogo_55acee.png' />";
			public $openingTwitPicImgStr =  "<img class='TwitPic' src='";
			public $endDivStr = "</div>";
			public $closingBrace = "' />";
			public $openParagraph = "<p>";
			public $openParagraphHandle = "<p>@";
			public $closeParagraph = "</p>";
			
			// $data is a collection of tweets
			// $layoutDelegate will be mocked out for tests
			public function LayoutTweets($data, $layoutDelegate)
			{
				foreach ($data->statuses as $result)
				{
					if (isset($result->entities->media)) 
					{
						foreach ($result->entities->media as $media) 
						{
							if (isset($media->media_url) == false)
							{
								// Only printing cat tweets with pics
								continue;
							}
							
							$layoutDelegate($this->tweetDivStr);
							if (isset($result->user->profile_image_url))
							{
								$avatarStr = $this->openingAvatarImgStr.$result->user->profile_image_url.$this->closingBrace;
								$layoutDelegate($avatarStr);
							}
							
							$layoutDelegate($this->tweetLogoStr);
							
							$userNameStr = $this->openParagraph.$result->user->name.$this->closeParagraph;
							$layoutDelegate($userNameStr);
							
							$screenNameStr = $this->openParagraphHandle.$result->user->screen_name.$this->closeParagraph;
							$layoutDelegate($screenNameStr);
							
							if(isset($result->text))
							{
								$tweetTextStr = $this->openParagraph.$result->text.$this->closeParagraph;
								$layoutDelegate($tweetTextStr);
							}
							
							$tweetMediaStr = $this->openingTwitPicImgStr.$media->media_url.$this->closingBrace;
							$layoutDelegate($tweetMediaStr);

							$layoutDelegate($this->endDivStr);
						}
					}
				}
			}
		}
?>