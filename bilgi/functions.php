<?php
$bilgi = "";
if (array_key_exists ( "bilgi", $_SESSION )) {
	$bilgi = $_SESSION ['bilgi'];
}
if ($bilgi) {
}else{
	
	echo "Giriş Yapılmadı..";
	header ( "refresh:2; url=giris.php" );
	exit ();
}

function getHeader($title="") {
	return "
			<!DOCTYPE html>
			<html>
			  <head>
			    <title>{$title}</title>
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
			  <body>
			  	<div class='header'>
				     <div class='container'>
				        <div class='row'>
				           <div class='col-md-5'>
				              <!-- Logo -->
				              <div class='logo'>
				                 <h1><a href='index.php'>Hastane Bilgi Yönetim Sistemi</a></h1>
				              </div>
				           </div>
				           <div class='col-md-5'>
				              <div class='row'>
				                <div class='col-lg-12'>
				                  <TABLE  BGCOLOR=yellow>
    <TR><TD>
 <FORM NAME='clock_form'>
     <INPUT TYPE='button' class='btn btn-success btn-lg' NAME='clock' size=20>
 </FORM>
 <SCRIPT LANGUAGE='JavaScript'>
     function clockTick()
     {
		  currentTime = new Date();
		  document.clock_form.clock.value = ' '+currentTime.toLocaleTimeString()+'<<<<<<>>>>>>'+currentTime.toLocaleDateString() ;
		  document.clock_form.clock.blur();
		  setTimeout('clockTick()', 1000);
     }
     clockTick();
 </SCRIPT>
    </TD></TR>
</TABLE>
				                </div>
				              </div>
				           </div>
				           <div class='col-md-2'>
				              <div class='navbar navbar-inverse' role='banner'>
				                  <nav class='collapse navbar-collapse bs-navbar-collapse navbar-right' role='navigation'>
				                    <ul class='nav navbar-nav'>
				                      <li class='dropdown'>
				                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
				                        <i class='glyphicon glyphicon-log-out'></i>  Çıkış Yap <b class='caret'></b></a>
				                        <ul class='dropdown-menu animated fadeInUp'>
				                          <li><a href='cikis.php'>Çıkış Yap</a></li>
				                        </ul>
				                      </li>
				                    </ul>
				                  </nav>
				              </div>
				           </div>
				        </div>
				     </div>
				</div>
			
			";
}


function getMenu(){
	return "
			<ul class='nav' style='display: block; background-color: '>
                    <!-- Main menu -->
					<li><img src='images/logo.jpg' height='175px' width='175px'></li>
                    <li class='current'><a href='index.php'><i class='glyphicon glyphicon-home'></i> Kontrol Paneli</a></li>                                        
					<li><a href='hastaKayitForm.php'><i class='glyphicon glyphicon-floppy-disk'></i> Hasta Kayıt</a></li>
		
					<li><a href='hastaGoruntule.php'><i class='glyphicon glyphicon-user'></i> Hasta Görüntüle</a></li>
					<li><a href='doktorGoruntule.php'><i class='glyphicon glyphicon-user'></i> Doktor Görüntüle</a></li>
					<li><a href='poliklinikGoruntule.php'><i class='glyphicon glyphicon-tasks'></i> Poliklinikler</a></li>
			<li class='submenu'>
                         <a href='#'>
                            <i class='glyphicon glyphicon-zoom-in'></i> Stok Durumu
                            <span class='caret pull-right'></span>
                         </a>
                         <!--Sub menu-->
                         <ul>
                            <li><a href='ilacGoruntule.php'><i class='glyphicon glyphicon-minus'></i> İlaçlar</a></li>
                            <li><a href='malzemeGoruntule.php'><i class='glyphicon glyphicon-minus'></i> Tıbbi Malzeme</a></li>
                        </ul>
                    </li>		 
			
                </ul>
			";
}

function getFooter(){
	return "
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
			";
}



?>