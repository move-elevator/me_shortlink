<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Model;

use \MoveElevator\MeShortlink\Domain\Model\Shortlink;
use \TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Class ShortlinkTest
 *
 * @package MoveElevator\MeShortlink\Tests\Unit\Domain\Model
 */
class ShortlinkTest extends UnitTestCase {

	/**
	 * @var \MoveElevator\MeShortlink\Domain\Model\Shortlink
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
		$this->object = new Shortlink();
		$this->testConfig = array(
			'title' => 'foo',
			'page' => 1,
			'urlWithHTTP' => 'http://www.move-elevator.de',
			'urlWithOutHTTP' => 'www.move-elevator.de',
			'urlWithHTTPS' => 'https://www.move-elevator.de',
			'paramsWithAmp' => '&foo=bar',
			'paramsWithOutAmp' => 'foo=bar',
		);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		unset($this->object);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setTitle
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getTitle
	 * @return void
	 */
	public function testSetTitleStringAndGetsSame() {
		$this->object->setTitle($this->testConfig['title']);
		$this->assertSame($this->object->getTitle(), $this->testConfig['title']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setPage
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getPage
	 * @return void
	 */
	public function testSetPageIntAndGetsSame() {
		$this->object->setPage($this->testConfig['page']);
		$this->assertSame($this->object->getPage(), $this->testConfig['page']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setUrl
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getUrl
	 * @return void
	 */
	public function testSetUrlWithHttpAndGetsSame() {
		$this->object->setUrl($this->testConfig['urlWithHTTP']);
		$this->assertSame($this->object->getUrl(), $this->testConfig['urlWithHTTP']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setUrl
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getUrl
	 * @return void
	 * @return void
	 */
	public function testSetUrlWithHttpsAndGetsSame() {
		$this->object->setUrl($this->testConfig['urlWithHTTPS']);
		$this->assertSame($this->object->getUrl(), $this->testConfig['urlWithHTTPS']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setUrl
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getUrl
	 * @return void
	 */
	public function testSetUrlWithOutHttpAndGetsWithHttp() {
		$this->object->setUrl($this->testConfig['urlWithOutHTTP']);
		$this->assertSame($this->object->getUrl(), $this->testConfig['urlWithHTTP']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setParams
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getParams
	 * @return void
	 */
	public function testSetParamsWithAmpAndGetsSame() {
		$this->object->setParams($this->testConfig['paramsWithAmp']);
		$this->assertSame($this->object->getParams(), $this->testConfig['paramsWithAmp']);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::setParams
	 * @covers \MoveElevator\MeShortlink\Domain\Model\Shortlink::getParams
	 * @return void
	 */
	public function testSetParamsWithOutAmpAndGetsWithAmp() {
		$this->object->setParams($this->testConfig['paramsWithOutAmp']);
		$this->assertSame($this->object->getParams(), $this->testConfig['paramsWithAmp']);
	}

}

?>
