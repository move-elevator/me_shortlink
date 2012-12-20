<?php

namespace MoveElevator\MeShortlink\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Core\Bootstrap;

/**
 * Shortlink Redirect Hook
 * Calls the ShortlinkController->redirectAction
 */

class CheckAlternativeIdMethods {
    public function redirect() {
        $configuration = array(
            'extensionName' => 'MeShortlink',
            'pluginName' => 'Shortlink',
            'controller' => 'Shortlink',
            'vendorName' => 'MoveElevator',
            'action' => 'redirect',
            'settings' => array(),
            'mvc' => array(
                'requestHandlers' => array(
                    'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler' => 'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler'
                )
            ),
        );
        $GLOBALS['TSFE']->sys_page = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $bootstrap = new Bootstrap();
        
        $bootstrap->run('', $configuration);
    }

}

?>