<?php

namespace MoveElevator\MeShortlink\Controller;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ShortlinkController extends \TYPO3\CMS\Extbase\MVC\Controller\ActionController {

    /**
     * @var \MoveElevator\MeShortlink\Domain\Repository\ShortlinkRepository
     * @inject
     */
    protected $shortlinkRepository;

    /**
     * @var \MoveElevator\MeShortlink\Domain\Repository\DomainRepository
     * @inject
     */
    protected $domainRepository;

    /**
     * action redirect
     *
     * @return void
     */
    public function redirectAction() {
	$request_uri = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$http_host = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';

	$linkPath = pathinfo($http_host . $request_uri);
	$shortLinkToCheck = isset($linkPath['filename']) ? $linkPath['filename'] : '';

	$shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);
	
	$domains = $this->domainRepository->findByName($http_host);
	$domain = $domains->current();

	if (is_object($shortLinks) && count($shortLinks) > 0) {
	    foreach ($shortLinks as $shortLink) {
		if (isset($domain)) {
		    if ($domain->getPid() != $shortLink->getPid()) {
			continue;
		    }
		}
		header("HTTP/1.0 301 Moved Permanently");
		header("Status: 301 Moved Permanently");
		if ($shortLink->getPage() != '') {
		    header("Location: " . \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl("index.php?id=" . $shortLink->getPage() . $shortLink->getParams()), true, 301);
		} else if ($shortLink->getUrl()) {
		    header("Location: " . $shortLink->getUrl(), true, 301);
		}
		exit;
	    }
	}
    }

}

?>