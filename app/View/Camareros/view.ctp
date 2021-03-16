<div class="camareros view">
<h2><?php echo __('Camarero'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dni'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['dni']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellido'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['apellido']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($camarero['Camarero']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Camarero'), array('action' => 'edit', $camarero['Camarero']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Camarero'), array('action' => 'delete', $camarero['Camarero']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $camarero['Camarero']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Camareros'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camarero'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Mesas'); ?></h3>
	<?php if (!empty($camarero['Mesa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Serie'); ?></th>
		<th><?php echo __('Puestos'); ?></th>
		<th><?php echo __('Posicion'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Camarero Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camarero['Mesa'] as $mesa): ?>
		<tr>
			<td><?php echo $mesa['id']; ?></td>
			<td><?php echo $mesa['serie']; ?></td>
			<td><?php echo $mesa['puestos']; ?></td>
			<td><?php echo $mesa['posicion']; ?></td>
			<td><?php echo $mesa['created']; ?></td>
			<td><?php echo $mesa['modified']; ?></td>
			<td><?php echo $mesa['camarero_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mesas', 'action' => 'view', $mesa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mesas', 'action' => 'edit', $mesa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mesas', 'action' => 'delete', $mesa['id']), array('confirm' => __('Are you sure you want to delete # %s?', $mesa['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
