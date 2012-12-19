<?php

namespace MoveElevator\MeShortlink\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \MoveElevator\MeShortlink\Utility\GeneralUtility as MeUtility;
use \TYPO3\CMS\Core\Utility\HttpUtility;
use \MoveElevator\MeShortlink\Domain\Model\Domain;

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
        $requestUri = GeneralUtility::getIndpEnv('REQUEST_URI');
        $httpHost = GeneralUtility::getHostname();
        $shortLinkToCheck = MeUtility::getValidShortlink($requestUri);

        if ($shortLinkToCheck !== FALSE) {
            $shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);
            $domains = $this->domainRepository->findByName($httpHost);
            $domain = $domains->current();
            if (is_object($shortLinks)) {
                foreach ($shortLinks as $shortLink) {
                    if ($domain instanceof Domain &&
                            $domain->getPid() != $shortLink->getPid()
                    ) {
                        continue;
                    }
                    $url = MeUtility::getRedirectUrl($shortLink);
                    if (GeneralUtility::isValidUrl($url)) {
                        HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
                    }
                }
            }
        }
    }
}

?>