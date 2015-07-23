<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Model;

use \MoveElevator\MeShortlink\Domain\Model\Domain;
use \TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Class DomainTest
 *
 * @package MoveElevator\MeShortlink\Tests\Unit\Domain\Model
 */
class DomainTest extends BaseTestCase {

	/**
	 * @var \MoveElevator\MeShortlink\Domain\Model\Domain
	 */
	protected $object;

	/*
	 * @var array
	 */
	protected $testConfig;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->object = new Domain();

		$this->testConfig = array(
			'name' => 'www.move-elevator.de',
		);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		unset($this->object);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Domain::setName
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Domain::getName
	 * @return void
	 */
	public function testSetNameStringAndGetsSame() {
		$this->object->setName($this->testConfig['name']);
		$this->assertSame($this->object->getName(), $this->testConfig['name']);
	}

}

?>