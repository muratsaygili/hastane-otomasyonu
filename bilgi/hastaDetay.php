<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("Hasta Detay");
?>


    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
<!-- MENU >> -->                <?php print getMenu();?>
             </div>
		  </div>
		  <div class="row col-md-10 panel-warning">
		  		  	
		  			<div class="content-box-header panel-heading">
	  					<div class="panel-title "><b>HASTA BİLGİLERİ</b></div>
						
						<div class="panel-options">
							<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
							<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
						</div>
		  			</div>
		  			<div class="content-box-large box-with-header">
		  			<?php 
		  			
		  			if(isset($_GET['kayit_no'])){
			  			$kayitNo=$_GET['kayit_no'];
			  			$rsHasta=mysql_query("SELECT * FROM hasta WHERE kayit_no={$kayitNo}",$db);
			  			$row=mysql_fetch_row($rsHasta);
			  			
			  			$durumQ=mysql_query("SELECT * FROM pol_kayit WHERE kayit_no={$kayitNo}",$db);
			  			$durum=mysql_fetch_assoc($durumQ);
		  			}
		  			?>
		  			
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>Ad</th>
			                  <th>Soyad</th>
			                  <th>TC No</th>
			                  <th>Cinsiyet</th>
			                  <th>Telefon</th>
			                  <th>Doğum Tarihi</th>
			                  <th>Kayıt Tarihi</th>
			                </tr>
			              </thead>
			              <tbody>
			              <?php 
			              echo '<tr>
				                 	<td>'.$row[0].'</td>
				                 	<td>'.$row[1].'</td>
	    							<td>'.$row[2].'</td>
					    			<td>'.$row[3].'</td>
							  		<td>'.$row[4].'</td>
						  			<td>'.$row[5].'</td>
						  			<td>'.$row[6].'</td>
										<td>'.$durum['h_kayit_tarihi'].'</td>
				                </tr>';
			              ?>
			                
			              </tbody>
			            </table>
  					</div><legend></legend>
  					<?php 
  					$qAdres="SELECT * FROM adres WHERE kayit_no=$kayitNo";
  					$rsAdres=mysql_query($qAdres,$db);
  					$rowAdres=mysql_fetch_row($rsAdres);
  					?>
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
			                  <th>ID</th>
			                  <th>İl</th>
			                  <th>İlçe</th>
			                  <th>Mahalle</th>
			                  <th>Sokak</th>
			                  <th>Bina</th>
			                  <th>Daire</th>
			                </tr>
			              </thead>
			              <tbody>
			              <?php 
			              echo '<tr>
				                 	<td>'.$rowAdres[0].'</td>
				                 	<td>'.$rowAdres[1].'</td>
	    							<td>'.$rowAdres[2].'</td>
					    			<td>'.$rowAdres[3].'</td>
							  		<td>'.$rowAdres[4].'</td>
						  			<td>'.$rowAdres[5].'</td>
						  			<td>'.$rowAdres[6].'</td>
				                </tr>';
			              ?>
			                
			              </tbody>
			            </table>
  					</div>
  					Hasta Durumu: 
  					<?php 
  					
  					if(isset($_POST['submit2'])){
  						mysql_query("CALL hastaCikis('".$kayitNo."')",$db);
  						echo '<meta HTTP-EQUIV="REFRESH" content="0; url=hastaDetay.php?kayit_no='.$kayitNo.'">';
  					}
  					//<button class='btn btn-danger btn-xs' onclick="">Çıkış Al</button>
  						if($durum['h_cikis_tarihi']!=null){
  							$flag=false;
  							echo "<font color='red'>".$durum['h_cikis_tarihi']." tarihinde çıkış yaptı..</font>";
  						}
  						else{
  							$flag=true;
  							echo "Çıkış Yapılmadı  <form action='hastaDetay.php?kayit_no=$kayitNo' method='post'>
												      <input class='btn btn-danger btn-xs' type='submit' name='submit2' value='Çıkış Al' />
												 </form>";
  							
  						}
  						
  					?>
  				
					</div>
		  		
		  
		  <div class="content-box-large col-md-12">
		  <div class="col-md-6">
		  	<div class="row">
		  		<div class="content-box-large">
	  					<div class="content-box-header">
		  					<div class="panel-title">Hasta Tanı Girişi</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<form class="form-inline" role="form" action='hastaDetay.php?kayit_no=<?php print $kayitNo;?>' method='post'>
							
								<fieldset>
									<div class="form-group col-sm-4">
										<label>TANI:</label>
										<?php 
										$rsTani=mysql_query("SELECT * FROM pol_kayit WHERE kayit_no={$kayitNo}");
										$rowTani=mysql_fetch_array($rsTani);
										echo $rowTani['tani'];
										
										if(isset($_POST['submitTani'])){
											$tani=$_POST['taniGiris'];
											mysql_query("CALL taniGiris('".$tani."','".$kayitNo."')",$db);
											
											echo "<meta content='1; URL=hastaDetay.php?kayit_no=$kayitNo' http-equiv='refresh'>";
											echo mysql_error($db);
										}
										?>
										
									</div>
									<div class="form-group  col-sm-2">
										<label>Tanı Yazınız:   </label>
									</div>
									<div class="form-group  col-sm-5">
										<input required="required" class="form-control" <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?>name="taniGiris"  placeholder="Tanı" type="text" maxlength="30">
									<button <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?>type="submitTani" id="submitTani" name="submitTani" class="btn btn-primary btn-success">
										Gönder
									</button>
									</div>
								</fieldset>
								
							</form>
						</div>
	  				</div>
		  	</div>
		  </div>
		  
		 
		  
		  <div class="col-md-6">
		  	<div class="row">
		  		<div class="content-box-large">
		  		<div class="content-box-header">
		  					<div class="panel-title">Reçete Bilgileri</div>
			  			</div>
			  			<div class="content-box-large box-with-header">
			  				<form class="form-inline" role="form" action='receteOlustur.php?kayit_no=<?php print $kayitNo;?>' method='post'>
							
								<fieldset>
									<div class="form-group col-sm-12">
										<?php 
																				
										$receteSql=mysql_query("SELECT * FROM recete WHERE kayit_no={$kayitNo}");
										$rsReceteSql=mysql_fetch_assoc($receteSql);
										
										if($rsReceteSql['recete_no']==null){
											echo "Reçete Kaydı Bulunamadı !";
										}else{
											$qilac="SELECT * FROM recete WHERE kayit_no={$kayitNo}";
											$rsilac=mysql_query($qilac);
														echo "<table class='table'>
																		<thead>
												                <tr>
												                  <th>İlaç No</th>
												                  <th>İlaç Adı</th>
												                  <th>Kullanım Süresi</th>
												                  <th>Günlük Dozaj</th>
												                </tr>
												              </thead>
															<tbody>";			
											while ($rowilac=mysql_fetch_assoc($rsilac)){
												$ilacAd=mysql_query("SELECT * FROM ilac WHERE ilac_no={$rowilac['ilac_no']}",$db);
												$rowisim=mysql_fetch_row($ilacAd);
												
												echo '<tr><td>'.$rowilac['ilac_no'].'  ';?>
												<input <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?> class="btn btn-danger btn-xs pull-right" type="button" value="X" 
				onclick="window.open('recetedenSil.php?kayit_no=<?php print $kayitNo;?>&recete_no=<?php print $rowilac['recete_no'];?>','ornekpencere',' width=400,height=600,left=300,top=30');">
												<?php echo '</td><td>'.$rowisim[1].' '.$rowisim[4].'</td><td>'.$rowilac['kul_suresi'].' gün</td><td>'.$rowilac['dozaj'].'</td></tr>';
											}
											
											echo "</tbody></table>";
										}
										
										
										?>
										<input <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?> class="btn btn-success" type="button" value="İlaç Ekle" 
				onclick="window.open('receteOlustur.php?kayit_no=<?php print $kayitNo;?>','ornekpencere',' width=400,height=600,left=300,top=30');">
									</div>
								</fieldset>
							</form>
						</div>
		  		</div>
		  	</div>
		  </div>
		  </div>
		  
		  <div class="col-md-12">
		  	<div class="row panel-warning">
		  		<div class="content-box-header panel-heading">
	  				<div class="panel-title "><b>Kullanılan Malzeme ve Ücret Bilgileri</b></div>
	  			</div>
		  		<div class="content-box-large box-with-header">
		  		
		  		
		  		<?php $toplamUcret=0;
		  		$qMalzeme="SELECT * FROM kull_malz WHERE kayit_no={$kayitNo}";
		  		$rsMalzeme=mysql_query($qMalzeme,$db);
		  		echo "<table class='table'>
							<thead>
			                <tr>
			                  <th>Malzeme No-Ad</th>
			                  <th>Malzeme Adet</th>
			                  <th>Fiyat</th>
			                </tr>
			              </thead>
						<tbody>";
		  		while ($rowMalzeme=mysql_fetch_assoc($rsMalzeme)){
		  			$qStok="SELECT * FROM stok WHERE mal_no={$rowMalzeme['mal_no']}  ";
		  			$rsStok=mysql_query($qStok,$db);
		  			$rowStok=mysql_fetch_row($rsStok);
		  			$fiyat=floatval($rowMalzeme['mal_adet'])*floatval($rowStok[3]);
		  			$toplamUcret=$toplamUcret+$fiyat;
		  			echo "<tr><td>"; ?>
		  					<input <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?> class="btn btn-danger btn-xs pull-left" type="button" value="X" 
				onclick="window.open('malzemedenSil.php?kayit_no=<?php print $kayitNo;?>&malzeme_no=<?php print $rowMalzeme['malzeme_no'];?>','ornekpencere',' width=400,height=600,left=300,top=30');">
		  				<?php echo ">".$rowMalzeme['mal_no']."-".$rowStok[1]."</td><td>".$rowMalzeme['mal_adet']."</td><td>".$fiyat."</td></tr>";
		  		}
		  		echo "</tbody></table>";?>
		  		<input <?php if($flag==false){
  							echo 'disabled="disabled"';
  						}?> class="btn btn-success" type="button" value="Malzeme Ekle" 
				onclick="window.open('kullMalzemeEkle.php?kayit_no=<?php print $kayitNo;?>','ornekpencere',' width=400,height=600,left=300,top=30');">
				<?php
		  		echo "<label class='pull-right'>Toplam Ücret: ".$toplamUcret."</label>";
		  		mysql_query("UPDATE ucretler SET toplam_ucret={$toplamUcret} WHERE kayit_no={$kayitNo}",$db);
		  		?>
		  		
		  		
				</div>
			</div>
		  </div>
		  
		  
		  
		  </div>
		</div>
    </div>

    <?php print getFooter(); ?>