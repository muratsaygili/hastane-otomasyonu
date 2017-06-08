<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("Hasta Kayıt Anasayfa");
?>
    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block; background-color: ">
<!-- MENU >> -->                <?php print getMenu();?>
             </div>
		  </div>

		  <div class="col-md-10">
		  
		  	<div class="row">
		  	
		  		<img src='images/hasta-kayit.jpg'  width='900px'>
		  	<!--  		<input class="btn btn-success" type="button" value="Hasta Kayıt" 
				onclick="window.open('hastaKayitForm.php','ornekpencere',' width=400,height=600,left=300,top=50');"> -->
		  	</div>
		  		
		  		
		  </div>
		</div>
    </div>

    <?php print getFooter(); ?>