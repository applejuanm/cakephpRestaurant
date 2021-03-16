<div class="camareros index">
	<h2><?php echo __('Camareros'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('dni'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('apellido'); ?></th>
			<th><?php echo $this->Paginator->sort('telefono'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($camareros as $camarero): ?>
	<tr>
		<td><?php echo h($camarero['Camarero']['id']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['dni']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['apellido']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['telefono']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['created']); ?>&nbsp;</td>
		<td><?php echo h($camarero['Camarero']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $camarero['Camarero']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $camarero['Camarero']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $camarero['Camarero']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $camarero['Camarero']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Camarero'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
