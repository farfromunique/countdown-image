<?php
/*
header("Content-type: image/png");
try {
	$target = new DateTime($_GET['to']);
	$target_tz = $target->getTimezone();
	$now = new DateTime('now', $target_tz);
} catch (\Throwable $th) {
	$err = $th;
	$text = 'This was improperly configured';
}

$font = dirname(__FILE__) . '/OpenSans.ttf';

if (!isset($err)) {
	if ($now > $target) {
		$text = 'No time left';
	} else {
		$interval = $now->diff($target);
		switch ($interval->d) {
			case 0:
				$days_string = '';
				break;
			case 1:
				$days_string = $interval->d . ' day ';
				break;
			default:
				$days_string = $interval->d . ' days ';
				break;
		}
		switch ($interval->h) {
			case 0:
				$hours_string = '';
				break;
			case 1:
				$hours_string = $interval->h . ' hour ';
				break;
			default:
				$hours_string = $interval->h . ' hours ';
				break;
		}
		switch ($interval->i) {
			case 0:
				$minutes_string = '';
				break;
			case 1:
				$minutes_string = $interval->i . ' minute';
				break;
			default:
				$minutes_string = $interval->i . ' minutes';
				break;
		}
		$text = $days_string . $hours_string . $minutes_string . ' remiaing';
	}
}

$image = new Imagick();
$draw = new ImagickDraw();
$draw->setFillColor('white');
$draw->setStrokeAntialias(true);
$draw->setTextAntialias(true);
$draw->setFontSize(24);
// Set typeface
$draw->setFont($font);
// Calculate size
$metrics = $image->queryFontMetrics($draw, $text, FALSE);
$w = $metrics['textWidth'];
$h = $metrics['textHeight'];
$y = $metrics['ascender'];
$image->newImage($w * 1.1, $h * 1.1, 'black', "png");
$image->annotateImage($draw, 0, $y, 0, $text);
echo $image;
*/
$img = new Imagick();
$img->newImage(200, 200, new ImagickPixel('lime'));
$img->setImageFormat("png");
header("Content-Type: image/png");
echo $img;
