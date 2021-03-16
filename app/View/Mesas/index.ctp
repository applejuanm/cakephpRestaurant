<div class="mesas index">
	<h2><?php echo __('Mesas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('serie'); ?></th>
			<th><?php echo $this->Paginator->sort('puestos'); ?></th>
			<th><?php echo $this->Paginator->sort('posicion'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('camarero_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($mesas as $mesa): ?>
	<tr>
		<td><?php echo h($mesa['Mesa']['id']); ?>&nbsp;</td>
		<td><?php echo h($mesa['Mesa']['serie']); ?>&nbsp;</td>
		<td><?php echo h($mesa['Mesa']['puestos']); ?>&nbsp;</td>
		<td><?php echo h($mesa['Mesa']['posicion']); ?>&nbsp;</td>
		<td><?php echo h($mesa['Mesa']['created']); ?>&nbsp;</td>
		<td><?php echo h($mesa['Mesa']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mesa['Camarero']['nombre'], array('controller' => 'camareros', 'action' => 'view', $mesa['Camarero']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mesa['Mesa']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mesa['Mesa']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mesa['Mesa']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mesa['Mesa']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Mesa'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Camareros'), array('controller' => 'camareros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camarero'), array('controller' => 'camareros', 'action' => 'add')); ?> </li>
	</ul>
</div>
