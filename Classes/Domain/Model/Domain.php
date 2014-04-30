<?php

namespace MoveElevator\MeShortlink\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Domain
 *
 * @package MoveElevator\MeShortlink\Domain\Model
 */
class Domain extends AbstractEntity {

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