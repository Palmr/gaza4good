<div class="users view">
<h2>User Info @<?php echo h($user['twitter_handle']); ?></h2>
	<dl>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter Handle'); ?></dt>
		<dd>
			<?php echo h($user['twitter_handle']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Twitter Uid'); ?></dt>
		<dd>
			<?php echo h($user['twitter_uid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($user['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($user['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['address']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
