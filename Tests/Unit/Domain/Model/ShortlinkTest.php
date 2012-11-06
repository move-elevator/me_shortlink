<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Model;

/**
 * Test case for class '\MoveElevator\MeShortlink\Domain\Model\Shortlink'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class ShortlinkTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

    /**
     * @var \MoveElevator\MeShortlink\Domain\Model\Shortlink
     */
    protected $object;
    
    /*
     * @var array
     */
    protected $testConfig;

    public function setUp() {
        $this->object = new \MoveElevator\MeShortlink\Domain\Model\Shortlink();
	$this->testConfig = array(
	    'title' => 'foo',
	    'page' => 1,
	    'urlWithHTTP' => 'http://www.move-elevator.de',
	    'urlWithOutHTTP' => 'www.move-elevator.de',
	    'paramsWithAmp' => '&foo=bar',
	    'paramsWithOutAmp' => 'foo=bar',
	);
    }

    public function tearDown() {
        unset($this->object);
    }

    /**
     * @test
     */
    public function SetTitleStringAndGetsSame() {
        $this->object->setTitle($this->testConfig['title']);
        $this->assertSame($this->object->getTitle(), $this->testConfig['title']);
    }
    
    /**
     * @test
     */
    public function SetPageIntAndGetsSame() {
        $this->object->setPage($this->testConfig['page']);
        $this->assertSame($this->object->getPage(), $this->testConfig['page']);
    }
    
    /**
     * @test
     */
    public function SetUrlWithHttpAndGetsSame() {
        $this->object->setUrl($this->testConfig['urlWithHTTP']);
        $this->assertSame($this->object->getUrl(), $this->testConfig['urlWithHTTP']);
    }
    
    /**
     * @test
     */
    public function SetUrlWithOutHttpAndGetsSame() {
        $this->object->setUrl($this->testConfig['urlWithOutHTTP']);
        $this->assertSame($this->object->getUrl(), $this->testConfig['urlWithHTTP']);
    }
    
    /**
     * @test
     */
    public function SetParamsWithAmpAndGetsSame() {
        $this->object->setParams($this->testConfig['paramsWithAmp']);
        $this->assertSame($this->object->getParams(), $this->testConfig['paramsWithAmp']);
    }
    
    /**
     * @test
     */
    public function SetParamsWithOutAmpAndGetsSame() {
        $this->object->setParams($this->testConfig['paramsWithOutAmp']);
        $this->assertSame($this->object->getParams(), $this->testConfig['paramsWithAmp']);
    }

}

?>
