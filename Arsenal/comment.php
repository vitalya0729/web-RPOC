<?php
session_start();
include 'func/config_sql.php';
$text_comment = $_POST['text_comment'];
$page = $_POST['page_id'];
$user = $_SESSION['user'];
mysql_query("INSERT INTO comments (comment, page, user) VALUES ('$text_comment','$page', '$user')");
$url = 'showContent.php?id='.$page;
header("Location: $url"); 