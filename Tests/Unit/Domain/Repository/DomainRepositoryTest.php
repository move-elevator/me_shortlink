<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Repository;

/**
 * Test case for class '\MoveElevator\MeShortlink\Domain\Repository\DomainRepository'
 *
 * @package me_shortlink
 * @subpackage Tests
 */
class DomainRepositoryTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

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

    /**
     * @test
     */
    public function createDomainRecords() {
        $this->repositoryObject = $this->objectManager->get('\\MoveElevator\\MeShortlink\\Domain\\Repository\\DomainRepository');
        $this->fixtureUid = $this->testingFramework->createRecord(
                'tx_meshortlink_domain_model_domain', array ('name' => 'www.google.de')
        );
        
	$querySettings =new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
	$querySettings->setRespectStoragePage(FALSE);
	$this->repositoryObject->setDefaultQuerySettings($querySettings);
        $this->assertEquals($this->repositoryObject->findByUid($this->fixtureUid)->getName(), 'www.google.de');
    }
}

?>
