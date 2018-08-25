<link rel="stylesheet" href="log.css">
<link href="wow.css" type="text/css" rel="stylesheet" />

<body background="body_back.gif"/>
<div class="formisian" style='width:250px'>
<form action="valid.php" method="post">
<table>
	<tr>
		<td colspan="2" style="border-bottom:1px solid black;text-align:center;">
			Masuk Ke Sistem
		</td>
	</tr>
	<?php
	if (isset($_GET['pesan'])){
		echo "<tr style='color:red'>";
		echo "<td colspan='2'>".$_GET['pesan']."</td>";
		echo "</tr>";
	}
	?>
	<tr>
		<td>Username</td>
		<td><input type="text" name="username" id="RegisterUsername" required></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" id="RegisterUsername" required></td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" value="Masuk">
		</td>
	</tr>
</table>	
</form>
</div>
<center>
<div id="content">
<h3 style="color: red">Selamat Datang Pengguna Sistem</h3>
<p style="text-align:justify; color: blue"><b>&nbsp &nbsp Sistem Pencatatan Dana Kas Kecil <i>Metode Fluktuasi</i></b> adalah sebuah sistem yang digunakan untuk mengelola pencatatan dana kas kecil yang menggunakan metode sistem dana tidak tetap. </p>
</div>
</center>
<body/>