<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY);


if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('extbase')) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('MoveElevator.' . $_EXTKEY, 'Shortlink', array(
	'Shortlink' => 'redirect',
	    ),
	    // non-cacheable actions
	    array(
	'Shortlink' => 'redirect',
	    )
    );
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = 'MoveElevator\MeShortlink\Service\CheckAlternativeIdMethods->redirect';
}
?>