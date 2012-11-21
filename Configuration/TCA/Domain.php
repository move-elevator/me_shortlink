<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_meshortlink_domain_model_domain'] = array(
    'ctrl' => $TCA['tx_meshortlink_domain_model_domain']['ctrl'],
    'interface' => array(
	'showRecordFieldList' => 'hidden, name',
    ),
    'types' => array(
	'1' => array('showitem' => 'hidden;;1, name,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
	'1' => array('showitem' => ''),
    ),
    'columns' => array(
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
	'name' => array(
	    'exclude' => 0,
	    'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:tx_meshortlink_domain_model_domain.name',
	    'config' => array(
		'type' => 'input',
		'size' => 30,
		'eval' => 'trim,required,unique'
	    ),
	),
    ),
);
?>