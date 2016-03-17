<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Utility;

use MoveElevator\MeShortlink\Utility\ShortlinkUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Tests\UnitTestCase;

/**
 * Test case for class '\MoveElevator\MeShortlink\Tests\Unit\Utility'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class ShortlinkUtilityTest extends UnitTestCase
{

    /*
     * @var array
     */
    protected $backupGlobalsBlacklist = array('GLOBALS', 'TYPO3_CONF_VARS');

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var  \MoveElevator\MeShortlink\Utility\ShortlinkUtility
     */
    protected $utilityObject;

    /**
     * @var  \MoveElevator\MeShortlink\Service\ShortlinkService
     */
    protected $serviceObject;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

        $this->utilityObject = new ShortlinkUtility();
        $this->fixtureShortlink = array(
            'title' => 'fooo',
            'url' => 'http://move-elevator.de',
        );
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getRedirectUrlFromShortlink
     * @return void
     */
    public function testGetRedirectUrlFromShortlink()
    {
        $redirectUrl = ShortlinkUtility::getRedirectUrlFromShortlink($this->fixtureShortlink);
        $this->assertEquals($redirectUrl, 'http://move-elevator.de');
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getValidShortlink
     * @return void
     */
    public function testGetValidShortlink()
    {
        $this->assertFalse($this->utilityObject->getValidShortlink('*foo-bar_batz23.html'));
        $this->assertSame('foo-bar_batz23', ShortlinkUtility::getValidShortlink('foo-bar_batz23'));
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getInternalUrlFromShortlink
     * @return void
     */
    public function testGetInternalUrlFromShortlink()
    {
        $this->fixtureShortlink['page'] = 1;
        $this->assertStringStartsWith(
            'http',
            $this->utilityObject->getInternalUrlFromShortlink($this->fixtureShortlink)
        );
    }
}
