<?php

namespace Sdl\Airsoft\Message;

class Event extends Base {
	protected $section = 'event';
	/**
	 * @var int
	 */
	protected $id;
	/**
	 * @var string
	 */
	protected $title;
	/**
	 * @var string
	 */
	protected $location;
	/**
	 * @var string
	 */
	protected $orgName;
	/**
	 * @var string
	 */
	protected $type;
	/**
	 * @var string
	 */
	protected $rule;
	/**
	 * @var \DateTime
	 */
	protected $dateStart;
	/**
	 * @var \DateTime
	 */
	protected $dateEnd;
	/**
	 * @var int
	 */
	protected $cityId;
	/**
	 * @var string
	 */
	protected $polygon;
	/**
	 * @var string
	 */
	protected $message;

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return Event
	 */
	public function setId(int $id): Event {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Event
	 */
	public function setTitle(string $title): Event {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLocation(): string {
		return $this->location;
	}

	/**
	 * @param string $location
	 *
	 * @return Event
	 */
	public function setLocation(string $location): Event {
		$this->location = $location;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrgName(): string {
		return $this->orgName;
	}

	/**
	 * @param string $orgName
	 *
	 * @return Event
	 */
	public function setOrgName(string $orgName): Event {
		$this->orgName = $orgName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @param string $type
	 *
	 * @return Event
	 */
	public function setType(string $type): Event {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRule(): string {
		return $this->rule;
	}

	/**
	 * @param string $rule
	 *
	 * @return Event
	 */
	public function setRule(string $rule): Event {
		$this->rule = $rule;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateStart(): \DateTime {
		return $this->dateStart;
	}

	/**
	 * @param \DateTime $dateStart
	 *
	 * @return Event
	 */
	public function setDateStart(\DateTime $dateStart): Event {
		$this->dateStart = $dateStart;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateEnd(): \DateTime {
		return $this->dateEnd;
	}

	/**
	 * @param \DateTime $dateEnd
	 *
	 * @return Event
	 */
	public function setDateEnd(\DateTime $dateEnd): Event {
		$this->dateEnd = $dateEnd;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getCityId(): int {
		return $this->cityId;
	}

	/**
	 * @param int $cityId
	 *
	 * @return Event
	 */
	public function setCityId(int $cityId): Event {
		$this->cityId = $cityId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPolygon(): string {
		return $this->polygon;
	}

	/**
	 * @param string $polygon
	 *
	 * @return Event
	 */
	public function setPolygon(string $polygon): Event {
		$this->polygon = $polygon;

		return $this;
	}

	/**
	 * @param string $message
	 */
	public function setMessage(string $message): void {
		$this->message = $message;
	}

	public function validate() {
		if ($this->getId() < 1) {
			throw new \RuntimeException('Event ID is empty');
		}

		if (!$this->getTitle()) {
			throw new \RuntimeException('Event Title is empty');
		}

		if (!$this->getLocation()) {
			throw new \RuntimeException('Event Location is empty');
		}

		if (!$this->getDateStart()) {
			throw new \RuntimeException('Invalid start date');
		}

		if (!$this->getDateEnd()) {
			throw new \RuntimeException('Invalid end date');
		}

	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		$result = parent::jsonSerialize();

		$result['dateStart'] = $this->getDateStart()->format('d.m.Y H:i');
		$result['dateEnd'] = $this->getDateEnd()->format('d.m.Y H:i');

		return $result;
	}

}