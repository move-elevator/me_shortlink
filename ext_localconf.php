<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, '');


if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('extbase')) {
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/index_ts.php']['preBeUser'][] =
        'MoveElevator\MeShortlink\Service\ShortlinkService->init';
    $TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_meshortlink_domain_model_shortlink'][0] = array(
        'fList' => 'title,page,params,url',
        'icon' => true
    );
    $TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_meshortlink_domain_model_domain'][0] = array(
        'fList' => 'name',
        'icon' => true
    );
    $TYPO3_CONF_VARS['SC_OPTIONS']['tce']['formevals']['tx_meshortlink_eval'] =
        'EXT:me_shortlink/Classes/Validation/BackendValidation.php';
}
