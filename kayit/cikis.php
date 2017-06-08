<?php
require_once 'config.php';
require_once 'functions.php';

print getHeader("Çıkış");

	if(isset($_SESSION['kayit'])){
		session_destroy();
		header("Location:../index.php");
	}
	else{
		echo "Oturum açık değil, yönlendiriliyorsunuz..";
		header("refresh:2; url=../index.php");
	}
?>
</body>
</html>