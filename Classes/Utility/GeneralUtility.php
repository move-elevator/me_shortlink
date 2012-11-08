<?php

namespace MoveElevator\MeShortlink\Utility;

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class GeneralUtility {

    /**
     * Get url from Shortlink
     * @param \MoveElevator\MeShortlink\Domain\Model\Shortlink
     * @return string
     */
    public static function getRedirectUrl($shortLink) {
	if ($shortLink->getPage() != '') {
	    $url = self::getInternalUrl($shortLink);
	} else if ($shortLink->getUrl()) {
	    $url = $shortLink->getUrl();
	}
	return $url;
    }

    /**
     * Get Speaking path from RealUrl Extension
     * @param integer $pid
     * @param array $params
     * @return void
     */
    protected function getSpeakingUrlFromRealUrl($pid, $params = array()) {
	$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_pageSelect');
	$GLOBALS['TSFE']->tmpl = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_TStemplate');
	$GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;

	$pageRow = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('*', 'pages', 'uid = ' . (int) $pid);
	if ($pageRow) {
	    $conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pageRow, '', 0, 'index.php', '', \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $params));
	}

	$realUrl = new \tx_realurl();
	$realUrl->encodeSpURL($conf, $this);
	$url = $conf['LD']['totalURL'];
	return $url;
    }

    /**
     * Returns full URL of internal Page with optinal Params
     * @param string $shortlinkParams
     * @return array
     */
    public function getInternalUrl($shortLink) {
	if (ExtensionManagementUtility::isLoaded('realurl')) {
	    $realUrlParams = \TYPO3\CMS\Core\Utility\GeneralUtility::explodeUrl2Array($shortLink->getParams());
	    $url = self::getSpeakingUrlFromRealUrl($shortLink->getPage(), $realUrlParams);
	} else {
	    $url = 'index.php?id=' . $shortLink->getPage() . $shortLink->getParams();
	}
	return \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($url);
    }

}

?>
