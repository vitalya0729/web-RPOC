<?php
session_start();
include 'func/functions.php';
$page_name='ShowContent';
$_SESSION['page']='showContent.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
