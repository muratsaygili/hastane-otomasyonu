<!DOCTYPE html>
<html>
  <head>
    <title>Malzeme Güncelle</title>
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
$noAl;
if(array_key_exists("mod",$_POST))
	$mod=$_POST['mod'];
if(array_key_exists("mal_no",$_GET))
	$noAl=$_GET['mal_no'];

if($mod=="update"){
	$ad="";
	$stokAdet;
	$fiyat;
	
	if(array_key_exists("mal_ad",$_POST))
		$ad=$_POST['mal_ad'];
	if(array_key_exists("stok_adet",$_POST))
		$stokAdet=$_POST['stok_adet'];
	if(array_key_exists("mal_fiyat",$_POST))
		$fiyat=$_POST['mal_fiyat'];
	
		$rsGuncelle=mysql_query("UPDATE stok SET mal_ad='$ad', stok_adet='$stokAdet', mal_fiyat='$fiyat' WHERE mal_no=$noAl ",$db);
		
		if($rsGuncelle){
			echo "<script>window.alert('Malzeme Güncelleme Başarılı!!'); window.close();</script>";
		}
		else 
			echo "Malzeme Güncelleme Başarısız !!";
		
		echo mysql_error($db);
	
}
echo mysql_error($db);
?>

<div class='content-box-large'>
	<div class='panel-heading'>
		<div class='panel-title'>Malzeme Güncelleme Formu</div>
	</div>
	<div class='panel-body'>
		<form action='malzemeGuncelle.php?mal_no=<?php echo $noAl;?>' method='post'>
		<?php 
		$qYazdir="SELECT * FROM stok WHERE mal_no={$noAl}";
		$rsYazdir=mysql_query($qYazdir,$db);
		$rowYazdir=mysql_fetch_row($rsYazdir);
		
		?>
			<fieldset>
				<input name='mod' class='form-control' type="hidden" value="update">
				<div class='form-group'>
					<label>Malzeme Adı </label> <input required="required" name='mal_ad' maxlength="30"
						class='form-control' placeholder='Ad' type="text" value="<?php echo $rowYazdir[1];?>">
				</div>
				<div class='form-group'>
					<label>Adet</label> <input required="required" name='stok_adet'
						class='form-control' placeholder='Adet' type="number" value="<?php echo $rowYazdir[2];?>">
				</div>
				<div class='form-group'>
					<label>Fiyat</label> <input required="required" name='mal_fiyat'
						class='form-control' placeholder='Fiyat' type="" value="<?php echo $rowYazdir[3];?>">
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