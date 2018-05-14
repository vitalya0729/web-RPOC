<?php

session_start();
if(isset($_SESSION['user']))
{
	$page = $_SESSION['page'];
	header("Location: $page");
	exit;
}
include 'func/functions.php';
if (isset($_POST['login']))
{
	if($_POST['kapcha'] == $_SESSION['rand_code']) 
	{
		unset($_SESSION['rand_code']);	
		if ($_POST['password']==$_POST['passwordRepeat'])
		{
			include 'func/config_sql.php';
			$login=$_POST['login'];
			$res=mysql_query("SELECT login FROM `users` WHERE `login`='$login'");
			if (mysql_fetch_array($res))
			{
				$_SESSION['error']="Пользователь с таким логином уже зарегистрирован";		
			}
			else
			{
				$password=md5(($_POST['password']));
				$res=mysql_query("INSERT INTO `users`(`login`, `password`) VALUES ('$login','$password')");
				if ($res == true) 
				{
					$_SESSION['user']=$login;
					if (!(empty($_POST['mail'])))
					{	
						header('Content-Type: text/html; charset=utf-8');
						$hash = md5($_POST['mail']);
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
					}
					header("Location: $_SESSION[page]");
				}
				else $_SESSION['error']="Беда с базой данных. Повторите, пожалуйста, позже";	
			}
		}
		else
		{
			$_SESSION['error']="Пароли не совпадают";
		}

	}
	else 
	{
		$_SESSION['error']="Проверочный код не совпадает";
	}
}
$page_name='Registration';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
