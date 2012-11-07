<?php

namespace MoveElevator\MeShortlink\Service;

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
	$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
	$bootstrap = new \TYPO3\CMS\Extbase\Core\Bootstrap();
	$bootstrap->run('', $configuration);
    }

}

?>
