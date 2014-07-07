<?php
$query=$_GET['query'];
header("Content-type:text/html");
ini_set("display_errors","false");
$consumerKey="OGSdzPyy6tqogL3RQ0Rp5s6PV";
$consumerSecret="Kni6daw1aGWgAOrVWE8Lbwt5GdczaTPkdU5IW9GmqTaBk8jkmY";
require_once ("twitter.php");
$accessToken="194077529-BMk4YkSq8vY7YR7tqC02upHvfx0DEU5rN1tJoIrh";
$accessTokenSecret="5V6kSiXm2vPUc0MgjMY8IP661FhA75eZWydrSPbT7sOsq";
$twitter=new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
$url="https://api.twitter.com/1.1/search/tweets.json?q=$query&result_type=mixed&count=4";
$tweets=$twitter->get($url);
if(!$tweets->statuses){
	die("Try another query");
}
$tweets=$tweets->statuses;
echo "<table class='table'>";
foreach ($tweets as $tweet) {
	echo "<tr><td>".$tweet->text."</td><td>".$tweet->created_at."</td><td>".$tweet->source."</td></tr>";
}
$tweets=json_encode($tweets);
//echo $tweets;
?>