<?php

	$this->Paginator->options(array(
			'update' => '#contenedor-camareros',
			'before' => $this->Js->get('#procesando')->effect('fadeIn', array('buffer'=> false)),
			'complete' => $this->Js->get('#procesando')->effect('fadeOut', array('buffer' => false))
	));

?>

<div id="contenedor-camareros">

<div class="page-header">

	<h2><?php echo __('Camareros'); ?></h2>

  </div>
		<div class="col-md-12">

	<div class="progress oculto" id="procesando">
	  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	    <span class="sr-only">100% Complete</span>
	  </div>
	</div>


		<table class="table table-striped">
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
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $camarero['Camarero']['id']),
					array('class' => 'btn btn-sm btn-info')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $camarero['Camarero']['id']),
				array('class' => 'btn btn-sm btn-default')); ?>
			<button class ='btn btn-sm btn-danger'>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $camarero['Camarero']
                ['id']), array('confirm' => 'Quieres eliminar a ' . $camarero['Camarero']['nombre'] . ' ?')); ?></button>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	</div>

	<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<ul class="pagination">
			<li> <?php echo $this->Paginator->prev('< ' . __('previous'), array('tag' => false), null, array('class' => 'prev disabled')); ?> </li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<li> <?php echo $this->Paginator->next(__('next') . ' >', array('tag' => false), null, array('class' => 'next disabled')); ?> </li>
		</ul>
	<?php echo $this->Js->writeBuffer(); ?>
</div> <!-- contenedor-meseros -->