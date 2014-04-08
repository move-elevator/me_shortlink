<?php

namespace MoveElevator\MeShortlink\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility,
    \TYPO3\CMS\Core\Utility\HttpUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \MoveElevator\MeShortlink\Utility\ShortlinkUtility;


use \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/**
 * Class ShortlinkController
 *
 * @package MoveElevator\MeShortlink\Controller
 */
class ShortlinkController extends ActionController {

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

    /*
     * @return void
     */
    public function redirectAction() {
        $requestUri = GeneralUtility::getIndpEnv('REQUEST_URI');
        $httpHost = GeneralUtility::getHostname();
        $shortLinkToCheck = ShortlinkUtility::getValidShortlink($requestUri);

        if ($shortLinkToCheck !== FALSE) {
            if (!isset($GLOBALS['TCA']['tx_meshortlink_domain_model_shortlink'])) {
                $GLOBALS['TSFE']->includeTCA();
            }
            $shortLinks = $this->shortlinkRepository->findByShortlinkString($shortLinkToCheck);
            if ($shortLinks instanceof QueryResult && count($shortLinks) > 0) {
                $domain = $this->getDomain($httpHost);
                $this->checkShortLinksDomain($shortLinks, $domain);
            }
        }
    }

    /**
     * check if shortlink matches against domain and redirect
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $shortLinks
     * @param \MoveElevator\MeShortlink\Domain\Model\Domain $domain|NULL
     */
    protected function checkShortLinksDomain(QueryResult $shortLinks, $domain = FALSE) {
        foreach ($shortLinks as $shortLink) {
            if ($domain instanceof Domain && $domain->getPid() !== $shortLink->getPid()) {
                continue;
            }

            $this->redirect($shortLink);
        }
    }

    /**
     * redirect to shortlink target
     *
     * @param \MoveElevator\MeShortlink\Domain\Model\Shortlink $shortLink
     * @return void
     */
    protected function redirect($shortLink) {
        $url = ShortlinkUtility::getRedirectUrlFromShortlink($shortLink);

        if (GeneralUtility::isValidUrl($url) === TRUE) {
            HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
        }
    }

    /**
     * return ShortlinkDomain by given httpHost
     *
     * @param string $httpHost
     * @return string $domain
     */
    protected function getDomain($httpHost) {
        $domains = $this->domainRepository->findByDomainName($httpHost);
        $domain = $domains->current();

        return $domain;
    }
}

?>