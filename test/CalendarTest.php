<?php

use Calendar\Calendar\Calendar;

class CalendarTest extends PHPUnit_Framework_TestCase {

    public function testDaysInMonth() {
    	$cal = new Calendar();

    	$this->assertEquals(31, $cal->daysInMonth(1,2015));
    }

    public function testShowingNameOfMonth() {
    	$cal = new Calendar();

    	$this->assertEquals("June", $cal->showMonth(6));
    }
}
