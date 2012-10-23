<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('MoveElevator.' . $_EXTKEY, 'Shortlink', array(
    'Shortlink' => 'redirect',
	),
	// non-cacheable actions
	array(
    'Shortlink' => 'redirect',
	)
);

//$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = "tx_meshortlink_shortlink->redirect";


$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = "MoveElevator\MeShortlink\Controller\ShortlinkController->redirectAction";
?>