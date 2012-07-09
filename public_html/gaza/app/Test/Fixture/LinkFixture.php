<?php
/**
 * LinkFixture
 *
 */
class LinkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'offer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'archived' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_links_users' => array('column' => 'user_id', 'unique' => 0),
			'fk_links_offers' => array('column' => 'offer_id', 'unique' => 0),
			'fk_links_requests' => array('column' => 'request_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'offer_id' => 1,
			'request_id' => 1,
			'created' => '2012-07-07 19:19:40',
			'archived' => 1
		),
	);

}
