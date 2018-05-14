<?php
$dblocation = "localhost";
$dbname = "arsenal";
$dbuser = "root";
$dbpasswd = "";
$dbcn = mysql_connect($dblocation,$dbuser,$dbpasswd);
mysql_select_db($dbname);
mysql_query('SET NAMES utf8');
if (!$dbcn) 
{
  echo( "<P>В настоящий момент сервер базы данных не доступен, поэтому 
            корректное отображение страницы невозможно.</P>" );
  exit();
}
