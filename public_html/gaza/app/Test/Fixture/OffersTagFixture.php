<?php
/**
 * OffersTagFixture
 *
 */
class OffersTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'offer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_offertags_offers' => array('column' => 'offer_id', 'unique' => 0),
			'fk_offertags_tags' => array('column' => 'tag_id', 'unique' => 0)
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
			'tag_id' => 1,
			'offer_id' => 1
		),
	);

}
