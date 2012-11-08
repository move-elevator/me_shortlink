<?php

namespace MoveElevator\MeShortlink\Controller;

use TYPO3\CMS\Core\Utility\HttpUtility;

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

    public function redirectAction() {
	$requestUri = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REQUEST_URI');
	$httpHost = \TYPO3\CMS\Core\Utility\GeneralUtility::getHostname();

	$shortLinkToCheck = pathinfo($httpHost . $requestUri, PATHINFO_FILENAME);
	if ($shortLinkToCheck !== '') {
	    $shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);
	    $domains = $this->domainRepository->findByName($httpHost);
	    $domain = $domains->current();
	    if (is_object($shortLinks)) {
		foreach ($shortLinks as $shortLink) {
		    if ($domain instanceof \MoveElevator\MeShortlink\Domain\Model\Domain &&
			    $domain->getPid() != $shortLink->getPid()
		    ) {
			continue;
		    }
		    $url = \MoveElevator\MeShortlink\Utility\GeneralUtility::getRedirectUrl($shortLink);
		    if (\TYPO3\CMS\Core\Utility\GeneralUtility::isValidUrl($url)) {
			HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
			$this->redirectToPage($url);
		    }
		}
	    }
	}
    }

}

?>