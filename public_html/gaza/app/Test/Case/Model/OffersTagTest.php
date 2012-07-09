<?php
App::uses('OffersTag', 'Model');

/**
 * OffersTag Test Case
 *
 */
class OffersTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.offers_tag',
		'app.tag',
		'app.offer',
		'app.user',
		'app.group',
		'app.request',
		'app.link',
		'app.requests_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OffersTag = ClassRegistry::init('OffersTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OffersTag);

		parent::tearDown();
	}

}
