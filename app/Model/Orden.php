<?php


    class Orden extends AppModel {

        
	public $belongsTo = array(
		'Camarero' => array(
			'className' => 'Camarero',
			'foreignKey' => 'camarero_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
    }
    

?>