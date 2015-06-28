<?php

namespace Calendar\Calendar;

/**
* Class Calendar
*/
class Calendar
{

	function __construct($year = 2015) {

		$this->year 		= $year;
		$this->daysOfWeek 	= array('S','M','T','W','T','F','S');
	}

	/**
	 * Function to get number of days within given month and year
	 * Reference : http://php.net/manual/en/function.cal-days-in-month.php
	 */
	public function daysInMonth($month) {

		return $month == 2 ? ($this->year % 4 ? 28 : ($this->year % 100 ? 29 : ($this->year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 

	}

	/**
	 * Set the days of week according to the fist day given by user
	 */
	public function setDaysOfWeek($first) {
		switch ($first) {
			case '0': return array('S','M','T','W','T','F','S'); break;

			case '1': return array('M','T','W','T','F','S', 'S'); break;

			case '2': return array('T','W','T','F','S','S','M'); break;

			case '3': return array('W','T','F','S','S','M','T'); break;

			case '4': return array('T','F','S','S','M','T','W'); break;

			case '5': return array('F','S','S','M','T','W','T'); break;

			case '6': return array('S','S','M','T','W','T','F'); break;
		}
	}

	/**
	 * Showing name of month according to 
	 */
	public function showMonth($month) {
		switch ($month) {
			case '1': return 'January'; break;

			case '2': return 'February'; break;

			case '3': return 'March'; break;

			case '4': return 'April'; break;

			case '5': return 'May'; break;

			case '6': return 'June'; break;

			case '7': return 'July'; break;

			case '8': return 'August'; break;

			case '9': return 'September'; break;

			case '10': return 'October'; break;

			case '11': return 'November'; break;

			case '12': return 'December'; break;
		}
	}

	public function generateCalendarHeader($firstDay) {

		$this->daysOfWeek = $this->setDaysOfWeek($firstDay);

		$head = "<tr>";
		foreach ($this->daysOfWeek as $day) {
				$head .= "<th class='text-center'>". $day ."</th>";
		}

		$head .= "</tr>";

		return $head;

	}

	public function generateCalendarContent($month, $firstDay) {
		
		$daysInMonth 		= $this->daysInMonth($month);
		$firstDayOfMonth 	= mktime(0,0,0,$month,1,$this->year);
		$dayCounter 		= 1;
		$dateContainer 		= getdate($firstDayOfMonth);
		$dayOfWeek 			= $dateContainer['wday'];

		$dayOfWeek 			-= $firstDay;

		if($dayOfWeek < 0) {
			$dayOfWeek += 6;
		}

		$contents 			= "<tr>";

		if($dayOfWeek > 0) {
			$contents  		.= "<td colspan='$dayOfWeek'>&nbsp;</td>";
		}

		while ($dayCounter <= $daysInMonth) {

			if($dayOfWeek 	== 7) {
				$dayOfWeek 	= 0;
				$contents 	.= "</tr><tr>";
			}

			$contents 		.= "<td>$dayCounter</td>";

			$dayOfWeek++;
			$dayCounter++;
		}

		if($dayOfWeek != 7) {
			$remainingDays 	= 7 - $dayOfWeek;
			$contents		.= "<td colspan='$remainingDays'>&nbsp;</td>"; 
		}

		return $contents;
		

	}

	private function getLastDayOfWeek($firstDay) {
		$lastDay = $firstDay - 1;

		if($lastDay < 0) {
			$lastDay = 6;
		}

		return $lastDay;
	}
}
