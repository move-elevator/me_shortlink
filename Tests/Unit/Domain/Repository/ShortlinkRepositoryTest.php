<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Utility;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Tests\UnitTestCase;


/**
 * Class ShortlinkRepositoryTest
 *
 * @package MoveElevator\MeShortlink\Tests\Unit\Domain\Repository
 */
class ShortlinkRepositoryTest extends UnitTestCase {

	/**
	 * @var \Tx_Phpunit_Framework
	 */
	protected $testingFramework;

	/**
	 * @var  \MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository
	 */
	protected $repositoryObject;

	/*
	 * @var array
	 */
	protected $testConfig;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
		$this->testConfig = array(
			'title' => 'ShortlinkRepositoryTest',
			'page' => 1,
			'url' => '',
			'params' => '&foo=bar'
		);

		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->repositoryObject = $objectManager->get('MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository');
		$this->testingFramework->createRecord(
			'tx_meshortlink_domain_model_shortlink', array(
				'title' => $this->testConfig['title'],
				'page' => $this->testConfig['page'],
				'url' => $this->testConfig['url'],
				'params' => $this->testConfig['params'],
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
	 * @return void
	 */
	public function testFindByRequest() {
		$querySettings = new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->repositoryObject->setDefaultQuerySettings($querySettings);
		$shortlinkObject = $this->repositoryObject->findByShortlinkString($this->testConfig['title'])->current();
		$this->assertEquals($shortlinkObject->getTitle(), $this->testConfig['title']);
	}

}

?>
