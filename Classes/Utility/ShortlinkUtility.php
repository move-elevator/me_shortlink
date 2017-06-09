<?php

namespace MoveElevator\MeShortlink\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class ShortlinkUtility
 *
 * @package MoveElevator\MeShortlink\Utility
 */
class ShortlinkUtility
{
    const PAGETYPE_TO_GET_TYPOSCRIPT = 0;

    /**
     * Check if the url has a valid shortlink part
     *
     * @param string $url
     * @return string|false
     */
    public static function getValidShortlink($url)
    {
        $parts = preg_split('/(\/)|(\.)/', $url, -1, PREG_SPLIT_NO_EMPTY);

        if (count($parts) > 1) {
            return false;
        }

        $lastPart = array_pop($parts);

        if (!preg_match('/^([a-zA-Z0-9-_]{3,30})$/', $lastPart)) {
            return false;
        }

        return $lastPart;
    }

    /**
     * Get url from shortlink
     *
     * @param array $shortLink
     * @return string
     */
    public static function getRedirectUrlFromShortlink(array $shortLink)
    {
        if (isset($shortLink['page']) && intval($shortLink['page']) > 0) {
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
    public static function getInternalUrlFromShortlink(array $shortLink)
    {
        self::initializeFrontendConfiguration(intval($shortLink['page']));

        $shortLinkPage = $shortLink['page'];
        $shortLinkParams = GeneralUtility::explodeUrl2Array($shortLink['params']);
        $shortLinkParams['L'] = $shortLink['sys_language_uid'];
        $url = $GLOBALS['TSFE']->cObj->getTypoLink_URL($shortLinkPage, $shortLinkParams);

        return GeneralUtility::locationHeaderUrl($url);
    }

    /**
     * @param int $pageId
     * @return void
     */
    protected static function initializeFrontendConfiguration($pageId)
    {
        if ($GLOBALS['TSFE']->cObj instanceof ContentObjectRenderer) {
            return;
        }

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
        Bootstrap::getInstance()->loadBaseTca();
        $GLOBALS['TSFE']->fetch_the_id();
        $GLOBALS['TSFE']->getConfigArray();
        $GLOBALS['TSFE']->cObj = $objectManager->get('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
    }
}
