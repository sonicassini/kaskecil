
<html>
<head>
	<title>Cetak Laporan Pengeluaran Kas Kecil Per Periode</title>
    <link href="styleku.css" type="text/css" rel="stylesheet" />
</head>
<body>
   
<?php
include "koneksi.php";
        $b = $_POST["b"];
        $t = $_POST["t"];


      echo "<h3 align='center'>LAPORAN PENGELUARAN KAS KECIL</h3>";
  
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
        echo "<th rowspan='1'>NO PENGELUARAN</th>";
        echo "<th rowspan='1'>NO BIAYA</th>";
        echo "<th>KETERANGAN</th>";
        echo "<th>JUMLAH</th>";
        echo "</tr>";

        $sql1 = "select * from pengeluaran_kk where month(tgl_pengeluaran)='$b' and year(tgl_pengeluaran) = '$t' order by tgl_pengeluaran asc";
        $sql2 = "select SUM(jml_pengeluaran) as jumlah from pengeluaran_kk where month(tgl_pengeluaran)='$b' and year(tgl_pengeluaran) = '$t'"; 

        $hasil1 = mysqli_query($konek, $sql1);
        $hasil2 = mysqli_query($konek, $sql2);

        while($data = mysqli_fetch_assoc($hasil1)){
            echo "<tr id='rowHover'>";
            echo "<td width='20%' align='center'>".$data['tgl_pengeluaran']."</td>"
                ."<td width='20%' align='center'>".$data['no_pengeluaran']."</td>"
                ."<td width='20%' align='center'>".$data['no_biaya']."</td>"
                ."<td>".$data['nm_pengeluaran']."</td>"
                ."<td align='right'>".number_format($data['jml_pengeluaran'])."</td>";
            echo "</tr>";
    
        }
        while($data = mysqli_fetch_assoc($hasil2)){
            echo "<tr class='jumlah'>";
            echo "<td colspan='4' align='right'>Total :</td>"
                 ."<td align='right'>".number_format($data['jumlah'])."</td>";
            echo "</tr>";
            
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