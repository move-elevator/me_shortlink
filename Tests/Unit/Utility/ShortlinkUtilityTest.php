<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Utility;

/**
 * Test case for class '\MoveElevator\MeShortlink\Tests\Unit\Utility'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class ShortlinkUtilityTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

    /**
     * @var \Tx_Phpunit_Framework
     */
    protected $testingFramework;

    /**
     * @var  \MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository
     */
    protected $repositoryObject;
    
    /**
     * @var  \MoveElevator\MeShortlink\Utility\ShortlinkUtility
     */
    protected $utilityObject;

    public function setUp() {
        $this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
        $this->repositoryObject = $this->objectManager->get('\\MoveElevator\\MeShortlink\\Domain\\Repository\\ShortlinkRepository');
        $this->utilityObject = $this->objectManager->get('MoveElevator\\MeShortlink\\Utility\\ShortlinkUtility');
        $this->fixtureShortlinkUid = $this->testingFramework->createRecord(
                'tx_meshortlink_domain_model_shortlink', array(
                    'title' => 'fooo',
                    'url' => 'move-elevator.de',
                )
        );
    }

    public function tearDown() {
        $this->testingFramework->cleanUp();
        unset($this->testingFramework);
        unset($this->repositoryObject);
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getRedirectUrlFromShortlink
     */
    public function testGetRedirectUrlFromShortlink() {
        $querySettings = new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
        $querySettings->setRespectStoragePage(FALSE);
        $this->repositoryObject->setDefaultQuerySettings($querySettings);
        $shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
        $redirectUrl = $this->utilityObject->getRedirectUrlFromShortlink($shortLink);
        $this->assertEquals($redirectUrl, 'http://move-elevator.de');
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getValidShortlink
     */
    public function testGetValidShortlink() {
        $this->assertFalse($this->utilityObject->getValidShortlink('*foo-bar_batz23.html'));
        $this->assertSame('foo-bar_batz23', $this->utilityObject->getValidShortlink('foo-bar_batz23'));
    }
    
    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getInternalUrlFromShortlink
     */
    public function testGetInternalUrlFromShortlink(){
        $shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
        $this->assertStringStartsWith('http', $this->utilityObject->getInternalUrlFromShortlink($shortLink));
    }
    
    /**
     * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getSpeakingUrlFromRealUrl
     */
    public function testGetSpeakingUrlFromRealUrl(){
        $this->markTestIncomplete('just check against PageId 1!');
        $this->assertSame('', $this->utilityObject->getSpeakingUrlFromRealUrl(1));
    }

}

?>