<?php

namespace MoveElevator\MeShortlink\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Core\Bootstrap;

/**
 * Shortlink Redirect Hook
 * Calls the ShortlinkController->redirectAction
 */
class CheckAlternativeIdMethods {

	/**
	 * Redirect to ShortlinkController->redirectAction()
	 * and intialize sys_page by preBeUser Hook
	 *
	 * @return void
	 */
	public function redirect() {
		$configuration = array(
			'extensionName' => 'MeShortlink',
			'pluginName' => 'Shortlink',
			'controller' => 'Shortlink',
			'vendorName' => 'MoveElevator',
			'action' => 'redirect',
			'settings' => array(),
			'mvc' => array(
				'requestHandlers' => array(
					'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler' => 'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler'
				)
			),
		);
		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$GLOBALS['TSFE']->sys_page = $objectManager->get('TYPO3\CMS\Frontend\Page\PageRepository');
		$bootstrap = new Bootstrap();

		$bootstrap->run('', $configuration);
	}

}

?>