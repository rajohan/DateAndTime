<?php
/**
 * MIT License
 *
 * Copyright (c) 2018. Raymond Johannessen
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Raymond Johannessen Webutvikling
 * https://rajohan.no
 */

declare(strict_types=1);

class DateAndTime
{
    private $timeZone;
    private $date;
    private $dateNow;
    private $interval;
    private $timeFrame;

    /**
     * DateAndTime constructor.
     *
     * @param string $date     - (Y-m-d H:i:s 2017-06-16 00:55:35) Date/time to calculate difference from current date/time
     *                            Time is optional. d-m-Y H:i:s format will also work as expected.
     */
    public function __construct(string $date, string $timeZone = "Europe/Oslo")
    {
        $this->timeZone = new DateTimeZone(date_default_timezone_get());
        $this->date = new DateTime($date, $this->timeZone);
        $this->dateNow = new DateTime("now", $this->timeZone);
        $this->interval = $this->date->diff($this->dateNow);
    }

    /**
     * Get a formatted time frame.
     *
     * @return string - Formatted as: (Stops at first match, in the order below).
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
     */
    public function getTimeFrame()
    {
        if ($this->interval->y >= 1) {
            $this->yearsFormatted();
        } else if ($this->interval->m >= 1) {
            $this->monthsFormatted();
        } else if ($this->interval->d >= 1) {
            $this->daysFormatted();
        } else if ($this->interval->h >= 1) {
            $this->hoursFormatted();
        } else if ($this->interval->i >= 1) {
            $this->minutesFormatted();
        } else {
            $this->secondsFormatted();
        }

        return $this->timeFrame;
    }

    /**
     * Get the time difference.
     *
     * @return string Formatted as: 1 year 11 months 29 days 21 hours 56 minutes 36 seconds.
     */
    public function getTime()
    {
        return $this->timeFormatted();
    }

    /**
     * @return int - Difference in years.
     */
    public function getYears()
    {
        return $this->interval->y;
    }

    /**
     * @return int - Difference in months.
     */
    public function getMonths()
    {
        return round($this->getDays() / 30);
    }

    /**
     * @return int - Difference in weeks.
     */
    public function getWeeks() {
        return round($this->getDays() / 7);
    }

    /**
     * @return int - Difference in days.
     */
    public function getDays()
    {
        return round($this->getHours() / 24);
    }

    /**
     * @return int - Difference in hours.
     */
    public function getHours() {
        return round($this->getMinutes() / 60);
    }

    /**
     * @return int - Difference in minutes.
     */
    public function getMinutes()
    {
        return round($this->getSeconds() / 60);
    }

    /**
     * @return int - Difference in seconds.
     */
    public function getSeconds()
    {
        return abs($this->dateNow->getTimestamp() - $this->date->getTimestamp());
    }

    /**
     * @return int - Difference in milliseconds.
     */
    public function getMilliseconds() {
        return $this->getSeconds() * 1000;
    }

    /**
     * @return int - Difference in microseconds.
     */
    public function getMicroseconds() {
        return $this->getMilliSeconds() * 1000;
    }

    /**
     * @return int - Difference in nanoseconds.
     */
    public function getNanoseconds() {
        return $this->getMicroSeconds() * 1000;
    }

    /**
     * Helper method to format year time frame.
     */
    private function yearsFormatted()
    {
        if ($this->interval->y === 1) {
            $this->timeFrame = $this->interval->y . " year ago";
        } else {
            $this->timeFrame = $this->interval->y . " years ago";
        }
    }

    /**
     * Helper method to format month time frame.
     */
    private function monthsFormatted()
    {
        if ($this->interval->d === 0) {
            $daysAgo = " ago";
        } else if ($this->interval->d === 1) {
            $daysAgo = $this->interval->d . " day ago";
        } else {
            $daysAgo = $this->interval->d . " days ago";
        }

        if ($this->interval->m === 1) {
            $this->timeFrame = $this->interval->m . " month " . $daysAgo;
        } else {
            $this->timeFrame = $this->interval->m . " months " . $daysAgo;
        }
    }

    /**
     * Helper method to format day time frame.
     */
    private function daysFormatted()
    {
        if ($this->interval->d === 1) {
            $this->timeFrame = "Yesterday";
        } else {
            $this->timeFrame = $this->interval->d . " days ago";
        }
    }

    /**
     * Helper method to format hour time frame.
     */
    private function hoursFormatted()
    {
        if ($this->interval->h === 1) {
            $this->timeFrame = $this->interval->h . " hour ago";
        } else {
            $this->timeFrame = $this->interval->h . " hours ago";
        }
    }

    /**
     * Helper method to format minutes time frame.
     */
    private function minutesFormatted()
    {
        if ($this->interval->i === 1) {
            $this->timeFrame = $this->interval->i . " minute ago";
        } else {
            $this->timeFrame = $this->interval->i . " minutes ago";
        }
    }

    /**
     * Helper method to format seconds time frame.
     */
    private function secondsFormatted()
    {
        if ($this->interval->s <= 30) {
            $this->timeFrame = "Just now";
        } else {
            $this->timeFrame = $this->interval->s . " seconds ago";
        }
    }

    /**
     * Helper method to format date and time.
     *
     * @return string - Formatted date and time.
     */
    private function timeFormatted()
    {
        $years = $months = $days = $hours = $minutes = $seconds = "";

        if($this->interval->y !== 0) {
            $years = $this->interval->y;
            $years .= $this->interval->y > 1 ? " years " : " year ";
        }

        if($this->interval->m !== 0) {
            $months = $this->interval->m;
            $months .= $this->interval->m > 1 ? " months " : " month ";
        }

        if($this->interval->d !== 0) {
            $days = $this->interval->d;
            $days .= $this->interval->d > 1 ? " days " : " day ";
        }

        if($this->interval->h !== 0) {
            $hours = $this->interval->h;
            $hours .= $this->interval->h > 1 ? " hours " : " hour ";
        }

        if($this->interval->i !== 0) {
            $minutes = $this->interval->i;
            $minutes .= $this->interval->i > 1 ? " minutes " : " minute ";
        }

        if($this->interval->s !== 0) {
            $seconds = $this->interval->s;
            $seconds .= $this->interval->s > 1 ? " seconds " : " second ";
        }

        return $years . $months . $days . $hours . $minutes . $seconds;
    }
}
