<?php
App::uses('AppController', 'Controller');
/**
 * Camareros Controller
 *
 * @property Camarero $Camarero
 * @property PaginatorComponent $Paginator
 */
class CamarerosController extends AppController {

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
		$this->Camarero->recursive = 0;
		$this->set('camareros', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Camarero->exists($id)) {
			throw new NotFoundException(__('Invalid camarero'));
		}
		$options = array('conditions' => array('Camarero.' . $this->Camarero->primaryKey => $id));
		$this->set('camarero', $this->Camarero->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Camarero->create();
			if ($this->Camarero->save($this->request->data)) {
				$this->Flash->success(__('The camarero has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The camarero could not be saved. Please, try again.'));
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
		if (!$this->Camarero->exists($id)) {
			throw new NotFoundException(__('Invalid camarero'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Camarero->save($this->request->data)) {
				$this->Flash->success(__('The camarero has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The camarero could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Camarero.' . $this->Camarero->primaryKey => $id));
			$this->request->data = $this->Camarero->find('first', $options);
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
		$this->Camarero->id = $id;
		if (!$this->Camarero->exists()) {
			throw new NotFoundException(__('Invalid camarero'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Camarero->delete()) {
			$this->Flash->success(__('The camarero has been deleted.'));
		} else {
			$this->Flash->error(__('The camarero could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
