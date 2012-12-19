<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\Repository;

class DomainRepository extends Repository {

    public function findByDomainName($domain) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->matching($query->equals('name', $domain, TRUE));
        return $query->execute();
    }

}