<?php
App::uses('BaseAuthorize', 'Controller/Component/Auth');

class TwitterAuthorize extends BaseAuthorize {
  public function authorize($user, CakeRequest $request) {
    // Get a request token from twitter
    App::import('Vendor', 'HttpSocketOauth');
    $Http = new HttpSocketOauth();

    //Change this to not use these static ips!
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

    $response = $Http->request($request);
    // Redirect user to twitter to authorize  my application
    parse_str($response, $response);
    $this->redirect('http://api.twitter.com/oauth/authorize?oauth_token=' . $response['oauth_token'])    ;
  }
}
?>
