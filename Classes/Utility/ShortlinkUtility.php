<?php

namespace MoveElevator\MeShortlink\Utility;

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

class ShortlinkUtility {

    /**
     * Check if the url has a valid shortlink part
     * @param string $url
     * @return string|false
     */
    public static function getValidShortlink($url) {
        $parts = preg_split('/(\/)|(\.)/', $url, -1, PREG_SPLIT_NO_EMPTY);
        
        if (count($parts) > 1) {
            return FALSE;
        }
        
        $lastPart = array_pop($parts);
        
        if (!preg_match('/^([a-zA-Z0-9-_]{3,30})$/', $lastPart)) {
            return FALSE;
        } 
        
        return $lastPart;
    }

    /**
     * Get url from Shortlink
     * @param \MoveElevator\MeShortlink\Domain\Model\Shortlink $shortLink
     * @return string
     */
    public static function getRedirectUrlFromShortlink($shortLink) {
        if (intval($shortLink->getPage()) > 0) {
            $url = self::getInternalUrlFromShortlink($shortLink);
        } else {
            $url = $shortLink->getUrl();
        }
        
        return $url;
    }

    /**
     * Returns full URL of internal Page with optinal Params
     * @param string $shortlinkParams
     * @return string
     */
    public function getInternalUrlFromShortlink($shortLink) {
        $shortLinkPage = $shortLink->getPage();
        $shortLinkParams = $shortLink->getParams();
        
        if (ExtensionManagementUtility::isLoaded('realurl')) {
            $realUrlParams = GeneralUtility::explodeUrl2Array($shortLinkParams);
            $url = self::getSpeakingUrlFromRealUrl($shortLinkPage, $realUrlParams);
        } else {
            $url = 'index.php?id=' . $shortLinkPage . $shortLinkParams;
        }
        
        return GeneralUtility::locationHeaderUrl($url);
    }

    /**
     * Get Speaking path from RealUrl Extension
     * @param integer $pid
     * @param array $params
     * @return array
     */
    public function getSpeakingUrlFromRealUrl($pid, $params = array()) {
        //init page object to get realUrl configuration
        $GLOBALS['TSFE']->sys_page = GeneralUtility::makeInstance('t3lib_pageSelect');
        $GLOBALS['TSFE']->tmpl = GeneralUtility::makeInstance('t3lib_TStemplate');
        $GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;

        $pageRow = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('*', 'pages', 'uid = ' . (int) $pid);
        
        if ($pageRow) {
            $conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pageRow, '', 0, 'index.php', '', GeneralUtility::implodeArrayForUrl('', $params));
        }
        $realUrl = GeneralUtility::makeInstance('tx_realurl');
        $realUrl->encodeSpURL($conf, $this);
        $url = $conf['LD']['totalURL'];
        
        return $url;
    }

}

?>