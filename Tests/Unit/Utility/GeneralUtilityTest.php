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
     * @var  \MoveElevator\MeShortlink\Domain\Repository\DomainRepository
     */
    protected $repositoryObject;

    public function setUp() {
        $this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
    }

    public function tearDown() {
	$this->testingFramework->cleanUp();
	unset($this->testingFramework);
        unset($this->repositoryObject);
    }

    public function testGetRedirectUrl() {
        $this->repositoryObject = $this->objectManager->get('\\MoveElevator\\MeShortlink\\Domain\\Repository\\ShortlinkRepository');
        $this->fixtureUid = $this->testingFramework->createRecord(
                'tx_meshortlink_domain_model_shortlink', array (
		    'title' => 'fooo',
		    'url' => 'move-elevator.de',
		)
        );
        
	$querySettings =new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
	$querySettings->setRespectStoragePage(FALSE);
	$this->repositoryObject->setDefaultQuerySettings($querySettings);
	$shortLink = $this->repositoryObject->findByUid($this->fixtureUid);
	$utilityObject = $this->objectManager->get('MoveElevator\\MeShortlink\\Utility\\GeneralUtility');
	$redirectUrl = $utilityObject::getRedirectUrl($shortLink);
        $this->assertEquals($redirectUrl, 'http://move-elevator.de');
    }
}

?>
