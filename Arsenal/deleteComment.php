<?php
session_start();
include 'func/config_sql.php';
$id = $_GET['id'];
$db_comments = mysql_query("SELECT user FROM comments WHERE id = '$id'");
$user = mysql_fetch_array($db_comments)['user']; 
if (($_SESSION['user']!=='admin') && ($_SESSION['user']!==$user))
{
	$page = $_SESSION['page'];
	header("Location: $page");
	exit;
}
$page = $_SESSION['page'];
include 'func/config_sql.php';
mysql_query("DELETE from `comments` WHERE `id` = '$id'");
header("Location: $page");
exit;
