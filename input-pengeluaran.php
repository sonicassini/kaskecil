<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="gg.css" type="text/css" rel="stylesheet" />
<link href="area.css" type="text/css" rel="stylesheet" />
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
  <form action="pengeluaran-simpan.php" name="form" method="POST" enctype="multipart/form-data">
  <h1>Input Data Pengeluaran Kas Kecil</h1>

    <fieldset>
        <div class="control-group">
            <label>SALDO</label>
            <input type="text" name="saldo" 
              <?php
                    include "koneksi.php";
                    $res = mysqli_query($konek, 
                      "select SUM(IF(nm_akun = 'Kas', jml_transaksi, 0)) 
                      - SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0)) 
                      as saldo from kas_kecil");
                    while($row = mysqli_fetch_assoc($res)){
                        echo "value=".number_format($row['saldo'])."";
                    }
                ?>
               required readonly>        
        </div>
        <div class="control-group">
            <label>No Keluar</label>
            <input type="text" name="no_pengeluaran" maxLength="8"
               required autofocus>        
        </div>
        <div class="control-group">
            <label>Tanggal</label>
            <input type="search" name="tgl_pengeluaran" required readonly
            value="<?php $today = date("Y-m-d"); echo "$today";?>">
              <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.tgl_pengeluaran);return false;" ><img name="popcal" align="absmiddle" src="calender/calbtn.gif" width="34" height="22" border="0" alt=""></a>
        </div>
        <div class="control-group">
            <label>Biaya</label>
            <select name="no_biaya" required>
                <option value="">---</option>
                <?php
                    include "koneksi.php";
                    $res = mysqli_query($konek, "select * from biaya");
                    if (!$res) die("Gagal Query Biaya");
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<option value='{$row['no_biaya']}'>{$row['nm_biaya']}</option>";
                    }
                ?>
                </select>       
        </div>
        <div class="control-group">
            <label>Jumlah</label>
            <input type="text" name="jml_pengeluaran" required 
                onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">        
        </div>
        <div class="control-group">
          <label>Keterangan</label>
                <textarea name="keterangan" rows="2" maxLength="100" placeholder="Isikan Keterangan" required></textarea>
        </div>
     </fieldset>
     <input type="submit" value="Simpan">
  </form>
</div>
</center>  
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
<div id="footer">
	<p style="font:14px verdana">
		Sistem Pencatatan Dana Kas Kecil - Metode Fluktuasi
    <br/>
    - Input Pengeluaran - 
	</p>
</div>
</body>
</div>
