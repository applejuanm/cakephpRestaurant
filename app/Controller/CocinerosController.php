<?php
App::uses('AppController', 'Controller');
/**
 * Cocineros Controller
 *
 * @property Cocinero $Cocinero
 * @property PaginatorComponent $Paginator
 */
class CocinerosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cocinero->recursive = 0;
		$this->set('cocineros', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cocinero->exists($id)) {
			throw new NotFoundException(__('Invalid cocinero'));
		}
		$options = array('conditions' => array('Cocinero.' . $this->Cocinero->primaryKey => $id));
		$this->set('cocinero', $this->Cocinero->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cocinero->create();
			if ($this->Cocinero->save($this->request->data)) {
				$this->Flash->success('The cocinero has been saved.','default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The cocinero could not be saved. Please, try again.'));
			}
		}
		$platillos = $this->Cocinero->Platillo->find('list');
		$this->set(compact('platillos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cocinero->exists($id)) {
			throw new NotFoundException(__('Invalid cocinero'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cocinero->save($this->request->data)) {
				$this->Flash->success(__('The cocinero has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The cocinero could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cocinero.' . $this->Cocinero->primaryKey => $id));
			$this->request->data = $this->Cocinero->find('first', $options);
		}
		$platillos = $this->Cocinero->Platillo->find('list');
		$this->set(compact('platillos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cocinero->id = $id;
		if (!$this->Cocinero->exists()) {
			throw new NotFoundException(__('Invalid cocinero'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cocinero->delete()) {
			$this->Flash->success(__('The cocinero has been deleted.'));
		} else {
			$this->Flash->error(__('The cocinero could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
