<?php
session_start();

function addTag($line,$start_tag,$end_tag)
{
	switch ($start_tag)
		{
		case (('<h3>') ||('<p>')):
			$line=$start_tag.$line.$end_tag;
			return ($line=preg_replace("/(\n)/Ui", $end_tag.$start_tag, $line));
			break;
		}
	return '';
}

if($_SESSION['user']!=='admin')
{
	header("Location: result.php");
	exit;
}

include 'func/config_sql.php';

$id_edit=$_GET['edit'];
$id_del=$_GET['delete'];
$add=$_GET['add'];

if (($_POST['submit']) && ($id_edit))
{
	$team=$_POST['team'];
	$num_games=$_POST['num_games'];
	$num_points=$_POST['num_points'];
	$tourney=$_POST['tourney'];
	if ($team) 
	{
		mysql_query("UPDATE result SET team='".$team."' WHERE id='".$id_edit."'");
	}
	if ($num_games)
	{
		mysql_query("UPDATE result SET num_games='$num_games' WHERE id='$id_edit'");
	}
	if ($num_points) 
	{
		mysql_query("UPDATE result SET num_points='$num_points' WHERE id='$id_edit'");
	}
	if ($tourney) 
	{
		mysql_query("UPDATE result SET tourney='$tourney' WHERE id='$id_edit'");
	}
	//echo '<p>Data success save</p>';
	header("Location: result.php");
}

if (($add) && ($_POST['submit']))
{	
	$team=$_POST['team'];
	$num_games=$_POST['num_games'];
	$num_points=$_POST['num_points'];
	$tourney=$_POST['tourney'];
	mysql_query("INSERT INTO result (team,num_games,num_points,tourney) VALUES ('$team', '$num_games', '$num_points', '$tourney')");
	//echo '<p>Data success add</p>';
	header("Location: result.php");
}

if (($id_edit) || ($add))
{
include 'func/functions.php';
$page_name='ChangeResult';
$template='tpl/main.tpl';
$_SESSION['id_edit']=$id_edit;
$page=createPage($template,$page_name);
echo $page;
}

if ($id_del)
{
 	mysql_query("DELETE FROM result WHERE id='".$id_del."'");
 	//echo '<p>Data success deteled</p>';
 	header("Location: result.php");
}

mysql_close($dbcnx);
