<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

class DomainRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    public function findByDomainName($domain) {
	$query = $this->createQuery();
	$query->getQuerySettings()->setRespectStoragePage(FALSE);
	$query->matching($query->equals('name', $domain, TRUE));
	return $query->execute();
    }
}