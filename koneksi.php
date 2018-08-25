<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "kaskecil";

	$konek = @mysqli_connect($host, $user, $pass, $dbname);
	if(!$konek) { //artinya $konek != true
		die( "Gagal Koneksi karena : ".mysqli_connect_error());
	}
?>
