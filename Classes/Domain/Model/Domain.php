<?php

namespace MoveElevator\MeShortlink\Domain\Model;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Domain/Model
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Domain extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>