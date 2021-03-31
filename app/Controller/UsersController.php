<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */

class UsersController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Flash');

    /**
     * index method
     *
     * @return void
     */

	//cada controlador va a tener su propio beforeFilter, lo deja entrar antes de que sea autentificado
	public function beforeFilter()
	{
		//llamamos a nuestro beforeFilter de nuestro AppController
		parent::beforeFilter();
		//nos deja ir a la accion 'add', accede sin ningun problema, sea que este autentificado o no lo esté.
	//	$this->Auth->allow('add');
		//lo comento porque ya manejo cada controlador con 'isAuthorized'
	}

 /*
	public function isAuthorized($user){
		
		//si el usuario es user puede acceder al index y aniadir usuarios
		if($user['role'] == 'user'){
			//
			if(in_array($this->action, array('index','add'))){

				return true;

			}else{

				if($this->Auth->user('id')){

					$this->Flash->set('No puedes acceder');
					//si no se puede acceder que nos redirija a la url de nuestra aplicacion
					$this->redirect($this->Auth->redirectUrl());
				}
			}
		}
		//le damos los permisos al AppController
		return parent::isAuthorized($user);
	}

	 */

	//accion de logearse
	public function login(){

		if($this->request->is('post')){
			//si esta accediendo al metodo login si es post
			if($this->Auth->login()){
				//retorna a una direccion url
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->set('Usuario y/o contraseña incorrectos', array('class' => 'alert alert-danger'));
		}
	}

	//accion de logOut
	public function logout(){
		//lo mandamos a logout, el componente definido en nuestro AppController.
		return $this->redirect($this->Auth->logout());
	}



    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}


    /**
 * add method
 *
 * @return void
 */
	//a partir de ahora los usuarios creados por defectos sean 'Úsers', no 'Admins'
	public function add() {
		//todo lo que mandamos desde nuestro fomulario
		if ($this->request->is('post')) {
			$this->User->create();
			//Insertamos que nuestro modelo por defecto sea user, manipulamos el Modelo 'User' y el campo 'Rol'
			//que sea de tipo user
			$this->request->data['User']['role'] = 'user';
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

    /**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}



?>