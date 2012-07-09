<div class="links form">
<?php echo $this->Form->create('Link'); ?>
	<fieldset>
		<legend><?php echo __('Add Link'); ?></legend>
	<?php
		echo $this->Form->input('offer_id');
		echo $this->Form->input('request_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
