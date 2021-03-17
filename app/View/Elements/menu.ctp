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
	            <a class="navbar-brand" href="#">Restaurante</a>
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
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mesas <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
	                        <li><?php echo $this->Html->link('Lista Mesas', array('controller' => 'mesas',
                                'action' => 'index'));?></li>
	                         <li><?php echo $this->Html->link('Nueva Mesa', array('controller' => 'mesas',
                                'action' => 'add'));?></li>
	                    </ul>
	                </li>
					<li><a href="#about">About</a></li>
	                <li><a href="#contact">Contact</a></li>
	            </ul>
	        </div>
	        <!--/.nav-collapse -->
	    </div>
	</div>