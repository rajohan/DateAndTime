# DateAndTime
date time
___
### Initiating
##### Initiate by creating a new DateAndTime() object.
```php
__construct(string $date, string $timeZone = "Europe/Oslo")
```
___
| Parameter | Description |
|--|--|
| string $date | Date/time to calculate difference from current date/time. Time is optional |
| | Format: Y-m-d H:i:s 2017-06-16 00:55:35 or d-m-Y H:i:s |
| string $timeZone | Optional: defaults to Europe/Oslo if nothing is passed in. |
##### Example:
```php
$time = new DateAndTime("2017-06-16");
```
___
