<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("Hasta Kayıt");
?>


    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
<!-- MENU >> -->                <?php print getMenu(); 

$getKayitNo="SELECT kayit_no FROM pol_kayit ORDER BY kayit_no DESC LIMIT 1";
$resultKayitNo=mysql_query($getKayitNo,$db);
$kayitNo=1+mysql_result($resultKayitNo, 0,'kayit_no');

?>
             </div>
		  </div>
		  
		  <div class="col-md-10">
		  
		  	<div class="row">
		  		
		  		
		  		<div class="col-md-1"></div>
		  		<div class="col-md-7">
		  		<div class='content-box-large'>
		  		<?php 
		  		$ad="";
		  		$soyad="";
		  		$tcno=0;
		  		$cinsiyet="";
		  		$tel=0;
		  		$dtarihi="";
		  		$il="";
		  		$ilce="";
		  		$mahalle="";
		  		$sokak="";
		  		$bina="";
		  		$daire=0;
		  		$polno=0;
		  		$drno=0;
		  		
		  		if(array_key_exists("h_ad", $_POST))
		  			$ad=$_POST['h_ad'];
		  		if(array_key_exists("h_soyad", $_POST))
		  			$soyad=$_POST['h_soyad'];
		  		if(array_key_exists("h_tcno", $_POST))
		  			$tcno=$_POST['h_tcno'];
		  		if(array_key_exists("h_cinsiyet", $_POST))
		  			$cinsiyet=$_POST['h_cinsiyet'];
		  		if(array_key_exists("h_telno", $_POST))
		  			$tel=$_POST['h_telno'];
		  		if(array_key_exists("h_dogum_tarihi", $_POST))
		  			$dtarihi=$_POST['h_dogum_tarihi'];
		  		
		  		if(array_key_exists("il", $_POST))
		  			$il=$_POST['il'];
		  		if(array_key_exists("ilce", $_POST))
		  			$ilce=$_POST['ilce'];
		  		if(array_key_exists("mahalle", $_POST))
		  			$mahalle=$_POST['mahalle'];
		  		if(array_key_exists("sokak", $_POST))
		  			$sokak=$_POST['sokak'];
		  		if(array_key_exists("bina", $_POST))
		  			$bina=$_POST['bina'];
		  		if(array_key_exists("daire", $_POST))
		  			$daire=$_POST['daire'];
		  		
		  		if(array_key_exists("pol_no", $_POST))
		  			$polno=$_POST['pol_no'];
		  		if(array_key_exists("dr_no", $_POST))
		  			$drno=$_POST['dr_no'];
		  		
		  		//kayit_no satırını da hesapladık.. kendimiz göndereceğiz..
		  		
		  		
		  		
		  		$query="CALL hastaKayit('".$kayitNo."','".$ad."','".$soyad."','".$tcno."','".$cinsiyet."','".$tel."','".$dtarihi."','".$il."','".$ilce."','".$mahalle."','".$sokak."','".$bina."','".$daire."','".$polno."','".$drno."')";
		  		$rs=mysql_query($query,$db);
		  		if($rs)
		  			echo "<script>alert('Kayıt Ekleme Başarılı!!'); window.location='hastaGoruntule.php';</script>";
		  		
		  		?>
			  				<div class='panel-heading'>
					            <div class='panel-title'>Hasta Kayıt Formu</div>
					        </div>
			  				<div class='panel-body'>
			  					<form action='hastaKayitForm.php' method='post'>
									<fieldset>
										<div class='form-group'>
											<label>Hasta Ad</label>
											<input required="required" name ='h_ad' class='form-control' placeholder='Hasta Ad' type='text' maxlength="15">
										</div>
										<div class='form-group'>
											<label>Hasta Soyad</label>
											<input required="required" name ='h_soyad' class='form-control' placeholder='Hasta Soyad' type='text' maxlength="20">
										</div>
										<div class='form-group'>
											<label>Hasta TC no</label>
											<input required="required" name ='h_tcno' class='form-control' placeholder='TC NO' type="text" pattern="[0-9]{11}" title="11 Basamaklı TC No(Örn: 11223344556)">
										</div>
										<div class='form-group'>
											<label>Cinsiyet</label><br>
											<input required="required" type="radio" name="h_cinsiyet" value="Erkek"> Erkek
  											<input  type="radio" name="h_cinsiyet" value="Kadın"> Kadın<br>
										</div>
										<div class='form-group'>
											<label>Hasta Telefon No</label>
											<input required="required" name ='h_telno' class='form-control' placeholder='Tel No' type="text" pattern="[0-9]{10}" title="Başında 0 Olmadan Telefon No(Örn: 5*********)">
										</div>
										<div class='form-group'>
											<label>Hasta Doğum Tarihi</label>
											<input required="required" name ='h_dogum_tarihi' class='form-control' placeholder='Hasta Doğum Tarihi' type='date'>
										</div>
										<br><label>ADRES BİLGİLERİ</label><br><br>
										<div class='form-group'>
											<label>İL</label>
											<input required="required" name ='il' class='form-control' placeholder='İl' type='text' maxlength="15">
										</div>
										<div class='form-group'>
											<label>İLÇE</label>
											<input required="required" name ='ilce' class='form-control' placeholder='İlçe' type='text' maxlength="15">
										</div>
										<div class='form-group'>
											<label>MAHALLE</label>
											<input required="required" name ='mahalle' class='form-control' placeholder='Mahalle' type='text' maxlength="15">
										</div>
										<div class='form-group'>
											<label>SOKAK</label>
											<input required="required" name ='sokak' class='form-control' placeholder='Sokak' type='text' maxlength="15">
										</div>
										<div class='form-group'>
											<label>BİNA</label>
											<input required="required" name ='bina' class='form-control' placeholder='Bina' type='text'  maxlength="15">
										</div>
										<div class='form-group'>
											<label>DAİRE</label>
											<input required="required" name ='daire' class='form-control' placeholder='daire' type="number">
										</div>
										<br><label>POLİKLİNİK BİLGİLERİ</label><br><br>
										<div class='form-group'>
											<label>Poliklinik</label>
											<select name="pol_no" class="form-control">
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
										<div class="form-group">
											<label>Doktor No</label>
											<select name="dr_no" class="form-control">
												<?php 
												$sql="SELECT dr_no,dr_ad,dr_soyad FROM doktor WHERE durum=1";
												$rs=mysql_query($sql,$db);
												while ($row=mysql_fetch_array($rs))
												{
													echo "<option value='{$row['dr_no']}' selected>{$row['dr_ad']} {$row['dr_soyad']}</option>";
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
			  					
			  			</div>
		<div class="col-md-4"></div>
		
		
		
		
		  	</div>
		  		
		  		
		  </div>
		</div>
    </div>

    <?php print getFooter(); ?>