<?php App::import('vendor', 'markdown'); ?>
<?php if($rootMessage): ?>
  <div class="root-message message">
<?php else: ?>
  <li class="message">
<?php endif; ?>
  <img src="https://api.twitter.com/1/users/profile_image?screen_name=<?php echo ($user['twitter_handle']); ?>&amp;size=bigger" alt="" />
  <div class="message-text">
    <?php if($rootMessage): ?>
      <h2>
    <?php else: ?>
      <h3>
    <?php endif; ?>
      <a href="https://twitter.com/<?php echo ($user['twitter_handle']); ?>">@<?php echo ($user['twitter_handle']); ?></a>
      <?php
            echo ($type == 'Request') ? 'needs "'.h($message['title']).'"' : 'has "'.h($message['title']).'"'; 
      ?>
    <?php if($rootMessage): ?>
      </h2>
    <?php else: ?>
      </h3>
    <?php endif; ?>
    <?php if ($showDetails): ?>
      <p>
        <?php echo Markdown(strval(h($message['details']))); ?>
      </p>
    <?php endif; ?>
  </div>
  <?php if($viewLink): ?>
    <div class="view-message-page"><a href="/<?php echo ($type == 'Request') ? 'Requests' : 'Offers';  ?>/thread/<?php echo ($message['id']);?>">View</a></div>
  <?php endif; ?>
  <div class="clear"></div>
<?php if($rootMessage): ?>
  </div>
<?php else: ?>
  </li>
<?php endif; ?>
