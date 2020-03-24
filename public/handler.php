<?php

return function ($event)
{
	header("Content-type: image/png");

	try {
		$target = new DateTime($event['to']);
		$target_tz = $target->getTimezone();
		$now = new DateTime('now', $target_tz);
	} catch (\Throwable $th) {
		$err = $th;
		$text = 'This was improperly configured';
	}

	require_once('../calculateTextBox.php');
	putenv('GDFONTPATH=' . realpath('.'));
	$font = dirname(__FILE__) . '/OpenSans.ttf';

	if (!$err) {
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

	$size = calculateTextBox(14, 0, $font, $text);

	$width = max(300, $size['width'] * 1.1);
	$height = $size['height'] * 1.3;

	$x_pos = ($width - $size['width']) / 2;


	$image = imagecreatetruecolor($width, $height);
	// set up colors
	$white = imageColorAllocate($image, 255, 255, 255);

	imagettftext($image, 14, 0, $x_pos, $size['height'], $white, $font, $text);

	imagepng($image);
	imageDestroy($image);
}
