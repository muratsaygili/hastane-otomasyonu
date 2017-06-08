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

$ilacNo;
$kulSuresi;
$dozaj;
$mod="";

if(array_key_exists("ilac_no",$_POST))
	$ilacNo=$_POST['ilac_no'];
if(array_key_exists("kul_suresi",$_POST))
	$kulSuresi=$_POST['kul_suresi'];
if(array_key_exists("dozaj",$_POST))
	$dozaj=$_POST['dozaj'];
if(array_key_exists("mod",$_POST))
	$mod=$_POST['mod'];

if($mod=="okey"){
	
	$qKalan="SELECT * FROM ilac WHERE ilac_no='$ilacNo'";
	$rsKalan=mysql_query($qKalan,$db);
	$rowKalan=mysql_fetch_row($rsKalan);
	$kalanMiktar=$rowKalan[3];
	
	 if ($kalanMiktar>0)
	 {
	 	$query="INSERT INTO recete (ilac_no,kayit_no,kul_suresi,dozaj) VALUES ('$ilacNo','$kayitNo','$kulSuresi','$dozaj')";
	 	$rs=mysql_query($query,$db);
	 	
	 	if ($rs) {
	 		echo "<script>window.alert('İlaç Ekleme Başarılı!!'); window.close();</script>";
	 	}else
	 		echo "İlaç Ekleme Başarısız !!";
	 	
	 }
	 else {
		 echo "<script>window.alert('Seçilen ilaç stokta bulunmamaktadır !!');</script>";
		 echo "<meta content='1; URL=receteOlustur.php?kayit_no=$kayitNo' http-equiv='refresh'>";
	 }
	
	
}


?>
            
		  
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="content-box-large">
		  		
		  		
			  				<div class="panel-heading">
					            <div class="panel-title">İlaç Ekleme Formu</div>
					        </div>
			  				<div class="panel-body">
			  					<form action="receteOlustur.php?kayit_no=<?php print $kayitNo;?>" method="post">
									<fieldset>
									<label><?php echo "İlaç eklenecek hasta id= ".$kayitNo;?></label><br><br>
										<div class='form-group'>
											<label>İlaç Seçiniz</label>
											<select name="ilac_no" class="form-control">
												<?php 
												$sql="SELECT * FROM ilac";
												$rs=mysql_query($sql,$db);
												while ($row=mysql_fetch_array($rs))
												{
													echo "<option value='{$row['ilac_no']}' 'selected'>{$row['ilac_ad']}</option>";
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Kullanım Süresi(gün)</label>
											<input required="required" class="form-control" placeholder="Kullanım Süresi" type="number" name="kul_suresi">
										</div>
										<div class="form-group">
											<label>Günlük Kullanım Dozajı</label>
											<input required="required" class="form-control" placeholder="Dozaj" type="number" name="dozaj">
										</div>
										<input type="hidden" name="mod" value="okey">
									</fieldset>
									<div>
										<input type='submit' class='btn btn-primary' value='Kaydet'>
									</div>
								</form>
			  				</div>
		  		</div>
		  	</div>
		  </div>
		</div>
    </div>

    <?php print getFooter(); ?>