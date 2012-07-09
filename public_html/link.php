<?php
require_once 'db/db.php';
require_once 'twitter/twitter_comms.php';

/**
 * Convenience function to construct a tweet, targetting a specific user,
 * and mentioning a second user. Truncates the dynamic length text input
 * to avoid violating the twitter maximum tweet length, defined in
 * TWITTER_CHAR_LIMIT.
 * @param target_user the user to tweet at (not including '@' prefix)
 * @param mention_user the user to mention (not including '@' prefix)
 * @param join_text the text to string together the mention and the title description
 * @param title_str the title text of the wanted or offered item(s)
 * @param hashtag_ref the hashtag to uniquely reference the original "need" or "have" tweet
 */
function constructAndSendTweet($target_user, $mention_user, $join_text, $title_str, $hashtag_ref) {
  // Mash together the initial prefix and suffix parts
  $message_prefix = '@' . $target_user . ' @' . $mention_user . ' ' . $join_text . ' "';
  $message_suffix = '" ' . $hashtag_ref;
  
  // If the title of the request or offer is too large, we need to append ellipsis and truncate
  // the title string to fit
  if (strlen($title_str) > TWITTER_CHAR_LIMIT - strlen($message_prefix) - strlen($message_suffix)) {
    $message_suffix = '...' . $message_suffix;
    $title_str = substr($title_str, 0, TWITTER_CHAR_LIMIT - strlen($message_prefix) - strlen($message_suffix));
  }
  $message = $message_prefix . $title_str . $message_suffix;
  
  // Belt and braces check before we hand off to twitter convenience code
  if (strlen($message) > TWITTER_CHAR_LIMIT) {
    die("Constructed invalid tweet");
  }
  else {
    sendTweet($message, null);
  }
}

/** 
 * Sends tweets to the relevant parties regarding a link between
 * a request and offer.
 * @param link_id the link id to send tweets regarding
 */
function sendTweetsForLink ($link_id) {
  $query = "
    SELECT 
      o.title offer_title
    , r.title req_title
    , ou.twitter_handle offer_user_twitter_handle
    , ru.twitter_handle req_user_twitter_handle
    , o.id offer_id
    , r.id req_id
    FROM links l
    JOIN offers o ON o.id = l.offer_id
    JOIN requests r ON r.id = l.request_id
    JOIN users ou ON ou.id = o.user_id
    JOIN users ru ON ru.id = r.user_id
    WHERE l.id = $link_id";
  
  $con = getConnection();
  $result = mysql_query($query);
  if ($result && mysql_num_rows($result) == 1) {
    $row = mysql_fetch_array($result);
    
    // Shred into useful variables
    $offer_title = $row['offer_title'];
    $req_title = $row['req_title'];
    $offer_user_twitter_handle = $row['offer_user_twitter_handle'];
    $req_user_twitter_handle = $row['req_user_twitter_handle'];
    $offer_id = $row['offer_id'];
    $req_id = $row['req_id'];
    
    constructAndSendTweet($offer_user_twitter_handle, $req_user_twitter_handle, 'needs', $req_title, ID_HASHTAG_PREFIX . 'R' . $req_id);
    constructAndSendTweet($req_user_twitter_handle, $offer_user_twitter_handle, 'has', $offer_title, ID_HASHTAG_PREFIX . 'O' . $offer_id);
  }
  else {
    die("Failed to tweet the link");
  }
  mysql_close($con);
}

?>