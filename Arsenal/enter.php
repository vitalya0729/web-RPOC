<?php 
session_start();
include 'func/functions.php';
include 'func/config_sql.php';

if(isset($_SESSION['user']))
{
	$page = $_SESSION['page'];
	header("Location: $page");
	exit;
}

if($_POST['submit'])
{
	$user = $_POST['user'];
	$res=mysql_query("SELECT password FROM users WHERE login='$user'");	
	if($db_data =mysql_fetch_array($res))
	{	
		$password=md5($_POST['password']);
		if ($db_data['password'] == $password)
		{	
			$_SESSION['user'] = $user;
			$page = $_SESSION['page'];
			header("Location: $page");
			exit;
		}
		else
		{
			$_SESSION['error']='Неправильный пароль';		
		}
	}
	else 
	{
		$_SESSION['error']='Нет такого пользователя';
	}
}

$page_name='Enter';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);

echo $page;
mysql_close($dbcn);
