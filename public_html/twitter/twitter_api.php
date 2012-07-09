<?php

require 'auth/tmhOAuth.php';
require 'auth/tmhUtilities.php';
require_once 'config.php';

define('TWITTER_CHAR_LIMIT', 140);

function getTwitterOAuthAPI () {
  return new tmhOAuth(array(
    'consumer_key'    => CONSUMER_KEY
  , 'consumer_secret' => CONSUMER_SECRET
  , 'user_token'      => USER_TOKEN
  , 'user_secret'     => USER_SECRET 
  ));
}

?>