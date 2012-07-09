<?php
App::uses('AppController', 'Controller');
/**
 * RequestsTags Controller
 *
 * @property RequestsTag $RequestsTag
 */
class RequestsTagsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RequestsTag->recursive = 1;
		$this->set('requestsTags', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->RequestsTag->id = $id;
		if (!$this->RequestsTag->exists()) {
			throw new NotFoundException(__('Invalid requests tag'));
		}
		$this->set('requestsTag', $this->RequestsTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RequestsTag->create();
			if ($this->RequestsTag->save($this->request->data)) {
				$this->Session->setFlash(__('The requests tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requests tag could not be saved. Please, try again.'));
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
		$this->RequestsTag->id = $id;
		if (!$this->RequestsTag->exists()) {
			throw new NotFoundException(__('Invalid requests tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequestsTag->save($this->request->data)) {
				$this->Session->setFlash(__('The requests tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requests tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->RequestsTag->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->RequestsTag->id = $id;
		if (!$this->RequestsTag->exists()) {
			throw new NotFoundException(__('Invalid requests tag'));
		}
		if ($this->RequestsTag->delete()) {
			$this->Session->setFlash(__('Requests tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requests tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
