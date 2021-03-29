<?php
App::uses('AppController', 'Controller');
/**
 * Platillos Controller
 *
 * @property Platillo $Platillo
 * @property PaginatorComponent $Paginator
 */
class PlatillosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session','Flash', 'RequestHandler');
	//usamos helpers para importar etiquetas helpers
  	//son ayudantes para hacer formularios,Javascript
 	 //Time es para formatos de fechas
    public $helpers = array('Html', 'Form', 'Time', 'Js');

	public $paginate = array(
		'limit' => 3,
		'order' => array(
			'Platillo.id' => 'asc'
		)
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Platillo->recursive = 0;
		$this->paginate['Platillo']['limit'] = 1;
		$this->paginate['Platillo']['order'] = array('Platillo.id' => 'asc');
		$this->set('platillos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Platillo->exists($id)) {
			throw new NotFoundException(__('Invalid platillo'));
		}
		$options = array('conditions' => array('Platillo.' . $this->Platillo->primaryKey => $id));
		$this->set('platillo', $this->Platillo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Platillo->create();
			if ($this->Platillo->save($this->request->data)) {
				$this->Flash->success('El camarero ha sido modificado');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The platillo could not be saved. Please, try again.'));
			}
		}
		$categoriaPlatillos = $this->Platillo->CategoriaPlatillo->find('list');
		$cocineros = $this->Platillo->Cocinero->find('list');
		$this->set(compact('categoriaPlatillos', 'cocineros'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Platillo->exists($id)) {
			throw new NotFoundException(__('Invalid platillo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Platillo->save($this->request->data)) {
				$this->Flash->success(__('The platillo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The platillo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Platillo.' . $this->Platillo->primaryKey => $id));
			$this->request->data = $this->Platillo->find('first', $options);
		}
		$categoriaPlatillos = $this->Platillo->CategoriaPlatillo->find('list');
		$cocineros = $this->Platillo->Cocinero->find('list');
		$this->set(compact('categoriaPlatillos', 'cocineros'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Platillo->id = $id;
		if (!$this->Platillo->exists()) {
			throw new NotFoundException(__('Invalid platillo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Platillo->delete()) {
			$this->Flash->success(__('The platillo has been deleted.'));
		} else {
			$this->Flash->error(__('The platillo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	//funcion que cogems del search.js
	public function searchjson(){

		$term = null;
		//cogemos la peticion term de search.js
		if(!empty($this->request->query['term'])){

			$term = $this->request->query['term'];
			//este metodo de phpm lo que hace es coger nuestro termino de busqueda y 
			//lo que hace es dividir nuestro termino en strings, es decir en cadenas
			$terms = explode(' ', trim($term));
			//lo asemejamos a un array vacio
			$terms = array_diff($terms, array(''));
			//realiza la busqueda de los terminos que realiza cada busqueda
			foreach($terms as $term){
				$conditions[] = array('Platillo.nombre LIKE' => '%' . $term . '%');
			}
			//recorre los platillos
			$platillos = $this->Platillo->find('all', array('recursive' => -1, 'fields' => 
			array('Platillo.id', 'Platillo.nombre', 'Platillo.foto', 'Platillo.foto_dir'), 
			'conditions' => $conditions, 'limit' => 20));

		}

		echo json_encode($platillos);
		$this->autoRender = false;
	}

	public function search(){

		$search = null;
		
	}
}
