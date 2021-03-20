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
		'foto' => array(
            'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'Algo anda mal, intente nuevamente',
				'on' => 'create'
			),
	        'isUnderPhpSizeLimit' => array(
	    		'rule' => 'isUnderPhpSizeLimit',
	        	'message' => 'Archivo excede el límite de tamaño de archivo de subida'
	        ),
		    'isValidMimeType' => array(
	    		'rule' => array('isValidMimeType', array('image/jpeg', 'image/png'), false),
        		'message' => 'La imagen no es jpg ni png',
	    	),
		    'isBelowMaxSize' => array(
	    		'rule' => array('isBelowMaxSize', 1048576),
        		'message' => 'El tamaño de imagen es demasiado grande'
	    	),
		    'isValidExtension' => array(
	    		'rule' => array('isValidExtension', array('jpg', 'png'), false),
        		'message' => 'La imagen no tiene la extension jpg o png'
	    	),
		    'checkUniqueName' => array(
                'rule' => array('checkUniqueName'),
                'message' => 'La imagen ya se encuentra registrada',
                'on' => 'update'
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


	public $hasMany = array(
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'platillo_id',
			'dependent' => false
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

	//verificar si la imagen ya esta dentro del servidor, sirve para eliminar la anterior foto y poner
	//la de entrada, nos va a recibir un data
	function checkUniqueName($data)
	{
		//consulta que busca el primer registro de nuestro primer campo foto, el campo foto tiene que ser igual
		//al campo foto que yo estoy subiendo en este momento
	     $isUnique = $this->find('first', array('fields' => array('Platillo.foto'), 'conditions' => array('Platillo.foto' => $data['foto'])));
		//si no esta vacio me rotorna falso
	    if(!empty($isUnique))
	    {
	        return false;
	    }
	    else
	    {	//si activa la validacion si hay una foto
	        return true;
	    }
	}

}


