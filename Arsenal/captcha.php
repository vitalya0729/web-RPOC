<?php
	session_start();
	$string = "";
	for ($i = 0; $i < 5; $i++)
		$string .= chr(rand(97, 122));
	
	$_SESSION['rand_code'] = $string;

	$dir = "fonts/";
	$image = imagecreatetruecolor(170, 60);
	$black = imagecolorallocate($image, 0, 0, 0);
	$white = imagecolorallocate($image, 255, 255, 255);
	$color = imagecolorallocate($image, 200, 100, 90);


	imagefilledrectangle($image,0,0,399,99,$white);
	imagettftext ($image, 26, 10, 40, 50, $color, $dir."7fonts.ru_WildScriptpl.ttf", $_SESSION['rand_code']);
	header("Content-type: image/png");
	imagepng($image);
?>

