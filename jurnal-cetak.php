
<html>
<head>
	<title>Cetak Buku Jurnal</title>
    <link href="styleku.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="gaya.css">
</head>
<body>
   
<?php
include "koneksi.php";
        $b = $_POST["b"];
        $t = $_POST["t"];


      echo "<h3 align='center'>BUKU JURNAL</h3>";
  
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
        echo "<th>KETERANGAN</th>";
        echo "<th>DEBET</th>";
        echo "<th>KREDIT</th>";
        echo "</tr>";

        $sql1 = "select * from kas_kecil where month(tgl_kaskecil)='$b' and year(tgl_kaskecil) = '$t' order by tgl_kaskecil, level asc";

        $hasil1 = mysqli_query($konek, $sql1);

        while($data = mysqli_fetch_assoc($hasil1)){
           
            if($data['nm_akun'] == "Kas"){
            echo "<tr class='ganjil'>";
            echo "<td rowspan='4' width='20%' align='center'>".$data['tgl_kaskecil']."</td>"
                ."<td>Kas Kecil</td>"
                ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
                ."<td align='right'></td>";
            echo "</tr>";
            echo "<tr class='ganjil'>";
            echo "<td>&nbsp &nbsp".$data['nm_akun']."</td>"
            ."<td align='right'></td>"
            ."<td align='right'>".number_format($data['jml_transaksi'])."</td>";
            echo "<tr/>";
            echo "<tr class='ganjil'>";
            echo "<td colspan='3' style='font:12px verdana; color:grey'>(".$data['keterangan'].")</td>";
            echo "<tr/>";
            echo "<tr>";
            echo "<td colspan='5'></td>";
            echo "<tr/>";
      }else{
        echo "<tr class='genap'>";
        echo "<td rowspan='4' width='20%' align='center'>".$data['tgl_kaskecil']."</td>"
        ."<td>".$data['nm_akun']."</td>"
        ."<td align='right'>".number_format($data['jml_transaksi'])."</td>"
        ."<td align='right'></td>";
        echo "</tr>";
        echo "<tr class='genap'>";
        echo "<td>&nbsp &nbsp Kas Kecil</td>"
            ."<td align='right'></td>"
            ."<td align='right'>".number_format($data['jml_transaksi'])."</td>";
        echo "<tr/>";
        echo "<tr class='genap'>";
        echo "<td colspan='3' style='font:12px verdana; color:grey'>(".$data['keterangan'].")</td>";
        echo "<tr/>";
        echo "<tr>";
        echo "<td colspan='5'></td>";
        echo "<tr/>";
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