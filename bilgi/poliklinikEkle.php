<!DOCTYPE html>
<html>
  <head>
    <title>Poliklinik Ekle</title>
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
  	<div class='header'>
	     <div class='container'>
	        <div class='row'>
	           <div class='col-md-5'>
	              <!-- Logo -->
	              <div class='logo'>
	                 <h1><a href='#'>Hastane Bilgi Yönetim Sistemi</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

<?php
include_once 'config.php';
include_once 'functions.php';

$mod="";

if(array_key_exists("mod",$_POST))
	$mod=$_POST['mod'];

if($mod=="okey"){
	$polAd="";
	if(array_key_exists("pol_ad",$_POST))
		$polAd=$_POST['pol_ad'];
	$rsEkle=mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('$polAd')",$db);
	
	if($rsEkle){
		echo "<script>window.alert('Kayıt Ekleme Başarılı!!'); window.close();</script>";
		
		
	}
	else 
		echo "Kayıt Ekleme Başarısız !!";
}
echo mysql_error($db);
?>

<div class='content-box-large'>
	<div class='panel-heading'>
		<div class='panel-title'>Poliklinik Ekleme Formu</div>
	</div>
	<div class='panel-body'>
		<form action='poliklinikEkle.php' method='post'>
			<fieldset>
				<input name='mod' class='form-control' type="hidden" value="okey">
				<div class='form-group'>
					<label>Poliklinik Adı </label> <input required="required" name='pol_ad'
						class='form-control' placeholder='Ad' type="text" maxlength="25">
				</div>
			</fieldset>
			<div>
				<input type='submit' class='btn btn-primary' value='Kaydet'>
			</div>
		</form>
	</div>
</div>
<footer>
         <div class='container'>
         
            <div class='copy text-center'>
               Copyright 2015 <a href='#'>&copy Murat Saygılı</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src='https://code.jquery.com/jquery.js'></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src='../bootstrap/js/bootstrap.min.js'></script>
    <script src='../js/custom.js'></script>
  </body>
</html>