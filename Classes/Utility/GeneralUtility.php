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
	    if (ExtensionManagementUtility::isLoaded('realurl')) {
		$paramsTemp = explode('&', $shortLink->getParams());
		$params = array();
		foreach ($paramsTemp as $param) {
		    $paramValue = explode('=', $param);
		    if (isset($paramValue[0]) && isset($paramValue[1]))
			$params[$paramValue[0]] = $paramValue[1];
		}
		$url = self::getSpeakingUrlFromRealUrl($shortLink->getPage(), $params);
	    } else {
		$url = 'index.php?id=' . $shortLink->getPage() . $shortLink->getParams();
	    }
	    $url = \TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($url);
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

	$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'uid = ' . (int) $pid);
	$pageRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
	if ($pageRow) {
	    $conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pageRow, '', 0, 'index.php', '', \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $params));
	}

	$realUrl = new \tx_realurl();
	$realUrl->encodeSpURL($conf, $this);
	$url = $conf['LD']['totalURL'];
	return $url;
    }
}

?>
