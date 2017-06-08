<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("Bilgi İşlem Anasayfa");
?>
    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
<!-- MENU >> -->                <?php print getMenu();?>
             </div>
		  </div>
		  
		  <div class="col-md-10">
		  
		  	<div class="row">
		  		<?php 
		  		
		  		$drNo=0;
		  		$dal1="";
		  		if(array_key_exists("dr_no",$_GET))
		  			$drNo=$_GET['dr_no'];
		  		if(array_key_exists("dal1",$_GET))
		  			$dal1=$_GET['dal1'];
		  		
		  		
		  		$doldurRs=mysql_query("SELECT * FROM doktor WHERE dr_no={$drNo}",$db);
		  		$doldur=mysql_fetch_array($doldurRs);
		  		$ad1=$doldur[2];
		  		$soyad1=$doldur[3];
		  		$durum1=$doldur[4];
		  		
		  		
		  		
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
		  			$rsEkle=mysql_query("INSERT INTO doktor (dr_dal_no,dr_ad,dr_soyad)VALUES ('$pol','$ad','$soyad')",$db);
		  		
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
		<div class='panel-title'>Doktor Güncelleme Formu</div>
	</div>
	<div class='panel-body'>
		<form action='doktorGuncelle.php' method='post'>
			<fieldset>
				<input name='mod' class='form-control' type="hidden" value="okey">
				<div class='form-group'>
					<label>Doktor Adı </label> <input required="required" name='d_ad' maxlength="15"
						class='form-control' placeholder='Ad' type="text" value="<?php echo $ad1;?>">
				</div>
				<div class='form-group'>
					<label>Doktor Soyadı</label> <input required="required" name='d_soyad' maxlength="15"
						class='form-control' placeholder='Soyad' type='text' value="<?php echo $soyad1;?>">
				</div>
				<div class='form-group'>
											<label>Poliklinik</label>>><?php echo $dal1;?>
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

    <?php print getFooter(); ?>