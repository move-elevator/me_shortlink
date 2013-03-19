<?php

namespace MoveElevator\MeShortlink\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Shortlink extends AbstractEntity {

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * @var integer
     */
    protected $page;

    /**
     * @var string
     */
    protected $url = '';

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
     * @return integer $page
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param integer $page
     * @return void
     */
    public function setPage($page) {
        $this->page = $page;
    }

    /**
     * @return string $url
     */
    public function getUrl() {
        if (strlen($this->url) > 0 && substr($this->url, 0, 4) !== 'http') {

            return 'http://' . $this->url;
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
     * @return string
     */
    public function getParams() {
        if (strlen($this->params) > 0 && $this->params{0} !== '&') {
            
            return '&' . $this->params;
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