<?php

namespace MoveElevator\MeShortlink\Service;

/**
 * Class GoogleAnalyticsTracking
 *
 * @package MoveElevator\MeShortlink\Service
 */
class GoogleAnalyticsTracking {

	/**
	 * @var array
	 */
	protected $configuration;

	/**
	 * @var array
	 */
	protected $trackingFields;

	const GOOGLE_ANALYTICS_HOSTNAME = 'http://www.google-analytics.com/collect';

	/**
	 * @param array $configuration
	 */
	public function __construct(array $configuration) {
		$this->configuration = $configuration;

	}

	/**
	 * @return string|bool
	 */
	public function trackPageView() {
		if ($this->configuration['trackingEnabled'] !== '1') {
			return TRUE;
		}

		$this->setTrackingFieldsByServerGlobals();
		if (is_callable('curl_init') && (bool)$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse']) {
			return $this->sendCurlRequest();
		}

		global $BE_USER;
		$BE_USER->simplelog('There is no curl to track page view', 'MeShortlink');

		return FALSE;
	}

	/**
	 * @return string|bool
	 */
	protected function sendCurlRequest() {
		$fieldsRequestData = '';
		foreach ($this->trackingFields as $key => $value) {
			$fieldsRequestData .= $key . '=' . $value . '&';
			rtrim($fieldsRequestData, '&');
		}
		$curlSession = curl_init();
		curl_setopt($curlSession, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curlSession, CURLOPT_URL, self::GOOGLE_ANALYTICS_HOSTNAME);
		curl_setopt($curlSession, CURLOPT_POST, count($this->trackingFields));
		curl_setopt($curlSession, CURLOPT_POSTFIELDS, $fieldsRequestData);
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
		if (
			isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer'])
			&& strlen(trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer'])) > 0
		) {
			curl_setopt($curlSession, CURLOPT_PROXY, trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlProxyServer']));
		}
		$result = curl_exec($curlSession);

		curl_close($curlSession);

		return $result;
	}

	/**
	 * @return array
	 */
	public function setTrackingFieldsByServerGlobals() {
		$this->trackingFields = array(
			'v' => 1,
			'tid' => $this->configuration['trackingId'],
			'cid' => $this->createUniversallyUniqueIdentifierV4(),
			't' => 'event',
			'aip' => 1,
			'ec' => 'Shortlink',
			'ea' => 'Shortlink',
			'el' => 'Shortlink: ' . $_SERVER['REDIRECT_URL'],
			'ev' => 1
		);

	}

	/**
	 * Generates version 4 UUID: random
	 *
	 * @return bool|string
	 */
	protected function createUniversallyUniqueIdentifierV4() {
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff),

			// 16 bits for "time_mid"
			mt_rand(0, 0xffff),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand(0, 0x0fff) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand(0, 0x3fff) | 0x8000,

			// 48 bits for "node"
			mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
		);
	}
}
