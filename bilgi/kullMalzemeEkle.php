<!DOCTYPE html>
<html>
  <head>
    <title>Malzeme Ekle</title>
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

$kayitNo;
if(array_key_exists("kayit_no",$_GET))
	$kayitNo=$_GET['kayit_no'];

$mod="";
if(array_key_exists("mod",$_POST))
	$mod=$_POST['mod'];

if($mod=="ekle"){
	$malNo;
	$malAdet;
	
	if(array_key_exists("mal_no",$_POST))
		$malNo=$_POST['mal_no'];
	if(array_key_exists("mal_adet",$_POST))
		$malAdet=$_POST['mal_adet'];
	
	
	$qKalan="SELECT * FROM stok WHERE mal_no='$malNo'";
	$rsKalan=mysql_query($qKalan,$db);
	$rowKalan=mysql_fetch_row($rsKalan);
	$kalanMiktar=$rowKalan[2];
	
	
	if ($kalanMiktar>0)
	{
		$rsEkle=mysql_query("INSERT INTO kull_malz (kayit_no,mal_no,mal_adet) VALUES ('$kayitNo','$malNo','$malAdet')",$db);
		
		if($rsEkle){
			echo "<script>window.alert('Malzeme Ekleme Başarılı!!'); window.close();</script>";
			
			
		}
		else 
			echo "Malzeme Ekleme Başarısız !!";
	}else {
		 echo "<script>window.alert('Seçilen malzeme stokta bulunmamaktadır !!');</script>";
		 echo "<meta content='1; URL=kullMalzemeEkle.php?kayit_no=$kayitNo' http-equiv='refresh'>";
	 }
	
}
echo mysql_error($db);
?>

<div class='content-box-large'>
	<div class='panel-heading'>
		<div class='panel-title'>Malzeme Ekleme Formu</div>
	</div>
	<div class='panel-body'>
		<form action='kullMalzemeEkle.php?kayit_no=<?php print $kayitNo;?>' method='post'>
			<fieldset>
			<label><?php echo "İlaç eklenecek hasta id= ".$kayitNo;?></label><br><br>
				<input name='mod' class='form-control' type="hidden" value="ekle">
				<div class='form-group'>
											<label>Malzeme Seçiniz</label>
											<select name="mal_no" class="form-control">
												<?php 
												$sql="SELECT * FROM stok";
												$rs=mysql_query($sql,$db);
												while ($row=mysql_fetch_array($rs))
												{
													echo "<option value='{$row['mal_no']}' 'selected'>{$row['mal_ad']}</option>";
												}
												?>
											</select>
										</div>
				<div class='form-group'>
					<label>Adet</label> <input required="required" name='mal_adet'
						class='form-control' placeholder='Adet' type="number">
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