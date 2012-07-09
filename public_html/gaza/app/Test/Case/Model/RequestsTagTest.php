<?php
App::uses('RequestsTag', 'Model');

/**
 * RequestsTag Test Case
 *
 */
class RequestsTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requests_tag',
		'app.tag',
		'app.request',
		'app.user',
		'app.group',
		'app.offer',
		'app.link',
		'app.offers_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RequestsTag = ClassRegistry::init('RequestsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RequestsTag);

		parent::tearDown();
	}

}
