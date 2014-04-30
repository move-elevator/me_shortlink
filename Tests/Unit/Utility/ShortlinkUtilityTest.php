<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Utility;

use \MoveElevator\MeShortlink\Utility\ShortlinkUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase;


/**
 * Test case for class '\MoveElevator\MeShortlink\Tests\Unit\Utility'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class ShortlinkUtilityTest extends BaseTestCase {

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

	/**
	 * @return void
	 */
	public function setUp() {
		$this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->repositoryObject = $this->objectManager->get('MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository');
		$this->utilityObject = new ShortlinkUtility();
		$this->fixtureShortlinkUid = $this->testingFramework->createRecord(
			'tx_meshortlink_domain_model_shortlink', array(
				'title' => 'fooo',
				'url' => 'move-elevator.de',
			)
		);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->testingFramework);
		unset($this->repositoryObject);
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getRedirectUrlFromShortlink
	 * @return void
	 */
	public function testGetRedirectUrlFromShortlink() {
		$querySettings = new Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->repositoryObject->setDefaultQuerySettings($querySettings);
		$shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
		$redirectUrl = ShortlinkUtility::getRedirectUrlFromShortlink($shortLink);
		$this->assertEquals($redirectUrl, 'http://move-elevator.de');
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getValidShortlink
	 * @return void
	 */
	public function testGetValidShortlink() {
		$this->assertFalse($this->utilityObject->getValidShortlink('*foo-bar_batz23.html'));
		$this->assertSame('foo-bar_batz23', ShortlinkUtility::getValidShortlink('foo-bar_batz23'));
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getInternalUrlFromShortlink
	 * @return void
	 */
	public function testGetInternalUrlFromShortlink() {
		$shortLink = $this->repositoryObject->findByUid($this->fixtureShortlinkUid);
		$this->assertStringStartsWith('http', $this->utilityObject->getInternalUrlFromShortlink($shortLink));
	}

	/**
	 * @covers \MoveElevator\MeShortlink\Utility\ShortlinkUtility::getSpeakingUrlFromRealUrl
	 * @return void
	 */
	public function testGetSpeakingUrlFromRealUrl() {
		$this->markTestIncomplete('just check against PageId 1!');
		$this->assertSame('', $this->utilityObject->getSpeakingUrlFromRealUrl(1));
	}

}

?>