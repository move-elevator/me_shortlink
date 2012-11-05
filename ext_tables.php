<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('extbase')) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($_EXTKEY, 'Shortlink', 'Shortlink');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'm:e Shortlink Manager');

t3lib_extMgm::addLLrefForTCAdescr('tx_meshortlink_domain_model_shortlink', 'EXT:me_shortlink/Resources/Private/Language/locallang_csh_tx_meshortlink_domain_model_shortlink.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_meshortlink_domain_model_shortlink');
$TCA['tx_meshortlink_domain_model_shortlink'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:tx_meshortlink_domain_model_shortlink',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,page,url,params,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Shortlink.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_meshortlink_domain_model_shortlink.png'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_meshortlink_domain_model_domain', 'EXT:me_shortlink/Resources/Private/Language/locallang_csh_tx_meshortlink_domain_model_domain.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_meshortlink_domain_model_domain');
$TCA['tx_meshortlink_domain_model_domain'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:me_shortlink/Resources/Private/Language/locallang_db.xlf:tx_meshortlink_domain_model_domain',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Domain.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_meshortlink_domain_model_domain.png'
	),
);

?>