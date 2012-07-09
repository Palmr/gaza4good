<?php
/**
 * RequestsTagFixture
 *
 */
class RequestsTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_requesttags_requests' => array('column' => 'request_id', 'unique' => 0),
			'fk_requesttags_tags' => array('column' => 'tag_id', 'unique' => 0)
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
			'tag_id' => 1,
			'request_id' => 1,
			'id' => 1
		),
	);

}
