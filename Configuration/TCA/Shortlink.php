<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_meshortlink_domain_model_shortlink'] = array(
	'ctrl' => $TCA['tx_meshortlink_domain_model_shortlink']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden, title, page, url, params',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, title,page;;2;;3-3-3,url,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'params'),
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf'
				. ':tx_meshortlink_domain_model_shortlink.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'tx_meshortlink_eval,trim,required,alphanum_x,nospace',
				'max' => 30,
			),
		),
		'page' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf'
				. ':tx_meshortlink_domain_model_shortlink.page',
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
			'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf'
				. ':tx_meshortlink_domain_model_shortlink.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'params' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf'
				. ':tx_meshortlink_domain_model_shortlink.params',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);
