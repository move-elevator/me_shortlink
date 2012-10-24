<?php

function redirect() {
    $configuration = array(
	'extensionName' => 'MeShortlink',
	'pluginName' => 'Shortlink',
	'controller' => 'Shortlink',
	'vendorName' => 'MoveElevator',
	'action' => 'redirect',
	'settings' => array(),
	'mvc' => array(
	    'requestHandlers' => array(
		'Tx_Extbase_MVC_Web_FrontendRequestHandler' => 'Tx_Extbase_MVC_Web_FrontendRequestHandler'
	    )
	),
    );
    $GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
    //require 'typo3/sysext/core/Classes/Core/Bootstrap.php';
    $bootstrap = new Tx_Extbase_Core_Bootstrap();
    $bootstrap->run('', $configuration);
}

?>
