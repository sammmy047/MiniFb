<?php
session_start();

if(!isset($_SESSION['god']))
$_SESSION['god']=['A','W','E','S','O','M','E'];
echo $_COOKIE["PHPSESSID"];
print_r($_SESSION['god']);
?>