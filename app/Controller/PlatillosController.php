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
		if(!empty($this->request->query['search'])){
		
			$search = $this->request->query['search'];			//comparo expresion regular con search
			$search = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $search);

			$terms = explode(' ', trim($search));
			$terms = array_diff($terms, array(''));

			foreach($terms as $term){				
				$terms1[] = preg_replace('/[^a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/', '', $term);
				$conditions[] = array('Platillo.nombre LIKE' => '%' . $term . '%');			
			}
			//resultado de busqueda
			$platillos = $this->Platillo->find('all', array('recursive' => -1, 
			'conditions' => $conditions, 'limit' => 200));
			//si encuentras solo 1 registro de nuestra busqueda de platillos
			if(count($platillos) == 1){
				//si nos devuelve un solo resultado nos devuelve el id del platillo seleccionado
				return $this->redirect(array('controller' => 'platillos', 'action' => 'view', 
				$platillos[0]['Platillo']['id']));
			}
			
				$terms1 = array_diff($terms1, array(''));
				$this->set(compact('platillos', 'terms1'));
			}
				//en el caso que no exista un termino de busqueda
				//mandamos en set el termino de busqueda definido arriba(funcion) que es set
				$this->set(compact('search'));

				//peticion Ajax que nos genera la vista de resultado de nuestro platillo
				if($this->request->is('ajax')){
					//bloqueamos nuestro layout
					$this->layout = false;
					//vamos a mandar con el metodo set la variable ajax con el valor de 1,
					//en el caso que mandemos esto con una funcion ajax
					$this->set('ajax', 1);
				}else{
					//en el caso que no fuese asi
					$this->set('ajax', 0);
				}
		}
}
