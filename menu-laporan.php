<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="gg.css" type="text/css" rel="stylesheet" />
<link href="menu.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="my.js"></script>
</head>
<body background="body_back.gif"/>
<?php
  include "atas.php";
?>
<div id="wrap">	
<div id="atas">
  <ul>
    <li><a href="home.php">HOME</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">INPUT DATA</a>
      <div class="dropdown-content">
        <a href="input-biaya.php">Input Biaya</a>
        <a href="input-penerimaan.php">Input Penerimaan Kas Kecil</a>
        <a href="input-pengeluaran.php">Input Pengeluaran Kas Kecil</a>
      </div>
    </li>  
    <li><a href="menu-laporan.php">LAPORAN</a></li>
    <li style="float:right"><a href="logout.php"><input type="submit" value="LOGOUT"></a></li>
  </ul>
</div>
<div id="kanan">
    <div id="menu_vertikal">
    .:: DAFTAR LAPORAN ::.
      <ul>
        <li><a href="tampil-biaya.php">DAFTAR BIAYA</a></li>
        <li><a href="tampil-penerimaan.php">LAP PENERIMAAN</a></li>
        <li><a href="tampil-pengeluaran1.php">LAP PENGELUARAN PER PERIODE</a></li>
        <li><a href="tampil-pengeluaran2.php">LAP PENGELUARAN PER JENIS BIAYA</a></li>
        <li><a href="tampil-jurnal.php">BUKU JURNAL</a></li>
        <li><a href="tampil-kaskecil.php">BUKU KAS KECIL</a></li>
      </ul>
    </div>
  </div>
<center>
<img src="daftar-laporan.png" style="display: block; margin: 0 auto; text-align: center; height: 400px;"/>
</center>		
<div id="footer">
	<p style="font:14px verdana">
		Sistem Pencatatan Dana Kas Kecil - Metode Fluktuasi
    <br/>
    - Laporan - 
	</p>
</div>
</body>
</div>
