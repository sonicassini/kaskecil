<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="az.css" type="text/css" rel="stylesheet" />
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
  </ul>
</div>
<center>
<div id="content">
<?php
  include "koneksi.php";
  $no_biaya = $_GET['no_biaya'];
  $sql = "select * from biaya where no_biaya = '$no_biaya'";
  $hasil = mysqli_query($konek, $sql);
  if(!$hasil) die("Gagal Query Biaya");
  //Jika berhasil, maka ambil tiap field dgn fetch
  $dt = mysqli_fetch_assoc($hasil);
  //Letakkan tiap field ke dalam variabel
  $nm_biaya   = $dt['nm_biaya'];
  ?>

  <form action="biayaedit-simpan.php" method="post">
    <h1>Edit Data Biaya</h1>

    <fieldset id="UserDataFields">
        <div class="control-group">
            <label>No Biaya</label>
            <input type="text" name="no_biaya"
              value="<?php echo $no_biaya;?>" required readonly>
        </div>
        <div class="control-group">
            <label>Nama Biaya</label>
            <input type="text" name="nm_biaya"
              placeholder="<?php echo $nm_biaya;?>" required autofocus>
        </div>
     </fieldset>
    <input type="submit" value="Update">
    <input type="button" value="Batal" onClick="self.history.back()">
</form>
  
</div>
</center>   
<div id="footer">
	<p style="font:14px verdana">
		Sistem Pencatatan Dana Kas Kecil - Metode Fluktuasi
    <br/>
    - Edit Biaya - 
	</p>
</div>
</body>
</div>
