<?php 
session_start();

$admin = 'admin';
$pass = '1a1dc91c907325c69271ddf0c944bc72';

if($_POST['submit'])
{
	if(($admin == $_POST['user']) AND ($pass == md5($_POST['pass'])))
	{
		$_SESSION['admin'] = $admin;
		header("Location: main.php");
		exit;
	}
	else 
	{
		echo '<p>invalid password</p>';
	}
}

echo '<form method="post">';
echo '	Username: <input type="text" name="user" /><br />';
echo '	Password: <input type="password" name="pass" /><br />';
echo '	<input type="submit" name="submit" value="Enter" />';
echo '</form>';
