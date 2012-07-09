<div class="requestsTags view">
<h2><?php  echo __('Requests Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requestsTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $requestsTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Request'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requestsTag['Request']['title'], array('controller' => 'requests', 'action' => 'view', $requestsTag['Request']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($requestsTag['RequestsTag']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Requests Tag'), array('action' => 'edit', $requestsTag['RequestsTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Requests Tag'), array('action' => 'delete', $requestsTag['RequestsTag']['id']), null, __('Are you sure you want to delete # %s?', $requestsTag['RequestsTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requests Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
