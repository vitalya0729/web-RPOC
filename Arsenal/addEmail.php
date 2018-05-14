<?php
session_start();
include 'func/functions.php';
if (!(empty($_POST['mail'])))
{	
	$login = $_SESSION['user'];
	header('Content-Type: text/html; charset=utf-8');
	$hash = md5($_POST['mail']);
	include 'func/config_sql.php';
	mysql_query("UPDATE users SET hash='$hash' WHERE `login`= '$login'");
	$to = $_POST['mail'];
	$subject = file_get_contents("tpl/mailSubject.tpl");
	$message = file_get_contents("tpl/mailContent.tpl");
	$header = file_get_contents("tpl/mailHeader.tpl");
	$message = str_replace("{HASH}", md5($_POST['mail']), $message);
	$message = str_replace("{MAIL}", $_POST['mail'], $message);
	
	echo $message;
	exit();
	//mail($to, $subject, $message, $header);
	//header("Location: $_SESSION[page]");
}
else 
{
$page_name='AddEmail';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
}