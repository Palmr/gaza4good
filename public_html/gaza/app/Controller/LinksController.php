<?php
App::uses('AppController', 'Controller');
/**
 * Links Controller
 *
 * @property Link $Link
 */
class LinksController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Link->recursive = 0;
		$this->set('links', $this->paginate());
	}

/**
 * forRequest method
 * @return array
 */
	public function forRequest($id = null) {
		if($id == null) {
			throw new NotFoundException(__('No request id given'));
		}
		$offers = $this->Link->findAllByRequestId($id);

		if($offers != null) {
			for($i=0; $i < count($offers); $i++) {
				$offers[$i]['User'] = $this->requestAction('Users/view/'.$offers[$i]['Offer']['user_id'])['User'];
			}
		}

		return $offers;
	}

/**
 * forOffer method
 * @return array
 */
	public function forOffer($id = null) {
		if($id == null) {
			throw new NotFoundException(__('No offer id given'));
		}
		$requests = $this->Link->findAllByOfferId($id);

		if($requests != null) {
			for($i=0; $i < count($requests); $i++) {
				$requests[$i]['User'] = $this->requestAction('Users/view/'.$requests[$i]['Request']['user_id'])['User'];
			}
		}

		return $requests;
	}	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->set('link', $this->Link->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Link->create();
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The link has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'));
			}
		}
		$users = $this->Link->User->find('list');
		$offers = $this->Link->Offer->find('list');
		$requests = $this->Link->Request->find('list');
		$this->set(compact('users', 'offers', 'requests'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The link has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Link->read(null, $id);
		}
		$users = $this->Link->User->find('list');
		$offers = $this->Link->Offer->find('list');
		$requests = $this->Link->Request->find('list');
		$this->set(compact('users', 'offers', 'requests'));
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
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->Link->delete()) {
			$this->Session->setFlash(__('Link deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Link was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
