<?php


    class PedidosController extends AppController {

        public $components = array('Session', 'RequestHandler', 'Flash');
        public $helpers = array('Html','Form','Time');

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
                $pedido = array( 'platillo_id' => $id, 'cantidad' => $cantidad, 'subtotal' => $subtotal);
                //guardamos nuestros datos del pedido con save
                $this->Pedido->save($pedido);   
                //vemos si el pedido existe para que no nos duplique el pedido
                //si el pedido es igual al pedido que nos manda desde Ajax
                $exite_pedido = $this->Pedido->find('all', array('fields' => ('Pedido.platillo_id'),
                    'condition' => array('Pedido.platillo_id' => $id)));
                
            }

            //no voy a usar ninguna vista asociada a esta accion
            $this->autoRender = false;
        }

        public function view(){

        }

    
    }


?>