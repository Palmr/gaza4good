<?php
App::uses('AppController', 'Controller');
/**
 * Offers Controller
 *
 * @property Offer $Offer
 */
class OffersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
    $offers = $this->paginate();
    if ($this->request->is('requested')) {
        return $offers;
    } else {
        $this->set('offers', $offers);
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
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
    if ($this->request->is('requested')) {
        return $this->Offer->read(null, $id);
    } else {		
			$this->set('offer', $this->Offer->read(null, $id));
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
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		$this->set('offer', $this->Offer->read(null, $id));
		$this->set('id', $id);
	}	

/**
 * unsatisfiedByUser method
 */
	public function unsatisfiedByUser($userId = null) {
		if($userId == null) {
			throw new NotFoundException(__('Cannot find unsatisfied offers - no user ID specified'));
		}
		return $this->Offer->find('all', array(
			'conditions' => array('Offer.satisfied =' => '0', 'Offer.user_id =' => $userId)
		));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Offer->create();
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
			}
		}
		$users = $this->Offer->User->find('list');
		$groups = $this->Offer->Group->find('list');
		$tags = $this->Offer->Tag->find('list');
		$this->set(compact('users', 'groups', 'tags'));
	}

/**
 * create method
 *
 * @return void
 */
	public function create() {
		if ($this->request->is('post')) {
			$this->Offer->create();
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash('Thank you! Your offer has been saved', 'default', array('class' => 'alert alert-success'));
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
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Offer->save($this->request->data)) {
				$this->Session->setFlash(__('The offer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Offer->read(null, $id);
		}
		$users = $this->Offer->User->find('list');
		$groups = $this->Offer->Group->find('list');
		$tags = $this->Offer->Tag->find('list');
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
		$this->Offer->id = $id;
		if (!$this->Offer->exists()) {
			throw new NotFoundException(__('Invalid offer'));
		}
		if ($this->Offer->delete()) {
			$this->Session->setFlash(__('Offer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
