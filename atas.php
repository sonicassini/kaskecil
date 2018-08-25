<?php
  session_start();
  if (!isset($_SESSION['username']) or empty($_SESSION['username'])){
    header("location:login.php?pesan=Anda Harus Login Dahulu");
    exit;
  }
?>

<div id="content">
	<p style="color:red; font:14px verdana" align="center">
		<?php date_default_timezone_set("Asia/Jakarta"); echo date("D, d F Y").
		"";?>
		<br/> 
		<?php
      echo "Masuk Sebagai : ".$_SESSION['username'];
	?>
	</p>
</div>