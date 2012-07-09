<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/*  public $components = array(
    'Session',
    'Auth' => array(
      'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
      'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
     )
   );

public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }

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
         'oauth_callback' => 'http://10.246.36.29/Oauth/twitter_callback',
         'oauth_consumer_key' => 'HYz4uRi1tpAPZwAOAtktA',
         'oauth_consumer_secret' => 'VrSiHOI3DTWoWSp1WBz8RJ3AHiF8UtFfuXxZcbDUY',
       ),
     );
     #$this->Session->setFlash('Url Builder: ' . $Http->url($request['uri'], '%scheme://%host/%path'))    ;
     $response = $Http->request($request);
     // Redirect user to twitter to authorize  my application
     parse_str($response, $response);
     $this->redirect('http://api.twitter.com/oauth/authorize?oauth_token=' . $response['oauth_token'])    ;
   }

*/
}
