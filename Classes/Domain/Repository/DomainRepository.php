<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class DomainRepository
 *
 * @package MoveElevator\MeShortlink\Domain\Repository
 */
class DomainRepository extends Repository {

	/**
	 * @param string $domain
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByDomainName($domain) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setIgnoreEnableFields(FALSE);
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('name', $domain, TRUE));

		return $query->execute();
	}

}