<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 *
 * @property Request $Request
 */
class RequestsController extends AppController {

/**
 * index method
 *
 * @return void
 */
public function index() {
    $requests = $this->paginate();
    if ($this->request->is('requested')) {
        return $requests;
    } else {
        $this->set('requests', $requests);
    }
}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
    if ($this->request->is('requested')) {
        return $this->Request->read(null, $id);
    } else {		
			$this->set('request', $this->Request->read(null, $id));
		}
	}

/**
 * thread method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function thread($id = null) {
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		$this->set('request', $this->Request->read(null, $id));
		$this->set('id', $id);
	}	

/**
 * unsatisfiedByUser method
 */
	public function unsatisfiedByUser($userId = null) {
		if($userId == null) {
			throw new NotFoundException(__('Cannot find unsatisfied requests - no user ID specified'));
		}
		return $this->Request->find('all', array(
			'conditions' => array('Request.satisfied =' => '0', 'Request.user_id =' => $userId)
		));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Request->create();
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		}
		$users = $this->Request->User->find('list');
		$groups = $this->Request->Group->find('list');
		$tags = $this->Request->Tag->find('list');
		$this->set(compact('users', 'groups', 'tags'));
	}

/**
 * create method
 *
 * @return void
 */
	public function create() {
		if ($this->request->is('post')) {
			$this->Request->create();
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash('Thank you! Your request has been saved', 'default', array('class' => 'alert alert-success'));
			} else {
				$this->Session->setFlash('Please fill in all details', 'default', array('class' => 'alert alert-error'));
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
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Request->save($this->request->data)) {
				$this->Session->setFlash(__('The request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Request->read(null, $id);
		}
		$users = $this->Request->User->find('list');
		$groups = $this->Request->Group->find('list');
		$tags = $this->Request->Tag->find('list');
		$this->set(compact('users', 'groups', 'tags'));
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
		$this->Request->id = $id;
		if (!$this->Request->exists()) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->Request->delete()) {
			$this->Session->setFlash(__('Request deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Request was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function createFromAjax() {
		$this->layout = 'ajax';
		$this->Request->create();
		$this->set('arse',$this->request->data);
		//if ($this->Request->save($this->request->data)) {
		//	$this->set('result',$this->Request->find('id'));
		//} else {
		//	$this->set('result','error saving');
		//}
	}
}
