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
	header("Location: main.php");
	exit;
}

include 'func/config_sql.php';

$id_edit=$_GET['edit'];
$id_del=$_GET['delete'];
$add=$_GET['add'];

if (($_POST['submit']) && ($id_edit))
{
	$title=$_POST['title'];
	$link_img=$_FILES['link_img']['name'];
	$review=$_POST['review'];
	$content=$_POST['content'];
	if ($title) 
	{
		$title=addTag($title,'<h3>','</h3>');
		mysql_query("UPDATE news SET title='".$title."' WHERE id='".$id_edit."'");
	}
	if ($link_img)
	{

		$link_img="picture/".$_FILES['link_img']['name'];
		move_uploaded_file($_FILES['link_img']['tmp_name'], $link_img);
		$db = mysql_query("SELECT link_img FROM news WHERE id = '$id_edit'");
		$link_del = mysql_fetch_array($db)['link_img'];
		unlink ("$link_del");
		mysql_query("UPDATE news SET link_img='$link_img' WHERE id='$id_edit'");	
	}
	if ($review) 
	{
		$review=addTag($review,'<p>','</p>');
		mysql_query("UPDATE news SET review='$review' WHERE id='$id_edit'");
	}
	if ($content) 
	{
		$content=addTag($content,'<p>','</p>');
		mysql_query("UPDATE news SET content='$content' WHERE id='$id_edit'");
	}
	//echo '<p>Data success save</p>';
	header("Location: main.php");
}

if (($add) && ($_POST['submit']))
{	
	$title=addTag($_POST['title'],'<h3>','</h3>');
	$link_img="picture/".$_FILES['link_img']['name'];
	$review=$_POST['review'];
	$content=$_POST['content'];
  	move_uploaded_file($_FILES['link_img']['tmp_name'], $link_img);
	mysql_query("INSERT INTO news (title,link_img,review,content) VALUES ('$title', '$link_img', '$review', '$content')");
	header("Location: main.php");
}

if (($id_edit) || ($add))
{
include 'func/functions.php';
$page_name='ChangeNews';
$template='tpl/main.tpl';
$_SESSION['id_edit']=$id_edit;
$page=createPage($template,$page_name);
echo $page;
}

if ($id_del)
{
	$db = mysql_query("SELECT link_img FROM news WHERE id = '$id_del'");
	$link_del = mysql_fetch_array($db)['link_img'];
	unlink ("$link_del");
 	mysql_query("DELETE FROM news WHERE id='".$id_del."'");
 	//echo '<p>Data success deteled</p>';
 	header("Location: main.php");
}

mysql_close($dbcnx);
