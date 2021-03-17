<?php
App::uses('AppModel', 'Model');
/**
 * Platillo Model
 *
 * @property CategoriaPlatillo $CategoriaPlatillo
 * @property Cocinero $Cocinero
 */
class Platillo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';

	//palabra reservada para obtener la configuracion del plugin upload
	//donde almacenamos las fotos,direccion de fotos, tipo de plugin y
	//subir foto e eliminar la que habia antes
	public $actsAs = array(
		'Upload.Upload' => array(
			'foto' => array(
				'fields' => array(
					'dir' => 'foto_dir'
				),
				'thumbnailMethod' => 'php',
				'thumbnailSizes' => array(
					'vga' => '640x480',
					'thumb' => '150x150'
				),
				'deleteOnUpdate' => true,
				'deleteFolderOnDelete' => true 
			)
		)
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nombre' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'descripcion' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'precio' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'categoria_platillo_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'CategoriaPlatillo' => array(
			'className' => 'CategoriaPlatillo',
			'foreignKey' => 'categoria_platillo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Cocinero' => array(
			'className' => 'Cocinero',
			'joinTable' => 'cocineros_platillos',
			'foreignKey' => 'platillo_id',
			'associationForeignKey' => 'cocinero_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
