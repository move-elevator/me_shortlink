<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY);


if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('extbase')) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('MoveElevator.' . $_EXTKEY, 'Shortlink', array(
        'Shortlink' => 'redirect',
            ), array(
        'Shortlink' => 'redirect',
            )
    );
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] = 'MoveElevator\MeShortlink\Service\CheckAlternativeIdMethods->redirect';
    $TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_meshortlink_domain_model_shortlink'][0] = array(
        'fList' => 'title,page,params,url',
        'icon' => TRUE
    );
    $TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_meshortlink_domain_model_domain'][0] = array(
        'fList' => 'name',
        'icon' => TRUE
    );
    $TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_meshortlink_evalfunc'] = 'EXT:me_shortlink/Classes/Service/class.tx_meshortlink_evalfunc.php';
}
?>