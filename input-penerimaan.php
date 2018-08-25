<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="gg.css" type="text/css" rel="stylesheet" />
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
<form action="penerimaan-simpan.php" name="form" method="POST" enctype="multipart/form-data">
  <h1>Input Data Penerimaan Kas Kecil</h1>

    <fieldset id="UserDataFields">
        <div class="control-group">
            <label>No Terima</label>
            <input type="text" name="no_penerimaan" maxLength="8" required autofocus>        
        </div>
        <div class="control-group">
            <label>Tanggal</label>
            <input type="search" name="tgl_penerimaan" required readonly
            value="<?php $today = date("Y-m-d"); echo "$today";?>">
              <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.tgl_penerimaan);return false;" ><img name="popcal" align="absmiddle" src="calender/calbtn.gif" width="34" height="22" border="0" alt=""></a>
        </div>
        <div class="control-group">
            <label>Jumlah</label>
            <input type="text" name="jml_penerimaan" required 
                <?php
                //aktifkan jika metode imprest
                /*  include "koneksi.php";
                    $cek1 = mysqli_num_rows(mysqli_query($konek, 
                          "select * from kas_kecil WHERE keterangan='Pembentukan Kas Kecil'"));
                    $cek2 = mysqli_num_rows(mysqli_query($konek, 
                          "select * from kas_kecil WHERE keterangan='Pengisian Kembali'"));
                    $cek3 = mysqli_fetch_assoc(mysqli_query($konek, 
                          "select SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0))  
                          as awal from kas_kecil"));
                    $cek4 = mysqli_fetch_assoc(mysqli_query($konek, 
                          "select (SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0)) 
                          - SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0))) 
                          as saldo1 from kas_kecil"));                  
                    $cek5 = mysqli_fetch_assoc(mysqli_query($konek, 
                          "select SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0)) -
                          (SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0)) 
                          - SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0))) 
                          as saldob from kas_kecil"));
                    $cek6 = mysqli_fetch_assoc(mysqli_query($konek, 
                          "select (SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0)) - 
                          (SUM(IF(keterangan = 'Pengisian Kembali', jml_transaksi, 0)) 
                          - SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0)))) 
                          as saldoc from kas_kecil"));
                    $cek7 = mysqli_fetch_assoc(mysqli_query($konek, 
                          "select SUM(IF(keterangan = 'Pembentukan Kas Kecil', jml_transaksi, 0)) - 
                          (SUM(IF(nm_akun = 'Kas', jml_transaksi, 0)) 
                          - SUM(IF(nm_akun NOT IN ('Kas'), jml_transaksi, 0))) 
                          as saldod from kas_kecil"));
                         
                      
                      if ($cek1 == 0){
                        echo "placeholder='Isi Jumlah'";
                      }else{
                        echo " readonly ";
                        
                        if ($cek2 == 0) {
                          if ($cek3['awal'] == $cek4['saldo1']) {
                            echo "placeholder='Saldo Max'";
                          }else{
                            echo "value=".number_format($cek5['saldob'])."";
                          } 
                        }
                        if ($cek2 > 0) {
                          if ($cek3['awal'] == $cek6['saldoc']) {
                            echo "placeholder='Saldo Max'";
                          }else{
                            echo "value=".number_format($cek7['saldod'])."";
                          } 
                        }
                      } */
                ?> 
            onkeydown='return numbersonly(this, event);' 
            onkeyup='javascript:tandaPemisahTitik(this);'>
                      
        </div>
        <div class="control-group">
            <label>Keterangan</label>
            <input type="text" name="nm_penerimaan" style='font:14px arial; text-align:center' 
            <?php
                    include "koneksi.php";
                    $cek = mysqli_num_rows(mysqli_query($konek, "select * from penerimaan_kk WHERE nm_penerimaan='Pembentukan Kas Kecil'"));
                      if ($cek == 0){
                        echo "value='Pembentukan Kas Kecil'";
                      }else{
                        echo "value='Pengisian Kembali'";
                          }
                ?>
                required readonly>        
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
    - Input Penerimaan - 
	</p>
</div>
</body>
</div>
