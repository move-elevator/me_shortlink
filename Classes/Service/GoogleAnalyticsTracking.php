<?php

namespace MoveElevator\MeShortlink\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class GoogleAnalyticsTracking
 *
 * @package MoveElevator\MeShortlink\Service
 */
class GoogleAnalyticsTracking
{

    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var array
     */
    protected $trackingFields;

    /**
     * @var string
     */
    protected $googleAnalyticsHostname = 'http://www.google-analytics.com/collect';

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return string|bool
     */
    public function trackPageView()
    {
        if ($this->configuration['trackingEnabled'] !== '1') {
            return true;
        }

        $this->setTrackingFieldsByServerGlobals();
        if (is_callable('curl_init') && (bool)$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse']) {
            return $this->sendCurlRequest();
        }

        /** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        /** @var \TYPO3\CMS\Backend\FrontendBackendUserAuthentication $frontendBackendUserAuthentication */
        $frontendBackendUserAuthentication = $objectManager->get(
            'TYPO3\CMS\Backend\FrontendBackendUserAuthentication'
        );
        $frontendBackendUserAuthentication->simplelog(
            'There is no curl to track page view',
            'me_shortlink'
        );

        return false;
    }

    /**
     * @return string|bool
     */
    protected function sendCurlRequest()
    {
        $fieldsRequestData = '';
        foreach ($this->trackingFields as $key => $value) {
            $fieldsRequestData .= $key . '=' . $value . '&';
            rtrim($fieldsRequestData, '&');
        }

        $config = array(
            'follow_redirects' => true,
            'strict_redirects' => true
        );

        if (isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer'])
            && strlen(trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer'])) > 0
        ) {
            $config['proxy_host'] = trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer']);
        }

        $httpRequest = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            'TYPO3\CMS\Core\Http\HttpRequest',
            $this->googleAnalyticsHostname,
            'POST',
            $config
        );

        $httpRequest->addPostParameter($fieldsRequestData);
        $result = $httpRequest->send();

        return $result->getBody();
    }

    /**
     * @return array
     */
    public function setTrackingFieldsByServerGlobals()
    {
        $this->trackingFields = array(
            'v' => 1,
            'tid' => $this->configuration['trackingId'],
            'cid' => $this->createUniversallyUniqueIdentifierV4(),
            't' => 'event',
            'aip' => 1,
            'ec' => 'Shortlink',
            'ea' => 'Shortlink',
            'el' => 'Shortlink: ' . $_SERVER['REDIRECT_URL'],
            'ev' => 1
        );
    }

    /**
     * Generates version 4 UUID: random
     *
     * @return bool|string
     */
    protected function createUniversallyUniqueIdentifierV4()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
