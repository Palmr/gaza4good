<?php
require_once 'twitter_api.php';

/**
 * Sends a tweet via the twitter API.
 * @param message the message to send
 * @param in_reply_to_status_id the id of the tweet to which we are replying
 */
function sendTweet($message, $in_reply_to_status_id) {
  echo $message;
  
  $twitterOAuthAPI = getTwitterOAuthAPI();
  $code = $twitterOAuthAPI->request('POST', $twitterOAuthAPI->url('1/statuses/update'), array(
    'status' => $message
  , 'in_reply_to_status_id' => $in_reply_to_status_id
  ));

  if ($code == 200) {
    $response = json_decode($twitterOAuthAPI->response['response']);
  } else {
    $response = $twitterOAuthAPI->response['response'];
  }
}

?>

