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
		if ($this->configuration['trackingEnabled'] === '1') {
			$this->setTrackingFieldsByServerGlobals();
			if (is_callable('curl_init')) {
				return $this->sendCurlRequest();
			}
		}

		return NULL;
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
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_URL, self::GOOGLE_ANALYTICS_HOSTNAME);
		curl_setopt($ch, CURLOPT_POST, count($this->trackingFields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsRequestData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);

		curl_close($ch);

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