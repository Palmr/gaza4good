<div class="offersTags view">
<h2><?php  echo __('Offers Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($offersTag['OffersTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($offersTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $offersTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Offer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($offersTag['Offer']['title'], array('controller' => 'offers', 'action' => 'view', $offersTag['Offer']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Offers Tag'), array('action' => 'edit', $offersTag['OffersTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Offers Tag'), array('action' => 'delete', $offersTag['OffersTag']['id']), null, __('Are you sure you want to delete # %s?', $offersTag['OffersTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Offers Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offers Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Offers'), array('controller' => 'offers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Offer'), array('controller' => 'offers', 'action' => 'add')); ?> </li>
	</ul>
</div>
