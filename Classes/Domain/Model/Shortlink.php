<?php

namespace MoveElevator\MeShortlink\Domain\Model;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Domain/Model
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Shortlink extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $page;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var string
	 */
	protected $params;

	/**
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string $page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * @param string $page
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * @return string $url
	 */
	public function getUrl() {
		if(strlen($this->url) > 0){
		    if(substr($this->url,0,4) !== 'http'){
			return 'http://'.$this->url;
		    }
		}
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return string $params
	 */
	public function getParams() {
		if(strlen($this->params) > 0){
		    if($this->params{0} !== '&'){
			return '&'.$this->params;
		    }
		}
		return $this->params;
	}

	/**
	 * @param string $params
	 * @return void
	 */
	public function setParams($params) {
		$this->params = $params;
	}

}
?>