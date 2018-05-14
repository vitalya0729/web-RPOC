<?php
session_start();
include 'func/functions.php';
$page_name='Foto';
$_SESSION['page']='foto.php';
$template='tpl/main.tpl';
$page=createPage($template,$page_name);
echo $page;
