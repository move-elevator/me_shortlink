<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

class ShortlinkRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    public function findByRequest($shortlink) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
	$query->matching($query->equals('title', $shortlink ,TRUE));
        return $query->execute();
    }
}
?>