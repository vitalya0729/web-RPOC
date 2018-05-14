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
	header("Location: foto.php");
	exit;
}

include 'func/config_sql.php';
$link_del=$_GET['delete'];
$add=$_GET['add'];

if (($add) && ($_POST['submit']))
{	
	$foto_link = "picture/".$_FILES['foto_link']['name'];
  	move_uploaded_file($_FILES['foto_link']['tmp_name'], $foto_link);

	mysql_query("INSERT INTO foto (link_img) VALUES ('$foto_link')");
	//echo '<p>Data success add</p>';
	header("Location: foto.php");
}

if ($add)
{
include 'func/functions.php';
$page_name='ChangeFoto';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
}

if ($link_del)
{
 	mysql_query("DELETE FROM foto WHERE link_img='".$link_del."'");
 	unlink ("$link_del");
 	//echo '<p>Data success deteled</p>';
 	header("Location: foto.php");
}

mysql_close($dbcnx);
