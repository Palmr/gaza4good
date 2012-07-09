<div class="offersTags form">
<?php echo $this->Form->create('OffersTag'); ?>
	<fieldset>
		<legend><?php echo __('Edit Offers Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tag_id');
		echo $this->Form->input('offer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OffersTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OffersTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Offers Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add')); ?> </li>
	</ul>
</div>
