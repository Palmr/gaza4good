<?php
App::uses('AppController', 'Controller');
/**
 * OffersTags Controller
 *
 * @property OffersTag $OffersTag
 */
class OffersTagsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OffersTag->recursive = 1;
		$this->set('offersTags', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->OffersTag->id = $id;
		if (!$this->OffersTag->exists()) {
			throw new NotFoundException(__('Invalid offers tag'));
		}
		$this->set('offersTag', $this->OffersTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OffersTag->create();
			if ($this->OffersTag->save($this->request->data)) {
				$this->Session->setFlash(__('The offers tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offers tag could not be saved. Please, try again.'));
			}
		}
		$tags = $this->OffersTag->Tag->find('list');
		$offers = $this->OffersTag->Offer->find('list');
		$this->set(compact('tags', 'offers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->OffersTag->id = $id;
		if (!$this->OffersTag->exists()) {
			throw new NotFoundException(__('Invalid offers tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OffersTag->save($this->request->data)) {
				$this->Session->setFlash(__('The offers tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offers tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->OffersTag->read(null, $id);
		}
		$tags = $this->OffersTag->Tag->find('list');
		$offers = $this->OffersTag->Offer->find('list');
		$this->set(compact('tags', 'offers'));
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
		$this->OffersTag->id = $id;
		if (!$this->OffersTag->exists()) {
			throw new NotFoundException(__('Invalid offers tag'));
		}
		if ($this->OffersTag->delete()) {
			$this->Session->setFlash(__('Offers tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offers tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
