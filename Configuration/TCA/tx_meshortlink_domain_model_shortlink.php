<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tx_meshortlink_domain_model_shortlink'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:me_shortlink/Resources/Private/Language/' .
            'locallang_db.xlf:tx_meshortlink_domain_model_shortlink',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'versioningWS' => true,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'searchFields' => 'title,page,url,params,',
        'dynamicConfigFile' =>
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('me_shortlink') .
            'Configuration/TCA/Shortlink.php',
        'iconfile' => 'EXT:me_shortlink/Resources/Public/Icons/tx_meshortlink_domain_model_shortlink.png',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l18n_parent',
        'transOrigDiffSourceField' => 'l18n_diffsource'
    ),
    'interface' => array(
        'showRecordFieldList' => 'hidden, title, page, url, params',
    ),
    'types' => array(
        '1' => array('showitem' => 'hidden,sys_language_uid;;1;;3-3-3;;1, title,page;;2;;3-3-3,url,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
        '2' => array('showitem' => 'params'),
    ),
    'columns' => array(
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => '30',
                'max' => '30',
            )
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
            ),
        ),
        'title' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/' .
                'locallang_db.xlf:tx_meshortlink_domain_model_shortlink.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'tx_meshortlink_eval,trim,required,alphanum_x,nospace',
                'max' => 30,
            ),
        ),
        'page' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/' .
                'locallang_db.xlf:tx_meshortlink_domain_model_shortlink.page',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 1,
                'maxitems' => 1,
            ),
        ),
        'url' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/' .
                'locallang_db.xlf:tx_meshortlink_domain_model_shortlink.url',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'params' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/' .
                'locallang_db.xlf:tx_meshortlink_domain_model_shortlink.params',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'sys_language_uid'=> array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
                    array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
                )
            )
        ),
        'l18n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => array(
                'type' =>'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array('', 0),
                ),
                'foreign_table' =>'tx_meshortlink_domain_model_shortlink',
                'foreign_table_where' =>
                    'AND tx_meshortlink_domain_model_shortlink.uid=###CURRENT_PID### ' .
                    'AND tx_meshortlink_domain_model_shortlink.sys_language_uid IN (-1,0)',
            )
        ),
        'l18n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough'
            )
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_meshortlink_domain_model_shortlink');
