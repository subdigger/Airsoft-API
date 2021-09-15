<?php

namespace Sdl\Airsoft;

use Sdl\Airsoft\Message\Base;
use Sdl\Airsoft\Message\Event;

class Airsoft {
	/**
	 * @var string
	 */
	protected $apiUrl = '';
	/**
	 * @var string
	 */
	protected $privateKey = '';
	/**
	 * @var string
	 */
	protected $publicKey = '';
	/**
	 * @var int
	 */
	protected $clientId;
	/**
	 * @var int
	 */
	protected $requestId = 1;

	/**
	 * @return string
	 */
	public function getApiUrl(): string {
		return $this->apiUrl;
	}

	/**
	 * @param string $apiUrl
	 *
	 * @return Airsoft
	 */
	public function setApiUrl(string $apiUrl): Airsoft {
		$this->apiUrl = $apiUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPrivateKey(): string {
		return $this->privateKey;
	}

	/**
	 * @param string $privateKey
	 *
	 * @return Airsoft
	 */
	public function setPrivateKey(string $privateKey): Airsoft {
		$this->privateKey = $privateKey;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPublicKey(): string {
		return $this->publicKey;
	}

	/**
	 * @param string $publicKey
	 *
	 * @return Airsoft
	 */
	public function setPublicKey(string $publicKey): Airsoft {
		$this->publicKey = $publicKey;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getClientId(): int {
		return $this->clientId;
	}

	/**
	 * @param int $clientId
	 *
	 * @return Airsoft
	 */
	public function setClientId(int $clientId): Airsoft {
		$this->clientId = $clientId;

		return $this;
	}

	/**
	 * Add new or replace existing event with specified ID
	 *
	 * @param Event $event
	 *
	 * @return bool|string
	 */
	public function addEvent(Event $event) {
		return $this->request('event/add', $event);
	}
	
	protected function request(string $action, Base $message = null) {
		$ch = curl_init();

		$url = $this->apiUrl . '/' . $action;

		$request = [
			'clientId' => $this->clientId,
			'requestId' => $this->requestId++,
			'date' => time(),
			'sign' => '',
		];

		$request['sign'] = hash('sha256', $request['clientId'] . '|' . $request['requestId'] . '|' . $request['date'] . '|' . $this->privateKey);

		if ($message) {
			$message->validate();

			$request[$message->getSection()] = $message;
		}

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'X-Auth: ' . $this->publicKey,
		]);
		$response = curl_exec($ch);

		curl_close($ch);

		$result = json_decode($response, true);

		if (empty($result['success'])) {
			throw new \RuntimeException(!empty($result['message']) ? $result['message'] : 'Unknown error: ' . $response);
		}

		return $result;
	}
}