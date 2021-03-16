<div class="mesas form">
<?php echo $this->Form->create('Mesa'); ?>
	<fieldset>
		<legend><?php echo __('Add Mesa'); ?></legend>
	<?php
		echo $this->Form->input('serie');
		echo $this->Form->input('puestos');
		echo $this->Form->input('posicion');
		echo $this->Form->input('camarero_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mesas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Camareros'), array('controller' => 'camareros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camarero'), array('controller' => 'camareros', 'action' => 'add')); ?> </li>
	</ul>
</div>
