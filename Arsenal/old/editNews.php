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
	$title=$_POST['title'];
	$link_img=$_POST['link_img'];
	$review=$_POST['review'];
	$content=$_POST['content'];
	if ($title) {mysql_query("UPDATE news SET title='".$title."' WHERE id='".$id."'");}
	if ($link_img) {mysql_query("UPDATE news SET link_img='$link_img' WHERE id='$id'");}
	if ($review) {mysql_query("UPDATE news SET review='$review' WHERE id='$id'");}
	if ($content) {mysql_query("UPDATE news SET content='$content' WHERE id='$id'");}
	echo '<p>Data success save</p>';
}

if (($add) && ($_POST['submit']))
{	
	$title=$_POST['title'];
	$link_img=$_POST['link_img'];
	$review=$_POST['review'];
	$content=$_POST['content'];
	mysql_query("INSERT INTO news (title,link_img,review,content) VALUES ('$title', '$link_img', '$review', '$content')");
	echo '<p>Data success add</p>';
}

if (($id) || ($add))
{
echo '<form method="post">';
echo '	Title: <input type="text" name="title" /><br />';
echo '	link_img: <input type="text" name="link_img" /><br />';
echo '	review: <input type="text" name="review" /><br />';
echo '	content: <input type="text" name="content" /><br />';
echo '	<input type="submit" name="submit" value="Enter" />';
echo '</form>';
}

if ($id_del)
{
 	mysql_query("DELETE FROM news WHERE id='".$id_del."'");
 	echo '<p>Data success deteled</p>';
}

mysql_close($dbcnx);
include 'footer.php';