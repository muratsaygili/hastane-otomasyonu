<!DOCTYPE html>
<html>
  <head>
    <title>İlaç Ekle</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!-- Bootstrap -->
    <link href='../bootstrap/css/bootstrap.min.css' rel='stylesheet'>
    <!-- styles -->
    <link href='../css/styles.css' rel='stylesheet'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
      <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->
  </head>
  <body onunload="opener.location.reload(true);">
  	
<?php
include_once 'config.php';
include_once 'functions.php';


$drNo;
if(array_key_exists("dr_no",$_GET))
	$drNo=$_GET['dr_no'];

$rs1=mysql_query("SELECT durum FROM doktor WHERE dr_no={$drNo}",$db);
$row1=mysql_fetch_row($rs1);
$durum=$row1[0];

if($durum==1){
	$rs2=mysql_query("UPDATE doktor SET durum=0 WHERE dr_no={$drNo}",$db);
}
else{
	$rs2=mysql_query("UPDATE doktor SET durum=1 WHERE dr_no={$drNo}",$db);
}



if($rs2)
	echo "<script> window.close();</script>";

echo mysql_error($db);





print getFooter();
?>
