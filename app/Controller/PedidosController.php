<?php


    class PedidosController extends AppController {

        public $components = array('Session', 'RequestHandler', 'Flash');
        public $helpers = array('Html','Form','Time');

        public function isAuthorized($user){
		
            //si el usuario es user puede acceder al index y aniadir usuarios
            if($user['role'] == 'user'){
                //
                if(in_array($this->action, array('add', 'view', 'itemupdate', 'remove', 'remove', 'quitar', 'recalcular'))){
    
                    return true;
    
                }else{
    
                    if($this->Auth->user('id')){
    
                        $this->Flash->set('No puedes eliminar el platillo');
                        //si no se puede acceder que nos redirija a la url de nuestra aplicacion
                        $this->redirect($this->Auth->redirectUrl());
                    }
                }
            }
            //le damos los permisos al AppController
            return parent::isAuthorized($user);
        }

        public function add(){
            //si recibimos ayax
            if($this->request->is('ajax')) {

                //con esto recibimos los datos de la peticion ajax 'addtocart' para almacenarlo
                //tanto  el id como la variable cantidad
                $id = $this->request->data['id'];
                $cantidad = $this->request->data['cantidad'];

                //con esta consulta decimos que nos recupere el precio de la consulta que te estoy mandando
                //y ponlo en la variable platillo 
                $platillo = $this->Pedido->Platillo->find('all', array('fields' => array('Platillo.precio'), 
                'conditions' => array('Platillo.id' => $id)));
                

                //almacenamos el valor del precio de cada producto
                $precio = $platillo[0]['Platillo']['precio'];
                //cantidad es nuestra variable que hemos hecho con nuestra peticion de Ajax
                $subtotal = $cantidad * $precio;

                //nuestro array con nuestra cantidad y subtotal
                $pedido = array( 'platillo_id' => $id, 'cantidad' => $cantidad, 'subtotal' => $subtotal );
                //vemos si el pedido existe para que no nos duplique el pedido
                //si el pedido es igual al pedido que nos manda desde Ajax
                $existe_pedido = $this->Pedido->find( 'all', array('fields' => array('Pedido.platillo_id'), 'conditions' => array('Pedido.platillo_id' => $id)));
                
                if(count($existe_pedido) == 0){
                    //guardamos nuestros datos del pedido con save
                    $this->Pedido->save($pedido);  
                }
            }

            //cakephp nos obliga a crear una vista add, entonces como lo vamos a trabajar con jquery
            //y ajax entonces nos sale un error, es decir procesar los datos en esta misma vista
            $this->autoRender = false;
        }

        public function view(){

            //si no existe ningun pedido nos redirecciona a otro sitio

            $res_pedidos = $this->Pedido->find('all');

        
            if(count($res_pedidos) == 0){
               
                $this->Flash->set('aun no se ha realizado ningun pedido'); 
                

                return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
            }


            //aqui realizamos una consulta de todos los pedidos hechos
            $this->set('pedidos', $this->Pedido->find('all', array('order' => 'Pedido.id ASC')));

            //generamos el total de nuestros pedidos, con sum voy cogiendo los pedidos metiendolo en 'subtotal'
            $total_pedidos = $this->Pedido->find('all', array('fields' => array('SUM(Pedido.subtotal) as subtotal')));

            //abstraemor el valor de subtotal recorriendo el array
            $mostrar_total_pedidos = $total_pedidos[0][0]['subtotal'];

            //mandamos la variable

            $this->set('total_pedidos', $mostrar_total_pedidos);
            
        }

        public function itemupdate(){
           //si la peticion es de tipo ajax
           if($this->request->is('ajax')){
            //recuperamos nuestro id de la peticion
            $id = $this->request->data['id'];
            //si existe nuestro campo cantidad? y si no existe pues es null
            $cantidad = isset($this->request->data['cantidad']) ? $this->request->data['cantidad'] : null;

            if($cantidad == 0)
            {
                $cantidad = 1;
            }

            if($cantidad < 0)
            {
                $cantidad = -1*$cantidad;
            }
            //mandamos el id con el item del pedido mediante un array
             $item = $this->Pedido->find('all', array('fields' => array('Pedido.id', 'Platillo.precio'),
                'conditions' => array('Pedido.id' => $id)));

            //recorremos el arreglo y vamos a recuperar el precio
            $precio_item = $item[0]['Platillo']['precio'];

            //nos devuelve un subtotal de cantidad recogida en el ajax y el precio del producto recogido
            //con su id
            $subtotal_item = $cantidad * $precio_item;
    
            //recogemos los datos de forma dinamica en un arreglo
            $item_update = array('id' => $id, 'cantidad' => $cantidad, 'subtotal' => $subtotal_item);
            //guardamos todo el array correspondiente del id que le estamos mandando
            $this->Pedido->saveAll($item_update);

           }
           //recalculamos los cambios en total del carro
           $total = $this->Pedido->find('all', array('fields' => array('SUM(Pedido.subtotal) as subtotal')));
           //recorremos el array y lo almacenamos en el total
           $mostrar_total = $total[0][0]['subtotal'];
           //recorremos el pedido con el id correspondiente
           $pedido_update = $this->Pedido->find('all', array('fields' => array('Pedido.id', 'Pedido.subtotal'),
            'conditions' => array('Pedido.id' => $id)));

           //transformamos el array en JSON, recorriendolo por id con su subtotal calculado
           $mostrar_pedido = array('id' => $pedido_update[0]['Pedido']['id'], 
            'subtotal' => $pedido_update[0]['Pedido']['subtotal'], 'total' =>  $mostrar_total);

            //lo mandamos en un JSON
            echo json_encode(compact('mostrar_pedido'));

            //asi no nos exiga una vista desde nuestra accion
            $this->autoRender = false;
        }
        

        //funcion de borrar
        public function remove()
        {
            //es ajax?
            if($this->request->is('ajax'))
            {
                 //el id que le estoy mandando desde nuestro cart.js
                $id = $this->request->data['id'];
                $this->Pedido->delete($id);
            }
              //recorremos la parte subtotal del array meidante su id
            $total_remove = $this->Pedido->find('all', array('fields' => array('SUM(Pedido.subtotal) as subtotal')));

            //cogemos el subtotal
            $mostrar_total_remove = $total_remove[0][0]['subtotal'];

            //hacemos una consulta de todos los pedidos,
            //
            $pedidos = $this->Pedido->find('all');

            //si el total es igual a 0, que lo deje en 0.00 porque si no se queda en Null
            if(count($mostrar_total_remove) == 0){

                $mostrar_total_remove = "0.00";
            }
            
             //pasamos el subtotal a JSON para Ajax y mando la variable pedidos
             //para procesarlo en el cart.js en el ajax
            echo json_encode(compact('pedidos', 'mostrar_total_remove'));
            $this->autoRender = false;
        }

        //funcion de quitar todos los pedidos

        public function quitar(){
            //usamos el metodo de cakephp borra todo, primer parametro true,
            //2` parametro, depende otros modelos
            if($this->Pedido->deleteAll(1, false)){
                $this->Flash->success('Todos los pedidos han sido quitados');
            }else{
                $this->Flash->error('No se pudo quitar los pedidos');
            }

            return $this->redirect(array('controller' => 'Platillos', 'action' => 'index'));

        }
        public function recalcular()
        {
            // debug($_POST);
            
            $arreglo = $this->request->data['Pedido'];
            
            // debug($arreglo);
            
            if($this->request->is('post'))
            {
                foreach($arreglo as $key => $value)
                {
                    //que solo sea numerico entre 0 y 9
                    $entero = preg_replace("/[^0-9]/", "", $value);
                    
                    if($entero == 0 || $entero == "")
                    {
                        $entero = 1;
                    }
                    
                    $precio_update = $this->Pedido->find('all', array('fields' => array('Pedido.id', 'Platillo.precio'), 'conditions' => array('Pedido.id' => $key)));
                    
                    $precio_update_mostrar = $precio_update[0]['Platillo']['precio'];
                    
                    $subtotal_update = $entero * $precio_update_mostrar;
                    
                    $pedido_update = array('id' => $key, 'cantidad' => $entero, 'subtotal' => $subtotal_update);
                    $this->Pedido->saveAll($pedido_update);
                }
            }
            
              
            if($this->request->data['recalcular'] == 'recalcular')
            {
                $this->Flash->success('Todos los pedidos fueron actualizados correctamente', 'default', array('class' => 'alert alert-success'));
                        
                return $this->redirect(array('controller' => 'pedidos', 'action' => 'view'));            
            }
            elseif($this->request->data['procesar'] == 'procesar')
            {
                 return $this->redirect(array('controller' => 'ordens', 'action' => 'add'));  
            }
        }
        
    }
    ?>