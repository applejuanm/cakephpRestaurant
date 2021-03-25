<?php

class Orden extends AppModel {
    
	public $validate = array(
		'cliente' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Ingrese nombre de cliente',
			),
		),
		'dni' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Ingrese DNI de cliente',
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Solo números',
			),
		)
	);    
    
	public $belongsTo = array(
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'mesa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	); 
	
	public $hasMany = array(
		'OrdenItem' => array(
			'className' => 'OrdenItem',
			'foreignKey' => 'orden_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);	
	
    
}

?>