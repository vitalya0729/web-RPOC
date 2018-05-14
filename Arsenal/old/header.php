<?php
session_start();
echo '<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Arsenal</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/arsenal.css" rel="stylesheet">';

  //  <style >

echo ';
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
  	<div class="container">
  		<nav class="nav_site">'."\n";

if($_SESSION['admin'])
{
echo '        <div class="row">'."\n";
echo '          <ul class="line">'."\n";
echo '            <li class="col-md-3"><a href=admin.php?do=logout>LOG OUT</a></li>'."\n";
echo '          </ul>'."\n";
echo '        </div>'."\n";   
}

echo '  			<div class="row">'."\n";
echo '  				<ul class="line">'."\n";
echo '            <li class="col-md-3"'; if ($type_page=="main") {echo ' id="active"';}  echo '><a href="main.php" >ГЛАВНАЯ</a></li>'."\n";
echo '            <li class="col-md-3"'; if ($type_page=="result") {echo' id="active"';} echo '><a href="result.php" >РЕЗУЛЬТАТЫ</a></li>'."\n";
echo '            <li class="col-md-3"'; if ($type_page=="history") {echo' id="active"';}  echo '><a href="history.php" >ИСТОРИЯ</a></li>'."\n";
echo '            <li class="col-md-3"'; if ($type_page=="foto") {echo' id="active"';} echo '><a href="foto.php" >ФОТО</a></li>'."\n";		
echo '          </ul>'."\n";
echo '  			</div>'."\n";
echo '  		</nav>

  		
  	<div class="logo"><img src="picture/logo.png" alt="emblema" class="img-responsive"></div>  				
';




