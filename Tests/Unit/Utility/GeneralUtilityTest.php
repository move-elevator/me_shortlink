<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Utility;

/**
 * Test case for class '\MoveElevator\MeShortlink\Tests\Unit\Utility'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class GeneralUtilityTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

    /**
     * @var \Tx_Phpunit_Framework
     */
    protected $testingFramework;

    /**
     * @var  \MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository
     */
    protected $repositoryObject;
    
    /**
     * @var  \MoveElevator\MeShortlink\Utility\GeneralUtility
     */
    protected $utilityObject;

    public function setUp() {
        $this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
        $this->repositoryObject = $this->objectManager->get('\\MoveElevator\\MeShortlink\\Domain\\Repository\\ShortlinkRepository');
        $this->utilityObject = $this->objectManager->get('MoveElevator\\MeShortlink\\Utility\\GeneralUtility');
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
     * @covers \MoveElevator\MeShortlink\Utility\GeneralUtility::getRedirectUrl
     */
    public function testGetRedirectUrl() {
        $querySettings = new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
        $querySettings->setRespectStoragePage(FALSE);
        $this->repositoryObject->setDefaultQuerySettings($querySettings);
        $shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
        $redirectUrl = $this->utilityObject->getRedirectUrl($shortLink);
        $this->assertEquals($redirectUrl, 'http://move-elevator.de');
    }

    /**
     * @covers \MoveElevator\MeShortlink\Utility\GeneralUtility::getValidShortlink
     */
    public function testGetValidShortlink() {
        $this->assertFalse($this->utilityObject->getValidShortlink('*foo-bar_batz23.html'));
        $this->assertSame('foo-bar_batz23', $this->utilityObject->getValidShortlink('foo-bar_batz23'));
    }
    
    /**
     * @covers \MoveElevator\MeShortlink\Utility\GeneralUtility::getInternalUrl
     */
    public function testGetInternalUrl(){
        $shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
        $this->assertStringStartsWith('http', $this->utilityObject->getInternalUrl($shortLink));
    }
    
    /**
     * @covers \MoveElevator\MeShortlink\Utility\GeneralUtility::getSpeakingUrlFromRealUrl
     */
    public function testGetSpeakingUrlFromRealUrl(){
        $this->markTestIncomplete('must be written!');
    }

}

?>