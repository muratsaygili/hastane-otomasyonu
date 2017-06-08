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


$receteNo;
$kayitNo;
if(array_key_exists("recete_no",$_GET))
	$receteNo=$_GET['recete_no'];
if(array_key_exists("kayit_no",$_GET))
	$kayitNo=$_GET['kayit_no'];

$rs=mysql_query("DELETE FROM recete WHERE recete_no={$receteNo}",$db);

if($rs)
	echo "<script> window.close();</script>";

echo mysql_error($db);





print getFooter();
?>
