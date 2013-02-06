<?php

namespace MoveElevator\MeShortlink\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \MoveElevator\MeShortlink\Utility\GeneralUtility as MeUtility;
use \TYPO3\CMS\Core\Utility\HttpUtility;
use \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

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

    /*
     * @return void
     */
    public function redirectAction() {
        $requestUri = GeneralUtility::getIndpEnv('REQUEST_URI');
        $httpHost = GeneralUtility::getHostname();
        $shortLinkToCheck = MeUtility::getValidShortlink($requestUri);

        if ($shortLinkToCheck !== FALSE) {
            $shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);
            
            if ($shortLinks instanceof QueryResult && count($shortLinks) > 0) {
                $domain = $this->getDomain($httpHost);
                $this->checkShortLinksDomain($shortLinks, $domain);
            }
        }
    }
    
    /**
     * check if shortlink matches against domain and redirect
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $shortLinks
     * @param \MoveElevator\MeShortlink\Domain\Model\Domain $domain|NULL
     */
    protected function checkShortLinksDomain(QueryResult $shortLinks, $domain = NULL){
        foreach ($shortLinks as $shortLink) {
            if ($domain && $domain->getPid() != $shortLink->getPid()) {
                continue;
            }
            
            $this->redirect($shortLink);
        }
    }
    
    /**
     * redirect to shortlink target
     * @param \MoveElevator\MeShortlink\Domain\Model\Shortlink $shortLink
     * @return void
     */
    protected function redirect($shortLink){
        $url = MeUtility::getRedirectUrlFromShortlink($shortLink);
        
        if (GeneralUtility::isValidUrl($url)) {
            HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
        }
    }
    
    /**
     * return ShortlinkDomain by given httpHost
     * @param string $httpHost
     * @return string $domain
     */
    protected function getDomain($httpHost){
        $domains = $this->domainRepository->findByName($httpHost);
        $domain = $domains->current();
        
        return $domain;
    }
}

?>