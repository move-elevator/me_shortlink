<?php

namespace MoveElevator\MeShortlink\Controller;

/**
 * @author Sascha Seyfert <sef@move-elevator.de>
 * @package me_shortlink
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ShortlinkController extends \TYPO3\CMS\Extbase\MVC\Controller\ActionController
{
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

    /**
     * action redirect
     *
     * @return void
     */
    public function redirectAction()
    {
        $requestUri = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
        $httpHost = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';

        $linkPath = pathinfo($httpHost . $requestUri);
        $shortLinkToCheck = isset($linkPath['filename']) ? $linkPath['filename'] : '';

        $shortLinks = $this->shortlinkRepository->findByRequest($shortLinkToCheck);

        $domains = $this->domainRepository->findByName($httpHost);
        $domain = $domains->current();

        if (is_object($shortLinks)) {
            foreach ($shortLinks as $shortLink) {
                if ($domain) {
                    if ($domain->getPid() != $shortLink->getPid()) {
                        continue;
                    }
                }

                if ($shortLink->getPage() != '') {
                    if (\TYPO3\CMS\Core\Extension\ExtensionManager::isLoaded('realurl')) {
                        $paramsTemp = explode('&', $shortLink->getParams());
                        $params = array();
                        foreach ($paramsTemp as $param) {
                            $paramValue = explode('=', $param);
                            if (isset($paramValue[0]) && isset($paramValue[1]))
                                $params[$paramValue[0]] = $paramValue[1];
                        }
                        $url = $this->getSpeakingUrlFromRealUrl($shortLink->getPage(), $params);

                    } else {
                        $url = 'index.php?id=' . $shortLink->getPage() . $shortLink->getParams();
                    }
                    $this->redirectToPage(\TYPO3\CMS\Core\Utility\GeneralUtility::locationHeaderUrl($url));
                } else if ($shortLink->getUrl()) {
                    $this->redirectToPage($shortLink->getUrl());
                }
            }
        }
    }

    protected function redirectToPage($url)
    {

        header("HTTP/1.0 301 Moved Permanently");
        header("Status: 301 Moved Permanently");
        header("Location: " . $url, true, 301);
        exit;
    }

    protected function getSpeakingUrlFromRealUrl($pid, $params = array())
    {
        $realUrl = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tx_realurl');
        $GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_pageSelect');
        $GLOBALS['TSFE']->tmpl = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_TStemplate');
        $GLOBALS['TSFE']->config['config']['tx_realurl_enable'] = 1;
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'pages', 'uid = ' . (int)$pid);
        $pageRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
        $conf['LD'] = $GLOBALS['TSFE']->tmpl->linkData($pageRow, '', 0, 'index.php', '', \TYPO3\CMS\Core\Utility\GeneralUtility::implodeArrayForUrl('', $params));
        $realUrl->encodeSpURL($conf, $this);
        $url = $conf['LD']['totalURL'];
        return $url;
    }

}

?>