<div class="requestsTags form">
<?php echo $this->Form->create('RequestsTag'); ?>
	<fieldset>
		<legend><?php echo __('Edit Requests Tag'); ?></legend>
	<?php
		echo $this->Form->input('tag_id');
		echo $this->Form->input('request_id');
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RequestsTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RequestsTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requests Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requests'), array('controller' => 'requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Request'), array('controller' => 'requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
