    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Usuarios', array('controller' => 'users', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Usuario', array('controller' => 'users', 'action' => 'add')) ?></li>
              </ul>
            </li>


            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Camareros <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Camareros', array('controller' => 'camareros', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Camareros', array('controller' => 'camareros', 'action' => 'add')) ?></li>
              </ul>
            </li>


            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Platillos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Platillos', array('controller' => 'platillos', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nuevo Platillo', array('controller' => 'platillos', 'action' => 'add')) ?></li>
                <li><?php echo $this->Html->link('Buscar Platillo', array('controller' => 'platillos', 'action' => 'search')) ?></li>
                <li class="divider"></li>
                <li class="dropdown-header">Categorías</li>
                <li><?php echo $this->Html->link('Lista Categorías', array('controller' => 'categoria_platillos', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nueva Categoría', array('controller' => 'categoria_platillos', 'action' => 'add')) ?></li>                   
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mesas <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?php echo $this->Html->link('Lista Mesas', array('controller' => 'mesas', 'action' => 'index')) ?></li>
                <li><?php echo $this->Html->link('Nueva Mesa', array('controller' => 'mesas', 'action' => 'add')) ?></li>
           
              </ul>
            </li>

			<li><?php echo $this->Html->link('Lista de Ordenes', array('controller' => 'ordens', 'action' => 'index')); ?></li>
            
          </ul>

          <?php echo $this->Form->create('Platillo', array('type' => 'GET', 'class' => 'navbar-form 
            navbar-left', 'url' => array('controller' => 'platillos', 'action' => 'search'))); ?>
          <div class="from-group">
            <?php 
              echo $this->Form->input('search', array('label' => false, 'div' => false, 'id' => 's',
                'class' => 'form-control s', 'autocomplete' => 'off', 'placeholder' => 'buscar platillo...'));
            ?>
          
          <?php 
              echo $this->Form->button('Buscar', array('div' => false, 'class' => 'btn btn-primary'));
          ?>

          <?php echo $this->Form->end() ?>
          </div>
          <?php echo $this->Html->link('Pedidos', array('controller' => 'pedidos', 'action' => 'view'), array('class' => 'btn btn-success navbar-btn') ); ?>
            
          <ul class="nav navbar-nav navbar-right">
              <li>
                <?php echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout')); ?>
              </li>
            </ul>  
        </div><!--/.nav-collapse -->
      </div>
    </div>