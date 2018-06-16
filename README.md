# DateAndTime
date time
___
### Initiating
##### Initiate by creating a new DateAndTime() object.
```php
__construct(string $date, string $timeZone = "Europe/Oslo");
```
| Parameter | Description |
|--|--|
| string $date | Date/time to calculate difference from current date/time. Time is optional |
| | Format: Y-m-d H:i:s 2017-06-16 00:55:35 or d-m-Y H:i:s |
| string $timeZone | Optional: defaults to Europe/Oslo if nothing is passed in. |
| | Supported time zones: http://php.net/manual/en/timezones.php |
##### Example:
```php
$time = new DateAndTime("2017-06-16");
```
___
### Get time frame
##### Get a formatted time frame.
```php
$time->getTimeFrame();
```
| Parameter | Description |
|--|--|
| return string | Formatted as: (Stops at first match, in the order below). |
| | Years >= 1: y year(s) ago |
| | Months >= 1: Days == 0: m month(s) ago OR Days > 0: m month(s) d day(s) ago |
| | Days >= 1: Days == 1: Yesterday OR Days > 1: d days ago |
| | Hours >= 1: h hour(s) ago |
| | Minutes >= 1 i minute(s) ago |
| | Seconds > 30: s seconds ago |
| | Seconds <= 30: Just now |
___
### Get time
##### Get the time difference.
```php
$time->getTime();
```
| Parameter | Description |
|--|--|
| return string | Example output: 1 year 11 months 29 days 21 hours 56 minutes 36 seconds. |
___
### Get years
##### Get the time difference in years.
```php
$time->getYears();
```
| Parameter | Description |
|--|--|
| return int | Example output: 1 |
___
### Get months
##### Get the time difference in months.
```php
$time->getMonths();
```
| Parameter | Description |
|--|--|
| return int | Example output: 12 |
___
### Get weeks
##### Get the time difference in weeks.
```php
$time->getWeeks();
```
| Parameter | Description |
|--|--|
| return int | Example output: 52 |
___
### Get days
##### Get the time difference in days.
```php
$time->getDays();
```
| Parameter | Description |
|--|--|
| return int | Example output: 365 |
___
### Get hours
##### Get the time difference in hours.
```php
$time->getHours();
```
| Parameter | Description |
|--|--|
| return int | Example output: 8765 |
___
### Get minutes
##### Get the time difference in minutes.
```php
$time->getMinutes();
```
| Parameter | Description |
|--|--|
| return int | Example output: 525900 |
___
### Get seconds
##### Get the time difference in seconds.
```php
$time->getMinutes();
```
| Parameter | Description |
|--|--|
| return int | Example output: 31554000 |
___
### Get milliseconds
##### Get the time difference in milliseconds.
```php
$time->getMilliseconds();
```
| Parameter | Description |
|--|--|
| return int | Example output: 31554000000 |
___
### Get microseconds
##### Get the time difference in microseconds.
```php
$time->getMicroseconds();
```
| Parameter | Description |
|--|--|
| return int | Example output: 31554000000000 |
___
### Get nanoseconds
##### Get the time difference in nanoseconds.
```php
$time->getNanoseconds();
```
| Parameter | Description |
|--|--|
| return int | Example output: 31554000000000000 |
___
