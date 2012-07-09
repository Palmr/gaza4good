<?php
if ($this->Session->read('Twitter') == null) {
?>
  <a href="/Users/login" title="Log in using Twitter"><img src="https://si0.twimg.com/images/dev/buttons/sign-in-with-twitter-d-sm.png"></a>
<?php
}
else {
?>
  <a href="/Users" title="Users page">@<?php echo h($this->Session->read('AuthUser')['User']['twitter_handle']); ?></a> | <a href="/Users/logout" title="Log out">logout</a>
<?php
}
?>
