<?php
session_start();
$page = $_SESSION['page'];
session_unset();
header("Location: $page ");
