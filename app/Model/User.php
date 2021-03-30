<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(
    'fullname' => array(
        'notBlank' => array(
            'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
        ),
    ),
    'username' => array(
        'notBlank' => array(
            'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
        ),
    ),
    'password' => array(
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
    //esto lo que hace es que todo el contenido del metodo, nos va a 
    //ejecutar antes de realizar alguna operacion de nuestro controlador
    //antes de pasar por el metodo save
    public function beforeSave($options = array())
    {
        //antes de que guarde nuestro usuario, encripte la contraseña del mismo
        //estamos enviando un objeto tipo password???
        if(isset($this->data[$this->alias]['password'])){

            $passwordHasher = new BlowfishPasswordHasher();

            //lo volcamos en el objeto $passwordHasher, con el metodo hash
            //que genera una contraseña encriptada antes de guardarse o usar un metodo del
            //controlador, esto lo que hace es encriptar nuestra contraseña
            $this->data[$this->alias]['password'] = $passwordHasher->hash( $this->data[$this->alias]['password']);
        }
        //si se ha encriptado correctamente lo mandamos a true
        return true;
        
    }
}
?>