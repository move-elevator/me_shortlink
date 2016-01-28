<?php

namespace MoveElevator\MeShortlink\Utility;

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Class ShortlinkUtility
 *
 * @package MoveElevator\MeShortlink\Utility
 */
class ShortlinkUtility {
	const PAGETYPE_TO_GET_TYPOSCRIPT = 0;

	/**
	 * Check if the url has a valid shortlink part
	 *
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
	 *
	 * @param array $shortLink
	 * @return string
	 */
	public static function getRedirectUrlFromShortlink(array $shortLink) {
		if (intval($shortLink['page']) > 0) {
			$url = self::getInternalUrlFromShortlink($shortLink);
		} else {
			$url = $shortLink['url'];
		}

		return $url;
	}

	/**
	 * Returns full URL of internal Page with optinal Params
	 *
	 * @param array $shortLink
	 * @return string
	 */
	public static function getInternalUrlFromShortlink(array $shortLink) {
		self::initTsfe(intval($shortLink['page']));

		$shortLinkPage = $shortLink['page'];
		$shortLinkParams = GeneralUtility::explodeUrl2Array($shortLink['params']);
		$url = $GLOBALS['TSFE']->cObj->getTypoLink_URL($shortLink['page']);

		return GeneralUtility::locationHeaderUrl($url);
	}

	/**
	 * Get Speaking path from RealUrl Extension
	 *
	 * @param integer $pid
	 * @param array $params
	 * @return array
	 */
	public static function getSpeakingUrlFromRealUrl($pid, $params = array()) {
		//init page object to get realUrl configuration
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$GLOBALS['TSFE'] = new \stdClass();
		$GLOBALS['TSFE']->sys_page = $objectManager->get('TYPO3\CMS\Frontend\Page\PageRepository');
		$GLOBALS['TSFE']->tmpl = $objectManager->get('TYPO3\CMS\Core\TypoScript\TemplateService');
		$GLOBALS['TSFE']->csConvObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Charset\\CharsetConverter');
		$GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;

		$pageRow = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('*', 'pages', 'uid = ' . (int)$pid);

		if ($pageRow) {
			$conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData(
				$pageRow, '', 0, 'index.php', '', GeneralUtility::implodeArrayForUrl('', $params)
			);
		}

		/** @var \tx_realurl $realUrl */
		$realUrl = GeneralUtility::makeInstance('tx_realurl');
		$realUrl->encodeSpURL($conf);

		$url = 'index.php?id=' . $pid;

		if (is_array($conf) && isset($conf['LD'])) {
			$url = $conf['LD']['totalURL'];
			if ($url === '') {
				$url = $conf['LD']['url'];
			}
		}

		unset($GLOBALS['TSFE']);

		return $url;
	}

	/**
	 * @return void
	 */
	protected static function initTsfe($pageId) {
		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

		$GLOBALS['TSFE'] = $objectManager->get(
			'TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController',
			$GLOBALS['TYPO3_CONF_VARS'],
			$pageId,
			self::PAGETYPE_TO_GET_TYPOSCRIPT
		);

		$GLOBALS['TSFE']->initFEuser();
		$GLOBALS['TSFE']->initTemplate();
		\TYPO3\CMS\Core\Core\Bootstrap::getInstance()->loadCachedTca();
		$GLOBALS['TSFE']->fetch_the_id();
		$GLOBALS['TSFE']->getConfigArray();
		$GLOBALS['TSFE']->cObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
	}
}