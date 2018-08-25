<head>
<link href="wow.css" type="text/css" rel="stylesheet" />
<link href="dp.css" type="text/css" rel="stylesheet" />
<link href="gg.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="gaya.css">
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
<div id="tampil">   
 <h3 align='center'>BUKU KAS KECIL</h3>
  <table border='5' width='48%' style='border-collapse:collapse;' align='center'>
  <th>PERIODE</th>
  <tr>
    <td>
      <form method="POST" enctype="multipart/form-data">
    <fieldset id="UserDataFields">
    <div class="control-group">
      <select name="bulan" id="RegisterUsername" required>
      <option value="">- Pilih Bulan -</option>
      <option value="01">Januari</option>
      <option value="02">Februari</option>
      <option value="03">Maret</option>
      <option value="04">April</option>
      <option value="05">Mei</option>
      <option value="06">Juni</option>
      <option value="07">Juli</option>
      <option value="08">Agustus</option>
      <option value="09">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>

    <select name="tahun" required>
      <option value="">- Pilih Tahun -</option>
        <?php
          include "koneksi.php";
          $res = mysqli_query($konek, "SELECT YEAR(tgl_kaskecil) AS thn FROM kas_kecil GROUP BY YEAR(tgl_kaskecil);");
          if (!$res) die("Gagal Query Tahun");
          while($row = mysqli_fetch_assoc($res)){
            echo "<option value='{$row['thn']}'>{$row['thn']}</option>";
                    }
        ?>
    </select>
  </div>
  </fieldset>
    <input style="margin-left:35%" type="submit" name="submit" value="Tampil">
  
    </form>
    </td>
  </tr>
  </table>
</div>

<div id='tampil'>
    <?php // jika submit button diklik
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        include "koneksi.php";
          $bulan = $_POST['bulan'];
          $tahun = $_POST['tahun'];

         //tampil tabel
      echo "<h3 align='center'>BUKU KAS KECIL</h3>";
  
      $ambilbulan = $bulan;
      if ($ambilbulan=="01")  $namabulan="Januari";
    elseif ($ambilbulan=="02")  $namabulan="Februari";
    elseif ($ambilbulan=="03")  $namabulan="Maret";
    elseif ($ambilbulan=="04")  $namabulan="April";
    elseif ($ambilbulan=="05")  $namabulan="Mei";
    elseif ($ambilbulan=="06")  $namabulan="Juni";
    elseif ($ambilbulan=="07")  $namabulan="Juli";
    elseif ($ambilbulan=="08")  $namabulan="Agustus";
    elseif ($ambilbulan=="09")  $namabulan="September";
    elseif ($ambilbulan=="10")  $namabulan="Oktober";
    elseif ($ambilbulan=="11")  $namabulan="November";
    elseif ($ambilbulan=="12")  $namabulan="Desember";
      
      echo "<h3 align='center'>Periode $namabulan - $tahun</h3>";

    echo "<table border='1' class='grid' align='center' width='800px' height='150px'>";
    echo "<tr>";
    echo "<th>NO</th>";
    echo "<th>TANGGAL</th>";
    echo "<th>NO BUKTI</th>";
    echo "<th>KETERANGAN</th>";
    echo "<th>PENERIMAAN</th>";
    echo "<th>PENGELUARAN</th>";
    echo "<th>SALDO</th>";
    echo "</tr>";

//Query Saldo
    $q = "select * from kas_kecil where month(tgl_kaskecil)='$bulan' 
    and year(tgl_kaskecil) = '$tahun'";
    $h = mysqli_query($konek, $q);
    $j = mysqli_num_rows($h);
    if ($j == 0){
      $sql = "select month(tgl_kaskecil) as tgl from kas_kecil where year(tgl_kaskecil) ='$tahun' order by tgl_kaskecil desc limit 1";
      $exe = mysqli_query($konek, $sql);
      $dataa = mysqli_fetch_assoc($exe);
      $tgl = $dataa['tgl']; 

      //Query tampil saldo jika data kosong               
      $sql2 = "select saldo from kas_kecil where month(tgl_kaskecil)='$tgl' 
      and year(tgl_kaskecil) ='$tahun' order by tgl_kaskecil desc limit 1";
      $tes = mysqli_query($konek, $sql2);
      $dt = mysqli_fetch_assoc($tes);
      $tgl_terakhir = $dt['saldo'];
    }else{
      $bb = $bulan - 1;
      //Query tampil saldo awal jika ada data
      $sql2 = "select saldo from kas_kecil where month(tgl_kaskecil)='$bb' 
      and year(tgl_kaskecil) ='$tahun' order by tgl_kaskecil desc limit 1";
      $tes = mysqli_query($konek, $sql2);
      $dt = mysqli_fetch_assoc($tes);
      $tgl_terakhir = $dt['saldo'];
    }

//Validasi
    $val = "SELECT MONTH(tgl_kaskecil) AS bln, YEAR(tgl_kaskecil) AS thn, tgl_kaskecil AS awal 
    FROM kas_kecil WHERE keterangan ='Pembentukan Kas Kecil'";
    $hsl = mysqli_query($konek, $val);
    $dt = mysqli_fetch_assoc($hsl);
    $bln = $dt['bln'];
    $thn = $dt['thn'];
    $awal = $dt['awal'];

    //validasi jika bln pilih < bln pembentukan
    $pesan = "Tidak Ada Transaksi, Pembentukan Kas Kecil Tanggal ".$awal;
    if ($tahun == $thn){
      if ($bulan < $bln) {
        echo "
          <script>
            alert('$pesan');
            self.history.back();      
          </script>
        ";
        exit;
      }
    }
  
//Query Data
    $sql1 = "select * from kas_kecil where month(tgl_kaskecil)='$bulan' 
    and year(tgl_kaskecil) = '$tahun' order by tgl_kaskecil, level asc";

    $hasil2 = mysqli_query($konek, $sql2);
    $hasil1 = mysqli_query($konek, $sql1);

    $jumData = mysqli_num_rows($hasil1);
    echo "<h4 align=right>Terdapat : <b>$jumData</b> Data</h4>";

    //kalo sampe sini berarti berhasil query
  
    echo "<form method='POST' action='kaskecil-cetak.php' enctype='multipart/form-data' target='_blank'>";
        echo "<input type='text' name='b' value='$bulan' readonly>";
        echo "-";
        echo "<input type='text' name='t' value='$tahun' readonly>"; 
        
      echo "<input type='image' style='margin-left:51%; height: 60px' src='print.png' onclick='cetak()'>";
      echo "</form>";
    
    $no = 0;
    while($data = mysqli_fetch_assoc($hasil2)){
        echo "<tr class='ganjil'>";
        echo "<td colspan='6'></td>";
        echo "<td align='right'>".number_format($data['saldo'])."</td>";
        echo "</tr>";
        }

    while($data = mysqli_fetch_assoc($hasil1)){
     $no++;
    
      if($data['nm_akun'] == "Kas"){
        echo "<tr class='ganjil'>";
        echo "<td style='width:50px' align='center'> $no </td>";
        echo "<td width='19%' align='center' style='font:18px verdana'>".$data['tgl_kaskecil']."</td>"
        ."<td align='center' style='font:18px verdana'>".$data['no_kaskecil']."</td>"
        ."<td style='font:20px verdana'>".$data['keterangan']."</td>"
        ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
        ."<td align='right'>-</td>"
        ."<td align='right' style ='color:green' width='20%'>".number_format($data['saldo'])."</td>";
      echo "</tr>";
      }else{
        echo "<tr class='genap'>";
        echo "<td style='width:50px' align='center'> $no </td>";
        echo "<td width='19%' align='center' style='font:18px verdana'>".$data['tgl_kaskecil']."</td>"
        ."<td align='center' style='font:18px verdana'>".$data['no_kaskecil']."</td>"
        ."<td style='font:20px verdana'>".$data['nm_akun']."</td>"
        ."<td align='right'>-</td>"
        ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
        ."<td align='right' style ='color:red' width='20%'>".number_format($data['saldo'])."</td>";
      echo "</tr>";
      }  
    }

      }
  ?>
</table>
</div> 
</center>   
<div id="footer">
	<p style="font:14px verdana">
		Sistem Pencatatan Dana Kas Kecil - Metode Fluktuasi
    <br/>
    - Buku Kas Kecil -  
	</p>
</div>
</body>
</div>
