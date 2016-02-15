<?php

namespace MoveElevator\MeShortlink\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use MoveElevator\MeShortlink\Utility\ShortlinkUtility;

/**
 * Class ShortlinkService
 *
 * @package MoveElevator\MeShortlink\Service
 */
class ShortlinkService
{

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /*
     * @return void
     */
    public function init()
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

        $requestUri = GeneralUtility::getIndpEnv('REQUEST_URI');
        $httpHost = GeneralUtility::getHostname();
        $shortLinkToCheck = ShortlinkUtility::getValidShortlink($requestUri);

        if ($shortLinkToCheck !== false) {
            $shortLinks = $this->findByShortlinkString($shortLinkToCheck);
            if (count($shortLinks) > 0) {
                $domain = $this->getDomain($httpHost);
                $this->checkShortLinksDomain($shortLinks, $domain);
            }
        }
    }

    /**
     * check if shortlink matches against domain and redirect
     *
     * @param array $shortLinks
     * @param $domain array|bool
     * @return void
     */
    protected function checkShortLinksDomain(array $shortLinks = array(), $domain = false)
    {
        foreach ($shortLinks as $shortLink) {
            if (is_array($domain) && $domain['pid'] !== $shortLink['pid']) {
                continue;
            }

            $this->redirect($shortLink);
        }
    }

    /**
     * redirect to shortlink target
     *
     * @param array $shortLink
     * @return void
     */
    protected function redirect(array $shortLink)
    {
        $this->trackAnalytics();
        $url = ShortlinkUtility::getRedirectUrlFromShortlink($shortLink);

        if (GeneralUtility::isValidUrl($url) === true) {
            HttpUtility::redirect($url, HttpUtility::HTTP_STATUS_301);
        }
    }

    /**
     * return ShortlinkDomain by given httpHost
     *
     * @param string $httpHost
     * @return string $domain
     */
    protected function getDomain($httpHost)
    {
        $domain = $this->findOneByDomainName($httpHost);

        return $domain;
    }

    /**
     * track google analytics pageview if config is enable
     *
     * @return void
     */
    protected function trackAnalytics()
    {
        $configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['me_shortlink']);
        if (isset($configuration['googleAnalyticsSettings.']) && is_array($configuration['googleAnalyticsSettings.'])) {
            /* @var $trackingService \MoveElevator\MeShortlink\Service\GoogleAnalyticsTracking */
            $trackingService = $this->objectManager->get(
                'MoveElevator\MeShortlink\Service\GoogleAnalyticsTracking',
                $configuration['googleAnalyticsSettings.']
            );
            $trackingService->trackPageView();
        }
    }

    /**
     * use classic TYPO3_DB connection to prevent overhead loading of extbase, performance and mapping issues
     *
     * @param string $httpHost
     * @return array|FALSE|NULL
     */
    protected function findOneByDomainName($httpHost)
    {
        return $this->getDatabaseConnection()->exec_SELECTgetSingleRow(
            '*',
            'tx_meshortlink_domain_model_domain',
            'name = "' . addslashes($httpHost) . '"' . $this->getEnableFields()
        );
    }

    /**
     * use classic TYPO3_DB connection to prevent overhead loading of extbase, performance and mapping issues
     *
     * @param string $shortLinkToCheck
     * @return array|NULL
     */
    protected function findByShortlinkString($shortLinkToCheck)
    {
        return $this->getDatabaseConnection()->exec_SELECTgetRows(
            '*',
            'tx_meshortlink_domain_model_shortlink',
            'title = "' . addslashes($shortLinkToCheck) . '"' . $this->getEnableFields()
        );
    }

    /**
     * get DatabaseConnection
     *
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * @return string
     */
    protected function getEnableFields()
    {
        $enableFields = ' AND hidden = 0';
        $enableFields .= ' AND deleted = 0';
        $enableFields .= ' AND starttime <= ' . $GLOBALS['SIM_ACCESS_TIME'];
        $enableFields .= ' AND (endtime=0 OR endtime>' . $GLOBALS['SIM_ACCESS_TIME'] . ')';

        return $enableFields;
    }
}
