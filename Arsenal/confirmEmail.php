<?php
if ((isset($_GET['mail'])) && (isset($_GET['hash'])))
{
	$email = $_GET['mail'];
	$hash = $_GET['hash'];
	include 'func/config_sql.php';
	if (mysql_query("UPDATE users SET email='$email' WHERE `hash`= '$hash'"))
	{
		$page_name='ConfirmEmailT';
	}
}	
else 
{
	$page_name='ConfirmEmailF';
}
session_start();
include 'func/functions.php';
$_SESSION['page']='main.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
