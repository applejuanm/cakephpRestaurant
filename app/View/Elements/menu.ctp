	<!--Codigo Bootstrap--->
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>

	           <?php echo $this->Html->link('Restaurante', array('controller' => 'pages',
			   		'action' => 'home'), array('class' => 'navbar-brand')) ?>

	        </div>
	        <div class="navbar-collapse collapse">
	            <ul class="nav navbar-nav">
	
                    <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Camareros 
                        <span class="caret"></span></a>
	                    <ul class="dropdown-menu" role="menu">
	                        <li><?php echo $this->Html->link('Lista Camareros', array('controller' => 'camareros',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nuevo Camarero', array('controller' => 'camareros',
                                'action' => 'add'));?></li>
	                    </ul>
	                </li>



					<li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cocineros <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
	                        <li><?php echo $this->Html->link('Lista Cocineros', array('controller' => 'cocineros',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nuevo Cocinero', array('controller' => 'cocineros',
                                'action' => 'add'));?></li>
	                    </ul>
	                </li>


					<li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Platillos <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
	                        <li><?php echo $this->Html->link('Lista Platillos', array('controller' => 'platillos',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nuevo Platillos', array('controller' => 'platillos',
                                'action' => 'add'));?></li>
								<li class="divider"></li>
								<li class="dropdown-header" role="menu">Categorias </li>
									<li><?php echo $this->Html->link('Lista Categorias', array('controller' => 'categoria_platillos',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nueva Categoria', array('controller' => 'categoria_platillos',
                                'action' => 'add'));?></li>
	                    </li>
	                </li>

	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mesas <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
	                        <li><?php echo $this->Html->link('Lista Mesas', array('controller' => 'mesas',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nueva Mesa', array('controller' => 'mesas',
                                'action' => 'add'));?></li>
								
							
	                    </ul>
	                </li>
					
	            </ul>
				<li style="position: right; top: 8px;">
				<div><?php echo $this->Html->link('Pedidos', array('controller' => 'pedidos', 'action' => 'view'),
				 array('class' => 'btn btn-success navbar-sm-btn')); ?> </div>
				 </li>
				
	        </div>
	        <!--/.nav-collapse -->
	    </div>
	</div>