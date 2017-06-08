<!DOCTYPE html>
<html>
  <head>
    <title>Hastane v1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="../css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Bilgi İşlem Giriş Ekranı</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
<?php 
require_once 'config.php';
/* $bilgi_islem="bilgi_islem";
$bilgi_islem_pw="bilgi_pass";
$hastakayit="hastakayit";
$hastakayit_pw="kayit_pass"; */

$username=""; $password="";
if (array_key_exists ( "username", $_POST ))
	$username = $_POST ['username'];
if (array_key_exists ( "password", $_POST ))
	$password = $_POST ['password'];

$bilgi = "";
if (array_key_exists ( "bilgi", $_SESSION )) {
	$bilgi = $_SESSION ['bilgi'];
}
if ($bilgi) {
	header ( "Location:index.php" );
	exit ();
}else{

?>
	
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			            
			            <form class="form-inline" action="giris.php" method="post">
							<?php 
							if(array_key_exists ( "username", $_POST )){
							
								$rs=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password' ");
							
								if(mysql_num_rows($rs)>0){
									if ($username=="bilgi_islem") {
										$bilgi=$_SESSION['bilgi']=$username;
										echo "başarıyla giriş yaptınız. Yönlendiriliyorsunuz.. ".$bilgi;
										header("refresh:2; url=index.php");
									}else{
										echo "Kullanıcı adı veya parola hatalı..";
										header("refresh:2; url=giris.php");
									}
								}else {
									echo "Kullanıcı adı veya parola hatalı..";
									header("refresh:2; url=giris.php");
								}
							}
							?>
							<div class="form-group">
								<input class="form-control" type="text" placeholder="Username" name="username" />
							</div><hr>
							<div class="form-group">
								<input class="form-control" type="password" placeholder="Password" name="password" />
							</div><hr>
								<input type="submit" class="btn btn-lg btn-primary btn-block" value="Giriş"> 
							
						</form>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
  </body>
</html>
<?php }?>