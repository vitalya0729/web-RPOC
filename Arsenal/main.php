<?php
session_start();
include 'func/functions.php';
$page_name='Main';
$_SESSION['page']='main.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;

