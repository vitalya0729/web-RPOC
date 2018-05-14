<?php
function replaceErrorContent()
{
	if (isset($_SESSION['error']))
	{
		$str=$_SESSION['error'];
		unset($_SESSION['error']);
		return  $str;
	}
	return '';
}
