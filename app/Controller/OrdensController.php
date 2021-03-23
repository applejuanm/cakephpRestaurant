<?php

    class OrdensController extends AppController{

        public $components = array('Session', 'RequestHandler');
        public $helpers = array('Html', 'Form', 'Time', 'Js');
        
        public function add(){
            //que modelo necesitamos pedir para recuperar sus datos, con esto llamamos a nuestro modelo Pedido
            // sin necesidad de hacer ninguna relacion
            $this->loadModel('Pedido','RequestHandler');
            //consulta a pedido
            $orden_item = $this->Pedido->find('all', array('order' => 'Pedido.id ASC'));

           // debug($order_item);

           //existe algun registro en $order_item?
            if(count($orden_item) > 0){
                 //si tenemos algun pedido dentro de la variable $order_item
                 $total_pedidos = $this->Pedido->find('all', array('fields' => 
                 array('SUM(Pedido.subtotal) as subtotal')));
                //cogemos el subtotal
                $mostrar_total_pedidos = $total_pedidos[0][0]['subtotal'];

                //Recuperando mesas de restaurante
                $mesas = $this->Orden->Mesa->find('list');

                //lo mandamos a la vista, esto tenemos todos los datos para crear nuestra vista
                $this->set(compact('orden_item', 'mostrar_total_pedidos', 'mesas'));


            }else{  
               //si tenemos algun pedido
                $this->Flash->set('Ninguna orden ha sido procesada');
                return $this->redirect(array('controller' => 'platillos', 'action' => 'index'));
            }


        }
    }
    



?>