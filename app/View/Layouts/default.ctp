<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>

	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('style.css' ,'bootstrap.min', 'bootstrap-theme.min','fileinput.min','jquery-ui.min'));
		echo $this->Html->script(array('jquery.min','docs.min','bootstrap.min','fileinput.min','jquery-ui.min','search'));
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script>
		$("#foto").fileinput();
		//indicamos la ruta base de nuestro proyecto
		var basePath = "<?php echo Router::url('/') ?>"
	</script>
</head>
<body>
	<!--Utilizamos un condicional si esta puesta la variable $current_user
		entonces si existe este usuario autentificado nos muestra el menu
		la variable $current_user tiene todos los datos del usuario(id,nombre,username,rol)-->
		<?php if(isset($current_user)): ?>
		<?php echo $this->element('menu'); ?>
		<?php endif; ?>
			
		<?php //debug($current_user) ?>	

		<div class="container" role="main">
		
			<!--Este metodo nos enseña los camareros y las mesas-->
			<?php echo $this->Flash->render(); ?>
			<!----Componentes de autentificacion-->
			<?php echo $this->Session->flash('auth'); ?>
			<!--Este metodo nos enseña todo el contenido-->
			<?php echo $this->fetch('content'); ?>

			<br>
			 	<div id="msg"></div>
			<br>

		</div>

	</div>
	
</body>
</html>
