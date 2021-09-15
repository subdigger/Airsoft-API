<?php


namespace Sdl\Airsoft\Message;


class Base implements \JsonSerializable {
	/**
	 * @var string
	 */
	protected $section;

	/**
	 * @return string
	 */
	public function getSection(): string {
		return $this->section;
	}

	/**
	 * Check if message is valid
	 */
	public function validate() {
		throw new \RuntimeException('Invalid message');
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		$result = get_object_vars($this);
		unset($result['section']);

		return $result;
	}
}