# Usage

```php
$air = new \Sdl\Airsoft\Airsoft();
$air->setClientId(<YOUR CLIENT ID>)
	->setPublicKey('<YOUR PUBLIC KEY>')
	->setPrivateKey('<YOUR PRIVATE KEY>')
	->setApiUrl('<API URL>')

;
```

Fill up with valid information from API holder


Here below the minimal expected data. But please fill as mas as possible

```php
$event = new \Sdl\Airsoft\Message\Event();

// Server works with Europe/Kiev time zone. So be sure you using same
$tz = new \DateTimeZone('Europe/Kiev');
$dateStart = new \DateTime('19.09.2021 12:00', $tz);
$dateEnd = new \DateTime('19.09.2021 16:00', $tz);

$event->setId(123)
	->setTitle('Test event')
	->setLocation('Somewhere')
	->setDateStart($dateStart)
	->setDateEnd($dateEnd)
;
```

Than execute request

```php
var_dump($air->addEvent($event));
```

If request succeed - you will receive:

```
array(1) {
  'success' =>
  bool(true)
}
```

In other case exception with error message will be raised.

Available cities:

| id | name |
| :--- | :--- |
| 1 | Киев |
| 2 | Одесса |
| 3 | Полтава |
| 4 | Запорожье |
| 5 | Днипро |
| 6 | Харьков |
| 7 | Новомосковск |
| 8 | Бровары |
| 9 | Борисполь |
| 10 | Житомир |
| 11 | Чернигов |
| 12 | Николаев |
| 13 | Винница |
| 14 | Тернополь |
| 15 | Луцк |
| 16 | Черкассы |
| 17 | Львов |

If city is not set - even will be global