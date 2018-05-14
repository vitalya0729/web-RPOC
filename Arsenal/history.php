<?php
session_start();
$page_name="History";
include 'func/functions.php';
$_SESSION['page']='history.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;

