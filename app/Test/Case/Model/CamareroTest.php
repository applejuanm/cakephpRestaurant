<?php
App::uses('Camarero', 'Model');

/**
 * Camarero Test Case
 */
class CamareroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.camarero',
		'app.mesa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Camarero = ClassRegistry::init('Camarero');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Camarero);

		parent::tearDown();
	}

}
