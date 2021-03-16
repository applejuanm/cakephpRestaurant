<div class="camareros form">
<?php echo $this->Form->create('Camarero'); ?>
	<fieldset>
		<legend><?php echo __('Edit Camarero'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('dni');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('telefono');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Camarero.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Camarero.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Camareros'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
