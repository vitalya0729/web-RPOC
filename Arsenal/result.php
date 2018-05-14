<?php
session_start();
include 'func/functions.php';
$_SESSION['page'];
$page_name='Result';
$_SESSION['page']='result.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
