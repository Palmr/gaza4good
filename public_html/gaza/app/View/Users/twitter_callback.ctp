<?php
  $twitterResponse = $this->Session->read('Twitter');
  if (isset($twitterResponse['user_id'])) {
?>
  <div class="alert alert-success">
    Hey @<?php echo $this->Session->read('AuthUser')['User']['twitter_handle'];?>, your login was successful
  </div>
<?php
 }
 else {
?>
  <div class="alert alert-error">
    Login failed, go back and try again
  </div>
<?php
  }
?>
