<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class ShortlinkRepository
 *
 * @package MoveElevator\MeShortlink\Domain\Repository
 */
class ShortlinkRepository extends Repository {

	/**
	 * @var string
	 */
	protected $objectType = 'MoveElevator\MeShortlink\Domain\Shortlink';

	/**
	 * @param string $shortlink
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByShortlinkString($shortlink) {

		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching($query->equals('title', $shortlink, TRUE));

		return $query->execute();
	}

}