<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "get these codes from app.twitter.com",
    'oauth_access_token_secret' => "get these codes from app.twitter.com",
    'consumer_key' => "get these codes from app.twitter.com",
    'consumer_secret' => "get these codes from app.twitter.com"
);
//this should be a function that gets an array of twitter screen_name, and in a loop crawl each users tweets
//
$base_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

$screen_names = array("SaeedTaghaviV", "ArefGhorbani");
foreach ($screen_names as $screen_name)
{
    //set get field for each screen_name, it is necessary
    $getfield = '?screen_name='.$screen_name;
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    //
    $response = $twitter->setGetfield($getfield)
        ->buildOauth($base_url , $requestMethod)
        ->performRequest();
    $tweets = json_decode($response);
    foreach ($tweets as $tweet)
    {
        if ($tweet->in_reply_to_status_id=="")
        {
//            $tweet->user->name;
            echo $tweet->user->screen_name.": <br>";
            echo $tweet->text;
            echo "<br>*********<br>";
        }
    }
}