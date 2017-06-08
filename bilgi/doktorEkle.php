<!DOCTYPE html>
<html>
  <head>
    <title>Doktor Ekle</title>
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
	$ad="";
	$soyad="";
	$pol=0;
	if(array_key_exists("d_ad",$_POST))
		$ad=$_POST['d_ad'];
	if(array_key_exists("d_soyad",$_POST))
		$soyad=$_POST['d_soyad'];
	if(array_key_exists("pol_no",$_POST))
		$pol=$_POST['pol_no'];
	$rsEkle=mysql_query("INSERT INTO doktor (dr_dal_no,dr_ad,dr_soyad) VALUES ('$pol','$ad','$soyad')",$db);
	
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
		<div class='panel-title'>Doktor Ekleme Formu</div>
	</div>
	<div class='panel-body'>
		<form action='doktorEkle.php' method='post'>
			<fieldset>
				<input name='mod' class='form-control' type="hidden" value="okey">
				<div class='form-group'>
					<label>Doktor Adı </label> <input required="required" name='d_ad'
						class='form-control' placeholder='Ad' type="text" maxlength="15">
				</div>
				<div class='form-group'>
					<label>Doktor Soyadı</label> <input required="required" name='d_soyad'
						class='form-control' placeholder='Soyad' type='text' maxlength="15">
				</div>
				<div class='form-group'>
											<label>Poliklinik</label>
											<select required="required" name="pol_no" class="form-control">
												<?php 
												$sql="SELECT * FROM pol_dal";
												$rs=mysql_query($sql,$db);
												while ($row=mysql_fetch_array($rs))
												{
													echo "<option value='{$row['pol_no']}' selected>{$row['pol_ad']}</option>";
												}
												?>
											</select>
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