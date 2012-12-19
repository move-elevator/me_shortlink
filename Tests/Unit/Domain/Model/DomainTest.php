<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Model;

class DomainTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

    /**
     * @var \MoveElevator\MeShortlink\Domain\Model\Domain
     */
    protected $object;

    /*
     * @var array
     */
    protected $testConfig;

    public function setUp() {
        $this->object = new \MoveElevator\MeShortlink\Domain\Model\Domain();

        $this->testConfig = array(
            'name' => 'www.move-elevator.de',
        );
    }

    public function tearDown() {
        unset($this->object);
    }

    public function testSetNameStringAndGetsSame() {
        $this->object->setName($this->testConfig['name']);
        $this->assertSame($this->object->getName(), $this->testConfig['name']);
    }

}

?>