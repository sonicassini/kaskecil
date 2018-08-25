
<html>
<head>
	<title>Cetak Buku Kas Kecil</title>
    <link href="styleku.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="gaya.css">
</head>
<body>
   
<?php
include "koneksi.php";
        $b = $_POST["b"];
        $t = $_POST["t"];


      echo "<h3 align='center'>BUKU KAS KECIL</h3>";
  
        $ambilbulan = $b;
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
        
        echo "<h3 align='center'>Periode $namabulan - $t</h3>";

        echo "<table border='1' width='90%' style='border-collapse:collapse;' align='center'>";
        echo "<tr class='tableheader'>";
        echo "<th>TANGGAL</th>";
        echo "<th>NO BUKTI</th>";
        echo "<th>KETERANGAN</th>";
        echo "<th>PENERIMAAN</th>";
        echo "<th>PENGELUARAN</th>";
        echo "<th>SALDO</th>";
        echo "</tr>";

//Query Saldo
    $q = "select * from kas_kecil where month(tgl_kaskecil)='$b' 
    and year(tgl_kaskecil) = '$t'";
    $h = mysqli_query($konek, $q);
    $j = mysqli_num_rows($h);
    if ($j == 0){
      $sql = "select month(tgl_kaskecil) as tgl from kas_kecil where year(tgl_kaskecil) ='$t' order by tgl_kaskecil desc limit 1";
      $exe = mysqli_query($konek, $sql);
      $dataa = mysqli_fetch_assoc($exe);
      $tgl = $dataa['tgl']; 

      //Query tampil saldo jika data kosong               
      $sql2 = "select saldo from kas_kecil where month(tgl_kaskecil)='$tgl' 
      and year(tgl_kaskecil) ='$t' order by tgl_kaskecil desc limit 1";
      $tes = mysqli_query($konek, $sql2);
      $dt = mysqli_fetch_assoc($tes);
      $tgl_terakhir = $dt['saldo'];
    }else{
      $bb = $b - 1;
      //Query tampil saldo awal jika ada data
      $sql2 = "select saldo from kas_kecil where month(tgl_kaskecil)='$bb' 
      and year(tgl_kaskecil) ='$t' order by tgl_kaskecil desc limit 1";
      $tes = mysqli_query($konek, $sql2);
      $dt = mysqli_fetch_assoc($tes);
      $tgl_terakhir = $dt['saldo'];
    }

//Query Data
    $sql1 = "select * from kas_kecil where month(tgl_kaskecil)='$b' and year(tgl_kaskecil) = '$t' order by tgl_kaskecil, level asc";

    $hasil2 = mysqli_query($konek, $sql2);
    $hasil1 = mysqli_query($konek, $sql1);
    
    while($data = mysqli_fetch_assoc($hasil2)){
        echo "<tr class='ganjil'>";
        echo "<td colspan='5'></td>";
        echo "<td align='right'>".number_format($data['saldo'])."</td>";
        echo "</tr>";
        }

    while($data = mysqli_fetch_assoc($hasil1)){
    
      if($data['nm_akun'] == "Kas"){
        echo "<tr class='ganjil'>";
        echo "<td width='20%' align='center'>".$data['tgl_kaskecil']."</td>"
        ."<td align='center'>".$data['no_kaskecil']."</td>"
        ."<td>".$data['keterangan']."</td>"
        ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
        ."<td align='right'>-</td>"
        ."<td align='right' width='20%'>".number_format($data['saldo'])."</td>";
      echo "</tr>";
      }else{
        echo "<tr class='genap'>";
        echo "<td width='20%' align='center'>".$data['tgl_kaskecil']."</td>"
        ."<td align='center'>".$data['no_kaskecil']."</td>"
        ."<td>".$data['nm_akun']."</td>"
        ."<td align='right'>-</td>"
        ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
        ."<td align='right' width='20%'>".number_format($data['saldo'])."</td>";
      echo "</tr>";
      }
    }
    ?>
    </table>
    <script>
        window.load = cetak();
        function cetak(){
            window.print();
        }
    </script>
</body>
</html>