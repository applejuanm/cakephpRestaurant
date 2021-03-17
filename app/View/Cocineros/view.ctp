<div class="cocineros view">
<h2><?php echo __('Cocinero'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cocinero['Cocinero']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($cocinero['Cocinero']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellido'); ?></dt>
		<dd>
			<?php echo h($cocinero['Cocinero']['apellido']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cocinero['Cocinero']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cocinero['Cocinero']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cocinero'), array('action' => 'edit', $cocinero['Cocinero']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cocinero'), array('action' => 'delete', $cocinero['Cocinero']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $cocinero['Cocinero']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Cocineros'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cocinero'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Platillos'), array('controller' => 'platillos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Platillo'), array('controller' => 'platillos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Platillos'); ?></h3>
	<?php if (!empty($cocinero['Platillo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Descripcion'); ?></th>
		<th><?php echo __('Precio'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Categoria Platillo Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cocinero['Platillo'] as $platillo): ?>
		<tr>
			<td><?php echo $platillo['id']; ?></td>
			<td><?php echo $platillo['nombre']; ?></td>
			<td><?php echo $platillo['descripcion']; ?></td>
			<td><?php echo $platillo['precio']; ?></td>
			<td><?php echo $platillo['created']; ?></td>
			<td><?php echo $platillo['modified']; ?></td>
			<td><?php echo $platillo['categoria_platillo_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'platillos', 'action' => 'view', $platillo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'platillos', 'action' => 'edit', $platillo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'platillos', 'action' => 'delete', $platillo['id']), array('confirm' => __('Are you sure you want to delete # %s?', $platillo['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Platillo'), array('controller' => 'platillos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
