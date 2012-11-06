<?php

namespace MoveElevator\MeShortlink\Controller;

use TYPO3\CMS\Core\Utility\HttpUtility;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ShortlinkController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	$requestUri = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
	$httpHost = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';

	$linkPath = pathinfo($httpHost . $requestUri);
	$shortLinkToCheck = isset($linkPath['filename']) ? $linkPath['filename'] : '';

	$shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);

	$domains = $this->domainRepository->findByName($httpHost);
	$domain = $domains->current();
	if (is_object($shortLinks)) {
	    foreach ($shortLinks as $shortLink) {
		if ($domain) {
		    if ($domain->getPid() != $shortLink->getPid()) {
			continue;
		    }
		}
		$url = \MoveElevator\MeShortlink\Utility\GeneralUtility::getRedirectUrl($shortLink);
		if ($url) {
		    HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
		    $this->redirectToPage($url);
		}
	    }
	}
    }
}

?>