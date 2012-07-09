<?php

/**
 * Invoke via command line (php /path/to/twitter_stream_job.php) - will log request to
 * the database if it is a valid / applicable request, and may reply in the case of a valid
 * request, or a request that is not ignored.
 */
 
require_once 'config.php';
require_once 'twitter_api.php';
require 'twitter_comms.php';
require __DIR__ . '/../db/db.php';

define('METHOD_HAVE','have');
define('METHOD_NEED','need');
define('RESPONSE_MSG_INVALID_NEED','Hi, please tweet us again and let us know what you need.');
define('RESPONSE_MSG_INVALID_HAVE','Hi, please tweet us again and let us know what you have.');
define('TWEET_PARSE_REGEX', "/(" . TWITTER_USER . ")\s(NEED|HAVE)(\s(.*))?/i");

function writeTweetToDatabase ($user_screen_name, $user_id, $method, $requirement, $hashtags, $coordinate_str) {
  $con = getConnection();
  $user_id = getOrCreateUserFromTwitterHandle($user_screen_name, $user_id);
  $internal_id = null;
  if ($method == METHOD_HAVE) {
    $internal_id = insertOffer($user_id, $requirement, $hashtags, $coordinate_str);
  }
  else {
    $internal_id = insertRequest($user_id, $requirement, $hashtags, $coordinate_str);
  }
  mysql_close($con);
  return $internal_id;
}

function streaming_callback($data, $length, $metrics) {
  $tweet = json_decode($data);
  
  if ($tweet) {
    // Split out and validate the tweet
    preg_match(TWEET_PARSE_REGEX, $tweet->text, $tweet_part_array);
    
    // If the first part of the message isn't the username, return false...
    // this must be an exact match
    if ($tweet_part_array[1] != TWITTER_USER) {
      return false;
    }
    
    // Strip out the first word
    $method = trim(strtolower($tweet_part_array[2]));
    $requirement = trim($tweet_part_array[4]);
    
    // Get other relevant details
    $user_screen_name = $tweet->user->screen_name;
    $user_id = $tweet->user->id;
    $hashtags = $tweet->entities->hashtags; // array of object {indices,text}
    $hashtag_str_array = array();
    for ($i = 0; $i < count($hashtags); $i++) {
      array_push($hashtag_str_array, $hashtags[$i]->text);
    }
    
    // Form coordinates into a simple string
    $coordinate_str = "";
    if (count($tweet->coordinates) > 0) {
      $coordinate_str = $tweet->coordinates->coordinates[0] . ',' . $tweet->coordinates->coordinates[1];
    }
    
    // Tweeted at ourselves, probably best not to reply!
    if (strtolower($user_screen_name) == strtolower(TWITTER_USER)) {
      return false;
    }
    
    // If one of our keyword methods is invoked, dig deeper
    if ($method == METHOD_HAVE || $method == METHOD_NEED) {
      // Check that the user has specified what they have or need
      if ($requirement == '') {
        // Branch error based on input
        if ($method == METHOD_HAVE) {
          $responseMsg = RESPONSE_MSG_INVALID_HAVE;
        }
        else {
          $responseMsg = RESPONSE_MSG_INVALID_NEED;
        }
      }
      else {
        // Log to database, get unique id and respond
        echo "\n";
        echo $method;
        echo "\n";
        $internal_id = writeTweetToDatabase($user_screen_name, $user_id, $method, $requirement, $hashtag_str_array, $coordinate_str);
        if ($method == METHOD_HAVE) {
          $responseMsg = "Offer " . ID_HASHTAG_PREFIX . 'O' . $internal_id . " received, we thank you kindly!";
        }
        else {
          $responseMsg = "Request " . ID_HASHTAG_PREFIX . 'R' . $internal_id . " received, we'll let you know when something turns up!";
        }
      }
    }
    else {
      // Some other word has been entered, ignore this tweet
      return false;
    }

    // Reply to user (pass through tweet id to ensure it is a valid reply)
    // Note that the API will ignore this id unless the message starts with
    // @userScreenName...
    sendTweet('@' . $user_screen_name . ' ' . $responseMsg, $tweet->id_str);
  }
  
  // Stop polling if this file is created
  return file_exists(dirname(__FILE__) . '/STOP');
}

$twitterOAuthAPI = getTwitterOAuthAPI();
$twitterOAuthAPI->streaming_request(
  'POST'
, 'https://stream.twitter.com/1/statuses/filter.json'
  , array(
    'track' => TWITTER_USER
  )
, 'streaming_callback'
);

// output any response we get back AFTER the Stream has stopped -- or it errors
tmhUtilities::pr($twitterOAuthAPI);

?>
