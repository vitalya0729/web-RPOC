<?php
session_start();
if(!$_SESSION['admin'])
{
	header("Location: enter.php");
	exit;
}
include 'header.php';
include 'config_sql.php';

$id=$_GET['id'];
$id_del=$_GET['delete'];
$add=$_GET['add'];

if (($_POST['submit']) && ($id))
{
	$link_img_res=$_POST['link_img_res'];
	$competition=$_POST['competition'];
	if ($link_img_res) {mysql_query("UPDATE result SET link_img_res='".$link_img_res."' WHERE id='".$id."'");}
	if ($competition) {mysql_query("UPDATE result SET competition='$competition' WHERE id='$id'");}
	echo '<p>Data success save</p>';
}

if (($add) && ($_POST['submit']))
{	
	$link_img_res=$_POST['link_img_res'];
	$competition=$_POST['competition'];
	mysql_query("INSERT INTO result (link_img_res,competition) VALUES ('$link_img_res', '$competition')");
	echo '<p>Data success add</p>';
}

if (($id) || ($add))
{
echo '<form method="post">';
echo '	link_img: <input type="text" name="link_img_res" /><br />';
echo '	competition: <input type="text" name="competition" /><br />';
echo '	<input type="submit" name="submit" value="Enter" />';
echo '</form>';
}

if ($id_del)
{
 	mysql_query("DELETE FROM result WHERE id='".$id_del."'");
 	echo '<p>Data success deteled</p>';
}

mysql_close($dbcnx);
