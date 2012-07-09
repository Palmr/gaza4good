<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
//    $this->Auth->allow('edit', 'logout');
  }

  public function logout() {
    $this->Session->delete('Twitter');
    $this->Session->delete('AuthUser');
  }

//@palmer - Horrible hacks here to get this plugin working with cake 2.x
//          Also a hard coded IP due to host ipv6 issues
//          Should split out the oauth keys to external config too
  public function login() {
    // Get a request token from twitter
    App::import('Vendor', 'HttpSocketOauth');
    $Http = new HttpSocketOauth();
    $request = array(
      'uri' => array(
        'scheme' => 'https',
        'host' => '199.59.148.20',
        'path' => '/oauth/request_token',
      ),
      'method' => 'GET',
      'auth' => array(
        'method' => 'OAuth',
        'oauth_callback' => 'http://www.gaza4good.org.uk/Users/twitter_callback',
        'oauth_consumer_key' => '--Get from twitter api--',
        'oauth_consumer_secret' => '--Get from twitter api--',
      ),
    );
    $response = $Http->request($request);
    // Redirect user to twitter to authorize  my application
    parse_str($response, $response);
    $this->redirect('http://api.twitter.com/oauth/authorize?oauth_token=' . $response['oauth_token']);
  }

  public function twitter_callback() {
    App::import('Vendor', 'HttpSocketOauth');
    if (isset($this->params['url']['oauth_verifier'])) {
      $Http = new HttpSocketOauth();
      // Issue request for access token
      $request = array(
        'uri' => array(
          'host' => '199.59.148.20',
          'path' => '/oauth/access_token',
        ),
        'method' => 'POST',
        'auth' => array(
          'method' => 'OAuth',
          'oauth_consumer_key' => '--Get from twitter api--',
          'oauth_consumer_secret' => '--Get from twitter api--',
          'oauth_token' => $this->params['url']['oauth_token'],
          'oauth_verifier' => $this->params['url']['oauth_verifier'],
        ),
      );
      $response = $Http->request($request);
      parse_str($response, $response);
      // Save data in $response to database or session as it contains the access token and access token secret that you'll need later to interact with the twitter API
      $this->Session->write('Twitter', $response);
      $userRow = $this->User->findByTwitterUid($response['user_id']);
      $this->Session->write('AuthUser', $userRow);
      $this->set('user', $userRow);
    }
    else {
      $this->Session->delete('Twitter');
      $this->Session->delete('AuthUser');
    }
  }


/**
 * index method
 *
 * @return void
 */
  public function index() {
		$this->User->id = $this->Session->read('AuthUser')['User']['id'];
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
    $this->set('user', $this->Session->read('AuthUser')['User']);
	}

/**
 * add method
 *
 * @return void
 */
	/*public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
	/*public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}*/
}
