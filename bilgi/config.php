<?php
$db=mysql_connect("localhost","root","1234") or die("mysQl bağlantısı başarısız".mysql_error());
$table=mysql_select_db("hastane",$db) or die("veritabanı bağlantısı başarısız".mysql_error());
mysql_query("SET NAMES utf8");
session_start();
?>