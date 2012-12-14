<?php

namespace MoveElevator\MeShortlink\Tests\Unit\Domain\Repository;

class ShortlinkRepositoryTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

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

    public function setUp() {
        $this->testingFramework = new \Tx_Phpunit_Framework('tx_meshortlink');
        $this->testConfig = array(
            'title' => 'ShortlinkRepositoryTest',
            'page' => 1,
            'url' => '',
            'params' => '&foo=bar'
        );

        $this->repositoryObject = $this->objectManager->get('\\MoveElevator\\MeShortlink\\Domain\\Repository\\ShortlinkRepository');
        $this->testingFramework->createRecord(
                'tx_meshortlink_domain_model_shortlink', array(
                    'title' => $this->testConfig['title'],
                    'page' => $this->testConfig['page'],
                    'url' => $this->testConfig['url'],
                    'params' => $this->testConfig['params'],
                )
        );
    }

    public function tearDown() {
        $this->testingFramework->cleanUp();
        unset($this->testingFramework);
        unset($this->repositoryObject);
    }

    public function testFindByRequest() {
        $querySettings = new \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings();
        $querySettings->setRespectStoragePage(FALSE);
        $this->repositoryObject->setDefaultQuerySettings($querySettings);
        $shortlinkObject = $this->repositoryObject->findByRequest($this->testConfig['title'])->current();
        $this->assertEquals($shortlinkObject->getTitle(), $this->testConfig['title']);
    }

}

?>
