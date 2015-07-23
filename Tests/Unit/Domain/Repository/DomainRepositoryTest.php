<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Repository;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Tests\UnitTestCase;


/**
 * Class DomainRepositoryTest
 *
 * @package MoveElevator\MeShortlink\Tests\Unit\Domain\Repository
 */
class DomainRepositoryTest extends BaseTestCase {

	/**
	 * @var \Tx_Phpunit_Framework
	 */
	protected $testingFramework;

	/**
	 * @var  \MoveElevator\MeShortlink\Domain\Repository\DomainRepository
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
		$this->testConfig = array(
			'domain' => 'www.move-elevator.de'
		);

		$this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->repositoryObject = $objectManager->get('MoveElevator\MeShortlink\Domain\Repository\DomainRepository');
		$this->testingFramework->createRecord(
			'tx_meshortlink_domain_model_domain', array('name' => $this->testConfig['domain'])
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
	 * @covers \MoveElevator\MeShortlink\Domain\Repository\DomainRepository::findByDomainName
	 * @return void
	 */
	public function testFindByDomainName() {
		$querySettings = new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
		$querySettings->setRespectStoragePage(FALSE);
		$this->repositoryObject->setDefaultQuerySettings($querySettings);
		/*
		 * @var \MoveElevator\MeShortlink\Domain\Model\Domain
		 */
		$domainObject = $this->repositoryObject->findByDomainName($this->testConfig['domain'])->current();
		$this->assertEquals($domainObject->getName(), $this->testConfig['domain']);
	}

}

?>