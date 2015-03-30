<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_meshortlink_domain_model_shortlink');
$TCA['tx_meshortlink_domain_model_shortlink'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:tx_meshortlink_domain_model_shortlink',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'versioningWS' => TRUE,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'searchFields' => 'title,page,url,params,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Shortlink.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_meshortlink_domain_model_shortlink.png'
	),
);

if (version_compare(TYPO3_branch, '6.1', '<')) {
	\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_meshortlink_domain_model_shortlink');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_meshortlink_domain_model_domain');
$TCA['tx_meshortlink_domain_model_domain'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:tx_meshortlink_domain_model_domain',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'versioningWS' => TRUE,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'searchFields' => 'name,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Domain.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_meshortlink_domain_model_domain.png'
	),
);

if (version_compare(TYPO3_branch, '6.1', '<')) {
	\TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA('tx_meshortlink_domain_model_domain');
}
