<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Model;

/**
 * Test case for class '\MoveElevator\MeShortlink\Domain\Model\Domain'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class DomainTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

    /**
     * @var \MoveElevator\MeShortlink\Domain\Model\Domain
     */
    protected $object;

    public function setUp() {
        $this->object = new \MoveElevator\MeShortlink\Domain\Model\Domain();
    }

    public function tearDown() {
        unset($this->object);
    }

    /**
     * @test
     */
    public function SetNameStringAndGetsSame() {
        $newName = 'www.test.com';
        $this->object->setName($newName);
        $this->assertSame($this->object->getName(), $newName);
    }

}

?>
