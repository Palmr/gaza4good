<?php
require 'config.php';

/**
 * Simply returns a MySQL connection using the config from config.php
 * to save the hassle of passing the parameters in from the caller.
 * @return reference to the connection
 */
function getConnection() {
  $con = mysql_connect('localhost', DB_USERNAME, DB_PASSWORD);
  mysql_select_db(DB_DATABASE_NAME);
  return $con;
}

/**
 * Bootstraps a user account from the provided twitter unique id 
 * and twitter handle.
 * @param twitter_handle the twitter username 
 * @param twitter_uid the twitter unique internal identifier
 * @return internal id for the user in our database
 */
function getOrCreateUserFromTwitterHandle($twitter_handle, $twitter_uid) {
  // Sanitise inputs
  $twitter_handle = mysql_real_escape_string($twitter_handle);
  $twitter_uid = mysql_real_escape_string($twitter_uid);
  
  // Check to see if we have a user with this twitter uid
  $user_id = null;
  $result = mysql_query("SELECT id FROM users WHERE twitter_uid = $twitter_uid");

  if ($result && mysql_num_rows($result) == 0) {
    $result = mysql_query("INSERT INTO users (created, modified, twitter_handle, twitter_uid)
                           VALUES (SYSDATE(), SYSDATE(), '$twitter_handle', '$twitter_uid');");
                           
    if (!$result) {
      die('Could not insert user account' . mysql_error());
    }
    
    // Pull back the user id
    $user_id = mysql_insert_id();
  }
  else if ($result && mysql_num_rows($result) == 1) {
    $row = mysql_fetch_array($result);
    $user_id = $row['id'];
  }
  else {
    die('Failed to query user account' . mysql_error());
  }
  return $user_id;
}

/**
 * Inserts an offer record and associated tags.
 * @param user_id the internal user id creating the record
 * @param requirement the offer string
 * @param an array of dereferenced hashtags (array of strings)
 * @param coordinate_str the location data as a string, lon,lat as per twitter API
 * @return internal id of offer
 */
function insertOffer($user_id, $requirement, $hashtags, $coordinate_str) {
  // Sanitise inputs
  $requirement = mysql_real_escape_string($requirement);
  $coordinate_str = mysql_real_escape_string($coordinate_str);

  $result = mysql_query("INSERT INTO offers (user_id, title, details, location, created, satisfied, archived)
                         VALUES ($user_id, '$requirement', '', '$coordinate_str', SYSDATE(), 0, 0);");
                           
  if (!$result) {
    die('Could not insert offer: ' . mysql_error());
  }
  $offer_id = mysql_insert_id();
  
  // Process hashtags
  for ($i = 0; $i < count($hashtags); $i++) {
    $tag_id = getOrCreateTag($hashtags[$i]);
    $result = mysql_query("INSERT INTO offers_tags (offer_id, tag_id)
                           VALUES ($offer_id, $tag_id)");
    if (!$result) {
      die('Failed to insert offer_tag' . mysql_error());
    }
  }
  return $offer_id;
}

/**
 * Inserts an request record and associated tags.
 * @param user_id the internal user id creating the record
 * @param requirement the request string
 * @param an array of dereferenced hashtags (array of strings)
 * @param coordinate_str the location data as a string, lon,lat as per twitter API
 * @return internal id of request
 */
function insertRequest($user_id, $requirement, $hashtags, $coordinate_str) {
  // Sanitise inputs
  $requirement = mysql_real_escape_string($requirement);
  $coordinate_str = mysql_real_escape_string($coordinate_str);

  $result = mysql_query("INSERT INTO requests (user_id, title, details, location, created, satisfied, archived)
                         VALUES ($user_id, '$requirement', '', '$coordinate_str', SYSDATE(), 0, 0)");
                           
  if (!$result) {
    die('Could not insert request' . mysql_error());
  }
  $request_id = mysql_insert_id();
  
  // Process hashtags
  for ($i = 0; $i < count($hashtags); $i++) {
    $tag_id = getOrCreateTag($hashtags[$i]);
    $result = mysql_query("INSERT INTO requests_tags (request_id, tag_id)
                           VALUES ($request_id, $tag_id)");
    if (!$result) {
      die('Failed to insert request_tag' . mysql_error());
    }
  }
  return $request_id;
}

/**
 * Bootstrap a tag (get or create).
 * @param tag_str the tag as a string
 * @return the internal id of the tag
 */
function getOrCreateTag($tag_str) {
  // Sanitise inputs
  $tag_str = mysql_real_escape_string($tag_str);
  $result = mysql_query("SELECT id FROM tags WHERE name = '$tag_str'");
  $tag_id = null;

  if ($result && mysql_num_rows($result) == 0) {
    $result = mysql_query("INSERT INTO tags (name)
                           VALUES ('$tag_str');");
                           
    if (!$result) {
      die('Could not insert tag' . mysql_error());
    }
    
    // Pull back the user id
    $tag_id = mysql_insert_id();
  }
  else if ($result && mysql_num_rows($result) == 1) {
    $row = mysql_fetch_array($result);
    $tag_id = $row['id'];
  }
  else {
    die('Failed to query tag' . mysql_error());
  }
  return $tag_id;
}

?>
