<?php

/*
	Simple project to search tweets from twitter api
*/

header("Content-type:text/html");//send a proper header
ini_set("display_errors","false");//don't display errors
require_once ("twitter.php");//require twitter api

//Initialization of variables mostly application's configuration

$query = $_GET['query'];//the query string to search for
$consumerKey = "OGSdzPyy6tqogL3RQ0Rp5s6PV";
$consumerSecret = "Kni6daw1aGWgAOrVWE8Lbwt5GdczaTPkdU5IW9GmqTaBk8jkmY";
$accessToken = "194077529-BMk4YkSq8vY7YR7tqC02upHvfx0DEU5rN1tJoIrh";
$accessTokenSecret = "5V6kSiXm2vPUc0MgjMY8IP661FhA75eZWydrSPbT7sOsq";
$url = "https://api.twitter.com/1.1/search/tweets.json?q=$query&result_type=mixed&count=2&include_entities=true";//search URL

//Initiate TwitterOAuth class with required variables.

$twitter = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

//send a request to the url
$tweets = $twitter->get($url);

if(!$tweets->statuses){
	die("Try another query");//if there are no tweets available just die
}
echo "<table class='table'>";
foreach ($tweets as $t) {

	//search for the media and store if it exists

	if(is_array($t)){
		foreach ($t as $tweet) {
			$user=$tweet->user;
			if($tweet->entities){
				$entities=$tweet->entities;
				if($entities->media){
			
					$media=$entities->media;
					$media=$media[0];
					$media_url=$media->media_url;
			
				}
			}
			//if there is media url, construct a image tag and store in $abc

			if($media_url){

				$abc="<img src='$media_url' height='100' width='128' />";

			}
			
			echo "<tr><td>".$tweet->text."</td><td>$abc</td></tr>";
			//Re-initializing variables to false so that if a post doesn't have a image, it doesn't get image from the previous one!
			$media_url=false;
			$url=false;
			$abc=false;
		}
		
		//get information about user

		$user=$tweet->user;
		echo "<tr><td>".$t[0]->text."</td><td>$abc</td></tr>";
		//above re-initialization was in a if condition, so this part is also required!
		$media_url=false;
		$url=false;
		$abc=false;	
	}
}
?>