# DateAndTime
date time
___
### Initiating
##### Initiate by creating a new DateAndTime() object.
```php
__construct(string $date, string $timeZone = "Europe/Oslo");
```
___
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
___
| Parameter | Description |
|--|--|
| return string | Formatted as: (Stops at first match, in the order below). |
| | Years >= 1: y year(s) ago |
| | Months >= 1:
Days == 0: m month(s) ago
Days > 0: m month(s) d day(s) ago |
##### Example:
```php
$time = new DateAndTime("2017-06-16");
```
___


@return string - Formatted as: (Stops at first match, in the order below).
     *                                  - Years >= 1: y year(s) ago
     *                                  - Months >= 1:
     *                                        - Days == 0: m month(s) ago
     *                                        - Days > 0: m month(s) d day(s) ago
     *                                  - Days >= 1:
     *                                      - Days == 1: Yesterday
     *                                      - Days > 1 d days ago
     *                                  - Hours >= 1: h hour(s) ago
     *                                  - Minutes >= 1 i minute(s) ago
     *                                  - Seconds > 30: s seconds ago
     *                                  - Seconds <= 30: Just now
