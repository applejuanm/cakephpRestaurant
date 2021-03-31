<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    //vamos a agregar funcionalidades a los controladores que heredamos de esta superclase

    public $components = array(

        'Session',
        //Cuando te autentificas, entra dentro del index
        'Auth' => array(
            //a donde te va a redirigir una vez el usuario ha puesto sus credenciales
            'loginRedirect' => array(
                'controller' => 'platillos',
                'action' => 'index'
            ),
            //cuando el usuario salga del sistema, es decir se deslogue 
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            //que tipo de encriptacion estamos utilizando
            'authenticate' => array(
                //el formulario de login tiene el metodo de encriptacion 'Blowfish'
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            //la autorizacion de acceso la podemos hacer desde nuestro controlador, por ejemplo allow('add');
            //vamos a autorizar desde cada uno de nuestros controladores las acciones correspondientes a cada
            //usuario
            'authorize' => array('controller'),
            //los mensajes de error de autenticacion no se los muestre, cada vez que haga un error de acceso
            'authError' => false
        ),
    );
    //beforeFilter, esta funcion se encarga de filtrar antes de que el usuario ingrese sus 
    //credenciales,(nombre, usuario y contrasenya)
    public function beforeFilter(){
        //acciones que puede acceder sin autentificacion
        $this->Auth->allow('login', 'logout');
        //esta variable lo que nos va a mandar es los datos de autentificacion del usuario actual
        //es decir, nos va a mandar todos los datos, nombre rol fullname
        $this->set('current_user', $this->Auth->user());
    }

    //aqui vamos a manejar las acciones correspondientes que van a ser controladas dentro de nuestra
    //autentificacion de usuarios
    public function isAuthorized($user){
    
        //ejemplo si el usuario es admin o rol hace diferentes acciones

        //aqui le indicamos que a todas las acciones de todos nuestros controladores
        //tienen acceso a todas las acciones de la web 
        if(isset($user['role']) && $user['role'] == 'admin'){

            return true;
        }
         
            return false;
        
    }

}
