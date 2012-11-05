<?php

namespace MoveElevator\MeShortlink\Domain\Repository;

/**
 *
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Domain/Repository
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class DomainRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
    public function findByDomainName($domain) {
	$query = $this->createQuery();
	$query->getQuerySettings()->setRespectStoragePage(FALSE);
	$query->matching($query->equals('name', $domain, TRUE));
	return $query->execute();
    }
}