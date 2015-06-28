<?php

	require "vendor/autoload.php";

	use Calendar\Calendar\Calendar;

	$year 		= date('Y');
	$firstDay 	= 1;

	$months = array(1,2,3,4,5,6,7,8,9,10,11,12);

	if(isset($_GET['year']) and isset($_GET['day'])) {
		$year 		= $_GET['year'];
		$firstDay	= $_GET['day'];
	}

	$calendar = new Calendar($year);

?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Calendar</title>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron text-center">
					<h1>Calendar</h1>
					<p>
						<strong>Solaiman Mansyur</strong><br/>
						solaiman.mansyur@gmailcom
					</p>
				</div>
			</div>
		</div>

		<div class="row">
			<form method="GET" action="">
				<div class="col-lg-4 col-lg-offset-2">
					<input type="number" class="form-control" name="year" min="1818" ma="2020" placeholder="Select year" value="<?php echo isset($year) ? $year : "" ?>">
				</div>
				<div class="col-lg-4">
					<select class="form-control" name="day">
						<option value="0" <?php echo $firstDay == 0 ? 'selected' : ''; ?>>Sunday</option>
						<option value="1" <?php echo $firstDay == 1 ? 'selected' : ''; ?>>Monday</option>
						<option value="2" <?php echo $firstDay == 2 ? 'selected' : ''; ?>>Tuesday</option>
						<option value="3" <?php echo $firstDay == 3 ? 'selected' : ''; ?>>Wednesday</option>
						<option value="4" <?php echo $firstDay == 4 ? 'selected' : ''; ?>>Thursday</option>
						<option value="5" <?php echo $firstDay == 5 ? 'selected' : ''; ?>>Friday</option>
						<option value="6" <?php echo $firstDay == 6 ? 'selected' : ''; ?>>Saturday</option>
					</select>
				</div>
				<div class="col-lg-2">
					<input type="submit" class="btn btn-primary" name="submit" value="Submit">
				</div>
			</form>
		</div>

		<hr/>

			<h1 class="text-danger text-center"><?php echo $year ?></h1>

		<hr/>

		<?php foreach(array_chunk($months,3) as $rows) { ?>
			<div class="row">
			<?php foreach($rows as $month) { ?>
				<div class="col-lg-4">
					<div class="well text-center text-primary"><?php echo $calendar->showMonth($month) ?></div>
					<table class="table table-bordered">
						<?php echo $calendar->generateCalendarHeader($firstDay); ?>
						<?php echo $calendar->generateCalendarContent($month, $firstDay); ?>
					</table>
				</div>
			<?php } ?>
			</div>
		<?php } ?>

	</div>
</body>
</html>
